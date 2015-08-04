<?php
function loader($class)
{
    $file = $class . '.php';
    if (file_exists(__DIR__ . DIRECTORY_SEPARATOR .$file)) {
        require __DIR__ . DIRECTORY_SEPARATOR . $file;
    }else if(realpath(__DIR__ . '/../' . $file)){
      require realpath(__DIR__ . '/../' . $file);
    }
    else{
        throw new \Exception('could not find class ' . __DIR__ . '/../' . $file);
    }
}
spl_autoload_register('loader');