<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;

class CategoryController extends ApiController
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}