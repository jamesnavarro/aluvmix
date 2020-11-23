$(function(){
});

function pedidos_d(){

       $.ajax({
            type: 'GET',
            url: '../vistas/despacho/aprofom/index.php',
            success: function(resultado){
                    $("#encabezado").html("Pedidos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}

