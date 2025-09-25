<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CareerApplicant extends Model
{
    protected $table = 'career_applicant';
    protected $primaryKey = 'career_applicant_id';

    protected $fillable = [
        'job_applicant_id',
        'name',
        'email',
        'phone',
        'alter_phone',
        'father_name',
        'dob',
        'aadhar',
        'gender',
        'marital_status',
        'p_district',
        'p_city',
        'p_address',
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

    public function interviewInfo()
    {
        return $this->hasOne(Interview::class, 'job_applicant_id');
    }

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
}
