<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/{id}/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::get('/{id}/salons', [UserController::class, 'salons'])->name('users.salons');
    Route::get('/{id}/records', [UserController::class, 'records'])->name('users.records');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::match(['put', 'patch'], '/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'delete'])->name('users.delete');
});