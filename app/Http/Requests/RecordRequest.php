<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'service_id' => 'required|integer|exists:services,id',
            'master_id' => 'required|integer|exists:masters,id',
            'start_datetime' => 'required|date_format:Y-m-d H',
            'name' => 'required|string|between:3,191',
            'phone' => 'required|string|between:10,15',
            'comment' => 'nullable|string',
        ];
    }
}
