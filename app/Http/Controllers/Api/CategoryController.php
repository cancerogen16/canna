<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
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
        $categories = Category::all();

        return $this->handleResponse($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $category = new Category($request->validated());

        $category->save();

        return $this->handleResponse($category, 201);
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
        $category = Category::findOrFail($id);

        return  $this->handleResponse($category->toArray());
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
        $category = Category::findOrFail($id);

        $data = $request->validated();

        $category->update($data);

        return $this->handleResponse($category, 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return $this->handleResponse($category, 'Deleted');
    }
}