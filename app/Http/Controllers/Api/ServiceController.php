<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Throwable;

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
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            return $this->handleResponse($service->toArray());
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function update(ServiceRequest $request, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $data = $request->validated();

            $service->update($data);

            return $this->handleResponse($service);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $service->delete();

            return $this->handleResponse($service);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }
}
