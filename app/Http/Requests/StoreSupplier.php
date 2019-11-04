<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplier extends FormRequest
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
            'contacts' => 'required',
            'contacts.*.telephone' => 'required,',
            'contacts.*.address' => 'required|alpha',
            'account' => 'required',
            'account.type' => 'required|alpha',
            'account.number' => 'required|numeric',
            'account.name' => 'required|alpha',
            'account.expirationDate' => 'required|date|after:tomorrow',
            'user_id' => 'required|exists:users,id',
            'tender_id' => 'required|exists:tenders,id',
        ];
    }
}
