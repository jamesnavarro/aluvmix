 
$(function(){
     $("#mostrar_tabla").html(mostrar_sistemas(1)); 
});
 
function mostrar_sistemas(page){
    
        $.ajax({
            type: 'GET',
            data: 'page='+page,
            url: '../vistas/presupuestos/mod_sistemas/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_sist(){ 
     var ids= $("#id_sistema").val();
     var nombres= $("#nombre").val();
     
//   
    if(nombres===''){
        sweetAlert("Cantidad de Cuerpo fijo");
        $("#nombre").focus();
        return false;
    }
  
        $.ajax({
            type: 'GET',
            data: 'ids='+ids+'&nombres='+nombres+'&sw=1',
            url: '../vistas/presupuestos/mod_sistemas/acciones.php', 
            success: function(resultado){
                $("#id_sistema").val(resultado); 
                sweetAlert("Se guardo con exito");
                 mostrar_sistemas(1);
            }
           });
}

function limpiar_modsis(){
 $("#id_sistema").val(''); 
 $("#nombre").val('');
 
}

function nuevo(){
    limpiar_modsis();
}

function editar(id){ 
       $("#Formulariosistema").modal("show");
   
         $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/mod_sistemas/acciones.php', //
        success: function(resultado){
        var p = eval(resultado);

        $("#id_sistema").val(p[0]); 
        $("#nombre").val(p[1]);
        mostrar_sistemas(1);
 }
 });
}

function borrar_modsis(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/mod_sistemas/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_sistemas(1);
            }
           });
       }
}



