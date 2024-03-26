<?php

namespace App\Http\Controllers;

use App\Models\Task; // Importing Task model
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This method retrieves all the tasks and returns the 'tasks.index' view with the tasks.
     * The authorization middleware 'viewAny' is applied to ensure the user has permission to view any task.
     */
    public function index()
    {
        $this->authorize('viewAny', Task::class);

        $tasks = Task::all(); // Retrieve all tasks
        return view('tasks.index', ['tasks' => $tasks]); // Pass tasks to the view
    }

    /**
     * Show the form for creating a new resource.
     *
     * This method displays the 'tasks.create' view for creating a new task.
     * The authorization middleware 'create' is applied to ensure the user has permission to create a task.
     */
    public function create()
    {
        $this->authorize('create', Task::class);

        return view('tasks.create'); // Return the 'tasks.create' view
    }

    /**
     * Store a newly created resource in storage.
     *
     * This method stores a newly created task in the database using the 'StoreTaskRequest' validation.
     * After storing the task, it redirects back to the previous page with a success message.
     * The authorization middleware 'create' is applied to ensure the user has permission to create a task.
     */
    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);

        Task::create($request->validated()); // Create a new task with validated data
        return redirect()->back()->with('success', 'Task created successfully.'); // Redirect back with success message
    }

    /**
     * Display the specified resource.
     *
     * This method displays the 'tasks.show' view with the specified task.
     * The authorization middleware 'view' is applied to ensure the user has permission to view the task.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', compact('task')); // Return the 'tasks.show' view with the task
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This method displays the 'tasks.edit' view with the specified task.
     * The authorization middleware 'update' is applied to ensure the user has permission to update the task.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task')); // Return the 'tasks.edit' view with the task
    }

    /**
     * Update the specified resource in storage.
     *
    
