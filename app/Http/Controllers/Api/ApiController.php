<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

abstract class ApiController extends Controller
{
    use ApiResponder;

    protected $model;

    public function index(): JsonResponse
    {
        $result = $this->model->all();

        return $this->ok(null, $result->toArray());
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $this->model->fill($data)->push();

            return $this->response(201, 'Created');
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show(int $entityId)
    {
        try {
            $entity = $this->model->find($entityId)->first();

            if (!$entity) {
                return $this->notFound();
            }

            return $this->ok(null, $entity->toArray());
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(int $entityId, Request $request)
    {
        try {
            $entity = $this->model->find($entityId)->first();

            if (!$entity) {
                return $this->notFound();
            }

            $data = $request->validated();

            $this->model->fill($data)->push();

            return $this->response(204, 'Updated');
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(int $entityId)
    {
        try {
            $entity = $this->model->find($entityId)->first();

            if (!$entity) {
                return $this->notFound();
            }

            $entity->delete();

            return $this->response(204, 'Deleted');
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}
