<?php

use App\Http\Controllers\Api\MasterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MasterController::class, 'index'])->name('masters.index');
Route::get('/{id}/services', [MasterController::class, 'services'])->name('masters.services');
Route::get('/{id}/calendars', [MasterController::class, 'calendars'])->name('masters.calendars');
Route::get('/{id}/calendars/{day}', [MasterController::class, 'calendarsForDay'])->name('masters.calendarsForDay');
Route::get('/{id}', [MasterController::class, 'show'])->name('masters.show');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/', [MasterController::class, 'store'])->name('masters.add');
    Route::match(['put', 'patch'], '/{id}', [MasterController::class, 'update'])->name('masters.update');
    Route::get('/{id}/records', [MasterController::class, 'records'])->name('masters.records');
    Route::delete('/{id}', [MasterController::class, 'delete'])->name('masters.delete');
});