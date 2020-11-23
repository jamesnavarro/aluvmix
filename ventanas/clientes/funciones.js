$(function() {
     $("#mostrar_tabla").html(mostrar_clientes(1));
    
     $('#buscador').change(function(){
             mostrar_clientes(1);  
     }); 
});
function mostrar_clientes(page){
     var bus= $("#buscador").val();

        $.ajax({
            type: 'GET',
            data: 'buscar='+bus+'&page='+page,
            url: 'listado.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado); 
            }
           });
     
}
function seleccionar(id,nombre){
    window.opener.obtener_cliente(id, nombre);
    window.close();
}


