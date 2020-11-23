$(function(){
     $("#mostrar_tabla").html(mostrar_color(1)); 
     
      $('#precolor').change(function(){
         mostrar_color(1);  
     });
 
});
function mostrar_color(page){
     var colorpre = $("#precolor").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&precol='+colorpre,
            url: '../vistas/presupuestos/crear_color/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_color(){ 
     var id = $("#id_color").val(); 
     var coloralu = $("#color_alumi").val();
     var cosalum = $("#cost_alumi").val();
     
      if(coloralu===''){
        sweetAlert("color");
        $("#color_alumi").focus();
        return false;
    }
    if(cosalum===''){
        sweetAlert("costo");
        $("#cost_alumi").focus();
        return false;
    }
        $.ajax({
            type: 'GET',
            data: 'id_col='+id+'&coloralun='+coloralu+'&cosalumn='+cosalum+'&sw=1',
            url: '../vistas/presupuestos/crear_color/acciones.php', 
            success: function(resultado){
                $("#id_color").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_color(1);
            }
           });
}
function limpiar_color(){
    $("#id_color").val(''); 
    $("#color_alumi").val('');
    $("#cost_alumi").val('');
}

function nuevo(){
    limpiar_color();
}

function editar(id){
      $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/crear_color/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
    $("#id_color").val(p[0]); 
    $("#color_alumi").val(p[1]);
    $("#cost_alumi").val(p[2]);

 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/crear_color/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_color(1);
            }
           });
       }
}





