<?php
use Phalcon\Config;

return new Config([
    "database" => [
        "adapter"  => "Mysql",
        "host"     => "vx1.dspot.us",
        "username" => "ekranjRW",
        "password" => "2m46hbvy7u544r7fu245as",
        "dbname"   => "ekranj"
    ],
    'auth' => [
        'jwtKey' => 'sROcbFVomKAw4EWuGdp5Fixn1stRXNicuFyErnwQgnFitQyosg7YtYlSS95MGTt6WDG/7KjVQX8Czf7ycUBxiw=='
    ],
    'environment' => 'staging'
]);
