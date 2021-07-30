<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarRequest extends FormRequest
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
        return [
            'master_id' => 'required|integer|exists:masters,id',
            'record_id' => 'nullable|integer|exists:records,id',
            'start_datetime' => 'required|date_format:Y-m-d H',
        ];
    }
}
