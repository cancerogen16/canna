<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class SalonController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $salons = Salon::all();

        return $this->handleResponse($salons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $salon = new Salon($request->validated());

        $salon->save();

        return $this->handleResponse($salon, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, $id): JsonResponse
    {
        $salon = Salon::findOrFail($id);

        return  $this->handleResponse($salon->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, int $id): JsonResponse
    {
        $salon = Salon::findOrFail($id);

        $data = $request->validated();

        $salon->update($data);

        return $this->handleResponse($salon, 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $salon = Salon::findOrFail($id);

        $salon->delete();

        return $this->handleResponse($salon, 'Deleted');
    }
}