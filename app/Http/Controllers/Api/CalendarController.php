<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarRequest;
use App\Http\Requests\CalendarScheduleRequest;
use App\Http\Requests\CleanCalendarScheduleRequest;
use App\Models\Calendar;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CalendarController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $calendars = Calendar::all();

        return $this->ok([
            'calendars' => $calendars,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CalendarRequest $request
     * @return JsonResponse
     */
    public function store(CalendarRequest $request): JsonResponse
    {
        try {
            $calendar = new Calendar($request->validated());

            $this->authorize('create', $calendar);

            $calendar->save();

            return $this->response(201, [
                'calendar' => $calendar,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $calendar = Calendar::findOrFail($id);

            return $this->ok([
                'calendar' => $calendar->toArray(),
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CalendarRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CalendarRequest $request, int $id): JsonResponse
    {
        try {
            $calendar = Calendar::findOrFail($id);

            $data = $request->validated();

            $this->authorize('update', [$calendar, $data['master_id']]);

            $calendar->update($data);

            return $this->ok([
                'calendar' => $calendar,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $calendar = Calendar::findOrFail($id);

            $this->authorize('delete', $calendar);

            $calendar->delete();

            return $this->ok([
                'calendar' => $calendar,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

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

    /**
     * Сохранение в базу нового расписания для мастера
     *
     * @param CalendarScheduleRequest $request
     * @return JsonResponse
     */
    public function schedule(CalendarScheduleRequest $request): JsonResponse
    {
        try {
            $fields = $request->input();

            $this->authorize('editSchedule', [Calendar::class, $fields['master_id']]);

            $slotsByDays = $this->getSlotsByDays($fields); // массив слотов в новом расписании мастера, отсортированный по дням и часам

            if (!empty($slotsByDays)) {
                $master_id = (int)$fields['master_id']; // id мастера

                $this->fillCalendar($master_id, $slotsByDays);

                return $this->ok();
            } else {
                return $this->response(422, [], 'Нет слотов для записи');
            }
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * Удаление из базы расписания на запрошенные дни
     *
     * @param CleanCalendarScheduleRequest $request
     * @return JsonResponse
     */
    public function cleanSchedule(CleanCalendarScheduleRequest $request): JsonResponse
    {
        try {
            $fields = $request->input();

            $this->authorize('editSchedule', [Calendar::class, $fields['master_id']]);

            $dates = $fields['dates'];
            $master_id = $fields['master_id'];

            if (!empty($dates)) {
                foreach ($dates as $date) {
                    Calendar::where('master_id', $master_id)
                        ->where('start_datetime', 'like', $date . '%')
                        ->delete();
                }
                return $this->ok();
            } else {
                return $this->response(422, [], 'Нет календаря на указанные дни');
            }
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}
