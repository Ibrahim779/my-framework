<?php
namespace PHPMVC;
use PHPMVC\LIB\FrontController;
if (!defined('DS')){
define('DS', DIRECTORY_SEPARATOR);
}
require_once '..' . DS . 'app' . DS . 'config' . DS . 'config.php';
require_once  APP_PATH . DS . 'lib' . DS . 'AutoLoad.php';
$front_controller = new FrontController();
$front_controller->dispatch();