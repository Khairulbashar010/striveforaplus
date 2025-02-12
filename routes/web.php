<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TuitionPostingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Public Routes
// Homepage: Display paginated tuition postings

Route::get('/', [TuitionPostingController::class, 'index'])->name('home');
Route::get('/tuition/detail/{tuition}', [TuitionPostingController::class, 'show'])->name('tuition_postings.show');

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Protected Routes for Tutors (Only for authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::prefix('tuition')->group(function () {
        Route::get('/create', [TuitionPostingController::class, 'create'])->name('tuition_postings.create');        
        Route::post('/', [TuitionPostingController::class, 'store'])->name('tuition_postings.store');
        Route::get('/{tuitionPosting}/edit', [TuitionPostingController::class, 'edit'])->name('tuition_postings.edit');
        Route::put('/{tuitionPosting}', [TuitionPostingController::class, 'update'])->name('tuition_postings.update');
        Route::delete('/{tuitionPosting}', [TuitionPostingController::class, 'destroy'])->name('tuition_postings.destroy');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    });
});