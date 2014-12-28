<?php

// Путь до приложения
define('APP_PATH', realpath('../app/') . DIRECTORY_SEPARATOR);
//
define('VIEW_PATH', realpath('../app/view/') . DIRECTORY_SEPARATOR);
define('MODEL_PATH', realpath('../app/model/') . DIRECTORY_SEPARATOR);
define('CONFIG_PATH', realpath('../app/config/') . DIRECTORY_SEPARATOR);

define('PUBLIC_PATH', realpath('../public/') . DIRECTORY_SEPARATOR);

define('EXT', '.php');

function dd($value) {
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

function dd_($value) {
    dd($value); die();
}

require_once APP_PATH . 'autoloader.php';
require_once APP_PATH . '../vendor/autoload.php';

// Регистрируем класс для авто загрузки классов
spl_autoload_register('Autoloader::load');


$handler = new Session();
session_set_save_handler($handler, false);
//register_shutdown_function('session_write_close');
// Запуск сессии
session_start();

// $_SERVER['REQUEST_URI'] = /auth/signin/
$result = parse_url($_SERVER['REQUEST_URI']);
// array(
//    'path' => '/auth/signin/'
//)

$path = substr($result['path'], 1);
// auth/signin/


// $_SERVER['REQUEST_METHOD'] = GET
$method = strtolower($_SERVER['REQUEST_METHOD']);
// $method = 'get';

$path = explode(DIRECTORY_SEPARATOR, $path);
// $path = array(
//      0 => auth,
//      1 => signin
// );



if (isset($path[0]) && !empty($path[0])) {
    $controller = $path[0];
    // $controller = auth
} else {
    $controller = 'main';
}

if (isset($path[1]) && !empty($path[1])) {
    $action = $path[1];
    // $action = signin
} else {
    $action = 'index';
}

$action = $method . ucfirst($action);
// $action = getSignin

$class = ucfirst($controller) . 'Controller';
// $class = \Controller\Auth

if (file_exists(APP_PATH . 'controller' . DIRECTORY_SEPARATOR . $controller . '.php')) {
    // /var/www/study.dev/app/controller/auth.php
    if (method_exists($class, $action)) {
        $object = new $class();
        // $object = new \Controller\Auth();

        return $object->$action();
        // $object->getSignin();
    } else {
        echo '404';
        header("HTTP/1.0 404 Not Found");
    }
}
