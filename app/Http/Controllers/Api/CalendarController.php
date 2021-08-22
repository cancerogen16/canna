<?php

namespace App\Http\Controllers\Api;

use App\Facades\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarRequest;
use App\Http\Requests\CalendarScheduleRequest;
use App\Http\Requests\CleanCalendarScheduleRequest;
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
        try {
            $calendars = Calendar::all();

            return $this->ok([
                'calendars' => $calendars,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
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

            $slotsByDays = Schedule::getSlotsByDays($fields); // массив слотов в новом расписании мастера, отсортированный по дням и часам

            if (!empty($slotsByDays)) {
                $master_id = (int)$fields['master_id']; // id мастера

                Schedule::fillCalendar($master_id, $slotsByDays);

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
