<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategoryVideoController;

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


Route::prefix('')->group(function(){

    Route::get('', [IndexController::class, 'index'])->name('home.index');
    Route::get('video/create', [VideoController::class, 'create'])->name('video.create');
    Route::post('video', [VideoController::class, 'store'])->name('video.store');
    Route::get('video/{video}',[VideoController::class, 'show'])->name('video.show');
    Route::get('video/{video}/edit',[VideoController::class, 'edit'])->name('video.edit');
    Route::put('video/{video}',[VideoController::class, 'update'])->name('video.update');

    Route::get('categories/{category:slug}/videos',[CategoryVideoController::class, 'index'])->name('categories.videos.index');
});
