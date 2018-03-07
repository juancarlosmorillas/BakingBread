$(document).ready(function(){
    
    /*FUNCIONES DE ESTILOS*/
    
    $(window).on('resize', function(){
        location.reload();
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
                            'Tabla de clientes'+
                        '</div>'+
                        '<div class="panel-body">'+
                            '<div class="table-responsive">'+
                                '<table class="table table-striped table-bordered table-hover">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th>Id</th>'+
                                            '<th>Nombre</th>'+
                                            '<th>TIN</th>'+
                                            '<th>Direccion</th>'+
                                            '<th>Código Postal</th>'+
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
                        
                        
                    } /*Final del IF */else{
                        var divTPV = $('#tableCTPV');
                        divTPV.remove('#errorSearching')
                        var mensaje = '<h3 id="errorSearching" class="text-center">Lo sentimos, no hemos encontrado ningun registro</h3>';
                        divTPV.append(mensaje);
                        
                    }
                    
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
        var valorBusqueda = valorBusqueda.toUpperCase();
        if(valorBusqueda !== ""){
            for(var i = 0; i < clientes.length ; i++){
            var tin = clientes[i].tin;
            tin = tin.toUpperCase();
            var busqueda = tin.search(valorBusqueda);
                if( busqueda != -1){
                    encontrados.push(clientes[i]);
                }
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
                       var carrito = json.carrito;
                       pintarCarrito(carrito);
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
        //var cantidad = $(this).parent('td').siblings('td.quantity').text() * 1.0;
        $.ajax(
                {
                    url: 'index.php',
                    type: 'GET',
                    dataType: 'json',
                    data:{
                        ruta: 'productajax',
                        accion: 'sumar',
                        id: id
                    }
                }
                ).done(
                    function (json){
                        var carrito = json.carrito;
                        pintarCarrito(carrito);
                    }
                ).fail();
    }
    
    function resta(){
        var id = $(this).parent('td').siblings('td.idp').text();
        $.ajax(
                {
                    url: 'index.php',
                    type: 'GET',
                    dataType: 'json',
                    data:{
                        ruta: 'productajax',
                        accion: 'restar',
                        id: id
                    }
                }
                ).done(
                    function (json){
                        var carrito = json.carrito;
                        pintarCarrito(carrito);
                    }
                ).fail();
    }
    
    function sumaModal(){
        alert('prueba');
        var id = $(this).parent('td').siblings('td.idp').text();
        $.ajax(
                {
                    url: 'index.php',
                    type: 'GET',
                    dataType: 'json',
                    data:{
                        ruta: 'productajax',
                        accion: 'sumar',
                        id: id
                    }
                }
                ).done(
                    function (json){
                        var carrito = json.carrito;
                        pintarCarritoModal(carrito);
                    }
                ).fail();
    }
    
    function restaModal(event){
        var id = $(this).parent('td').siblings('td.idp').text();
        $.ajax(
                {
                    url: 'index.php',
                    type: 'GET',
                    dataType: 'json',
                    data:{
                        ruta: 'productajax',
                        accion: 'restar',
                        id: id
                    }
                }
                ).done(
                    function (json){
                        var carrito = json.carrito;
                        pintarCarritoModal(carrito);
                    }
                ).fail();
        /*
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
        totalCompraModal();*/    
    }//Fin resta Modal
    
    /*GUARDAR TICKET*/
    
    $('#btnGuardarFuera').on('click', mostrarCompra);
    
    function mostrarCompra(event){
        //La funcion anterior esta en el backUp
        $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'productajax',
                    accion: 'getCart'
                }
            }
            ).done(
                function (json){
                    var carrito = json.carrito;
                    pintarCarritoModal(carrito);  
                }
            ).fail();
    }
    
    /**/
    function getClient(event){
        $('#ticketHeader > h3 > span.fa ').remove();
        var nombre = $(this).data("name");
        var id = $(this).data("id");
        $('#test').text(id);
       // alert(prueba);
        var span = '<span class="fa fa-times"></span>';
        $('#ticketHeader > h3 > span').text(nombre);
        $('#ticketHeader > h3').append(span);
        $('#ticketHeader > h3 > span.fa').on('click', function(){
            $('#ticketHeader > h3 > span').text('');
            $('#ticketHeader > h3 > span.fa ').remove();
            $('#test').text('');
        //alert(prueba);
        });
    }
    
    
    
    $('#btnSave').on('click', saveTicket);
    function saveTicket(event){
        var idCliente = $('#test').text();
        //alert('entro');
        /*Si esta vacio lo guarda como cliente nulo*/
        $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'ticketajax',
                    accion: 'saveticket',
                    idcliente: idCliente
                }
            
            }
        ).done(
            function(json){
                if(json.respuesta.res == 1){
                    //alert('holi');
                    //window.location.reload(true);
                    window.location.replace('https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?ruta=main&accion=compra');
                }else{
                    window.location.replace('https://proyecto-panaderia-juankamorillas.c9users.io/mvc/index.php?ruta=main&accion=compra2');
                }
            }
            ).fail();
    }
    
    $('#newTicket').on('click', function(e){
         $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'ticketajax',
                    accion: 'newticket',
                }
            
            }
        ).done(
            function(json){
                if(json.respuesta == 1){
                    //alert('holi');
                }
            }
            ).fail();
    });
    
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
    
    function pintarCarrito(carrito){
        var bodyTabla = $('#bodyCompra');
        /*Para pintar el carrito, primero se borra entero y luego lo pintamos*/
        bodyTabla.children().remove();
        for(var i = 0; i<carrito.length; i++){
            var id = carrito[i].id;
            var description = carrito[i].item.description;
            var cantidad = carrito[i].cantidad;
            var precio = carrito[i].item.price;
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
        }
        $('td.add').on('click', 'span', suma);
        $('td.substr').on('click', 'span', resta);
        totalCompra();
    }//Fin de pintar carrito
    
    function pintarCarritoModal(carrito){
        /*Pintamos el carrito principal*/
        var bodyTabla = $('#bodyCompra');
        bodyTabla.children().remove();
        /*Pintamos el carrito del Modal*/
        var divModal = $('#tableCompra');
        divModal.children().remove();
        var table = 
            '<table id="compra" class="table table-striped table-bordered table-hover">'+
                '<thead>'+
                    '<tr>'+
                        '<td>Código</td>'+
                        '<td>Descripción</td>'+
                        '<td>Cantidad</td>'+
                        '<td>Precio</td>'+
                        '<td>Subtotal (€)</td>'+
                        '<td></td>'+
                        '<td></td>'+
                    '</tr>'+
                '</thead>'+
                '<tbody id="bodyCompra2">'+
                '</tbody>'+
            '</table>';
        divModal.append(table);
        var bodyCompra = $('#bodyCompra2');
        for(var i = 0; i<carrito.length; i++){
            var id = carrito[i].id;
            var description = carrito[i].item.description;
            var cantidad = carrito[i].cantidad;
            var precio = carrito[i].item.price;
            var html = 
            '<tr>'+
                '<td class="idp">'+id+'</td>'+
                '<td>'+description+'</td>'+
                '<td class="quantity">'+cantidad+'</td>'+
                '<td class="price">'+precio+'</td>'+
                '<td class="subprice">'+cantidad * precio +'</td>'+
                '<td class="add2"><span class="glyphicon glyphicon-plus"></span></td>'+
                '<td class="substr2"><span class="glyphicon glyphicon-minus"></span></td>'+
            '</tr>';
            bodyTabla.append(html);
            bodyCompra.append(html);
        }
        var total = $('#pprecio').clone();
        divModal.append(total);
        $('td.add').on('click', 'span', suma);
        $('td.substr').on('click', 'span', resta);
        $('td.add2').on('click', 'span', sumaModal);
        $('td.substr2').on('click', 'span', restaModal);
        totalCompra();
        totalCompraModal();
    }
    
    /*Funcion autoejecutable para pintar el carrito si existe*/
    (function(){
        $.ajax(
            {
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                data:{
                    ruta: 'productajax',
                    accion: 'getCart'
                }
            }
            ).done(
                function (json){
                    var carrito = json.carrito;
                    pintarCarrito(carrito);  
                }
            ).fail();
    })();
    
}); //Fin del $(document).ready()