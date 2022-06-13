<?php

declare(strict_types=1);

use App\Support\Helpers\EnvHelper;

return [
          'api' => [
            'host' => EnvHelper::get('API_HOST', 'https://api.supermetrics.com'),
            'client_id' => EnvHelper::get('API_CLIENT_ID', 'ju16a6m81mhid5ue1z3v2g0uh'),
            'email' => EnvHelper::get('API_EMAIl', 'your@email.address'),
            'name' => EnvHelper::get('API_NAME', 'Your Name'),
            'total_posts_per_page' => EnvHelper::get('API_POSTS_PER_PAGE', '100'),
            'total_pages' => EnvHelper::get('API_TOTAL_PAGES', '10')
          ]
];
