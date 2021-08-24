<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'salon_id' => 'required|integer|exists:salons,id',
            'name' => 'required|between:3,191',
            'photo' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|integer|between:0,999999',
            'start_at' => 'required|date_format:Y-m-d H:i:s',
            'end_at' => 'required|date_format:Y-m-d H:i:s|after:start_at',

        ];
    }
}
