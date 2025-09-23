<?php
 
namespace App\Rules;
 
use Closure;
use App\Model\Employees;
use Illuminate\Contracts\Validation\ValidationRule;
 
class UniquePhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail)
    {
        return Employees::where('phone', request('phone') . '-' . $value)
                    ->doesntExist();
    }
}