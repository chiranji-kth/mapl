<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Model\Job;
use Illuminate\Support\Facades\Log;

class BranchController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = Job::get();
        return view('admin.employee.job.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.employee.job.form');
    }

    public function store(JobRequest $request)
    {
        $input = $request->all();
        try {
            Job::create($input);
            return ajaxResponse(200, 'Job Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $editModeData = Job::findOrFail($id);
        return view('admin.employee.job.form', ['editModeData' => $editModeData]);
    }

    public function update(JobRequest $request, $id)
    {
        $job = Job::findOrFail($id);
        $input  = $request->all();
        try {
            $job->update($input);
            return ajaxResponse(200, 'Job Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function destroy($id)
    {

        $count = Job::where('job_id', '=', $id)->count();

        if ($count > 0) {

            return 'hasForeignKey';
        }

        try {
            $job = Job::findOrFail($id);
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
}
