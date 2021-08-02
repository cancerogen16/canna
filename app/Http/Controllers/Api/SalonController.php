<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalonSearchRequest;
use App\Models\Salon;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SalonRequest;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SalonController extends Controller
{
    use ApiResponder;

    public function index(): JsonResponse
    {
        $salons = Salon::all();

        return $this->handleResponse([
            'salons' => $salons
        ]);
    }

    public function store(SalonRequest $request): JsonResponse
    {
        try {
            $salon = new Salon($request->validated());

            if (Auth::user()->cannot('create', $salon)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $salon->save();

            return $this->handleResponse([
                'salon' => $salon
            ], 201);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            return $this->handleResponse([
                'salon' => $salon->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function update(SalonRequest $request, int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $data = $request->validated();

            if (Auth::user()->cannot('update', [$salon, $data['user_id']])) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $salon->update($data);

            return $this->handleResponse([
                'salon' => $salon
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            if (Auth::user()->cannot('delete', $salon)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $salon->delete();

            return $this->handleResponse([
                'salon' => $salon
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function search(SalonSearchRequest $request)
    {
        $result = [];

        $salons = Salon::where('city', $request->input('city'))->get();

        foreach ($salons as $salon) {
            if ($salon->services()->where('category_id', $request->input('category_id'))->get()) {
                $result[] = $salon;
            }
        }

        return $this->handleResponse([
            'salons' => $result,
        ]);

    }

    public function getMasters(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $masters = $salon->masters()->get();

            return $this->handleResponse([
                'masters' => $masters,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getServices(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $services = $salon->services()->get();

            return $this->handleResponse([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getActions(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $services = $salon->services()->get();

            $actions = [];

            foreach ($services as $service) {
                foreach ($service->actions()->get() as $action) {
                    $actions[] = $action;
                }
            }

            return $this->handleResponse([
                'actions' => $actions,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getRecords(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            if (Auth::user()->cannot('viewRecords', $salon)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $services = $salon->services()->get();

            $records = [];

            foreach ($services as $service) {
                foreach ($service->records()->get() as $record) {
                    $records[] = $record;
                }
            }

            return $this->handleResponse([
                'records' => $records,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }
}