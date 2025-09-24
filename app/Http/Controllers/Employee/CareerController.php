<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Model\CareerApplicant;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CareerRequest;
use Illuminate\Http\Request;
use App\Model\Job;
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
        $results = CareerApplicant::with('job')
            ->orderBy('career_applicant_id', 'DESC');

        if (request()->ajax()) {

            if (!empty($request->employee_name)) {
                $results->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->employee_name . '%');
                });
            }

            $results = $results->get();

            return view('admin.recruitment.career.pagination', compact('results'))->render();
        }

        $results = $results->get();

        return view('admin.recruitment.career.index', compact('results'));


        // $results = CareerApplicant::orderBy('career_applicant_id', 'DESC')->paginate(10);
        // return view('admin.recruitment.career.index', ['results' => $results]);
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
