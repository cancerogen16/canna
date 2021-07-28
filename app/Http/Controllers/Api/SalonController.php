<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SalonRequest;
use Throwable;

class SalonController extends Controller
{
    use ApiResponder;

    public function index(): JsonResponse
    {
        $data = Salon::all();

        return $this->handleResponse($data);
    }

    public function store(SalonRequest $request): JsonResponse
    {
        try {
            $salon = new Salon($request->validated());

            $salon->save();

            return $this->handleResponse($salon, 201);

        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            return $this->handleResponse($salon->toArray());
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function update(SalonRequest $request, int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $data = $request->validated();

            $salon->update($data);

            return $this->handleResponse($salon);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $salon->delete();

            return $this->handleResponse($salon);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }
}