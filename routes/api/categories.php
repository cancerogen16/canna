<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::match(['put', 'patch'], '/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
});