<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TuitionPostingController;

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

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout (accessible only when authenticated)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes for Tutors (Only for authenticated users)
Route::middleware('auth')->group(function () {
    // Display the form for creating a new tuition posting
    Route::get('/tuition/create', [TuitionPostingController::class, 'create'])->name('tuition.create');
    
    // Store the new tuition posting
    Route::post('/tuition/store', [TuitionPostingController::class, 'store'])->name('tuition.store');
    
    // Display the form for editing an existing tuition posting
    Route::get('/tuition/{id}/edit', [TuitionPostingController::class, 'edit'])->name('tuition.edit');
    
    // Update the tuition posting
    Route::put('/tuition/{id}', [TuitionPostingController::class, 'update'])->name('tuition.update');
    
    // Delete the tuition posting (optional)
    Route::delete('/tuition/{id}', [TuitionPostingController::class, 'destroy'])->name('tuition.destroy');
});