<?php

namespace App\Exports;

use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;

class SalaryExport
{
    protected $results;

    public function __construct($results)
    {
        $this->results = $results;
    }

    public function export()
    {
        \Excel::create('Salary_Report', function ($excel) {

            $excel->sheet('Sheet1', function ($sheet) {

                // 1️⃣ Add title row
                $sheet->mergeCells('A1:W1');
                $sheet->row(1, ['MAPL - SALARY SHEET']);
                $sheet->cell('A1', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setFontSize(14);
                    $cell->setAlignment('center');
                });

                // 2️⃣ Add address row
                $sheet->mergeCells('A2:W2');
                $sheet->row(2, ['Party Name & Address : AS MOTORS, BHILWARA (Raj.)']);
                $sheet->cell('A2', function ($cell) {
                    $cell->setAlignment('center');
                });

                // 3️⃣ Header row
                $headers = [
                    'S.No',
                    'Employee ID',
                    'Name',
                    'Post',
                    'Salary',
                    'Per Day Wages',
                    'Basic Work Days',
                    'Basic Salary',
                    'Per Day Salary',
                    'Month Days',
                    'Days Worked',
                    'OT Days',
                    'OT Salary',
                    'Allowance',
                    'Gross',
                    'PF/ESI Applicable',
                    'PF/ESI Employee',
                    'PF/ESI Employer',
                    'Advance',
                    'Dress Deduction',
                    'Other Deduction',
                    'Net Payable',
                    'CTC'
                ];

                $sheet->row(4, $headers);
                $sheet->row(4, function ($row) {
                    $row->setFontWeight('bold');
                });

                // 4️⃣ Data rows
                $rows = $this->generateRows();
                $sheet->fromArray($rows, null, 'A5', false, false);

                // 5️⃣ Auto-size columns
                foreach (range('A', 'W') as $col) {
                    $sheet->setAutoSize(true);
                }
            });
        })->download('xlsx');
    }

    private function generateRows()
    {
        $rows = [];
        $serial = 1;

        foreach ($this->results as $value) {
            $assignJob = $value->assignJob;

            $salary = $assignJob->salary ?? 0;
            $perday_wages = $assignJob->perday_wages ?? 0;
            $deduction = $assignJob->deduction ?? '';

            $days_worked = $value->days_worked ?? 0;
            $basic_work_days = $days_worked >= 26 ? 26 : $days_worked;

            $month = $value->month;
            $year = $value->year;

            $monthdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $perday_salary = $monthdays > 0 ? round($salary / $monthdays, 2) : 0;
            $otdays = $days_worked > 26 ? $days_worked - 26 : 0;
            $ot_salary = round($perday_salary * $otdays, 2);
            $allowance = round(($perday_salary - $perday_wages) * $basic_work_days, 2);

            $basic_salary = $perday_wages * $basic_work_days;
            $gross = $basic_salary + $ot_salary + $allowance;

            $deductions = array_filter(array_map('trim', explode(',', $deduction)));

            $pf_applicable = in_array('PF', $deductions) ? 'YES' : 'NO';
            $esi_applicable = in_array('ESI', $deductions) ? 'YES' : 'NO';

            $pf_employee = $pf_applicable === 'YES' ? round(0.12 * $basic_salary, 2) : 0;
            $esi_employee = $esi_applicable === 'YES' ? round(0.0075 * $gross, 2) : 0;

            $pf_employer = $pf_applicable === 'YES' ? round(0.13 * $basic_salary, 2) : 0;
            $esi_employer = $esi_applicable === 'YES' ? round(0.0325 * $gross, 2) : 0;

            $advance = (float)($value->advance ?? 0);
            $dress_deduction = (float)($value->dress_deduction ?? 0);
            $other_deduction = (float)($value->other_deduction ?? 0);

            $net_payable = $gross - $pf_employee - $esi_employee - $advance - $dress_deduction - $other_deduction;
            $ctc = $gross + $pf_employer + $esi_employer;

            $rows[] = [
                $serial++,
                $value->employee->employee_id,
                $value->employee->name,
                $value->employee->job->post ?? 'N/A',
                $salary,
                $perday_wages,
                $basic_work_days,
                $basic_salary,
                $perday_salary,
                $monthdays,
                $days_worked,
                $otdays,
                $ot_salary,
                $allowance,
                $gross,
                "$pf_applicable, $esi_applicable",
                "$pf_employee / $esi_employee",
                "$pf_employer / $esi_employer",
                $advance,
                $dress_deduction,
                $other_deduction,
                round($net_payable, 2),
                round($ctc, 2)
            ];
        }

        return $rows;
    }
}
