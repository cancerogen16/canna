<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Action;
use App\Models\Master;
use App\Models\Service;
use App\Services\ImageUploadService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ServiceController extends Controller
{
    use ApiResponder;

    /**
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function index(ImageUploadService $uploadService): JsonResponse
    {
        $services = [];

        $servicesCollection = Service::all();

        foreach ($servicesCollection as $item) {
            $item['image'] = $uploadService->getImage($item['image'], 'medium');

            $services[] = $item;
        }

        return $this->ok([
            'services' => $services
        ]);
    }

    /**
     * @param ServiceRequest $request
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function store(ServiceRequest $request, ImageUploadService $uploadService): JsonResponse
    {
        try {
            $service = new Service($request->validated());

            if (Auth::user()->cannot('create', $service)) {
                return $this->response(401, [], 'Нет доступа');
            }

            if (isset($service['image'])) {
                if ($photo = $uploadService->upload($service['image'])) {
                    $service['image'] = $photo;
                }
            }

            $service->save();

            if (isset($service['image'])) {
                $service['image'] = $uploadService->getImage($service['image'], 'large');
            }

            return $this->response(201, [
                'service' => $service
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function show(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $service['image'] = $uploadService->getImage($service['image'], 'large');

            return $this->ok([
                'service' => $service->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param ServiceRequest $request
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function update(ServiceRequest $request, ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $data = $request->validated();

            if (Auth::user()->cannot('update', [$service, $data['salon_id']])) {
                return $this->response(401, [], 'Нет доступа');
            }

            if (isset($service['image'])) {
                if ($photo = $uploadService->upload($service['image'])) {
                    $service['image'] = $photo;
                }
            } else {
                $service['image'] = null;
            }

            $service->update($data);

            if (isset($service['image'])) {
                $service['image'] = $uploadService->getImage($service['image'], 'large');
            }

            return $this->ok([
                'service' => $service
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('delete', $service)) {
                return $this->response(401, [], 'Нет доступа');
            }

            $service->delete();

            return $this->ok([
                'service' => $service
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function getMasters(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $masters = [];

            $mastersCollection = $service->masters()->get();

            foreach ($mastersCollection as $item) {
                $item['photo'] = $uploadService->getImage($item['photo'], 'thumbnail');

                $masters[] = $item;
            }

            return $this->ok([
                'masters' => $masters,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function getActions(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $actions = [];

            $actionsCollection = $service->actions()->get();

            foreach ($actionsCollection as $item) {
                $item['photo'] = $uploadService->getImage($item['photo'], 'medium');

                $actions[] = $item;
            }

            return $this->ok([
                'actions' => $actions,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param int $master_id
     * @return JsonResponse
     */
    public function attachMaster(int $id, int $master_id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('editMasterConnection', [$service, $master_id])) {
                return $this->response(401, [], 'Нет доступа');
            }

            $master = Master::findOrFail($master_id);

            if ($service->salon_id == $master->salon_id) {
                $service->masters()->attach($master_id);
            } else {
                return $this->response(422, [], 'Услуга и мастер должны принадлежать одному салону');
            }

            return $this->ok();
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param int $action_id
     * @return JsonResponse
     */
    public function attachAction(int $id, int $action_id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('editActionConnection', [$service, $action_id])) {
                return $this->response(401, [], 'Нет доступа');
            }

            $action = Action::findOrFail($action_id);

            if ($service->salon_id == $action->salon_id) {
                $service->actions()->attach($action_id);
            } else {
                return $this->response(422, [], 'Услуга и мастер должны принадлежать одному салону');
            }

            return $this->ok();
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param int $master_id
     * @return JsonResponse
     */
    public function detachMaster(int $id, int $master_id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('editMasterConnection', [$service, $master_id])) {
                return $this->response(401, [], 'Нет доступа');
            }

            $service->masters()->detach($master_id);

            return $this->ok();
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param int $action_id
     * @return JsonResponse
     */
    public function detachAction(int $id, int $action_id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            if (Auth::user()->cannot('editActionConnection', [$service, $action_id])) {
                return $this->response(401, [], 'Нет доступа');
            }

            $service->actions()->detach($action_id);

            return $this->ok();
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}
