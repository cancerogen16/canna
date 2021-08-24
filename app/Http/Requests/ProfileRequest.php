<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'nullable|string|min:3|max:250',
            'photo' => 'nullable|string',
            'address' => 'nullable|string|min:4|max:300',
            'phone' => 'nullable|string|between:10,15',
            'about' => 'nullable|string|min:4|max:300',
        ];
    }
}
