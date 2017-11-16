<?php

namespace Ekranj\Services;

use Phalcon\Http\Response as PhalconResponse;

class Response extends PhalconResponse
{
    public function send(int $httpCode, $output)
    {
        $this->setStatusCode($httpCode);
        $this->setJsonContent($output);
        parent::send();
    }
}
