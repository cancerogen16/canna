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
            $item['photo'] = $uploadService->getImage($item['photo'], 'large');

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
    public function show(int $id, ImageUploadService $uploadService): JsonResponse
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
    public function update(MasterRequest $request, int $id, ImageUploadService $uploadService): JsonResponse
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

            return $this->handleResponse([
                'master' => $master
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

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

    public function getServices(int $id)
    {
        try {
            $master = Master::findOrFail($id);

            $services = $master->services()->get();

            return $this->handleResponse([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getCalendars(int $id)
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

    public function getCalendarsForDay(int $id, string $day)
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

    public function getRecords(int $id)
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
