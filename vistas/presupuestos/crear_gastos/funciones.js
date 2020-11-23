 
$(function(){
     $("#mostrar_tabla").html(mostrar_gasto(1)); 
     
      $('#nue_gast').change(function(){
         mostrar_gasto(1);  
     });
 
});
function mostrar_gasto(page){
     var nuev = $("#nue_gast").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&gast_nue='+nuev,
            url: '../vistas/presupuestos/crear_gastos/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_gasto(){ 
     var id = $("#id_gast").val(); 
     var refe = $("#refer").val();
     var descp = $("#descrip").val();
     var por = $("#porcent").val();
      var estgas = $("#estad_gastos").val();
   
      if(refe===''){
        sweetAlert("digite referencia");
        $("#refer").focus();
        return false;
    }
    if(descp===''){
        sweetAlert("digite descripcion");
        $("#descrip").focus();
        return false;
    }
     if(por===''){
        sweetAlert("digite porcentaje");
        $("#porcent").focus();
        return false;
    }
        $.ajax({
            type: 'GET',
            data: 'id_pr='+id+'&refee='+refe+'&descpp='+descp+'&porr='+por+'&estgas='+estgas+'&sw=1',
            url: '../vistas/presupuestos/crear_gastos/acciones.php', 
            success: function(resultado){
                $("#id_gast").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_gasto(1);
            }
           });
}

function limpiar_gasto(){
   $("#id_gast").val(''); 
   $("#refer").val('');
   $("#descrip").val('');
   $("#porcent").val('');
   $("#estad_gastos").val('');
}

function nuevo(){
    limpiar_gasto();
}

function editar_b(id){
      $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/crear_gastos/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_gast").val(p[0]);
   $("#refer").val(p[1]);
   $("#descrip").val(p[2]);
   $("#porcent").val(p[3]);
   $("#estad_gastos").val(p[4]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/crear_gastos/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_gasto(1);
            }
           });
       }
}





