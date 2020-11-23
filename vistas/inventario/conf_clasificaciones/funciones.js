$(function(){
     $("#mostrar_tabla").html(mostrar_estant(1));
     
    $('#item').change(function(){
        mostrar_estant(1);
      });
     $('#estant').change(function(){
        mostrar_estant(1);
      }); 

 });  

    function mostrar_estant(page){
        var cod = $("#item").val();
        var des = $("#estant").val();
      
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&page='+page,
                url: '../vistas/inventario/conf_clasificaciones/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_clasif(){
        var id_estan = $("#id_estan").val();
        var estante_f = $("#estante_f").val();
    

        if (estante_f===''){
            alert('debe ingresar la descripcion') 
            $("#estante_f").focus();
            return false;
         }
    $.ajax({
            type: 'GET',
            data: 'id_estan='+id_estan+'&estante_f='+estante_f+'&sw=1',
            url: '../vistas/inventario/conf_clasificaciones/acciones.php', 
            success: function(resultado){
            
               alert("Se guardo con exito");
                mostrar_estant(1);
            }
           });
}

function limpiar_clasif(){
  $("#id_estan").val('');
  $("#estante_f").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_lin();
}

function editar_clasif(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'ids='+id+'&sw=2',  //
            url: '../vistas/inventario/conf_clasificaciones/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     $("#id_estan").val(t[0]);
     $("#estante_f").val(t[1]);
   
 }
});
}
