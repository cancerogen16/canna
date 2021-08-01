<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                'category_id' => 'required|integer|exists:categories,id',
                'salon_id' => 'required|integer|exists:salons,id',
                'title' => 'required|between:3,191',
                'slug' => 'nullable|regex:/^[a-z0-9-]+$/',
                'price' => 'required|integer|between:0,999999',
                'duration' => 'required|integer|between:1,10',
                'image' => 'nullable|string|max:255',
                'excerpt' => 'nullable|string',
                'description' => 'nullable|string',
            ];
        } else {
            return [];
        }
    }
}
