 
$(function(){
     $("#mostrar_tabla").html(mostrar_temple(1)); 
     
      $('#nue_espe').change(function(){
         mostrar_temple(1);  
     });
 
});
function mostrar_temple(page){
     var nue = $("#nue_espe").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&espe_nue='+nue,
            url: '../vistas/presupuestos/servicio_temple/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function guardar_temple(){ 
     var id = $("#id_tem").val(); 
     var espsr = $("#espes").val();
     var cos_t = $("#cos_tem").val();
    
   
      if(espsr===''){
        sweetAlert("digite espesor");
        $("#espes").focus();
        return false;
    }
    if(cos_t===''){
        sweetAlert("digite digite costo");
        $("#cos_tem").focus();
        return false;
    }
     
        $.ajax({
            type: 'GET',
            data: 'id_e='+id+'&rspsrr='+espsr+'&cost_tm='+cos_t+'&sw=1',
            url: '../vistas/presupuestos/servicio_temple/acciones.php', 
            success: function(resultado){
                $("#id_tem").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_tabla(1);
            }
           });
}

function limpiar_temple(){
   $("#id_tem").val(''); 
   $("#espes").val('');
   $("#cos_tem").val('');
}

function nuevo(){
    $("#agregar").modal("show");
    limpiar_temple();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/servicio_temple/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_tem").val(p[0]);
   $("#espes").val(p[1]);
   $("#cos_tem").val(p[2]);
 }
 });
}
//paginacion



