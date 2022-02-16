<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '4653340701398016',
        'client_secret' => '557bef275244cc56a30f5f5e4160d935',
        'redirect' => 'https://phamviethung.toidayhoc.com/laravel/handle-auth/callbackFromFacebook'
    ],

    'google' => [
        'client_id' => '382357875643-od34699m4m6ome795hto2mdj6vmbcjmv.apps.googleusercontent.com', 
        'client_secret' => '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', 
        'redirect' => 'https://phamviethung.toidayhoc.com/laravel/handle-auth/callbackFromGoogle'
    ],

];
