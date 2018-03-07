<?php
class Autoload{
    
    static function searchClass($className){
        $archive = dirname(__FILE__) . '/' . $className . '.php';
        if(file_exists($archive)){
            require $archive;
        }
    }
}

spl_autoload_register('Autoload::searchClass');