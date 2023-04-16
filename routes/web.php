<?php

use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\TermsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [IndexController::class, '__invoke'])->name('index');
Route::get('/terms', [TermsController::class, '__invoke'])->name('terms');
