<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Models\Action;
use App\Traits\ApiResponder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class ActionController extends Controller
{
    use ApiResponder;

    public function index(): JsonResponse
    {
        $actions = Action::all();

        return $this->handleResponse($actions, 200);
    }

    public function store(ActionRequest $request): JsonResponse
    {
        try {
            $action = new Action($request->validated());

            $action->save();

            return $this->handleResponse($action, 201);
        } catch (QueryException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при создании акции'], 400);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $action = Action::findOrFail($id);

            return $this->handleResponse($action->toArray(), 200);
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при поиске акции'], 404);
        }
    }

    public function update(ActionRequest $request, int $id): JsonResponse
    {
        try {
            $action = Action::findOrFail($id);

            $data = $request->validated();

            $action->update($data);

            return $this->handleResponse($action, 'Updated');
        } catch (ModelNotFoundException | QueryException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при обновлении акции'], 404);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $action = Action::findOrFail($id);

            $action->delete();

            return $this->handleResponse($action, 'Deleted');
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при поиске акции'], 404);
        }
    }
}
