<?php

use imagemanipulation\ImageBuilder;

require_once '../vendor/autoload.php';


$path = $_SERVER["REQUEST_URI"];
$paths = explode("/", $path);
$method = str_replace('.png', '', $paths[1]);

$b = ImageBuilder::create(__DIR__ . '/uglydog.png');

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $path)) {
    if ($path == "/uglydog.png"){
        return false;    // serve the requested resource as-is
    }
    
    call_user_func_array(array($b, $method), array_slice($paths, 2));//->render();
      
}
echo '<img src="/uglydog.png" />';
echo '<img src="/'.$method.'.png" />';
