 
$(function(){
     $("#mostrar_tabla").html(mostrar_vidrio(1)); 
     
      $('#codvi').change(function(){
         mostrar_vidrio(1);  
     });
     $('#codi_vidri').change(function(){
         buscar_vidrio();  
     });
 
});
function mostrar_vidrio(page){
     var codvid = $("#codvi").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&codvidv='+codvid,
            url: '../vistas/presupuestos/confi_vidrio/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_vidrio(){ 
     var id = $("#id_vidri").val(); 
     var codivi = $("#codi_vidri").val();
     var colvi = $("#color_vidri").val();
     var refvi = $("#ref_vidri").val();
     var espei = $("#espesor_vidri").val();
     var vicost = $("#costo_vid").val();
     var descr = $("#descripcion").val();
      if(codivi===''){
        sweetAlert("codigo");
        $("#codi_vidri").focus();
        return false;
    }
    if(colvi===''){
        sweetAlert("color");
        $("#color_vidri").focus();
        return false;
    }
     if(refvi===''){
        sweetAlert("referencia");
        $("#ref_vidri").focus();
        return false;
    }
     if(espei===''){
        sweetAlert("espesor");
        $("#espesor_vidri").focus();
        return false;
    }
      if(vicost===''){
        sweetAlert("costo");
        $("#costo_vid").focus();
        return false;
    }
    if(descr===''){
        sweetAlert("El producto debe estar creado en inventario.");
        $("#costo_vid").focus();
        return false;
    }
    
        $.ajax({
            type: 'GET',
            data: 'idv='+id+'&codiviv='+codivi+'&colviv='+colvi+'&refviv='+refvi+'&espeiv='+espei+'&vicostv='+vicost+'&desc='+descr+'&sw=1',
            url: '../vistas/presupuestos/confi_vidrio/acciones.php', 
            success: function(resultado){
                $("#id_vidri").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_tabla(1);
            }
           });
}
function limpiar_vidrio(){
    $("#id_vidri").val(''); 
    $("#codi_vidri").val('');
    $("#color_vidri").val('');
    $("#ref_vidri").val('');
    $("#espesor_vidri").val('');
    $("#costo_vid").val('');
}

function nuevo(){
    limpiar_vidrio();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/confi_vidrio/acciones.php', //
        success: function(resultado){
            console.log(resultado);
  var p = eval(resultado);
    $("#id_vidri").val(p[0]); 
    $("#codi_vidri").val(p[1]);
    $("#color_vidri").val(p[2]);
    $("#ref_vidri").val(p[3]);
    $("#espesor_vidri").val(p[4]);
    $("#costo_vid").val(p[5]);
     $("#descripcion").val(p[6]);
 }
 });
}
function buscar_vidrio(){
    var id =  $("#codi_vidri").val();
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/confi_vidrio/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
    $("#id_vidri").val(p[0]); 
    $("#codi_vidri").val(id);
    $("#color_vidri").val(p[2]);
    $("#ref_vidri").val(p[3]);
    $("#espesor_vidri").val(p[4]);
    $("#costo_vid").val(p[5]);
    $("#descripcion").val(p[6]);
 }
 });
}
function borrar(id){
     var c = confirm("Esta seguro de eliminar esta vidrio?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/confi_vidrio/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_vidrio(1);
            }
           });
       }
}
  function est_vid(id,sw){
          $.ajax({
                   post:'GET',
                     data:'id='+id+'&est='+sw+'&sw=4',
                    url:'../vistas/presupuestos/confi_vidrio/acciones.php',
                   success:function(d){
                   $("#e"+id).html(d);
                   
               } 
            });
        }
function buscar_productos_var(){
    window.open("../popup/productos_var/","Productos","width=1000 , height=800");
}
function pasar_acc(cod,desc){
    $("#codi_vidri").val(cod);
    buscar_vidrio();
    $("#descripcion").val(desc);
}




