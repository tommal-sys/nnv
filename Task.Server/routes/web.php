<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Picture\PictureController;
use Illuminate\Support\Facades\Route;
use Task\Core\Routing\RoutingName;

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

Route::get('/', [HomeController::class, 'index'])->name(RoutingName::HOME_INDEX);

Route::get('pictures', [PictureController::class, 'index'])->name(RoutingName::PICTURE_INDEX);

Route::get('picture/show/{id}', [PictureController::class, 'show'])->name(RoutingName::PICTURE_SHOW);

Route::post('picture/store', [PictureController::class, 'store'])->name(RoutingName::PICTURE_STORE);

Route::post('picture/search', [PictureController::class, 'search'])->name(RoutingName::PICTURE_SEARCH);