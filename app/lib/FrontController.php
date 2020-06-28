<?php
namespace PHPMVC\LIB;
class FrontController
{
    const NOT_FOUND_ACTION = 'notFound';
    const NOT_FOUND_CONTROLLER = 'PHPMVC\Controllers\NotFoundController';

    private $_controller = 'index';
    private $_action = 'index';
    private $_prams = array();
    public function __construct()
    {
        $this->_parseUrl();
    }

    private function _parseUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        $urls = (explode('/',trim($url,'/'),6)) ;
        if (isset($urls[3])&&$urls[3]!==''){
            $this->_controller = $urls[3];
        }
        if (isset($urls[4])&&$urls[4]!==''){
            $this->_action = $urls[4];
        }
        if (isset($urls[5])&&$urls[5]!==''){
            $this->_prams = explode('/',$urls[5]);
        }
    }
    public function dispatch()
    {
        $controllerName = 'PHPMVC\Controllers\\'. ucfirst($this->_controller ). 'Controller';
       if(!class_exists($controllerName)){
           $controllerName = self::NOT_FOUND_CONTROLLER;
       }
        $controller = new $controllerName();

        $actionName = $this->_action ;
       if(!method_exists($controller, $actionName)){
          $this->_action = $actionName = self::NOT_FOUND_ACTION;
       }
        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setPrams($this->_prams);
        $controller->$actionName();
    }
}