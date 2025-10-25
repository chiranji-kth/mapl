<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Model\CareerApplicant;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CareerRequest;
use Illuminate\Http\Request;
use App\Model\Job;
use App\Model\State;
use App\Model\District;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CareerRepository;

class CareerController extends Controller
{
    protected $careerRepositories;

    public function __construct(CareerRepository $careerRepositories)
    {
        $this->careerRepositories = $careerRepositories;
    }

    public function index(Request $request)
    {
        $jobs = Job::all();
        $states = State::all();
        $districts = District::all();

        if ($request->ajax()) {
            $query = CareerApplicant::with(['job', 'states', 'districts'])
                ->orderBy('career_applicant_id', 'DESC');

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

            $data = $results->map(function ($applicant) {
                return [
                    'job_post' => ($applicant->job['post'] ?? 'N/A') .
                        '<br /><span class="text-muted">Exp: ' .
                        ($applicant->experience ? \Illuminate\Support\Str::limit($applicant->experience, 10, '...') : 'None') .
                        '</span>',
                    'name' => $applicant->name . '<br /><span class="text-muted">Email: ' . $applicant->email . '</span>',
                    'phone' => $applicant->phone . '<br /><span class="text-muted">Gender: ' . $applicant->gender . '</span>',
                    'father_name' => $applicant->father_name ?? 'N/A',
                    'dob' => (!empty($applicant->dob) && strtotime($applicant->dob))
                        ? \Carbon\Carbon::parse($applicant->dob)->format('d/m/y') . '<br /><span class="text-muted">Aadhar: ' . ($applicant->aadhar ?? 'N/A') . ' </span>'
                        : 'N/A <br /><span class="text-muted">Aadhar: ' . ($applicant->aadhar ?? 'N/A') . ' </span>',
                    'employment_status' => $applicant->employment_status ?? 'N/A',
                    'state_name' => $applicant->states['state_name'] ?? '',
                    'district_name' => $applicant->districts['dist_name'] ?? '',
                    'created_at' => $applicant->created_at
                        ? $applicant->created_at->format('Y-m-d')
                        : '',
                    'actions' => '<a href="' . route('employees.makeemployee', $applicant->career_applicant_id) . '"
                                class="btn btn-success btn-xs btnColor">
                                Make a Employee
                              </a>
                              <a title="View" href="' . route('careerJob.show', $applicant->career_applicant_id) . '"
                                class="btn btn-primary btn-xs btnColor">
                                <i class="glyphicon glyphicon-th-large" aria-hidden="true"></i>
                              </a>
                              <a href="' . route('careerJob.delete', $applicant->career_applicant_id) . '"
                                data-token="' . csrf_token() . '"
                                data-id="' . $applicant->career_applicant_id . '"
                                class="delete btn btn-danger btn-xs deleteBtn btnColor">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a>
                              <a href="' . route('careerJob.edit', $applicant->career_applicant_id) . '"
                                class="btn btn-success btn-xs btnColor">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a>',
                ];
            });

            return response()->json(['data' => $data->toArray()]);
        }

        return view('admin.recruitment.career.index', compact('jobs', 'states', 'districts'));
    }





    public function show($id)
    {
        $results = CareerApplicant::where('career_applicant_id', $id)->first();
        return view('admin.recruitment.career.details', ['result' => $results]);
    }

    public function edit($id)
    {

        $jobs = Job::where('status', true)->orderBy('created_at', 'desc')->get();
        $empModeData = CareerApplicant::findOrFail($id);
        return view('admin.recruitment.career.editCareer', ['empModeData' => $empModeData, 'jobs' => $jobs]);
    }

    public function update(CareerRequest $request, $id)
    {
        $employee = CareerApplicant::findOrFail($id);
        // $photo    = $request->file('photo');
        // if ($photo) {
        //     $imgName = md5(str_random(30) . time() . '_' . $request->file('photo')) . '.' . $request->file('photo')->getClientOriginalExtension();
        //     $request->file('photo')->move('uploads/employeePhoto/', $imgName);
        //     if (file_exists('uploads/employeePhoto/' . $employee->photo) and !empty($employee->photo)) {
        //         unlink('uploads/employeePhoto/' . $employee->photo);
        //     }
        //     $employeePhoto['photo'] = $imgName;
        // }
        // $kyc_file = $request->file('kyc_file');
        // if ($kyc_file) {
        //     $kycName = md5(str_random(30) . time() . '_' . $request->file('kyc_file')) . '.' . $request->file('kyc_file')->getClientOriginalExtension();
        //     $request->file('kyc_file')->move('uploads/employeeKycDoc/', $kycName);
        //      if (file_exists('uploads/employeeKycDoc/' . $employee->kyc_file) and !empty($employee->kyc_file)) {
        //         unlink('uploads/employeeKycDoc/' . $employee->kyc_file);
        //     }
        //     $employeeKycDoc['kyc_file'] = $kycName;
        // }
        $employeeDataFormat = $this->careerRepositories->makeCareerDataFormat($request->all());
        // if (isset($employeePhoto)) {
        //     $employeeData = $employeeDataFormat + $employeePhoto;
        // } else {
        //     $employeeData = $employeeDataFormat;
        // }
        // if (isset($employeeKycDoc)) {
        //     $employeeData = $employeeData + $employeeKycDoc;
        // } else {
        //     $employeeData = $employeeData;
        // }

        try {
            DB::beginTransaction();

            // Update Personal Information
            $employee->update($employeeDataFormat);

            DB::commit();
            return ajaxResponse(200, 'Employee information successfully updated.');
        } catch (\Exception $e) {
            Log::error('Career update failed: ' . $e->getMessage());
            Log::error($e->getTraceAsString());;
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function store(JobPostRequest $request) {}

    public function destroy($id)
    {
        try {
            $data = CareerApplicant::FindOrFail($id);
            $data->delete();
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
}
