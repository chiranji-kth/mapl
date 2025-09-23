<?php

namespace App\Http\Requests;

use App\Traits\CustomValidationMessageTrait;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniquePhoneNumber;

class EmployeesRequest extends FormRequest
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
        if (isset($this->employee)) {
            return [
                'name' => 'required',
                // 'email' => 'nullable|unique:employees,email,' . $this->employee . ',emp_id',
                'phone' => 'required|integer|unique:employees,phone,' . $this->employee . ',emp_id',
                'father_name' => 'required',
                'dob' => 'required',
                'aadhar' => 'required',
                'gender' => 'required',
                'bank' => 'required',
                'acc_no' => 'required',
                'ifc_code' => 'required',
                'branch' => 'required',
                'marital_status' => 'required',
                'highest_qualification' => 'required',
                'employment_status' => 'required',
                'post_applied' => 'required',
                'salary_expectations' => 'required',
                'time_preference' => 'required',
                'filled_by' => 'required',
                'date_of_joining' => 'required',
                'kyc_doc' => 'required',
                'photo'  => 'mimes:jpeg,jpg,png|max:1024',
            ];
        }
        
        return [
                'name' => 'required',
                // 'email' => 'nullable|unique:employees,email',
                'phone' => 'required|integer|unique:employees,phone,' . $this->employee . ',emp_id',
                'father_name' => 'required',
                'dob' => 'required',
                'aadhar' => 'required',
                'gender' => 'required',
                'bank' => 'required',
                'acc_no' => 'required',
                'ifc_code' => 'required',
                'branch' => 'required',
                'marital_status' => 'required',
                'highest_qualification' => 'required',
                'employment_status' => 'required',
                'post_applied' => 'required',
                'salary_expectations' => 'required',
                'time_preference' => 'required',
                'filled_by' => 'required',
                'date_of_joining' => 'required',
                'kyc_doc' => 'required',
                'photo'  => 'mimes:jpeg,jpg,png|max:1024',
            ];
    }
}
