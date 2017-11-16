<?php

namespace Ekranj\Library;

abstract class Response extends DiInterface
{
    protected $staticHostname;

    public function buildArr($result): array
    {
        $data = array();

        foreach ($result as $value) {
            array_push($data, $this->build($value));
        }

        return $data;
    }
}
