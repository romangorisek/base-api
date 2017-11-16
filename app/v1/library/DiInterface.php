<?php

namespace Ekranj\Library;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface as PhalconDiInterface;
use Phalcon\Di;

abstract class DiInterface implements InjectionAwareInterface
{
    protected $di;

    public function setDi(PhalconDiInterface $di)
    {
        $this->di = $di;
    }

    public function getDi()
    {
        if ($this->di == null) {
            $this->di = Di::getDefault();
        }

        return $this->di;
    }
}
