<?php

/**
 * This array return statement is used to configure the default filesystem disk
 * for the application.
 *
 * The 'local' disk is currently set as the default, which means that any file
 * operations that do not specify a disk will use this disk. The 'local' disk
 * is used for files that are stored on the local file system.
 *
 * You can change the default disk by modifying the value of the 'default' key.
 * For example, if you wanted to use the 's3' disk as the default, you would
 * change 'local' to 's3'.
 *
 * You can also add additional disks to the array by adding new key-value pairs.
 * For example, if you wanted to add a 'google' disk, you would add the following
 * code:
 *
 * 'google' => [
 *     'driver' => 'google',
 *     'key' => env('GOOGLE_DISK_KEY'),
 *     'secret' => env('GOOGLE_DISK_SECRET'),
 *     'project_id' => env('GOOGLE_PROJECT_ID'),
 *     'bucket' => env('GOOGLE_BUCKET'),
 *     'path_prefix' => '',
 * ]
 *
 * Make sure to run php artisan config:cache if you make any changes to this
 * array.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The 'local' disk is the default one, as many
    | applications will not need to access any other disks.
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    |
