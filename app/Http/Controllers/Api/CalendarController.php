<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarRequest;
use App\Http\Requests\CalendarScheduleRequest;
use App\Models\Calendar;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
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

        return $this->handleResponse([
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

            $calendar->save();

            return $this->handleResponse([
                'calendar' => $calendar,
            ], 201);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            return $this->handleResponse([
                'calendar' => $calendar->toArray(),
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            $calendar->update($data);

            return $this->handleResponse([
                'calendar' => $calendar,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            $calendar->delete();

            return $this->handleResponse([
                'calendar' => $calendar,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            $work_from = (int)$fields['work_from']; // время начала работы
            $work_to = (int)$fields['work_to']; // время окончания работы
            $dates = $fields['dates']; // массив дат, на которые распространяется новое расписание
            $master_id = $fields['master_id']; // id мастера

            $slotsByDays = []; // массив слотов в новом расписании мастера, отсортированный по дням и часам

            if (!empty($dates) && ($work_to > $work_from)) {
                foreach ($dates as $date) {
                    for ($time = $work_from; $time < $work_to; $time++) {
                        $slotTime = strlen($time) == 1 ? strval('0' . $time) : strval($time); // часы в 2 разряда

                        $slotsByDays[$date][$time] = [
                            'master_id' => $master_id,
                            'record_id' => null,
                            'start_datetime' => $date . ' ' . $slotTime . ':00:00',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                }

                if (!empty($slotsByDays)) {
                    $schedules = Calendar::where('master_id', $master_id)->get(); // текущее расписание мастера в базе

                    if ($schedules->isEmpty()) { // если расписания ещё нет
                        foreach ($slotsByDays as $date => $slots) {
                            Calendar::insert($slots); // пишем в базу слоты очередного дня
                        }
                    } else {
                        foreach ($slotsByDays as $date => $slots) {
                            $schedules = Calendar::where('master_id', $master_id)
                                ->where('start_datetime', 'like', $date . '%')->get(); // расписание мастера в базе на очередной день

                            if (!empty($schedules)) {
                                foreach ($schedules as $schedule) {
                                    $time = date('H', strtotime($schedule['start_datetime'])); // время начала слота

                                    if ($schedule['record_id'] && array_key_exists($time, $slots)) { // если была запись на очередной слот
                                        $slots[$time]['record_id'] = $schedule['record_id'];
                                    }
                                }
                            }

                            Calendar::where('master_id', $master_id)
                                ->where('start_datetime', 'like', $date . '%')->delete(); // удаление расписания мастера на очередную дату

                            Calendar::insert($slots); // сохранение в базу заданных слотов
                        }
                    }

                    return $this->handleResponse([]);
                } else {
                    return $this->handleResponse([
                        'errors' => ['Нет слотов для записи']
                    ]);
                }
            }
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }
}
