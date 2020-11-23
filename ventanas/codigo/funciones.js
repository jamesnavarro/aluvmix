$(function() {
     mostrar_codigos(1);
     $('#buscador').change(function(){
             mostrar_codigos(1);  
     }); 
});
function mostrar_codigos(page){
     var bus= $("#buscador").val();
     var id= $("#id").val();
        $.ajax({
            type: 'GET',
            data: 'bus='+bus+'&page='+page,
            url: 'listado.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado); 
            }
           });
     
}
function seleccionar(id,nombre){
    window.opener.obtener_codigos(id, nombre);
    window.close();
}


