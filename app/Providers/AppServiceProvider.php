<?php

namespace App\Providers;

use App\Contracts\UploadImageServiceContract;
use App\Services\ScheduleService;
use App\Services\ImageUploadService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UploadImageServiceContract::class, ImageUploadService::class);
        $this->app->bind('ScheduleService', ScheduleService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
