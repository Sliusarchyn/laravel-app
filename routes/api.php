<?php

use App\Http\Controllers\Rest\User\CreateController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::post('/', [CreateController::class, '__invoke']);
});
