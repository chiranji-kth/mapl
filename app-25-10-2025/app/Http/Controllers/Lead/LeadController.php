<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Model\Lead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LeadController extends Controller
{

    public function index()
    {
        $results = Lead::orderBy('lead_id', 'DESC')->get();
        return view('admin.lead.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.lead.form');
    }

    public function store(LeadRequest $request)
    {

        $input                 = $request->all();
        
        $input['created_by']   = Auth::user()->user_id;
        $input['updated_by']   = Auth::user()->user_id;
        $input['from_date'] = dateConvertFormtoDB($request->from_date);

        try {
            Lead::create($input);
            return ajaxResponse(200, 'Lead Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'internal server error');
        }

    }

    public function show($id)
    {
        $editModeData = Lead::with('createdBy')->where('lead_id', $id)->first();
        return view('admin.lead.details', compact('editModeData'));
    }

    public function edit($id)
    {
        $editModeData = Lead::FindOrFail($id);
        return view('admin.lead.editform', compact('editModeData'));
    }

    public function update(LeadRequest $request, $id)
    {

        $data                  = Lead::FindOrFail($id);
        $input                 = $request->all();
        $input['updated_by']   = Auth::user()->user_id;
        $input['from_date'] = dateConvertFormtoDB($request->from_date);

        try {
            $data->update($input);
            return ajaxResponse(200, 'Lead Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'internal server error');
        }
    }

    public function destroy($id)
    {
        try {
            $data = Lead::FindOrFail($id);
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
    public function updateStatus(Request $request)
    {
        $result = Lead::where('lead_id', $request->lead_id)->update(['status' => $request->status]);
        if (!!$result) {
            return "success";
        }
    }
    
    public function followup($id)
    {
        $editModeData = Lead::FindOrFail($id);
        return view('admin.lead.followup', compact('editModeData'));
    }
    // public function storefollowup(LeadRequest $request)
    // {

    //     $input                 = $request->all();
        
    //     $input['created_by']   = Auth::user()->user_id;
    //     $input['updated_by']   = Auth::user()->user_id;
    //     $input['from_date'] = dateConvertFormtoDB($request->from_date);

    //     try {
    //         Lead::create($input);
    //         return ajaxResponse(200, 'Lead Successfully saved.');
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return ajaxResponse(500, 'internal server error');
    //     }

    // }
}
