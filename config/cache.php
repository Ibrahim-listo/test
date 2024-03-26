<?php

use Illuminate\Support\Str;

// Return an array of cache configuration options.
return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache store that will be used by the
    | framework. This connection is utilized if another isn't explicitly
    | specified when running a cache operation inside the application.
    |
    | The value can be set to any of the cache store drivers supported by Laravel.
    | The supported cache store drivers are: array, database, file, memcached,
    | redis, and apc. If the value is not set, 'database' will be used as the default.
    |
    */
    'default' => env('CACHE_STORE', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define multiple cache connections, with each store having
    | multiple configurations. This provides an easy way to manage your
    | cache stores and set their specific cache expiration times, database
    | connection info, and other settings.
    |
    | The configuration keys available for each cache store are:
    | 'driver', 'connection', 'database', 'table', 'expire_on_close',
    | 'locking_mutex', 'prefix', 'expires_on_minute_rotation',
    | 'hash_key', 'hash_driver', 'share_database', 'cache_key_prefix'.
    |
    */

];
