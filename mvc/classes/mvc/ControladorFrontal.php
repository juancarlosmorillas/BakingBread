<?php

class ControladorFrontal{
    
    private $controlador;
    private $modelo;
    private $vista;

    function __construct($nombreRuta = null) {
        $nombreRuta = strtolower($nombreRuta);

        $enrutador = new Enrutador();
        $nuevaRuta = $enrutador->getRuta($nombreRuta);
        /*echo Util::varDump($nombreRuta).'<br>';
        echo Util::varDump($nuevaRuta) . '<br>';
        echo Util::varDump($enrutador->getRuta($nombreRuta = null)) . '<br>';
        exit();*/

        //creamos y guardamos en variables los nombres de las 3 clases clave que usaremos (model, vista y controlador)
        $nombreModelo = $nuevaRuta->getModelo(); 
        $nombreVista = $nuevaRuta->getVista(); 
        $nombreControlador = $nuevaRuta->getControlador(); 
        
        $this->modelo = new $nombreModelo(); //modelo con el que trabajar
        $this->vista = new $nombreVista($this->modelo); //vista con la que trabajar
        $this->controlador = new $nombreControlador($this->modelo); //controlador con el que voy a trabajar
    }

    function doAccion($accion = null) {
        $accion = strtolower($accion); //metodo que se debe ejecutar
        if (method_exists($this->controlador, $accion)) {
            $this->controlador->$accion(); //le digo al controller que ejecute ese metodo
        } else {
            $this->controlador->index(); //si no hay accion le das la de index
        }
    }
    
    function output($accion = null) {
        return $this->vista->render($accion);
    }
}