<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// default name space for all routes is 'App\Http\Controllers\Api'
$api_version = config('api.api_version');

Route::group(["prefix" => "{$api_version}"], function () {
    // register categories routes
    Route::prefix('categories')
        ->group(base_path('routes/api/categories.php'));

    Route::prefix('authorization')
        ->group(base_path('routes/api/authorization.php'));

});

Route::any('/{any}', function () {
    return response()->json([
        'success' => false,
        'message' => 'Resource not found',
    ], 404);
})->name('api.any.404');

