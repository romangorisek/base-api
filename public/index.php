<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . "/app/versioning.php";

define('APP_PATH', BASE_PATH . '/app/' . API_VERSION);

// try {

/**
 * The FactoryDefault Dependency Injector automatically registers the services that
 * provide a full stack framework. These default services can be overidden with custom ones.
 */
$di = new FactoryDefault();

/**
 * Get config service for use in inline setup below
 */
$config = require APP_PATH . "/config/config.php";

/**
 * Include Autoloader
 */
include APP_PATH . '/config/loader.php';

/**
 * Include Services
 */
include APP_PATH . '/config/services.php';

/**
 * Starting the application
 * Assign service locator to the application
 */
$app = new Micro($di);

/**
 * Include Application
 */
include APP_PATH . '/routes/app.php';

/**
 * Handle the request
 */
$app->handle();
// } catch (Throwable  $e) {
//     $response = new Phalcon\Http\Response;
//     $response->setStatusCode(500);
//     $response->setJsonContent([$e->getMessage()]);
//     $response->send();
// }
