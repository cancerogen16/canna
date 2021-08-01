<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionRequest extends FormRequest
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
        if ($this->getMethod() != 'GET') {
            return [
                'service_id' => 'required|integer|exists:services,id',
                'name' => 'required|between:3,191',
                'photo' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|integer|between:0,999999',
                'start_at' => 'required|date_format:Y-m-d H:i:s',
                'end_at' => 'required|date_format:Y-m-d H:i:s|after:start_at',
            ];
        } else {
            return [];
        }
    }
}
