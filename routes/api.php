<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\RandomGreetingsController;
use Illuminate\Support\Facades\Route;

Route::get('/random/greet', [RandomGreetingsController::class, 'getRandomGreetings']);
Route::post('/random/add', [RandomGreetingsController::class, 'addNewGreetings']);

// ? Authentication
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register');

// ? Routes inside middleware cannot be accessed without authentication
Route::group(['middleware' => ['auth:api']], function () {
  Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('/auth/user', [AuthController::class, 'getUser'])->name('get-user');
  Route::get('/auth/refresh', [AuthController::class, 'refreshToken'])->name('refresh-token');

  // ? Route that accesses gemini third party api
  Route::post('/gemini/ask', [GeminiController::class, 'fetchData']);
});
