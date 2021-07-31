<?php

namespace App\Http\Controllers\Api;

use App\Models\Salon;

class SalonController extends ApiController
{
    public function __construct(Salon $model)
    {
        $this->model = $model;
    }
}