<?php

namespace App\Http\Controllers\Api;

use App\Models\Action;

class ActionController extends ApiController
{
    public function __construct(Action $model)
    {
        $this->model = $model;
    }
}