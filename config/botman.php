<?php

return [
    'driver' => env('BOTMAN_DRIVER', 'facebook'),

    'drivers' => [
        'facebook' => [
            'token' => env('FACEBOOK_TOKEN'),
            'app_secret' => '73f6ffb71f5d66792b511b0b26077646',
            'verification' => env('FACEBOOK_VERIFICATION'),
        ],
    ],

]

    ?>