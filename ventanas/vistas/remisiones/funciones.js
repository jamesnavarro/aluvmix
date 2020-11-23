$(function() {

    $("#mostrar_tabla").html(mostrar_remisiones(1));
    $('#descripcion').change(function(){
             mostrar_remisiones(1); 
     });
    
});

function verremi(){
    $("#Formularioremisiones").modal("show");
}

