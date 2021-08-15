<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\ImageUploadService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    use ApiResponder;

    /**
     * Список категорий
     *
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function index(ImageUploadService $uploadService): JsonResponse
    {
        $categories = [];

        $categoriesCollection = Category::all();

        foreach ($categoriesCollection as $item) {
            $item['image'] = $uploadService->getImage($item['image'], 'medium');

            $categories[] = $item;
        }

        return $this->ok([
            'categories' => $categories
        ]);
    }

    /**
     * Создание новой категории
     *
     * @param CategoryRequest $request
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function store(CategoryRequest $request, ImageUploadService $uploadService): JsonResponse
    {
        try {
            $this->authorize('create', Category::class);

            $category = new Category($request->validated());

            if (isset($category['image'])) {
                if ($photo = $uploadService->upload($category['image'])) {
                    $category['image'] = $photo;
                }
            }

            $category->save();

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
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function show(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            $category['image'] = $uploadService->getImage($category['image'], 'large');

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
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $this->authorize('update', Category::class);

            $category = Category::findOrFail($id);

            $data = $request->validated();

            if (isset($category['image'])) {
                if ($photo = $uploadService->upload($category['image'])) {
                    $category['image'] = $photo;
                }
            } else {
                $category['image'] = null;
            }

            $category->update($data);

            if (isset($category['image'])) {
                $category['image'] = $uploadService->getImage($category['image'], 'large');
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