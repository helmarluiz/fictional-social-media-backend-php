<?php

declare(strict_types=1);

use App\Support\Router;

/* Instantiate the router */
$router = new Router();

/* Register endpoints */
$router::get('/api/user-analysis', \App\Controllers\UserAnalysis\LoadUserAnalysisController::class);

$router::get('/api/posts', \App\Controllers\Posts\LoadPostsController::class);
