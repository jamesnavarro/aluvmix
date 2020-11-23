 
$(function(){
     $("#mostrar_tabla").html(mostrar_cris(1)); 

    $('#nom').change(function(){
             mostrar_cris(1);
     });  
       $('#area').change(function(){
             mostrar_cris(1);
     });  
});

function mostrar_cris(page){
    var cod =$("#nom").val();
    var area =$("#area").val();
        $.ajax({
            type: 'GET',
             data:'cod='+cod+'&area='+area+'&page='+page,
            url: '../vistas/presupuestos/cristales/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function guardar_cris(){ 
     var id_cris = $("#id_cris").val();
     var descrip_cris= $("#descrip_cris").val();
      var area_cris= $("#area_cris").val();
      var secu_cristal= $("#secu_cristal").val();
     
    if(descrip_cris===''){
        sweetAlert("digite descripcion");
        $("#descrip_cris").focus();
        return false;
    }
   
        $.ajax({
            type: 'GET',
            data: 'id_cris='+id_cris+'&descrip_cris='+descrip_cris+'&area_cris='+area_cris+'&secu_cristal='+secu_cristal+'&sw=1',
            url: '../vistas/presupuestos/cristales/acciones.php', 
            success: function(resultado){
                $("#id_cris").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_cris(1);
            }
           });
}

function limpiar_cris(){
   $("#descrip_cris").val('');
   $("#area_cris").val(''); 
   $("#secu_cristal").val('');
}

function nuevo(){
    $("#agregar").modal("show");
    limpiar_cris();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/cristales/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
     $("#id_cris").val(p[0]);
    $("#descrip_cris").val(p[1]);
    $("#area_cris").val(p[2]); 
    $("#secu_cristal").val(p[3]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta informacion");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/cristales/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_cris(1);
            }
           });
       }
}





