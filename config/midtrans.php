<?php

return [
    'serverKey' => env('MIDTRANS_SERVER_KEY', NULL),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', FALSE),
    'isSanitize' => env('MIDTRANS_IS_SANITIZE', TRUE),
    'is3ds' => env('MIDTRANS_IS_3DS', TRUE)
];