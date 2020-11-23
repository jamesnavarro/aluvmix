 
$(function(){
     $("#mostrar_tabla").html(mostrar_kits(1)); 
     $("#cod_pro").click(function(){
         window.open("../popup/productos_var","productos","width=800 , height=600 ");
     });
     
       $('#nom').change(function(){
             mostrar_kits(1);
     });  
        $('#categorias').change(function(){
             mostrar_kits(1);
     });  
      $('#est_k').change(function(){
             mostrar_kits(1);
     });  
     
});
function mostrar_kits(page){
     var nom = $("#nom").val();
     var categorias = $("#categorias").val();
     var est_k = $("#est_k").val();
        $.ajax({
            type: 'GET',
            data:'nom='+nom+'&categorias='+categorias+'&est_k='+est_k+'&page='+page,
            url: '../vistas/presupuestos/kits/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function guardar_kits(){ 
     var codigo = $("#codigo").val();
     var descripcion= $("#descripcion").val();
     var modulo= $("#modulo").val();
     var sistema= $("#sistema").val();
     var valor= $("#valor").val();
     var est_kit= $("#est_kit").val();
     
    if(descripcion===''){
        sweetAlert("Digite la descripcion");
        $("#descripcion").focus();
        return false;
    }
    if(modulo===''){
        sweetAlert("Digite el modulo");
        $("#modulo").focus();
        return false;
    }
      if(est_kit===''){
        sweetAlert("Seleccione el estado");
        $("#est_kit").focus();
        return false;
    }

   
        $.ajax({
            type: 'GET',
            data: 'codigo='+codigo+'&descripcion='+descripcion+'\
    &modulo='+modulo+'&sistema='+sistema+'&valor='+valor+'&est_kit='+est_kit+'&sw=1',
            url: '../vistas/presupuestos/kits/acciones.php', 
            success: function(resultado){
                $("#codigo").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_kits(1);
            }
           });
}

function limpiar_kits(){
     var codigo = $("#codigo").val('');
     var descripcion= $("#descripcion").val('');
     var modulo= $("#modulo").val('');
     var sistema= $("#sistema").val('');
     var valor= $("#valor").val('');
      var est_kit= $("#est_kit").val('');
}


function editar(id){
        $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
         url: '../vistas/presupuestos/kits/acciones.php', 
        success: function(resultado){
             var p = eval(resultado);
             $("#codigo").val(p[0]);
             $("#descripcion").val(p[1]);
             $("#titu").html(p[1]);
             $("#modulo").val(p[2]);
             $("#sistema").val(p[3]);
             $("#valor").val(p[4]);
             $("#est_kit").val(p[5]);
             mostrar_insumos_kit();
             mostrar_sistema_kit();
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/kits/acciones.php', 
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_kits(1);
            }
           });
       }
}
function pasar_acc(cod,nom){
    $("#cod_pro").val(cod);
    $("#des_pro").val(nom);
}
function agregar_insumos(){
     var codigo = $("#codigo").val();
      var ref = $("#cod_pro").val();
      var des = $("#des_pro").val();
      var can = $("#can_pro").val();
      $.ajax({
            type: 'GET',
            data: 'codigo='+codigo+'&ref='+ref+'&des='+des+'&can='+can+'&sw=4',  //
            url: '../vistas/presupuestos/kits/acciones.php', 
            success: function(resultado){
                alert("Se guardo con exito");
                mostrar_insumos_kit();
                mostrar_sistema_kit();
                $("#cod_pro").val('');
                $("#des_pro").val('');
                $("#can_pro").val('');
            }
           });
}
function mostrar_insumos_kit(){
     var codigo = $("#codigo").val();
      $.ajax({
            type: 'GET',
            data: 'codigo='+codigo+'&sw=5',  //
            url: '../vistas/presupuestos/kits/acciones.php', 
            success: function(resultado){
                $("#ver_insumos").html(resultado);
            }
           });
}
function delkititem(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=6',  //
            url: '../vistas/presupuestos/kits/acciones.php', 
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_insumos_kit();
            }
           });
       }
}
function agregar_sistemas(){
      var codigo = $("#codigo").val();
      var sis = $("#sis").val();
         $.ajax({
            type: 'GET',
            data: 'codigo='+codigo+'&sis='+sis+'&sw=7',  //
            url: '../vistas/presupuestos/kits/acciones.php', 
            success: function(){
                mostrar_sistema_kit();
            }
           });
}
function mostrar_sistema_kit(){
     var codigo = $("#codigo").val();
      $.ajax({
            type: 'GET',
            data: 'codigo='+codigo+'&sw=8',  //
            url: '../vistas/presupuestos/kits/acciones.php', 
            success: function(resultado){
                $("#ver_sistema").html(resultado);
            }
           });
}
function del_sis(id){
     var c = confirm("Esta seguro de eliminar este items?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=9',  //
            url: '../vistas/presupuestos/kits/acciones.php', 
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_sistema_kit();
            }
           });
       }
}

function cam(id,est){
    var page = $("#page").val();
     var c = confirm("Esta seguro de cambiar el estado?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&est='+est+'&sw=10',  //
            url: '../vistas/presupuestos/kits/acciones.php', 
            success: function(resultado){
                alert("Se ha editado con exito el estado");
                mostrar_kits(page);
            }
           });
       }
}


