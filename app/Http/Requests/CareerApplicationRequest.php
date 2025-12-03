<?php

namespace App\Http\Requests;

use App\Traits\CustomValidationMessageTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CareerApplicationRequest extends FormRequest
{
    use CustomValidationMessageTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'required',

            'phone' => [
                'required',
                'digits:10',
                'numeric',
                Rule::unique('career_applicant', 'phone'),
            ],

            'father_name' => 'required',
            'marital_status' => 'required',
            'gender' => 'required',
            'highest_qualification' => 'required',
            'employment_status' => 'required',
            'post_applied' => 'required',
            'time_preference' => 'required',
            'filled_by' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Mobile number is required',
            'phone.digits'   => 'Mobile number must be 10 digits',
            'phone.numeric'  => 'Only numbers allowed',
            'phone.unique'   => 'This mobile number is already registered',
        ];
    }
}
