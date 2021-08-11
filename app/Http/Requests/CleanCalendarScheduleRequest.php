<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CleanCalendarScheduleRequest extends FormRequest
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
            'master_id' => 'required|integer|exists:masters,id',
            'dates' => 'required|array', // массив дат, на которые распространяется удаление календаря
            'dates.*' => 'required|date_format:Y-m-d', // элемент массива дат
        ];
    }
}
