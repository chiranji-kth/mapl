<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Model\SalaryDetails;
use App\Model\SalaryDetailsToAllowance;
use App\Model\SalaryDetailsToDeduction;
use App\Model\SalaryDetailsToLeave;
use App\Repositories\CommonRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Employees;

class AttendanceController extends Controller
{

    protected $commonRepository;

    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository  = $commonRepository;
    }

    public function index(Request $request)
    {
        $employeeList = $this->commonRepository->jobEmployeesList();
        return view('admin.attendance.manualAttendance.index', ['employeeList' => $employeeList]);
    }

    public function store(Request $request)
    {
        $input               = $request->all();
        $input['created_by'] = Auth::user()->user_id;
        $input['updated_by'] = Auth::user()->user_id;
    }

    public function create()
    {
        $employeeList = $this->commonRepository->employeeList();
        return view('admin.payroll.salarySheet.generateSalarySheet', ['employeeList' => $employeeList]);
    }
}
