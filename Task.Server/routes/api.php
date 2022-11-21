<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PictureController;
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


Route::post('/auth/register', [AuthController::class, 'createUser']);

Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->group( function () {

    Route::get('/picture/show', [PictureController::class, 'show']);

    Route::get('/picture/search', [PictureController::class, 'search']);

    Route::post('/picture/store', [PictureController::class, 'store']);

});