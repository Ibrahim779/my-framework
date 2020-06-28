<?php


namespace PHPMVC\Controllers;


use PHPMVC\LIB\FrontController;

abstract class AbstractController
{
    protected $_controller;
    protected $_action;
    protected $_prams;
    protected $_data= [];

    public function notFound()
    {
        $this->_view();
    }
    public function setController($controllerName)
    {
        $this->_controller = $controllerName;
    }
    public function setAction($actionName)
    {
        $this->_action = $actionName;
    }
    public function setPrams($pramsName)
    {
        $this->_prams = $pramsName;
    }
    public function _view($data)
    {
        if ($this->_action == FrontController::NOT_FOUND_ACTION){
            require_once VIEW_PATH . 'notfound'. DS . 'notfound.view.php';
        }else{
        $view = VIEW_PATH . $this->_controller . DS . $this->_action . '.view.php';
        if (file_exists($view)){
           extract($this->_data);
            require_once $view;
        }else{
            require_once  VIEW_PATH . 'notfound' . DS . 'notview.view.php';
        }
        }

    }

}