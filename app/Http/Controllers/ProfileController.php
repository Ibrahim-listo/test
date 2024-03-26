<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * This method returns an Inertia render of the Profile/Edit view, passing in two values:
     * 1. $mustVerifyEmail: a boolean indicating whether the user's account requires email verification
     * 2. $status: the status message from the user's session, if it exists
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => Session::get('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * This method updates the authenticated user's profile information using the validated data from the
     * ProfileUpdateRequest. If the user's email address has been changed, their email verification status
     * is set to null. The user's profile information is then saved to the database.
     *
     * A success message is added to the user's session, and they are redirected back to the profile edit page.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        Session::flash('status', 'Profile updated successfully!');

        return redirect()->route('profile.edit');
    }

    /**
     * Delete the user's account.
     *
     * This method deletes the authenticated user's account after validating their password. The user is logged out,
     * their session is invalidated, and a new CSRF token is generated. They are then redirected to the homepage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_
