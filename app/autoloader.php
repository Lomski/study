<?php
/**
 * Created by PhpStorm.
 * User: bormash
 * Date: 14.10.2014
 * Time: 20:09
 */

class Autoloader {

    public static function load($class) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

        $filename = strtolower($class) . '.php';



        if (file_exists(APP_PATH . 'core' . DIRECTORY_SEPARATOR . $filename)) {
            require_once APP_PATH . 'core' . DIRECTORY_SEPARATOR . $filename;
        } elseif (strrpos($class, 'Controller') > 0 && strrpos($class, 'Controller') + 10 == strlen($class)) {
            require_once APP_PATH . 'controller' . DIRECTORY_SEPARATOR . substr($class, 0, strrpos($class, 'Controller')) . '.php';
        } else {
            require_once APP_PATH . $filename;
        }


    }

}