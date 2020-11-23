$(function() {

    $("#mostrar_tabla").html(mostrar_fact_ventas(1));
    $('#descripcion').change(function(){
             mostrar_fact_ventas(1); 
     });
    
});

function facturaventas(){
    $("#Formulariofactuventas").modal("show");
}

