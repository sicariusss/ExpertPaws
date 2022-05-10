<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false, 'login' => false]);

Route::middleware(['auth'])
    ->name('crm.')
    ->prefix('crm')
    ->group(static function () {
        Route::resource('users', \App\Http\Controllers\CRM\UserController::class);
    });

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
