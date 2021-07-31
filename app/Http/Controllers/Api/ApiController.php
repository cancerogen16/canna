<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    use ApiResponder;

    protected $model;

    public function index()
    {
        $result = $this->model->all();

        return $this->ok(null, $result->toArray());
    }

    public function show(int $entityId)
    {
        $entity = $this->model->find($entityId)->first();

        if (!$entity) {
            return $this->sendError('Not found', 404);
        }

        return $this->ok(null, $entity);
    }

    public function update(int $entityId, Request $request)
    {
        $entity = $this->model->find($entityId)->first();

        if (!$entity) {
            return $this->sendError('Not found', 404);
        }

        $data = $request->validated();

        $this->model->fill($data)->push();

        return response(204, 'Updated');
    }

    public function destroy(int $entityId)
    {
        $entity = $this->model->find($entityId)->first();

        if (!$entity) {
            return $this->sendError('Not found', 404);
        }

        $entity->delete();

        return response(204, 'Deleted');
    }

    public function create(Request $request)
    {
        $data = $request->validated();

        $this->model->fill($data)->push();

        return response(201, 'Created');
    }
}
