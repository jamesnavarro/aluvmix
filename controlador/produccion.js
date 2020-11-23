function pro_puestos(){

       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/puestos/index.php',
            success: function(resultado){
                    $("#encabezado").html("Procesos de Trabajos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function pro_puestos_master(){

       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/masterpuestos/index.php',
            success: function(resultado){
                    $("#encabezado").html("Puestos de Trabajos");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function pro_rutas(){

       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/rutas/index.php',
            success: function(resultado){
                    $("#encabezado").html("Hoja de Rutas");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function pro_crearrutas(cod){
    $("#producto").val(cod);
    pro_mostrarrutas(cod);
}
function pro_mostrarrutas(cod){
        $.ajax({
            type: 'GET',
            data: 'cod='+cod,
            url: 'produccion/rutas/tablarutas.php',
            success: function(resultado){
                 $("#mostrar_rutasx").html(resultado);
            }
  });
}
function pro_addpuesto(){
    var codi = $("#producto").val();
    var puesto = $("#puesto").val();
            $.ajax({
            type: 'GET',
            data: 'codi='+codi+'&puesto='+puesto+'&sw=4',
            url: 'produccion/rutas/acciones.php',
            success: function(resultado){
                 pro_mostrarrutas(codi);
                 mostrar_lis(1);

            }
  });

}
function pro_delruta(id){
    var pro = confirm("Esta seguro de quitar este puesto de trabajo");
    if(pro){
var codi = $("#producto").val();
            $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',
            url: 'produccion/rutas/acciones.php',
            success: function(resultado){
                 alert('Se elimino con exito');
                 pro_mostrarrutas(codi);
            }
  });
    }
}
function pro_editarruta(id){
    var sec = $("#secu"+id).val();
    var codi = $("#producto").val();
            $.ajax({
            type: 'GET',
            data: 'sec='+sec+'&id='+id+'&sw=2',
            url: 'produccion/rutas/acciones.php',
            success: function(resultado){
                 pro_mostrarrutas(codi);
            }
  });

}
function pro_cuentaco(){

       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/cuentas_cobro/index.php',
            success: function(resultado){
                    $("#encabezado").html("Cuentas de cobro por servicios");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function pro_servi(){

       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/servicios/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}


function pro_publicos(){

       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/publicos/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}      
function pro_burro(){

       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/burros/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

} 
function lista_costo(){

       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/hojas/index.php',
            success: function(resultado){
                    $("#encabezado").html("Hoja de Costos");
                    $("#controlador").html(resultado);
                  //$("#msg").html("Pend: 1 ");
            }
           }); 

} 
function infor_puesto(){

       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/proc_trabajo/index.php',
            success: function(resultado){
                    $("#encabezado").html("INFORMACION PUESTOS DE TRABAJO");
                    $("#controlador").html(resultado);
                  //$("#msg").html("Pend: 1 ");
            }
           }); 

} 