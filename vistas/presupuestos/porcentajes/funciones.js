 
$(function(){
     $("#mostrar_tabla").html(mostrar_porcentajes(1)); 
});
function mostrar_porcentajes(page){
        $.ajax({
            type: 'GET',
            data: page,
            url: '../vistas/presupuestos/porcentajes/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function guardar_porcentaje(){ 
     var id = $("#id_porc").val(); 
     var line = $("#linea").val();
     var pr1 = $("#por1").val();
     var pr2 = $("#por2").val();
   
    
    if(line===''){
        sweetAlert("elija tipo de linea");
        $("#linea").focus();
        return false;
    }
      if(pr1===''){
        sweetAlert("digite porcentaje 1");
        $("#por1").focus();
        return false;
    }
    if(pr2===''){
        sweetAlert("digite porcentaje 2");
        $("#por2").focus();
        return false;
    }
  
 
        $.ajax({
            type: 'GET',
            data: 'id_p='+id+'&lin='+line+'&prr1='+pr1+'&prr2='+pr2+'&sw=1',
            url: '../vistas/presupuestos/porcentajes/acciones.php', 
            success: function(resultado){
                $("#id_porc").val(resultado); 
                sweetAlert("Se guardo con exito"+resultado);
                mostrar_porcentajes(1);
            }
           });
}

function limpiar_porcentajes(){
   $("#id_porc").val(''); 
   $("#linea").val('');
   $("#por1").val('');
   $("#por2").val('');
  

}
function nuevo(){
    $("#agregar").modal("show");
    limpiar_porcentajes();
}

function editar(id){
     $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/porcentajes/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_porc").val(p[0]);
   $("#linea").val(p[1]);
   $("#por1").val(p[2]);
   $("#por2").val(p[3]);
  
   
 }
           });
}











































