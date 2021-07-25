<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Traits\ApiResponder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    use ApiResponder;

    public function index(): JsonResponse
    {
        $services = Service::all();

        return $this->handleResponse($services);
    }

    public function store(ServiceRequest $request): JsonResponse
    {
        try {
            $service = new Service($request->validated());

            $service->save();

            return $this->handleResponse($service, 201);
        } catch (QueryException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при добавлении услуги']);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            return $this->handleResponse($service->toArray(), 200);
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при поиске услуги']);
        }
    }

    public function update(ServiceRequest $request, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $data = $request->validated();

            $service->update($data);

            return $this->handleResponse($service, 'Updated');
        } catch (ModelNotFoundException | QueryException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при обновлении услуги']);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $service->delete();

            return $this->handleResponse($service, 'Deleted');
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при посике услуги']);
        }
    }
}
