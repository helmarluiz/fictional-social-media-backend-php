<?php

require_once __DIR__ . '/vendor/autoload.php';

/* Load Environment Variables */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/* Include http routes */
include __DIR__ . '/routes.php';
