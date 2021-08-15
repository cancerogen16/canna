<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CleanCalendarScheduleRequest extends FormRequest
{
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
