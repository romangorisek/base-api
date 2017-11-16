<?php

/**
 * @SWG\Info(title="Ekranj REST API", version="0.1")
 * @SWG\Swagger(
 *   schemes={"http"},
 *   host="ekranj.local.si",
 *   basePath="/"
 * )
 */

include APP_PATH . '/routes/user.php';

$app->get('/' . API_VERSION, function () {
    echo 'Ekranj REST API ' . APP_VERSION;
});

$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'Endpoint not found';
});


$app->before(function () use ($app, $di) {
    $acl = $di->get('acl');
    if ($acl->checkRoute($app)) {
        return true;
    }
    $di->get('response')->send(403, ['Unauthorised']);
    return false;
});
