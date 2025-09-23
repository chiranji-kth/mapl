<?php

namespace App\MOdel;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_id', 'name', 'phone', 'created_by', 'updated_by', 'status'
    ];

    public function createdBy(){
        return $this->belongsTo(Employee::class,'created_by')->withDefault([
            'id' => 0,
            'first_name' => 'N/A',
            'last_name' => '',
        ]);
    }
}
