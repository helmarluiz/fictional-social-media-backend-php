<?php

declare(strict_types=1);

use App\Support\Helpers\EnvHelper;

return [
    'database' => [
        'host' => EnvHelper::get('DB_HOST', 'localhost'),
        'database' => EnvHelper::get('DB_DATABASE', 'php-news')
        'user' => EnvHelper::get('DB_USER', 'root'),
        'password' => EnvHelper::get('DB_PASSWORD', ''),
        'charset' => 'utf8',
    ],
];
