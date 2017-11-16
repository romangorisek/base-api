<?php

namespace Ekranj\Controllers;

use Ekranj\Models\User as UserModel;
use Ekranj\Library\Response\User as UserResponse;

/**
 * @Acl(role=500)
 */
class UserController extends BaseController
{

    public function getCurrent()
    {
        $user = $this->getDi()->get('auth')->getUser();
        
        if ($user) {
            $response = new UserResponse();
            $code = 200;
            $data = $response->build($user);
        } else {
            $code = 404;
            $data = ['User not logged in.'];
        }

        $this->sendResponse($code, $data);
    }

    /**
     * @Acl(role=0)
     */
    public function login()
    {
        $postData = $this->getPostData();

        if (!isset($postData['email']) or $postData['email']=='' or !isset($postData['password']) or $postData['password']=='') {
            $code = 400;
            $data = [ 'email or password missing' ];
        } else {
            if (!$user = UserModel::login($postData['email'], $postData['password'])) {
                $code = 401;
                $data = [ 'User not found.' ];
            } else {
                $code = 201;
                $data = [ 'jwt' => $user->getJWT() ];
            }
        }
        $this->sendResponse($code, $data);
    }

    /**
     * @Acl(role=0)
     */
    public function register()
    {
        $postData = $this->getPostData();
        
        $user = new UserModel();
        $code = 500;
        $data = ['User creation failed'];

        if (! isset($postData['role'])) $postData['role'] = UserModel::ROLE_ADMIN;

        if ($user->save($postData, ['email', 'password', 'role'])) {
            $code = 200;
            $data = ['User successfully created'];
        }

        $this->sendResponse($code, $data);
    }
}
