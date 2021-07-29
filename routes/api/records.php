<?php

use App\Http\Controllers\Api\RecordController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RecordController::class, 'index'])->name('records.index');
Route::get('/{id}', [RecordController::class, 'show'])->name('records.show');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/', [RecordController::class, 'store'])->name('records.store');
    Route::match(['put', 'patch'], '/{id}', [RecordController::class, 'update'])->name('records.update');
    Route::delete('/{id}', [RecordController::class, 'delete'])->name('records.delete');
});