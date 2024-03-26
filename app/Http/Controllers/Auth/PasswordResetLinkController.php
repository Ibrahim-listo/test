<?php

// Import necessary classes and functions
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Container\BindingResolutionException;

// Define the PasswordResetLinkController class
class PasswordResetLinkController extends Controller
{
    // Define the create method to display the password reset link request view
    public function create(): Response
    {
        // Render the Auth/ForgotPassword view with the 'status' session variable
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    // Define the store method to handle an incoming password reset link request
    public function store(Request $request): RedirectResponse
    {
        // Validate the email field in the request
        $request->validate([
            'email' => 'required|email',
        ]);

        // Try to send a password reset link
        try {
            // Call the sendResetLink method from the Password facade with the email field in the request
            $status = Password::sendResetLink(
                $request->only('email')
            );

            // If the status is 'RESET_LINK_SENT', set the 'status' session variable and return to the previous page
            if ($status == Password::RESET_LINK_SENT) {
                return back()->with('status', __($status));
            }

            // If the status is not 'RESET_LINK_SENT', return a JSON response with an error message and a 422 status code
            return response()->json([
                'message' => __($status),
                'status' => 422,
            ], 422);

        // If there is a BindingResolutionException, return a JSON response with an error message and a 500 status code
        } catch (BindingResolutionException $e) {
            return response()->json([
                'message' => 'Unable to send password reset link',
                'status' => 500,
            ], 500);
        }
    }
}
