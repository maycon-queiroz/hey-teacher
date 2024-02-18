<?php

use App\Http\Controllers\{DashboardController, ProfileController, Question, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('question')->name('question.')->group(function () {
    Route::post('/store', [QuestionController::class, 'store'])->name('store');
    Route::post('/like/{question}', Question\LikeController::class)->name('like');
    Route::post('/unlike/{question}', Question\UnlikeController::class)->name('unlike');
    Route::put('/publish/{question}', Question\PublishController::class)->name('publish');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
