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
        return [
            'main_photo' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'city' => 'required|min:3|max:250',
            'address' => 'required|string|min:4|max:300',
            'phone' => 'required|integer|min:6',
            'worktime' => 'required|integer|min:6',
            'description' => 'required|string|min:4|max:300',
        ];
    }
}