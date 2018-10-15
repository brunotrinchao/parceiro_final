<?php
class Autoload {
    public function __construct() {
        spl_autoload_extensions('.class.php');
        spl_autoload_register(array($this, 'load'));
    
    }
    private function load($className) {
        $extension = spl_autoload_extensions();
        if(is_file(ROOT . '/class/' . $className . $extension)){
            require_once (ROOT . '/class/' . $className . $extension);
        }else{
            require_once (ROOT . '/_genesis/' . $className . $extension);
        }
    }
}