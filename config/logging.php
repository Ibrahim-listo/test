<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

// This section of the code returns an array containing the configuration
// for various log channels used in the Laravel application.

return [
    // The 'default' key specifies the default log channel used to write
    // messages to the logs. The value should correspond to one of the
    // channels defined in the 'channels' array.
    'default' => env('LOG_CHANNEL', 'stack'),

    // The 'deprecations' key configures the log channel for deprecation
    // warnings. This allows developers to prepare their application for
    // upcoming major versions of dependencies.
    'deprecations' => [
        // The 'channel' key sets the log channel for deprecation warnings.
        // The value can be set to 'null' to disable logging deprecations.
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),

        // The 'trace' key determines whether to include a stack trace with
        // deprecation warnings. The value can be set to true or false.
        'trace' => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    // The 'channels' key holds an array of log channel configurations.
    'channels' => [
        // The 'stack' key defines a stacked log channel, which processes
        // logs through multiple handlers in the order they are defined.
        'stack' => [
            // The 'driver' key sets the driver for the stacked log channel.
            // The 'stack' driver is used in this case.
            'driver' => 'stack',

            // The 'channels' key specifies the log channels to include in
            // the stack. In this case, the 'single' and 'syslog' channels
            // are included.
            'channels' => ['single', 'syslog'],

            // The 'ignore_exceptions' key determines whether to ignore
            // exceptions when processing logs. The value can be set to
            // true or false.
            'ignore_exceptions' => false,
        ],

        // The 'single' key defines a single-file log channel.
        'single' => [
            // The 'driver' key sets the driver for the single-file log channel.
            // The 'single' driver is used in this case.
            'driver' => 'single',

            // The 'path' key sets the file path for the log.
            'path' => storage_path('logs/laravel.log'),

            // The 'level' key sets the minimum log level for this channel.
            // The value can be set to 'debug', 'info', 'notice', 'warning',
            // 'error', 'critical', 'alert', or 'emergency'.
            'level' => 'debug',
        ],

        // The 'syslog' key defines a syslog log channel.
        'syslog' => [
            // The 'driver' key sets the driver for the syslog log channel.
            // The 'syslog' driver is used in this case.
            'driver' => 'syslog',

            // The 'level' key sets the minimum log level for this channel.
            // The value can be set to 'debug', 'info', 'notice', 'warning',
            // 'error', 'critical', 'alert', or 'emergency'.
            'level' => 'warning',
        ],

        // Additional log channels can be added here as needed.
    ],
];
