<?php

namespace App\Http\Controllers\Api;

use App\Facades\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Action;
use App\Models\Master;
use App\Models\Service;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Throwable;

class ServiceController extends Controller
{
    use ApiResponder;

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $services = [];

            $servicesCollection = Service::all();

            foreach ($servicesCollection as $item) {
                $item['thumb'] = ImageUpload::getImage($item['image'], 'medium');

                $services[] = $item;
            }

            return $this->ok([
                'services' => $services
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param ServiceRequest $request
     * @return JsonResponse
     */
    public function store(ServiceRequest $request): JsonResponse
    {
        try {
            $service = new Service($request->validated());

            $this->authorize('create', $service);

            $service->save();

            if (isset($service['image'])) {
                $service['thumb'] = ImageUpload::getImage($service['image'], 'thumbnail');
            }

            return $this->response(201, [
                'service' => $service
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            if (isset($service['image'])) {
                $service['thumb'] = ImageUpload::getImage($service['image'], 'large');
            }

            return $this->ok([
                'service' => $service->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param ServiceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ServiceRequest $request, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $data = $request->validated();

            $this->authorize('update', [$service, $data['salon_id']]);

            $service->update($data);

            if (isset($service['image'])) {
                $service['thumb'] = ImageUpload::getImage($service['image'], 'thumbnail');
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

            $this->authorize('delete', $service);

            $service->delete();

            return $this->ok([
                'service' => $service
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function masters(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $masters = $service->getMasters('thumbnail');

            return $this->ok([
                'masters' => $masters,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function actions(int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $actions = $service->getActions('medium');

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

            $this->authorize('editMasterConnection', [$service, $master_id]);

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

            $this->authorize('editActionConnection', [$service, $action_id]);

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

            $this->authorize('editMasterConnection', [$service, $master_id]);

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

            $this->authorize('editActionConnection', [$service, $action_id]);

            $service->actions()->detach($action_id);

            return $this->ok();
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}
