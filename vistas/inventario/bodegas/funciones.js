$(function(){
     $("#mostrar_tabla").html(mostrar_bod(1));
     
    $('#cod').change(function(){
        mostrar_bod(1);
      });
     $('#des').change(function(){
        mostrar_bod(1);
      }); 
        $('#est').change(function(){
        mostrar_bod(1);
      }); 
     $('#res').change(function(){
         mostrar_bod(1);
     });
     $('#bod_cod').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#bod_cod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/inventario/bodegas/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#bod_cod").val(cod);
              $("#bod_nomb").val(t[1]);
              $("#bod_resum").val(t[2]);
              $("#bod_cuenta").val(t[3]);
              $("#ctaapi_bod").val(t[4]);
              $("#estado_bod").val(t[5]);
              $("#ciudad_bod").val(t[6]);
              $("#codica_bod").val(t[7]);
              $("#costos_bod").val(t[8]);
              $("#codnit_bod").val(t[9]);
              $("#sed_bod").val(t[10]);
         }
     
});
 }
    function mostrar_bod(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
         var res = $("#res").val();
        var est = $("#est").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&res='+res+'&page='+page,
                url: '../vistas/inventario/bodegas/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_bod(){
        var bodcod = $("#bod_cod").val();
        var bodnomb = $("#bod_nomb").val();
        var bodresum = $("#bod_resum").val();
        var bodta = $("#bod_cuenta").val();
        var ctaapibod = $("#ctaapi_bod").val();
        var est = $("#estado_bod").val();
        var ciudbod = $("#ciudad_bod").val();
        var codicabod = $("#codica_bod").val();
        var costbod = $("#costos_bod").val();
        var codnibod = $("#codnit_bod").val(); 
        var sed_bod = $("#sed_bod").val(); 
      
    $.ajax({
            type: 'GET',
            data: 'bodcod='+bodcod+'&bodnomb='+bodnomb+'&bodresum='+bodresum+'&bodta='+bodta+'&ctaapibod='+ctaapibod+'&est='+est+'&ciudbod='+ciudbod+'&codicabod='+codicabod+'&costbod='+costbod+'&codnibod='+codnibod+'&sed_bod='+sed_bod+'&sw=1',
            url: '../vistas/inventario/bodegas/acciones.php', 
            success: function(resultado){
               alert("Se guardo con exito");
                mostrar_bod(1);
            }
           });
}

function limpiar_bod(){
   $("#bod_cod").val('');
   $("#bod_nomb").val('');
   $("#bod_resum").val('');
   $("#bod_cuenta").val('');
   $("#ctaapi_bod").val('');
   $("#estado_bod").val('');
   $("#ciudad_bod").val('');
   $("#codica_bod").val('');
   $("#costos_bod").val('');
   $("#codnit_bod").val('');
   $("#sed_bod").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_bod();
}

function editar_bod(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/inventario/bodegas/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
    
     $("#bod_cod").val(t[0]);
     $("#bod_nomb").val(t[1]);
     $("#bod_resum").val(t[2]);
     $("#bod_cuenta").val(t[3]);
     $("#ctaapi_bod").val(t[4]);
     $("#estado_bod").val(t[5]);
     $("#ciudad_bod").val(t[6]);
     $("#codica_bod").val(t[7]);
     $("#costos_bod").val(t[8]);
     $("#codnit_bod").val(t[9]);
     $("#sed_bod").val(t[10]);
   
 }
});
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   