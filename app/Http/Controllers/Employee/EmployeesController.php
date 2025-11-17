<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesRequest;
use App\Model\CareerApplicant;
use App\Model\Employees;
use App\Model\Job;
use App\Model\State;
use App\Model\District;
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

        $jobs = Job::all();
        $states = State::all();
        $districts = District::all();

        $query = Employees::with(['job', 'states', 'districts'])
            ->orderBy('emp_id', 'DESC');
        $results = $query->get();

        // echo "<pre>";
        // print_r($results->toArray());
        // exit;


        if ($request->ajax()) {
            $query = Employees::with(['job', 'states', 'districts'])
                ->orderBy('emp_id', 'DESC');

            // if ($request->filled('employee_name')) {
            //     $query->where('name', 'like', '%' . $request->employee_name . '%');
            // }

            if ($request->has('job_id')) {
                $query->where('post_applied', $request->job_id);
            }

            if ($request->has('state_id')) {
                $query->where('p_state', $request->state_id);
            }

            if ($request->has('district_id')) {
                $query->where('p_district', $request->district_id);
            }

            if ($request->has('created_from')) {
                $query->whereDate('created_at', '>=', $request->created_from);
            }

            if ($request->has('created_to')) {
                $query->whereDate('created_at', '<=', $request->created_to);
            }

            if ($request->has('updated_from')) {
                $query->whereDate('updated_at', '>=', $request->updated_from);
            }

            if ($request->has('updated_to')) {
                $query->whereDate('updated_at', '<=', $request->updated_to);
            }

            $results = $query->get();

            $data = $results->map(function ($employee) {
                return [
                    'employee_id' => $employee->employee_id ?? 'N/A',
                    'job_post' => ($employee->job['post'] ?? 'N/A') .
                        '<br /><span class="text-muted">Exp: ' .
                        ($employee->experience ? \Illuminate\Support\Str::limit($employee->experience, 10, '...') : 'None') .
                        '</span>',
                    'name' => $employee->name . '<br /><span class="text-muted">Email: ' . $employee->email . '</span>',
                    'phone' => $employee->phone . '<br /><span class="text-muted">Gender: ' . $employee->gender . '</span>',
                    'father_name' => $employee->father_name ?? 'N/A',
                    'joining_date' => (!empty($employee->date_of_joining) && strtotime($employee->date_of_joining))
                        ? \Carbon\Carbon::parse($employee->date_of_joining)->format('d-m-Y')
                        : 'N/A',
                    'state_name' => $employee->states['state_name'] ?? '',
                    'district_name' => $employee->districts['dist_name'] ?? '',
                    'created_at' => $employee->created_at
                        ? $employee->created_at->format('d-m-Y')
                        : '',
                    'photo' => ($employee->photo && file_exists(base_path('uploads/employeePhoto/' . $employee->photo)))
                        ? '<a href="' . route('employees.show', $employee->emp_id) . '">
                            <img src="' . asset('uploads/employeePhoto/' . $employee->photo) . '" 
                                class="img-circle" style="width:70px">
                        </a>'
                        : '<a href="' . route('employees.show', $employee->emp_id) . '">
                            <img src="' . asset('admin_assets/img/default.png') . '" 
                                class="img-circle" style="width:70px">
                        </a>',
                    'actions' => '<a title="View" href="' . route('employees.show', $employee->emp_id) . '"
                                class="btn btn-primary btn-xs btnColor">
                                <i class="glyphicon glyphicon-th-large" aria-hidden="true"></i>
                              </a>
                              <a href="' . route('employees.delete', $employee->emp_id) . '"
                                data-token="' . csrf_token() . '"
                                data-id="' . $employee->career_applicant_id . '"
                                class="delete btn btn-danger btn-xs deleteBtn btnColor">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a>
                              <a href="' . route('employees.edit', $employee->emp_id) . '"
                                class="btn btn-success btn-xs btnColor">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a>',
                ];
            });

            return response()->json(['data' => $data->toArray()]);
        }

        return view('admin.employee.employees.index', compact('jobs', 'states', 'districts'));
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
        $jobs = Job::where('status', true)->orderBy('created_at', 'desc')->get();
        $empModeData = CareerApplicant::findOrFail($id);
        return view('admin.employee.employees.add-employee', ['empModeData' => $empModeData, 'jobs' => $jobs]);
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

        $lastEmployee = Employees::orderBy('emp_id', 'desc')->first();
        $newNumber = $lastEmployee ? ((int) str_replace('MAPL/', '', $lastEmployee->employee_id) + 1) : 1;
        $employeeData['employee_id'] = 'MAPL/' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        // echo "<pre>"; print_r($employeeData); exit;
        try {
            $childData = Employees::create($employeeData);

            if (!empty($childData)) {

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
        $jobs = Job::where('status', true)->orderBy('created_at', 'desc')->get();
        $data = [
            'empModeData'  => $editModeData,
            'jobs'         => $jobs
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
