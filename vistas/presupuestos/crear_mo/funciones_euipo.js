 
$(function(){
     $("#mostrar_tabla_e").html(mostrar_equpo(1)); 
     
      $('#nue_equi').change(function(){
         mostrar_equpo(1);  
     });
 
});
function mostrar_equpo(page){
     var nuequi = $("#nue_equi").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&equi_nue='+nuequi,
            url: '../vistas/crear_mo/lista_equipo.php',
            success: function(resultado){
                 $("#mostrar_tabla_e").html(resultado);
            }
           }); 
}
function guardar_equipo(){ 
     var id = $("#id_equi").val(); 
     var refequi = $("#refer_equi").val();
     var desequi = $("#descrip_equipo").val();
     var valequi = $("#valor_equipo").val();
     var calequi = $("#calcular").val();
     var diasequi = $("#dias_equi").val();
     var numequi = $("#num_dias").val();
     
   if(refequi===''){
        sweetAlert("digite referencia");
        $("#refer_equi").focus();
        return false;
    }
    if(desequi===''){
        sweetAlert("digite descripcion");
        $("#descrip_equipo").focus();
        return false;
    }
     if(valequi===''){
        sweetAlert("valor equipo");
        $("#valor_equipo").focus();
        return false;
    }
    if(calequi===''){
        sweetAlert("utilidad");
        $("#calcular").focus();
        return false;
    }
     if(diasequi===''){
        sweetAlert("dias");
        $("#dias_equi").focus();
        return false;
    }
   
        $.ajax({
            type: 'GET',
            data: 'id_equip='+id+'&refequin='+refequi+'&desequin='+desequi+'&valequin='+valequi+'&calequin='+calequi+'&diasequin='+diasequi+'&numequin='+numequi+'&sw=1',
            url: '../vistas/crear_mo/acciones_equipo.php', 
            success: function(resultado){
                $("#id_equi").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_equpo(1);
            }
           });
}

function limpiar_equipo(){
  $("#id_equi").val(''); 
  $("#refer_equi").val('');
  $("#descrip_equipo").val('');
  $("#valor_equipo").val('');
  $("#calcular").val('');
  $("#dias_equi").val('');
  $("#num_dias").val('');
}

function nuevo(){
    $("#agregarn").modal("show");
    limpiar_equipo();
}

function editar_equi(id){
      $("#marcar3").attr("class","");
    $("#marcar4").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/crear_mo/acciones_equipo.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_equi").val(p[0]);
   $("#refer_equi").val(p[1]);
   $("#descrip_equipo").val(p[2]);
   $("#valor_equipo").val(p[3]);
   $("#calcular").val(p[4]);
   $("#dias_equi").val(p[5]);
   $("#num_dias").val(p[6]);
 }
 });
}

function borrar_equi(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/crear_mo/acciones_equipo.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_equpo(1);
            }
           });
       }
}





