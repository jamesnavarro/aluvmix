 
$(function(){
     $("#mostrar_tabla").html(mostrar_otr(1)); 
     
      $('#nue_pr').change(function(){
         mostrar_otr(1);  
     });
 
});
function mostrar_otr(page){
     var otr = $("#nue_pr").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&otr_nu='+otr,
            url: '../vistas/presupuestos/crear_otro/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function guardar_otr(){ 
     var id = $("#id_otr").val(); 
     var ref_otr = $("#refer_otr").val();
     var des_otr = $("#descrip_otr").val();
     var cantr = $("#can_otr").val();
     var vaotr = $("#val_otr").val();
   
      if(ref_otr===''){
        sweetAlert("digite referencia");
        $("#refer_otr").focus();
        return false;
    }
    if(des_otr===''){
        sweetAlert("descripcion");
        $("#descrip_otr").focus();
        return false;
    }
     if(cantr===''){
        sweetAlert("cantidad");
        $("#can_otr").focus();
        return false;
    }
    if(vaotr===''){
        sweetAlert("valor");
        $("#val_otr").focus();
        return false;
    }
    
        $.ajax({
            type: 'GET',
            data: 'id_otr='+id+'&ref_otrr='+ref_otr+'&des_otrr='+des_otr+'&cantrr='+cantr+'&vaotrr='+vaotr+'&sw=1',
            url: '../vistas/presupuestos/crear_otro/acciones.php', 
            success: function(resultado){
                $("#id_otr").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_otr(1);
            }
           });
}

function limpiar_otr(){
   $("#id_otr").val(''); 
   $("#refer_otr").val('');
   $("#descrip_otr").val('');
   $("#can_otr").val('');
   $("#val_otr").val('');
}

function nuevo(){
    limpiar_otr();
}

function editar(id){
      $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/crear_otro/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_otr").val(p[0]);
   $("#refer_otr").val(p[1]);
   $("#descrip_otr").val(p[2]);
   $("#can_otr").val(p[3]);
   $("#val_otr").val(p[4]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/crear_otro/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_otr(1);
            }
           });
       }
}





