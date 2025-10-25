<?php

namespace App\MOdel;

use Illuminate\Database\Eloquent\Model;


class Lead extends Model
{
    protected $table = 'followup';
    protected $primaryKey = 'followup_id';

    protected $fillable = [
       'followup_id', 'lead_id', 'message', 'created_by'
    ];

    public function createdBy(){
        return $this->belongsTo(Employee::class,'created_by')->withDefault([
            'id' => 0,
            'first_name' => 'N/A',
            'last_name' => '',
        ]);
    }
}
