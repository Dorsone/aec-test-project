<?php

use App\Http\Controllers\IndexController;
use App\Http\Middleware\AuthCheckMiddleware;
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

Route::get('v1/foo', IndexController::class)
    ->name('v1.foo')
    ->middleware(AuthCheckMiddleware::class);
