<?php

namespace App\Http\Requests;

use App\Traits\CustomValidationMessageTrait;
use Illuminate\Foundation\Http\FormRequest;

class AssignJobRequest extends FormRequest
{
    use CustomValidationMessageTrait;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'emp_id' => 'required|integer',
            'company_id' => 'required|integer',
            'perday_wages' => 'required',
            'from_date' => 'required',
            // 'to_date' => 'required',
            
        ];
    }
}