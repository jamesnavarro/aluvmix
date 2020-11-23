$(function() {
     mostrar_fuentes(1);
    
     $('#buscador').change(function(){
             mostrar_fuentes(1);  
     }); 
});
function mostrar_fuentes(page){
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
    window.opener.obtener_fuentes(id, nombre);
    window.close();
}


