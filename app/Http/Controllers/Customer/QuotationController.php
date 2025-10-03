<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuotationRequest;
use App\Model\Quotation;
use App\Model\Branch;
use App\Model\Job;
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
        $branches = Branch::orderBy('branch_name')->get();
        $jobs = Job::where('status', true)->get();
        return view('admin.quotation.form', compact('branches', 'jobs'));
    }

    public function store(QuotationRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->except('items');

            // Generate quotation number
            $latestQuotation = Quotation::where('branch_id', $request->branch_id)
                ->orderBy('quotation_no', 'desc')
                ->first();

            $quotation_no = $latestQuotation && is_numeric($latestQuotation->quotation_no)
                ? str_pad($latestQuotation->quotation_no + 1, 4, '0', STR_PAD_LEFT)
                : '0101';

            $input['quotation_no'] = $quotation_no;
            $input['note'] = $request->has('note') ? implode(', ', $request->note) : null;

            $grandTotal = 0;

            // Create quotation first
            $quotation = Quotation::create($input);

            foreach ($request->items as $item) {
                $qty = $item['qty'];
                $rate = $item['rate'];

                $rowTotal = $qty * $rate;
                $pf = 0;
                $esi = 0;
                $cgst = 0;
                $sgst = 0;
                $igst = 0;
                // Apply deductions / taxes if passed from frontend
                if (isset($item['pf']) && $item['pf']) $pf += $qty * $rate * 0.13;       // PF 13%
                if (isset($item['esi']) && $item['esi']) $esi += $qty * $rate * 0.0325;    // ESI 3.25%
                if (isset($item['cgst']) && $item['cgst']) $cgst += $qty * $rate * 0.09;    // CGST 9%
                if (isset($item['sgst']) && $item['sgst']) $sgst += $qty * $rate * 0.09;    // SGST 9%
                if (isset($item['igst']) && $item['igst']) $igst += $qty * $rate * 0.18;    // IGST 18%

                $quotation->details()->create([
                    'quotation_id'  => $quotation->id,
                    'particluar'    => $item['particluar'],
                    'gender'        => $item['gender'],
                    'working_hour'  => $item['working_hour'],
                    'qty'           => $qty,
                    'rate'          => $rate,
                    'pf'            => $pf,
                    'esi'           => $esi,
                    'cgst'          => $cgst,
                    'sgst'          => $sgst,
                    'igst'          => $igst,
                    'total'         => $rowTotal,
                ]);

                $grandTotal += $rowTotal;
            }

            // Update quotation total
            $quotation->update(['total_amount' => $grandTotal]);

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
        $branches = Branch::orderBy('branch_name')->get();
        $jobs = Job::where('status', true)->get();
        $details = $quotation->details;

        return view('admin.quotation.editform', compact('quotation', 'details', 'branches', 'jobs'));
    }

    public function update(QuotationRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $quotation = Quotation::findOrFail($id);
            $input = $request->except('items');
            $input['updated_by'] = Auth::user()->user_id;
            $input['note'] = $request->has('note') ? implode(', ', $request->note) : null;
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
