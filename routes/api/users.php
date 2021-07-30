<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::group([
    'middleware' => 'auth:sanctum',
    //добавить посредник на проверку прав (юзер видит только свое, админ видит все)
], function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/{id}/profile', [UserController::class, 'getProfile'])->name('users.profile');
    Route::get('/{id}/salons', [UserController::class, 'getSalons'])->name('users.salons');
    Route::get('/{id}/records', [UserController::class, 'getRecords'])->name('users.records');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::match(['put', 'patch'], '/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'delete'])->name('users.delete');
});