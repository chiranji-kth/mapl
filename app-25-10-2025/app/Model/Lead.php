<?php

namespace App\MOdel;

use Illuminate\Database\Eloquent\Model;


class Lead extends Model
{
    protected $table = 'lead';
    protected $primaryKey = 'lead_id';

    protected $fillable = [
        'lead_id', 'name', 'phone', 'guardtype', 'no_of_guard', 'from_date', 'purpose', 'status','created_by','updated_by'
    ];

    public function createdBy(){
        return $this->belongsTo(Employee::class,'created_by')->withDefault([
            'id' => 0,
            'first_name' => 'N/A',
            'last_name' => '',
        ]);
    }
}
