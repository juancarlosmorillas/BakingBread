<?php

class Ruta {

    private $modelo;
    private $vista;
    private $controlador;

    function __construct($modelo, $vista, $controlador) {
        $this->modelo = $modelo;
        $this->vista = $vista;
        $this->controlador = $controlador;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getVista() {
        return $this->vista;
    }

    function getControlador() {
        return $this->controlador;
    }

    
}