<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Events\UserEmailVerified; // Event triggered when a user's email is verified
use Illuminate\Auth\Events\Verified; // Event triggered when a user passes email verification
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user(); // Get the authenticated user

        if ($user->hasVerifiedEmail()) { // Check if the user's email is already verified
            return redirect()->intended(route('dashboard', ['verified' => 1], false)); // Redirect to the dashboard with a 'verified' parameter
        }

        $user->markEmailAsVerified(); // Mark the user's email as verified
        event(new UserEmailVerified($user)); // Trigger the UserEmailVerified event
        event(new Verified($user)); // Trigger the Verified event

        return redirect()->intended(route('dashboard', ['verified' => 1], false)); // Redirect to the dashboard with a 'verified' parameter
    }
}


<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserEmailVerified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user; // The user whose email has been verified

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\User  $user
     */
    public function __construct(User $user)
    {
        $this->user
