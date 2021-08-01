<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ActionRequest;
use App\Models\Action;

class ActionController extends ApiController
{
    public function __construct(Action $model, ActionRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}