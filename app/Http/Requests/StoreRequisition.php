<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequisition extends FormRequest
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
            'department_id' => 'required|exists:departments,id',
            'order_id' => 'sometimes|exists:orders,id',
            'items' => 'required',
            'items.*.name' => 'required|alpha|max:255',
            'items.*.amount' => 'required',
            'status' => 'required|alpha|in:waiting,rejected,approved,assigned,delivered',
        ];
    }
}
