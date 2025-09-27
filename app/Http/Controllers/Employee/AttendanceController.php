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
        // Base query with eager loading
        $query = Attendance::with(['employee', 'company', 'assignJob'])
            ->orderBy('id', 'DESC');

        // Apply filter if month is selected
        if ($request->has('monthField')) {
            $query->where('month', $request->monthField);
        }

        $results = $query->get();
        // echo "<pre>";
        // print_r($results->toArray());
        // exit;
        // AJAX request: return only the pagination partial
        if ($request->ajax()) {
            return view('admin.attendance.pagination', compact('results'))->render();
        }

        // Full page load: return main index view
        return view('admin.attendance.index', compact('results'));
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

        // echo "<pre>";
        // print_r($request->all());
        // exit;

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
            $jobs = AssignJob::with(['employee' => function ($q) {
                $q->active();
            }, 'job'])
                ->where('company_id', $request->company_id)
                ->where('status', 1)
                ->get();

            $employees = $jobs->map(function ($job) {
                if (!$job->employee) return null;

                return [
                    'emp_id'       => $job->employee->emp_id,
                    'employee_id'  => $job->employee->employee_id,
                    'name'         => $job->employee->name,
                    'gender'       => $job->employee->gender,
                    'shift_timing' => $job->shift_timing,
                    'post'         => '',
                    'job_id'      => $job->job_id,
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
}
