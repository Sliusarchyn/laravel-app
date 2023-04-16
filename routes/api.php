<?php

use App\Http\Controllers\Rest\User\DeleteController;
use App\Http\Controllers\Rest\User\PaginateController;
use App\Http\Controllers\Rest\User\ShowController;
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

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [PaginateController::class, '__invoke']);
    Route::get('/{id}', [ShowController::class, '__invoke']);
    Route::delete('/{id}', [DeleteController::class, '__invoke']);
});
