<?php
use imagemanipulation\PharClassLoader;
Phar::mapPhar();

$basePath = 'phar://' . __FILE__ . '/';
if (is_file($basePath . 'PharClassLoader.php')){
	require $basePath . 'PharClassLoader.php';
}

$classLoader = new PharClassLoader(__FILE__);
$classLoader->register();

__HALT_COMPILER();