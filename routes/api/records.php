<?php

use App\Http\Controllers\Api\RecordController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [RecordController::class, 'index'])->name('records.index');
    Route::get('/{id}', [RecordController::class, 'show'])->name('records.show');
    Route::get('/{id}/calendars', [RecordController::class, 'сalendars'])->name('records.calendars');
    Route::post('/', [RecordController::class, 'store'])->name('records.store');
    Route::match(['put', 'patch'], '/{id}', [RecordController::class, 'update'])->name('records.update');
    Route::delete('/{id}', [RecordController::class, 'delete'])->name('records.delete');
});