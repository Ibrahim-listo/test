<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * ConfirmablePasswordController
 *
 * This controller handles the logic for confirming a user's password.
 */
class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * This method returns the confirm password view to the user.
     *
     * @return \Inertia\Response
     */
    public function show(): Response
    {
        return Inertia::render('Auth/ConfirmPassword');
    }

    /**
     * Confirm the user's password.
     *
     * This method confirms the user's password and redirects them to the intended page.
     * If the password is not valid, a validation exception is thrown.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the password field
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        // Store the timestamp of the password confirmation in the session
        $request->session()->put('auth.password_confirmed_at', now()->timestamp);

        // Redirect the user to the intended page
        return redirect()->intended(route('dashboard', [], false));
    }
}

// Import the Carbon library for working with dates
use Carbon\Carbon;

// Import the Rule class for creating custom validation rules
use Illuminate\Validation\Rule;
