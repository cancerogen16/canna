<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:250',
            'salon_id' => 'required|integer|exists:salons,id',
            'slug' => 'nullable|regex:/^[a-z0-9-]+$/',
            'position' => 'required|string|max:191',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'experience' => 'nullable|string',
            'description' => 'nullable|string',
            'rating' => 'nullable|integer|between:0,5',
        ];
    }
}