<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Quotation PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            background: #fff;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            /* padding: 0 15px; */
            box-sizing: border-box;
            border: 1px solid #000;
        }

        .footer {
            max-width: 800px;
            margin: 0 auto;
            /* padding: 0 15px; */
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

        .quotation-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 3px 0 3px 0;
            letter-spacing: 1px;
            border-top: 1px solid #000;
        }

        .details-table {
            border-top: 1px solid #000;
        }

        .details-table th,
        .details-table td {
            border: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }

        .no-border td,
        .no-border th {
            border: none;
            padding: 3px;
        }

        .right-align {
            text-align: right;
        }

        .center-align {
            text-align: center;
        }

        .sign {
            width: 90px;
            height: auto;
        }

        .info-table td {
            padding: 5px;
            border: 1px solid #000;
        }

        .particulars-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .amount-words {
            text-transform: capitalize;
        }

        .calculation-table {
            margin-top: 0;
        }

        .calculation-table td {
            padding: 5px;
        }

        .total-row {
            font-weight: bold;
        }

        .grand-total-row {
            font-weight: bold;
            font-size: 14px;
        }

        .footer-section {
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        .payment-info {
            float: left;
            width: 60%;
        }

        .signature-section {
            float: right;
            width: 35%;
            text-align: center;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
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
            border: none;
        }

        .footer-sign {
            width: 30%;
            text-align: center;
            vertical-align: center;
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

        <div class="quotation-title">QUOTATION</div>

        <table>
            <tr>
                <td colspan="4" style="text-transform:uppercase"><strong>GST No.:</strong> 08AAKCM5617L1Z0</td>
                <td colspan="4" style="text-transform:uppercase"><strong>PAN No.:</strong> AAKCM5617L</td>
            </tr>
            <tr>
                <td colspan="4"><strong>Quotation No.:</strong> MAPL-SG/25-26/{{ $quotation->quotation_no }}</td>
                <td colspan="4"><strong>State Code:</strong> {{ $quotation->state_code }}</td>
            </tr>
            <tr>
                <td colspan="8"><strong>Quotation DATE:</strong> {{ \Carbon\Carbon::parse($quotation->qdate)->format('d/m/Y') }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td style="border: none; vertical-align: top; width: 16%; text-wrap: nowrap;">
                    <strong>Party Name: </strong>
                </td>
                <td style="border: none; vertical-align: top; width: 45%; text-transform: uppercase">
                    {{ $quotation->name }}<br /> {{ $quotation->address }}
                </td>
                <td style="border:none; width: 39%;padding:0">
                    <table>
                        <tr>
                            <td style="text-transform:uppercase"><strong>Party GSTN:</strong> {{ $quotation->gst_no }}</td>
                        </tr>
                        <tr>
                            <td><strong>Contact:</strong> {{ $quotation->contact }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong> {{ $quotation->email }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="particulars-table">
            <thead>
                <tr>
                    <th style="width: 6%;">S.No.</th>
                    <th style="width: 30%;">Particulars</th>
                    <th style="width: 10%;">Gender</th>
                    <th style="width: 16%;">Working Hour</th>
                    <th style="width: 10%;">Qty</th>
                    <th style="width: 14%;">Rate</th>
                    <th style="width: 14%;">Amount (Rs.)</th>
                </tr>
            </thead>
            <tbody>
                @php
                $subtotal = 0;
                @endphp

                @foreach($quotation->details as $i => $item)
                @php
                $lineTotal = $item->rate * $item->qty;
                $subtotal += $lineTotal;
                @endphp
                <tr>
                    <td style="width: 6%;" class="center-align">{{ $i + 1 }}</td>
                    <td style="width: 30%;">{{ $item->particluar }}</td>
                    <td style="width: 10%;" class="center-align">{{ $item->gender }}</td>
                    <td style="width: 16%;" class="center-align">{{ $item->working_hour }}</td>
                    <td style="width: 10%;" class="center-align">{{ $item->qty }}</td>
                    <td style="width: 14%;" class="right-align">{{ number_format($item->rate, 2) }}</td>
                    <td style="width: 14%;" class="right-align">{{ number_format($lineTotal, 2) }}</td>
                </tr>
                @endforeach

                @for ($j = count($quotation->details); $j < 10; $j++)
                    <tr>
                    <td style="width: 10%;" class="center-align">{{ $j + 1 }}</td>
                    <td style="width: 30%;">&nbsp;</td>
                    <td style="width: 10%;" class="center-align">&nbsp;</td>
                    <td style="width: 20%;" class="center-align">&nbsp;</td>
                    <td style="width: 10%;" class="center-align">&nbsp;</td>
                    <td style="width: 10%;" class="right-align">&nbsp;</td>
                    <td style="width: 10%;" class="right-align">&nbsp;</td>
                    </tr>
                    @endfor
            </tbody>
        </table>


        @php

        $deductions = is_array($quotation->deduction) ? $quotation->deduction : json_decode($quotation->deduction ?? '[]');

        $pf = in_array('PF', $deductions) ? $subtotal * 0.13 : 0;
        $esi = in_array('ESI', $deductions) ? $subtotal * 0.0325 : 0;

        $total = $subtotal + $pf + $esi;

        $cgst = in_array('CGST', $deductions) ? $total * 0.09 : 0;
        $sgst = in_array('SGST', $deductions) ? $total * 0.09 : 0;
        $igst = in_array('IGST', $deductions) ? $total * 0.18 : 0;

        $grandTotal = $subtotal + $pf + $esi + $cgst + $sgst + $igst;


        @endphp

        <table>
            <tr>
                <td colspan="4" style="border: none;"></td>
                <td colspan="2" class="right-align"><strong>Sub Total:</strong></td>
                <td colspan="2" class="right-align"><strong>{{ number_format($subtotal, 2) }}</strong></td>
            </tr>
            @if($pf > 0)
            <tr>
                <td colspan="4" style="border: none;"></td>
                <td colspan="2" class="right-align"><strong>PF (13%):</strong></td>
                <td colspan="2" class="right-align">{{ number_format($pf, 2) }}</td>
            </tr>
            @endif @if($esi > 0)
            <tr>
                <td colspan="4" style="border: none;"></td>
                <td colspan="2" class="right-align"><strong>ESI (3.25%):</strong></td>
                <td colspan="2" class="right-align">{{ number_format($esi, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="4" style="border: none;"></td>
                <td colspan="2" class="right-align"><strong>Total:</strong></td>
                <td colspan="2" class="right-align"><strong>{{ number_format($subtotal, 2) }}</strong></td>
            </tr>
            @if($cgst > 0)
            <tr>
                <td colspan="4" style="border: none;"></td>
                <td colspan="2" class="right-align"><strong>CGST (9%):</strong></td>
                <td colspan="2" class="right-align">{{ number_format($cgst, 2) }}</td>
            </tr>
            @endif @if($sgst > 0)
            <tr>
                <td colspan="4" style="border: none;"></td>
                <td colspan="2" class="right-align"><strong>SGST (9%):</strong></td>
                <td colspan="2" class="right-align">{{ number_format($sgst, 2) }}</td>
            </tr>
            @endif @if($igst > 0)
            <tr>
                <td colspan="4" style="border: none;"></td>
                <td colspan="2" class="right-align"><strong>IGST (18%):</strong></td>
                <td colspan="2" class="right-align">{{ number_format($igst, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="4" class="right-align" style="text-transform:uppercase">
                    <strong>Note:</strong>
                    @php
                    $notes = $quotation->note ? explode(', ', $quotation->note) : [];
                    @endphp
                    @if(count($notes))
                    @foreach($notes as $note)
                    <span>{{ $note }}</span>@if(!$loop->last), @endif
                    @endforeach
                    @else
                    <span>None</span>
                    @endif

                </td>
                <td colspan="2" class="right-align"><strong>Grand Total:</strong></td>
                <td colspan="2" class="right-align"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
            </tr>
        </table>

        <table class="info-table">
            <tr>
                <td colspan="3" class="amount-words">
                    <strong>Amount in Words: </strong>{{ convertNumberToIndianWords(floor($grandTotal)) }}
                </td>
            </tr>
        </table>

        <div class="footer">
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
    </div>
</body>

</html>