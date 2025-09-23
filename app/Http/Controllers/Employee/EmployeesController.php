<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesRequest;
use App\Model\CareerApplicant;
use App\Model\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\EmployeesRepository;

class EmployeesController extends Controller
{

    protected $employeesRepositories;

    public function __construct(EmployeesRepository $employeesRepositories)
    {
        $this->employeesRepositories = $employeesRepositories;
    }

    public function index(Request $request)
    {

        $results = Employees::orderBy('emp_id', 'DESC')->get();

        if (request()->ajax()) {
            
            if ($request->employee_name != '') {
                $results = Employees::where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->employee_name . '%');
                });
            }

            $results = $results->get();
            return View('admin.employee.employees.pagination', ['results' => $results])->render();
        }

        return view('admin.employee.employees.index', ['results' => $results]);
    }

    // // printing employee list

    // public function printEmployee(Request $request)
    // {
    //     if ($request->role_id != '') {
    //         $results = Employee::whereHas('userName', function ($q) use ($request) {
    //             $q->with('role')->where('role_id', $request->role_id);
    //         })->with('department', 'designation', 'branch', 'payGrade', 'supervisor', 'hourlySalaries')->orderBy('employee_id', 'DESC');
    //     } else {
    //         $results = Employee::with(['userName' => function ($q) {
    //             $q->with('role');
    //         }, 'department', 'designation', 'branch', 'payGrade', 'supervisor', 'hourlySalaries'])->orderBy('employee_id', 'DESC');
    //     }

    //     if ($request->department_id != '') {
    //         $results->where('department_id', $request->department_id);
    //     }

    //     if ($request->designation_id != '') {
    //         $results->where('designation_id', $request->designation_id);
    //     }

    //     if ($request->employee_name != '') {
    //         $results->where(function ($query) use ($request) {
    //             $query->where('first_name', 'like', '%' . $request->employee_name . '%')
    //                 ->orWhere('last_name', 'like', '%' . $request->employee_name . '%');
    //         });
    //     }

    //     $results = $results->get();

    //     $printHead = PrintHeadSetting::first();

    //     return view('admin.employee.employee.print_employee', ['results' => $results, 'printHead' => $printHead]);
    // }

    public function makeemployee($id)
    {
        $empModeData = CareerApplicant::findOrFail($id);
        return view('admin.employee.employees.add-employee', ['empModeData' => $empModeData]);
    }

    public function store(EmployeesRequest $request)
    {
        $photo = $request->file('photo');
        if ($photo) {
            $imgName = md5(str_random(30) . time() . '_' . $request->file('photo')) . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('uploads/employeePhoto/', $imgName);
            $employeePhoto['photo'] = $imgName;
        }
        $kyc_file = $request->file('kyc_file');
        if ($kyc_file) {
            $kycName = md5(str_random(30) . time() . '_' . $request->file('kyc_file')) . '.' . $request->file('kyc_file')->getClientOriginalExtension();
            $request->file('kyc_file')->move('uploads/employeeKycDoc/', $kycName);
            $employeeKycDoc['kyc_file'] = $kycName;
        }
        $employeeDataFormat = $this->employeesRepositories->makeEmployeePersonalInformationDataFormat($request->all());
        
        if (isset($employeePhoto)) {
            $employeeData = $employeeDataFormat + $employeePhoto;
        } else {
            $employeeData = $employeeDataFormat;
        }
        if (isset($employeeKycDoc)) {
            $employeeData = $employeeData + $employeeKycDoc;
        } else {
            $employeeData = $employeeData;
        }
// echo "<pre>"; print_r($employeeData); exit;
        try {
            $childData = Employees::create($employeeData);
            
            if(!empty($childData)){
                
                   $data = CareerApplicant::FindOrFail($request->applicant_id); 
                   $result = $data->delete();
            }
            return ajaxResponse(200, 'Employee information successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function edit($id)
    {
        $editModeData       = Employees::findOrFail($id);

        $data = [
            'empModeData'  => $editModeData,
        ];

        return view('admin.employee.employees.editEmployee', $data);

    }

    public function update(EmployeesRequest $request, $id)
    {
        $employee = Employees::findOrFail($id);
        $photo    = $request->file('photo');
        if ($photo) {
            $imgName = md5(str_random(30) . time() . '_' . $request->file('photo')) . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('uploads/employeePhoto/', $imgName);
            if (file_exists('uploads/employeePhoto/' . $employee->photo) and !empty($employee->photo)) {
                unlink('uploads/employeePhoto/' . $employee->photo);
            }
            $employeePhoto['photo'] = $imgName;
        }
        $kyc_file = $request->file('kyc_file');
        if ($kyc_file) {
            $kycName = md5(str_random(30) . time() . '_' . $request->file('kyc_file')) . '.' . $request->file('kyc_file')->getClientOriginalExtension();
            $request->file('kyc_file')->move('uploads/employeeKycDoc/', $kycName);
             if (file_exists('uploads/employeeKycDoc/' . $employee->kyc_file) and !empty($employee->kyc_file)) {
                unlink('uploads/employeeKycDoc/' . $employee->kyc_file);
            }
            $employeeKycDoc['kyc_file'] = $kycName;
        }
        $employeeDataFormat = $this->employeesRepositories->makeEmployeePersonalInformationDataFormat($request->all());
        if (isset($employeePhoto)) {
            $employeeData = $employeeDataFormat + $employeePhoto;
        } else {
            $employeeData = $employeeDataFormat;
        }
        if (isset($employeeKycDoc)) {
            $employeeData = $employeeData + $employeeKycDoc;
        } else {
            $employeeData = $employeeData;
        }

        try {
            DB::beginTransaction();

            // Update Personal Information
            $employee->update($employeeData);

            DB::commit();
            return ajaxResponse(200, 'Employee information successfully updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function show($id)
    {

        $employeeInfo = Employees::where('emp_id', $id)->first();

        return view('admin.employee.employees.details', ['result' => $employeeInfo]);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Employees::FindOrFail($id);
            if (!is_null($data->photo)) {
                if (file_exists('uploads/employeePhoto/' . $data->photo) and !empty($data->photo)) {
                    unlink('uploads/employeePhoto/' . $data->photo);
                }
            }
            $result = $data->delete();
            DB::commit();
            $bug = 0;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            // return $e;
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


}
