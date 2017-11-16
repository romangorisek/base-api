<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

require_once $config->application->vendorDir . "autoload.php";

$namespaces = [
        'Ekranj\\Controllers' => $config->application->controllersDir,
        'Ekranj\\Services' => $config->application->servicesDir,
        'Ekranj\\Library' => $config->application->libraryDir
    ];
$models_controller = 'Ekranj\\Models';
$namespaces[$models_controller] = $config->application->modelsDir;

$loader->registerNamespaces($namespaces)->register();
