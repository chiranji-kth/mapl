<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = 'invoice_detail';
    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_id',
        'particluar',
        'month',      // Add this
        'year',       // Add this
        'qty',
        'rate',
        'gender',        // usually stored as JSON
        'working_hour',        // usually stored as JSON
        'days',        // usually stored as JSON
        'payout',        // usually stored as JSON
    ];

    protected $casts = [
        'deduction' => 'array',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
