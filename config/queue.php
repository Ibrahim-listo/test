<?php

/**
 * This section of code returns the default queue connection name.
 *
 * In Laravel, queue connections allow you to specify different queuing systems
 * for various queued jobs. The default queue connection name is used for any
 * queued jobs that do not explicitly specify a different connection.
 *
 * The `return` statement with an array indicates that this code is likely part
 * of a configuration file for a Laravel application. The array keys and values
 * defined in this file are used to configure various aspects of the application.
 *
 * The `'default'` key in the array specifies the default queue connection name.
 * In this case, the default queue connection name is set to `'redis'`, which
 * means that any queued jobs that do not explicitly specify a different connection
 * will use the Redis queuing system.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------
    |
    | Here you may specify which of the connections below you wish
    | to use as your default connection for all queue work. Of
    | course, you may have any number of connections and you
    | are welcome to switch between them at any time.
    |
    */

    'default' => 'redis',

];
