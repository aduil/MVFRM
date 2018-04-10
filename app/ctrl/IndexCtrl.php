<?php
namespace app\ctrl;

class IndexCtrl
{
    public function __construct()
    {

    }

    public function index()
    {
        $view = new \lib\view();
        $view->display();
    }

}
