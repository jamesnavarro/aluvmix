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
     $('#umb').change(function(){
         mostrar_line(1);
     });
     $('#cp').change(function(){
         mostrar_line(1);
     });
     $('#fcod').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#fcod").val();
      $.ajax({
                type: 'GET',
                data: 'id='+cod+'&sw=2',
                url: '../vistas/contabilidad/clasesactividad/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#fcod").val(cod);
     $("#fdes").val(t[1]);
      $("#fumb").val(t[4]); 
      $("#fcp").val(t[2]);
      $("#fcue").val(t[5]);
      $("#fest").val(t[3]);
      $("#fpara").val(t[6]);
         }
     
});
 }
    function mostrar_line(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
         var umb = $("#umb").val();
        var est = $("#est").val();
        var cp = $("#cp").val();

        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&umb='+umb+'&cp='+cp+'&page='+page,
                url: '../vistas/contabilidad/clasesactividad/lista.php',
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
        var umb = $("#fumb").val();
        var est = $("#fest").val();
        var cue = $("#fcue").val();
        var cp = $("#fcp").val();
            var para = $("#fpara").val();
        if (cod===''){
            alert('Digita el codigo') ;
            $("#fcod").focus();
            return false;
        }
        if (des===''){
            alert('debe ingresar la descripcion') 
            $("#fdes").focus();
            return false;
         }
    $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&des='+des+'&umb='+umb+'&para='+para+'&est='+est+'&cue='+cue+'&cp='+cp+'&sw=1',
            url: '../vistas/contabilidad/clasesactividad/acciones.php', 
            success: function(resultado){
            
               alert("Se guardo con exito");
                mostrar_line(1);
            }
           });
}

function limpiar_lin(){
  $("#fcod").val('');
  $("#fdes").val('');
  $("#fcp").val(''); 
  $("#fest").val('');
  $("#fcue").val('');
  $("#fumb").val('');
  $("#fpara").val('');
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
            url: '../vistas/contabilidad/clasesactividad/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     $("#fcod").val(t[0]);
     $("#fdes").val(t[1]);
      $("#fumb").val(t[4]); 
      $("#fcp").val(t[2]);
      $("#fcue").val(t[5]);
      $("#fest").val(t[3]);
      $("#fpara").val(t[6]);
   
 }
});
}
