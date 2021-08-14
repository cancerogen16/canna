<?php

use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/{id}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::post('/', [ProfileController::class, 'store'])->name('profiles.store');
    Route::match(['put', 'patch'], '/{id}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::delete('/{id}', [ProfileController::class, 'delete'])->name('profiles.delete');
});