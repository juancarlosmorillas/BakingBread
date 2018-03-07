<?php

class Enrutador {
    
    private $rutas = array();

    function __construct() {
        $this->rutas['index'] = new Ruta('ModeloMain', 'VistaMain', 'ControladorMain');
        $this->rutas['member'] = new Ruta('ModeloMember', 'VistaMember', 'ControladorMember');
        $this->rutas['client'] = new Ruta('ModeloClient', 'VistaClient', 'ControladorClient');
        $this->rutas['main'] = new Ruta('ModeloMember','VistaMain','ControladorMain');
        $this->rutas['product'] = new Ruta('ModeloProduct','VistaMember','ControladorProduct');
        $this->rutas['clientajax'] = new Ruta('ModeloClient', 'VistaAjax', 'ControladorAjax');
        $this->rutas['productajax'] = new Ruta('ModeloProduct', 'VistaAjax','ControladorAjax');
        $this->rutas['ticketajax'] = new Ruta('ModeloTicket', 'VistaAjax', 'ControladorAjax');
    }

    function getRuta($ruta) {
        if(!isset($this->rutas[$ruta])) {
            return $this->rutas['index'];
        }
        return $this->rutas[$ruta];
    }
}