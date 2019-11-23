<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
{
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
            'details' => 'required',
            'details.*.amount' => 'required|alpha_num',
            'details.*.description' => 'required|regex:/^[a-zA-Z0-9,.\-\s]+$/',
            'supplier_id' => 'required|exists:suppliers,id|belongsTo:tender_id',
            'tender_id' => 'required|exists:tenders,id',
        ];
    }
}
