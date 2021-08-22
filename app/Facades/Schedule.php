<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Schedule extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ScheduleService';
    }
}