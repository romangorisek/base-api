<?php
use Phalcon\Config;

return new Config([
    "database" => [
        "adapter"  => "Mysql",
        "host"     => "localhost",
        "username" => "root",
        "password" => "",
        "dbname"   => "ekranj"
    ],
    'auth' => [
        'jwtKey' => 'sROcbFVomKAw4EWuGdp5Fixn1stRXNicuFyErnwQgnFitQyosg7YtYlSS95MGTt6WDG/7KjVQX8Czf7ycUBxiw=='
    ],
    'environment' => 'local'
]);
