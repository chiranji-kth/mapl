<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployeesSalary extends Model
{
    protected $table = 'employees_salary';
    protected $primaryKey = 'id';

    protected $fillable = [
        
            'emp_id',
            'salary',
            'basic',
            'month',
            'year',
            'month_days',
            'working_days',
            'per_day',
            'emp_pf',
            'emp_esi',
            'empr_pf',
            'empr_esi',
            'advance',
            'dress',
            'allowance',
            'totalSalary'
            
        ];
    
    public function employees(){
        return $this->belongsTo(Employees::class,'emp_id');
    }

}
