<?php

use App\Http\Controllers\Api\ActionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ActionController::class, 'index'])->name('actions.index');
Route::get('/{id}', [ActionController::class, 'show'])->name('actions.show');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/', [ActionController::class, 'store'])->name('actions.store');
    Route::match(['put', 'patch'], '/{id}', [ActionController::class, 'update'])->name('actions.update');
    Route::delete('/{id}', [ActionController::class, 'delete'])->name('actions.delete');
});