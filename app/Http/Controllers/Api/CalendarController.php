<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarRequest;
use App\Models\Calendar;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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
     * Schedule resource in storage.
     *
     * @param CalendarRequest $request
     * @return JsonResponse
     */
    public function schedule(CalendarRequest $request): JsonResponse
    {
        try {
            $fields = $request->input();

            $work_from = (int)$fields['work_from'];
            $work_to = (int)$fields['work_to'];
            $dates = $fields['dates'];
            $master_id = $fields['master_id'];

            $slotsByDays = [];

            if (!empty($dates) && ($work_to > $work_from)) {
                foreach ($dates as $date) {
                    for ($time = $work_from; $time < $work_to; $time++) {
                        $slotTime = strlen($time) == 1 ? strval('0' . $time) : strval($time);

                        $slotsByDays[$date][] = [
                            'master_id' => $fields['master_id'],
                            'start_datetime' => $date . ' ' . $slotTime . ':00:00',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                }

                if (!empty($slotsByDays)) {
                    $schedules = Calendar::where('master_id', $master_id)->get();

                    if ($schedules->isEmpty()) {
                        foreach ($slotsByDays as $day => $slots) {
                            Calendar::insert($slots);
                        }
                    } else {
                        foreach ($slotsByDays as $day => $slots) {
                            foreach ($schedules as $schedule) {
                                if (stripos($schedule['start_datetime'], $day) !== false) {
                                    DB::table('calendars')->delete($schedule['id']);
                                }
                            }

                            Calendar::insert($slots);
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
