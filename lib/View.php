<?php

namespace lib;
/**
 * Class View
 */
class View
{
    public $tpl = null;
    public function __construct()
    {
        $route = \lib\Route::getInstance();
        $this->tpl = $route->ctrl . '/' . $route->action;
    }

    public function display($tpl = null)
    {
        $file = APP_ROOT . '/view/' . $this->tpl . '.htm';
        if(!file_exists($file)) {
            throw new \Exception('View {' . $file . '} Not Found.');
        }
        echo file_get_contents($file);
    }

}