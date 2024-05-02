<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\S3uploadController;
// Route::get('/', function () {
//     return view('s3upload');
// });
Route::get('/', [S3uploadController::class, 'index']);
Route::post('s3upload', [S3uploadController::class, 'store'])->name("s3upload");
