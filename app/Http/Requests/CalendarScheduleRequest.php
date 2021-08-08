<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarScheduleRequest extends FormRequest
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
            'dates' => 'required|array', // массив дат, на которые распространяется новое расписание
            'dates.*' => 'required|date_format:Y-m-d', // элемент массива дат
            'work_from' => 'required|integer|min:0|max:23', // время начала работы
            'work_to' => 'required|integer|min:1|max:24|gt:work_from', // время окончания работы
        ];
    }
}
