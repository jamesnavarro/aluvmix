 
$(function(){
     $("#mostrar_tabla").html(mostrar_slineas(1)); 
});
function mostrar_slineas(page){
        $.ajax({
            type: 'GET',
            data: 'page='+page,
            url: '../vistas/sublineas/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function guardar_slineas(){ 
     var id_nuesl = $("#id_sublin").val();
     var nomsub= $("#nombre_slinea").val();
     var valsub= $("#valor_slinea").val();
     var anosub= $("#anoni_slinea").val();
     var transub= $("#tranpo_slinea").val();
     var slineas= $("#slinea").val();
     
    if(nomsub===''){
        sweetAlert("Nombre");
        $("#nombre_slinea").focus();
        return false;
    }
      if(valsub===''){
        sweetAlert("valor");
        $("#valor_slinea").focus();
        return false;
    }
      if(anosub===''){
        sweetAlert("anonisado");
        $("#anoni_slinea").focus();
        return false;
    }
      if(transub===''){
        sweetAlert("transporte");
        $("#tranpo_slinea").focus();
        return false;
    }
      if(slineas===''){
        sweetAlert("sublinea");
        $("#slinea").focus();
        return false;
    }
   
        $.ajax({
            type: 'GET',
            data: 'id_liss='+id_nuesl+'&nomsubs='+nomsub+'&valsubs='+valsub+'&anosubs='+anosub+'&transubs='+transub+'&slineass='+slineas+'&sw=1',
            url: '../vistas/sublineas/acciones.php', 
            success: function(resultado){
                $("#id_sublin").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_slineas(1);
            }
           });
}

function limpiar_slineas(){
   $("#id_sublin").val('');
   $("#nombre_slinea").val('');
   $("#valor_slinea").val('');
   $("#anoni_slinea").val('');
   $("#tranpo_slinea").val('');
   $("#slinea").val('');
}

function nuevo(){
    $("#agregar").modal("show");
    limpiar_slineas();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/sublineas/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
  $("#id_sublin").val(p[0]);
   $("#nombre_slinea").val(p[1]);
   $("#valor_slinea").val(p[2]);
   $("#anoni_slinea").val(p[3]);
   $("#tranpo_slinea").val(p[4]);
   $("#slinea").val(p[5]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/sublineas/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_slineas(1);
            }
           });
       }
}





