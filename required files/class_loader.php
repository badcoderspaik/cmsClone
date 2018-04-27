<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 22.04.2018
 * Time: 22:23
 */
spl_autoload_register(function ($class_name) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/classes/php/' . $class_name . '.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        echo 'Class not found in this directory';
    }
});