<?php

declare(strict_types=1);

use App\Support\Helpers\EnvHelper;

return [
          'database' => [
            'host' => EnvHelper::get('DB_HOST', 'fsm-db-mysql'),
            'database' => EnvHelper::get('DB_DATABASE', 'fsm'),
            'user' => EnvHelper::get('DB_USER', 'root'),
            'password' => EnvHelper::get('DB_PASSWORD', '12345'),
            'charset' => 'utf8',
          ]
];
