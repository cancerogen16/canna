<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarRequest;
use App\Models\Calendar;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @param  CalendarRequest  $request
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
     * @param  int  $id
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
     * @param  CalendarRequest  $request
     * @param  int  $id
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
     * @param  int  $id
     * @return JsonResponse
     */
    public function delete(int $id)
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
}
