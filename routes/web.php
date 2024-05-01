<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [WelcomeController::class, 'index']);
Route::resource('images', 'WelcomeController', ['only' => ['store', 'destroy']]);