<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Repositories\CommonRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\EmployeesAttendance;
use App\Model\AssignJob;
use App\Model\Attendance;
use App\Model\Company;
use Illuminate\Support\Facades\Validator;
use Svg\Tag\Group;

class AttendanceController extends Controller
{

    protected $commonRepository;

    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository  = $commonRepository;
    }

    public function index(Request $request)
    {
        $query = Attendance::with(['employee', 'company', 'assignJob'])
            ->orderBy('company_id')
            ->orderBy('year')
            ->orderBy('month');

        // Filter by company if selected
        if ($request->has('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end   = Carbon::parse($request->end_date)->endOfDay();

            $query->whereBetween(DB::raw("STR_TO_DATE(CONCAT(year,'-',month,'-01'), '%Y-%m-%d')"), [$start, $end]);
        }

        $results = $query->get();

        // Group by Company → Month-Year
        $grouped = $results->groupBy(function ($item) {
            return $item->company->company_name ?? 'Unknown Company';
        })->map(function ($companyRecords) {
            return $companyRecords->groupBy(function ($item) {
                return sprintf('%02d-%04d', $item->month, $item->year);
            });
        });

        if ($request->ajax()) {
            return view('admin.attendance.pagination', compact('grouped'))->render();
        }

        $companyList = $this->commonRepository->companyList();

        return view('admin.attendance.index', compact('grouped', 'companyList'));
    }

    public function create()
    {
        $companyList    = $this->commonRepository->companyList();
        return view('admin.attendance.form', ['companyList' => $companyList]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'month'      => (int) $request->month,
            'year'       => (int) $request->year,
            'company_id' => (int) $request->company_id,
            'selected'   => $request->selected ?? [],
        ]);

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer',
            'month'      => 'required|integer|min:1|max:12',
            'year'       => 'required|digits:4',
            'selected'   => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            foreach ($request->selected as $employeeId) {
                $daysWorked = $request->days[$employeeId] ?? 0;
                $assignJobId = $request->assign_job_id[$employeeId] ?? null;

                Attendance::updateOrCreate(
                    [
                        'company_id'    => $request->company_id,
                        'emp_id'        => $employeeId,
                        'month'         => $request->month,
                        'year'          => $request->year,
                    ],
                    [
                        'assign_job_id'  => $assignJobId,
                        'days_worked'   => $daysWorked,
                        'status'        => 1,
                    ]
                );
            }

            return redirect()->route('attendance.index')->with('success', 'Attendance saved successfully!');
        } catch (\Exception $e) {
            \Log::error('Attendance save error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while saving attendance!');
        }
    }

    public function getCompanyEmployees(Request $request)
    {
        $request->merge([
            'month' => (int) $request->month,
            'year'  => (int) $request->year,
            'company_id' => (int) $request->company_id,
        ]);
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer',
            'month'      => 'required|integer|min:1|max:12',
            'year'       => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        try {
            $jobs = AssignJob::with(['employee'])
                ->where('company_id', $request->company_id)
                ->where('status', 1)
                ->get();

            // echo "<pre>";
            // print_r($jobs->toArray());
            // exit;

            $employees = $jobs->map(function ($job) {
                if (!$job->employee) return null;
                return [
                    'emp_id'       => $job->employee->emp_id,
                    'employee_id'  => $job->employee->employee_id,
                    'name'         => $job->employee->name,
                    'father_name'  => $job->employee->father_name,
                    'gender'       => $job->employee->gender,
                    'shift'        => $job->shift,
                    'shift_timing' => $job->shift_timing,
                    'post'         => $job->employee->job->post,
                    'job_id'       => $job->job_id,
                ];
            })->filter()->values();

            if ($employees->isEmpty()) {
                return response()->json(['error' => 'No active employees found for this company.'], 404);
            }

            return response()->json($employees);
        } catch (\Exception $e) {
            \Log::error('Attendance Employee Load Error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function exportCsv(Request $request)
    {
        $query = Attendance::with(['employee', 'company', 'assignJob']);

        if ($request->company_id) $query->where('company_id', $request->company_id);
        if ($request->monthField) $query->where('month', $request->monthField);
        if ($request->yearField)  $query->where('year', $request->yearField);

        $results = $query->get();
        // echo "<pre>";
        // print_r($results->toArray());
        // exit;
        $filename = 'attendance_report.csv';

        $company = Company::find($request->company_id);
        $companyname    = $company->company_name ?? 'All Companies';
        $companyAddress = $company->address ?? '';
        $companyphone   = $company->phone ?? '';

        $month = $request->monthField ?: date('m');
        $year  = $request->yearField ?: date('Y');

        $callback = function () use ($results, $companyname, $companyAddress, $companyphone, $month, $year) {

            $handle = fopen('php://output', 'w');

            // UTF-8 BOM
            fwrite($handle, "\xEF\xBB\xBF");

            // Title
            fputcsv($handle, ['', '', '', 'MAPL - Attendance Sheet']);
            fputcsv($handle, []);
            fputcsv($handle, ['', 'Party Name & Address:', $companyname . ', ' . $companyAddress]);
            fputcsv($handle, ['', 'Phone:', $companyphone, '', '', 'Date:', date("d-m-Y")]);
            fputcsv($handle, ['', '', '', '', '', 'Month/Year:', $month . '/' . $year]);
            fputcsv($handle, []);

            // CSV header
            fputcsv($handle, [
                'Sr',
                'EMP ID',
                'Name',
                'Gender',
                'Post',
                'Shift',
                'Per Day Wages',
                'Shift Timing',
                'Working Days'
            ]);

            $serial = 1;
            $total_days_worked = 0;

            foreach ($results as $value) {
                $post        = $value->employee->job->post ?? '-';
                $perday_wages = $value->assignJob->perday_wages ?? 0;
                $shiftName   = $value->assignJob->shift ?? '-';
                $shiftTime   = $value->assignJob->shift_timing ?? '-';
                $days_worked = $value->days_worked ?? 0;
                $total_days_worked += $days_worked;

                fputcsv($handle, [
                    $serial++,
                    $value->employee->employee_id ?? '-',
                    $value->employee->name ?? '-',
                    $value->employee->gender ?? '-',
                    $post,
                    $shiftName,
                    $perday_wages,
                    $shiftTime,
                    $days_worked
                ]);
            }

            fputcsv($handle, []);
            fputcsv($handle, ['', '', 'TOTAL PERSON', count($results), '', '', '', 'TOTAL WORKING DAYS', $total_days_worked]);

            fputcsv($handle, []);
            fputcsv($handle, []);
            fputcsv($handle, []);

            fputcsv($handle, ['', '', '', 'Overall Attedance Summary ', '', '', '', '']);

            fputcsv($handle, [
                '',
                '',
                'Particular (Job Role)',
                'Gender',
                'Hrs',
                'Total Employee/Qty.',
                'Total Duty',
                '',
                ''
            ]);

            // groupby shift_timing and gender role wise also
            $grouped = $results->groupBy(function ($item) {
                $shift = $item->assignJob->shift_timing ?? 'Unknown Shift';
                $gender = $item->employee->gender ?? 'Unknown Gender';
                $jobRole = $item->employee->job->post ?? 'Unknown Role';
                return $jobRole . '|' . $shift . '|' . $gender;
            });
            $total = 0;
            foreach ($grouped as $key => $group) {
                $parts = explode('|', $key);
                $jobRole = $parts[0];
                $shiftTiming = $parts[1];
                $gender = $parts[2];


                $totalEmployees = $group->count();
                $totalDuty = $group->sum('days_worked');
                $total += $totalDuty;
                fputcsv($handle, [
                    '',
                    '',
                    $jobRole,
                    $gender,
                    $shiftTiming,
                    $totalEmployees,
                    $totalDuty,
                    '',
                    ''
                ]);
            }

            fputcsv($handle, ['', '', '', '', '', 'Grand Total Duty', $total, '', '']);
            fputcsv($handle, []);
            fputcsv($handle, []);
            fputcsv($handle, ['', '', 'Prepared By', '', '', 'Checked By', '', '', 'Site Supervisor /Field Officer']);

            fclose($handle);
        };

        return response()->stream($callback, 200, [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ]);
    }

    public function exportPdf(Request $request)
    {
        $query = Attendance::with(['employee', 'company', 'assignJob']);

        if ($request->company_id) $query->where('company_id', $request->company_id);
        if ($request->monthField) $query->where('month', $request->monthField);
        if ($request->yearField)  $query->where('year', $request->yearField);

        $results = $query->get();

        $company = Company::find($request->company_id);
        $companyname    = $company->company_name ?? 'All Companies';
        $companyAddress = $company->address ?? '';
        $companyphone   = $company->phone ?? '';

        $month = $request->monthField ?: date('m');
        $year  = $request->yearField ?: date('Y');

        // SUMMARY GROUPING LIKE CSV
        $summary = [];
        $grouped = $results->groupBy(function ($item) {
            $shift = $item->assignJob->shift_timing ?? 'Unknown Shift';
            $gender = $item->employee->gender ?? 'Unknown Gender';
            $role = $item->employee->job->post ?? 'Unknown Role';
            return $role . '|' . $shift . '|' . $gender;
        });

        // TOTAL PERSON
        $total_person = $results->count();

        // TOTAL WORKING DAY
        $total_working_day = $results->sum('days_worked');

        foreach ($grouped as $key => $group) {
            [$role, $shift, $gender] = explode('|', $key);

            $summary[] = [
                'jobRole'         => $role,
                'gender'          => $gender,
                'shift'           => $shift,
                'total_employees' => $group->count(),
                'total_duty'      => $group->sum('days_worked')
            ];
        }

        $total_duty = collect($summary)->sum(function ($x) {
            return (int) $x['total_duty'];
        });

        $pdf = PDF::loadView('admin.attendance.attendance_pdf', compact(
            'results',
            'summary',
            'companyname',
            'companyAddress',
            'companyphone',
            'month',
            'year',
            'total_person',
            'total_working_day',
            'total_duty'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('attendance_report.pdf');
    }


    public function updateAmounts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:attendance,id',
            'advance' => 'nullable|numeric',
            'dress' => 'nullable|numeric',
            'other' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $record = Attendance::find($request->id);
        if (!$record) {
            return response()->json(['success' => false, 'message' => 'Record not found']);
        }

        $record->advance = $request->advance ?? 0;
        $record->dress_deduction = $request->dress ?? 0;
        $record->other_deduction = $request->other ?? 0;
        $record->save();

        return response()->json([
            'success' => true,
            'updated_at' => $record->updated_at->format('Y-m-d H:i:s')
        ]);
    }
}
