$(function(){
     $("#mostrar_tabla").html(mostrar_unidad(1));
     
    $('#cod').change(function(){
        mostrar_unidad(1);
      });
     $('#des').change(function(){
        mostrar_unidad(1);
      }); 
        $('#est').change(function(){
        mostrar_unidad(1);
      }); 
 
     $('#fcod').change(function(){
        inv_buscar_unidad();
      });
 });  
 function inv_buscar_unidad(){
     var cod = $("#fcod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/inventario/unidad/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#fcod").val(cod);
              $("#fdes").val(t[1]);
              $("#fest").val(t[3]);
         }
     
});
 }
    function mostrar_unidad(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var est = $("#est").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&page='+page,
                url: '../vistas/inventario/unidad/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_unidad(){
        var cod = $("#fcod").val();
        var des = $("#fdes").val();
        var est = $("#fest").val();
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
            data: 'cod='+cod+'&des='+des+'&est='+est+'&sw=1',
            url: '../vistas/inventario/unidad/acciones.php', 
            success: function(resultado){
            
               alert("Se guardo con exito");
                mostrar_unidad(1);
            }
           });
}

function limpiar_unidad(){
  $("#fcod").val('');
  $("#fdes").val('');
  $("#fest").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_unidad();
}

function editar_unidad(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/inventario/unidad/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     $("#fcod").val(t[0]);
     $("#fdes").val(t[1]);
     $("#fest").val(t[2]);
   
 }
});
}
