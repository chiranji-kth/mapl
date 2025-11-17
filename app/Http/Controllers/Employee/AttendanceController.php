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
use Illuminate\Support\Facades\Validator;

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
        $results = Attendance::with(['employee', 'company', 'assignJob'])
            ->orderBy('company_id')
            ->orderBy('year')
            ->orderBy('month');

        if ($request->company_id) $results->where('company_id', $request->company_id);
        if ($request->monthField) $results->where('month', $request->monthField);
        if ($request->yearField) $results->where('year', $request->yearField);

        $results = $results->get();

        $filename = 'attendance_report.csv';

        $callback = function () use ($results) {
            $handle = fopen('php://output', 'w');

            // CSV header
            fputcsv($handle, ['Company', 'Month', 'EMP ID', 'Name', 'Gender', 'Post', 'shift', 'Shift Timing', 'Working Days', 'Advance', 'Dress Deduction', 'other Deduction']);

            foreach ($results as $value) {
                fputcsv($handle, [
                    $value->company->company_name ?? '-',
                    \DateTime::createFromFormat('!m', $value->month)->format('F') . ' ' . $value->year,
                    $value->employee->employee_id ?? '-',
                    $value->employee->name ?? '-',
                    $value->employee->gender ?? '-',
                    $value->employee->job->post ?? '-',
                    $value->assignJob->shift ?? '-',
                    $value->assignJob->shift_timing ?? '-',
                    $value->days_worked,
                    $value->advance ?? '0',
                    $value->dress_deduction ?? '0',
                    $value->other_deduction ?? '0',
                ]);
            }

            fclose($handle);
        };

        // Headers passed directly to the stream response
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Use stream() with headers as the 3rd parameter
        return response()->stream($callback, 200, $headers);
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
