<?php

namespace App\Http\Controllers;

use App\Models\Project; // Importing the Project model
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Inertia\Inertia; // Importing the Inertia class

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This method retrieves all projects and returns them to the "Project/Index" Inertia component.
     * The user must be authorized to view any projects.
     */
    public function index()
    {
        $this->authorize('viewAny', Project::class);

        $projects = Project::with('user')->get(); // Retrieve all projects with their associated users

        return Inertia("Project/Index", [ // Return the Inertia response with the projects data
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * This method displays the form for creating a new project.
     * The user must be authorized to create a project.
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        return Inertia("Project/Create"); // Return the Inertia response with the "Project/Create" component
    }

    /**
     * Store a newly created resource in storage.
     *
     * This method stores a newly created project in the database.
     * The user must be authorized to create a project.
     */
    public function store(StoreProjectRequest $request)
    {
        $this->authorize('create', Project::class);

        $project = Project::create($request->validated()); // Create a new project with the validated request data

        return redirect()->route('projects.index'); // Redirect the user to the projects index page
    }

    /**
     * Display the specified resource.
     *
     * This method displays a single project.
     * The user must be authorized to view the project.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return Inertia("Project/Show", [ // Return the Inertia response with the "Project/Show" component
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This method displays the form for editing a project.
     * The user must be authorized to update the project.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return Inertia("Project/Edit", [ // Return the Inertia response with the "Project/Edit" component
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * This method updates an existing project in the database.
     * The user must be authorized to update the project.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($request->validated()); // Update the project with the validated request data

        return redirect()->route('projects.index'); // Redirect the user to the projects index page
    }

    /**
     * Remove the specified resource from storage.
     *
     * This method deletes a project from the database.
     * The user must be authorized to delete the project
