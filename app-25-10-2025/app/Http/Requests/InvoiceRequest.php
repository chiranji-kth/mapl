<?php

namespace App\Http\Requests;

use App\Traits\CustomValidationMessageTrait;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'branch_id'             => 'required|integer',
            'qdate'              => 'required',
            // Either existing company or "Other"
            'company_id'            => 'required_without:name|nullable|not_in:',  // dropdown selected OR name required
            'name'                  => 'required_if:company_id,other',
            'contact'               => 'required_if:company_id,other',
            'email'                 => 'nullable|email',
            'gst_no'                => 'nullable|string',
            'pincode'               => 'nullable|numeric',
            'address'               => 'required_if:company_id,other',
            'month'                => 'nullable|string',
            'year'                => 'nullable|string',

            'items'                 => 'required|array|min:1',
            'items.*.particluar'    => 'required|string',
            'items.*.qty'           => 'required|numeric|min:1',
            'items.*.rate'          => 'required|numeric|min:0',
            'items.*.gender'        => 'required',
            'items.*.working_hour'  => 'required',
            'items.*.days'          => 'required',
            'items.*.payout'        => 'required',
            'items.*.month'         => 'required',
            'items.*.year'          => 'required',
        ];
    }
}
