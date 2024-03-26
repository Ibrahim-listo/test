<?php

namespace App\Http\Controllers; // The namespace declaration for the UserController class

use App\Models\User; // Importing the User model to be used in the controller
use App\Http\Requests\StoreUserRequest; // Importing the StoreUserRequest class for request validation
use App\Http\Requests\UpdateUserRequest; // Importing the UpdateUserRequest class for request validation

class UserController extends Controller // Defining the UserController class that extends the base Controller class
{
    /**
     * Display a listing of the resource.
     *
     * This method is responsible for displaying a listing of users. It first authorizes the user to view any users, then retrieves all users and returns the users.index view with the users data.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class); // Authorizing the user to view any users

        $users = User::all(); // Retrieving all users
        return view('users.index', compact('users')); // Returning the users.index view with the users data
    }

    /**
     * Show the form for creating a new resource.
     *
     * This method is responsible for displaying the form for creating a new user. It first authorizes the user to create a new user, then returns the users.create view.
     */
    public function create()
    {
        $this->authorize('create', User::class); // Authorizing the user to create a new user

        return view('users.create'); // Returning the users.create view
    }

    /**
     * Store a newly created resource in storage.
     *
     * This method is responsible for storing a newly created user in the database. It first authorizes the user to create a new user, then creates a new user using the User::create() method and the validated request data. After creating the user, it redirects back to the previous page with a success message.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class); // Authorizing the user to create a new user

        User::create($request->validated()); // Creating a new user using the User::create() method and the validated request data
        return redirectBack()->with('success', 'User created successfully.'); // Redirecting back to the previous page with a success message
    }

    /**
     * Display the specified resource.
     *
     * This method is responsible for displaying the specified user. It first authorizes the user to view the specified user, then returns the users.show view with the user data.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user); // Authorizing the user to view the specified user

        return view('users.show', compact('user')); // Returning the users.show view with the user data
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This method is responsible for displaying the form for editing the specified user. It first authorizes the user to update the specified user, then returns the users.edit view with the user data.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user); // Authorizing the user to update the specified user

        return view('
