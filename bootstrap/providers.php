<?php

// Define a new array to store the list of service providers
$providers = array(
    // Include the AppServiceProvider class
    use App\Providers\AppServiceProvider;
    // Use the fully qualified class name of AppServiceProvider
    App\Providers\AppServiceProvider::class,
);

// Return the array of service providers
return $providers;

