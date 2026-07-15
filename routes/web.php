<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubscribeTransactionController;
use App\Http\Controllers\CourseVideoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{course:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');

// Must logged in before create transaction - khusus student
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/checkout/{course}', [FrontController::class, 'checkout'])->name('front.checkout');
    Route::post('/checkout/{course}', [FrontController::class, 'checkoutProcess'])->name('front.checkout.store');
    Route::get('/learning/{course}/{courseVideo}', [FrontController::class, 'learning'])->name('front.learning');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class)
        ->middleware('role:owner');
    Route::resource('teachers', TeacherController::class)
        ->middleware('role:owner');
    Route::resource('courses', CourseController::class)
        ->middleware('role:owner|teacher');
    Route::resource('subscribe_transactions', SubscribeTransactionController::class)
        ->middleware('role:owner');
    Route::resource('course_videos', CourseVideoController::class)
        ->middleware('role:owner|teacher');
});

require __DIR__.'/auth.php';