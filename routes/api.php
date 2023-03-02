<?php

use App\Http\Controllers\Authentication\CheckController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix'     => 'auth',
    'as'         => 'auth.',
], function () {
    Route::post('login', LoginController::class)->name('login');
    Route::get('check', CheckController::class)->name('check');
});

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::apiResource('lessons', LessonController::class)->only(['index', 'show']);
});