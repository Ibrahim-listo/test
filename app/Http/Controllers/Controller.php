<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
    {
        return 'This is the index method of the abstract controller class';
    }
}
