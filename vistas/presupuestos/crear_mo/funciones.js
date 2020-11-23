 
$(function(){
     $("#mostrar_tabla").html(mostrar_prec(1)); 
     
      $('#nue_pr').change(function(){
         mostrar_prec(1);  
     });
 
});
function mostrar_prec(page){
     var nuv = $("#nue_pr").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&pr_nue='+nuv,
            url: '../vistas/presupuestos/crear_mo/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function guardar_prec(){ 
     var id = $("#id_pr").val(); 
     var refen = $("#refer_n").val();
     var descpn = $("#descrip_n").val();
     var instn = $("#es_ins").val();
     var fr_cob = $("#for_cob").val();
     var utin = $("#uti_serv").val();
   
      if(refen===''){
        sweetAlert("digite referencia");
        $("#refer_n").focus();
        return false;
    }
    if(descpn===''){
        sweetAlert("digite descripcion");
        $("#descrip_n").focus();
        return false;
    }
     if(fr_cob===''){
        sweetAlert("costo");
        $("#for_cob").focus();
        return false;
    }
    if(utin===''){
        sweetAlert("utilidad");
        $("#uti_serv").focus();
        return false;
    }
        $.ajax({
            type: 'GET',
            data: 'id_pr='+id+'&refeen='+refen+'&descppn='+descpn+'&intnn='+instn+'&fr_cobb='+fr_cob+'&utinn='+utin+'&sw=1',
            url: '../vistas/presupuestos/crear_mo/acciones.php', 
            success: function(resultado){
                $("#id_pr").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_prec(1);
            }
           });
}

function limpiar_prec(){
   $("#id_pr").val(''); 
   $("#refer_n").val('');
   $("#descrip_n").val('');
   $("#es_ins").val('');
   $("#for_cob").val('');
   $("#uti_serv").val('');
}

function nuevo(){
    $("#agregar").modal("show");
    limpiar_prec();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/crear_mo/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_pr").val(p[0]);
   $("#refer_n").val(p[1]);
   $("#descrip_n").val(p[2]);
   $("#es_ins").val(p[3]);
   $("#for_cob").val(p[4]);
   $("#uti_serv").val(p[5]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/crear_mo/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_prec(1);
            }
           });
       }
}





