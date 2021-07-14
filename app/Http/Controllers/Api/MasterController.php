<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Master;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MasterRequest;


class MasterController extends Controller
{
    use ApiResponder;

    public function index(Request $request): JsonResponse
    {
        $data = Master::all();

        return $this->handleResponse($data);
    }

    public function add(MasterRequest $request): JsonResponse
    {
        $master = new Master($request->validated());

        $master->save();

        return $this->handleResponse($master, 201);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $master = Master::findOrFail($id);

        return  $this->handleResponse($master->toArray());
    }

    public function update(MasterRequest $request, int $id): JsonResponse
    {
        $master = Master::findOrFail($id);

        $data = $request->validated();

        $master->update($data);

        return $this->handleResponse($master, 'Updated');
    }

    public function delete($id): JsonResponse
    {
        $master = Master::findOrFail($id);

        $master->delete();

        return $this->handleResponse($master, 'Deleted');
    }

}
