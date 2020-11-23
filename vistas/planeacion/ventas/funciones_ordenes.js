function mostrar_items(cot){
    var  ser = $("#ser").val();
     var  est = $("#est").val();
      $.ajax({
            post:'GET',
            data:'cot='+cot+'&ser='+ser+'&est='+est+'&sw=2',
            url:'../vistas/planeacion/orden/modelo.php',
            success:function(a){
               
               $("#mostrar_lineas").html(a);
              
            } 
        });
}
function pasar_items_orden(item,ubi,obs,des){
     $("#f_item").val(item);
     $("#f_ubi").val(ubi);
     $("#f_obs").val(obs);
     $("#f_pri").val(des);
     $("#modalordenitems").modal('show');
     desglose_vidrio(item);
}
function desglose_vidrio(id){
        $.ajax({
                                        type:'GET',
                                        data:'cot='+id+'&sw=3',
                                        url:'../vistas/planeacion/orden/modelo.php',
                                        success : function(d){
                                            $("#desglose_vidrio").html(d);
                                        }
                                     });
}
function disancho(id){
    console.log(id);
    $("#v_ancho2"+id).attr("disabled", false);
}
function disalto(id){
    $("#v_alto2"+id).attr("disabled", false);
}
function agregaritems(){
        var item_pri = $("#f_item").val();
        var ubi = $("#f_ubi").val();
        var obs = $("#f_obs").val();
         var pri = $("#f_pri").val();
         var cot = $("#idcot").val();
         var orden = $("#idorden").val();
        
    $("input[name=item]:checked").each(function(){
	var id = $(this).attr("id");
        var item = $("#item"+id).val();
        var per = $("#per"+id).val();
        var boq = $("#boq"+id).val();
        var ancho = $("#v_ancho"+id).val();
        var ancho2 = $("#v_ancho2"+id).val();
        var alto = $("#v_alto"+id).val();
        var alto2 = $("#v_alto2"+id).val();
        var cantidad = $("#v_cantidad"+id).val();
        var producto = $("#producto"+id).val();
        var linea = $("#linea"+id).val();
        $.ajax({
                                        type:'GET',
                                        data:'item='+item+'&per='+per+'&boq='+boq+'&ancho='+ancho+'&ancho2='+ancho2+'\
                                        &alto='+alto+'&alto2='+alto2+'&cantidad='+cantidad+'&pri='+pri+'&item_pri='+item_pri+'\
                                        &ubi='+ubi+'&obs='+obs+'&cot='+cot+'&orden='+orden+'&producto='+producto+'&linea='+linea+'&sw=4',
                                        url:'../vistas/planeacion/orden/modelo.php',
                                        success : function(d){
                                            alert(d);
                                          $("#modalordenitems").modal('hide');
                                          mostrar_items(cot);
                                        }
                                     });

        
 
    });
}
function validarc(id){
    var cant = $("#v_cantidad"+id).val();
    var rest = $("#v_restante"+id).val();
    if(parseFloat(cant) > parseFloat(rest)){
        alert("La cantidad digitada es mayor a la restante.");
        $("#v_cantidad"+id).val(rest);
    }
}