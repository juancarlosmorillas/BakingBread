<?php

class Vista{
    
    private $modelo;
    
    function __construct(Modelo $modelo){
        $this->modelo = $modelo;
    }
    
    function getModelo(){
        return $this->modelo;
    }
    
    function render($action) {
        return Util::varDump($this->getModelo()->getDatos());
    }
}