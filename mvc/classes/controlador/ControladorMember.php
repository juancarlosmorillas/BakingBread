<?php

class ControladorMember extends Controlador{
    
    function index(){
        if($this->isLogged()){
            $this->getModelo()->setData('archivo', 'member_logged.html');
            if($this->isAdministrator()){
                $enlace = '<li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Register member<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?ruta=member&accion=listmember">Member List</a>
                                </li>
                                <li>
                                    <a href="index.php?ruta=member&accion=addmember">New Member</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                           </li>';
                $this->getModelo()->setData('addMiembro', $enlace);
        }}else{
            $this->getModelo()->setData('archivo', '_index.html');
        }
    }
  
    function doregister(){
        $member = new Member();
        $member->read();
        $password2 = Request::read('password2');
    
        if($this->getModelo()->checkMemberByLogin($member) <= 0){
            if($password2 == $member->getPassword()){
               
                    $encripted = Util::encryptPassword($member->getPassword());
                    $member->setPassword($encripted);
                    $res = $this->getModelo()->register($member);
                    if($res > 0){
                        $this->getModelo()->setData('mensajer', 'Successfully registered.');
                    }else{
                        $this->getModelo()->setData('mensajer', 'DataBase failed to register.');
                    }
                
            }else{
                $this->getModelo()->setData('mensajer', 'The provided passwords does not match, try again.');
            }
        }else{
            $this->getModelo()->setData('mensajer', 'There is a member using that login name already, try a new one.');
        }
        $this->index();
    }
    
    function doregister2(){
        $member = new Member();
        $member->read();
        $password2 = Request::read('password2');

        if($this->getModelo()->checkMemberByLogin($member) <= 0){
            if($member->getPassword() !== null || $password2 !==null){
            if($password2 == $member->getPassword()){
               
                    $encripted = Util::encryptPassword($member->getPassword());
                    $member->setPassword($encripted);
                    $res = $this->getModelo()->register($member);
                    if($res > 0){
                         header('Location: index.php?ruta=member&accion=addmember&op=add&res='.$res);
                    }else{
                        header('Location: index.php?ruta=member&accion=addmember&op=add&res='.$res);
                    }
                
            }else{
               header('Location: index.php?ruta=member&accion=addmember&op=add&res='.$res);
            }
        }
            header('Location: index.php?ruta=member&accion=addmember&op=add&res='.$res);
        }else{
            header('Location: index.php?ruta=member&accion=addmember&op=exist&res='.$res);
        }
        $this->index();
    }
    
    function dologin(){
        $member = new Member();
        $member->read();
        $memberdb = new Member();
        $memberdb = $this->getModelo()->getMemberByLogin($member);
        if($memberdb !== null){
            if(Util::verifyPassword($member->getPassword(), $memberdb->getPassword())){
                $this->getSession()->login($memberdb);
            }else{
                $this->getModelo()->setData('mensajel', 'The provided password does not match with the member.');
            }
        }else{
            $this->getModelo()->setData('mensajel', 'No such member registered, try register first.');
        }
        $this->index();
    }
    
    function dologout(){
        $this->getSession()->logout();
        $this->index();
    }
    
    function addmember(){
        if($this->isAdministrator()){
            
             $op = Request::read('op');
             $res = Request::read('res');

              if($res !== null){
        
                if($op == 'add'){
                    if($res > 0){
                        $res='Miembro añadido correctamente.';
                     }else{
                        $res='Lo siento, intentalo de nuevo.';
                     }
                }elseif($op == 'exist'){
                    $res = 'Lo sentimos, ese miembro ya existe';
                }
            $res = '<h3 class=" thumbnail text-center">'. $res .'</h3>';
            $this->getModelo()->setData('mensaje', $res);
              }  
            $this->getModelo()->setData('archivo', 'form_member.html');   
            
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
    
    /***** VISUALIZAR LA LINEA DE USUARIOS ******/
    function listmember(){
        if($this->isAdministrator()){
            
             $op = Request::read('op');
             $res = Request::read('res');
            
            if($res !== null){
                if($op == 'edit'){
                    if($res >= 0){
                        $res='Miembro editado correctamente.';
                    }else{
                        $res='Lo sentimos, intentelo de nuevo.';
                    }}elseif($op == 'del'){
                            if($res > 0){
                                $res='Miembro eliminado correctamente.';
                             }
                             else{
                                $res='Lo sentimos, intentelo de nuevo.';
                             }
                     }elseif($op == 'exist'){
                         $res='Lo sentimos, este miembro ya existe.';
                     }
            
            $res = '<h3 class=" thumbnail text-center">'. $res .'</h3>';

            $this->getModelo()->setData('mensaje', $res);
         }
            $this->getModelo()->setData('archivo', 'table_members.html'); 
            if(Request::read('page') === null){
                $page = 1;
            }else{
                $page = Request::read('page');
            }
            $paginate = new Pagination($this->getModelo()->getCount() , $page , 5);
            /*Placeholders de la lista de miembros*/
            /*Antes de paginar necesitamos saber si la lista de miembros es mayor de 0*/
            //$listaMembers = $this->getModelo()->getAll();
            
            
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
                
           
            $linea = '  <tr>
                            <td>{{id}}</td>
                            <td>{{login}}</td>
                            <td><a href="?ruta=member&accion=vieweditmember&id={{id}}"><i class="fa fa-edit fa-fw"></i>Editar</a></td>
                            <td><a class="aremove" data-toggle="modal" data-target="#modalDelete{{id}}" style="cursor: pointer;"><i class="fa fa-remove fa-fw"></i>Eliminar</a></td>
                        </tr>
                        <!-- Modal Para borrar Usuario 2 -->
                        <div id="modalDelete{{id}}" class="modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" id="titulo">Borrar Usuario {{login}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="?ruta=member&accion=removemember">
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
                        <!-- Fin Modal 2 -->';
            $members = $this->getModelo()->getPaginateMembers($paginate->getOffset(),  $paginate->getRpp());
            
          /*  echo Util::varDump($members);
            exit;*/
            
            $rango = '<ul class="pagination pl1"><li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=member&accion=listmember&page=' . $paginate->first() .'">First</a></li> ';
            $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=member&accion=listmember&page=' . $paginate->previous() . '">&laquo;</a></li>';       
            foreach($paginate->getRange() as $number){
                if($page == $number){
                $rango .= '<li class="active" ><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=member&accion=listmember&page=' . $number . '">' . $number . '</a> </li>';
                }else{
                $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=member&accion=listmember&page=' . $number . '">' . $number . '</a> </li>';
                }
            }
            $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=member&accion=listmember&page=' . $paginate->next() . '">&raquo;</a></li>'; 
            $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=member&accion=listmember&page=' . $paginate->last() . '">Last</a></li></ul> ';
            $this->getModelo()->setData('rango', $rango);
           
            $todo = '';
            foreach($members as $indice => $member) {
                $r = Util::renderText($linea, $member->getAttributesValues());
                $todo .= $r;
            }
            
            $this->getModelo()->setData('viewmember', $todo);
            //header('Location: index.php?op=borrado&res' . $r);
        }else{
            $this->index();
        }
        
    }
    
    function removemember(){
        if($this->isAdministrator()){
            $id = Request::read('id');
            if($id !== null){
  
               $r =  $this->getModelo()->removeMember($id);
                 header('Location: index.php?ruta=member&accion=listmember&op=del&res='.$r);
            }else{
                header('Location: index.php?ruta=member&accion=listmember&op=del&res='.$r);
            }
            
        }else{
            $this->index();
        }
    } 
    
    /********* EDITAR MIEMBROS ********/

    function vieweditmember(){
        if($this->isAdministrator()){
            
            $id=Request::read('id');
            if($member=$this->getModelo()->getMemberById($id) === null){
                header('Location: index.php?ruta=member');
            }else{
                $member=$this->getModelo()->getMemberById($id);
                $this->setCampos2($member);
                $this->getModelo()->setData('archivo', 'form_edit_member.html');
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
            $this->index();
        }
    }
    
    function editmember(){
        if($this->isAdministrator()){
            $member = new Member();
            $member->read();
            
            $memberdb = new Member();
            $memberdb = $this->getModelo()->getMemberById($member->getId());
            
            $newpass = Request::read('newpassword');
            $password2 = Request::read('password2');
            $r = $member->getLogin() == $memberdb->getLogin();
            
           // echo $r;
            
           $exist = $this->getModelo()->checkMemberByLogin($member);
            //exit;
            
            /*cho Util::varDump($member);
            echo Util::varDump($memberdb);
            exit;*/
        if(($exist == 1 && $r == 1) || $exist == 0){  
           /* echo 'hola';
            echo $newpass;
            echo $password2;
            echo Util::varDump($memberdb);
            exit;*/
            if($memberdb !== null && $newpass === $password2){
                
                $member->setPassword(Util::encryptPassword($newpass));
                $r = $this->getModelo()->editMember($member);
                header('Location:index.php?ruta=member&accion=listmember&op=edit&res='.$r);
            }else{
                 header("Location:index.php?ruta=member&accion=listmember&op=edit&res=".$r);
            }
        }else{
            header("Location:index.php?ruta=member&accion=listmember&op=exist&res=".$exist);
            
            }
        }else{
            $this->index();
        }
    }
    
     /********* EDITAR CURRENT MEMBER ********/
     
     function editcurrentmember(){
         if($this->isLogged()){
             $CurrentUser = $this->getSession()->getUser();
             //echo Util::varDump($CurrentUser);
           //  exit;
           
             
             $this->getModelo()->setData('archivo', 'edit_current_member.html');
             $this->setCampos2($CurrentUser);
             
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
        }}else{
            $this->getModelo()->setData('archivo', '_index.html');
        }
             
             
             
             
         }
     }
    
    
    
    
    
    
    
    
    
    

   
    
    