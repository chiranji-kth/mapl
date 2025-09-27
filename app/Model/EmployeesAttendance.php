<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployeesAttendance extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';

    protected $fillable = [
        'month',
        'year',
        'emp_id',
        'company_id',
        'assign_job_id',
        'working_days',
        'created_at',
        'updated_at',
        'status'
    ];

    public function employees()
    {
        return $this->belongsTo(Employees::class, 'emp_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
