$(function(){
     $("#mostrar_tabla").html(mostrar_line(1));
     

     $('#des').change(function(){
        mostrar_line(1);
      }); 
        $('#est').change(function(){
        mostrar_line(1);
      }); 
     $('#res').change(function(){
         mostrar_line(1);
     });
     $('#fdes').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#fdes").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/inventario/colores/acciones.php',
         success: function(t) {
             var t = eval(t);
        
              $("#fdes").val(cod);
              $("#fres").val(t[2]); 
              $("#fest").val(t[3]);
         }
     
});
 }
    function mostrar_line(page){
  
        var des = $("#des").val();
         var res = $("#res").val();
        var est = $("#est").val();
        $.ajax({
                type: 'GET',
                data: 'des='+des+'&est='+est+'&res='+res+'&page='+page,
                url: '../vistas/inventario/colores/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_lin(){
 
        var des = $("#fdes").val();
        var res = $("#fres").val();
        var est = $("#fest").val();

        if (des===''){
            alert('debe ingresar la descripcion') 
            $("#desc_lin").focus();
            return false;
         }
    $.ajax({
            type: 'GET',
            data: 'des='+des+'&res='+res+'&est='+est+'&sw=1',
            url: '../vistas/inventario/colores/acciones.php', 
            success: function(resultado){
              console.log(resultado);
               alert("Se guardo con exito");
                mostrar_line(1);
            }
           });
}

function limpiar_lin(){

  $("#fdes").val('');
  $("#fres").val(''); 
  $("#fest").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_lin();
}

function editar_lin(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/inventario/colores/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
 
     $("#fdes").val(t[1]);
     $("#fres").val(t[2]); 
     $("#fest").val(t[3]);
   
 }
});
}
