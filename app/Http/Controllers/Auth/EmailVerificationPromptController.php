<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Class EmailVerificationPromptController
 *
 * This class handles the display of the email verification prompt for users who have not yet verified their email address.
 * If the user has already verified their email, they will be redirected to the dashboard.
 */
class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * This method checks if the user has already verified their email address. If the user has verified their email,
     * they will be redirected to the dashboard. Otherwise, the email verification prompt will be displayed.
     *
     * @param Request $request The incoming request object.
     * @return RedirectResponse|Response The redirect response or Inertia response object.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        $user = $request->user(); // Retrieve the authenticated user.

        if ($user->hasVerifiedEmail()) { // Check if the user has already verified their email.
            return redirect()->intended(route('dashboard', [], false)); // Redirect to the dashboard.
        }

        return Inertia::render('Auth/VerifyEmail', [ // Render the email verification prompt.
            'status' => $request->session()->get('status'), // Pass the session status to the view.
        ]);
    }
}
