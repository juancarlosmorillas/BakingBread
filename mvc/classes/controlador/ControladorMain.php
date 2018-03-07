<?php

class ControladorMain extends Controlador{
    
    function index(){
        if($this->isLogged()){
        $this->getModelo()->setData('archivo', 'member_logged.html'); 
        $op = Request::read('op');
        $res = Request::read('res');
        $accion = Request::read('accion');
        if($accion === 'compra'){
            $this->getModelo()->setData('mensaje', 'Gracias por comprar en Baking Bread!');
        }else if($accion === 'compra2'){
            $this->getModelo()->setData('mensaje', 'Lo sentimos, no se puede realizar esa compra. ');
        }
        if($this->isAdministrator()){
                $enlace = '<li>
                                <a href="#"><i class="fa fa-male fa-fw"></i> Registrar miembros<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="index.php?ruta=client&accion=listmember">Listado de Miembros</a>
                                    </li>
                                    <li>
                                        <a href="index.php?ruta=member&accion=addmember">Añadir Nuevo Miembro</a>
                                    </li>
                                </ul>
                            </li>';
            $this->getModelo()->setData('addMiembro', $enlace);
        
        }
        }else{
            $this->getModelo()->setData('archivo', '_index.html');
        }
    }
    
    function enviarCorreoPrueba(){
        echo '<h1>Hola</h1>';
        $obetivo = Request::read('email');
        Util::enviarCorreo($objetivo, 'Verificación de Correo.', 'Pulsa el siguiente enlace para verificar tu email y activar tu cuenta : ');
        $this->getModelo()->setData('mensaje', '<h2>Ya esta illo</h2>');
        $this->index();
    }
    
    function vertpv(){
        if($this->isLogged()){
            $this->getModelo()->setData('archivo', '_tpv.html');    
            
            if($this->isAdministrator()){
                $enlace = '<li>
                                <a href="#"><i class="fa fa-male fa-fw"></i> Registrar miembros<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="index.php?ruta=client&accion=listmember">Listado de Miembros</a>
                                    </li>
                                    <li>
                                        <a href="index.php?ruta=member&accion=addmember">Añadir Nuevo Miembro</a>
                                    </li>
                                </ul>
                            </li>';
                $this->getModelo()->setData('addMiembro', $enlace);
        
        }
        }else{
            $this->index();
        }
    }
    
    function viewapuntar(){
        if($this->isLogged()){
            $this->getModelo()->setData('archivo', '_apuntar.html');
        }else{
            $this->index();
        }
    }
     
  
    
     
    
    
    
    
    
}