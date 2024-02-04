<?php

use App\Http\Controllers\Rest\User\CreateController;
use App\Http\Controllers\Rest\User\DeleteController;
use App\Http\Controllers\Rest\User\PaginateController;
use App\Http\Controllers\Rest\User\ShowController;
use App\Http\Controllers\Rest\User\UpdateController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [PaginateController::class, '__invoke']);
    Route::post('/', [CreateController::class, '__invoke']);
    Route::get('/{id}', [ShowController::class, '__invoke']);
    Route::put('/{id}', [UpdateController::class, '__invoke']);
    Route::delete('/{id}', [DeleteController::class, '__invoke']);
});
