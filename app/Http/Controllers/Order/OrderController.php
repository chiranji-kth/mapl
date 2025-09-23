<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Model\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $results = Order::orderBy('order_id', 'DESC')->get();
        return view('admin.order.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.order.form');
    }

    // public function store(OrderRequest $request)
    // {

    //     $input                 = $request->all();
        
    //     $input['created_by']   = Auth::user()->user_id;
    //     $input['updated_by']   = Auth::user()->user_id;
    //     $input['from_date'] = dateConvertFormtoDB($request->from_date);

    //     try {
    //         Order::create($input);
    //         return ajaxResponse(200, 'Order Successfully saved.');
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return ajaxResponse(500, 'internal server error');
    //     }

    // }

    // public function show($id)
    // {
    //     $editModeData = Order::with('createdBy')->where('lead_id', $id)->first();
    //     return view('admin.order.details', compact('editModeData'));
    // }

    // public function edit($id)
    // {
    //     $editModeData = order::FindOrFail($id);
    //     return view('admin.order.editform', compact('editModeData'));
    // }

    // public function update(OrderRequest $request, $id)
    // {

    //     $data                  = Order::FindOrFail($id);
    //     $input                 = $request->all();
    //     $input['updated_by']   = Auth::user()->user_id;
    //     $input['from_date'] = dateConvertFormtoDB($request->from_date);

    //     try {
    //         $data->update($input);
    //         return ajaxResponse(200, 'Order Successfully Updated.');
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return ajaxResponse(500, 'internal server error');
    //     }
    // }

    // public function destroy($id)
    // {
    //     try {
    //         $data = Order::FindOrFail($id);
    //         $data->delete();
    //         $bug = 0;
    //     } catch (\Exception $e) {
    //         $bug = $e->errorInfo[1];
    //     }

    //     if ($bug == 0) {
    //         echo "success";
    //     } elseif ($bug == 1451) {
    //         echo 'hasForeignKey';
    //     } else {
    //         echo 'error';
    //     }
    // }
    // public function updateStatus(Request $request)
    // {
    //     $result = Order::where('order_id', $request->order_id)->update(['status' => $request->status]);
    //     if (!!$result) {
    //         return "success";
    //     }
    // }
    
    
}
