 
$(function(){
     $("#mostrar_tabla").html(mostrar_ace(1)); 

       $('#nom').change(function(){
             mostrar_ace(1);
     });  
        $('#categorias').change(function(){
             mostrar_ace(1);
     });  
     
});
function mostrar_ace(page){
     var nom = $("#nom").val();
     var categorias = $("#categorias").val();
        $.ajax({
            type: 'GET',
            data:'nom='+nom+'&categorias='+categorias+'&page='+page,
            url: '../vistas/presupuestos/colores_ace/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function guardar_ace(){ 
     var codigo = $("#codigo").val();
     var descripcion= $("#descripcion").val();
     var est_ace= $("#est_ace").val();
     
    if(descripcion===''){
        sweetAlert("Digite la descripcion");
        $("#descripcion").focus();
        return false;
    }
    
      if(est_ace===''){
        sweetAlert("Seleccione el estado");
        $("#est_kit").focus();
        return false;
    }

   
        $.ajax({
            type: 'GET',
            data: 'codigo='+codigo+'&descripcion='+descripcion+'&est_ace='+est_ace+'&sw=1',
            url: '../vistas/presupuestos/colores_ace/acciones.php', 
            success: function(resultado){
                $("#codigo").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_ace(1);
            }
           });
}

function limpiar_ace(){
     $("#codigo").val('');
     $("#descripcion").val('');
     $("#est_ace").val('');
}


function editar_a(id){
   $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
         url: '../vistas/presupuestos/colores_ace/acciones.php', 
        success: function(resultado){
             var p = eval(resultado);
             $("#codigo").val(p[0]);
             $("#descripcion").val(p[1]);
             $("#est_ace").val(p[2]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/colores_ace/acciones.php', 
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_ace(1);
            }
           });
       }
}






