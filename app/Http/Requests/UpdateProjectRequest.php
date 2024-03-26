<?php

namespace App\Http\Requests; // The code is in the App\Http\Requests namespace

use Illuminate\Foundation\Http\FormRequest; // The code extends the FormRequest class from Laravel's Illuminate framework

class UpdateProjectRequest extends FormRequest // The code defines a new class called UpdateProjectRequest that extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool True if the user is authorized, false otherwise
     */
    public function authorize(): bool // The method authorize() returns a boolean value indicating whether the user is authorized to make this request
    {
        return $this->user()->can('update', $this->project); // The user is authorized if they have the 'update' permission for the project being updated
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array // The method rules() returns an array of validation rules that apply to the request
    {
        return [
            'title' => ['required', 'string', 'max:255'], // The 'title' field is required, must be a string, and must not exceed 255 characters
            'description' => ['nullable', 'string'], // The 'description' field is optional, but if provided must be a string
            'status' => ['required', 'string', 'in:in_progress,completed,on_hold'], // The 'status' field is required, must be a string, and must be one of the values 'in_progress', 'completed', or 'on_hold'
        ];
    }

    /**
     * Get the project instance that this request is for.
     *
     * @return \App\Models\Project The project instance that this request is for
     */
    public function project(): \App\Models\Project // The method project() returns the project instance that this request is
