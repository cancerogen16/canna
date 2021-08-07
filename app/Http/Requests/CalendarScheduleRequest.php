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
            'record_id' => 'nullable|integer|exists:records,id',
            'dates' => 'required|array', // массив дат, на которые распространяется новое расписание
            'work_from' => 'required|string|min:1|max:2', // время начала работы
            'work_to' => 'required|string|min:1|max:2', // время окончания работы
        ];
    }
}
