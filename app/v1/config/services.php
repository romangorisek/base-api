<?php

use Phalcon\Mvc\View\Simple as View;
use Phalcon\Mvc\Url as UrlResolver;
use Ekranj\Services\Date;
use Ekranj\Services\Response;
use Ekranj\Services\Authentication;
use Ekranj\Services\Acl;

/**
 * Shared configuration service
 */
$di->setShared('config', function () use ($config) {
    return $config;
});

$di->setShared('date', function () {
    return new Date(new DateTime());
});

$di->setShared('response', function () {
    return new Response();
});

/**
 * Sets the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    return $view;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});

$di->setShared("auth", function () {
    $auth = new Authentication();
    return $auth;
});

$di->setShared("acl", function () {
    $acl = new Acl();
    return $acl;
});
