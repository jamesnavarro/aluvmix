 
$(function(){
     $("#mostrar_listado_p").html(mostrar_lis(1)); 
   
      $("#ite").change(function(){
          mostrar_lis(1);
      });
      $("#codi").change(function(){
          mostrar_lis(1);
      });
      $("#desc").change(function(){
          mostrar_lis(1);
      });
       $("#refe").change(function(){
          mostrar_lis(1);
      });
      $("#line").change(function(){
          mostrar_lis(1);
      });
      $("#ulti").change(function(){
          mostrar_lis(1);
      });
      $("#modi").change(function(){
          mostrar_lis(1);
      });
     
});

function mostrar_lis(page){
              var ite = $("#ite").val();
         var codi = $("#codi").val();
         var desc = $("#desc").val();
         var refe = $("#refe").val();
         var line = $("#line").val();
         var ulti = $("#ulti").val();
         var modi = $("#modi").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&ite='+ite+'&codi='+codi+'&desc='+desc+'&line='+line+'&ulti='+ulti+'&modi='+modi+'&refe='+refe,
            url: 'produccion/rutas/lista_li.php',
            success: function(resultado){
                 $("#mostrar_listado_p").html(resultado);
            }
  }); 
}






