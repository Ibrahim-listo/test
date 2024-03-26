<?php

// Define a new array for the list of providers
$providers = array(
    use App\Providers\AppServiceProvider;
    App\Providers\AppServiceProvider::class,
);

// Return the array of providers
return $providers;

