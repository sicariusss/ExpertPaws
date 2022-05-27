<?php

use App\Http\Controllers\API\CallbackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ContactController;

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

/**
 * Аутентификация
 */
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
/**
 * API сущностей
 */
Route::get('users', [UserController::class, 'index']);
Route::get('contacts', [ContactController::class, 'contacts']);
Route::post('contacts', [ContactController::class, 'form']);
Route::get('callbacks/{userId}', [CallbackController::class, 'callbacks']);
