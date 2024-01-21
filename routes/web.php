<?php

use App\Jobs\OTP;
use App\Models\User;
use App\Models\Video;
use App\Mail\VerifyEmail;
use App\Jobs\ProcessVideo;
use App\Events\VideoCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\CheckVerifyEmail;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\ProfileController;
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

    Route::post('videos/{video}/comments',[CommentController::class, 'store'])
        ->middleware('auth')
        ->name('comments.store');

    Route::get('{likeable_type}/{likeable_id}/like',[LikeController::class, 'store'])->name('likes.store');
    Route::get('{likeable_type}/{likeable_id}/dislike',[DislikeController::class, 'store'])->name('dislikes.store');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


