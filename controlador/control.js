$(function() {
//esta funciones son para mostrar las notificaciones de llamadas y mostrar la hora
//vriables globales 
//    setInterval(function() { 
//         call();
//         notificacion();
//     }, 10000);
//     setInterval(function() { 
//         hora();
//     }, 1000);
     //fin de notificaciones
     var refreshId = setInterval(function() { vero(); }, 5000);
    $('#entrar').click(function(){
             validar_usuario();
     });

     $('#password').change(function(){
             validar_usuario();
     });
   
});

    
function validar_usuario(){
    var user = $("#usuario").val();
    var clave = $("#password").val();
    
    if(user===''){
        alert("Digita el usuario");
        $("#usuario").focus();
        return false; 
    }
    if(clave===''){
        alert("Digita tu clave de acceso");
        $("#password").focus();
        return false;
    }
    $.ajax({
            type: 'GET',
            data: 'usuario='+user+'&clave='+clave+'',
            url: 'modelo/validar_acceso.php',
            success: function(resultado){
                    if(resultado==1){

                        location.href="vistas/index.php";
                    }else{
                        alert("usuario o clave no valido");
                        return false;
                    }
            }
           });
}


function p(){
    sweetAlert("ola");
}
function notificacion(){

       $.ajax({
            type: 'GET',
            url: '../vistas/actividades/acciones.php?sw=6',
            success: function(resultado){
                if(resultado!==''){
                    alert('! Tienes una llamada pendiente por realizar a '+resultado+' Â¡');
                }
                   //$("#msg").html(resultado); 
           
            }
           });
}
var ok;
function nueva_cotizacion(modulo){

       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/ventas/sala_ventas.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                    $("#continuar").attr("disabled", false);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 

}
function validar_modulo(modulo){
    if(modulo=='presupuestos'){
        return '1';
    }else{
        alert('No tiene acceso');
        return '0';
        
    }
}
function pre_porcentaje(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/porcentajes/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}
function pre_costos(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/costos/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}
function pre_servitemple(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/servicio_temple/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pre_gastos(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_gastos/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pre_manobra(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_mo/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pre_otrogasto(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_otro/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}


function pre_prearea(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/precios_areas/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}


function pre_confialum(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_color/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pre_confivid(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/confi_vidrio/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pre_listmate(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_per/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}


function pre_listservi(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_servicios/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pre_mantedolar(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/conf_dolar/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pre_acce(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/colores_ace/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pro_grupo(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/grupo_trabajo/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pro_repgrupo(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/reporte_trab/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}

function pro_confipag(){
 
       $.ajax({
            type: 'GET',
            url: '../vistas/produccion/conf_pagos/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}













function cotizaciones(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/cotizaciones/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
           
            }
           }); 
}
function cotizaciones_aprobadas(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/cotizaciones_aprobadas/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
           
            }
           }); 
}
function report_cot_presu(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/report_cot_presu/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
//  PARTE DE LA  CONFIGURACION //
function porcentajes(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/porcentajes/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function buscar(){
    var id = $("#buscar").val();
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2.1',
            url: '../vistas/presupuestos/productos_dos/acciones.php',
            success: function(res){
                    pre_mostrar_detalle_productos(res);
            }
           }); 
}
function productos_dos(id){

       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/productos_dos/index.php',
            success: function(resultado){
                    $("#encabezado").html("CREACION DE ITEMS DT <span id='paginacion' ></span><b>Buscar Id:<input type='text' id='buscar' onchange='buscar()'></b> ");
                    $("#controlador").html(resultado);
                    if(id!='0'){
                        pre_mostrar_detalle_productos(id);
                        paginacion();
                    }
            }
           }); 
}
function pre_mostrar_detalle_productos(id){
    $.ajax({
            type: 'GET',
            data:'id='+id+'&sw=2',
            url: '../vistas/presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                
                var p = eval(resultado);
                    $("#id_pro").val(p[0]);
                    $("#idp").val(id);
                    $("#foto").attr("disabled",false);
                    $("#loadi").attr("disabled",false);
                    $("#codigo").val(id);
                    $("#linea").val(p[1]);
                    $("#referencia").val(p[6]);
                    $("#sistema").val(p[30]); 
                    $("#anc_general").val(p[3]);
                    $("#imagen").html(p[28]);
                    $("#btn_ok").html(p[19]);
                    $("#btn_aprobado").html(p[23]);
                    $("#btn_estado").html(p[21]);
                    $("#tipo").val(p[31]);
                    $("#alt_gener").val(p[5]);
                    $("#hojas").val(p[12]);
                    $("#alt_rejilla").val(p[10]);
                    $("#referencia").val(p[6]);
                    $("#configuracion").val(p[32]);
                    $("#cantidad").val('1');
                    $("#tipo_vid").val('');
                    $("#espesor_vid").val(p[33]);
                    //$("#tipo_riel").val(p[34]); 
                    if(p[34]=='true'){
                         $("#tipo_riel").prop("checked", true );
                          $("#modulo_rieles").show();
                     }else{
                         $("#tipo_riel").prop("checked", false );
                         $("#modulo_rieles").hide();
                     }
                    //$("#tipo_alfa").val(p[35]);
                    if(p[35]=='true'){
                         $("#tipo_alfa").prop("checked", true );
                         $("#modulo_alfajia").show();
                     }else{
                         $("#tipo_alfa").prop("checked", false );
                          $("#modulo_alfajia").hide();
                     }
                    $("#ancho_max").val(p[16]);
                    $("#descripcion").val(p[4]);
                    //$("#tipo_rejilla").val(p[38]);
                    if(p[38]=='true'){
                         $("#tipo_rejilla").prop("checked", true );
                         $("#modulo_rejilla").show();
                     }else{
                         $("#tipo_rejilla").prop("checked", false );
                          $("#modulo_rejilla").hide();
                     }
                    $("#alto_max").val(p[17]);
                    //$("#tipo_cie").val(p[36]);
                    if(p[36]=='true'){
                         $("#tipo_cie").prop("checked", true );
                         $("#modulo_cierre").show();
                         $("#can_cie").attr("disabled", false );
                     }else{
                         $("#tipo_cie").prop("checked", false );
                         $("#modulo_cierre").hide();
                         $("#can_cie").attr("disabled", true );
                     }
                    $("#cuerpo_fij").val(p[37]);
                    $("#per").val(p[8]);
                    $("#boq").val(p[9]);
                    $("#lam").val(p[15]);
                     $("#espaciadores").val(p[39]);
                     $("#interlayer").val(p[40]);
                     $("#ancho_cf_der").val(p[41]);
                     $("#ancho_cf_izq").val(p[42]);
                     $("#alto_cf_sup").val(p[43]);
                     $("#alto_cf_inf").val(p[44]);
                     if(p[45]=='true'){
                         $("#tipo_rod").prop("checked", true );
                         $("#modulo_rodajas").show();
                         $("#can_rod").attr("disabled", false );
                     }else{
                         $("#tipo_rod").prop("checked", false );
                         $("#modulo_rodajas").hide();
                         $("#can_rod").attr("disabled", true );
                     }
                     if(p[49]=='true'){
                         $("#tipo_bra").prop("checked", true );
                         $("#modulo_brazos").show();
                         $("#can_bra").attr("disabled", false );
                     }else{
                         $("#tipo_bra").prop("checked", false );
                         $("#modulo_brazos").hide();
                         $("#can_bra").attr("disabled", true );
                     }
                     if(p[50]=='true'){
                         $("#tipo_bis").prop("checked", true );
                         $("#modulo_bisagras").show();
                     }else{
                         $("#tipo_bis").prop("checked", false );
                         $("#modulo_bisagras").hide();
                     }
                     $("#obser").val(p[47]);
                     $("#aprobadopor").val(p[48]);
                      $("#can_cie").val(p[51]);
                       $("#can_rod").val(p[52]);
                        $("#can_bra").val(p[53]);
                       
                     
                    console.log(p[31]);
                    pre_parametros1(id);
                    pre_veracc(id);
                    pre_ver_cierres(id);
                    pre_ver_rodajas(id);
                    pre_ver_brazos(id);
                    pre_ver_bisagras(id);
                    pre_parametros_perfil(id);
                    pre_parametros_rieles(id);
                    pre_parametros_alfajia(id);
                    pre_mostrarvidrios(id);
                    validar_linea();
                    pre_select_ref1();
                    pre_mostrar_rejilla(id);
                    pre_mostrar_rejilla_select(id);
                    opction_medidas();
                    mostrar_instalacion();
                    cargar_select_instalacion();
                    
            }
           });

}
function paginacion(){
    $.ajax({
       type:'GET',
       url: '../vistas/presupuestos/productos_dos/paginacion.php',
       success:function(res){
           var p = eval(res);
           $("#paginacion").html(p[0]);
           //productos_dos(id);
       }
    });
}
function validar_linea(){
        var linea = $("#linea").val();
            if(linea=='Vidrio'){
                    $("#sistema").attr("disabled", true); 
                    $("#tipo").attr("disabled", true).val('N/A');
                    $("#hojas").attr("disabled", true).val('1');
                    $("#alt_rejilla").attr("disabled", true).val('0');
                    $("#configuracion").attr("disabled", true).val('VIDRIO');
                    $("#tipo_vid").attr("disabled", true).val('');
                    $("#espesor_vid").attr("disabled", true).val('0');
                    $("#tipo_riel").attr("disabled", true).val('No');
                    $("#tipo_alfa").attr("disabled", true).val('No');
                    $("#tipo_rejilla").attr("disabled", true).val('No');
                    $("#tipo_cie").attr("disabled", true).val('No');
                    $("#cuerpo_fij").attr("disabled", true).val('No');
                    $("#per").attr("disabled", false);
                    $("#boq").attr("disabled", false);
                    $("#lam").attr("disabled", false);
                     $("#espaciadores").attr("disabled", false);
                     $("#interlayer").attr("disabled", false);
                     $("#ancho_cf_der").attr("disabled", true);
                     $("#ancho_cf_izq").attr("disabled", true);
                     $("#alto_cf_sup").attr("disabled", true);
                     $("#alto_cf_inf").attr("disabled", true);
            }else if(linea=='Aluminio'){
                   $("#sistema").attr("disabled", false); 
                    $("#tipo").attr("disabled", false).val();
                    $("#hojas").attr("disabled", false).val();
                    $("#alt_rejilla").attr("disabled", false);
                    $("#configuracion").attr("disabled", false);
                    $("#tipo_vid").attr("disabled", false);
                    $("#espesor_vid").attr("disabled", false);
                    $("#tipo_riel").attr("disabled", false);
                    $("#tipo_alfa").attr("disabled", false);
                    $("#tipo_rejilla").attr("disabled", false);
                    $("#tipo_cie").attr("disabled", false);
                    $("#cuerpo_fij").attr("disabled", false);
                    $("#per").attr("disabled", true);
                    $("#boq").attr("disabled", true);
                    $("#lam").attr("disabled", true);
                     $("#espaciadores").attr("disabled", true);
                     $("#interlayer").attr("disabled", true);
                     $("#ancho_cf_der").attr("disabled", false);
                     $("#ancho_cf_izq").attr("disabled", false);
                     $("#alto_cf_sup").attr("disabled", false);
                     $("#alto_cf_inf").attr("disabled", false);
            }else{
                      $("#sistema").attr("disabled", false); 
                    $("#tipo").attr("disabled", false).val();
                    $("#hojas").attr("disabled", false).val();
                    $("#alt_rejilla").attr("disabled", false);
                    $("#configuracion").attr("disabled", false);
                    $("#tipo_vid").attr("disabled", false);
                    $("#espesor_vid").attr("disabled", false);
                    $("#tipo_riel").attr("disabled", false);
                    $("#tipo_alfa").attr("disabled", false);
                    $("#tipo_rejilla").attr("disabled", false);
                    $("#tipo_cie").attr("disabled", false);
                    $("#cuerpo_fij").attr("disabled", false);
                    $("#per").attr("disabled", true);
                    $("#boq").attr("disabled", true);
                    $("#lam").attr("disabled", true);
                    $("#espaciadores").attr("disabled", true);
                    $("#interlayer").attr("disabled", true);
                    $("#ancho_cf_der").attr("disabled", false);
                    $("#ancho_cf_izq").attr("disabled", false);
                    $("#alto_cf_sup").attr("disabled", false);
                    $("#alto_cf_inf").attr("disabled", false);
            }
}
function mod_sistemas(){
   
       $.ajax({
            type: 'GET',
             url: '../vistas/presupuestos/mod_sistemas/index.php',
            success: function(resultado){
                    $("#encabezado").html("Crear Sistema");
                    $("#controlador").html(resultado);
                    
            }
           }); 
}
function cotizae_prod(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/cotizae_prod/index.php',
            success: function(resultado){
                    $("#encabezado").html("COTIZACION");
                    $("#controlador").html(resultado);
            }
           }); 
}


function servicio_temple(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/servicio_temple/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}

function crear_gastos(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_gastos/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}

function crear_mo(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_mo/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}

function crear_otro(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_otro/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}


function precios_areas(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/precios_areas/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function crear_color(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_color/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}

function confi_vidrio(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/confi_vidrio/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function crear_per(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_per/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function crear_servicios(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_servicios/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}


function conf_dolar(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/conf_dolar/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}


function pre_lista(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/lista/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function pre_lista_sin(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/lista_1/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function pre_lista_anulado(){
  
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/lista_2/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function listad(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/listad/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}

function lista_sin_aprobar(){
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/lista_sin_aprobar/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function inv_lineas(){
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/lineas/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}

function sublineas(){
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/sublineas/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}

function crear_cot(id){
   console.log(id);
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/crear_cot/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                    if (id!==0){
                    consultar_prod(id);  
                    }    
            }
           }); 
}
function pre_cotizaciones(){
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/cotizaciones/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);      
            }
           }); 
}
function maestroinv(){
       $.ajax({
            type: 'GET',
            url: '../vistas/inventario/producto/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                        
            }
           }); 
}

function consultar_prod(id){
    console.log(id);
     $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/productos_dos/acciones.php',
            data: 'id='+id+'&sw=2',
                success: function(resultado){ 
                 var p = eval(resultado);
                 $("#id_pronue").val(p[0]);
                 $("#lineaprod").val(p[1]);
                 $("#codnupro").val(p[2]);
                 $("#ancnup").val(p[3]);
                 $("#nom_pronue").val(p[4]);
                 $("#alt_nuep").val(p[5]);
                 $("#ref_pronue").val(p[6]);
                 $("#kit_nue").val(p[7]);
                 $("#perfo_pronue").val(p[8]);
                 $("#boque_nuep").val(p[9]);
                 $("#alcu_pronue").val(p[10]);
                 $("#alven_nuep").val(p[11]);
                 $("#modn_nuep").val(p[12]);
                 $("#ancf_pronue").val(p[13]);
                 $("#alvendos_nuep").val(p[14]);
                 $("#lami_nuep").val(p[15]);
                 $("#ancmax_pronue").val(p[16]);
                 $("#altmax_nuep").val(p[17]);
                 $("#id_ok").val(p[18]);
                 $("#btn_ok").html(p[19]);
                 $("#apro_id").html(p[20]);
                 $("#btn_apro").html(p[21]);
                 $("#aprobado_id").html(p[22]);
                 $("#btn_aproba").html(p[23]);
                 $("#id_revi").html(p[24]);
                 $("#btn_rev").html(p[25]);
                 $("#id_actu").html(p[26]);
                 $("#btn_actua").html(p[27]);
                 $("#imag_u").html(p[28]);
                 $("#imag_d").html(p[29]);
            }
            
     });   
}

function inv_bodegas(){
       $.ajax({
            type: 'GET',
            url: '../vistas/inventario/bodegas/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                        
            }
           }); 
}

function inv_tmovimientos(){
       $.ajax({
            type: 'GET',
            url: '../vistas/inventario/movimiento/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                        
            }
           }); 
}


function cont_empleados(){
       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/empleados/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                        
            }
           }); 
}

function nuevo_usuario(){
       $.ajax({
            type: 'GET',
            url: '../vistas/contabilidad/usuarios/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                        
            }
           }); 
}
//function ver_cotizacion(id){
//    window.open("presupuestos/ventas/sala_ventas.php?c="+id,"CotizacionVidrio","width=1200px , height=600px");
//}
function ver_cotizacion(id){
       $.ajax({
            type: 'GET',
            data: 'c='+id,
            url: 'presupuestos/ventas/sala_ventas.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   cargar_cotizacion(id);
                        
            }
           }); 
}
function cargar_cotizacion(cot){
                $.ajax({
            post:'GET',
            data:'cot='+cot+'&sw=11',
            url:'presupuestos/ventas/acciones.php',
            success:function(d){
                console.log(d);
                var p = eval(d);
                $("#mostrar_lineas").html("<tr><td colspan='14'><center> <img src='../images/load.gif'>Cargando Tabla.. </center></td></tr>");
                $("#idc").val(p[0]);
                $("#cli").val(p[7]);
                $("#dir").val(p[2]);
                $("#tel").val(p[3]);
                $("#dep").val(p[8]);
                $("#ciu").val(p[9]);
                $("#max").val(p[11]);
                $("#desc").val('0');
                $("#doc").val(p[1]);
                $("#cot").val(p[21]);
                $("#ver").val(p[22]);
                $("#ser").val(p[24]);
                $("#pag").val(p[23]);
                $("#reg").val(p[14]);
                $("#ent").val(p[25]);
                $("#obs").val(p[26]);
                $("#obra").val(p[13]);
                $("#est").val(p[16]);
                $("#idcot").val(cot);
                $("#ana").val(p[27]);
                $("#ase").val(p[28]);
                $("#desperdicio").val(p[29]);
                $("#desperdicio_al").val(p[30]);
                $("#desperdicio_acc").val(p[31]);
                $("#desperdicio_ace").val(p[32]);
                $("#desperdicio_esp").val(p[33]);
                $("#desperdicio_int").val(p[34]);
                console.log(p[34]);
                if(p[16]!=='En proceso'){
                    $("#guardar").attr("disabled", true);
                    $("#formulario").html("");
                    $("#msg").html('<img src="../imagenes/ok.png"><font color="green"> Congelado</font>');
                }else{
                    $("#guardar").attr("disabled", false); 
                    $("#msg").html('<img src="../imagenes/ledrojo.gif"><font color="red"> Sin Congelar</font>');
                }
                if(p[24]!=='0'){
                    $("#desc").attr("disabled", false);
                    $("#desc").val('0');
                    $("#ser").attr("disabled", false);
                }else{
                    $("#desc").attr("disabled", false);
                    $("#ser").attr("disabled", false);
                    var t = p[11] * (-1);
                    if(t > 40){
                        var de = p[11];
                    }else{
                        de = 0;
                    }
                    $("#desc").val(de);
                }
                if(p[0]==null){
                    $("#idc").focus();
                }else{
                    $("#ser").focus();
                }
                $("#iva").val(p[36]);
                mostrar_items(cot);
                mostrar_ventas();
                mostrar_servicios(cot);
            } 
        });
}

function tipo_vi(){
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/tipo_vidrio/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}


function pre_inst(){
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/precio_instalacion/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function pre_conefom(){
   var token = 'fomplus';
   //$("#loading").html('<img src="../imagenes/load.gif">');
       $.ajax({
            type: 'GET',
            url: 'http://172.16.0.19/api/',
            dataType: 'json',
             headers: { 'Authorization': 'Bearer cn389ncoiwuencr' },
            success: function(resultado){
                    console.log(resultado);
                    $("#encabezado").html("Lista de materiales fom");
                    $("#sinc").attr("disabled",true);
                    //var p = eval(resultado);
                    //$('#controlador').html(resultado.length);
                    var total = resultado.length;
                    var nuevafila= "";
                    for (  i = 0 ; i < resultado.length; i++){ //cuenta la cantidad de registros
                        nuevafila += "<b>" +resultado[i].codigo + " | " +resultado[i].descripcion + " </b></br>";  
                        var cod = resultado[i].codigo;
                        var des = resultado[i].descripcion;
                        var ref = resultado[i].referencia;
                        var col = resultado[i].color;
                        var valor = resultado[i].costo_ult_com;
                        var user = resultado[i].usuario;
                        //$("#loading").html('Procesando codigo:'+cod);
                        sincronizar_productos(cod,des,ref,col,valor,user,i,total);
                    }
                    //$("#controlador").html(nuevafila);
            }
           }); 
}
function sincronizar_productos(cod,des,ref,col,valor,user,i,total){
    
    $.ajax({
            type: 'GET',
            data: 'cod='+encodeURIComponent(cod)+'&des='+encodeURIComponent(des)+'&ref='+encodeURIComponent(ref)+'&col='+col+'&valor='+valor+'&user='+user+'&sw=1',
            url: 'presupuestos/conexiones/acciones.php',
            success: function(resultado){
                    //$("#loading").html('Guardados :'+i);
                    var p = ((Math.round(i) * 100) / total) + 1;
                    $("#barra1").attr('data-percent',''+parseInt(p)+'%');
                    $("#barra").attr('style','width:'+parseInt(p)+'%');
                    if(parseInt(p)>=98){
                        $("#sinc").attr("disabled",false);
                    }
                    console.log(i+' de '+total);
         
            }
           }); 
}
function pre_update_productos(){
       window.open("http://172.16.0.19/productos.php","cargar","width=400px , height=100px"); 
}
function pre_coloralum(){
   
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/color_alum/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}


function crear_refe(){
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/referen_f/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function crear_sistm(){
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/sistemas_f/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
            }
           }); 
}
function pre_grupos_ref(){
         window.open("presupuestos/productos_dos/grupos_referencias/index.php","grupos","width= 800px , height=550px");
}
function pre_grupos_kit(){
    $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/kits/index.php',
            success: function(resultado){
                    $("#encabezado").html("Listado de kits");
                    $("#controlador").html(resultado);
            }
           }); 
}
function pre_cristal(){
       $.ajax({
            type: 'GET',
            url: '../vistas/presupuestos/cristales/index.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   //$("#msg").html("Pend: 1 ");
            }
           }); 
}
function vero(){
    var use = $("#usuarioy").val();
    $.ajax({
            post:'GET',
            data:'use='+use,
            url: '../vistas/usuarios_online.php',
            success: function(data){
                //alert(data);
               $('#chat').html(data);
            }
	   });
}