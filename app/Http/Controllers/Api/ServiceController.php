<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;

class ServiceController extends ApiController
{
    public function __construct(Service $model, ServiceRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}