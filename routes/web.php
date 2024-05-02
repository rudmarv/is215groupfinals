<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\S3uploadController;
use App\Http\Controllers\GetArticleController;


Route::get('/', function () {
    
    if (auth()->user()) {
        return redirect('home');
    }
    else {
        return redirect('login');
    }
});
Route::get('/get-article', [GetArticleController::class, 'getArticle']);
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/', [S3uploadController::class, 'index']);
Route::post('s3upload', [S3uploadController::class, 'store'])->name("s3upload");
require __DIR__.'/auth.php';
