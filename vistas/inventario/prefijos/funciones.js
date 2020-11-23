$(function(){
     $("#mostrar_tabla").html(mostrar_pref(1));
     
    $('#cod').change(function(){
        mostrar_pref(1);
      });
     $('#des').change(function(){
        mostrar_pref(1);
      }); 
        $('#resT').change(function(){
        mostrar_pref(1);
      }); 
    
     
     $('#cod_pref').change(function(){
        inv_buscar_codigo();
      });
 });
 
 
  function inv_buscar_codigo(){
     var cod = $("#cod_pref").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/inventario/prefijos/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#cod_pref").val(cod);
              $("#id_pref").val(t[0]);
              $("#tipo_pref").val(t[2]);
              $("#fuente_pref").val(t[3]);
              $("#ult_pref").val(t[4]);
         }
     
});
 }
  
    function mostrar_pref(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var resT = $("#resT").val();
        
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&resT='+resT+'&page='+page,
                url: '../vistas/inventario/prefijos/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
                
            }
        });
    }
   function guardar_pref(){
        var id = $("#id_pref").val();
        var colm = $("#cod_pref").val();
        var ubi = $("#tipo_pref").val();
        var cen_ubi = $("#fuente_pref").val();
        var sed_ubi = $("#ult_pref").val();
     
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&codpref='+colm+'&tipopref='+ubi+'&fuentepref='+cen_ubi+'&ultpref='+sed_ubi+'&sw=1',
            url: '../vistas/inventario/prefijos/acciones.php', 
            success: function(resultado){
             console.log(resultado)
                $("#id_pref").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_pref(1);
            }
           });
}

function limpiar_pref(){
 $("#id_pref").val('');
 $("#cod_pref").val('');
 $("#tipo_pref").val('');
 $("#fuente_pref").val('');
 $("#ult_pref").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_pref();
}

function editar_pref(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/inventario/prefijos/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
    $("#id_pref").val(t[0]);
    $("#cod_pref").val(t[1]);
    $("#tipo_pref").val(t[2]);
    $("#fuente_pref").val(t[3]);
    $("#ult_pref").val(t[4]);
 }
});
}
