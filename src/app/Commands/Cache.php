<?php

declare(strict_types=1);

namespace App\Commands;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Services\PostsCacheService;
use App\Services\UserAnalysisCacheService;

/**
 * Cache command that will be executed via command line to generate cache when building the docker image
 *
 * @package App\Commands
 */

/* Instantiate cache services */
$postsCacheService = new PostsCacheService();
$userAnalysisCacheService = new UserAnalysisCacheService();

/* Sync Cache */
$postsCacheService->sync();
$userAnalysisCacheService->sync();
