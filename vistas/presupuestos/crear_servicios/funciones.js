 
$(function(){
     $("#mostrar_tabla").html(mostrar_ser(1)); 
     
      $('#nue_ser').change(function(){
         mostrar_ser(1);  
     });
 
});
function mostrar_ser(page){
     var nueser = $("#nue_ser").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&servnue='+nueser,
            url: '../vistas/presupuestos/crear_servicios/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_ser(){ 
     var id = $("#id_ser").val(); 
     var dess = $("#des_ser").val();
     var refs = $("#ref_ser").val();
     var vals = $("#Val_ser").val();
    if(dess===''){
        sweetAlert("digite descripcion");
        $("#des_ser").focus();
        return false;
    }
     if(refs===''){
        sweetAlert("referencia");
        $("#ref_ser").focus();
        return false;
    }
     if(vals===''){
        sweetAlert("Valor");
        $("#Val_ser").focus();
        return false;
    }
        $.ajax({
            type: 'GET',
            data: 'id_sr='+id+'&desss='+dess+'&refss='+refs+'&valss='+vals+'&sw=1',
            url: '../vistas/presupuestos/crear_servicios/acciones.php', 
            success: function(resultado){
                $("#id_ser").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_ser(1);
            }
           });
}

function limpiar_ser(){
   $("#id_ser").val(''); 
   $("#des_ser").val('');
   $("#ref_ser").val('');
   $("#Val_ser").val('');
}

function nuevo(){
    limpiar_ser();
}

function editar(id){
      $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/crear_servicios/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_ser").val(p[0]);
   $("#des_ser").val(p[1]);
   $("#ref_ser").val(p[2]);
   $("#Val_ser").val(p[3]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/crear_servicios/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_ser(1);
            }
           });
       }
}





