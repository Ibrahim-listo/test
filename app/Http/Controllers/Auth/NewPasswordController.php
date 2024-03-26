<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Class NewPasswordController
 *
 * This class handles the password reset functionality for users. It provides two methods:
 * 1. create(): displays the password reset view
 * 2. store(): handles the incoming new password request and attempts to reset the user's password
 */
class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * This method displays the password reset view, which allows users to enter their new password.
     * It takes a Request object as a parameter and returns an Inertia response.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        // The 'email' and 'token' parameters are extracted from the request and passed to the Inertia view
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * This method handles the incoming new password request and attempts to reset the user's password.
     * It takes a Request object as a parameter and returns a RedirectResponse.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // The request is validated using Laravel's validation rules
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // The password reset is attempted using Laravel's Password facade
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                // If the password reset is successful, the user's password and remember token are updated
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                // An event is triggered to notify that the password has been reset
                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, the user is redirected to the login page with a success message
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        // If there is an error, a ValidationException is thrown with an error message
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}

