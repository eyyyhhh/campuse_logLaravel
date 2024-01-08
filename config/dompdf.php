<?php

return [
    // ...
    'pdf' => [
        'enabled' => true,
        'binary' => env('DOMPDF_BINARY', 'vendor/bin/wkhtmltopdf'),
        'options' => [
            'dpi' => 96,
            'defaultFont' => 'Arial',
        ],
    ],
    // ...
];
