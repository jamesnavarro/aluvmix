$(function() {
     $("#mostrar_tabla").html(mostrar_cotizaciones(1));
    
     $('#buscador').change(function(){
             mostrar_cotizaciones(1);  
     }); 
});
function mostrar_cotizaciones(page){
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
function seleccionar(num_cot,version,id_tercero,nom_tercero,nombre_obra,vendedor,costo){
    //alert("ok");
    window.opener.obtener_variables(num_cot, version, id_tercero, nom_tercero, nombre_obra, vendedor,costo);
    window.close();
}


