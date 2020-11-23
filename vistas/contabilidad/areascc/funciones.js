$(function(){
     $("#mostrar_tabla").html(mostrar_line(1));
     
    $('#cod').change(function(){
        mostrar_line(1);
      });
     $('#des').change(function(){
        mostrar_line(1);
      }); 
        $('#est').change(function(){
        mostrar_line(1);
      }); 
     $('#res').change(function(){
         mostrar_line(1);
     });
     $('#fcla').change(function(){
         var fcla = $("#fcla").val();
         $("#fcod").val(fcla);
         
     });
     $('#fcod').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#fcod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/contabilidad/areascc/acciones.php',
         success: function(t) {
             console.log(t);
             var t = eval(t);
              $("#fcod").val(cod);
              $("#fdes").val(t[1]);
              $("#fres").val(t[2]); 
              $("#fest").val(t[3]);
              $("#fcla").val(t[4]);
         }
     
});
 }
    function mostrar_line(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
         var res = $("#res").val();
        var est = $("#est").val();
        
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&res='+res+'&page='+page,
                url: '../vistas/contabilidad/areascc/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_lin(){
        var cod = $("#fcod").val();
        var des = $("#fdes").val();
        var res = $("#fres").val();
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
            data: 'cod='+cod+'&des='+des+'&res='+res+'&est='+est+'&sw=1',
            url: '../vistas/contabilidad/areascc/acciones.php', 
            success: function(resultado){
            
               alert("Se guardo con exito");
                mostrar_line(1);
            }
           });
}

function limpiar_lin(){
  $("#fcod").val('');
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
            url: '../vistas/contabilidad/areascc/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     $("#fcod").val(t[0]);
     $("#fdes").val(t[1]);
     $("#fres").val(t[2]); 
     $("#fest").val(t[3]);
     $("#fcla").val(t[4]);
   
 }
});
}
