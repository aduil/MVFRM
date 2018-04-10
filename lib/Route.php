<?php
namespace lib;
/**
 * Route
 */
class Route
{
    public $ctrl;
    public $action;
    public $prefix = "";   // To config a prefix on url like 'foo/bar/index.php/' if rewrite is not available

    static protected $_instance = null;
    static public function getInstance()
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __clone(){}

    private function __construct()
    {
        /*
         * A rewrite to hide index.php is demanded.
         * Fetch controller and action from a rewrite url like localhost/:controller/:action
         * Fetch params by order like /:param1/:value1/:param2/:value2/...
         */
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0]; // remove GET params after ?
        if($this->prefix) {
            $pre = strlen($this->prefix);
            $uri = substr($uri, $pre, strlen($uri) - $pre);
        }

        if(!empty($uri) && $uri !='/'){
            $patharr = explode('/',trim($uri,'/'));
            if(isset($patharr[0])){
                $this->ctrl = $patharr[0];
            }
            unset($patharr[0]);
            if(isset($patharr[1])){
                $this->action = $patharr[1];
                unset($patharr[1]);
            }else{
                $this->action = 'index';
            }
            $count = count($patharr) + 2;
            $i = 2;
            while($i < $count){
                if(isset($patharr[$i+1])){
                    $_GET[$patharr[$i]] = $patharr[$i+1];
                }
                $i = $i+2;
            }
        } else {
            $this->ctrl = 'index';
            $this->action = 'index';
        }
    }
}
