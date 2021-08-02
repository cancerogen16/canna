<?php

use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ServiceController::class, 'index'])->name('services.index');
Route::get('/{id}/masters', [ServiceController::class, 'getMasters'])->name('services.masters');
Route::get('/{id}/actions', [ServiceController::class, 'getActions'])->name('services.actions');
Route::get('/{id}', [ServiceController::class, 'show'])->name('services.show');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/', [ServiceController::class, 'store'])->name('services.store');
    Route::match(['put', 'patch'], '/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::post('/{id}/masters/{master_id}', [ServiceController::class, 'attachMaster'])->name('services.attachMaster');
    Route::post('/{id}/actions/{action_id}', [ServiceController::class, 'attachAction'])->name('services.attachAction');
    Route::delete('/{id}/masters/{master_id}', [ServiceController::class, 'detachMaster'])->name('services.detachMaster');
    Route::delete('/{id}/actions/{action_id}', [ServiceController::class, 'detachAction'])->name('services.detachAction');
    Route::delete('/{id}', [ServiceController::class, 'delete'])->name('services.delete');
});