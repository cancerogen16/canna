<?php

namespace App\Http\Controllers\Api;

use App\Facades\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Throwable;

class CategoryController extends Controller
{
    use ApiResponder;

    /**
     * Список категорий
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $categories = [];

            $categoriesCollection = Category::all();

            foreach ($categoriesCollection as $item) {
                $item['thumb'] = ImageUpload::getImage($item['image'], 'medium');

                $categories[] = $item;
            }

            return $this->ok([
                'categories' => $categories
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
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
            $this->authorize('create', Category::class);

            $category = new Category($request->validated());

            $category->save();

            if (isset($category['image'])) {
                $category['thumb'] = ImageUpload::getImage($category['image'], 'thumbnail');
            }

            return $this->response(201, [
                'category' => $category
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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

            if (isset($category['image'])) {
                $category['thumb'] = ImageUpload::getImage($category['image'], 'large');
            }

            return $this->ok([
                'category' => $category
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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
            $this->authorize('update', Category::class);

            $category = Category::findOrFail($id);

            $data = $request->validated();

            $category->update($data);

            if (isset($category['image'])) {
                $category['thumb'] = ImageUpload::getImage($category['image'], 'thumbnail');
            }

            return $this->ok([
                'category' => $category
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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
            $this->authorize('delete', Category::class);

            $category = Category::findOrFail($id);

            $category->delete();

            return $this->ok([
                'category' => $category
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}