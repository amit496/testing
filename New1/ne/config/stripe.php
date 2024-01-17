<?php

return [
    
    'api_keys' => [
        'secret_key' => env('STRIPE_SECRET_KEY', null)
    ],
    'client_id' => env('STRIPE_CLIENT_ID', null), 
    'redirect_uri' => env('STRIPE_REDIRECT_URI', null), 
    'authorization_uri' => 'https://connect.stripe.com/oauth/authorize'
];
