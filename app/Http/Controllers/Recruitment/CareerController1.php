<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Model\CareerApplicant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CareerController extends Controller
{

    public function index(Request $request)
    {
        $results = CareerApplicant::orderBy('career_applicant_id', 'DESC')->paginate(10);

        if (request()->ajax()) {
            
            if ($request->employee_name != '') {
                $results = CareerApplicant::where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->employee_name . '%');
                });
            }

            $results = $results->paginate(10);
            return View('admin.recruitment.career.pagination', ['results' => $results])->render();
        }

        return view('admin.recruitment.career.index', ['results' => $results]);
        
        // $results = CareerApplicant::orderBy('career_applicant_id', 'DESC')->paginate(10);
        // return view('admin.recruitment.career.index', ['results' => $results]);
    }

    public function show($id)
    {
        $results = CareerApplicant::where('career_applicant_id', $id)->first();
        return view('admin.recruitment.career.details', ['result' => $results]);
    }
    
    
    public function store(JobPostRequest $request)
    {
        
        
    }

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
