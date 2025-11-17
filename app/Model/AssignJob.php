<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Employees;
use App\Model\Company;

class AssignJob extends Model
{
    protected $table = 'assignjob';
    protected $primaryKey = 'job_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'job_id',
        'emp_id',
        'company_id',
        'gender',
        'job_role',
        'shift',
        'shift_timing',
        'salary',
        'perday_wages',
        'deduction',
        'from_date',
        'to_date',
        'time_from',
        'time_to',
        'created_at',
        'updated_at',
        'status'
    ];

    public function employees()
    {
        return $this->belongsTo(Employees::class, 'emp_id', 'emp_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employees::class, 'emp_id', 'emp_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_role', 'job_id')->withDefault([
            'post' => 'N/A',
        ]);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
