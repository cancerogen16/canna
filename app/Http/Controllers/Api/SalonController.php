<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use App\Traits\ApiResponder;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\SalonRequest;

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

            return $this->handleResponse($salon, 'Salon created', 201);

        } catch (QueryException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при добавлении салона']);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            return $this->handleResponse($salon->toArray());
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при поиске салона']);
        }
    }

    public function update(SalonRequest $request, int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $data = $request->validated();

            $salon->update($data);

            return $this->handleResponse($salon, 'Updated');
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при изменении салона']);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $salon->delete();

            return $this->handleResponse($salon, 'Deleted');
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при удалении салона']);
        }
    }
}