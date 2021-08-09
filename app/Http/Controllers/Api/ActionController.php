<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Models\Action;
use App\Services\ImageUploadService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Throwable;

class ActionController extends Controller
{
    use ApiResponder;

    /**
     * @param ImageUploadService $
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

        return $this->handleResponse([
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

            if (isset($action['photo'])) {
                if ($photo = $uploadService->upload($action['photo'])) {
                    $action['photo'] = $photo;
                }
            }

            $action->save();

            if (isset($action['photo'])) {
                $action['photo'] = $uploadService->getImage($action['photo'], 'large');
            }

            return $this->handleResponse([
                'action' => $action
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            return $this->handleResponse([
                'action' => $action->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
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

            return $this->handleResponse([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

}