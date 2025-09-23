<?php

namespace App\MOdel;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $table = 'customer_order';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_id', 'userID', 'guardtype', 'no_of_guard', 'from_date', 'to_date', 'status','created_by','updated_by'
    ];

    public function createdBy(){
        return $this->belongsTo(Employee::class,'created_by')->withDefault([
            'id' => 0,
            'first_name' => 'N/A',
            'last_name' => '',
        ]);
    }
}
