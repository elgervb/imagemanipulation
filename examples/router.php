<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}

require_once 'vendor/autoload.php';

$uri = substr($_SERVER['REQUEST_URI'], 1);

if (!$uri) {
    $uri = 'index';
}

$getCode = function($file) {
    return htmlentities(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . $file . '.php'));
};

$file = __DIR__ . DIRECTORY_SEPARATOR . $uri . '.php';
if (is_file($file)) {
    include $file;
} else {
    echo "404 not found";
}
