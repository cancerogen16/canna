<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponder;

    /**
     * Список категорий
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
     * Создание новой категории
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $category = new Category($request->validated());

            $category->save();

            return $this->handleResponse($category, 'Category created', 201);
        } catch (QueryException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при добавлении категории']);
        }
    }

    /**
     * Вывод категории по id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            return $this->handleResponse($category->toArray());
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при поиске категории']);
        }
    }

    /**
     * Изменение категории
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, int $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            $data = $request->validated();

            $category->update($data);

            return $this->handleResponse($category, 'Updated');
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при изменении категории']);
        }
    }

    /**
     * Удаление категории
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            $category->delete();

            return $this->handleResponse($category, 'Deleted');
        } catch (ModelNotFoundException $e) {
            return $this->handleError($e->getMessage(), ['Ошибка при удалении категории']);
        }
    }
}