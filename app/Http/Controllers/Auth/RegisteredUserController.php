<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * If the user is already authenticated, they will be redirected to the home page.
     * Otherwise, the registration view will be rendered.
     *
     * @return Response The registration view.
     */
    public function create(): Response
    {
        return Auth::check()
            ? redirect(RouteServiceProvider::HOME)
            : Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * This method will validate the incoming request, create a new user, and log them in.
     * If there are any errors, the user will be redirected back to the registration page with an error message.
     *
     * @throws Exception If there is an error creating the user.
     * @return RedirectResponse A redirect response to the home page with a success message.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        // Create a new user with the provided information
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Fire the Registered event to trigger any necessary notifications or actions
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        // Redirect the user to the home page with a success message
        return redirect(RouteServiceProvider::HOME, 303)->with('success', 'Your account has been
