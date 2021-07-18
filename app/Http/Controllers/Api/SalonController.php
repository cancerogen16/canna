<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use App\Traits\ApiResponder;
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
        $salon = new Salon($request->validated());

        $salon->save();

        if ($salon) {
            return $this->handleResponse($salon, 201);

        } else {
            return $this->handleError('Ошибка при добавлении салона', [], 404);
        }

    }


    public function show($id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            return $this->handleResponse($salon->toArray());
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e, ['Ошибка при поиске салона'], 404);
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
            return $this->handleError($e, ['Ошибка при поиске салона'], 404);
        }
    }


    public function delete($id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $salon->delete();

            return $this->handleResponse($salon, 'Deleted');
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e, ['Ошибка при удалении салона'], 404);
        }
    }
}