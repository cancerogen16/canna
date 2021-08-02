<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Models\Action;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Throwable;

class ActionController extends Controller
{
    use ApiResponder;

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $actions = Action::all();

        return $this->handleResponse([
            'actions' => $actions
        ]);
    }

    /**
     * @param ActionRequest $request
     * @return JsonResponse
     */
    public function store(ActionRequest $request): JsonResponse
    {
        try {
            $action = new Action($request->validated());

            $action->save();

            return $this->handleResponse([
                'action' => $action
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $action = Action::findOrFail($id);

            return $this->handleResponse([
                'action' => $action->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * @param ActionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ActionRequest $request, int $id): JsonResponse
    {
        try {
            $action = Action::findOrFail($id);

            $data = $request->validated();

            $action->update($data);

            return $this->handleResponse([
                'action' => $action
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
            $action = Action::findOrFail($id);

            $action->delete();

            return $this->handleResponse([
                'action' => $action
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }


    public function getServices(int $id)
    {
        try {
            $action = Action::findOrFail($id);

            $services = $action->services()->get();

            return $this->handleResponse([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

}