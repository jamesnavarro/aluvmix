$(function(){
    
 }); 
 function BuscarGrupo(){
        var area = $("#area").val();
        $.ajax({
                type: 'GET',
                data: 'area='+area+'&sw=1',
                url: '../vistas/produccion/reporte_trab/acciones.php',
            success: function(d){
                $("#grupo").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    function BuscarDetGrupo(){
        var id = $("#grupo").val();
        $.ajax({
                type: 'GET',
                data: 'id='+id+'&sw=2',
                url: '../vistas/produccion/reporte_trab/acciones.php',
            success: function(d){
                $("#detallegrupo").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
        $.ajax({
                type: 'GET',
                data: 'id='+id+'&sw=2.1',
                url: '../vistas/produccion/reporte_trab/acciones.php',
            success: function(d){
                var p = eval(d);
                
                $("#vl_ofi").val(p[0]);
                $("#vl_ayu").val(p[1]);
                $("#tipo").val(p[2]);
                
            }
        });
    }
function GenerarReporte(){
         var grupo = $("#grupo").val();
         var area = $("#area").val();
         var inicio = $("#inicio").val();
         var fin = $("#fin").val();
         var opf = $("#opf").val();
         var ofi = $("#vl_ofi").val();
         var ayu = $("#vl_ayu").val();
         var tipo = $("#tipo").val();
         if(grupo==''){
             alert('Selecciona el area');
             $("#area").focus();
             return false;
         }
         if(grupo==''){
             alert('Selecciona el grupo');
             $("#grupo").focus();
             return false;
         }
         if(area==''){
             alert('Selecciona la fecha de inicio');
             $("#inicio").focus();
             return false;
         }
         if(inicio==''){
             alert('Selecciona la fecha final');
             $("#fin").focus();
             return false;
         }
         $("#boton1").html('<img src="../images/guardando.gif"> Generando');
         $.ajax({
                type: 'GET',
                data: 'area='+area+'&grupo='+grupo+'&inicio='+inicio+'&fin='+fin+'&opf='+opf+'&ofi='+ofi+'&ayu='+ayu+'&tipo='+tipo+'&sw=3',
                url: '../vistas/produccion/reporte_trab/acciones.php',
            success: function(d){
                $("#mostrarreporte").html(d);
                $("#boton1").html('Buscar');
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    function DetalleGenerarReporte(){
         var grupo = $("#grupo").val();
         var area = $("#area").val();
         var inicio = $("#inicio").val();
         var fin = $("#fin").val();
         var opf = $("#opf").val();
         var ofi = $("#vl_ofi").val();
         var ayu = $("#vl_ayu").val();
         var tipo = $("#tipo").val();
         //alert(inicio);
         $("#btn").html('<img src="../images/guardando.gif"> Generando..');
        $.ajax({
                type: 'GET',
                data: 'area='+area+'&grupo='+grupo+'&inicio='+inicio+'&fin='+fin+'&opf='+opf+'&ofi='+ofi+'&ayu='+ayu+'&tipo='+tipo+'&sw=4',
                url: '../vistas/produccion/reporte_trab/acciones.php',
            success: function(d){
                $("#mostrarreportedetallado").html(d);
                $("#btn").html('Ver Detalle');
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
     function DetallePorOp(id,opf){
         var grupo = $("#grupo").val();
         var area = $("#area").val();
         var inicio = $("#inicio").val();
         var fin = $("#fin").val();
         var ofi = $("#vl_ofi").val();
         var ayu = $("#vl_ayu").val();
         var tipo = $("#tipo").val();
         $("#btn"+id).html('<img src="../images/guardando.gif"> Generando..');
        $.ajax({
                type: 'GET',
                data: 'area='+area+'&grupo='+grupo+'&inicio='+inicio+'&fin='+fin+'&opf='+opf+'&ofi='+ofi+'&ayu='+ayu+'&tipo='+tipo+'&id='+id+'&sw=5',
                url: '../vistas/produccion/reporte_trab/acciones.php',
            success: function(d){
                $("#"+id).html(d);
                $("#btn"+id).html('Ver mas Detalle');
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    function ocultar(id){
        $("#"+id).html('');
    }
 
 function printer(){
     var grupo = $("#grupo").val();
         var area = $("#area").val();
         var inicio = $("#inicio").val();
         var fin = $("#fin").val();
         var ofi = $("#vl_ofi").val();
         var ayu = $("#vl_ayu").val();
         var tipo = $("#tipo").val();
    window.open('../vistas/produccion/reporte_trab/print_reptrab.php?grupo='+grupo+'&area='+area+'&inicio='+inicio+'&fin='+fin+'&ofi='+ofi+'&ayu='+ayu+'&tipo='+tipo+'','_blank');
}
 function printer2(){
     var grupo = $("#grupo").val();
         var area = $("#area").val();
         var inicio = $("#inicio").val();
         var fin = $("#fin").val();
         var ofi = $("#vl_ofi").val();
         var ayu = $("#vl_ayu").val();
         var tipo = $("#tipo").val();
   location.href=('../vistas/produccion/reporte_trab/reporte_excel.php?grupo='+grupo+'&area='+area+'&inicio='+inicio+'&fin='+fin+'&ofi='+ofi+'&ayu='+ayu+'&tipo='+tipo+'');
}
 function VerInc(id){
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=7',  //
            url: '../vistas/produccion/grupo_trabajo/acciones.php', //
            success: function(resultado){
                $("#mostrar_incapacidad").html(resultado);
            }
           });
}
 function verop(id,op){
                 var opf = $("#opf").val();
                $("#mostrar_trabajo").html('Cargando....');
                $.ajax({
                    type: 'GET',
                    data: 'opf='+op+'&id='+id+'&sw=6',
                    url: '../vistas/produccion/reporte_trab/acciones.php',
                    success: function(resultado){
                   
                                    $("#mostrar_trabajo").html(resultado);
                                   
                                   }
                     });
            }
 
 