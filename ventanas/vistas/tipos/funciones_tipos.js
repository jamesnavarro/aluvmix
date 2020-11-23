$(function() {
 
    $("#mostrar_tabla").html(mostrar_tipos(1));
  
     $('#tipo').change(function(){
             mostrar_tipos(1);
     });
        $('#estado').change(function(){
             mostrar_tipos(1);
     });

     
});

function mostrar_tipos(pagina){

    var nom = $("#tipo").val();
    var et = $("#estado").val();

    $.ajax({
            type: 'GET',
            data:  'tipo='+nom+'&estado='+et+'&page='+pagina,
            url: '../vistas/tipos/lista_tipos.php',
            success: function(resultado){
                     $("#mostrar_tabla").html(resultado);
            }
           });
       
}

function nuevo(){
    $("#FormularioProducto").modal("show");
}
function guardar_tipo(){
   
    var num = $("#numero").val(); 
    var nom = $("#nombre").val();
    var est = $("#estado").val();
 
    if(nom===''){
        alert("Debes de digitar el nombre");
        $("#nombre").focus();
        return false;
    }
    if(est===''){
        alert("selecciona estado");
        $("#estado").focus();
        return false;
    }
   
        $.ajax({
            type: 'GET',
            data: 'nombre='+nom+'&numero='+num+'&estado='+est+'&sw=1', 
            url: '../vistas/tipos/acciones.php',
            success: function(resultado){
                $("#numero").val(resultado);
                alert("Se guardo con exito");
                mostrar_tipos(1);
            }
           });
}
function limpiar_formulario(){
    $("#numero").val(''); 
    $("#nombre").val('');
    $("#estado").val(''); 
}
function editar(id){

    $("#FormularioProducto").modal("show");

     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/tipos/acciones.php', //
            success: function(resultado){
                var t = eval(resultado);
                $("#numero").val(t[0]);
                $("#nombre").val(t[1]);
                $("#estado").val(t[2]); 
            }
           });
}

function borrar(id){
     var page = $("#page").val();
     var c = confirm("Esta seguro de eliminar este tipo?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/tipos/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_tipos(page);
            }
           });
       }
}
 