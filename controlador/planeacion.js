$(function() {

});

function pla_apro(est){
    $.ajax({
            type: 'GET',
            url: '../vistas/planeacion/cotizaciones/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Cotizaciones por Aprobar");
                    $("#controlador").html(resultado);
            }
           }); 
}

function pla_aprofom(est){
    $.ajax({
            type: 'GET',
            url: '../vistas/planeacion/aprofom/index.php',
            success: function(resultado){
                    $("#encabezado").html("<b>Pedidos Generados</b>");
                    $("#controlador").html(resultado);
            }
           }); 
}
function des_aprofom(est){
    $.ajax({
            type: 'GET',
            url: '../vistas/planeacion/despacho/index.php',
            success: function(resultado){
                    $("#encabezado").html("<b>Pedidos Generados</b>");
                    $("#controlador").html(resultado);
            }
           }); 
}

function pla_ped(est){
    $.ajax({
            type: 'GET',
            url: '../vistas/planeacion/pedido/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Pedidos");
                    $("#controlador").html(resultado);
            }
           }); 
}
function pla_ordenes(){
    $.ajax({
            type: 'GET',
            url: '../vistas/planeacion/orden/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Orden produccion");
                    $("#controlador").html(resultado);
            }
           }); 
}
function pla_ordenes_rep(){
    $.ajax({
            type: 'GET',
            url: '../vistas/planeacion/orden/index_rep.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de Orden Reposicion");
                    $("#controlador").html(resultado);
            }
           }); 
}
function ver_cotizacion_pla(id){
   
       $.ajax({
            type: 'GET',
            data: 'c='+id,
            url: 'planeacion/ventas/sala_ventas.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   cargar_cotizacion_pla(id);
                        
            }
           }); 
}

function cargar_cotizacion_pla(cot){
                $.ajax({
            post:'GET',
            data:'cot='+cot+'&sw=11',
            url:'planeacion/ventas/acciones.php',
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
                if(p[16]=='Pedido por aprobar'){
                    $("#pedido").html('');
                }else if(p[16]=='Aprobado'){
                    $("#aprobar").html('');
                    $("#num_ped").html('Pedido No. <input type="text" style="width:50px" disabled id="ped" value="'+p[37]+'"> | Fecha Pédido: '+p[38]+' |  Generado por: '+p[39]);
                }else{
                    $("#pedido").html('');
                    $("#aprobar").html('');
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
            } 
        });
}

function ver_orden(ord,id){
   
       $.ajax({
            type: 'GET',
            data: 'c='+id+'&orden='+ord,
            url: 'planeacion/ventas/detalle_orden.php',
            success: function(resultado){
                    $("#encabezado").html("");
                    $("#controlador").html(resultado);
                   cargar_orden(id,ord);
                        
            }
           }); 
}

function cargar_orden(cot,orden){
                $.ajax({
            post:'GET',
            data:'cot='+cot+'&orden='+orden+'&sw=1',
            url:'planeacion/orden/modelo.php',
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
                if(p[41]!=='En proceso'){
                    $("#guardar").attr("disabled", true);
                    $("#formulario").html("");
                    $("#msg").html('<img src="../imagenes/ok.png"><font color="green">'+p[41]+'</font>');
                }else{
                    $("#guardar").attr("disabled", false); 
                    $("#msg").html('<img src="../imagenes/ledrojo.gif"><font color="red">'+p[41]+'</font>');
                }
                if(p[16]=='Pedido por aprobar'){
                    $("#pedido").html('');
                }else if(p[16]=='Aprobado'){
                    $("#aprobar").html('');
                    $("#num_ped").html('Pedido No. <input type="text" style="width:50px" disabled id="ped" value="'+p[37]+'"> | Fecha Pédido: '+p[38]+' |  Generado por: '+p[39]);
                }else{
                    $("#pedido").html('');
                    $("#aprobar").html('');
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
                mostrar_ventas(); //ojo con este modulo
            } 
        });
}


function manteped(est){
    $.ajax({
            type: 'GET',
            url: '../vistas/planeacion/mantenimiento/index.php',
            success: function(resultado){
                    $("#encabezado").html("Mantenimiento de pedidos");
                    $("#controlador").html(resultado);
            }
           }); 
}
function terce_pla(){
    $.ajax({
            type: 'GET',
            url: '../vistas/planeacion/terceros/index.php',
            success: function(resultado){
                    $("#encabezado").html("Lista de terceros");
                    $("#controlador").html(resultado);
            }
           }); 
}