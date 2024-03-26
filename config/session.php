<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Session Related Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure how you wish sessions to be stored and the use
    | of any other session "drivers" that are provided by Laravel. By default
    | we provide four types of session drivers: "file", "cookie", "database" and
    | "apc". You are free to add your own session driver.
    |
    | Supported: "file", "cookie", "database", "apc", "redis", "memcached", "dynamodb"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    'connection' => env('SESSION_CONNECTION', null),

    'table' => env('SESSION_TABLE', 'sessions'),

    'store' => env('SESSION_STORE', null),

    'lottery' => [2, 100],

    'cookie' => [
        'name' => env('SESSION_COOKIE', Str::slug(env('APP_NAME', 'laravel'), '_').'_session'),
        'path' => '/',
        'domain' => env('SESSION_DOMAIN', null),
        'secure' => env('SESSION_SECURE_COOKIE', false),
        'http_port' => env('SESSION_HTTP_PORT', null),
        'https_port' => env('SESSION_HTTPS_PORT', null),
        'same_site' => env('SESSION_SAME_SITE', null),
        'lifetime' => env('SESSION_LIFETIME', 120),
        'expire_on_close' => false,
    ],

    'encrypt' => false,

    'files' => [
        'path' => storage_path('framework/sessions'),
        'driver' => 'file',
        'expire' => NULL,
    ],

    'database' => [
       
