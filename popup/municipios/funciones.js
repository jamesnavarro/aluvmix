$(function() {
     $("#mostrar_tabla").html(mostrar_usuario(1));
    
     $('#usuario').change(function(){
             mostrar_usuario(1);  
     }); 
});
function mostrar_usuario(page){
     var nom= $("#usuario").val();
     var ciu= $("#ciu").val();

        $.ajax({
            type: 'GET',
            data: 'munix='+ciu+'&ciudad='+nom+'&page='+page,
            url: 'listado.php',
            success: function(resultado){
                console.log(resultado);
                 $("#mostrar_tabla").html(resultado); 
            }
           });
     
}
function seleccionar(nombre){
    window.opener.obtener_municipio(nombre);
    window.close();
}


