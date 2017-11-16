<?php

namespace Ekranj\Controllers;

use Phalcon\Mvc\Controller;

class BaseController extends Controller
{
    public function sendResponse($code, $data)
    {
        $this->di->get('response')->send($code, $data);
    }

    public function getPostData()
    {
        $body = $this->request->getJsonRawBody();
        if (is_object($body)) {
            return get_object_vars($body);
        }
        return $body;
    }
}
