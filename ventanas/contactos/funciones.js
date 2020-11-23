$(function() {
     $("#mostrar_tabla").html(mostrar_clientes(1));
    
     $('#buscador').change(function(){
             mostrar_clientes(1);  
     }); 
});
function mostrar_clientes(page){
     var bus= $("#buscador").val();
     var id= $("#id").val();
        $.ajax({
            type: 'GET',
            data: 'buscar='+bus+'&id='+id+'&page='+page,
            url: 'listado.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado); 
            }
           });
     
}
function seleccionar(id,nombre){
    window.opener.obtener_contacto(id, nombre);
    window.close();
}


