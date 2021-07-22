<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\NewPasswordController;

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

Route::middleware('auth:sanctum','verified')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('/login', [AuthController::class, 'login'])->name('authorization.login');
Route::post('/register', [AuthController::class, 'register'])->name('authorization.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('authorization.logout')->middleware('auth:sanctum');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->name('authorization.verification')->middleware('auth:sanctum');
Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('authorization.verification.verify')->middleware('auth:sanctum');

Route::post('/forgot-password', [NewPasswordController::class, 'forgotPassword'])->name('authorization.forgot');
Route::post('/reset-password', [NewPasswordController::class, 'reset'])->name('authorization.reset');