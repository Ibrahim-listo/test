<?php

namespace App\Providers; // The namespace declaration for this provider class

use Illuminate\Support\ServiceProvider; // Importing the base ServiceProvider class

class AppServiceProvider extends ServiceProvider // Defining the custom AppServiceProvider class
{
    /**
     * Register any application services.
     * 
     * This method is called after all other service providers have been registered,
     * and should be used for any final tasks such as binding values in the container.
     * 
     * @return void
     */
    public function register(): void
    {
        // Implement any custom service registration logic here
    }

    /**
     * Bootstrap any application services.
     * 
     * This method is called after all other service providers have been bootstrapped,
     * and should be used for any initialization or setup logic that needs to be performed.
     * 
     * @return void
     */
    public function boot(): void
    {
        // Implement any custom bootstrapping logic here
    }
}

