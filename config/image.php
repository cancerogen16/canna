<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'imagick',

    /*
     * Images sizes
     * по умолчанию - 'medium'
     * */

    'sizes' => [
        'thumbnail' => [100, 100],
        'medium' => [300, 300],
        'large' => [600, 600],
    ],
];
