$(function(){
     $("#mostrar_tabla").html(mostrar_ubi(1));
     
    $('#cod').change(function(){
        mostrar_ubi(1);
      });
     $('#des').change(function(){
        mostrar_ubi(1);
      }); 
        $('#resT').change(function(){
        mostrar_ubi(1);
      }); 
    
     $('#colum_ubi').change(function(){
         var fcla = $("#colum_ubi").val();
         $("#ubica_ubi").val(fcla).focus();
         
     });
     $('#ubica_ubi').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#ubica_ubi").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/inventario/ubicaciones/acciones.php',
         success: function(t) {
             console.log(t);
             var t = eval(t);
             if (t[0]==null){
                 $("#ubica_ubi").val(cod);
                 $("#colum_ubi").val();
                 $("#id_ubi").val('');
             }else{
              $("#ubica_ubi").val(cod);
              $("#colum_ubi").val(t[1]); 
              $("#cen_ubi").val(t[3]);
              $("#sed_ubi").val(t[4]);
          }
         }
});
 }
    function mostrar_ubi(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var resT = $("#resT").val();
        
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&resT='+resT+'&page='+page,
                url: '../vistas/inventario/ubicaciones/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_ubi(){
        var id = $("#id_ubi").val();
        var colm = $("#colum_ubi").val();
        var ubi = $("#ubica_ubi").val();
        var cen_ubi = $("#cen_ubi").val();
        var sed_ubi = $("#sed_ubi").val();
     
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&colm='+colm+'&ubi='+ubi+'&cen_ubi='+cen_ubi+'&sed_ubi='+sed_ubi+'&sw=1',
            url: '../vistas/inventario/ubicaciones/acciones.php', 
            success: function(resultado){
             console.log(resultado)
                $("#id_ubi").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_ubi(1);
            }
           });
}

function limpiar_ubi(){
$("#id_ubi").val('');
$("#colum_ubi").val('');
$("#ubica_ubi").val('');
$("#cen_ubi").val('');
$("#sed_ubi").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_ubi();
}

function editar_lin(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/inventario/ubicaciones/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
    $("#id_ubi").val(t[0]);
    $("#colum_ubi").val(t[1]);
    $("#ubica_ubi").val(t[2]);
    $("#cen_ubi").val(t[3]);
    $("#sed_ubi").val(t[4]);
 }
});
}
