<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;
use App\Models\Master;
use App\Models\Record;
use App\Models\Service;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Throwable;
use function PHPUnit\Framework\containsIdentical;

class RecordController extends Controller
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
            $this->authorize('viewAny', Record::class);

            $records = Record::all();

            return $this->ok([
                'records' => $records,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  RecordRequest  $request
     * @return JsonResponse
     */
    public function store(RecordRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $record = new Record($data);

            $this->authorize('create', $record);

            $service = $record->service()->first();

            if (!$service->masters->contains($data['master_id'])) {
                return $this->response(422, [], 'Мастер не оказывает запрашиваемую услугу');
            }

            $endDatetime = $service->getEndDatetime($data['start_datetime']);

            $master = Master::find($data['master_id']);

            $calendars = $master->calendars()
                ->whereBetween('start_datetime', [$data['start_datetime'], $endDatetime])
                ->where('record_id', null)
                ->get();

            if ($calendars->count() != $service->duration) {
                return $this->response(422, [], 'Свободных часов мастера недостаточно для записи на данную услугу в это время');
            }

            $record->save();

            foreach ($calendars as $calendar) {
                $calendar->record_id = $record->id;
                $calendar->save();
            }

            return $this->response(201, [
                'record' => $record,
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
            $record = Record::findOrFail($id);

            $this->authorize('view', $record);

            return $this->ok([
                'record' => $record->toArray(),
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  RecordRequest  $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(RecordRequest $request, int $id): JsonResponse
    {
        try {
            $record = Record::findOrFail($id);

            $data = $request->validated();

            $this->authorize('update', [$record, $data['user_id']]);

            $service = Service::findOrFail($data['service_id']);

            if (!$service->masters->contains($data['master_id'])) {
                return $this->response(422, [], 'Мастер не оказывает запрашиваемую услугу');
            }

            $endDatetime = $service->getEndDatetime($data['start_datetime']);

            $master = Master::find($data['master_id']);

            $slotsCount = $master->calendars()
                ->whereBetween('start_datetime', [$data['start_datetime'], $endDatetime])
                ->where(function ($query) use ($record) {
                    $query->where('record_id', null)
                        ->orWhere('record_id', $record->id);
                })
                ->count();

            if ($slotsCount != $service->duration) {
                return $this->response(422, [], 'Свободных часов мастера недостаточно для записи на данную услугу в это время');
            }

            $record->calendars()->update(['record_id' => null]);

            $record->update($data);

            $master->calendars()
                ->whereBetween('start_datetime', [$data['start_datetime'], $endDatetime])
                ->update(['record_id' => $record->id]);

            return $this->ok([
                'record' => $record,
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
            $record = Record::findOrFail($id);

            $this->authorize('delete', $record);

            $record->calendars()->update(['record_id' => null]);

            $record->delete();

            return $this->ok([
                'record' => $record,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function сalendars(int $id): JsonResponse
    {
        try {
            $record = Record::findOrFail($id);

            $this->authorize('view', $record);

            $calendars = $record->calendars()->get();

            return $this->ok([
                'calendars' => $calendars,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}
