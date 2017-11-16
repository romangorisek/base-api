<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

require_once $config->application->vendorDir . "autoload.php";

$loader->registerNamespaces(
    [
        'Certee\\Models' => $config->application->modelsDir,
        'Certee\\Controllers' => $config->application->controllersDir,
        'Certee\\Services' => $config->application->servicesDir,
        'Certee\\Library' => $config->application->libraryDir
    ]
)->register();
