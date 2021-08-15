<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalonSearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city' => 'required|min:3|max:250',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }
}
