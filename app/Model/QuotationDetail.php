<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class QuotationDetail extends Model
{
    protected $table = 'quotation_detail';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'quotation_id',
        'particluar',
        'gender',
        'working_hour',
        'qty',
        'rate',
        'total',
    ];


    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
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
