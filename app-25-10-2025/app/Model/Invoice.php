<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice'; // keep if your actual table is singular
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'qdate',
        'branch_id',
        'company_id',       // for existing company (if selected)
        'name',             // for "Other"
        'contact',
        'email',
        'gst_no',
        'pincode',          // add if you're storing pincode
        'address',
        'labour_surcharge', // add if storing
        'service_charge',   // add if storing
        'deduction',        // usually stored as JSON
        'total_amount',
        'invoice_id',
        'month',
        'year'
    ];

    protected $casts = [
        'deduction' => 'array', // if stored as JSON
    ];

    /**
     * One invoice has many invoice detail rows
     */
    public function details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    /**
     * Optional: Inverse relationship with company
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
