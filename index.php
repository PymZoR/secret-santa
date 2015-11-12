<?php

require_once './vendor/autoload.php';

// Load configuration values from the .env file.
if (!file_exists('.env')) {
    die('See README.md for setup.');
}
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

session_start();

$router = new Phroute\Phroute\RouteCollector();

// Load all the routes.
require_once './routes.php';

// Feed the dispatcher with all the routes we defined before.
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
    $url = explode('?', $_SERVER['REQUEST_URI']);
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url[0]);
} catch (Phroute\Exception\HttpRouteNotFoundException $e) {
    $response = 'Route not found.';
} catch (Phroute\Exception\HttpMethodNotAllowedException $e) {
    $response = 'Method not allowed.';
}

die($response);
