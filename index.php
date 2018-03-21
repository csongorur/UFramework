<?php

use Core\Request;
use Core\Route;
use Core\Session;

// Autoload
spl_autoload_register(function($class_name) {
    require_once(__DIR__ . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php');
});

// directory root
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);

// create Request object
Request::init($_GET, $_POST, $_SERVER);

$_GET = null;
$_POST = null;
$_SERVER = null;

$request = Request::getInstance();

session_start();

// Load helpers
include_once('Core/helpers.php');

// Load controllers from uri
$request_uri = $request->server('REQUEST_URI');
$index = strpos($request_uri, '?');

if ($index != false) {
    $request_uri = substr($request_uri, 0, $index);
}

$response = Route::execute($request_uri);

echo $response;
