<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;

class ServiceController extends ApiController
{
    public function __construct(Service $model)
    {
        $this->model = $model;
    }
}