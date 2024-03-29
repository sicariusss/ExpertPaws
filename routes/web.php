<?php

use App\Http\Controllers\CRM\CallbackController;
use App\Http\Controllers\CRM\ChapterController;
use App\Http\Controllers\CRM\ContactController;
use App\Http\Controllers\CRM\CourseController;
use App\Http\Controllers\CRM\ReviewsController;
use App\Http\Controllers\CRM\ImageController;
use App\Http\Controllers\CRM\LessonController;
use App\Http\Controllers\CRM\RoleController;
use App\Http\Controllers\CRM\UserController;
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

Route::middleware(['auth', 'crm'])
    ->name('crm.')
    ->prefix('crm')
    ->group(static function () {
        Route::get('/', function () {
            return view('crm.home');
        })->name('home');
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('lessons', LessonController::class);
        Route::resource('images', ImageController::class);
        Route::resource('reviews', ReviewsController::class);
        Route::patch('review/publish/{review}', [ReviewsController::class, 'publish'])->name('review.publish');
        Route::resource('courses', CourseController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('callbacks', CallbackController::class);
        Route::resource('chapters', ChapterController::class);
    });

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
