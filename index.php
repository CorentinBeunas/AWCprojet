<?php
require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/DashboardController.php';
require_once __DIR__ . '/app/core/Router.php';

$route = isset($_GET['route']) ? $_GET['route'] : '';

Router::dispatch($route);