$(function(){
     $("#mostrar_tabla").html(mostrar_line(1));
     

     $('#des').change(function(){
        mostrar_line(1);
      }); 
        $('#res').change(function(){
        mostrar_line(1);
      }); 
     $('#tmov').change(function(){
         mostrar_line(1);
     });
     $('#bdeg').change(function(){
        mostrar_line(1);
      });
     $('#desc_m').change(function(){
        mostrar_line(1);
      });
       $('#est_m').change(function(){
        mostrar_line(1);
      });
       $('#fec').change(function(){
        mostrar_line(1);
      });
       $('#usua_m').change(function(){
        mostrar_line(1);
      });
      $('#cons').change(function(){
        mostrar_line(1);
      });
      
 });  
 function inv_buscar_codigo(){
     var cod = $("#fdes").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/inventario/movimientos/list_mov/acciones.php',
         success: function(t) {
             var t = eval(t);
        
              $("#fdes").val(cod);
              $("#fres").val(t[2]); 
              $("#fest").val(t[3]);
         }
     
});
 }
    function mostrar_line(page){
  
        var des = $("#des").val();
        var res = $("#res").val();
        var tmov = $("#tmov").val();
        var bdeg = $("#bdeg").val();
        var desc_m = $("#desc_m").val();
         var pen = $("#pen").val();
        var fec = $("#fec").val();
        var usua_m = $("#usua_m").val();
        var cons = $("#cons").val();
        
        $.ajax({
                type: 'GET',
                data: 'des='+des+'&res='+res+'&pen='+pen+'&tmov='+tmov+'&cons='+cons+'&bdeg='+bdeg+'&desc_m='+desc_m+'&fec='+fec+'&usua_m='+usua_m+'&page='+page,
                url: '../vistas/inventario/movimientos/list_mov/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_lin(){
 
        var des = $("#fdes").val();
        var res = $("#fres").val();
        var est = $("#fest").val();

        if (des===''){
            alert('debe ingresar la descripcion') 
            $("#desc_lin").focus();
            return false;
         }
    $.ajax({
            type: 'GET',
            data: 'des='+des+'&res='+res+'&est='+est+'&sw=1',
            url: '../vistas/inventario/movimientos/list_mov/acciones.php', 
            success: function(resultado){
              console.log(resultado);
               alert("Se guardo con exito");
                mostrar_line(1);
            }
           });
}

function limpiar_lin(){

  $("#fdes").val('');
  $("#fres").val(''); 
  $("#fest").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_lin();
}

function editar_lin(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/inventario/movimientos/list_mov/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
 
     $("#fdes").val(t[1]);
     $("#fres").val(t[2]); 
     $("#fest").val(t[3]);
   
 }
});
}

function volver_cargar(id,tipo,save) {
    if(tipo=='ENTRADA'){
        $('<form action="../vistas/inventario/movimientos/index.php?tipo='+tipo+'" method="post" target="_blank" ><input type="hidden" name="id" value="'+id+'"/><input type="hidden" name="save" value="'+save+'"/></form>')
        .appendTo('body').submit();
    }else if(tipo=='SALIDA'){
         $('<form action="../vistas/inventario/movimientos/index.php?tipo='+tipo+'" method="post" target="_blank"><input type="hidden" name="id" value="'+id+'"/><input type="hidden" name="save" value="'+save+'"/></form>')
        .appendTo('body').submit();
    }else{
        $('<form action="../vistas/inventario/movimientos/entrada_traslado.php" method="post" target="_blank" ><input type="hidden" name="id" value="'+id+'"/><input type="hidden" name="save" value="'+save+'"/></form>')
        .appendTo('body').submit();
    }
}
function volver_cargar_tras(id,tipo,save) {
    if(tipo=='ENTRADA'){
        $('<form action="../vistas/inventario/traslado/index.php?tipo='+tipo+'" method="post" target="_blank"><input type="hidden" name="id" value="'+id+'"/><input type="hidden" name="save" value="'+save+'"/></form>')
        .appendTo('body').submit();
    }else if(tipo=='SALIDA'){
         $('<form action="../vistas/inventario/traslado/index.php?tipo='+tipo+'" method="post" target="_blank"><input type="hidden" name="id" value="'+id+'"/><input type="hidden" name="save" value="'+save+'"/></form>')
        .appendTo('body').submit();
    }else{
        $('<form action="../vistas/inventario/movimientos/entrada_traslado.php" method="post" target="_blank"><input type="hidden" name="id" value="'+id+'"/><input type="hidden" name="save" value="'+save+'"/></form>')
        .appendTo('body').submit();
    }
}