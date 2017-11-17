<?php

namespace Api;

use Phalcon\Mvc\Micro\Collection;

class MicroCollection extends Collection
{
    public function setPrefix($prefix)
    {
        return parent::setPrefix("/" . API_VERSION . $prefix);
    }
}