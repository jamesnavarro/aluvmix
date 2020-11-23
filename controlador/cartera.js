function car_terceros(){

       $.ajax({
            type: 'GET',
            url: '../vistas/cartera/terceros/index.php',
            success: function(resultado){
                    $("#encabezado").html("Listado de Terceros");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function car_terceroepro(){

       $.ajax({
            type: 'GET',
            url: '../vistas/cartera/proveedores/index.php',
            success: function(resultado){
                    $("#encabezado").html("Listado de Terceros");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function car_terceroeprofom(){

       $.ajax({
            type: 'GET',
            url: '../vistas/inventario/proveedores/index.php',
            success: function(resultado){
                    $("#encabezado").html("Listado de Proveedores");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function car_clientesfom(){

       $.ajax({
            type: 'GET',
            url: '../vistas/cartera/clientes/index.php',
            success: function(resultado){
                    $("#encabezado").html("Listado de Clientes");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function car_contactos(){

       $.ajax({
            type: 'GET',
            url: '../vistas/cartera/contactos/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Contactos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function car_contratos(){

       $.ajax({
            type: 'GET',
            url: '../vistas/cartera/contratos/index.php',
            success: function(resultado){
                    $("#encabezado").html("Listado de Contratos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function car_llamadas(){

       $.ajax({
            type: 'GET',
            url: '../vistas/cartera/actividades/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Llamadas");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function detalles(id){
    window.open("../vistas/cartera/contratos/detalles.php?id="+id , "Informe", " width= 1000 , height=600 ");
}