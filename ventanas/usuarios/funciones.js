$(function() {
     $("#mostrar_tabla").html(mostrar_usuario(1));
    
     $('#usuario').change(function(){
             mostrar_usuario(1);  
     }); 
});
function mostrar_usuario(page){
     var nom= $("#usuario").val();

        $.ajax({
            type: 'GET',
            data: 'nom_ter='+nom+'&page='+page,
            url: 'listado.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado); 
            }
           });
     
}
function seleccionar(nombre){
    window.opener.obtener_usuario(nombre);
    window.close();
}


