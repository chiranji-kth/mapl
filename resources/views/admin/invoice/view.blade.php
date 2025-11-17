@extends('admin.master')
@section('title', 'View invoice')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>View invoice</li>
            </ol>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <a href="{{ route('invoice.export', $invoice->id) }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-print" aria-hidden="true"></i> Print Invoice</a>
        </div>
    </div>

    <!-- Main invoice Info -->
    <div class="panel panel-default">
        <div class="panel-heading">Invoice Information</div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>Invoice ID</th>
                    <td>@if($invoice->branch_id == 1)
                        {{ date('Y') . '-' . date('y', strtotime('+1 year')) }}/{{ $invoice->invoice_id ?? $invoice->invoice_id }}
                        @else
                            {{ $invoice->invoice_id ?? $invoice->invoice_id }}
                        @endif
                    </td>
                </tr>
                 <tr>
                    <th>Date</th>
                    <td>{{ $invoice->qdate }}</td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td>{{ $invoice->branch_id == 1 ? 'MAPL' : 'AASTHA' }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td style="text-transform:uppercase">{{ $invoice->name }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $invoice->contact }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $invoice->email }}</td>
                </tr>
                <tr>
                    <th>GST No</th>
                    <td style="text-transform:uppercase">{{ $invoice->gst_no }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td style="text-transform:uppercase">{{ $invoice->address }}</td>
                </tr>
                <tr>
                    <th>Pincode</th>
                    <td>{{ $invoice->pincode }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Invoice Items -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Particular</th>
                <th>Days</th>
                <th>Hour</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Payout</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->details as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->particluar }} FOR {{ DateTime::createFromFormat('!m', $item->month)->format('M') }} {{ $item->year }} ({{ $item->gender }})</td>
                <td>{{ $item->days }}</td>
                <td>{{ $item->working_hour }}</td>
                <td>{{ $item->qty }}</td>
                <td>₹ {{ number_format($item->rate, 2) }}</td>
                <td>{{ $item->payout }}</td>
            </tr>
            @endforeach
        </tbody>
        @php
        $deductions = is_array($invoice->deduction) ? $invoice->deduction : json_decode($invoice->deduction ?? '[]');

        $subtotal = $invoice->total_amount;
        
        $pf = in_array('PF', $deductions) ? $subtotal * 0.13 : 0;
        $esi = in_array('ESI', $deductions) ? $subtotal * 0.0325 : 0;
        
        $totalQty = $invoice->details->sum('qty');
        
        $labour = ($invoice->labour_surcharge ?? 0) * $totalQty;
        $service = ($invoice->service_charge ?? 0) * $totalQty;
        
        $total = $subtotal + $pf + $esi;
        
        $cgst = in_array('CGST', $deductions) ? $total * 0.09 : 0;
        $sgst = in_array('SGST', $deductions) ? $total * 0.09 : 0;
        $igst = in_array('IGST', $deductions) ? $total * 0.18 : 0;
        
        
        
        $totalBeforeRound = $subtotal + $pf + $esi + $cgst + $sgst + $igst + $labour + $service;
        $roundedTotal = round($totalBeforeRound);
        $roundOff = number_format($roundedTotal - $totalBeforeRound, 2);
        @endphp
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <th>Sub Total</th>
                <td>₹ {{ number_format($subtotal, 2) }}</td>
            </tr>
            @if($pf > 0)
            <tr>
                <td colspan="3"></td>
                <th>PF (13%)</th>
                <td>₹ {{ number_format($pf, 2) }}</td>
            </tr>
            @endif
            @if($esi > 0)
            <tr>
                <td colspan="3"></td>
                <th>ESI (3.25%)</th>
                <td>₹ {{ number_format($esi, 2) }}</td>
            </tr>
            @endif
                       
            <tr>
                <td colspan="3"></td>
                <th>Total</th>
                <td><strong>₹ {{ number_format($total, 2) }}</strong></td>
            </tr>
            @if($cgst > 0)
            <tr>
                <td colspan="3"></td>
                <th>CGST (9%)</th>
                <td>₹ {{ number_format($cgst, 2) }}</td>
            </tr>
            @endif
            @if($sgst > 0)
            <tr>
                <td colspan="3"></td>
                <th>SGST (9%)</th>
                <td>₹ {{ number_format($sgst, 2) }}</td>
            </tr>
            @endif
            @if($igst > 0)
            <tr>
                <td colspan="3"></td>
                <th>IGST (18%)</th>
                <td>₹ {{ number_format($igst, 2) }}</td>
            </tr>
            @endif
            
            <tr>
                <td colspan="3"></td>
                <th>Round Off</th>
                <td>₹ {{ $roundOff }}</td>
            </tr>
            @if($labour > 0)
            <tr>
                <td colspan="3"></td>
                <th>Labour Surcharge</th>
                <td>₹ {{ number_format($labour, 2) }}</td>
            </tr>
            @endif
            @if($service > 0)
            <tr>
                <td colspan="3"></td>
                <th>Service Charge</th>
                <td>₹ {{ number_format($service, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="3"></td>
                <th>Grand Total</th>
                <td><strong>₹ {{ number_format($roundedTotal, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection