<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    /* Load Environment Variables */
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}
catch(Exception){}

/* Include http routes */
include __DIR__ . '/routes.php';
