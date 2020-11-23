$(function(){
     $("#mostrar_tabla").html(mostrar_cod(1));
     
    $('#cod').change(function(){
        mostrar_cod(1);
      });
     $('#des').change(function(){
        mostrar_cod(1);
      }); 
        $('#est').change(function(){
        mostrar_cod(1);
      }); 
     $('#res').change(function(){
         mostrar_cod(1);
     });
     $('#cont_cod').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#cont_cod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/contabilidad/cod_contables/acciones.php',
         success: function(t) {
             var t = eval(t);
               $("#cont_cod").val(cod);
               $("#id_cod_c").val(t[0]);
               $("#cont_contable").val(t[2]);
               $("#cont_fiscal").val(t[3]);
               $("#cont_niif").val(t[4]);
               $("#cod_naturaleza").val(t[5]);
               $("#cod_trm").val(t[6]);
               $("#cod_tributario").val(t[7]);
               $("#cod_presupuesto").val(t[8]);
         }
     
});
 }
    function mostrar_cod(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
         var res = $("#res").val();
        var est = $("#est").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&res='+res+'&page='+page,
                url: '../vistas/contabilidad/cod_contables/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_cod(){
        var idcodc = $("#id_cod_c").val();
        var codcod = $("#cont_cod").val();
        var contable = $("#cont_contable").val();
        var fiscal = $("#cont_fiscal").val();
        var contniif = $("#cont_niif").val();
        var codnatu = $("#cod_naturaleza").val();
        var codtrm = $("#cod_trm").val();
        var codtribu = $("#cod_tributario").val();
        var codpre = $("#cod_presupuesto").val();
        
    $.ajax({
            type: 'GET',
            data: 'id='+idcodc+'&codcod='+codcod+'&bodnomb='+contable+'&fiscal='+fiscal+'&contniif='+contniif+'&codnatu='+codnatu+'&codtrm='+codtrm+'&codtribu='+codtribu+'&codpre='+codpre+'&sw=1',
            url: '../vistas/contabilidad/cod_contables/acciones.php', 
            success: function(resultado){
               console.log(resultado)
               $("#id_cod_c").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_cod(1);
            }
           });
}

function limpiar_cod(){
      $("#id_cod_c").val('');
      $("#cont_cod").val('');
       $("#cont_contable").val('');
       $("#cont_fiscal").val('');
       $("#cont_niif").val('');
       $("#cod_naturaleza").val('');
       $("#cod_trm").val('');
      $("#cod_tributario").val('');
      $("#cod_presupuesto").val('');
        
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_cod();
}

function editar_cod(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/contabilidad/cod_contables/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
    
     $("#id_cod_c").val(t[0]);
     $("#cont_cod").val(t[1]);
     $("#cont_contable").val(t[2]);
     $("#cont_fiscal").val(t[3]);
     $("#cont_niif").val(t[4]);
     $("#cod_naturaleza").val(t[5]);
     $("#cod_trm").val(t[6]);
     $("#cod_tributario").val(t[7]);
     $("#cod_presupuesto").val(t[8]);
   
 }
});
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   