<?php

return [
    'client_id' => env('GOOGLE_ADS_CLIENT_ID'),
    'client_secret' => env('GOOGLE_ADS_CLIENT_SECRET'),
    'developer_token' => env('GOOGLE_ADS_DEVELOPER_TOKEN'),
    'refresh_token' => env('GOOGLE_ADS_REFRESH_TOKEN'),
    'customer_id' => env('GOOGLE_ADS_CUSTOMER_ID'),
    'login_customer_id' => env('GOOGLE_ADS_CUSTOMER_ID'), // Set to the same value as 'customer_id'
    'json_key_file' => base_path('config/google_keys.json'),
];
