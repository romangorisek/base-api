<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

require_once $config->application->vendorDir . "autoload.php";

$loader->registerNamespaces(
    [
        'Ekranj\\Models' => $config->application->modelsDir,
        'Ekranj\\Controllers' => $config->application->controllersDir,
        'Ekranj\\Services' => $config->application->servicesDir,
        'Ekranj\\Library' => $config->application->libraryDir
    ]
)->register();
