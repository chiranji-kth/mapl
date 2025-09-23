<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Model\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $results = Customer::orderBy('customer_id', 'DESC')->get();
        return view('admin.customer.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.customer.form');
    }

    public function store(CustomerRequest $request)
    {

        $input                 = $request->all();
        
        $input['created_by']   = Auth::user()->user_id;
        $input['updated_by']   = Auth::user()->user_id;
        $input['status']       = 1;

        try {
            Customer::create($input);
            return ajaxResponse(200, 'Customer Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'internal server error');
        }

    }

    public function show($id)
    {
        $editModeData = Customer::with('createdBy')->where('customer_id', $id)->first();
        return view('admin.customer.details', compact('editModeData'));
    }

    public function edit($id)
    {
        $editModeData = Customer::FindOrFail($id);
        return view('admin.customer.editform', compact('editModeData'));
    }

    public function update(CustomerRequest $request, $id)
    {

        $data                  = Customer::FindOrFail($id);
        $input                 = $request->all();
        $input['updated_by']   = Auth::user()->user_id;

        try {
            $data->update($input);
            return ajaxResponse(200, 'Customer Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'internal server error');
        }
    }

    public function destroy($id)
    {
        try {
            $data = Customer::FindOrFail($id);
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
        $result = Customer::where('customer_id', $request->customer_id)->update(['status' => $request->status]);
        if (!!$result) {
            return "success";
        }
    }
    
    
}
