<?php

use App\Http\Controllers\Api\CalendarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CalendarController::class, 'index'])->name('calendars.index');
Route::get('/{id}', [CalendarController::class, 'show'])->name('calendars.show');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/', [CalendarController::class, 'store'])->name('calendars.store');
    Route::match(['put', 'patch'], '/{id}', [CalendarController::class, 'update'])->name('calendars.update');
    Route::delete('/{id}', [CalendarController::class, 'delete'])->name('calendars.delete');

    Route::post('/schedule', [CalendarController::class, 'schedule'])->name('calendars.schedule');
    Route::post('/clean-schedule', [CalendarController::class, 'cleanSchedule'])->name('calendars.cleanSchedule');
});