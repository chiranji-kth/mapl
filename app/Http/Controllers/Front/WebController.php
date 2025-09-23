<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Http\Requests\CareerApplicationRequest;
use App\Lib\Enumerations\JobStatus;
use App\Model\Job;
use App\Model\JobApplicant;
use App\Model\CareerApplicant;
use App\Model\Services;
use Dotenv\Validator;
use Exception;

use App\Model\State;
use App\Model\District;

class WebController extends Controller
{
    //

    public function index(Request $request)
    {
        $published = 1;
        $active = 1;
        $job = Job::where('status', '=', $published)
            ->where('application_end_date', '>=', date('Y-m-d'))
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        if (request()->ajax()) {

            $job = Job::where('status', '=', $published)
                ->where('application_end_date', '>=', date('Y-m-d'))
                ->paginate(5);

            return   \View('front.job_pagination', ['jobs' => $job])->render();
        }

        $services = Services::where('status', '=', $active)->get();
        return view('front.index', ['jobs' => $job, 'services' => $services]);
    }


    public function about()
    {

        return view('front.about');
    }
    public function gallery()
    {

        return view('front.gallery');
    }
    public function services()
    {

        return view('front.service');
    }
    public function employees()
    {

        return view('front.employees');
    }
    public function career()
    {
        $jobs = Job::where('status', true)->orderBy('created_at', 'desc')->get();
        return view('front.career', compact('jobs'));
    }
    public function getStates()
    {
        return response()->json(
            State::select('state_id', 'state_name as name')->orderBy('state_name')->get()
        );
    }

    public function getDistricts($stateId)
    {
        return response()->json(
            District::where('state_id', $stateId)
                ->select('dist_id', 'dist_name as name')
                ->orderBy('dist_name')
                ->get()
        );
    }
    public function careerApply(CareerApplicationRequest $request)
    {
        $data = array();
        try {
            $career = new CareerApplicant;

            $career->name = strtoupper($request->name);
            $career->email = strtoupper($request->email);
            $career->phone = strtoupper($request->phone);
            $career->alter_phone = strtoupper($request->alter_phone);
            $career->father_name = strtoupper($request->father_name);
            $career->dob = strtoupper($request->dob);
            $career->aadhar = strtoupper($request->aadhar);
            $career->gender = strtoupper($request->gender);
            $career->marital_status = strtoupper($request->marital_status);

            $career->p_state = strtoupper($request->p_state);
            $career->p_district = strtoupper($request->p_district);
            $career->p_city = strtoupper($request->p_city);
            $career->p_address = strtoupper($request->p_address);
            $career->c_district = strtoupper($request->c_district);
            $career->c_city = strtoupper($request->c_city);
            $career->c_address = strtoupper($request->c_address);

            $career->highest_qualification = strtoupper($request->highest_qualification);
            $career->weight = strtoupper($request->weight);
            $career->height = strtoupper($request->height);
            $career->experience = strtoupper($request->experience);
            $career->employment_status = strtoupper($request->employment_status);
            $career->post_applied = strtoupper($request->post_applied);
            $career->salary_expectations = strtoupper($request->salary_expectations);
            $career->other_post_applied = strtoupper($request->other_post_applied);
            $career->time_preference = strtoupper($request->time_preference);
            $career->remarks = strtoupper($request->remarks);
            $career->filled_by = strtoupper($request->filled_by);
            $career->referd_by = strtoupper($request->referd_by);
            // $career->picture = '';
            $career->status = 0;

            // $picture = $request->file('picture');

            // if($picture)
            // {
            //   $file_name = str_replace(' ','-',$request->name).'-'.time().'.'.$resume->getClientOriginalExtension();
            //   $resume->move('uploads/applicantResume/',$file_name);
            //   $career->attached_resume = $file_name;
            // }
            // echo "<pre>"; print_r($career); exit;

            $career->save();
            $data = [
                'status'  => true,
                'message' => '<div class="alert alert-success alert-dismissable  mb-20">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>Application Send Successful</strong>
						</div>',

            ];
        } catch (Exception $e) {
            $data = [
                'status'  => false,
                'message' => '<div class="alert alert-danger alert-dismissable  mb-20">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<strong>Somthing went to wrong !</strong>
						</div>',
                'error' => $e->getMessage(),

            ];
        }

        return json_encode($data);
    }
    public function company()
    {
        return view('front.company');
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function jobDetails($id, $slug)
    {
        $job = Job::find($id);

        return view('front.job_details', ['job' => $job]);
    }

    public function jobApply(JobApplicationRequest $request)
    {

        try {
            $applicant = new JobApplicant;
            $applicant->job_id = $request->job_id;
            $applicant->applicant_name = $request->name;
            $applicant->applicant_email = $request->email;
            $applicant->phone = $request->phone;
            $applicant->cover_letter = $request->cover_letter;
            $applicant->application_date = date('Y-m-d');
            $applicant->status = JobStatus::$Apply;

            $resume = $request->file('resume');

            if ($resume) {
                $file_name = str_replace(' ', '-', $request->name) . '-' . time() . '.' . $resume->getClientOriginalExtension();
                $resume->move('uploads/applicantResume/', $file_name);
                $applicant->attached_resume = $file_name;
            }

            $applicant->save();


            return redirect()->back()->with('success', 'Application Successful');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
