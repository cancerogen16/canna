<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Action;
use App\Models\Master;
use App\Models\Service;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ServiceController extends Controller
{
    use ApiResponder;

    public function index(): JsonResponse
    {
        $services = Service::all();

        return $this->handleResponse([
            'services' => $services
        ]);
    }

    public function store(ServiceRequest $request): JsonResponse
    {
        try {
            $service = new Service($request->validated());

            if (Auth::user()->cannot('create', $service)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $service->save();

            return $this->handleResponse([
                'service' => $service
            ], 201);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            return $this->handleResponse([
                'service' => $service->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function update(ServiceRequest $request, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $data = $request->validated();

            if (Auth::user()->cannot('update', [$service, $data['salon_id']])) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $service->update($data);

            return $this->handleResponse([
                'service' => $service
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('delete', $service)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $service->delete();

            return $this->handleResponse([
                'service' => $service
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getMasters(int $id)
    {
        try {
            $service = Service::findOrFail($id);

            $masters = $service->masters()->get();

            return $this->handleResponse([
                'masters' => $masters,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getActions(int $id)
    {
        try {
            $service = Service::findOrFail($id);

            $actions = $service->actions()->get();

            return $this->handleResponse([
                'actions' => $actions,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function attachMaster(int $id, int $master_id)
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('editMasterConnection', [$service, $master_id])) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $master = Master::findOrFail($master_id);

            if ($service->salon_id == $master->salon_id) {
                $service->masters()->attach($master_id);
            } else {
                return $this->handleResponse([
                    'errors' => ['Услуга и мастер должны принадлежать одному салону']
                ]);
            }

            return $this->handleResponse([]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function attachAction(int $id, int $action_id)
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('editActionConnection', [$service, $action_id])) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $action = Action::findOrFail($action_id);

            if ($service->salon_id == $action->salon_id) {
                $service->actions()->attach($action_id);
            } else {
                return $this->handleResponse([
                    'errors' => ['Услуга и акция должны принадлежать одному салону']
                ]);
            }

            return $this->handleResponse([]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function detachMaster(int $id, int $master_id)
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('editMasterConnection', [$service, $master_id])) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $service->masters()->detach($master_id);

            return $this->handleResponse([]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function detachAction(int $id, int $action_id)
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('editActionConnection', [$service, $action_id])) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $service->actions()->detach($action_id);

            return $this->handleResponse([]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }
}
