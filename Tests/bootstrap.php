<?php

spl_autoload_register(function ($class) {
    if (strpos($class, 'LB\\') === 0) {
        $class = substr($class, 3);
    }
    $filepath = dirname(__DIR__) . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($filepath)) {
        include $filepath;
    }
});
