<?php
namespace app;

/**
 * Boot Here
 */
require_once '../lib/Route.php';
require_once '../lib/View.php';
require_once '../lib/Registry.php';

use \lib\Registry;

Registry::set('config', include('configs.php'));

define('APP_ROOT', dirname(__FILE__));

$route = \lib\Route::getInstance();
$ctrlClass = ucfirst($route->ctrl);
$action = $route->action . 'Action';
$ctrlfile = '../app/ctrl/'.$ctrlClass.'Ctrl.php';
$modelfile = '../app/model/'.$ctrlClass.'.php';
$modelClass = '\\app\\model\\'.$ctrlClass;
$ctrlClass = '\\app\\ctrl\\'.$ctrlClass.'Ctrl';
if(is_file($ctrlfile)){
    include $ctrlfile;
    $ctrl = new $ctrlClass();
    if(file_exists($modelfile)) {
        include $modelfile;
        $ctrl->model = new $modelClass();
    }
    if(!method_exists($ctrl, $action)) {
    	throw new \Exception('Action {' . $action . '} Not Found.');
    }
    $ctrl->$action();
}else{
    throw new \Exception('Controller {' . $ctrlClass . '} Not Found.');
}

