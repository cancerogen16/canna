<?php

use App\Http\Controllers\Api\SalonController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SalonController::class, 'index'])->name('salons.index');
Route::get('/{id}', [SalonController::class, 'show'])->name('salons.show');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/', [SalonController::class, 'store'])->name('salons.store');
    Route::match(['put', 'patch'], '/{id}', [SalonController::class, 'update'])->name('salons.update');
    Route::delete('/{id}', [SalonController::class, 'delete'])->name('salons.delete');
});