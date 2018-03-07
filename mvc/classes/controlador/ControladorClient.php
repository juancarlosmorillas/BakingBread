<?php

class ControladorClient extends Controlador{
    
    function index(){
        if($this->isLogged()){
            $this->getModelo()->setData('archivo', 'client_form.html');
            if($this->isAdministrator()){
                $enlace = '<li>
                                <a href="#"><i class="fa fa-male fa-fw"></i> Registrar miembros<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="index.php?ruta=member&accion=listmember">Listado de Miembros</a>
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
    
    function addclient(){
        
        if($this->isLogged()){
        $clients = array();
        $exist= 0; // parto de que no exista
        $client = new Client();
        $client->read();
        $clientBD = $this->getModelo()->getClientById($client->getId());
        $clients = $this->getModelo()->getAllClientsByTin($client->getTin());
        
        
            foreach($clients as $cliente){
              // echo Util::varDump($cliente);
              // echo $client->getName();
                   //echo'hola';
                    if($client->getName() == $cliente->getName()){
                        $exist = 1;
                        $this->getModelo()->setData('mensaje', '<h3 class=" thumbnail text-center">Lo sentimos, este cliente ya existe.</h3>');
                        $this->index();
                    }
                
            }
           //echo $exist;
           // exit;
             if($exist === 0){
                if(Filter::isEmail($client->getEmail())){
                    if(Filter::isTin($client->getTin())){
                        $r = $this->getModelo()->addclient($client); 
                        $this->getModelo()->setData('mensaje', '<h3 class=" thumbnail text-center">Cliente añadido correctamente.</h3>');
                        $this->index();
                        
                            }else{
                                $this->getModelo()->setData('mensaje', '<h3 class=" thumbnail text-center">El TIN no es válido, intentalo de nuevo.</h3>');
                                $this->index();
                            }
            }else{
                $this->getModelo()->setData('mensaje', '<h3 class=" thumbnail text-center">El email no es válido.</h3>');
                $this->index();
            }
   
    }
        }else{
              $this->getModelo()->setData('_index.html');
        }
     
    }
        
  
     /** VISUALIZAR LA LINEA DE CLIENTES ***/
    function listclient(){
        if($this->isLogged()){
            $op = Request::read('op');
            $res = Request::read('res');
             
            if($res !== null){
                if($op == 'edit'){
                    if($res >= 0){
                        $res='Cliente editado correctamente.';
                     }else{
                        $res='Lo sentimos, intentelo de nuevo.';
                     }
                    
                }elseif($op == 'del'){
                    if($res > 0){
                        $res='CLiente eliminado correctamente.';
                     }
                     else{
                        $res='Lo sentimos, intentelo de nuevo.';
                     }
             }elseif($op == 'exist'){
                    $res = 'Lo sentimos, este cliente ya existe';
                }
            
            $res = '<h3 class=" thumbnail text-center">'. $res .'</h3>';

            $this->getModelo()->setData('mensaje', $res);
            }
            $this->getModelo()->setData('archivo', 'table_clients.html');   
            if(Request::read('page') === null){
                $page = 1;
            }else{
                $page = Request::read('page');
            }
            $paginate = new Pagination($this->getModelo()->getCount() , $page , 5);
            if($this->isAdministrator()){
                $enlace = '<li>
                                <a href="#"><i class="fa fa-male fa-fw"></i> Registrar miembros<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="index.php?ruta=member&accion=listmember">Listado de Miembros</a>
                                    </li>
                                    <li>
                                        <a href="index.php?ruta=member&accion=addmember">Añadir Nuevo Miembro</a>
                                    </li>
                                </ul>
                            </li>';
                        
                $this->getModelo()->setData('addMiembro', $enlace);
            }
            if($this->isAdministrator()){
                $linea = '<tr>
                            <td>{{id}}</td>
                            <td>{{name}}</td>
                            <td>{{surname}}</td>
                            <td>{{tin}}</td>
                            <td>{{address}}</td>
                            <td>{{location}}</td>
                            <td>{{postalcode}}</td>
                            <td>{{province}}</td>
                            <td>{{email}}</td>
                            <td><a href="?ruta=client&accion=editclient&id={{id}}"><i class="fa fa-edit fa-fw"></i>Editar</a></td>
                            <td><a class="aremove" data-toggle="modal" data-target="#modalDelete{{id}}" style="cursor: pointer;"><i class="fa fa-remove fa-fw"></i>Eliminar</a></td>
                        </tr>
                        
                          <!-- Modal Para borrar Usuario 2 -->
                        <div id="modalDelete{{id}}" class="modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" id="titulo">Borrar Cliente {{name}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="?ruta=client&accion=removeclient">
                                            <p>¿Seguro que lo deseas eliminar?</p>
                                            <input type="submit" class="btn btn-success" value="Si">
                                            <button class="btn btn-danger" data-dismiss="modal">No</button>
                                            <input type="hidden" id="idmember" name="id" value="{{id}}">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Modal 2 -->
                        ';
                $linea2 = '<th></th><th></th>';
                $this->getModelo()->setData('viewclient2', $linea2);
            }else{
                $linea = '<tr>
                            <td>{{id}}</td>
                            <td>{{name}}</td>
                            <td>{{surname}}</td>
                            <td>{{tin}}</td>
                            <td>{{address}}</td>
                            <td>{{location}}</td>
                            <td>{{postalcode}}</td>
                            <td>{{province}}</td>
                            <td>{{email}}</td>
                        </tr>
                      ';
            }
            $clients = $this->getModelo()->getPaginateClients($paginate->getOffset(),  $paginate->getRpp());
            /*
            echo Util::varDump($clients);
            exit;
            */
            $rango = '<ul class="pagination ml1"> <li> <a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=client&accion=listclient&page=' . $paginate->first() . '">First</a></li>';
            $rango .= '<li><a class="btn btn-primary" href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=client&accion=listclient&page=' .  $paginate->previous() . '">&laquo;</a></li>';
            
            foreach($paginate->getRange() as $number){
                if($page == $number){
                $rango .= '<li class="active"><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=client&accion=listclient&page=' . $number . '">' . $number . '</a></li> ';
                }else{
                    $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=client&accion=listclient&page=' . $number . '">' . $number . '</a></li>';
                }
                
            }
             $rango .= '<li><a class="btn btn-primary" href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=client&accion=listclient&page=' .  $paginate->next(). '">&raquo;</a></li>';
            $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=client&accion=listclient&page=' . $paginate->last() . '">Last</a></li></ul> ';
            $this->getModelo()->setData('rango', $rango);
            $todo = '';
            
            foreach($clients as $indice => $client) {
            
                $r = Util::renderText($linea, $client->getValuesAttributes());
                $todo .= $r;
            }
           
            $this->getModelo()->setData('viewclient', $todo);
 
        }else{
            $this->index();
        }
        
    }   
    /*********FORM PARA EDITAR AL CLIENTE ************/
    function editclient(){
        
        if($this->isAdministrator()){
            $id=Request::read('id');
            $client=$this->getModelo()->getClientById($id);
            $this->setCampos($client);
            
            $this->getModelo()->setData('archivo', 'form_edit_client.html');
                $enlace = '<li>
                                <a href="#"><i class="fa fa-male fa-fw"></i> Registrar miembros<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="index.php?ruta=member&accion=listmember">Listado de Miembros</a>
                                    </li>
                                    <li>
                                        <a href="index.php?ruta=member&accion=addmember">Añadir Nuevo Miembro</a>
                                    </li>
                                </ul>
                            </li>';
                $this->getModelo()->setData('addMiembro', $enlace);
        }else{
            $this->index();
        }
    }
    
    function doeditclient(){
        if($this->isAdministrator()){
            $clients = array();
            $client = new Client();
            $client->read();
            $clientBD = $this->getModelo()->getClientById($client->getId());
            $exist = 0;
            $clients = $this->getModelo()->getAllClientsByTin($client->getTin());
            //echo Util::varDump($client);
            //if con la id del cliente
            foreach($clients as $cliente){
               
                if($cliente->getId() !== $client->getId()){
                    // echo Util::varDump($cliente->getId());
                  //   echo Util::varDump($client->getId());
                   // echo $client->getName().'<br>';
                  //  echo $cliente->getName();
                    
                    if($client->getName() == $cliente->getName()){
                      echo $exist= 1;
                         header("Location:index.php?ruta=client&accion=listclient&op=exist&res=".$exist);
                    }else{
                        if(Filter::isEmail($client->getEmail()) && $client->getId() !== null ) { //poner mas seguridad en el filtrado de campos
                            $r = $this->getModelo()->editClient($client);
                            echo $r;
                    
                        header("Location:index.php?ruta=client&accion=listclient&op=edit&res=".$r);
        
            }else{
               header("Location:index.php?ruta=client&accion=listclient&op=edit&res=".$r);
            }
                    }
                
                }
                if( empty($r)== 1){ // es el mismo
                    $r = 1;
                    $r = $this->getModelo()->editClient($client);
                     header("Location:index.php?ruta=client&accion=listclient&op=edit&res=".$r);
                };

               
            }
            }else{
                $this->index();
            }
        
    }
    
      /********* ELIMINAR AL CLIENTE ************/
    
    function removeclient(){
        if($this->isAdministrator()){
            $id = Request::read('id');
           /* echo $id;
            exit; */
            
            if($id !== null){
               $r =  $this->getModelo()->removeClient($id);
                 header('Location: index.php?ruta=client&accion=listclient&op=del&res='.$r);
            }else{
                header('Location: index.php?ruta=product&accion=listclientop=del&res='.$r);
            }
            
        }else{
            $this->getModelo()->setData('_index.html');
        }
    } 
    
    
    
    
}