<?php

namespace App\Http\Controllers\Api;

use App\Models\Calendar;

class CalendarController extends ApiController
{
    public function __construct(Calendar $model)
    {
        $this->model = $model;
    }
}