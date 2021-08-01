<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalonRequest extends FormRequest
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
                'user_id' => 'required|integer|exists:users,id',
                'title' => 'required|between:3,191',
                'slug' => 'nullable|regex:/^[a-z0-9-]+$/',
                'main_photo' => 'nullable|string|max:255',
                'city' => 'required|string|min:3|max:250',
                'address' => 'required|string|min:4|max:300',
                'phone' => 'required|string|between:10,15',
                'description' => 'required|string|min:4|max:300',
                'rating' => 'nullable|integer|between:0,5',
            ];
        } else {
            return [];
        }
    }
}