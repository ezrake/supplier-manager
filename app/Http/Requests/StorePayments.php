<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayments extends FormRequest
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
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'transaction_details.bank_account' => 'required|numeric',
            'transaction_details.authorised_by' => 'required|regex:/^[a-zA-Z0-9.\-\s]+$/',
            'transaction_details.type' => 'required|alpha',
        ];
    }
}
