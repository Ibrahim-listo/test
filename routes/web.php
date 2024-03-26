<?php

// Import necessary classes and helpers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Redirect root URL to dashboard
Route::get('/', function () {
    // Redirect to the dashboard route
    return redirect()->route('dashboard');
})->name('home');

// Define routes that require authentication and user verification
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        // Render the Dashboard view
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Project-related routes
    Route::resource('projects', ProjectController::class);

    // Task-related routes
    Route::resource('tasks', TaskController::class);

    // User-related routes
    Route::resource('users', UserController::class);

    // Profile-related routes
    Route::middleware('can:view,user')->group(function () {
        // Edit profile route
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

        // Update profile route
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Delete profile route
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Include authentication routes
require __DIR__.'/auth.php';

