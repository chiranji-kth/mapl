<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Model\Invoice;
use App\Model\Branch;
use App\Model\Job;
use App\Model\AssignJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Exports\QuotationExport;
use App\Model\Company;
use Maatwebsite\Excel\Facades\Excel;

use PDF;

class InvoiceController extends Controller
{

    public function index()
    {
        $results = Invoice::orderBy('id', 'DESC')->get();
        return view('admin.invoice.index', ['results' => $results]);
    }

    public function create()
    {

        $companys = Company::orderBy('company_id', 'DESC')->get();
        $jobs = Job::where('status', true)->get();
        return view('admin.invoice.form', ['companys' => $companys, 'jobs' => $jobs]);
    }

    public function store(InvoiceRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->except('items');

            if ($request->company_id !== 'other' && !empty($request->company_id)) {
                $company = Company::find($request->company_id);
                if ($company) {
                    $input['gst_no'] = $company->gst;
                    $input['name'] = $company->company_name;
                    $input['email'] = $company->email;
                    $input['contact'] = $company->phone;
                    $input['address'] = $company->address;
                    $input['pincode'] = '';
                }
            }

            $invoiceno = Invoice::select('invoice_id')
                ->where('branch_id', $request->branch_id)
                ->orderBy('id', 'desc')
                ->first();

            $input['invoice_id'] = $invoiceno->invoice_id + 1;
            $input['note'] = $request->has('note') ? implode(', ', $request->note) : null;
            // Create invoice
            $invoice = Invoice::create($input);

            $totalAmount = 0;

            foreach ($request->items as $item) {
                $itemTotal = $item['payout'];

                $invoice->details()->create([
                    'invoice_id'  => $invoice->id,
                    'particluar'  => $item['particluar'],
                    'gender'        => $item['gender'],
                    'working_hour'  => $item['working_hour'],
                    'days'          => $item['days'],
                    'month'         => $item['month'],
                    'year'         => $item['year'],
                    'qty'           => $item['qty'],
                    'rate'          => $item['rate'],
                    'payout'          => $item['payout'],
                    'total'         => $itemTotal,
                ]);

                $totalAmount += $itemTotal;
            }

            // Update total
            $invoice->update(['total_amount' => $totalAmount]);

            DB::commit();

            return ajaxResponse(200, 'Invoice Successfully saved.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return response()->json([
                'message' => 'Failed to store invoice',
                'error' => $e->getMessage(),
            ], 500);
        }
    }





    public function show($id)
    {
        $invoice = Invoice::with('details')->findOrFail($id);
        // echo "<pre>"; print_r($invoice); exit;
        return view('admin.invoice.view', compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $companys = Company::orderBy('company_id', 'DESC')->get();
        $jobs = Job::where('status', true)->get();
        $details = $invoice->details;

        return view('admin.invoice.editform', compact('invoice', 'details', 'companys', 'jobs'));
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        try {
            $invoice = Invoice::findOrFail($id);
            $input = $request->except('items');
            $input['updated_by'] = Auth::user()->user_id;

            // Fill company details from DB
            if ($request->company_id !== 'other' && !empty($request->company_id)) {
                $company = Company::find($request->company_id);
                if ($company) {
                    $input['gst_no'] = $company->gst;
                    $input['name'] = $company->company_name;
                    $input['email'] = $company->email;
                    $input['contact'] = $company->phone;
                    $input['address'] = $company->address;
                    $input['pincode'] = '';
                }
            }

            $invoice->update($input);

            $existingDetailIds = $invoice->details()->pluck('id')->toArray();
            $submittedDetailIds = [];
            $totalAmount = 0;

            foreach ($request->items as $item) {
                $itemTotal = $item['payout'];
                $detailData = [
                    'invoice_id'    => $invoice->id,
                    'particluar'    => $item['particluar'],
                    'gender'        => $item['gender'],
                    'working_hour'  => $item['working_hour'],
                    'days'          => $item['days'],
                    'month'         => $item['month'] ?? null,
                    'year'          => $item['year'] ?? null,
                    'qty'           => $item['qty'],
                    'rate'          => $item['rate'],
                    'payout'        => $item['payout'],
                    'total'         => $itemTotal,
                ];

                if (!empty($item['id'])) {
                    $detail = $invoice->details()->where('id', $item['id'])->first();
                    if ($detail) {
                        $detail->update($detailData);
                        $submittedDetailIds[] = $detail->id;
                    }
                } else {
                    $newDetail = $invoice->details()->create($detailData);
                    $submittedDetailIds[] = $newDetail->id;
                }

                $totalAmount += $itemTotal;
            }


            $idsToDelete = array_diff($existingDetailIds, $submittedDetailIds);
            $invoice->details()->whereIn('id', $idsToDelete)->delete();

            $invoice->update(['total_amount' => $totalAmount]);

            DB::commit();
            return ajaxResponse(200, 'Invoice successfully updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Invoice update error: ' . $e->getMessage());

            return ajaxResponse(500, 'Internal server error');
        }
    }






    public function destroy($id)
    {
        try {
            $data = Invoice::FindOrFail($id);
            $data->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        
    }
    public function export($id)
    {
        $invoice = Invoice::with('details')->findOrFail($id);

        if ($invoice->branch_id == 1) {
            $pdf = PDF::loadView('exports.invoice-pdf-mapl', compact('invoice'))
                ->setPaper('A4', 'portrait');
        } else {
            $pdf = PDF::loadView('exports.invoice-pdf-astha', compact('invoice'))
                ->setPaper('A4', 'portrait');
        }
        return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }

    public function getBranch($company_id)
    {

        $company = Company::with('branch:branch_id,branch_name')->where('company_id', $company_id)->first();

        if ($company && $company->branch) {
            return response()->json([
                'id' => $company->branch->branch_id,
                'name' => $company->branch->branch_name,
            ]);
        }

        return response()->json(['id' => null, 'name' => 'No branch found']);
    }

    public function getAssignJobs(Request $request)
    {
        $companyId = $request->company_id;
        $month = $request->month;
        $year = $request->year;

        if (!$companyId || !$month || !$year) {
            return response()->json([]);
        }

        $assignJobs = AssignJob::join('employees', 'employees.emp_id', '=', 'assignjob.emp_id')
            ->join('job', 'job.job_id', '=', 'employees.post_applied')
            ->leftJoin('attendance', function ($join) use ($month, $year) {
                $join->on('attendance.emp_id', '=', 'employees.emp_id')
                    ->where('attendance.month', $month)
                    ->where('attendance.year', $year);
            })
            ->leftJoin('quotation', function ($join) use ($companyId) {
                $join->on('quotation.company_id', '=', 'assignjob.company_id');
            })
            ->leftJoin('quotation_detail', function ($join) {
                $join->on('quotation_detail.quotation_id', '=', 'quotation.id')
                    ->whereColumn('quotation_detail.particluar', 'employees.post_applied')
                    ->whereColumn('quotation_detail.working_hour', 'assignjob.shift_timing');
            })
            ->where('assignjob.company_id', $companyId)
            ->where('quotation.status', true)
            ->select(
                'job.post',
                'employees.post_applied',
                'employees.gender',
                'assignjob.shift_timing',
                DB::raw('COUNT(assignjob.job_id) as total_assign_jobs'),
                DB::raw('SUM(COALESCE(attendance.days_worked, 0)) as total_attendance_days'),
                'quotation_detail.rate'
            )
            ->groupBy('employees.post_applied', 'employees.gender', 'assignjob.shift_timing', 'job.post', 'quotation_detail.rate')
            ->get();

        return response()->json($assignJobs);
    }
}
