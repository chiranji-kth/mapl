<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Lib\Enumerations\LeaveStatus;
use App\Model\Branch;
use App\Model\CompanyAddressSetting;
use App\Model\Department;
use App\Model\Designation;
use App\Model\Employee;

use App\Model\FrontSetting;
use App\Model\LeaveApplication;
use App\Model\PrintHeadSetting;
use App\Model\SalaryDetails;
use App\Model\SalaryDetailsToAllowance;
use App\Model\SalaryDetailsToDeduction;
use App\Model\SalaryDetailsToLeave;
use App\Repositories\CommonRepository;
use App\Repositories\PayrollRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Employees;
use App\Model\EmployeesSalary;
use App\Model\AssignJob;
use App\Model\Attendance;

class PayrollController extends Controller
{

    protected $commonRepository;
    protected $payrollRepository;

    public function __construct(CommonRepository $commonRepository, PayrollRepository $payrollRepository)
    {
        $this->commonRepository  = $commonRepository;
        $this->payrollRepository = $payrollRepository;
    }

    // public function index(Request $request)
    // {

    //     $employeeList = $this->commonRepository->jobEmployeesList();
    //     return view('admin.salary.index', ['employeeList' => $employeeList]);
    // }

    public function index(Request $request)
    {
        $query = Attendance::with(['employee', 'company', 'assignJob'])
            ->orderBy('company_id')
            ->orderBy('year')
            ->orderBy('month');

        // Filter by company if selected
        if ($request->has('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        // Filter by month/year
        if ($request->has('monthField')) {
            $query->where('month', $request->monthField);
        }
        if ($request->has('yearField')) {
            $query->where('year', $request->yearField);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween(DB::raw("STR_TO_DATE(CONCAT(year,'-',month,'-01'), '%Y-%m-%d')"), [
                Carbon::parse($request->start_date)->startOfMonth(),
                Carbon::parse($request->end_date)->endOfMonth(),
            ]);
        }

        $results = $query->get();

        // echo "<pre>";
        // print_r($results->toArray());
        // exit;

        $netSalary = $pf = $esi = $tds = 0;
        foreach ($results as $key => $value) {
            $netSalary = $value->days_worked * $value->assignJob->perday_wages;

            if (!empty($value->assignJob->deduction)) {
                $deductions = array_map('trim', explode(',', $value->assignJob->deduction));

                if (in_array('PF', $deductions)) {
                    $pf = (12 / 100) * ($value->days_worked * $value->assignJob->wages_per_day);
                }
                if (in_array('ESI', $deductions)) {
                    $esi = (0.75 / 100) * ($value->days_worked * $value->assignJob->wages_per_day);
                }
                if (in_array('TDS', $deductions)) {
                    $tds = (10 / 100) * ($value->days_worked * $value->assignJob->wages_per_day);
                }
            }


            $results[$key]->netSalary = round($netSalary - ($pf + $esi + $tds));
        }

        // echo "<pre>";
        // print_r($results->toArray());
        // exit;

        // Group by Company → Month-Year
        $grouped = $results->groupBy(function ($item) {
            return $item->company->company_name ?? 'Unknown Company';
        })->map(function ($companyRecords) {
            return $companyRecords->groupBy(function ($item) {
                return sprintf('%02d-%04d', $item->month, $item->year);
            });
        });

        if ($request->ajax()) {
            return view('admin.salary.pagination', compact('grouped'))->render();
        }

        $companyList = $this->commonRepository->companyList();

        return view('admin.salary.index', compact('grouped', 'companyList'));
    }

    public function calculateEmployeeSalary(Request $request)
    {

        // $query = DB::table('assignjob')
        //                 ->whereYear('from_date', '=', $request->year)
        //                 ->whereMonth('from_date', '=', $request->month)
        //                 ->where('emp_id', '=', $request->employee_id)
        //                 ->get();

        $deduction = $request->deduction;
        $wages_perday = $request->wages;
        $workingDays = $request->days;
        // echo "<pre>"; print_r(count($query)); exit;

        if ($workingDays <= 0) {
            return redirect('payroll')->with('error', 'fill more days');
        }

        $queryResult = EmployeesSalary::where('emp_id', $request->employee_id)->where('month', $request->month)->count();
        if ($queryResult > 0) {
            return redirect('payroll')->with('error', 'Salary already generated for this month.');
        }


        $employeeDetails = Employees::where('emp_id', $request->employee_id)->first();


        $oneday_salary = round($employeeDetails->salary_expectations / Carbon::now()->month($request->month)->daysInMonth);

        $payble_Salary = round($oneday_salary * $workingDays);
        $basic_Salary = round($wages_perday * $workingDays);

        if (!empty($deduction)) {
            if (in_array('PF', $deduction)) {

                $emppf = (12 / 100) * $basic_Salary;
                $empesi = (0.75 / 100) * $basic_Salary;
            }
            if (in_array('ESI', $deduction)) {
                $emprpf  = (13 / 100) * $basic_Salary;
                $empresi = (3.25 / 100) * $basic_Salary;
            }
        } else {

            $emppf = 0;
            $emprpf = 0;

            $empesi = 0;
            $empresi = 0;
        }

        $advance = $dress = $allowance = 0;

        $advance = $request->advance;
        $dress = $request->dress;
        $allowance = round($payble_Salary - $basic_Salary);

        $totalSalary =  $payble_Salary - ($advance + $dress + $emppf + $empesi);

        $data = [
            'emp_id'           => $employeeDetails->emp_id,
            'salary'           => $employeeDetails->salary_expectations,
            'basic'            => $basic_Salary,
            'month'            => $request->month,
            'year'             => $request->year,
            'month_days'       => Carbon::now()->month($request->month)->daysInMonth,
            'working_days'     => $workingDays,
            'per_day'          => $wages_perday,
            'emp_pf'           => $emppf,
            'empr_pf'          => $emprpf,
            'emp_esi'          => $empesi,
            'empr_esi'         => $empresi,
            'advance'          => $advance,
            'dress'            => $dress,
            'allowance'        => $allowance,
            'totalSalary'      => $totalSalary,
        ];

        DB::beginTransaction();

        $parentData = EmployeesSalary::create($data);

        DB::commit();
        return redirect('payroll');
        // return view('admin.payroll.salarySheet.generateSalarySheet', $data);
    }

    public function salary()
    {

        $results = EmployeesSalary::with('employees')->orderBy('id', 'DESC')->get();

        if (request()->ajax()) {

            $results = EmployeesSalary::with('employees')->orderBy('id', 'DESC');

            if ($request->monthField != '') {
                $results->where('month', $request->monthField);
            }

            // if ($request->status != '') {
            //     $results->where('status', $request->status);
            // }

            $results = $results->get();

            return View('admin.salary.pagination', compact('results'))->render();
        }

        $employeestList = $this->commonRepository->employeesList();
        // echo "<pre>"; print_r($results); exit;
        return view('admin.salary.salaryDetails', ['results' => $results, 'employeestList' => $employeestList]);
    }
    public function store(Request $request)
    {
        $input               = $request->all();
        $input['created_by'] = Auth::user()->user_id;
        $input['updated_by'] = Auth::user()->user_id;

        try {
            DB::beginTransaction();

            $parentData                       = SalaryDetails::create($input);
            $employeeSalaryDetailsToAllowance = $this->makeEmployeeSalaryDetailsToAllowanceDataFormat($request->all(), $parentData->salary_details_id);

            if (count($employeeSalaryDetailsToAllowance) > 0) {
                SalaryDetailsToAllowance::insert($employeeSalaryDetailsToAllowance);
            }

            $employeeSalaryDetailsToDeduction = $this->makeEmployeeSalaryDetailsToDeductionDataFormat($request->all(), $parentData->salary_details_id);
            if (count($employeeSalaryDetailsToDeduction) > 0) {
                SalaryDetailsToDeduction::insert($employeeSalaryDetailsToDeduction);
            }

            $employeeSalaryDetailsToLeave = $this->makeEmployeeSalaryDetailsToLeaveDataFormat($request->all(), $parentData->salary_details_id);
            if (count($employeeSalaryDetailsToLeave) > 0) {
                SalaryDetailsToLeave::insert($employeeSalaryDetailsToLeave);
            }

            DB::commit();
            $bug = 0;
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            return redirect('generateSalarySheet')->with('success', 'Salary Generate successfully.');
        } else {
            return redirect('generateSalarySheet')->with('error', 'Something Error Found !, Please try again.');
        }
    }


    public function monthSalary(Request $request)
    {
        $results = SalaryDetails::with(['employee' => function ($query) {
            $query->with('payGrade');
        }])->where('month_of_salary', $request->month)->get();

        return view('admin.payroll.salarySheet.salaryDetails', ['results' => $results]);
    }

    public function bulkSalary()
    {

        $departments  = Department::get();
        $branches     = Branch::get();
        $designations = Designation::get();

        return view('admin.payroll.salarySheet.generateBulkSalarySheet', [
            'departments'  => $departments,
            'branches'     => $branches,
            'designations' => $designations,
        ]);

        //   get to the bulk salary page
    }

    public function generateBulkSalary(Request $request)
    {

        $month        = $request->month;
        $from_date    = $month . '-01';
        $to_date      = date('Y-m-t', strtotime($from_date));
        $BulkEmployee = Employee::with('payGrade', 'hourlySalaries', 'department', 'designation');

        if ($request->branch_id != '') {
            $BulkEmployee->where('branch_id', '=', $request->branch_id);
        }
        if ($request->designation_id != '') {
            $BulkEmployee->where('designation_id', '=', $request->designation_id);
        }
        if ($request->department_id != '') {
            $BulkEmployee->where('department_id', '=', $request->department_id);
        }

        $BulkEmployee = $BulkEmployee->get();

        if (count($BulkEmployee) <= 0) {
            return redirect('generateSalarySheet')->with('error', 'No Employee Found.');
        }

        try {
            DB::beginTransaction();
            $done = 0;
            foreach ($BulkEmployee as $employeeDetails) {

                $query = DB::select("SELECT temp.* FROM (
                SELECT DATE_FORMAT(date,'%Y-%m') AS yearAndMonth,view_employee_in_out_data.finger_print_id,employee.employee_id FROM view_employee_in_out_data
                JOIN employee ON employee.finger_id = view_employee_in_out_data.finger_print_id
                ) AS temp WHERE yearAndMonth='$month' AND employee_id = $employeeDetails->employee_id");

                if (count($query) <= 0) {
                    continue;
                }

                $queryResult = SalaryDetails::where('employee_id', $employeeDetails->employee_id)->where('month_of_salary', $month)->count();
                if ($queryResult > 0) {
                    continue;
                }
                if (!empty($employeeDetails->pay_grade_id) || $employeeDetails->pay_grade_id != 0) {
                    $employeeAllInfo = [];
                    $allowance       = [];
                    $deduction       = [];
                    $tax             = 0;

                    $leaveRecord = LeaveApplication::select('leave_type.leave_type_id', 'leave_type_name', 'number_of_day', 'application_from_date', 'application_to_date')
                        ->join('leave_type', 'leave_type.leave_type_id', 'leave_application.leave_type_id')
                        ->where('status', LeaveStatus::$APPROVE)
                        ->where('application_from_date', '>=', $from_date)
                        ->where('application_to_date', '<=', $to_date)
                        ->where('employee_id', $employeeDetails->employee_id)
                        ->get();

                    $monthAndYear = explode('-', $month);
                    $start_year   = $monthAndYear[0] . '-01';
                    $end_year     = $monthAndYear[0] . '-12';

                    $financialYearTax = SalaryDetails::select(DB::raw('SUM(tax) as totalTax'))
                        ->where('status', 1)
                        ->where('employee_id', $employeeDetails->employee_id)
                        ->whereBetween('month_of_salary', [$start_year, $end_year])
                        ->first();

                    $allowance = $this->payrollRepository->calculateEmployeeAllowance($employeeDetails->payGrade->basic_salary, $employeeDetails->pay_grade_id);

                    $deduction = $this->payrollRepository->calculateEmployeeDeduction($employeeDetails->payGrade->basic_salary, $employeeDetails->pay_grade_id);
                    $tax       = $this->payrollRepository->calculateEmployeeTax(
                        $employeeDetails->payGrade->gross_salary,
                        $employeeDetails->payGrade->basic_salary,
                        $employeeDetails->date_of_birth,
                        $employeeDetails->gender,
                        $employeeDetails->pay_grade_id
                    );
                    $employeeAllInfo = $this->payrollRepository->getEmployeeOtmAbsLvLtAndWokDays(
                        $employeeDetails->employee_id,
                        $month,
                        $employeeDetails->payGrade->overtime_rate,
                        $employeeDetails->payGrade->basic_salary
                    );

                    $data = [
                        'allowances'          => $allowance,
                        'deductions'          => $deduction,
                        'tax'                 => $tax['monthlyTax'],
                        'taxAbleSalary'       => $tax['taxAbleSalary'],
                        'employee_id'         => $employeeDetails->employee_id,
                        'month'               => $month,
                        'employeeAllInfo'     => $employeeAllInfo,
                        'employeeDetails'     => $employeeDetails,
                        'leaveRecords'        => $leaveRecord,
                        'financialYearTax'    => $financialYearTax,
                        'employeeGrossSalary' => $employeeDetails->payGrade->gross_salary,
                    ];

                    $input = $this->payrollRepository->makeMonthlyBulkDataFormat($data);
                    $done += 1;
                } else {

                    // hourly salary
                    $employeeHourlySalary = $this->payrollRepository->getEmployeeHourlySalary($employeeDetails->employee_id, $month, $employeeDetails->hourlySalaries->hourly_rate);

                    $hourlyData = [
                        'hourly_rate'      => $employeeDetails->hourlySalaries->hourly_rate,
                        'employee_id'      => $employeeDetails->employee_id,
                        'month'            => $month,
                        'totalWorkingHour' => $employeeHourlySalary['totalWorkingHour'],
                        'totalSalary'      => $employeeHourlySalary['totalSalary'],
                        'employeeDetails'  => $employeeDetails,
                    ];

                    $input = $this->payrollRepository->makeHourlyBulkDataFormat($hourlyData);
                    $done += 1;
                }

                // insert all

                $input['created_by'] = Auth::user()->user_id;
                $input['updated_by'] = Auth::user()->user_id;

                $parentData                       = SalaryDetails::create($input);
                $employeeSalaryDetailsToAllowance = $this->makeEmployeeSalaryDetailsToAllowanceDataFormat($input, $parentData->salary_details_id);

                if (count($employeeSalaryDetailsToAllowance) > 0) {
                    SalaryDetailsToAllowance::insert($employeeSalaryDetailsToAllowance);
                }

                $employeeSalaryDetailsToDeduction = $this->makeEmployeeSalaryDetailsToDeductionDataFormat($input, $parentData->salary_details_id);
                if (count($employeeSalaryDetailsToDeduction) > 0) {
                    SalaryDetailsToDeduction::insert($employeeSalaryDetailsToDeduction);
                }

                $employeeSalaryDetailsToLeave = $this->makeEmployeeSalaryDetailsToLeaveDataFormat($input, $parentData->salary_details_id);
                if (count($employeeSalaryDetailsToLeave) > 0) {
                    SalaryDetailsToLeave::insert($employeeSalaryDetailsToLeave);
                }
            }
            DB::commit();

            if ($done == 0) {
                return redirect('generateSalarySheet')->with('error', 'No Related Data Found.');
            }
            return redirect('generateSalarySheet')->with('success', 'Salary Generate successfully.');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect('generateSalarySheet')->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $employeeList = $this->commonRepository->employeeList();
        return view('admin.payroll.salarySheet.generateSalarySheet', ['employeeList' => $employeeList]);
    }

    public function makeEmployeeSalaryDetailsToAllowanceDataFormat($data, $salary_details_id)
    {
        $allowanceData = [];
        if (isset($data['allowance_id'])) {
            for ($i = 0; $i < count($data['allowance_id']); $i++) {
                $allowanceData[$i] = [
                    'salary_details_id'   => $salary_details_id,
                    'allowance_id'        => $data['allowance_id'][$i],
                    'amount_of_allowance' => $data['amount_of_allowance'][$i],
                    'created_at'          => Carbon::now(),
                    'updated_at'          => Carbon::now(),
                ];
            }
        }
        return $allowanceData;
    }

    public function makeEmployeeSalaryDetailsToDeductionDataFormat($data, $salary_details_id)
    {
        $deductionData = [];
        if (isset($data['deduction_id'])) {
            for ($i = 0; $i < count($data['deduction_id']); $i++) {
                $deductionData[$i] = [
                    'salary_details_id'   => $salary_details_id,
                    'deduction_id'        => $data['deduction_id'][$i],
                    'amount_of_deduction' => $data['amount_of_deduction'][$i],
                    'created_at'          => Carbon::now(),
                    'updated_at'          => Carbon::now(),
                ];
            }
        }
        return $deductionData;
    }

    public function makeEmployeeSalaryDetailsToLeaveDataFormat($data, $salary_details_id)
    {
        $leaveData = [];
        if (isset($data['num_of_day'])) {
            for ($i = 0; $i < count($data['num_of_day']); $i++) {
                $leaveData[$i] = [
                    'salary_details_id' => $salary_details_id,
                    'num_of_day'        => $data['num_of_day'][$i],
                    'leave_type_id'     => $data['leave_type_id'][$i],
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ];
            }
        }
        return $leaveData;
    }

    public function makePayment(Request $request)
    {
        $data['status']         = 1;
        $data['comment']        = $request->comment;
        $data['payment_method'] = $request->payment_method;
        $data['created_by']     = Auth::user()->user_id;
        $data['updated_by']     = Auth::user()->user_id;
        $data['created_at']     = Carbon::now();
        $data['updated_at']     = Carbon::now();
        try {
            SalaryDetails::where('salary_details_id', $request->salary_details_id)->update($data);
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            echo "success";
        } else {
            echo "error";
        }
    }

    public function generatePayslip($id)
    {
        $paySlipId = $id;
        $ifHourly  = SalaryDetails::with(['employee' => function ($q) {
            $q->with(['hourlySalaries', 'department', 'designation']);
        }])->where('salary_details_id', $paySlipId)->first();

        if ($ifHourly->action == 'monthlySalary') {
            $paySlipDataFormat = $this->paySlipDataFormat($paySlipId);
        } else {
            $companyAddress = CompanyAddressSetting::first();
            $data           = [
                'salaryDetails'  => $ifHourly,
                'companyAddress' => $companyAddress,
                'paySlipId'      => $id,
            ];
            return view('admin.payroll.salarySheet.hourlyPaySlip', $data);
        }

        return view('admin.payroll.salarySheet.monthlyPaySlip', $paySlipDataFormat);
    }

    public function paySlipDataFormat($id)
    {
        $printHeadSetting = PrintHeadSetting::first();
        $setting          = FrontSetting::orderBy('id', 'desc')->first();
        $salaryDetails    = SalaryDetails::select('salary_details.*', 'employee.employee_id', 'employee.department_id', 'employee.designation_id', 'department.department_name', 'designation.designation_name', 'employee.first_name', 'employee.last_name', 'pay_grade.pay_grade_name', 'employee.date_of_joining')
            ->join('employee', 'employee.employee_id', 'salary_details.employee_id')
            ->join('department', 'department.department_id', 'employee.department_id')
            ->join('designation', 'designation.designation_id', 'employee.designation_id')
            ->join('pay_grade', 'pay_grade.pay_grade_id', 'employee.pay_grade_id')
            ->where('salary_details_id', $id)->first();

        $salaryDetailsToAllowance = SalaryDetailsToAllowance::join('allowance', 'allowance.allowance_id', 'salary_details_to_allowance.allowance_id')
            ->where('salary_details_id', $id)->get();

        $salaryDetailsToDeduction = SalaryDetailsToDeduction::join('deduction', 'deduction.deduction_id', 'salary_details_to_deduction.deduction_id')
            ->where('salary_details_id', $id)->get();

        $salaryDetailsToLeave = SalaryDetailsToLeave::select('salary_details_to_leave.*', 'leave_type.leave_type_name')
            ->join('leave_type', 'leave_type.leave_type_id', 'salary_details_to_leave.leave_type_id')
            ->where('salary_details_id', $id)->get();

        $monthAndYear = explode('-', $salaryDetails->month_of_salary);
        $start_year   = $monthAndYear[0] . '-01';
        $end_year     = $salaryDetails->month_of_salary;

        $financialYearTax = SalaryDetails::select(DB::raw('SUM(tax) as totalTax'))
            ->where('status', 1)
            ->where('employee_id', $salaryDetails->employee_id)
            ->whereBetween('month_of_salary', [$start_year, $end_year])
            ->first();

        return $data = [
            'salaryDetails'            => $salaryDetails,
            'salaryDetailsToAllowance' => $salaryDetailsToAllowance,
            'salaryDetailsToDeduction' => $salaryDetailsToDeduction,
            'paySlipId'                => $id,
            'financialYearTax'         => $financialYearTax,
            'salaryDetailsToLeave'     => $salaryDetailsToLeave,
            'printHeadSetting'         => $printHeadSetting,
            'logo_setting'             => $setting,
        ];
    }

    public function downloadPayslip($id)
    {

        $payslipId = $id;
        $ifHourly  = SalaryDetails::with(['employee' => function ($q) {
            $q->with(['hourlySalaries', 'department', 'designation']);
        }])->where('salary_details_id', $payslipId)->first();

        if ($ifHourly->action == 'monthlySalary') {
            $result = $this->paySlipDataFormat($payslipId);
        } else {
            $printHeadSetting = PrintHeadSetting::first();
            $setting          = FrontSetting::orderBy('id', 'desc')->first();
            $data             = [
                'salaryDetails'    => $ifHourly,
                'printHeadSetting' => $printHeadSetting,
                'logo_setting'     => $setting,
            ];
            //          return view('admin.payroll.salarySheet.hourlyPaySlipPdf',$data);
            $pdf = PDF::loadView('admin.payroll.salarySheet.hourlyPaySlipPdf', $data);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download("payslip.pdf");
        }

        $pdf = PDF::loadView('admin.payroll.salarySheet.monthlyPaySlipPdf', $result);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("payslip.pdf");
    }

    public function downloadMyPayroll()
    {
        $printHeadSetting = PrintHeadSetting::first();
        $results          = SalaryDetails::with(['employee' => function ($query) {
            $query->with('payGrade');
        }])->where('status', 1)->where('employee_id', session('logged_session_data.employee_id'))->orderBy('salary_details_id', 'DESC')->get();

        $data = [
            'printHead' => $printHeadSetting,
            'results'   => $results,
        ];

        $pdf = PDF::loadView('admin.payroll.report.pdf.myPayrollPdf', $data);

        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("my-payroll-Pdf.pdf");
    }

    public function paymentHistory(Request $request)
    {
        $results = '';
        if ($request->month) {
            $results = SalaryDetails::select(
                'salary_details.basic_salary',
                'salary_details.gross_salary',
                'salary_details.month_of_salary',
                DB::raw('CONCAT(COALESCE(employee.first_name,\'\'),\' \',COALESCE(employee.last_name,\'\')) AS fullName'),
                'employee.photo',
                'pay_grade.pay_grade_name',
                'hourly_salaries.hourly_grade',
                'department.department_name'
            )
                ->join('employee', 'employee.employee_id', 'salary_details.employee_id')
                ->join('department', 'department.department_id', 'employee.department_id')
                ->leftJoin('pay_grade', 'pay_grade.pay_grade_id', 'employee.pay_grade_id')
                ->leftJoin('hourly_salaries', 'hourly_salaries.hourly_salaries_id', 'employee.hourly_salaries_id')
                ->where('salary_details.status', 1)
                ->where('salary_details.month_of_salary', $request->month)
                ->orderBy('salary_details_id', 'DESC')
                ->get();
        }

        return view('admin.payroll.report.paymentHistory', ['results' => $results, 'month' => $request->month]);
    }

    public function myPayroll()
    {
        $results = SalaryDetails::with(['employee' => function ($query) {
            $query->with('payGrade');
        }])->where('status', 1)->where('employee_id', session('logged_session_data.employee_id'))->orderBy('salary_details_id', 'DESC')->get();
        return view('admin.payroll.report.myPayroll', ['results' => $results]);
    }

    public function exportSalaryCsv(Request $request)
    {
        $results = Attendance::with(['employee', 'company', 'assignJob'])
            ->orderBy('company_id')
            ->orderBy('year')
            ->orderBy('month');

        // Apply filters
        if ($request->company_id) $results->where('company_id', $request->company_id);
        if ($request->monthField) $results->where('month', $request->monthField);
        if ($request->yearField) $results->where('year', $request->yearField);

        $results = $results->get();

        $filename = 'salary_report.csv';

        $callback = function () use ($results) {
            $handle = fopen('php://output', 'w');

            // CSV Header
            fputcsv($handle, [
                'Serial',
                'District',
                'Branch',
                'Company',
                'Month',
                'EMP ID',
                'Name',
                'Gender',
                'Post',
                'Shift Timing',
                'Total Salary',
                'Basic Salary Per Day',
                'Working Days For Basic',
                'Basic Salary',
                'Per Day Salary',
                'Month Days',
                'Total Duties',
                'OT Days',
                'OT Salary',
                'Allowance',
                'Gross',
                'PF, ESI',
                'Employee PF/ESI',
                'Employer PF/ESI',
                'Advance',
                'Dress Deduction',
                'Other Deduction',
                'Net Payable',
                'CTC'
            ]);

            $serial = 1;

            foreach ($results as $value) {
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

                $pf_amount_employee = $pf_applicable === 'YES' ? round(0.12 * $gross, 2) : 0;
                $esi_amount_employee = $esi_applicable === 'YES' ? round(0.0175 * $gross, 2) : 0;
                $pf_amount_employer = $pf_applicable === 'YES' ? round(0.12 * $gross, 2) : 0;
                $esi_amount_employer = $esi_applicable === 'YES' ? round(0.0475 * $gross, 2) : 0;

                $advance = is_numeric($value->advance) ? $value->advance : 0;
                $dress_deduction = is_numeric($value->dress_deduction) ? $value->dress_deduction : 0;
                $other_deduction = is_numeric($value->other_deduction) ? $value->other_deduction : 0;

                $net_salary_calc = $gross - $pf_amount_employee - $esi_amount_employee - $advance - $dress_deduction - $other_deduction;
                $ctc = $gross + $pf_amount_employer + $esi_amount_employer;

                fputcsv($handle, [
                    $serial++,
                    $value->company->districts->dist_name ?? '-',
                    $value->company->branch->branch_name ?? '-',
                    $value->company->company_name ?? '-',
                    \Carbon\Carbon::createFromDate($value->year, $value->month)->format('F, Y'),
                    $value->employee->employee_id ?? '-',
                    $value->employee->name ?? '-',
                    $value->employee->gender ?? '-',
                    $value->assignJob->job->post ?? '-',
                    $value->assignJob->shift_timing ?? '-',
                    $value->assignJob->salary,
                    $value->assignJob->perday_wages,
                    $value->assignJob->perday_wages * $basic_work_days,
                    $basic_work_days,
                    $perday_salary,
                    $monthdays,
                    $value->days_worked,
                    $otdays,
                    $ot_salary,
                    $allowance,
                    $gross,
                    $pf_applicable . ', ' . $esi_applicable,
                    $pf_amount_employee . '/' . $esi_amount_employee,
                    $pf_amount_employer . '/' . $esi_amount_employer,
                    $advance,
                    $dress_deduction,
                    $other_deduction,
                    $net_salary_calc,
                    $ctc
                ]);
            }

            fclose($handle);
        };

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        return response()->stream($callback, 200, $headers);
    }
}
