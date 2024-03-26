<?php

// Use the necessary namespaces for the application's authentication routes
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// By default, redirect the root URL to the login page
Route::redirect('/', '/login');

// Define routes for displaying views
Route::view('/welcome', 'welcome');
Route::view('/404', 'errors.404');
Route::view('/password/confirm', 'auth.password.confirm');
Route::view('/email/verify', 'auth.email.verify');
Route::view('/password/reset/complete', 'auth.passwords.reset-success');

// Define routes available to unauthenticated users
Route::middleware('guest')->group(function () {
    // Display the registration form
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // Handle the registration form submission
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Display the login form
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Handle the login form submission
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Display the password reset request form
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    // Handle the password reset request form submission
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // Display the password reset form
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    // Handle the password reset form submission
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// Define routes available to authenticated users
Route::middleware('auth')->group(function () {
    // Display the email verification notice
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    // Handle the email verification
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    // Send email verification notification
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Confirm the user's password
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Update the user's password
    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');

    // Handle user logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

