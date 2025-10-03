<div class="table-responsive">
    @forelse($grouped as $companyName => $months)

    @foreach($months as $monthYear => $records)
    @php
    [$month, $year] = explode('-', $monthYear);
    $dateObj = DateTime::createFromFormat('!m', $month);
    @endphp

    <table class="table table-hover manage-u-table" id="example">
        <thead>
            <tr class="tr_header">
                <th>@lang('common.serial')</th>
                <th>District</th>
                <th>Branch</th>
                <th>Company</th>
                <th>Month</th>
                <th>EMP ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Post</th>
                <th>Shift Timing</th>

                <th>Total Salary</th>
                <th>Basic Salary Per Day</th>
                <th>Working Days For Basic</th>
                <th>Basic salary</th>
                <th>Per Day Salary</th>
                <th>Month Days</th>
                <th>Total Dutys</th>
                <th>OT Days</th>
                <th>OT Salary</th>
                <th>Allowance</th>
                <th>Gross</th>
                <th>PF, ESI</th>
                <th>Employee pf/esi</th>
                <th>Employer pf/esi</th>
                <th>Advance</th>
                <th>Dress Deduction</th>
                <th>Other Deduction</th>
                <th>Net Payable</th>
                <th>CTC</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $index => $value)
            @php
            $basic_work_days = $value->days_worked >= 26 ? 26 : $value->days_worked;
            $monthdays = cal_days_in_month(CAL_GREGORIAN, $value->month, $value->year);
            $perday_salary = round($value->assignJob->salary / $monthdays, 2);
            $otdays = $value->days_worked > 26 ? $value->days_worked - 26 : 0;
            $ot_salary = round($perday_salary * 2 * $otdays, 2);
            $allowance = (($perday_salary - $value->assignJob->perday_wages) * $basic_work_days);
            $gross = ($value->assignJob->perday_wages * $basic_work_days) + $allowance;

            $deductions = $value->assignJob && $value->assignJob->deduction
            ? array_map('trim', explode(',', $value->assignJob->deduction))
            : [];

            $pf_applicable = in_array('PF', $deductions) ? 'YES' : 'NO';
            $esi_applicable = in_array('ESI', $deductions) ? 'YES' : 'NO';

            $pf_amount_employee = $pf_applicable ? round(0.12 * $gross, 2) : 0;
            $esi_amount_employee = $esi_applicable ? round(0.0175 * $gross, 2) : 0;
            $pf_amount_employer = $pf_applicable ? round(0.12 * $gross, 2) : 0;
            $esi_amount_employer = $esi_applicable ? round(0.0475 * $gross, 2) : 0;

            $advance = is_numeric($value->advance) ? $value->advance : 0;
            $dress_deduction = is_numeric($value->dress_deduction) ? $value->dress_deduction : 0;
            $other_deduction = is_numeric($value->other_deduction) ? $value->other_deduction : 0;

            $net_salary_calc = $gross - $pf_amount_employee - $esi_amount_employee - $advance - $dress_deduction - $other_deduction;
            $ctc = $gross + $pf_amount_employer + $esi_amount_employer;

            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->company->districts->dist_name ?? '-' }}</td>
                <td>{{ $value->company->branch->branch_name ?? '-' }}</td>
                <td>{{ $value->company->company_name ?? '-' }}</td>
                <td>
                    @php
                    $dateObj = DateTime::createFromFormat('!m', $value->month);
                    echo $dateObj->format('F') . ', ' . $value->year;
                    @endphp
                </td>
                <td>{{ $value->employee->employee_id ?? '-' }}</td>
                <td>{{ $value->employee->name ?? '-' }}</td>
                <td>{{ $value->employee->gender ?? '-' }}</td>
                <td>{{ $value->assignJob->job->post ?? '-' }}</td>
                <td>{{ $value->assignJob->shift_timing ?? '-' }} (hrs.)</td>
                <td>{{ $value->assignJob->salary }}</td>
                <td>{{ $value->assignJob->perday_wages }}</td>
                <td>{{ $value->assignJob->perday_wages * $basic_work_days }}</td>
                <td>{{ $basic_work_days }}</td>
                <td>{{ $perday_salary }}</td>
                <td>{{ $monthdays }}</td>
                <td>{{ $value->days_worked }}</td>
                <td>{{ $otdays }}</td>
                <td>{{ $ot_salary }}</td>
                <td>{{ $allowance }}</td>
                <td>{{ $gross }}</td>
                <td>{{ $pf_applicable }} , {{ $esi_applicable }}</td>
                <td>{{ $pf_amount_employee . '/'. $esi_amount_employee }}</td>
                <td>{{ $pf_amount_employer . '/'. $esi_amount_employer }}</td>
                <td>{{ $advance }}</td>
                <td>{{ $dress_deduction }}</td>
                <td>{{ $other_deduction }}</td>
                <td>{{ $net_salary_calc ?? '-' }}</td>
                <td>{{ $ctc ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
    @empty
    <div class="alert alert-warning text-center">
        @lang('common.no_data_available') !
    </div>
    @endforelse
</div>