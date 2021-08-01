<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends ApiController
{
    public function __construct(User $model, UserRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}