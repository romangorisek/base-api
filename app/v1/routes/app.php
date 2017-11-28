<?php

use Ekranj\Models\Role;
use Ekranj\Models\User;
use Ekranj\Models\UserRoles;
use Ekranj\Library\Response\User as UserResponse;

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
    echo 'Ekranj REST API ' . API_VERSION;
});

$app->get('/' . API_VERSION . '/add_roles', function () use ($di) {
    $user = User::findFirst(['email = "admin"']);
    // $role = Role::findFirst(['name = "user"']);
    // $ur = new UserRoles;
    // $ur->user_id = $user->id;
    // $ur->role_id = $role->id;
    // $ur->save();
    // var_dump($user->email);
    // var_dump($user);die;
    $response = new UserResponse();
    $code = 200;
    $data = $response->build($user);
    $di->get('response')->send($code, $data);
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
    $app->stop();
});
