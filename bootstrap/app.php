<?php

session_start();
const APP_URL = 'http://localhost:8000';
const BASE_PATH = __DIR__ . '/../';
require __DIR__ . '/../vendor/autoload.php';
require BASE_PATH . 'core/functions.php';
$config = require BASE_PATH . 'config/database.php';
use Core\ValidationException;
use Core\Session;

use Database\Database;

Database::connect($config);

use Core\Router;

$router = new Router();
include __DIR__ . '/../routes/web.php';

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

try {
    $router->dispatch($method, $url);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();
