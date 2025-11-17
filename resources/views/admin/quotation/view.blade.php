@extends('admin.master')
@section('title', 'View Quotation')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>View Quotation</li>
            </ol>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <a href="{{ route('quotation.export', $quotation->id) }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-print" aria-hidden="true"></i> print Quotation </a>
        </div>
    </div>

    <!-- Main Quotation Info -->
    <div class="panel panel-default">
        <div class="panel-heading">Quotation Information</div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>Quotation No</th>
                    <td>{{ $quotation->quotation_no }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $quotation->qdate }}</td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td>{{ $quotation->branch_id == 1 ? 'MAPL' : 'AASTHA' }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td style="text-transform:uppercase">{{ $quotation->name }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $quotation->contact }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $quotation->email }}</td>
                </tr>
                <tr>
                    <th>GST No</th>
                    <td style="text-transform:uppercase">{{ $quotation->gst_no }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td style="text-transform:uppercase">{{ $quotation->address }}</td>
                </tr>
                <tr>
                    <th>State Code</th>
                    <td>{{ $quotation->state_code }}</td>
                </tr>
                <tr>
                    <th>Note / Deductions</th>
                    <td>
                        @php
                        $notes = $quotation->note ? explode(', ', $quotation->note) : [];
                        @endphp
                        @if(count($notes))
                        @foreach($notes as $note)
                        <span>{{ $note }}</span>
                        @endforeach
                        @else
                        <span>None</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Quotation Items -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Particluar</th>
                <th>Gender</th>
                <th>Working Hour</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
            $subtotal = 0;
            @endphp

            @foreach($quotation->details as $index => $item)
            @php
            $lineTotal = $item->rate * $item->qty;
            $subtotal += $lineTotal;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->job->post ?? 'N/A' }}</td>
                <td>{{ $item->gender }}</td>
                <td>{{ $item->working_hour }}</td>
                <td>{{ $item->qty }}</td>
                <td>₹ {{ number_format($item->rate, 2) }}</td>
                <td>₹ {{ number_format($item->rate * $item->qty, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        @php
        $deductions = is_array($quotation->deduction) ? $quotation->deduction : json_decode($quotation->deduction ?? '[]');

        $subtotal = $quotation->total_amount;

        $pf = in_array('PF', $deductions) ? $subtotal * 0.13 : 0;
        $esi = in_array('ESI', $deductions) ? $subtotal * 0.0325 : 0;

        $labour = $quotation->labour_surcharge ?? 0;
        $service = $quotation->service_charge ?? 0;

        $total = $subtotal + $pf + $esi;

        $cgst = in_array('CGST', $deductions) ? $total * 0.09 : 0;
        $sgst = in_array('SGST', $deductions) ? $total * 0.09 : 0;
        $igst = in_array('IGST', $deductions) ? $total * 0.18 : 0;

        $finalTotal = $subtotal + $pf + $esi + $cgst + $sgst + $igst + $labour + $service;
        @endphp

        <tfoot>
            <tr>
                <td colspan="7"></td>

            </tr>

            <tr>
                <td colspan="5"></td>
                <th>Sub Total</th>
                <td>₹ {{ number_format($subtotal, 2) }}</td>
            </tr>
            @if($pf > 0)
            <tr>
                <td colspan="5"></td>
                <th>PF (13%)</th>
                <td>₹ {{ number_format($pf, 2) }}</td>
            </tr>
            @endif
            @if($esi > 0)
            <tr>
                <td colspan="5"></td>
                <th>ESI (3.25%)</th>
                <td>₹ {{ number_format($esi, 2) }}</td>
            </tr>
            @endif
            
            <tr>
                <td colspan="5"></td>
                <th><strong>Total</strong></th>
                <td><strong>₹ {{ number_format($total, 2) }}</strong></td>
            </tr>

            @if($cgst > 0)
            <tr>
                <td colspan="5"></td>
                <th>CGST (9%)</th>
                <td>₹ {{ number_format($cgst, 2) }}</td>
            </tr>
            @endif
            @if($sgst > 0)
            <tr>
                <td colspan="5"></td>
                <th>SGST (9%)</th>
                <td>₹ {{ number_format($sgst, 2) }}</td>
            </tr>
            @endif
            @if($igst > 0)
            <tr>
                <td colspan="5"></td>
                <th>IGST (18%)</th>
                <td>₹ {{ number_format($igst, 2) }}</td>
            </tr>
            @endif
             @if($labour > 0)
            <tr>
                <td colspan="5"></td>
                <th>Labour Surcharge</th>
                <td>₹ {{ number_format($labour, 2) }}</td>
            </tr>
            @endif
            @if($service > 0)
            <tr>
                <td colspan="5"></td>
                <th>Service Charge</th>
                <td>₹ {{ number_format($service, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="5"></td>
                <th><strong>Total Amount</strong></th>
                <td><strong>₹ {{ number_format($finalTotal, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection