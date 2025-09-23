<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignJob extends Model
{
    protected $table = 'assignjob';
    protected $primaryKey = 'job_id';

    protected $fillable = [
        'job_id', 'emp_id', 'company_id', 'perday_wages', 'deduction', 'from_date', 'to_date', 'created_at', 'updated_at', 'status'
    ];
    
    public function employees(){
        return $this->belongsTo(Employees::class,'emp_id');
    }

    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }
    

}
