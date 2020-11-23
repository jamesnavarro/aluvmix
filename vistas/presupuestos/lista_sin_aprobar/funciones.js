 
$(function(){
     $("#mostrar_tabla").html(mostrar_lista(1)); 
   
      $("#linea").change(function(){
          mostrar_lista();
      });
      $("#bus").change(function(){
          mostrar_lista();
      });
      $("#estad").change(function(){
          mostrar_lista();
      });
       $("#desg").change(function(){
          mostrar_lista();
      });
     
});

function mostrar_lista(page){
     var line = $("#linea").val(); 
     var busc = $("#bus").val();
     var est = $("#estad").val();
     var desgl = $("#desg").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&lineb='+line+'&buscb='+busc+'&estb='+est+'&desglb='+desgl,
            url: '../vistas/lista_sin_aprobar/lista_li.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}





