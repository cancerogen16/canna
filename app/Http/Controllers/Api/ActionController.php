<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Models\Action;
use App\Services\ImageUploadService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ActionController extends Controller
{
    use ApiResponder;

    /**
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function index(ImageUploadService $uploadService): JsonResponse
    {
        $actions = [];

        $actionsCollection = Action::all();

        foreach ($actionsCollection as $item) {
            $item['photo'] = $uploadService->getImage($item['photo'], 'medium');

            $actions[] = $item;
        }

        return $this->ok([
            'actions' => $actions
        ]);
    }

    /**
     * @param ActionRequest $request
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function store(ActionRequest $request, ImageUploadService $uploadService): JsonResponse
    {
        try {
            $action = new Action($request->validated());

            if (Auth::user()->cannot('create', $action)) {
                return $this->response(401, [], 'Нет доступа');
            }

            if (isset($action['photo'])) {
                if ($photo = $uploadService->upload($action['photo'])) {
                    $action['photo'] = $photo;
                }
            }

            $action->save();

            if (isset($action['photo'])) {
                $action['photo'] = $uploadService->getImage($action['photo'], 'large');
            }

            return $this->ok([
                'action' => $action
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
            $action = Action::findOrFail($id);

            $action['photo'] = $uploadService->getImage($action['photo'], 'large');

            return $this->ok([
                'action' => $action->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param ActionRequest $request
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function update(ActionRequest $request, ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $action = Action::findOrFail($id);

            $data = $request->validated();

            if (Auth::user()->cannot('update', [$action, $data['salon_id']])) {
                return $this->response(401, [], 'Нет доступа');
            }

            if (isset($action['photo'])) {
                if ($photo = $uploadService->upload($action['photo'])) {
                    $action['photo'] = $photo;
                }
            } else {
                $action['photo'] = null;
            }

            $action->update($data);

            if (isset($action['photo'])) {
                $action['photo'] = $uploadService->getImage($action['photo'], 'large');
            }

            return $this->ok([
                'action' => $action
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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

            if (Auth::user()->cannot('delete', $action)) {
                return $this->response(401, [], 'Нет доступа');
            }

            $action->delete();

            return $this->ok([
                'action' => $action
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
    public function getServices(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $action = Action::findOrFail($id);

            $services = [];

            $servicesCollection = $action->services()->get();

            foreach ($servicesCollection as $item) {
                $item['image'] = $uploadService->getImage($item['image'], 'thumbnail');

                $services[] = $item;
            }

            return $this->ok([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

}