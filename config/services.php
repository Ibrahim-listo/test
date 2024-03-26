<?php

return [

    // Third-party services credentials and configurations
    'third-party-services' => [

        // Postmark
        'postmark' => [
            'token' => env('POSTMARK_TOKEN'),
        ],

        // Amazon Web Services (AWS) - Simple Email Service (SES)
        'ses' => [
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        ],

        // Slack
        'slack' => [
            'notifications' => [
                'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
                'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
            ],
        ],

        // SendGrid
        'sendgrid' => [
            'api_key' => env('SENDGRID_API_KEY'),
        ],
    ],
];

