<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CalendarRequest;
use App\Models\Calendar;

class CalendarController extends ApiController
{
    public function __construct(Calendar $model, CalendarRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}