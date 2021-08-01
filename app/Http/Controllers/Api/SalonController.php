<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SalonRequest;
use App\Models\Salon;

class SalonController extends ApiController
{
    public function __construct(Salon $model, SalonRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}