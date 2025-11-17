<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignJobRequest;
use App\Model\Company;
use App\Model\Employees;
use App\Model\AssignJob;
use App\Model\Job;
use App\Repositories\CommonRepository;
use App\Repositories\AssignjobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AssignJobController extends Controller
{

    protected $commonRepository;
    protected $assignjobRepository;

    public function __construct(CommonRepository $commonRepository, AssignjobRepository $assignjobRepository)
    {
        $this->commonRepository = $commonRepository;
        $this->assignjobRepository = $assignjobRepository;
    }

    public function index(Request $request)
    {
        $query = AssignJob::with(['employees', 'company'])->where('status', true)->orderBy('job_id', 'DESC');

        if ($request->ajax()) {
            if (!empty($request->employee_name)) {
                $query->whereHas('employees', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->employee_name . '%');
                });
            }

            $results = $query->get();
            return view('admin.recruitment.career.pagination', compact('results'))->render();
        }

        $results = $query->get();
        // echo "<pre>"; print_r($results->toArray()); exit;
        return view('admin.assignjob.index', compact('results'));
    }


    public function inactive(Request $request)
    {
        $query = AssignJob::with(['employees', 'company'])->where('status', false)->orderBy('job_id', 'DESC');

        if ($request->ajax()) {
            if (!empty($request->employee_name)) {
                $query->whereHas('employees', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->employee_name . '%');
                });
            }

            $results = $query->get();

            return view('admin.recruitment.career.pagination', compact('results'))->render();
        }

        $results = $query->get();
        return view('admin.assignjob.index', compact('results'));
    }


    public function create()
    {
        $jobs = Job::where('status', true)->orderBy('created_at', 'desc')->get();
        $employeesList    = $this->commonRepository->employeesList();
        $companyList    = $this->commonRepository->companyList();

        $data            = [
            'employeeList'    => $employeesList,
            'companyList'    => $companyList,
            'jobs'           => $jobs
        ];
        return view('admin.assignjob.form', $data);
    }

    public function store(AssignJobRequest $request)
    {
        $input = array();
        $input = [

            'emp_id'         => $request->emp_id,
            'company_id'     => $request->company_id,
            'shift'          => $request->shift,
            'shift_timing'   => $request->shift_timing,
            'salary'         => $request->salary,
            'perday_wages'   => $request->perday_wages,
            'from_date'      => $this->formatDate($request->from_date),
            'to_date'        => $this->formatDate($request->to_date),
            'time_from'      => $request->time_from,
            'time_to'        => $request->time_to,
            'deduction'      => (!is_array($request->deduction)) ? '' : implode(',', $request->deduction),
            'status'         => $request->status,

        ];


        // $input = $this->assignjobRepository->makeAssignjobDataFormat($request->all());
        try {
            AssignJob::create($input);
            return ajaxResponse(200, 'Assign Job Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $jobs = Job::where('status', true)->orderBy('created_at', 'desc')->get();
        $employeesList    = Employees::get();
        $companyList    = Company::get();
        $editModeData = AssignJob::findOrFail($id);
        // echo "<pre>"; print_r($companyList); exit;
        $data            = [
            'employeeList'    => $employeesList,
            'companyList'    => $companyList,
            'editModeData'   => $editModeData,
            'jobs'           => $jobs
        ];

        return view('admin.assignjob.edit-assignjob', $data);
    }

    public function update(AssignJobRequest $request, $id)
    {
        $data  = AssignJob::findOrFail($id);
        $input = array();
        $input = [

            'emp_id'         => $request->emp_id,
            'company_id'     => $request->company_id,
            'shift'          => $request->shift,
            'shift_timing'   => $request->shift_timing,
            'salary'         => $request->salary,
            'perday_wages'   => $request->perday_wages,
            'from_date'      => $this->formatDate($request->from_date),
            'to_date'        => $this->formatDate($request->to_date),
            'time_from'      => $request->time_from,
            'time_to'        => $request->time_to,
            'deduction'      => (!is_array($request->deduction)) ? '' : implode(',', $request->deduction),
            'status'         => $request->status,

        ];

        try {
            $data->update($input);
            return ajaxResponse(200, 'JobAssign Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function destroy($id)
    {

        $count = AssignJob::where('job_id', '=', $id)->count();



        try {
            $job = AssignJob::findOrFail($id);
            $job->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            echo "success";
        } elseif ($bug == 1451) {
            echo 'hasForeignKey';
        } else {
            echo 'error';
        }
    }

    public function changestatus(Request $req)
    {
        try {
            if (Auth::guard('web')->check()) {

                if ($req->status == 'Terminated') {
                    $data = array(
                        'status' => 0,
                        'updated_at' => Carbon::now(),
                    );
                    DB::table('assignjob')->where('job_id', '=', $req->id)->update($data);
                } else if ($req->status == 'Active') {

                    $data = array(
                        'status' => 1,
                        'updated_at' => Carbon::now(),
                    );
                    DB::table('assignjob')->where('job_id', '=', $req->id)->update($data);
                }

                return redirect('assignJob');
            } else {
                return redirect(LOGINPATH);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function getEmployeeDetails($id)
    {
        $employee = \App\Model\Employees::with('job')
            ->select('emp_id', 'gender', 'post_applied')
            ->find($id);

        if (!$employee) {
            return response()->json(['success' => false, 'message' => 'Employee not found']);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'gender' => $employee->gender,
                'job_role' => $employee->post_applied ? $employee->job->post : null
            ]
        ]);
    }

    private function formatDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            // Handle both dd/mm/yyyy and yyyy-mm-dd
            if (strpos($date, '/') !== false) {
                return \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            } elseif (strpos($date, '-') !== false) {
                return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
            }
        } catch (\Exception $e) {
            \Log::error("Date parse failed: " . $date . " | " . $e->getMessage());
        }

        // fallback to null if invalid
        return null;
    }

}
