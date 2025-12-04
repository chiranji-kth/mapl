<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0 0 10px 0;
        }

        .no-border td {
            border: none;
        }
    </style>
</head>

<body>

    <h2>MAPL - Attendance Sheet</h2>

    <table class="no-border">
        <tr>
            <td><b>Party Name & Address</b></td>
            <td>{{ $companyname }}, {{ $companyAddress }}</td>
            <td><b>Date</b></td>
            <td>{{ date('d-m-Y') }}</td>
        </tr>
        <tr>
            <td><b>Phone</b></td>
            <td>{{ $companyphone }}</td>
            <td><b>Month/Year</b></td>
            <td>{{ $month }}/{{ $year }}</td>
        </tr>
    </table>

    <h3>Employee Attendance</h3>

    <table>
        <thead>
            <tr>
                <th>Sr</th>
                <th>EMP ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Post</th>
                <th>Shift</th>
                <th>Per Day Wages</th>
                <th>Shift Timing</th>
                <th>Working Days</th>
            </tr>
        </thead>
        <tbody>
            @php $serial = 1; @endphp
            @foreach($results as $val)
            <tr>
                <td>{{ $serial++ }}</td>
                <td>{{ $val->employee->employee_id }}</td>
                <td>{{ $val->employee->name }}</td>
                <td>{{ $val->employee->gender }}</td>
                <td>{{ $val->assignJob->post_applied ?? '-' }}</td>
                <td>{{ $val->assignJob->shift ?? '-' }}</td>
                <td>{{ $val->assignJob->perday_wages ?? '-' }}</td>
                <td>{{ $val->assignJob->shift_timing ?? '-' }}</td>
                <td>{{ $val->days_worked }}</td>
            </tr>
            @endforeach

            <tr>
                <td colspan="2"></td>
                <td><b>TOTAL PERSON</b></td>
                <td><b>{{ $total_person }}</b></td>
                <td colspan="3"></td>
                <td><b>TOTAL WORKING DAY</b></td>
                <td><b>{{ $total_working_day }}</b></td>
            </tr>

        </tbody>
    </table>

    <h3>Overall Attendance Summary</h3>

    <table>
        <thead>
            <tr>
                <th>Job Role</th>
                <th>Gender</th>
                <th>Hrs</th>
                <th>Total Employee</th>
                <th>Total Duty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($summary as $s)
            <tr>
                <td>{{ $s['jobRole'] }}</td>
                <td>{{ $s['gender'] }}</td>
                <td>{{ $s['shift'] }}</td>
                <td>{{ $s['total_employees'] }}</td>
                <td>{{ $s['total_duty'] }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td><b>TOTAL</b></td>
                <td><b>{{ $total_duty }}</b></td>
            </tr>
        </tbody>
    </table>

    <br><br>

    <table class="no-border">
        <tr>
            <td><b>Prepared By</b></td>
            <td><b>Checked By</b></td>
            <td colspan="3"><b>Site Supervisor / Field Officer</b></td>
        </tr>
    </table>

</body>

</html>