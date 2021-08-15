<?php

namespace App\Http\Controllers\Api;

use App\Facades\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterRequest;
use App\Models\Master;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Throwable;

class MasterController extends Controller
{
    use ApiResponder;

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $masters = [];

        $mastersCollection = Master::all();

        foreach ($mastersCollection as $item) {
            $item['photo'] = ImageUpload::getImage($item['photo'], 'medium');

            $masters[] = $item;
        }

        return $this->ok([
            'masters' => $masters,
        ]);
    }

    /**
     * @param MasterRequest $request
     * @return JsonResponse
     */
    public function store(MasterRequest $request): JsonResponse
    {
        try {
            $master = new Master($request->validated());

            $this->authorize('create', $master);

            if (isset($master['photo'])) {
                if ($photo = ImageUpload::upload($master['photo'])) {
                    $master['photo'] = $photo;
                }
            }

            $master->save();

            if (isset($master['photo'])) {
                $master['photo'] = ImageUpload::getImage($master['photo'], 'large');
            }

            return $this->response(201, [
                'master' => $master
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $master['photo'] = ImageUpload::getImage($master['photo'], 'large');

            return $this->ok([
                'master' => $master->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param MasterRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(MasterRequest $request, int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $data = $request->validated();

            $this->authorize('update', [$master, $data['salon_id']]);

            if (isset($master['photo'])) {
                if ($photo = ImageUpload::upload($master['photo'])) {
                    $master['photo'] = $photo;
                }
            } else {
                $master['photo'] = null;
            }

            $master->update($data);

            if (isset($master['photo'])) {
                $master['photo'] = ImageUpload::getImage($master['photo'], 'large');
            }

            return $this->ok([
                'master' => $master->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $this->authorize('delete', $master);

            $master->delete();

            return $this->ok([
                'master' => $master->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function services(int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $services = $master->getServices('thumbnail');

            return $this->ok([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function calendars(int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $calendars = $master->calendars()->get();

            return $this->ok([
                'calendars' => $calendars,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param string $day
     * @return JsonResponse
     */
    public function calendarsForDay(int $id, string $day): JsonResponse
    {
        try {
            $validator = Validator::make(['day' => $day], [
                'day' => 'required|date_format:Y-m-d'
            ]);

            if ($validator->fails()) {
                return $this->response(401, $validator->messages()->toArray());
            }

            $master = Master::findOrFail($id);

            $calendars = $master->calendars()->whereDate('start_datetime', $day)->get();

            return $this->ok([
                'calendars' => $calendars,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function records(int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $this->authorize('viewRecords', $master);

            $calendars = $master->calendars()->get();

            $records = [];

            foreach ($calendars as $calendar) {
                $record = $calendar->record()->get();
                $records[] = $record;
            }

            return $this->ok([
                'records' => $records,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}
