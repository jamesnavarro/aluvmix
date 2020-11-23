$(function(){
     //$("#mostrar_tabla").html(mostrar_kardex(1)); 
     
      $('#cod_k').change(function(){
         mostrar_kardex(1);  
     });
       $('#ubi_k').change(function(){
         mostrar_kardex(1);  
     });
       $('#usu_k').change(function(){
         mostrar_kardex(1);  
     });
       $('#fec_k').change(function(){
         mostrar_kardex(1);  
     });
     $('#fec_f').change(function(){
         mostrar_kardex(1);  
     });
        $('#bod').change(function(){
          mostrar_kardex(1);  
     });  
        $('#tmov_k').change(function(){
          mostrar_kardex(1);  
     });
 
});
function mostrar_kardex(page){
    
     var cod_k = $("#cod_k").val();
     var ubi_k = $("#ubi_k").val();
     var usu_k = $("#usu_k").val();
     var fec_k = $("#fec_k").val();
     var fec_f = $("#fec_f").val();
     var color = $("#color").val();
     var bod = $("#bod").val();
     if(bod==''){
         alert("selecciona la bodega");
         $("#bod").focus();
         return false;
     }
     var tmov_k = $("#tmov_k").val();
        $.ajax({
            type: 'GET',
            data: 'cod_k='+cod_k+'&ubi_k='+ubi_k+'&color='+color+'&usu_k='+usu_k+'&fec_k='+fec_k+'&fec_f='+fec_f+'&bod='+bod+'&tmov_k='+tmov_k+'&page='+page,
            url: '../vistas/inventario/kardex/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
 function pdf(){
     var cod_k = $("#cod_k").val();
     var ubi_k = $("#ubi_k").val();
     var usu_k = $("#usu_k").val();
     var fec_k = $("#fec_k").val();
     var fec_f = $("#fec_f").val();
     var bod = $("#bod").val();
     var tmov_k = $("#tmov_k").val();
    if(bod==''){
             sweetAlert("Digite el codigo de la bodega");
             return false;
           }
      window.open("../vistas/inventario/kardex/pdf.php?id="+cod_k+"&ubi_k="+ubi_k+"&usu_k="+usu_k+"&fec_k="+fec_k+"&fec_f="+fec_f+"&bod="+bod+"&tmov_k="+tmov_k, "resumen", " width=1200 , height=500 ");
}
function pdf_ubi(){
     var cod_k = $("#cod_k").val();
     var ubi_k = $("#ubi_k").val();
     var usu_k = $("#usu_k").val();
     var fec_k = $("#fec_k").val();
     var bod = $("#bod").val();
     var fec_f = $("#fec_f").val();
     var tmov_k = $("#tmov_k").val();
     var color = $("#color").val();
     if(bod==''){
             sweetAlert("Digite el codigo de la bodega");
             return false;
           }
      window.open("../vistas/inventario/kardex/pdf_ubi.php?id="+cod_k+"&color="+color+"&ubi_k="+ubi_k+"&usu_k="+usu_k+"&fec_k="+fec_k+"&fec_f="+fec_f+"&bod="+bod+"&tmov_k="+tmov_k, "resumen", " width=1200 , height=500 ");
}
function buscarcod(){
    var cod = $("#cod_k").val();

    $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&sw=1',
            url: '../vistas/inventario/referencias/acciones.php',
            success: function(resultado){
     
                var p = eval(resultado);
                 $("#des_k").val(p[2]);
                 $("#color").val(p[4]);
            }
  });
}