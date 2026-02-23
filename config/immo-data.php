<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Your Immo Data API bearer token. You can obtain this from your
    | dashboard at https://immo-data.fr
    |
    */

    'api_key' => env('IMMO_DATA_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the Immo Data API. You should not need to change
    | this unless you are using a staging/test environment.
    |
    */

    'base_url' => env('IMMO_DATA_BASE_URL', 'https://api.immo-data.fr'),

];
