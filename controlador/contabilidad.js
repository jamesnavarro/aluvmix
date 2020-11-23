function cont_centrocostos(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/centrocostos/index.php',
            success: function(resultado){
                    $("#encabezado").html("Centro de Costos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function cont_centroproduccion(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/centroproduccion/index.php',
            success: function(resultado){
                    $("#encabezado").html("Centro de Produccion");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function cont_areascc(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/areascc/index.php',
            success: function(resultado){
                    $("#encabezado").html("Areas CC");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function cont_clasescc(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/clases/index.php',
            success: function(resultado){
                    $("#encabezado").html("Clases CC");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function cont_claseactividad(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/clasesactividad/index.php',
            success: function(resultado){
                    $("#encabezado").html("Clases de actividad");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function cont_terceros(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/terceros/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Terceros");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function conf_modulos(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/modulos/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Modulos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function cont_cargos(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/cargo/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Cargos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function cont_areatrab(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/area_trab/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Areas");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}

function cont_contables(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/cod_contables/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de codigos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}

function cont_parafiscales(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/parafiscales_c/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}

function cont_tcuentas(){

       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/tipo_cta/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}





function cont_jerarquias(){
    window.open("contabilidad/centrocostos/jerarquias.php","Jerarquias","width=600px , height=600px");
}

