<?php

namespace Ekranj\Services;

use Firebase\JWT\JWT;
use Ekranj\Models\User as UserModel;

class Authentication extends ServiceBase
{
    private $user = null;

    public function getUser()
    {
        if ($this->user == null) {
            $this->user = $this->getUserFromToken();
        }
        return $this->user;
    }

    public function getUserRole()
    {
        if ($user = $this->getUser()) {
            return $user->role;
        }
        return 0;
    }

    private function getUserFromToken()
    {
        if ($tokenData = $this->getTokenData()) {
            if ($user = UserModel::get($tokenData->user_id)) {
                if ($user->active == 1) {
                    return $user;
                }
            }
        }
        return false;
    }

    private function getTokenData()
    {
        $config = $this->getDI()->get('config');
        $request = $this->getDI()->get('request');
        $secretKey = base64_decode($config->auth->jwtKey);

        list($jwt) = sscanf( $request->getHeader('Authorization'), 'Bearer %s');
        if ($jwt) {
            try {
                $token = JWT::decode($jwt, $secretKey, ['HS512']);
                return $token->data;
            } catch (\Exception $e) {
            }
        }
        return false;
    }

    public function createToken($content)
    {
        $config = $this->getDI()->get('config');
        $request = $this->getDI()->get('request');
        $secretKey = base64_decode($config->auth->jwtKey);

        $data = [
            'iat'  => time(),
            'jti'  => base64_encode(random_bytes(32)),
            'iss'  => $request->getServer('SERVER_NAME'),
            'data' => $content
        ];

        $secretKey = base64_decode($config->auth->jwtKey);

        return JWT::encode($data, $secretKey, 'HS512');
    }
}
