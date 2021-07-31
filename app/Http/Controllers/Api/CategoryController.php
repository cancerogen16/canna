<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $categories = Category::all();

        if ($categories) {
            return $this->ok(null, $categories->toArray());
        } else {
            return $this->notFound();
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
            $category = new Category($request->validated());

            if ($category) {
                $category->save();

                return $this->ok(null, $category->toArray());
            } else {
                return $this->notFound();
            }
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
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

            if ($category) {
                return $this->ok(null, $category);
            } else {
                return $this->notFound();
            }
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
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

            if ($category) {
                $data = $request->validated();

                $category->update($data);

                return $this->ok(null, $category);
            } else {
                return $this->notFound();
            }
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
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

            if ($category) {
                $category->delete();

                return $this->ok(null, $category);
            } else {
                return $this->notFound();
            }
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}