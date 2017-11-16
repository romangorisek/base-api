<?php

namespace Ekranj\Services;

class Date extends ServiceBase
{
    protected $datetime;
    protected $format = 'Y-m-d H:i:s';

    public function __construct(\DateTime $datetime)
    {
        $this->datetime = $datetime;
    }

    public function now(): string
    {
        return $this->datetime->format($this->format);
    }
}
