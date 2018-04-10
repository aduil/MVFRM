<?php
namespace app\ctrl;

class IndexCtrl
{
    public function __construct()
    {

    }

    public function indexAction()
    {
        $view = new \lib\view();
        $view->display();
    }

}
