<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends ApiController
{
    public function __construct(Category $model, CategoryRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}