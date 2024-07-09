<?php

    return [
        'environment' => env('ENVIRONMENT', 'development'),
        'domain'      => env('DOMAIN', 'king-beard'),
        'site_url'    => env('SITE_URL'),
        'staging_url' => env('STAGING_URL', 'reviewyoursite.ca'),
        'debug'       => env('DEBUG', false),
        'auth'        => [
            'key'    => env('AUTH_KEY'),
            'secret' => env('SECURE_AUTH_KEY')
        ],
        'logged_in'   => env('LOGGED_IN_KEY'),
        'nonce'       => env('NONCE_KEY'),
        'salt'        => [
            'key'       => env('AUTH_SALT'),
            'secret'    => env('SECURE_AUTH_SALT'),
            'logged_in' => env('LOGGED_IN_SALT'),
            'nonce'     => env('NONCE_SALT'),
        ]
    ];