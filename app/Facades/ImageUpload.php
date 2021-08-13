<?php

namespace App\Facades;

use App\Contracts\UploadImageServiceContract;
use Illuminate\Support\Facades\Facade;

class ImageUpload extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UploadImageServiceContract::class;
    }

}