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

    public function index(): JsonResponse
    {
        $masters = Master::all();

        return $this->handleResponse([
            'masters' => $masters
        ]);
    }

    public function store(MasterRequest $request, ImageUploadService $uploadService): JsonResponse
    {
        try {
            $master = new Master($request->validated());

            if (Auth::user()->cannot('create', $master)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $photo = $uploadService->upload($request, 'photo');

            if ($photo) {
                $master['photo'] = $photo;
            }

            $master->save();

            return $this->handleResponse([
                'master' => $master
            ], 201);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            return $this->handleResponse([
                'master' => $master->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function update(MasterRequest $request, int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $data = $request->validated();

            if (Auth::user()->cannot('update', [$master, $data['salon_id']])) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
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
