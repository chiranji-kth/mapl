<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'emp_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'emp_id',
        'employee_id',
        'name',
        'email',
        'phone',
        'alter_phone',
        'father_name',
        'dob',
        'date_of_joining',
        'aadhar',
        'gender',
        'marital_status',
        'p_state',
        'p_district',
        'p_city',
        'p_address',
        'same_address',
        'c_state',
        'c_district',
        'c_city',
        'c_address',
        'bank',
        'acc_no',
        'ifc_code',
        'branch',
        'esic_no',
        'uan_no',
        'nominee',
        'esic_pf',
        'highest_qualification',
        'weight',
        'height',
        'experience',
        'employment_status',
        'post_applied',
        'salary_expectations',
        'other_post_applied',
        'time_preference',
        'remarks',
        'filled_by',
        'referd_by',
        'photo',
        'kyc_doc',
        'kyc_file',
        'status'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'post_applied', 'job_id')->withDefault([
            'post' => 'N/A',
        ]);
    }

    public function states()
    {
        return $this->belongsTo(State::class, 'p_state', 'state_id')->withDefault([
            'state_name' => 'N/A',
        ]);
    }

    public function districts()
    {
        return $this->belongsTo(District::class, 'p_district', 'dist_id')->withDefault([
            'dist_name' => 'N/A',
        ]);
    }

    public function assignedJobs()
    {
        return $this->hasMany(AssignJob::class, 'emp_id', 'emp_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
