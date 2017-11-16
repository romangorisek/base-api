<?php
use Phalcon\Config;

return new Config([
    "database" => [
        "adapter"  => "Mysql",
        "host"     => "mysql",
        "username" => "root",
        "password" => "secret",
        "dbname"   => "ekranj"
    ],
    'auth' => [
        'jwtKey' => 'sROcbFVomKAw4EWuGdp5Fixn1stRXNicuFyErnwQgnFitQyosg7YtYlSS95MGTt6WDG/7KjVQX8Czf7ycUBxiw=='
    ],
    'environment' => 'local'
]);
