<?php

namespace App\Http\Controllers\Api;

use App\Facades\ImageUpload;
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
        $actions = [];

        $actionsCollection = Action::all();

        foreach ($actionsCollection as $item) {
            $item['photo'] = ImageUpload::getImage($item['photo'], 'medium');

            $actions[] = $item;
        }

        return $this->ok([
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

            $this->authorize('create', $action);

            if (isset($action['photo'])) {
                if ($photo = ImageUpload::upload($action['photo'])) {
                    $action['photo'] = $photo;
                }
            }

            $action->save();

            if (isset($action['photo'])) {
                $action['photo'] = ImageUpload::getImage($action['photo'], 'large');
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
    public function show(int $id): JsonResponse
    {
        try {
            $action = Action::findOrFail($id);

            $action['photo'] = ImageUpload::getImage($action['photo'], 'large');

            return $this->ok([
                'action' => $action->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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

            $this->authorize('update', [$action, $data['salon_id']]);

            if (isset($action['photo'])) {
                if ($photo = ImageUpload::upload($action['photo'])) {
                    $action['photo'] = $photo;
                }
            } else {
                $action['photo'] = null;
            }

            $action->update($data);

            if (isset($action['photo'])) {
                $action['photo'] = ImageUpload::getImage($action['photo'], 'large');
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

            $this->authorize('delete', $action);

            $action->delete();

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
    public function services(int $id): JsonResponse
    {
        try {
            $action = Action::findOrFail($id);

            $services = $action->getServices('thumbnail');

            return $this->ok([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}