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
        if ($this->getMethod() != 'GET') {
            return [
                'name' => 'required|string|min:3|max:250',
                'salon_id' => 'required|integer|exists:salons,id',
                'slug' => 'nullable|regex:/^[a-z0-9-]+$/',
                'photo' => 'nullable|string|max:255',
                'experience' => 'nullable|string',
                'description' => 'nullable|string',
                'rating' => 'required|integer|between:0,9',
            ];
        } else {
            return [];
        }
    }
}