$(document).ready(function(){
    
    $(".aremove").click(function () {
    });
    
    /********     AJAX     **********/
    /*Busqueda de clientes por TIN*/
    $('#btnSearch').on('click', function(){
        $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'clientajax',
                    accion: 'searchclients'
                }
            }
            ).done(
                function (json){
                    var clientes = json.clientes;
                    var valorBusqueda = $('#vBusqueda').val();
                    var encontrados = buscarCliente(clientes, valorBusqueda);
                    var bodytpv = $('#tableBody');
                    /*Si existe body de la tabla es porque habia una busqueda anterior,
                    si existe eliminamos lo que tuvieramos en ese div*/
                    if(bodytpv != null){
                        var divTPV = $('#tableCTPV');
                        divTPV.children().remove();
                    }
                   if (encontrados.length > 0){
                       //Quito los eventos que existian antes
                       //$('.apuntaCliente').unbind('click', getClient());
                       //Sacar el HTML de una tabla cliente con los datos de los clientes del array
                       var html = 
                            '<div class="panel panel-primary mt50">'+
                        '<div class="panel-heading">'+
                            'Clients table'+
                        '</div>'+
                        '<div class="panel-body">'+
                            '<div class="table-responsive">'+
                                '<table class="table table-striped table-bordered table-hover">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th>Id</th>'+
                                            '<th>Name</th>'+
                                            '<th>Tin</th>'+
                                            '<th>Address</th>'+
                                            '<th>Postal Code</th>'+
                                            '<th>Email</th>'+
                                            '<th></th><th></th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id="tableBody">'+
                                          '</tbody>'+
                                    '</table>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                        var divTPV = $('#tableCTPV');
                        divTPV.append(html);
                        var bodytpv = $('#tableBody');
                        for(var i = 0; i < encontrados.length ; i++){
                            //alert (encontrados[i].name + encontrados[i].tin +encontrados[i].address +encontrados[i].postalcode+encontrados[i].email);
                            var htmlmitad = 
                                            '<tr>'+
                                                '<td>'+encontrados[i].id+'</td>'+
                                                '<td>'+encontrados[i].name+'</td>'+
                                                '<td>'+encontrados[i].tin+'</td>'+
                                                '<td>'+encontrados[i].address+'</td>'+
                                                '<td>'+encontrados[i].postalcode+'</td>'+
                                                '<td>'+encontrados[i].email+'</td>'+
                                                '<td><button data-id="'+encontrados[i].id+'" data-name="'+encontrados[i].name+'" class="btn btn-primary apuntaCliente"> Apuntar ticket </button></td>'+
                                                '<td><button class="btn btn-primary"> Facturar ticket </button></td>'+
                                            '</tr>';
                            bodytpv.append(htmlmitad);
                        }
                        
                        $('.apuntaCliente').on('click', getClient);
                        
                    } //Final del IF
                    
                   /*Ciclo de prueba para verificar que los datos son correctos*/
                   for(var i = 0; i < encontrados.length ; i++){
                       //alert (encontrados[i].name + encontrados[i].tin);
                   }
                }
                ).fail();
    });
    
    /*Recogemos los productos para el tpv*/
    $('#btnPan').on('click', function(){
        $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'productajax',
                    accion: 'verpanes'
                }
            }
            ).done(
                function (json){
                    var productos = json.productos;
                   
                    cambiaFotosTpv(productos);
                }
                ).fail();
    });
    
    $('#btnCroissants').on('click', function(){
        $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'productajax',
                    accion: 'vercroissants'
                }
            }
            ).done(
                function (json){
                    var productos = json.productos;
                    cambiaFotosTpv(productos);
                }
                ).fail();
    });
    
    $('#btnNavidad').on('click', function(){
        $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'productajax',
                    accion: 'vernavidad'
                }
            }
            ).done(
                function (json){
                    var productos = json.productos;
                    cambiaFotosTpv(productos);
                }
                ).fail();
    });
    
    $('#btnOtros').on('click', function(){
        $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'productajax',
                    accion: 'verotros'
                }
            }
            ).done(
                function (json){
                   var respuesta = json.productos;
                   
                   cambiaFotosTpv(respuesta);
                   
                }
                ).fail();
    });    
    
    /*************************FUNCIONES EXTERNAS***********************************/
    function cambiaFotosTpv(array){
        var fotos = $('#fotosTPV');
        var hijos = fotos.children();
        hijos.remove();
        fotos.unbind('click', addProductToTicket);
        for(var i = 0; i < array.length ; i++){
            var foto = '<div class="col-lg-4 col-md-12 col-xs-12 borde picTPV">'+
            '<img class="img-responsive " src="index.php?ruta=product&accion=veravatar&id=' + array[i].id +'">'+
            '</div>';
            fotos.append(foto);
        }
        //fotos.delegate('img', 'click', addProductToTicket);
        fotos.on('click', 'img', addProductToTicket);
    }
    
    /*function cambiaFotosTpvVieja(array){
        var fotos = $('#fotosTPV').find('img');
        //¿Que pasa si no tenemos 9 productos con fotos?
        /*Podria hacerlo al reves en el for, y simplemente cambiar tantas fotos como
        productos me devuelva la consulta*/
        /*for(var i = 0; i < fotos.length ; i++){
            if(array[i] != null){
                fotos[i].setAttribute('src', 'index.php?ruta=product&accion=veravatar&id=' + array[i].id);
            }
        }
    } */
    
    function buscarCliente(clientes, valorBusqueda){
        var encontrados = [];
        //Meto todos los clientes con TIN que coincidan en un array
        for(var i = 0; i < clientes.length ; i++){
            var tin = clientes[i].tin;
            var busqueda = tin.search(valorBusqueda);
            //alert('Tin: ' +tin+ ' valorBusqueda:' + valorBusqueda + ' busqueda = '+busqueda);
            if( busqueda != -1){
                encontrados.push(clientes[i]);
            }
        }
        //Devuelvo el array
        if(encontrados.length < 0){
            return -1;
        }else{
            return encontrados;
        }
    
    }
    
    /********Hacer que las fotos del tpv añadan algo a la lista de la compra********/
    //Recojo los tag img y les añado un evento 
    var fotosTPV = $('#fotosTPV').find('img').each(function(index){
        $(this).on('click', addProductToTicket);
    });
    
    //fotosTPV.delegate('img', 'click', addProductToTicket);
    function addProductToTicket(event){
         //Capturamos el id de la foto
            var src = $(this).attr('src');
            var array = src.split("");
            var encontrado = false;
            var i = array.length;
            while(!encontrado){
                if(array[i] == '='){
                    encontrado = true;
                }else{
                    i--;
                }
            }
            var idProduct = src.substr(i+1, array.length);
            $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'productajax',
                    accion: 'getproductoticket',
                    id: idProduct
                }
            }
            ).done(
                function (json){
                   if(json.respuesta.res == 1){
                       var bodyTabla = $('#bodyCompra');
                       /*Quitamos los eventos de todos los span porque despues 
                       se los damos de nuevo*/
                       $('td.add').unbind('click', suma);
                       $('td.substr').unbind('click', resta);
                       /**/
                       var id = json.producto.id;
                       var description = json.producto.description;
                       var precio = json.producto.price;
                       var cantidad = checkCantidad(id);
                       /*Si no habia fila, la crea, si la habia, la edita*/
                       if(cantidad == 1){
                            var html = 
                           '<tr>'+
                                '<td class="idp">'+id+'</td>'+
                                '<td>'+description+'</td>'+
                                '<td class="quantity">'+cantidad+'</td>'+
                                '<td class="price">'+precio+'</td>'+
                                '<td class="subprice">'+cantidad * precio +'</td>'+
                                '<td class="add"><span class="glyphicon glyphicon-plus"></span></td>'+
                                '<td class="substr"><span class="glyphicon glyphicon-minus"></span></td>'+
                            '</tr>';
                            bodyTabla.append(html);
                            //$('td.add').on('click', 'span', suma);
                            //$('td.substr').on('click', 'span', resta);
                       }else{
                            editRow(id, cantidad , precio);
                       }
                       //Calculamos el precio de la compra por el momento
                       totalCompra();
                       //Damos los eventos de nuevo
                       $('td.add').on('click', 'span', suma);
                       $('td.substr').on('click', 'span', resta);
                       addtoCart(id, cantidad, precio);
                   }else{
                       alert('error');
                   }
                   
                }
                ).fail();
        }//Fin AddProductToTicket
    
    function checkCantidad(id){
        var encontrado = false;
        var cantidad = 0;
        $('#bodyCompra > tr').each(function(){
            var idFila = $(this).find('td.idp').text();
            if(idFila == id){
                cantidad = $(this).find('td.quantity').text();
                encontrado = true;
            }
        });
        if(encontrado){
            cantidad++;
        }else{
            cantidad = 1;
        }
        return cantidad;
    }//Fin funcion checkCantidad
    
    
    function  editRow(id, cantidad, precio){
        $('#bodyCompra > tr').each(function(){
            var idFila = $(this).find('td.idp').text();
            if(idFila == id){
                $(this).find('td.quantity').text(cantidad);
                $(this).find('td.subprice').text(cantidad * precio);
            }
        });
        //para la tabla del modal
        $('#bodyCompra2 > tr').each(function(){
            var idFila = $(this).find('td.idp').text();
            if(idFila == id){
                $(this).find('td.quantity').text(cantidad);
                $(this).find('td.subprice').text(cantidad * precio);
            }
        });
    } // Fin Edit Row

    /*function  editRow(id, cantidad, precio){
        $('#bodyCompra > tr').each(function(){
            var idFila = $(this).find('td.idp').text();
            if(idFila == id){
                $(this).find('td.quantity').text(cantidad);
                $(this).find('td.subprice').text(cantidad * precio);
            }
        });    
    }*/ // Fin Edit Row

    function totalCompra(){
        //var total = $('#pprecio > span').text() * 1.0;
        //alert('Total al principio: ' +total);
        var total = 0.0;
        $('#bodyCompra > tr').each(function(){
            var precioFila = $(this).find('td.subprice').text() * 1.0;
            //alert ('PrecioFila en el blucle: '+precioFila);
            total = total + precioFila;
            //alert('total en el bucle: '+total);
        });
        //alert('total al final: '+total);
        $('#pprecio > span').text(total);
    }
    
    
    function totalCompraModal(){
        //var total = $('#pprecio > span').text() * 1.0;
        //alert('Total al principio: ' +total);
        var total = 0.0;
        $('#bodyCompra2 > tr').each(function(){
            var precioFila = $(this).find('td.subprice').text() * 1.0;
            //alert ('PrecioFila en el blucle: '+precioFila);
            total = total + precioFila;
            //alert('total en el bucle: '+total);
        });
        //alert('total al final: '+total);
        $('#pprecio > span').text(total);
    }    
    
    
    function suma(){
        var id = $(this).parent('td').siblings('td.idp').text();
        var cantidad = $(this).parent('td').siblings('td.quantity').text() * 1.0;
        var precio = $(this).parent('td').siblings('td.price').text();
        editRow(id, cantidad+1 , precio);
        totalCompra();
        //alert (id + cantidad + precio);
    }
    
    function resta(){
        var id = $(this).parent('td').siblings('td.idp').text();
        var cantidad = $(this).parent('td').siblings('td.quantity').text() * 1.0;
        var precio = $(this).parent('td').siblings('td.price').text();
        if(cantidad == 1){
            $(this).parent('td').parent('tr').remove();
        }else{
            editRow(id, cantidad-1 , precio);  
        }
        
        totalCompra();
        //alert (id + cantidad + precio);
    }
    
    function sumaModal(){
        var id = $(this).parent('td').siblings('td.idp').text();
        var cantidad = $(this).parent('td').siblings('td.quantity').text() * 1.0;
        var precio = $(this).parent('td').siblings('td.price').text();
        editRow(id, cantidad+1 , precio);
        totalCompraModal();
    }
    
    function restaModal(event){
        var id = $(this).parent('td').siblings('td.idp').text();
        var cantidad = $(this).parent('td').siblings('td.quantity').text() * 1.0;
        var precio = $(this).parent('td').siblings('td.price').text();
        if(cantidad == 1){
            
            $(this).parent('td').parent('tr').remove();
            var compra2 = $('#compra > #bodyCompra2').clone();
            $('#bodyCompra').replaceWith(compra2);
            $('#bodyCompra2').attr('id', 'bodyCompra');
            compra2.find('#bodyCompra2').attr('id', 'bodyCompra');
            $('#bodyCompra > tr > td.add').on('click', 'span', suma);
            $('#bodyCompra > tr > td.substr').on('click', 'span', resta);
        }else{
            editRow(id, cantidad-1 , precio);  
        }
        totalCompraModal();
    }
    
    /*GUARDAR TICKET*/
    
    $('#btnGuardarFuera').on('click', mostrarCompra);
    
    function mostrarCompra(event){
        //Recogemos los datos que queremos insertar en el Modal
        var divModal = $('#tableCompra');
        var total = $('#pprecio').clone();
        var compra = $('#compra').clone();
        compra.find('#bodyCompra').attr('id', 'bodyCompra2');
        //Eliminamos el interior de divModal para que no se repita la compra
        divModal.children().remove();
        //Insertamos la compra
        divModal.append(compra);
        divModal.append(total);
        
        /*Por si editamos la compra*/
        $('#bodyCompra2 > tr > td.add').on('click', 'span', suma);
        $('#bodyCompra2 > tr > td.substr').on('click', 'span', restaModal);
        totalCompraModal();
        /*Dentro de las funciones de suma y resta llamamos a edit row, que cambia las filas
        de las dos tablas de la compra y asi editamos las dos a la vez*/
    }
    
    function getClient(event){
        $('#ticketHeader > h3 > span.fa ').remove();
        //alert($(this).data("name"));
        var nombre = $(this).data("name");
        var id = $(this).data("id");
        var span = '<span class="fa fa-times"></span>';
        $('#ticketHeader > h3 > span').text(nombre);
        $('#ticketHeader > h3').append(span);
        $('#ticketHeader > h3 > span.fa').on('click', function(){
            $('#ticketHeader > h3 > span').text('');
            $('#ticketHeader > h3 > span.fa ').remove();
        });
        $('#btnSave').on('click', function(){
            $.ajax(
                {
                    url: 'index.php',
                    type: 'GET',
                    dataType: 'json',
                    data:{
                        ruta: 'ticketajax',
                        accion: 'saveticket',
                        id: id
                    }
                }
                ).done(
                    function (json){
                        if(json.respuesta.res == 1){
                            alert('holi');
                            //var idClient = json.respuesta.cliente['id'];
                            
                            /*$.ajax(
                                {
                                    url: 'index.php',
                                    type: 'GET',
                                    dataType: 'json',
                                    data:{
                                        ruta: 'ticketajax',
                                        accion: 'guardarticket',
                                        idcliente: idClient
                                    }
                                
                                }
                            ).done(
                                function(json){
                                    
                                }
                                ).fail();*/ //Final del ajax de dentro
                        }else{
                            alert('error');   
                        }
                    }
                    ).fail();
        });
    }
    
    //Funcion para guardar el ticket en la base de datos
    //ticket + ticketdetail
    function addtoCart(idproduct, quantity, price){
        $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'ticketajax',
                    accion: 'addtoCart',
                    idproduct: idproduct,
                    quantity: quantity,
                    price: price
                }
            }
            ).done(
                function (json){
                   var respuesta = json.respuesta.res;
                    //alert('Hola');  
                   
                }
                ).fail();
    }
    
    /*Fin Guardar Ticket*/
    
    (function(){
        
        
    });
    
}); //Fin del $(document).ready()