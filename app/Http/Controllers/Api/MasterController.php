<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Master;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\MasterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class MasterController extends Controller
{
    use ApiResponder;

    public function index(): JsonResponse
    {
        $data = Master::all();

        return $this->handleResponse($data);
    }

    public function add(MasterRequest $request): JsonResponse
    {
        $master = new Master($request->validated());

        $master->save();

    if($master)
        {
        return $this->handleResponse($master, 201);

        } else {
        return $this->handleError('Ошибка при добавлении мастера', [], 404);
        }

        }

    public function show($id): JsonResponse
    {
        try
        {
        $master = Master::findOrFail($id);

        return  $this->handleResponse($master->toArray());
        }

            catch(ModelNotFoundException $e)
            {
                return $this->handleError($e, ['Ошибка при поиске мастера'], 404);
        }
    }

    public function update(MasterRequest $request, int $id): JsonResponse
    {
        try
        {
        $master = Master::findOrFail($id);

        $data = $request->validated();

        $master->update($data);

        return $this->handleResponse($master, 'Updated');
        }

        catch(ModelNotFoundException $e)
        {
            return $this->handleError($e, ['Ошибка при поиске мастера'], 404);
        }
    }

    public function delete($id): JsonResponse
    {
        try
        {
        $master = Master::findOrFail($id);

        $master->delete();

        return $this->handleResponse($master, 'Deleted');
        }

        catch(ModelNotFoundException $e)
        {
            return $this->handleError($e, ['Ошибка при удалении мастера'], 404);
        }
    }

}
