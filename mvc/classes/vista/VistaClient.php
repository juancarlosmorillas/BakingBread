<?php

class VistaClient extends Vista{
    
    private function index() {
        $datos = $this->getModelo()->getDatos();
        $archivo = 'templates/' . $datos['archivo'];
        return Util::renderTemplate($archivo, $datos);
    }

    function render($accion) {
        if(!method_exists(get_class(), $accion)) {
            $accion = 'index';
        }
        return $this->$accion();
    }
}