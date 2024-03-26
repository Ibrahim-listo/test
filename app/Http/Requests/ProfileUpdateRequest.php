<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore(Auth::user()->id),
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'A name is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not be more than 255 characters.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.regex' => 'The name must only contain letters and spaces.',
            'email.required' => 'An email address is required.',
            'email.string' => 'The email address must be a string.',
            'email.lowercase' => 'The email address must be in lowercase.',
            'email.email' => 'The email address is not valid.',
            'email
