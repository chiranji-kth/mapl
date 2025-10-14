<?php

namespace App\Http\Requests;

use App\Traits\CustomValidationMessageTrait;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        if (isset($this->company)) {
            return [
                'company_name' => 'required',
                'branch_id' => 'required',
                'industry' => 'required',
                'email' => 'nullable|unique:company,email,' . $this->company . ',company_id',
                'phone' => 'required|integer',
                'address' => 'required',
                'pan' => 'nullable',
                'gst' => 'nullable',
                'owner_name' => 'required',
                'owner_phone' => 'required|integer',
                'contact_person_name' => 'required',
                'contact_person_phone' => 'required|integer',
                'date_of_service' => 'required',

                'state' => 'required',
                'district' => 'required',
                'city' => 'required',
                'site_address' => 'required',
                // 'site_photo_1' => 'required|mimes:jpeg,jpg,png',
            ];
        }

        return [
            'company_name' => 'required',
            'branch_id' => 'required',
            'industry' => 'required',
            'email' => 'nullable|unique:company,email',
            'phone' => 'required|integer',
            'address' => 'required',
            'pan' => 'nullable',
            'gst' => 'nullable',
            'owner_name' => 'required',
            'owner_phone' => 'required|integer',
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required|integer',
            'date_of_service' => 'required',
            'state' => 'required',
            'district' => 'required',
            'city' => 'required',
            'site_address' => 'required',
            // 'site_photo_1' => 'required|mimes:jpeg,jpg,png',
        ];
    }
}
