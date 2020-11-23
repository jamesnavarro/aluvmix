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
   
      $('#cp').change(function(){
         mostrar_line(1);
     })
     $('#fcod').change(function(){
        inv_buscar_codigo();
      });
      $('#fare').change(function(){
           var are = $("#fare").val();
        $("#fcod").val(are).focus();
      });
       $('#fcla').change(function(){
         var fcla = $("#fcla").val();
         buscar_area();
         
     });
      
 });  
 function buscar_area(){
          var cla = $("#fcla").val();
      $.ajax({
                type: 'GET',
                data: 'cla='+cla+'&sw=5',
                url: '../vistas/contabilidad/centrocostos/acciones.php',
         success: function(t) {
              $("#fare").html(t);
   
         }
});
 }
 function inv_buscar_codigo(){
     var cod = $("#fcod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/contabilidad/centrocostos/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#fcod").val(cod);
              $("#fdes").val(t[1]);
              $("#fres").val(t[2]); 
              $("#fest").val(t[3]);
              $("#fcp").val(t[4]);
              if(!t[1]){
                  $("#fare").val();
                  $("#fcla").val();
              }else{
                  $("#fare").val(t[5]);
                  $("#fcla").val(t[6]);
              }
         }
     
});
 }
    function mostrar_line(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
        var est = $("#est").val();
        var cp = $("#cp").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&res='+res+'&cp='+cp+'&page='+page,
                url: '../vistas/contabilidad/centrocostos/lista.php',
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
        var cp = $("#fcp").val();
        var are = $("#fare").val();
        if (cod===''){
            alert('debe ingresar la descripcion') ;
            $("#fcod").focus();
            return false;
        }
        if (des===''){
            alert('debe ingresar la descripcion') ;
            $("#fdes").focus();
            return false;
         }
         if (cp===''){
            alert('debe seleccionar el centro de produccion') ;
            $("#fcp").focus();
            return false;
         }
         if (are===''){
            alert('debe seleccionar el area') ;
            $("#fare").focus();
            return false;
         }
    $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&des='+des+'&res='+res+'&est='+est+'&cp='+cp+'&are='+are+'&sw=1',
            url: '../vistas/contabilidad/centrocostos/acciones.php', 
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
  $("#fcp").val('');
  $("#fare").val('');
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
            url: '../vistas/contabilidad/centrocostos/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     $("#fcod").val(t[0]);
     $("#fdes").val(t[1]);
     $("#fres").val(t[2]); 
     $("#fest").val(t[3]);
     $("#fcp").val(t[4]);
     $("#fare").val(t[5]);
     $("#fcla").val(t[6]);
   
 }
});
}
function ver_clases(cod){
    alert(cod);
    window.opener.cont_clasescc();
    window.opener.editar_lin(cod);
}
