<?php

use App\Http\Controllers\Api\MasterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MasterController::class, 'index'])->name('masters.index');
Route::get('/{id}', [MasterController::class, 'show'])->name('masters.show');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/', [MasterController::class, 'add'])->name('masters.add');
    Route::match(['put', 'patch'], '/{id}', [MasterController::class, 'update'])->name('masters.update');
    Route::delete('/{id}', [MasterController::class, 'delete'])->name('masters.delete');
});