<?php

namespace App\Http\Controllers;

/**
 * Abstract BaseController class that provides a default implementation for the index method.
 */
abstract class BaseController
{
    /**
     * Display the index route.
     *
     * This method serves as a default implementation for the index route in any controllers that extend this abstract class.
     * It returns a simple string message that indicates the current method being executed.
     *
     * @return string The string message 'This is the index method of the abstract controller class'.
     */
    public function index()
    {
        return 'This is the index method of the abstract controller class';
    }
}
