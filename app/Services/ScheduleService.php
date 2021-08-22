<?php

namespace App\Services;

use App\Models\Calendar;

class ScheduleService
{
    /**
     * Получение массива слотов в новом расписании мастера, отсортированного по дням и часам
     *
     * @param array $fields
     * @return array
     */
    public function getSlotsByDays(array $fields): array
    {
        $work_from = (int)$fields['work_from']; // время начала работы
        $work_to = (int)$fields['work_to']; // время окончания работы
        $dates = $fields['dates']; // массив дат, на которые распространяется новое расписание
        $master_id = (int)$fields['master_id']; // id мастера

        $slotsByDays = []; // массив слотов в новом расписании мастера, отсортированный по дням и часам

        foreach ($dates as $date) {
            for ($time = $work_from; $time < $work_to; $time++) {
                $slotTime = strlen($time) === 1 ? ('0' . $time) : (string)$time; // часы в 2 разряда

                $slotsByDays[$date][$time] = [
                    'master_id' => $master_id,
                    'record_id' => null,
                    'start_datetime' => $date . ' ' . $slotTime . ':00:00',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        return $slotsByDays;
    }

    /**
     * Включение в новое расписание имеющихся записей
     *
     * @param array $schedules
     * @param array $slots
     * @return array
     */
    public function includeRecords(array $schedules, array &$slots): array
    {
        foreach ($schedules as $schedule) {
            $time = date('H', strtotime($schedule['start_datetime'])); // время начала слота

            if ($schedule['record_id'] && array_key_exists($time, $slots)) { // если была запись на очередной слот
                $slots[$time]['record_id'] = $schedule['record_id'];
            }
        }

        return $slots;
    }

    /**
     * Заполнение календаря мастера в базе
     *
     * @param int $master_id
     * @param array $slotsByDays
     */
    public function fillCalendar(int $master_id, array $slotsByDays)
    {
        $schedules = Calendar::where('master_id', $master_id)->get(); // текущее расписание мастера в базе

        if ($schedules->isEmpty()) { // если расписания ещё нет
            foreach ($slotsByDays as $date => $slots) {
                Calendar::insert($slots); // пишем в базу слоты очередного дня
            }
        } else {
            foreach ($slotsByDays as $date => $slots) {
                $schedules = Calendar::where('master_id', $master_id)
                    ->where('start_datetime', 'like', $date . '%')
                    ->get(); // расписание мастера в базе на очередной день

                if (!$schedules->isEmpty()) { // если на очередной день есть записи
                    $slots = $this->includeRecords($schedules->toArray(), $slots);
                }

                Calendar::where('master_id', $master_id)
                    ->where('start_datetime', 'like', $date . '%')
                    ->delete(); // удаление расписания мастера на очередную дату

                Calendar::insert($slots); // сохранение в базу заданных слотов
            }
        }
    }
}