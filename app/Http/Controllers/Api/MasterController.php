<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterRequest;
use App\Models\Master;
use App\Services\ImageUploadService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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

        return $this->handleResponse([
            'masters' => $masters
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

            if (Auth::user()->cannot('create', $master)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            if (isset($master['photo'])) {
                if ($photo = $uploadService->upload($master['photo'])) {
                    $master['photo'] = $photo;
                }
            }

            $master->save();

            if (isset($master['photo'])) {
                $master['photo'] = $uploadService->getImage($master['photo'], 'large');
            }

            return $this->handleResponse([
                'master' => $master
            ], 201);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            return $this->handleResponse([
                'master' => $master->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            if (Auth::user()->cannot('update', [$master, $data['salon_id']])) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

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

            return $this->handleResponse([
                'master' => $master
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            if (Auth::user()->cannot('delete', $master)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $master->delete();

            return $this->handleResponse([
                'master' => $master
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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
                $item['image'] = $uploadService->getImage($item['image'], 'medium');

                $services[] = $item;
            }

            return $this->handleResponse([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            return $this->handleResponse([
                'calendars' => $calendars,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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
                return $this->handleResponse([
                    'errors' => $validator->messages(),
                ]);
            }

            $master = Master::findOrFail($id);

            $calendars = $master->calendars()->whereDate('start_datetime', $day)->get();

            return $this->handleResponse([
                'calendars' => $calendars,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            if (Auth::user()->cannot('viewRecords', $master)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $calendars = $master->calendars()->get();

            $records = [];

            foreach ($calendars as $calendar) {
                $record = $calendar->record()->get();
                $records[] = $record;
            }

            return $this->handleResponse([
                'records' => $records,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }
}
