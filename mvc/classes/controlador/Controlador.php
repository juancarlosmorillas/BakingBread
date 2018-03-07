<?php

class Controlador{
    
    private $modelo;
    private $session;
    
    function __construct(Modelo $modelo) {
        $this->modelo = $modelo;
        $this->session = new Session('mvc');
        if($this->isLogged()) {
            $user = $this->getUser();
            $this->getModelo()->setData('user', $user->getLogin());
        }
    }

    function getModelo(){
        return $this->modelo;
    }
    
    function getUser() {
        return $this->getSession()->getUser();
    }
    
    function getSession() {
        return $this->session;
    }

    function isAdministrator() {
        return $this->isLogged() && $this->getUser()->getLogin() === 'admin@admin.es' ||  $this->getUser()->getLogin() === 'admin' ;
    }

    function isLogged() {
        return $this->getSession()->isLogged();
    }
    
    /****** SET CAMPOS *******/
    
     function setCampos($objeto){
        $elementos = $objeto->getValuesAttributes();
        foreach($elementos as $indice =>$elemento){
            $this->getModelo()->setData($indice, $elemento);
        }
     }
    
     function setCampos2($objeto){
        $elementos = $objeto->getAttributesValues();
        foreach($elementos as $indice =>$elemento){
            $this->getModelo()->setData($indice, $elemento);
        }
     }
    
    
    
    
}