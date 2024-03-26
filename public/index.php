<?php

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Define the start time of the application
define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php') or file_exists($maintenance = __DIR__.'/../storage/framework/down')) {
    require $maintenance;
    http_response_code(Response::HTTP_SERVICE_UNAVAILABLE);
    echo 'The application is currently in maintenance mode. Please try again later.';
    exit;
}

// Register the Composer autoloader...
require_once __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__.'/../bootstrap/app.php';

$response = $app->handleRequest(Request::capture());

// Send the response and end the request
$response->send();

// Optional: Uncomment the line below to dump the response for debugging purposes
// dump($response);

$app->terminate();
