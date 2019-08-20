<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTender extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'details.*.title' => 'required|alpha',
            'details.*.items' => 'required',
            'details.*.items.*.description' => 'required',
            'details.*.duration' => 'required',
            'status' => 'required|in:proposed,assigned,terminated',
            'expiry' => 'required|date'
        ];
    }
}
