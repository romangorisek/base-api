<?php
use Phalcon\Config;

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

$config = new Config([
    'database' => [
        'adapter'    => 'Mysql',
        'host'       => 'localhost',
        'username'   => 'root',
        'password'   => '',
        'dbname'     => 'test',
        'charset'    => 'utf8',
    ],

    'application' => [
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'controllersDir' => APP_PATH . '/controllers/',
        'servicesDir'    => APP_PATH . '/services/',
        'libraryDir'     => APP_PATH . '/library/',
        'viewsDir'       => APP_PATH . '/views/',
        'baseUri'        => '/lytee-api/',
        'vendorDir'      => APP_PATH . '/../../vendor/'
    ],
    'environment' => 'production',
    'dock' => [
        'location' => '/space1/WWW/lytee/lytee-dock/public'
    ]
]);

$envAppend = '';
if ($env = getenv('APPLICATION_ENV')) {
    $envAppend = '_' . $env;
}

return $config->merge(require APP_PATH . "/../../etc/config{$envAppend}.php");
