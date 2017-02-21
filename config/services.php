<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '653359334846268',
        'client_secret' => '2db11cc1fc6632fcce32caf85a486d5a',
        'redirect' => 'http://fruits.com/facebook/callback',
    ],

    'google' => [
        'client_id' => '929263007464-9nj6e6upralb3t5rdnie78ptflm58hm5.apps.googleusercontent.com',
        'client_secret' => 'tmVeG3FRe9lrfkqFkXiXHgs4',
        'redirect' => 'http://fruits.com/google/callback',
    ],

];
