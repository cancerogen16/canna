<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

class UserController extends ApiController
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}