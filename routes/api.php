<?php

use App\Http\Controllers\Api\ImageController;
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

Route::prefix('categories')
    ->group(base_path('routes/api/categories.php'));

Route::prefix('salons')
    ->group(base_path('routes/api/salons.php'));

Route::prefix('masters')
    ->group(base_path('routes/api/masters.php'));

Route::prefix('services')
    ->group(base_path('routes/api/services.php'));

Route::prefix('calendars')
    ->group(base_path('routes/api/calendars.php'));

Route::prefix('records')
    ->group(base_path('routes/api/records.php'));

Route::prefix('actions')
    ->group(base_path('routes/api/actions.php'));

Route::prefix('authorization')
    ->group(base_path('routes/api/authorization.php'));

Route::prefix('users')
    ->group(base_path('routes/api/users.php'));

Route::prefix('profiles')
    ->group(base_path('routes/api/profiles.php'));

Route::post('/upload', [ImageController::class, 'uploadImage'])
    ->middleware('auth:sanctum');

Route::any('/{any}', function () {
    return response()->json([
        'success' => false,
        'message' => 'Resource not found',
    ], 404);
})->name('api.any.404');