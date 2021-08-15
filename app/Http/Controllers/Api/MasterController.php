<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterRequest;
use App\Models\Master;
use App\Services\ImageUploadService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Throwable;

class MasterController extends Controller
{
    use ApiResponder;

    /**
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function index(ImageUploadService $uploadService): JsonResponse
    {
        $masters = [];

        $mastersCollection = Master::all();

        foreach ($mastersCollection as $item) {
            $item['photo'] = $uploadService->getImage($item['photo'], 'medium');

            $masters[] = $item;
        }

        return $this->ok([
            'masters' => $masters,
        ]);
    }

    /**
     * @param MasterRequest $request
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function store(MasterRequest $request, ImageUploadService $uploadService): JsonResponse
    {
        try {
            $master = new Master($request->validated());

            $this->authorize('create', $master);

            if (isset($master['photo'])) {
                if ($photo = $uploadService->upload($master['photo'])) {
                    $master['photo'] = $photo;
                }
            }

            $master->save();

            if (isset($master['photo'])) {
                $master['photo'] = $uploadService->getImage($master['photo'], 'large');
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
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function show(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $master['photo'] = $uploadService->getImage($master['photo'], 'large');

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
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function update(MasterRequest $request, ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $data = $request->validated();

            $this->authorize('update', [$master, $data['salon_id']]);

            if (isset($master['photo'])) {
                if ($photo = $uploadService->upload($master['photo'])) {
                    $master['photo'] = $photo;
                }
            } else {
                $master['photo'] = null;
            }

            $master->update($data);

            if (isset($master['photo'])) {
                $master['photo'] = $uploadService->getImage($master['photo'], 'large');
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
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function getServices(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $services = [];

            $servicesCollection = $master->services()->get();

            foreach ($servicesCollection as $item) {
                $item['image'] = $uploadService->getImage($item['image'], 'thumbnail');

                $services[] = $item;
            }

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
    public function getCalendars(int $id): JsonResponse
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
    public function getCalendarsForDay(int $id, string $day): JsonResponse
    {
        try {
            $validator = Validator::make(['day' => $day], ['day' => 'required|date_format:Y-m-d']);

            if ($validator->fails()) {
                return $this->response(401, $validator->messages());
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
    public function getRecords(int $id): JsonResponse
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
