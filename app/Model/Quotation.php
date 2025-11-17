<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Quotation extends Model
{
    protected $table = 'quotation';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'branch_id',
        'name',
        'qdate',
        'state_code',
        'contact',
        'email',
        'gst_no',
        'deduction',
        'labour_surcharge', // add if storing
        'service_charge',   // add if storing
        'total_amount',
        'address',
        'quotation_no',
        'note',
        'status',
    ];

    protected $casts = [
        'deduction' => 'array',
    ];

    public function details()
    {
        return $this->hasMany(QuotationDetail::class);
    }

    // public function createdBy()
    // {
    //     return $this->belongsTo(Employee::class, 'created_by')->withDefault([
    //         'id' => 0,
    //         'first_name' => 'N/A',
    //         'last_name' => '',
    //     ]);
    // }
}
