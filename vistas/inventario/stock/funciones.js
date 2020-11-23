$(function(){
     $("#mostrar_tabla").html(mostrar_stock(1));
     
    $('#cod').change(function(){
        mostrar_stock(1);
      });
     $('#des').change(function(){
        mostrar_stock(1);
      }); 
     $('#res').change(function(){
         mostrar_stock(1);
     });
      $('#usu').change(function(){
         mostrar_stock(1);
     });
       $('#bod').change(function(){
         mostrar_stock(1);
     });
 });  

    function mostrar_stock(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
         var res = $("#res").val();
        var usu = $("#usu").val();
         var bod = $("#bod").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&res='+res+'&usu='+usu+'&bod='+bod+'&page='+page,
                url: '../vistas/inventario/stock/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    
function printer(){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
        var usu = $("#usu").val();
        var bod = $("#bod").val();
    window.open('../vistas/inventario/stock/print_stock.php?cod='+cod+'&des='+des+'&res='+res+'&usu='+usu+'&bod='+bod,'_blank');
}
  


