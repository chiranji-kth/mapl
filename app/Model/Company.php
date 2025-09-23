<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'company_id';

    protected $fillable = [
        'company_id',
        'branch_id',
        'company_name',
        'industry',
        'email',
        'phone',
        'gst',
        'pan',
        'state',
        'district',
        'city',
        'address',
        'owner_name',
        'owner_phone',
        'contact_person_name',
        'contact_person_phone',
        'site_address',
        'date_of_service',
        'site_photo_1',
        'site_photo_2',
        'status'
    ];

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'created_by')->withDefault([
            'id' => 0,
            'first_name' => 'N/A',
            'last_name' => '',
        ]);
    }

    public function branch()
    {
        return $this->belongsTo(\App\Model\Branch::class, 'branch_id', 'branch_id');
    }
}
