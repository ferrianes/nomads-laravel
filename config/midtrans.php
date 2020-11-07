<?php

return [
    'serverKey' => env('MIDTRANS_SERVER_KEY', NULL),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', FALSE),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', TRUE),
    'is3ds' => env('MIDTRANS_IS_3DS', TRUE)
];