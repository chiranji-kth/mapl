<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Employees;
use App\Model\Company;
use App\Model\AssignJob;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'company_id',
        'emp_id',
        'assign_job_id',
        'month',
        'year',
        'days_worked',
        'advance',
        'dress_deduction',
        'other_deduction',
        'created_at',
        'updated_at',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'emp_id', 'emp_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }
    public function assignJob()
    {
        return $this->belongsTo(AssignJob::class, 'assign_job_id', 'job_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
