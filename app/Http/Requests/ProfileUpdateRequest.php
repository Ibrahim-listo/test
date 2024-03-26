<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

// This class, ProfileUpdateRequest, extends the base FormRequest class provided by Laravel.
// It's used to validate and sanitize incoming HTTP request data related to updating a user's profile.
class ProfileUpdateRequest extends FormRequest
{
    // The rules method is overridden to define custom validation rules for the request data.
    public function rules(): array
    {
        // The name field is required, should be a string, and has a minimum length of 3 and a maximum length of 255.
        // It should only contain alphabets and whitespaces, and its uniqueness is checked against the User model,
        // excluding the current authenticated user and the user with the current name.
        'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z\s]+$/', Rule::unique(User::class)->ignore(Auth::id())->ignore(Auth::user()->name)],

        // The email field is required, should be a string, and should follow a valid email format.
        // Its uniqueness is checked against the User model, excluding the current authenticated user.
        'email' => [
            'required',
            'string',
            'email',
            Rule::unique(User::class)->ignore(Auth::id())
        ],

        // Add more validation rules for other fields here as needed.
    }
}
