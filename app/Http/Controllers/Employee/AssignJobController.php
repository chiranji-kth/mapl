<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignJobRequest;
use App\Model\Company;
use App\Model\Employees;
use App\Model\AssignJob;
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

    public function index()
    {
        $results = AssignJob::with(['employees', 'company'])->get();
        
        // echo "<pre>"; print_r($results[0]->employees->name); exit;  
        
        if (request()->ajax()) {
            
            if ($request->employee_name != '') {
                $results = AssignJob::where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->employee_name . '%');
                });
            }

            $results = $results->get();
            return View('admin.recruitment.career.pagination', ['results' => $results])->render();
        }
        return view('admin.assignjob.index', ['results' => $results]);
    }

    public function create()
    {
        $employeesList    = $this->commonRepository->employeesList();
        $companyList    = $this->commonRepository->companyList();
        
         $data            = [
            'employeeList'    => $employeesList,
            'companyList'    => $companyList,
        ];
        return view('admin.assignjob.form', $data);
    }

    public function store(AssignJobRequest $request)
    {
        $input = array();
        $input = [
                
                'emp_id'         => $request->emp_id,
                'company_id'     => $request->company_id,
                'perday_wages'   => $request->perday_wages,
                'from_date'      => dateConvertFormtoDB($request->from_date),
                'to_date'        => dateConvertFormtoDB($request->to_date),
                'deduction'      => (!is_array($request->deduction)) ? '' : implode(',', $request->deduction),
                'status'         => 1
            
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
        $employeesList    = Employees::get();
        $companyList    = Company::get();
        $editModeData = AssignJob::findOrFail($id);
        // echo "<pre>"; print_r($companyList); exit;
         $data            = [
            'employeeList'    => $employeesList,
            'companyList'    => $companyList,
            'editModeData'   => $editModeData,
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
                'perday_wages'   => $request->perday_wages,
                'from_date'      => dateConvertFormtoDB($request->from_date),
                'to_date'        => dateConvertFormtoDB($request->to_date),
                'deduction'      => (!is_array($request->deduction)) ? '' : implode(',', $request->deduction),
                'status'         => 1
            
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
                
                if($req->status == 'Terminated'){
                    $data = array(
                        'status' => 0,
                        'updated_at' => Carbon::now(),
                    );
                    DB::table('assignjob')->where('job_id', '=', $req->id)->update($data);
                }
                else if($req->status == 'Active'){
                    
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

}
