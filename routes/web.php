<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\S3uploadController;
Route::get('/', function () {
    return view('s3upload');
});


// Route::post(uri: '/s3upload', action: [AwsUploadController::class, 'store'])->name("s3upload");
Route::post('s3upload', [S3uploadController::class, 'store'])->name("s3upload");
// Route::get('s3upload', function () {return view('s3upload');})->name("s3upload");
// Route::get('/', [S3uploadController::class, 'index']);
// Route::resource('s3upload', 'S3uploadController', ['only' => ['store']]);