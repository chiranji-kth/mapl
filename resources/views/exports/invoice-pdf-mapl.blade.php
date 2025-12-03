<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $invoice->name ?? 'NA' }} INVOICE PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
            background: #fff;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 20px 10px 20px;
            box-sizing: border-box;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
            vertical-align: top;
        }

        .logo-cell {
            width: 180px;
            padding-right: 10px;
        }

        .logo-cell img {
            height: 60px;
        }

        .company-cell {
            text-align: right;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
        }

        .company-address {
            font-size: 12px;
            margin-top: 2px;
        }

        .invoice-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 3px 0 3px 0;
            letter-spacing: 1px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .info-table td {
            border: 1px solid #000;
            padding: 2px 4px;
            font-size: 12px;
        }

        .info-table .label {
            background: #f2f2f2;
            font-weight: bold;
            width: 120px;
        }

        .to-section {
            margin-top: 0;
            margin-bottom: 0;
        }

        .gstin-row {
            margin-bottom: 0;
            font-size: 13px;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #000;
            padding: 2px 4px;
            font-size: 12px;
        }

        .main-table th {
            background: #e6e6e6;
            font-weight: bold;
            text-align: center;
        }

        .main-table td {
            text-align: center;
        }

        .summary-table {
            width: 60%;
            float: right;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .summary-table td {
            border: 1px solid #000;
            padding: 2px 4px;
            font-size: 12px;
        }

        .summary-table .text-right {
            text-align: right;
        }

        .summary-table .bold {
            font-weight: bold;
        }

        .amount-words {
            margin-top: 4px;
            font-weight: bold;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .footer-table td {
            border: none;
            vertical-align: bottom;
            padding: 4px 3px 0 3px;
            font-size: 12px;
        }

        .footer-left {
            width: 65%;
        }

        .footer-right {
            width: 35%;
            text-align: right;
        }

        .sign {
            width: 90px;
            height: auto;
            margin-bottom: 5px;
        }

        @media print {
            body {
                margin: 0;
                background: #fff;
            }

            .container {
                margin: 0 auto;
                padding: 20px 20px 10px 20px;
            }

            .summary-table {
                float: none;
                margin-left: auto;
            }
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .totals-label {
            border: 1px solid #000;
            padding: 2px 4px;
            text-align: right;
            background: #fff;
        }

        .totals-value {
            border: 1px solid #000;
            padding: 2px 4px;
            text-align: right;
            background: #fff;
            font-weight: normal;
        }

        .totals-grand-label {
            border: 1px solid #000;
            padding: 2px 4px;
            text-align: right;
            font-weight: bold;
            background: #fff;
        }

        .totals-grand-value {
            border: 1px solid #000;
            padding: 2px 4px;
            text-align: right;
            font-weight: bold;
            background: #fff;
        }

        .amount-words-row {
            padding: 5px 0px;
            font-weight: bold;
            background: #fff;
            border: 1px solid #000;
            text-transform: capitalize;
        }

        .footer-notes {
            width: 50%;
            vertical-align: top;
            font-size: 10px;
            padding: 5px 2px 0 2px;
            border: none;
        }

        .footer-qr {
            width: 20%;
        }

        .footer-sign {
            width: 30%;
            text-align: center;
            vertical-align: bottom;
            border: none;
            padding: 5px 2px 0 2px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="https://www.maplbharat.com/front-assets/img/logo.png" alt="MAPL logo">
                </td>
                <td class="company-cell">
                    <div class="company-name">Mind Assessors Pvt. Ltd.</div>
                    <div class="company-address">
                        "Rajrani Tower", H1-6, IT Park, Near Adhunik Gas Agency,<br> Behind City Mall, I.P.I.A., Road No.-4, Jhalawar Road, Kota (Raj.)-324005<br> Email: maplbharat@gmail.com | Mob: 9314030299
                    </div>
                </td>
            </tr>
        </table>

        <div class="invoice-title">TAX INVOICE</div>

        <table class="info-table">
            <tr>
                <td colspan="2" class="label" style="text-transform:uppercase">GST No.:</td>
                <td colspan="2">08AAKCM5617L1Z0</td>
                <td colspan="2" class="label" style="text-transform:uppercase"><strong>PAN No.:</strong></td>
                <td colspan="2">AAKCM5617L </td>
            </tr>
            <tr>
                <td colspan="2" class="label">Invoice No.:</td>
                <td colspan="2">{{ date('Y') . '-' . date('y', strtotime('+1 year')) }}/{{ $invoice->invoice_id }}</td>
                <td colspan="2" class="label">Date:</td>
                <td colspan="2">{{ isset($invoice->qdate) ? \Carbon\Carbon::parse($invoice->qdate)->format('d/m/Y') : 'NA' }}</td>
            </tr>
            <tr>
                <td colspan="2" class="label">To:</td>
                <td colspan="6" style="text-transform:uppercase"><strong>{{ $invoice->name ?? 'NA' }}</strong><br />{{ $invoice->address }}</td>
            </tr>
            <tr>
                <td colspan="2" class="label">GSTIN :</td>
                <td colspan="6" style="text-transform:uppercase">{{ $invoice->gst_no }}</td>
            </tr>
        </table>

        <table class="main-table">
            <thead>
                <tr>
                    <th>S.No.</th>
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
                    <td> {{ number_format($item->rate, 2) }}</td>
                    <td>{{ $item->payout }}</td>
                </tr>
                @endforeach

                @for ($i = count($invoice->details); $i < 10; $i++)
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    @endfor
            </tbody>
        </table>


        @php $deductions = is_array($invoice->deduction) ? $invoice->deduction : json_decode($invoice->deduction ?? '[]');

        $subtotal = $invoice->details->sum('payout');

        $pf = in_array('PF', $deductions) ? $subtotal * 0.13 : 0;
        $esi = in_array('ESI', $deductions) ? $subtotal * 0.0325 : 0;

        $labour = $invoice->labour_surcharge ?? 0;
        $service = $invoice->service_charge ?? 0;

        $service = $subtotal * ($service / 100);

        $total = $subtotal + $labour + $service + $pf + $esi;

        $cgst = in_array('CGST', $deductions) ? $total * 0.09 : 0;
        $sgst = in_array('SGST', $deductions) ? $total * 0.09 : 0;
        $igst = in_array('IGST', $deductions) ? $total * 0.18 : 0;

        $totalBeforeRound = $total + $cgst + $sgst + $igst;
        $roundedTotal = round($totalBeforeRound); $roundOff = $roundedTotal - $totalBeforeRound;

        @endphp

        <table class="totals-table">
            <tr>
                <td colspan="4" class="totals-label" style="width:60%; background:#fff;"></td>
                <td colspan="2" class="totals-grand-label">Sub Total</td>
                <td colspan="2" class="totals-grand-value">{{ isset($subtotal) ? number_format($subtotal, 2) : 'NA' }}</td>
            </tr>
            @if($pf > 0)
            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-label">PF (13%)</td>
                <td colspan="2" class="totals-value">{{ number_format($pf, 2) }}</td>
            </tr>
            @endif
            @if($esi > 0)
            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-label">ESI (3.25%)</td>
                <td colspan="2" class="totals-value">{{ number_format($esi, 2) }}</td>
            </tr>
            @endif
            @if($labour > 0)
            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-label">Labour Surcharge</td>
                <td colspan="2" class="totals-value">{{ number_format($labour, 2) }}</td>
            </tr>
            @endif
            @if($service > 0)
            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-label">Service Charge</td>
                <td colspan="2" class="totals-value">{{ number_format($service, 2) }}</td>
            </tr>
            @endif

            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-grand-label">Total</td>
                <td colspan="2" class="totals-grand-value">{{ number_format($total, 2) }}</td>
            </tr>

            @if($cgst > 0)
            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-label">CGST (9%)</td>
                <td colspan="2" class="totals-value">{{ number_format($cgst, 2) }}</td>
            </tr>
            @endif
            @if($sgst > 0)
            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-label">SGST (9%)</td>
                <td colspan="2" class="totals-value">{{ number_format($sgst, 2) }}</td>
            </tr>
            @endif
            @if($igst > 0)
            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-label">IGST (18%)</td>
                <td colspan="2" class="totals-value">{{ number_format($igst, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-label">Round Off</td>
                <td colspan="2" class="totals-value">{{ isset($roundOff) ? number_format($roundOff, 2) : 'NA' }}</td>
            </tr>
            <tr>
                <td colspan="4" class="totals-label"></td>
                <td colspan="2" class="totals-grand-label">Grand Total</td>
                <td colspan="2" class="totals-grand-value">{{ isset($roundedTotal) ? number_format($roundedTotal, 2) : 'NA' }}</td>
            </tr>
            <tr>
                <td colspan="8" class="amount-words-row">
                    &nbsp;Amount in Words:- {{ isset($roundedTotal) ? convertNumberToIndianWords(floor($roundedTotal)) : 'NA' }}
                </td>
            </tr>
        </table>

        <!-- Footer Table -->
        <table class="footer-table">
            <tr>
                <td class="footer-notes">
                    The payment should be made in favour of<br>
                    <strong>Mind Assessors Pvt. Ltd.</strong><br>
                    <strong>A/c. No.: 50200085414581, IFSC: HDFC0007560</strong><br>
                    HDFC Bank Ltd., Rajeev Gandhi Nagar, Kota,<br>
                    If payment is delayed, Interest@2% P.M. shall be charged.
                    <br>
                    * Govt. taxes as applicable<br>
                    * All Subject to Kota Jurisdiction only.
                </td>

                <td class="footer-qr" style="text-align: center;">
                    <img src="https://www.maplbharat.com/front-assets/img/mapl-hdfc-qr.jpg" alt="QR Code" style="width: 100px; height: 100px; object-fit: contain;">
                </td>

                <td class="footer-sign">
                    For Mind Assessors Pvt. Ltd.<br>
                    <img class="sign" src="https://www.maplbharat.com/front-assets/img/astha-sign.png" alt=""><br>
                    <strong>Authorised Signature</strong>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>