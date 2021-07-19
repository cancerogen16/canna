<?php

use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ServiceController::class, 'index'])->name('services.index');
Route::get('/{id}', [ServiceController::class, 'show'])->name('services.show');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/', [ServiceController::class, 'store'])->name('services.store');
    Route::match(['put', 'patch'], '/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/{id}', [ServiceController::class, 'delete'])->name('services.delete');
});