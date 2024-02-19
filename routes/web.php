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

Route::middleware('auth')->group(function () {
    #region Question Routes
    Route::prefix('question')->name('question.')->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('index');
        Route::post('/store', [QuestionController::class, 'store'])->name('store');
        Route::post('/like/{question}', Question\LikeController::class)->name('like');
        Route::post('/unlike/{question}', Question\UnlikeController::class)->name('unlike');
        Route::put('/publish/{question}', Question\PublishController::class)->name('publish');
    });
    #endregion
    #region Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
    #endregion
});

require __DIR__ . '/auth.php';
