<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:250',
            'salon_id' => 'required|integer|exists:salons,id',
            'slug' => 'nullable|regex:/^[a-z0-9-]+$/',
            'position' => 'required|string|max:191',
            'photo' => 'nullable|string',
            'experience' => 'nullable|string',
            'description' => 'nullable|string',
            'rating' => 'nullable|integer|between:0,5',
        ];
    }
}