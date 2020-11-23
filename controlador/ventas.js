function ven_propescto(){

       $.ajax({
            type: 'GET',
            url: '../vistas/ventas/prospectos/index.php',
            success: function(resultado){
                    $("#encabezado").html("Listado de prospectos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function llama_ventas(){

       $.ajax({
            type: 'GET',
            url: '../vistas/ventas/act_ventas/index.php',
            success: function(resultado){
                    $("#encabezado").html("LLamadas");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}

function ven_seguimientos(){

       $.ajax({
            type: 'GET',
            url: '../vistas/ventas/seguimientos/index.php',
            success: function(resultado){
                    $("#encabezado").html("LLamadas");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}



function cop_cotizaciones(){

       $.ajax({
            type: 'GET',
            url: '../vistas/ventas/cotizacionesx/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);      
            }
           }); 
}


function ven_actividades(){

       $.ajax({
            type: 'GET',
            url: '../vistas/ventas/act_ventas/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);      
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