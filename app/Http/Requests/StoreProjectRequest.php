<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Return true if the user is authorized, false otherwise
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255', 'min:5', 'regex:/^[a-zA-Z0-9 ]+$/'],
            'description' => 'required|min:10',
            'owner_id' => 'exists:users,id',
        ];
    }

    /**
     * Get the error messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A project title is required.',
            'title.max' => 'A project title may not be greater than 255 characters.',
            'title.min' => 'A project title must be at least 5 characters.',
            'title.regex' => 'A project title may only contain letters, numbers, and spaces.',
            'description.required' => 'A project description is required.',
            'description.min' => 'A project description must be at least 10 characters.',
            'owner_id.exists' => 'The project owner is invalid.',
        ];
    }
}
