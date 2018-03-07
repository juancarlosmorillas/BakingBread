$(document).ready(function () {
    var login = $('[ name = login]');
    var pass = $('[name = password]');
    var newpass = $('[name = newpassword]');
    var pass2 = $('[name = password2]');
    var name = $('[name = name]');
    var surname = $('[name = surname]');
    var correo = $('[name = email]');
    var tin = $('[name = tin]');
    var TIN = $('#vBusqueda');
    var address = $('[name = address]');
    var location = $('[name = location]');
    var province = $('[name = province]');
    var postalcode = $('[name = postalcode]');
    var product = $('[name = product]');
    var price = $('[name = price]');
    var description = $('[name = description]');
    var span = '<span class="span2">*<span>';
    var span2 = '<span class="spanblack">*<span>';
    var incorrect = '<span class ="span2"> formato no válido </span>';
    var incorrect2 = '<span class ="spanblack"> formato no válido </span>';


    $('#formlogin').on('submit', function (e) {

        var VL = validarTexto(login.val(), 1);
        var VP = validarTextoNum(pass.val(), 4);
        var VP2 = validarContra2(pass.val(), pass2.val());

        if (VL == true && VP == true && VP2 == true) {
            login.removeClass('error');
            login.prev('span').remove();
            login.prev('span').remove();
            
            pass.removeClass('error');
            pass.prev('span').remove();
            pass.prev('span').remove();     
            
            pass2.removeClass('error');
            pass2.prev('span').remove();
            pass2.prev('span').remove();
        } else {
            if (VL == false) {
                login.addClass('error');
                login.prev('label').after(span).after(incorrect);
            } else {
                login.removeClass('error');
                login.prev('span').remove();
                login.prev('span').remove();
    
            }
            if (VP == false) {
                pass.addClass('error');
                pass.prev('label').after(span).after(incorrect);
            } else {
                pass.removeClass('error');
                pass.prev('span').remove();
                pass.prev('span').remove();
                
            }
            if (VP2 == false) {
                pass2.addClass('error');
                pass2.prev('label').after(span).after(incorrect);
            } else {
                pass2.removeClass('error');
                pass2.prev('span').remove();
                pass2.prev('span').remove();
            }

            e.preventDefault();
        }
    });
    
    $('#formeditlogin').on('submit', function (e) {

        var VL = validarTexto(login.val(), 1);
        var VNP = validarTextoNum(newpass.val(),4);
        var VP2 = validarContra2(newpass.val(), pass2.val());

        if (VL == true && VNP == true && VP2 == true) {
            
            login.removeClass('error');
            login.prev('span').remove();
            login.prev('span').remove();
            
            newpass.removeClass('error');
            newpass.prev('span').remove();  
            newpass.prev('span').remove();
            
            pass2.removeClass('error');
            pass2.prev('span').remove();
            pass2.prev('span').remove();
        } else {
            if (VL == false) {
                login.addClass('error');
                login.prev('label').after(span).after(incorrect);;
            } else {
                login.removeClass('error');
                login.prev('span').remove();
                login.prev('span').remove();
                
            }
            if (VNP == false) {
                newpass.addClass('error');
                newpass.prev('label').after(span).after(incorrect);

            } else {
                newpass.removeClass('error');
                newpass.prev('span').remove();  
                newpass.prev('span').remove();
            }
            if (VP2 == false) {
                pass2.addClass('error');
                pass2.prev('label').after(span).after(incorrect);;
            } else {
                pass2.removeClass('error');
                pass2.prev('span').remove();
                pass2.prev('span').remove();
            }

            e.preventDefault();
        }
    });
    
     $('#formlog').on('submit', function (e) {

        var VL = validarTexto(login.val(), 1);
        var VP = validarTextoNum(pass.val(), 4);
        
        if (VL == true && VP == true) {

            login.removeClass('error');
            login.prev('span').remove();
            
             pass.removeClass('error');     
             pass.prev('span').remove();
        } else {
            if (VL == false) {
                login.addClass('error');
                login.prev('label').after(span);
            } else {
                login.removeClass('error');
                login.prev('span').remove();
            }
            if (VP == false) {
                pass.addClass('error');
                pass.prev('label').after(span);
            } else {
                pass.removeClass('error');
                pass.prev('span').remove();
            }

            e.preventDefault();
        }
    });
    
   /*$('#btnSearch').on('click', function (event) {
        var VTIN = validarTIN(TIN.val());
        
        if (VTIN == true) {
        TIN.removeClass('error');
        } else {
            if (VTIN == false) {
                TIN.addClass('error');
            }
            event.preventDefault();
        }
    });*/


    $('#formclient').on('submit', function (e) {

        var VN = validarTexto(name.val(), 1);
        var VSN = validarTexto(surname.val(), 1);
        var VC = validarEmail(correo.val());
        var VT = validarTIN(tin.val());
        var VA = validarString(address.val());
        var VL = validarTextoNum(location.val(), 1);
        var VPR = validarTexto(province.val(), 1);
        var VCP = validarNumeros(postalcode.val(), 5);

        if (VN == true && VSN == true && VT == true && VA == true) {

            name.removeClass('error');
            name.prev('span').remove();
            name.prev('span').remove();

            surname.removeClass('error');
            surname.prev('span').remove();
            surname.prev('span').remove();
            
            correo.removeClass('error');
            correo.prev('span').remove();
            correo.prev('span').remove();
            
            tin.removeClass('error');
            tin.prev('span').remove();
            tin.prev('span').remove();
            
            address.removeClass('error');
            address.prev('span').remove();
            address.prev('span').remove();
            
            location.removeClass('error');
            location.prev('span').remove();
            location.prev('span').remove();
            
            province.removeClass('error');
            province.prev('span').remove();
            province.prev('span').remove();
            
            postalcode.removeClass('error');
            postalcode.prev('span').remove();
            postalcode.prev('span').remove();

        } else {
            if (VN == false) {
                name.addClass('error');
                name.prev('label').after(span).after(incorrect);
              
            } else {
                name.removeClass('error');
                name.prev('span').remove();
                name.prev('span').remove();
            }

            if (VSN == false) {
                surname.addClass('error');
                surname.prev('label').after(span).after(incorrect);
            } else {
                surname.removeClass('error');
                surname.prev('span').remove();
                surname.prev('span').remove();
            }

            if (VC == false) {
                //correo.addClass('error');
                correo.prev('label').after(incorrect2);
            } else {
                //correo.removeClass('error');
                correo.prev('span').remove();
              
            }
            if (VT == false) {
                tin.addClass('error');
                tin.prev('label').after(span).after(incorrect);
            } else {
                tin.removeClass('error');
                tin.prev('span').remove();
                tin.prev('span').remove();
            }
            if (VA == false) {
                address.addClass('error');
                address.prev('label').after(span).after(incorrect);
            } else {
                address.removeClass('error');
                address.prev('span').remove();
                address.prev('span').remove();
            }
            if (VL == false) {
                //location.addClass('error');
                location.prev('label').after(incorrect2);
            } else {
               // location.removeClass('error');
                location.prev('span').remove();
                
            }
            if (VPR == false) {
               // province.addClass('error');
                province.prev('label').after(incorrect2);
            } else {
                province.removeClass('error');
                province.prev('span').remove();
                
            }
            if (VCP == false) {
               // postalcode.addClass('error');
                postalcode.prev('label').after(incorrect2);
            } else {
                //postalcode.removeClass('error');
                postalcode.prev('span').remove();
                
            }

            e.preventDefault();
        }

    });

    $('#formproduct').on('submit', function (e) {

        var VPRO = validarTexto(product.val(), 3);
        var VPRI = validarPrecio(price.val());
        var VDES = validarTextArea(description.text());

        if (VPRO == true && VPRI == true && VDES == true) {


        } else {
            if (VPRO == false) {
                product.addClass('error');
                product.prev('label').after(span).after(incorrect);
            } else {
                product.removeClass('error');
                product.prev('span').remove();
                price.prev('span').remove();
            }
            if (VPRI == false) {
                price.addClass('error');
                price.prev('label').after(span).after(incorrect);
            } else {
                price.removeClass('error');
                price.prev('span').remove();
                price.prev('span').remove();
            }
            if (VDES == false) {
                description.addClass('error');
                description.prev('label').after(span).after(incorrect);
            } else {
                description.removeClass('error');
                description.prev('span').remove();
                description.prev('span').remove();
            }
            
            e.preventDefault();
        }
        
    });

    function validarTexto(nombre, min) {
        nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóú]+(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/;
        var salida = false;
        if (nombreRegex.test(nombre) && nombre!="" && nombre.length>min ) {
            salida = true;
        }
        return salida;
    }
    

    function validarString(nombre) {
      var salida = false;
      var direccion = jQuery.type(nombre);
        if(direccion === "string"){
            if(nombre == "" ){
                salida = false;
            }else{
            salida = true;    
            }
        }
        return salida;
    }
    function validarTextArea(nombre) {
      var salida = false;
      var direccion = jQuery.type(nombre);
        if(direccion === "string"){
            if(nombre == " " ){
                salida = false;
            }else{
            salida = true;    
            }
        }
        return salida;
    }
    
      function validarTextoNum(nombre, min) {
        nombreRegex = /^[0-9a-zA-Z]*$/;
       /* var prueba = /^[a-zA-Z]*$/;*/
        var salida = false;
        if (nombreRegex.test(nombre) && nombre!="" && nombre.length>=min ) {
            salida = true;
        }
        return salida;
    }
    
    function validarContra2(contra, contra2) {
        var salida = false;
        if (contra != '' && contra2 != '') {
            if (contra === contra2) {
                salida = true;
            }
        }
        return salida;
    }

    function validarEmail(email) {
        emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        var salida = false;
        if (emailRegex.test(email) && email != "") {
            salida = true;
        } else {

        }
        return salida;
    }

    function validarNumeros(codPostal, min) {
        postalRegex = /^[0-9]*$/;
        var salida = false;
        if (postalRegex.test(codPostal) && codPostal.length == min) {
            salida = true;
        }
        return salida;
    }

    function validarPass(password) {
        PassRegex = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{4,16}$/;
        var salida = false;
        if (PassRegex.test(password)) {
            salida = true;
        }
        return salida;

    }
    function validarTIN(tin) {
        tinRegex = /(\d{8})([-]?)([A-Z]{1})/;
        var salida = false;
        if (tinRegex.test(tin)) {
            salida = true;
        }

        return salida;
    }

    function istin(tin) {
        var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

    }

    function validarPrecio(price) {
        precioRegex = /^-?[0-9]+([,\.][0-9]*)?$/;
        var salida = false;
        if (precioRegex.test(price)) {
            salida = true;
        }
        return salida;
    }

     name.each(function(){
         $(this).on('invalid',function (e) {
             
            e.target.setCustomValidity("");
            
            if (!e.target.validity.valid) {
                
                if (e.target.name == "name") {
                    e.target.setCustomValidity("Nombre no completo");
                }

            }
        })
         
     });

    surname.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "surname") {
                        e.target.setCustomValidity("Apellido no completo");
                    }
    
                }
            })
             
         });
         
         
    tin.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "tin") {
                        e.target.setCustomValidity("TIN no completado");
                    }
    
                }
            })
             
         });
         
         correo.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "email") {
                        e.target.setCustomValidity("Correo no completado");
                    }
    
                }
            })
             
         });
         
         address.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "address") {
                        e.target.setCustomValidity("Dirección no completada");
                    }
    
                }
            })
             
         });
         
         postalcode.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "postalcode") {
                        e.target.setCustomValidity("Código Postal no completo");
                    }
    
                }
            })
             
         });
         
         login.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "login") {
                        e.target.setCustomValidity("Login no completo");
                    }
    
                }
            })
             
         });
         
         location.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "location") {
                        e.target.setCustomValidity("Localidad no completada");
                    }
    
                }
            })
             
         });
         
          province.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "province") {
                        e.target.setCustomValidity("Provincia no completa");
                    }
    
                }
            })
             
         });
         
         product.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "product") {
                        e.target.setCustomValidity("Producto no completado");
                    }
    
                }
            })
             
         });
         
         
         price.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "price") {
                        e.target.setCustomValidity("Precio no completado");
                    }
    
                }
            })
             
         });
         
         
         pass.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "password") {
                        e.target.setCustomValidity("Contraseña no completada");
                    }
    
                }
            })
             
         });
         
        newpass.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "password2") {
                        e.target.setCustomValidity("Contraseña no completada");
                    }
    
                }
            })
             
         });
         
         
         pass2.each(function(){
             $(this).on('invalid',function (e) {
                 
                e.target.setCustomValidity("");
                
                if (!e.target.validity.valid) {
                    
                    if (e.target.name == "pass2") {
                        e.target.setCustomValidity("Contraseña no completada");
                    }
    
                }
            })
             
         });
         





});
