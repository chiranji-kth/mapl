<!DOCTYPE html>
<html>

<head>
    <title>Salary Sheet PDF</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 10px;
        }

        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #444;
        }

        th {
            background: #f2f2f2;
            padding: 4px;
            font-weight: bold;
            font-size: 10px;
        }

        td {
            padding: 4px;
            font-size: 10px;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .total-row {
            font-weight: bold;
            background: #e8e8e8;
        }
    </style>
</head>

<body>

    <div class="title">MAPL - SALARY SHEET</div>

    <p style="font-size: 12px;">
        <strong>Party Name & Address:</strong> {{ $companyname }} - {{ $companyAddress }}<br>
        <strong>Phone:</strong> {{ $companyphone }}<br>
        <strong>Month/Year:</strong> {{ $month }}/{{ $year }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Sr</th>
                <th>EMP ID</th>
                <th>Name</th>
                <th>Post</th>
                <th>Total Salary</th>
                <th>Per Day Basic</th>
                <th>Basic Days</th>
                <th>Basic Salary</th>
                <th>Per Day Salary</th>
                <th>Month Days</th>
                <th>Total Duties</th>
                <th>OT Days</th>
                <th>OT Salary</th>
                <th>Allowance</th>
                <th>Gross</th>
                <th>PF/ESI</th>
                <th>Emp PF/ESI</th>
                <th>Er PF/ESI</th>
                <th>Advance</th>
                <th>Dress</th>
                <th>Other</th>
                <th>Net Payable</th>
                <th>CTC</th>
            </tr>
        </thead>

        <tbody>
            @foreach($rows as $row)
            <tr>
                <td>{{ $row['serial'] }}</td>
                <td>{{ $row['emp_id'] }}</td>
                <td>{{ $row['name'] }}</td>
                <td>{{ $row['post'] }}</td>
                <td>{{ $row['salary'] }}</td>
                <td>{{ $row['perday_wages'] }}</td>
                <td>{{ $row['basic_work_days'] }}</td>
                <td>{{ $row['basic_salary'] }}</td>
                <td>{{ $row['perday_salary'] }}</td>
                <td>{{ $row['monthdays'] }}</td>
                <td>{{ $row['days_worked'] }}</td>
                <td>{{ $row['otdays'] }}</td>
                <td>{{ $row['ot_salary'] }}</td>
                <td>{{ $row['allowance'] }}</td>
                <td>{{ $row['gross'] }}</td>
                <td>{{ $row['pf_esi'] }}</td>
                <td>{{ $row['pf_employee'] }}</td>
                <td>{{ $row['pf_employer'] }}</td>
                <td>{{ $row['advance'] }}</td>
                <td>{{ $row['dress'] }}</td>
                <td>{{ $row['other'] }}</td>
                <td>{{ $row['net_payable'] }}</td>
                <td>{{ $row['ctc'] }}</td>
            </tr>
            @endforeach

            <!-- TOTAL ROW -->
            <tr class="total-row">
                <td colspan="3">TOTAL</td>
                <td></td>
                <td>{{ $totals['salary'] }}</td>
                <td></td>
                <td></td>
                <td>{{ $totals['basic_salary'] }}</td>
                <td></td>
                <td>{{ $totals['monthdays'] }}</td>
                <td>{{ $totals['days_worked'] }}</td>
                <td>{{ $totals['otdays'] }}</td>
                <td>{{ $totals['ot_salary'] }}</td>
                <td>{{ $totals['allowance'] }}</td>
                <td>{{ $totals['gross'] }}</td>
                <td></td>
                <td>{{ $totals['pf_employee'] }}/{{ $totals['esi_employee'] }}</td>
                <td>{{ $totals['pf_employer'] }}/{{ $totals['esi_employer'] }}</td>
                <td>{{ $totals['advance'] }}</td>
                <td>{{ $totals['dress'] }}</td>
                <td>{{ $totals['other'] }}</td>
                <td>{{ $totals['net_payable'] }}</td>
                <td>{{ $totals['ctc'] }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>