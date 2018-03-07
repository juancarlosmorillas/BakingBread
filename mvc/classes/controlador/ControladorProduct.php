<?php

class ControladorProduct extends Controlador{

    /**
     * Funcion para comprobar que el carrito existe, si no lo creamos y asi jeje
     */ 
    function abrirCart(){
        $sesion = $this->getSession();
        $carrito = $sesion->get('carrito');
        if($carrito !== null){
            $ticketdetails = $carrito->getCarrito();
        }else{
            $carrito = new Carrito();
            $sesion->set('carrito', $carrito);
        }

    }//Final de abrirChart


    function index(){
        if($this->isLogged()){
            $op = Request::read('op');
            $id = Request::read('id');
            $res = Request::read('res');

            if($res !== null || $id!==null){

                if($op == 'addProduct'){
                    
                    if($id > 0){
                        $res='Producto añadido correctamente.';
                    }else{
                        $res='Lo sentimos, intentelo de nuevo.';
                    }
                    
                }elseif($op =='exist'){
                $res='Lo sentimos, ese producto ya existe.';
             }
            
            $res = '<h3 class=" thumbnail text-center">'. $res .'</h3>';

            $this->getModelo()->setData('mensaje', $res);
         }
            $this->getModelo()->setData('archivo', 'form_products.html');
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
    }//Fin Index
    
    
    function addproduct(){
       if($this->isLogged()){
        $product = new Product();
        $product->read();
        $family = $product->getIdFamily();
        $exist = $this->getModelo()->checkProductByProduct($product);
        /*echo Util::varDump($product); // sacar la id de la tabla Family del pruducto
        exit;*/
    if ($exist === 0) {
           
        if($family !== null){
            $family = $this->getModelo()->getFamilyByNames($family);
            $idfamily = $family->getId();
            $product->setIdfamily($idfamily);
            $idproduct = $this->getModelo()->addproduct($product);
        if($idproduct !== null){
           /* echo 'hola';
            exit;*/
            //Se sube la foto con el nombre de la id del producto
            $this->subirfoto($idproduct);
            
        }
         
        }
        header("Location:index.php?ruta=product&id=". $idproduct . "&op=addProduct");   
        }else{
           header("Location:index.php?ruta=product&op=exist&res=".$exist); }
       }else{
             $this->getModelo()->setData('archivo', 'member_logged.html');
        }
        //hacer una funcion que cuando introduzca el producto devuelva su id asignada
      /* $this->subirfoto($product); */
    } //Fin addProduct
    
    /******** MIRAR PORQUE NO TENEMOS DERECHO DE ESCRITURA *******/
    function subirfoto($idproduct) {
        if($this->isLogged()) { 
            //$input, $name = null, $target = '.', $size = 0, 
            //$policy = FileUpload::RENOMBRAR
            $subir = new FileUpload('foto',$idproduct , '../../foto', 2 * 1024 * 1024, FileUpload::SOBREESCRIBIR);
            $r = $subir->upload();
            return $r;
        } else {
            $this->index();
        }
    }
    
    function listproduct(){
        if($this->isLogged()){
            $op = Request::read('op');
            $res = Request::read('res');
             
            if($res !== null){
                if($op == 'edit'){
                    if($res > 0){
                        $res='Producto editado correctamente.';
                     }else{
                        $res='Lo sentimos, intentelo de nuevo';
                     }
                    
                }elseif($op == 'del'){
                    if($res > 0){
                        $res='Producto eliminado correctamente.';
                     }
                     else{
                        $res='Lo sentimos, intentelo de nuevo';
                     }
             }elseif($op=='exist'){
                 $res='Lo sentimos, ese producto ya existe.';
             }
            
            $res = '<h3 class=" thumbnail text-center">'. $res .'</h3>';

            $this->getModelo()->setData('mensaje', $res);
         }
            
            $this->getModelo()->setData('archivo', 'table_products.html');  
            if(Request::read('page') === null){
                $page = 1;
            }else{
                $page = Request::read('page');
            }
            $paginate = new Pagination($this->getModelo()->getCount() , $page ,5);
            $products = $this->getModelo()->getPaginateProducts($paginate->getOffset(),  $paginate->getRpp());
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

            $families = '';
          /* echo Util::varDump($member);
            exit;*/
            $todo = '';
           
            
            $linea = '                  <tr>
                                            <td>{{id}}</td>
                                            <td>{{product}}</td>
                                            <td>{{idfamily}}</td>
                                            <td>{{price}}</td>
                                            <td>{{description}}</td>
                                            <td><a href="?ruta=product&accion=vieweditproduct&id={{id}}"><i class="fa fa-edit fa-fw"></i>Editar</a></td>
                                            <td><a class="aremove" data-toggle="modal" data-target="#modalDelete{{id}}" style="cursor: pointer;"><i class="fa fa-remove fa-fw"></i>Eliminar</a></td>
                                                                    
                                              <!-- Modal Para borrar producto -->
                                            <div id="modalDelete{{id}}" class="modal" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title" id="titulo">Borrar Producto {{product}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="?ruta=product&accion=removeproduct">
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
                                            </tr>
                                    ';
         /* $products = $this->getModelo()->getAllproductFamily();
           echo Util::varDump($products);
            exit;*/
            $todo = '';
            
            foreach($products as $indice => $product) {
                $r = Util::renderText($linea, $product->getValuesAttributes());
                $todo .= $r;
                
              
            }
           /* echo Util::varDump($todo);
            exit;*/
            
            $this->getModelo()->setData('viewproduct', $todo);
            
            /*
            echo Util::varDump($clients);
            exit;
            */
            $rango = '<ul class="pagination pl1"><li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=product&accion=listproduct&page=' . $paginate->first() . '">First</a> </li>';
            $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=product&accion=listproduct&page=' . $paginate->previous() . '">&laquo;</a></li>';
            $range = 2;
            //echo Util::varDump($paginate);
            //echo Util::varDump($paginate->getRange());
            $range = $paginate->getRange();
            //echo Util::varDump($range);
            foreach($paginate->getRange() as $number){
                if($page == $number){
                $rango .= '<li class="active"><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=product&accion=listproduct&page=' . $number . '">' . $number . '</a> </li>';
                }else{
                    $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=product&accion=listproduct&page=' . $number . '">' . $number . '</a> </li>';
                }
                
            }
            $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=product&accion=listproduct&page=' . $paginate->next() . '">&raquo;</a></li>';
            $rango .= '<li><a href="https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?&ruta=product&accion=listproduct&page=' . $paginate->last() . '">Last</a></li></ul> ';
            $this->getModelo()->setData('rango', $rango);
 
        }else{
             $this->getModelo()->setData('archivo', 'member_logged.html');
        }
        
    } 
    
    function vieweditproduct(){
        if($this->isLogged()){
            $id=Request::read('id');
            
            $product = $this->getModelo()->getProductById($id);
          if($product === null){
                header('Location: index.php?ruta=member');
            }else{
                $this->setCampos($product);
                $this->getModelo()->setData('archivo', 'form_edit_products.html');
                /*echo $product->getIdFamily();*/
                if($product->getIdFamily() === '1'){
                 $linea = ' <select name="idfamily" class="form-control">
                                                            <option >Pan</option>
                                                            <option >Croissants</option>
                                                            <option >Navidad</option>
                                                            <option >Otros</option>
                                                                          </select>';
                }elseif($product->getIdFamily() === '2'){
                 $linea = ' <select name="idfamily" class="form-control">
                                                            <option >Pan</option>
                                                            <option selected>Croissants</option>
                                                            <option >Navidad</option>
                                                            <option >Otros</option>
                                                                          </select>';
                }elseif($product->getIdFamily() === '3'){
                 $linea = ' <select name="idfamily" class="form-control">
                                                            <option> Pan</option>
                                                            <option>Croissants</option>
                                                            <option selected>Navidad</option>
                                                            <option>Otros</option>
                                                                          </select>';
                }else{
                 $linea = ' <select name="idfamily" class="form-control">
                                                            <option>Pan</option>
                                                            <option>Croissants</option>
                                                            <option >Navidad</option>
                                                            <option selected>Otros</option>
                                                                          </select>';
                }
              $this->getModelo()->setData('select', $linea);
    
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
            }}}else{
                $this->getModelo()->setData('archivo', '_index.html');
            }
    }
    
    function veravatar() {
        $id=Request::read('id');
        if($this->isLogged()) {
            header('Content-type: image/*');
            
            $archivo = '../../foto/' .$id;
            if(!file_exists($archivo)) {
                $archivo = '../../foto/default.jpg';
            }
            readfile($archivo);
            exit();
        } else {
            $this->index();
        }
    } //Fin veravatar
    
    function editproduct(){
        if($this->isLogged()){    
             $product = new Product();
             $product->read();
             $productBD = $this->getModelo()->getProductById($product->getId());
             $family = $product->getIdFamily(); 
            /*echo Util::varDump($productBD);
             exit;*/
             $exist = $this->getModelo()->checkProductByProduct($product);
             $res = $productBD->getProduct() == $product->getProduct();
            /* echo $exist;
            exit;*/
            if($exist === 0 || ($exist == 1 && $res == 1)){
            if($family !== null){
                $family = $this->getModelo()->getFamilyByNames($family);
                $idfamily = $family->getId();
                $product->setIdfamily($idfamily);
                $idproduct = $product->getId();
                $r = $this->getModelo()->editproduct($product);
                /*echo Util::varDump($idproduct); // sacar la id de la tabla Family del pruducto
                exit;*/
                if($r > 0){
                    $this->subirfoto($idproduct);
                   
                }
                header("Location:index.php?ruta=product&accion=listproduct&op=edit&res=".$r); 
            }}else{
                  header("Location:index.php?ruta=product&accion=listproduct&op=exist&res=".$exist); 
            }
 
        }else{
             $this->getModelo()->setData('archivo', '_index.html');
        }
    }
    
    function removeproduct(){
        if($this->isAdministrator()){
            $id = Request::read('id');
            
            if($id !== null){
               $r = $this->getModelo()->removeProduct($id);
               
                 header('Location: index.php?ruta=product&accion=listproduct&op=del&res='.$r);
            }else{
                header('Location: index.php?ruta=product&accion=listproduct&op=del&res='.$r);
            }
            
        }else{
            $this->index();
        }
    }
    
    function vertpv(){
        if($this->isLogged()){
            $this->abrirCart();
            $productos = $this->getModelo()->getAllLimitTPV();
            //echo Util::varDump($productos);
            $this->getModelo()->setData('archivo', '_tpv.html');
            $html = '';
            foreach($productos as $producto){
                $html .= '
                <div class="col-lg-4 col-md-6 col-s-6 col-xs-12 picTPV m10 fotoprod">
                    <img class="img-responsive" src="index.php?ruta=product&accion=veravatar&id=' . $producto->getId() .'">
                </div>
                ';
            }
            $this->getModelo()->setData('fotos', $html);
            //echo Util::varDump($this->getSession()->get('carrito'));
            /*SACAR EL ENLACE DEL ADMIN*/
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
            $this->index();
        }
    } //Final ver TPV     
    
        function vertpvBUENO(){
        if($this->isLogged()){
            
            $productos = $this->getModelo()->getAllLimitTPV();
            //echo Util::varDump($productos);
            $this->getModelo()->setData('archivo', '_tpv.html');
            $contador = 0;
            $html = '';
            foreach($productos as $producto){
                if($contador == 0){
                    $html .= '<div class="row p15">';
                    //echo '0';
                }
                //col-lg-4 col-md-12 col-xs-12 picTPV m10 foto
                $html .= '
                <div class="">
                    <img class="" src="index.php?ruta=product&accion=veravatar&id=' . $producto->getId() .'">
                </div>
                ';
                $contador++;
                if($contador > 2){
                    $html .= '</div>';
                    $contador = 0;
                    //echo '1';
                }
                
                
            }
            $this->getModelo()->setData('fotos', $html);
            
            /*SACAR EL ENLACE DEL ADMIN*/
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
            $this->index();
        }
    } //Final ver TPV   
    
    
    function newticket(){
        if($this->isLogged()){
            //Restaurar todos los valores
            $sesion = $this->getSession();
            $carrito = new Carrito();
            $sesion->set('carrito', $carrito);
            header('Location: index.php?ruta=product&accion=vertpv');
        }
    }
}