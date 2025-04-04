<?php
session_start();

define('BASE_PATH', __DIR__);

require_once 'config/config.php';
require_once 'helpers/functions.php';

spl_autoload_register(function ($class) {
   $path = str_replace('\\', '/', $class) . '.php';
   if (file_exists(BASE_PATH . '/' . $path)) {
       require_once BASE_PATH . '/' . $path;
   }
});

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'task';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if (!isset($_SESSION['user_id']) && $controller != 'auth' && $action != 'login' && $action != 'register' && $action != 'processLogin' && $action != 'processRegister') {
   header('Location: index.php?controller=auth&action=login');
   exit();
}

$controllerName = ucfirst($controller) . 'Controller';
$controllerPath = 'controllers/' . $controllerName . '.php';

if (file_exists($controllerPath)) {
   require_once $controllerPath;
   $controllerInstance = new $controllerName();
   
   if (method_exists($controllerInstance, $action)) {
       $controllerInstance->$action();
   } else {
       require_once 'views/errors/404.php';
   }
} else {

   require_once 'views/errors/404.php';
}

