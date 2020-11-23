 
$(function(){
     $("#mostrar_tabla").html(mostrar_lineas(1)); 
});
function mostrar_lineas(page){
        $.ajax({
            type: 'GET',
            data: 'page='+page,
            url: '../vistas/lineas/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function guardar_lineas(){ 
     var id_li = $("#id_lin").val();
     var deslineas= $("#descrip_linea").val();
     
    if(deslineas===''){
        sweetAlert("digite descripcion");
        $("#descrip_linea").focus();
        return false;
    }
   
        $.ajax({
            type: 'GET',
            data: 'id_lil='+id_li+'&dlineasl='+deslineas+'&sw=1',
            url: '../vistas/lineas/acciones.php', 
            success: function(resultado){
                $("#id_lin").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_lineas(1);
            }
           });
}

function limpiar_lineas(){
   $("#descrip_linea").val('');
}

function nuevo(){
    $("#agregar").modal("show");
    limpiar_lineas();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/lineas/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_lin").val(p[0]);
   $("#descrip_linea").val(p[1]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/lineas/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_lineas(1);
            }
           });
       }
}





