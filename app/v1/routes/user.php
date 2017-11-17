<?php

use Api\MicroCollection;
use Ekranj\Controllers\UserController;

$user = new MicroCollection();

$user->setHandler(
    new UserController()
);

$user->setPrefix("/user");

/**
 * @SWG\Post(
 *   path="/user/login",
 *   summary="Check user credentials and return token",
 *   tags={"user"},
 *   @SWG\Parameter(
 *     name="locale",
 *     in="path",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="Params",
 *     in="body",
 *     @SWG\Schema(
 *       @SWG\Parameter(name="username",type="string"),
 *       @SWG\Parameter(name="password",type="string")
 *     )
 *   ),
 *   @SWG\Response(
 *     response=200,
 *     description="Login successful",
 *     @SWG\Parameter(name="jwt",type="string")
 *   ),
 *   @SWG\Response(
 *     response="default",
 *     description="Unknown error",
 *     @SWG\Schema(
 *       type="array",
 *       @SWG\Items(type="string")
 *     )
 *   )
 * )
 */
$user->post('/login', "login");

$user->post('/register', "register");

/**
 * @SWG\Get(
 *   path="/user",
 *   summary="Get authenticated user",
 *   tags={"user"},
 *   @SWG\Parameter(
 *     name="locale",
 *     in="path",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Response(
 *     response=201,
 *     description="User object",
 *     @SWG\Schema(ref="#/definitions/UserResponse")
 *   ),
 *   @SWG\Response(
 *     response="default",
 *     description="Unknown error",
 *     @SWG\Schema(
 *       type="array",
 *       @SWG\Items(type="string")
 *     )
 *   )
 * )
 */
$user->get('/', "getCurrent");

$app->mount($user);
