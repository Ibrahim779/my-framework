<?php
namespace PHPMVC\LIB;
class AutoLoad
{
    public static function autoload( $classname)
    {
        $classname = str_replace('PHPMVC','',$classname);
        $classname = APP_PATH. $classname . '.php';
        if (file_exists($classname)){
            require $classname;
        } else{
          echo 'ERROR : This Class' . $classname . ' is Not Found';
        }

    }
}
spl_autoload_register(__NAMESPACE__ . '\AutoLoad::autoload');