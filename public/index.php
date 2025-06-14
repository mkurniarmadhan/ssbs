<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Dotenv\Dotenv;

// Load .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Routing
$router = new Router();
$router->loadRoutes(__DIR__ . '/../routes/api.php');
$router->dispatch();
