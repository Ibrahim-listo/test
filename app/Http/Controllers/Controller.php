<?php

namespace App\Http\Controllers;

abstract class BaseController
{
    /**
     * Display the index route.
     *
     * @return string
     */
    public function index()
    {
        return 'This is the index method of the abstract controller class';
    }
}
