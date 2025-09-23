<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuotationRequest;
use App\Model\Quotation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Exports\QuotationExport;
use Maatwebsite\Excel\Facades\Excel;

use PDF;

class QuotationController extends Controller
{

    public function index()
    {
        $results = Quotation::orderBy('id', 'DESC')->get();
        return view('admin.quotation.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.quotation.form');
    }

    public function store(QuotationRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->except('items');
            
            $latestQuotation = Quotation::where('branch_id', $request->branch_id)
                ->orderBy('quotation_no', 'desc')
                ->first();
                
            $quotation_no = $latestQuotation && is_numeric($latestQuotation->quotation_no)
                ? str_pad($latestQuotation->quotation_no + 1, 4, '0', STR_PAD_LEFT)
                : '0101';
                    
            
            $input['quotation_no'] = $quotation_no;
            
            $totalAmount = 0;

            // Create quotation first
            $quotation = Quotation::create($input);

            foreach ($request->items as $item) {
                $itemTotal = $item['qty'] * $item['rate'];

                $quotation->details()->create([
                    'quotation_id'  => $quotation->id,
                    'particluar'    => $item['particluar'],
                    'gender'        => $item['gender'],
                    'working_hour'  => $item['working_hour'],
                    'qty'           => $item['qty'],
                    'rate'          => $item['rate'],
                    'total'         => $itemTotal,
                ]);

                $totalAmount += $itemTotal;
            }

            // Update using DB
            DB::table('quotation')
                ->where('id', $quotation->id)
                ->update(['total_amount' => $totalAmount]);

            DB::commit();

            return ajaxResponse(200, 'Quotation Successfully saved.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }




    public function show($id)
    {
        $quotation = Quotation::with('details')->findOrFail($id);
        return view('admin.quotation.view', compact('quotation'));
    }

    public function edit($id)
    {
        $quotation = Quotation::findOrFail($id);
        $details = $quotation->details;

        return view('admin.quotation.editform', compact('quotation', 'details'));
    }

    public function update(QuotationRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $quotation = Quotation::findOrFail($id);
            $input = $request->except('items');
            $input['updated_by'] = Auth::user()->user_id;

            $quotation->update($input);

            $quotation->details()->delete();

            $totalAmount = 0;

            foreach ($request->items as $item) {
                $itemTotal = $item['qty'] * $item['rate'];

                $quotation->details()->create([
                    'particluar'    => $item['particluar'],
                    'gender'        => $item['gender'],
                    'working_hour'  => $item['working_hour'],
                    'qty'           => $item['qty'],
                    'rate'          => $item['rate'],
                    'total'         => $itemTotal,
                ]);

                $totalAmount += $itemTotal;
            }

            $quotation->update(['total_amount' => $totalAmount]);

            DB::commit();
            return ajaxResponse(200, 'Quotation successfully updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotation update error: ' . $e->getMessage());
            return ajaxResponse(500, 'Internal server error');
        }
    }


    public function destroy($id)
    {
        try {
            $quotation = Quotation::findOrFail($id);

            // First delete child details
            $quotation->details()->delete();

            // Then delete parent quotation
            $quotation->delete();

            return ajaxResponse(200, 'Quotation deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) { // SQLSTATE 23000 = integrity constraint violation
                return ajaxResponse(409, 'This quotation is linked to another record.');
            }

            return ajaxResponse(500, 'Database error occurred.');
        } catch (\Exception $e) {
            return ajaxResponse(500, $e->getMessage());
        }
    }

    public function export($id)
    {
        $quotation = Quotation::with('details')->findOrFail($id);

        if ($quotation->branch_id == 1) {
            $pdf = PDF::loadView('exports.quotation-pdf-mapl', compact('quotation'))
                ->setPaper('A4', 'portrait');
        } else {
            $pdf = PDF::loadView('exports.quotation-pdf-astha', compact('quotation'))
                ->setPaper('A4', 'portrait');
        }
        return $pdf->download('quotation_' . $quotation->id . '.pdf');
    }
}
