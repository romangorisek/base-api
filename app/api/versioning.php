<?php

function apiVersion()
{
    $uriComponents = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
    $apiVersion = $uriComponents[0];
    if (!strlen($apiVersion) || $apiVersion[0] !== 'v' || !ctype_digit(substr($apiVersion, 1))) {
        echo "API version could not be determined";
        die;
    }
    if (!file_exists(BASE_PATH . '/app/' . $apiVersion)) {
        echo "Invalid API number";
        die;
    }

    return $apiVersion;
}

define('API_VERSION', apiVersion());