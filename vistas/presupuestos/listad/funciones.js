 
$(function(){
     $("#mostrar_tabla").html(mostrar_list(1)); 
   
      $("#linea").change(function(){
          mostrar_list();
      });
      $("#bus").change(function(){
          mostrar_list();
      });
      $("#estad").change(function(){
          mostrar_list();
      });
       $("#desg").change(function(){
          mostrar_list();
      });
     
});

function mostrar_list(page){
     var line = $("#linea").val(); 
     var busc = $("#bus").val();
     var est = $("#estad").val();
     var desgl = $("#desg").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&lineb='+line+'&buscb='+busc+'&estb='+est+'&desglb='+desgl,
            url: '../vistas/listad/lista_li.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}





