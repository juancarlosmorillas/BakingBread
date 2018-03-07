<?php

class ControladorAjax extends Controlador{
    
    /**
     * Funcion para comprobar que el carrito existe, si no lo creamos y asi jeje
     */ 
    function abrirCart(){
        if($this->isLogged()){
            $sesion = $this->getSession();
            $carrito = $sesion->get('carrito');
            if($carrito === null){
                $carrito = new Carrito();
            }
            $carrito = $carrito->getCarrito();
            return $carrito;
        }else{
            $this->index();
        }
    }//Final de abrirChart
    
    /**
     * Funcion para recuperar de la lista de la compra los
     * productos que tenemos, que los pasaremos a un "carrito"
     * que guardaremos en la sesión para mostrarlo cuando lo necesitemos
     * 
     */
     
    function getCarritoToJson($carrito){
        $array = array();
        foreach ($carrito as $line){
            $lineToJson = new Linea ($line->getId(), $line->getItem(), $line->getCantidad());
            $producto = $line->getItem();
            //echo Util::varDump($producto->getValuesAttributes());
            //echo Util::varDump($line);
            $productoJson = $producto->getValuesAttributes();
            //echo Util::varDump($productoJson);
            $lineToJson->setItem($productoJson);
            $array[] = $lineToJson->getValuesAttributes();
        }
        
        return $array;
    }
    
    function getCart(){
        if($this->isLogged()){
            $sesion = $this->getSession();
            $carrito = $sesion->get('carrito');
            if($carrito === null){
                $carrito = new Carrito();
            }
            $carrito = $carrito->getCarrito();
            $this->getModelo()->setData('carrito', $this->getCarritoToJson($carrito));
        }else{
            $this->index();
        }
    }
    
    function getproductoticket(){
        if($this->isLogged()){
            $id = Request::read('id');
            if($id != null){
                $product = $this->getModelo()->getProductById($id);
                $linea = new Linea($product->getId(), $product);
                //echo Util::varDump($product);
                //echo Util::varDump($linea);
                $sesion = $this->getSession();
                $carrito = $sesion->get('carrito');
                if($carrito === null){
                    $carrito = new Carrito();
                }
                $carrito->addLinea($linea);
                $sesion->set('carrito', $carrito);
                
                //echo Util::varDump($carrito);
                
                $carrito = $carrito->getCarrito();
                //echo Util::varDump($carrito);
                
                //$array = $product->getValuesAttributes();
                $this->getModelo()->setData('carrito', $this->getCarritoToJson($carrito));
                $this->getModelo()->setData('respuesta', array('res'=> 1)); 
            }else{
                $this->getModelo()->setData('respuesta', array('res'=> -1));
            }
        }else{
            $this->index();
        }
    }
    
    /* Funcion Antigua
    function getproductoticket(){
        if($this->isLogged()){
            $id = Request::read('id');
            if($id != null){
                $product = $this->getModelo()->getProductById($id);
                //echo Util::varDump($product);
                $array = $product->getValuesAttributes();
                $this->getModelo()->setData('producto', $array);
                $this->getModelo()->setData('respuesta', array('res'=> 1)); 
            }else{
                $this->getModelo()->setData('respuesta', array('res'=> -1));
            }
        }else{
            $this->index();
        }
        
    }
    */
    
    function guardarticket(){
        if($this->isLogged()){
            $idCliente = Request::read('idclient');
            $idMember = $this->getUser()->getId();
        }else{
            $this->index();
        }
    }
     
    
    function newticket(){
        if($this->isLogged()){
            //Restaurar todos los valores
            $sesion = $this->getSession();
            $carrito = new Carrito();
            $sesion->set('carrito', $carrito);
            header('Location: index.php?ruta=product&accion=vertpv');
            exit();
        }
    }    
    
    /*Restar un producto del carrito*/
    
    function restar(){
        if($this->isLogged()){
            //Leemos el ID del producto a restar
            $id = Request::read('id');
            //echo Util::varDump($id);
            if($id !== null){
                $product = $this->getModelo()->getProductById($id);
                //$linea = new Linea($product->getId(), $product, $cantidad);
                $sesion = $this->getSession();
                $carrito = $sesion->get('carrito');
                if($carrito === null){
                    $carrito = new Carrito();
                }
                $carrito->sub($id);
                //echo Util::varDump($carrito);
                
                $sesion->set('carrito', $carrito);
                $carrito = $carrito->getCarrito();
                //echo Util::varDump($carrito);
                $this->getModelo()->setData('carrito', $this->getCarritoToJson($carrito));
            } //fin del filtro de lectura de datos
        }else{
            $this->index();
        }
    }
    
    /*Funcion para sumar un producto al carrito*/
    function sumar(){
        if($this->isLogged()){
            //Leemos el ID del producto a restar
            $id = Request::read('id');
            //echo Util::varDump($id);
            if($id !== null){
                $product = $this->getModelo()->getProductById($id);
                //$linea = new Linea($product->getId(), $product, $cantidad);
                $sesion = $this->getSession();
                $carrito = $sesion->get('carrito');
                if($carrito === null){
                    $carrito = new Carrito();
                }
                $carrito->add($id);
                $sesion->set('carrito', $carrito);
                $carrito = $carrito->getCarrito();
                $this->getModelo()->setData('carrito', $this->getCarritoToJson($carrito));
            } //fin del filtro de lectura de datos
        }else{
            $this->index();
        }
    }
    
    /*Parte del controlador para los clientes*/
    function searchclients(){
      $clients = $this->getModelo()->getAllClients();
      $array = array();
      foreach($clients as $client){
          $array[] = $client->getValuesAttributes();
      }
      $this->getModelo()->setData('clientes', $array);
    }
    
    function index(){
        if($this->isLogged()){
        $this->getModelo()->setData('archivo', 'member_logged.html');  
        }else{
            $this->getModelo()->setData('archivo', '_index.html');
        }
    }
    
    
    
    function saveticket(){
        if($this->isLogged()){
            $idClient = Request::read('idcliente');
            //echo $idClient;
            $idMember = $this->getUser()->getId();
            //$date = date("Ymd");
            //Creamos un ticket nuevo
            $ticket = new Ticket();
            if($idClient != ''){
                $ticket->setIdclient($idClient);
                $ticket->setIdmember($idMember);
                //$ticket->setDatetime($date);
            }else{
                $ticket->setIdclient(null);
                $ticket->setIdmember($idMember);
                //$ticket->setDatetime($date);
            }
            /*Si el carrito esta vacio, no guardamos el ticket*/
            $carrito = $this->getSession()->get('carrito');
            $carrito = $carrito->getCarrito();
            //echo Util::varDump($carrito);
            //echo Util::varDump(count($carrito));
            //echo Util::varDump(empty($carrito));
            if(count($carrito) > 0 ){
                //echo 'hola';
                $r = $this->getModelo()->addTicket($ticket);   
            }else{
                $r = -1;
            }
            
            if($r > 0){
                //$r2 = $this->saveticketdetails($r);
                $this->saveticketdetails($r);
                $this->getModelo()->setData('respuesta', array('res'=> 1)); 
               
                $carrito = new Carrito();
                $this->getSession()->set('carrito', $carrito);
            }else{
                $this->getModelo()->setData('respuesta', array('res'=> -1));
            }
            //exit();
        }else{
            $this->index();
        }
    }
    
    function saveticketdetails($idticket){
        $carrito = $this->getSession()->get('carrito');
        $carrito = $carrito->getCarrito();
        $res = array();
        foreach($carrito as $linea){
            //echo Util::varDump($linea);
            //$ticketdetail = new TicketDetail($idticket, $linea['id'],$linea['cantidad'],$linea['item']->getPrice());
            //echo Util::varDump($ticketdetail);
            $idProduct = $linea->getId();
            $price = $linea->getItem()->getPrice();
            $quantity = $linea->getCantidad();
            $ticketdetail = new TicketDetail(null,$idticket, $idProduct, $quantity, $price);
            $this->getModelo()->addTicketDetail($ticketdetail);
        }
    }
    
    /*Parte del controlador para los productos*/
    
    function verpanes(){
        if($this->isLogged()){
        
            $productos = $this->getModelo()->getAllLimitTPVPan();
            $array = array();
            foreach($productos as $producto){
                $array[] = $producto->getValuesAttributes();
            }
            
            $this->getModelo()->setData('productos', $array);
        }else{
            $this->index();
        }
    }
    
    function vercroissants(){
        if($this->isLogged()){
        
            $productos = $this->getModelo()->getAllLimitTPVCroissants();
            $array = array();
            foreach($productos as $producto){
                $array[] = $producto->getValuesAttributes();
            }
            
            $this->getModelo()->setData('productos', $array);
        }else{
            $this->index();
        }
    }    
    
    function vernavidad(){
        if($this->isLogged()){
        
            $productos = $this->getModelo()->getAllLimitTPVNavidad();
            
            $array = array();
            foreach($productos as $producto){
                $array[] = $producto->getValuesAttributes();
            }
            //echo Util::varDump($array);
            $this->getModelo()->setData('productos', $array);
        }else{
            $this->index();
        }
    }        
    
    function verotros(){
        if($this->isLogged()){
        
            $productos = $this->getModelo()->getAllLimitTPVOtros();
            $array = array();
            foreach($productos as $producto){
                $array[] = $producto->getValuesAttributes();
            }
            
            $this->getModelo()->setData('productos', $array);
        }else{
            $this->index();
        }
    }
    
    
}//Final Controlador