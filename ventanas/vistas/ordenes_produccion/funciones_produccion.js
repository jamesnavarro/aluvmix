$(function() {

    $("#mostrar_tabla").html(mostrar_ordenes_produccion(1));

    $('#coti').change(function(){
             mostrar_ordenes_produccion(1);
     });
      $('#nomobra').change(function(){
             mostrar_ordenes_produccion(1); 
     });
       $('#fomp').change(function(){
             mostrar_ordenes_produccion(1); 
     });
 });

function mostrar_ordenes_produccion(pagina){
    
    var ncoti = $("#coti").val();
    var obra = $("#nomobra").val();
    var plus = $("#fomp").val();
    $.ajax({
            type: 'GET',
            data: 'ncot='+ncoti+ '&obra='+obra+ '&fplus='+plus+ '&page='+pagina,
            url: '../vistas/ordenes_produccion/lista_produccion.php',
            success: function(resultado){
                     $("#mostrar_tabla").html(resultado);
            }
           });

}

function nuevo(){
    $("#FormularioProducto").modal("show");
}
function guardar_producto(){
    
    var id = $("#art_idp").val(); 
    var des = $("#art_des").val();
    var pre = $("#art_pre").val();
    var tip = $("#art_tipo").val();
    var est = $("#art_est").val();
    var page = $("#page").val();

    if(des===''){
        alert("Debes de digitar la descripcion");
        $("#art_des").focus();
        return false;
    }
    if(pre===''){
        alert("Debes de digitar el precio");
        $("#art_pre").focus();
        return false;
    }
    if(tip===''){
        alert("Debes de seleccionar el tipo");
        $("#art_tipo").focus();
        return false;
    }
    if(est===''){
        alert("Debes de digitar seleccionar el estado");
        $("#art_est").focus();
        return false;
    }
        $.ajax({
            type: 'GET',
            data: 'id='+id+'&desc='+des+'&pre='+pre+'&tip='+tip+'&est='+est+'&sw=1', 
            url: '../vistas/productos/acciones.php',
            success: function(resultado){
                $("#art_idp").val(resultado);
                alert("Se guardo con exito");
                mostrar_productos(page);
            }
           });
}
function limpiar_formulario(){
    $("#art_idp").val(''); 
    $("#art_des").val('');
    $("#art_pre").val('');
    $("#art_tipo").val('');
    $("#art_est").val('');
}
function editar(id){
    $("#FormularioProducto").modal("show");

     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/ordenes_produccion/acciones.php', //
            success: function(resultado){
                var p = eval(resultado);
                $("#id_orden").val(p[0]);
                $("#íd_cot").val(p[1]);
                $("#id_cliente").val(p[2]);
                $("#ubicacion").val(p[3]);
                $("#obra").val(p[4]);   
                $("#fecha_reg_c").val(p[5]);
                $("#fecha_modificacion").val(p[6]);
                $("#estado").val(p[7]);
                $("#linea").val(p[8]);
                $("#ciudad").val(p[9]); 
                $("#pais_ter").val(p[10]);
                $("#municipio").val(p[11]);
            }
           });
}
function borrar(id){
     var page = $("#page").val();
     var c = confirm("Esta seguro de eliminar este item?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/productos/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_productos(page);
            }
           });
       }
}