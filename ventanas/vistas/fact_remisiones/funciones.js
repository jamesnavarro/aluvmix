$(function() {

    $("#mostrar_tabla").html(mostrar_fact_remisiones(1));
    $('#descripcion').change(function(){
             mostrar_fact_remisiones(1); 
     });
    
});

function verfactu(){
    $("#Formularioremisionesfact").modal("show");
}

