<?php
if (!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
define('APP_PATH', realpath(dirname(__FILE__).  DS .'..'. DS));
define('VIEW_PATH', APP_PATH. DS . 'views' . DS);
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME','mvc');