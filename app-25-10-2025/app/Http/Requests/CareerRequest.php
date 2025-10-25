<?php

namespace App\Http\Requests;

use App\Traits\CustomValidationMessageTrait;
use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
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
            'name' => 'required',
            // 'email' => 'required|email',
            'phone' => 'required|integer',
            'father_name' => 'required',
            'dob' => 'required',
            'marital_status' => 'required',
            'aadhar' => 'required|integer',
            'gender' => 'required',
            'highest_qualification' => 'required',
            'employment_status' => 'required',
            'post_applied' => 'required',
            // 'salary_expectations' => 'required',
            // 'time_preference' => 'required',
            // 'filled_by' => 'required',
        ];
    }
}
