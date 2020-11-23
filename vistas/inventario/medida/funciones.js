$(function(){
     $("#mostrar_tabla").html(mostrar_medidas(1));
     
    $('#cod').change(function(){
        mostrar_medidas(1);
      });
     $('#des').change(function(){
        mostrar_medidas(1);
      }); 
  
     $('#res').change(function(){
         mostrar_medidas(1);
     });
           $('#est').change(function(){
        mostrar_medidas(1);
      }); 
     $('#fcod').change(function(){
        inv_buscar_medida();
      });
 });  
 function inv_buscar_medida(){
     var cod = $("#fcod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/inventario/medida/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#fcod").val(cod);
     $("#fdes").val(t[1]);
     $("#fres").val(t[2]); 
     $("#fmedh").val(t[3]);
     $("#fmedv").val(t[4]);
     $("#fsepa").val(t[5]);
     $("#ftipom").val(t[6]);
     $("#fest").val(t[7]);
         }
     
});
 }
    function mostrar_medidas(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
        var est = $("#est").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&res='+res+'&est='+est+'&page='+page,
                url: '../vistas/inventario/medida/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_medida(){
        var cod = $("#fcod").val();
        var des = $("#fdes").val();
        var res = $("#fres").val();
        var est = $("#fest").val();
        var fmedh = $("#fmedh").val();
        var fmedv = $("#fmedv").val();
        var fsepa = $("#fsepa").val();
        var ftipom = $("#ftipom").val();
        if (cod===''){
            alert('debe ingresar la descripcion') 
            $("#desc_lin").focus();
            return false;
        }
        if (des===''){
            alert('debe ingresar la descripcion') 
            $("#desc_lin").focus();
            return false;
         }
    $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&des='+des+'&res='+res+'&est='+est+'&fmedh='+fmedh+'&fmedv='+fmedv+'&fsepa='+fsepa+'&ftipom='+ftipom+'&sw=1',
            url: '../vistas/inventario/medida/acciones.php', 
            success: function(resultado){
               alert("Se guardo con exito");
               mostrar_medidas(1);
            }
           });
}

function limpiar_medida(){
  $("#fcod").val('');
  $("#fdes").val('');
  $("#fres").val(''); 
  $("#fest").val('');
  $("#fmedh").val('');
  $("#fmedv").val('');
  $("#fsepa").val('');
  $("#ftipom").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_medida();
}

function editar_medida(id){
    $("#medida1").attr("class","");
    $("#medida2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/inventario/medida/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     $("#fcod").val(t[0]);
     $("#fdes").val(t[1]);
     $("#fres").val(t[2]); 
     $("#fmedh").val(t[3]);
     $("#fmedv").val(t[4]);
     $("#fsepa").val(t[5]);
     $("#ftipom").val(t[6]);
     $("#fest").val(t[7]);
   
 }
});
}
