<?php

use App\Http\Controllers\RandomGreetingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/random/greet', [RandomGreetingsController::class, 'getRandomGreetings']);
Route::post('/random/add', [RandomGreetingsController::class, 'addNewGreetings']);
