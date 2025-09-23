<?php

namespace App\Http\Requests;

use App\Traits\CustomValidationMessageTrait;
use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
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
            'name'               => 'required',
            'branch_id'          => 'required|integer',
            'qdate'              => 'required',
            'state_code'         => 'required',

            'items'                 => 'required',
            'items.*.particluar'    => 'required',
            'items.*.gender'        => 'required',
            'items.*.working_hour'  => 'required',
            'items.*.qty'           => 'required',
            'items.*.rate'          => 'required',
        ];
    }
}
