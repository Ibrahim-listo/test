<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

// StoreTaskRequest class extends FormRequest and is used to validate incoming HTTP requests for creating a new task.
class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool True if the user is authorized to create a task, false otherwise.
     */
    public function authorize(): bool
    {
        // Check if the user is authorized to create a task using the 'create-task' gate.
        return Gate::allows('create-task', $this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> An array of validation rules for the request fields.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255', // The task title is required, must be a string, and have a maximum length of 255 characters.
            'description' => 'nullable|string', // The task description is optional and must be a string if provided.
            'due_date' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d'), // The task due date is required, must be a valid date, and must be today or in the future.
            'assigned_to' => 'exists:users,id', // The user assigned to the task must exist in the database.
        ];
    }
}

