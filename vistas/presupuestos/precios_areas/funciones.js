 
$(function(){
     $("#mostrar_tabla").html(mostrar_prearea(1)); 
     
      $('#prearea').change(function(){
         mostrar_prearea(1);  
     });
 
});
function mostrar_prearea(page){
     var nuevprea = $("#prearea").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&gast_nue='+nuevprea,
            url: '../vistas/presupuestos/precios_areas/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_prearea(){ 
     var id = $("#id_prea").val(); 
     var prelinea = $("#lineaprea").val();
     var predes = $("#des_prea").val();
     var presig= $("#asi_prea").val();
     var prefa = $("#fabi_prea").val();
     var preadi = $("#adi_prea").val();
     var remed = $("#med_prea").val();
   
      if(prelinea===''){
        sweetAlert("linea");
        $("#prelinea").focus();
        return false;
    }
    if(predes===''){
        sweetAlert("descripcion");
        $("#des_prea").focus();
        return false;
    }
     if(presig===''){
        sweetAlert("asignacion");
        $("#asi_prea").focus();
        return false;
    }
    if(prefa===''){
        sweetAlert("precio de fabricacion");
        $("#asi_prea").focus();
        return false;
    }
   
     if(remed===''){
        sweetAlert("unidad de medida");
        $("#med_prea").focus();
        return false;
    }
    
        $.ajax({
            type: 'GET',
            data: 'id_preare='+id+'&prelinean='+prelinea+'&predesn='+predes+'&presign='+presig+'&prefan='+prefa+'&preadin='+preadi+'&remedn='+remed+'&sw=1',
            url: '../vistas/presupuestos/precios_areas/acciones.php', 
            success: function(resultado){
                $("#id_prea").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_prearea(1);
            }
           });
}
function limpiar_prearea(){
    $("#id_prea").val(''); 
    $("#lineaprea").val('');
    $("#des_prea").val('');
    $("#asi_prea").val('');
    $("#fabi_prea").val('');
    $("#adi_prea").val('');
    $("#med_prea").val('');
}

function nuevo(){
    limpiar_prearea();
}

function editar_p(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/precios_areas/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
    $("#id_prea").val(p[0]); 
    $("#lineaprea").val(p[1]);
    $("#des_prea").val(p[2]);
    $("#asi_prea").val(p[3]);
    $("#fabi_prea").val(p[4]);
    $("#adi_prea").val(p[5]);
    $("#med_prea").val(p[6]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/precios_areas/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_prearea(1);
            }
           });
       }
}





