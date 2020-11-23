$(function() {

    $("#mostrar_tabla").html(mostrar_productos(1));
    $('#descripcion').change(function(){
             mostrar_productos(1); 
     });
     $('#tipo').change(function(){
             mostrar_productos(1);
     });
     $('#usuario').change(function(){
             mostrar_productos(1);
     });
     $('#fecha').change(function(){
             mostrar_productos(1);
     });
});

function mostrar_productos(pagina){

    var desc = $("#descripcion").val();
    var tip = $("#tipo").val();
    var usu = $("#usuario").val();
    var fec = $("#fecha").val();

    $.ajax({
            type: 'GET',
            data: 'desc='+desc+'&tip='+tip+'&usu='+usu+'&fec='+fec+'&page='+pagina,
            url: '../vistas/productos/lista_productos.php',
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
            url: '../vistas/productos/acciones.php', //
            success: function(resultado){
                var p = eval(resultado);
                $("#art_idp").val(p[0]);
                $("#art_des").val(p[1]);
                $("#art_pre").val(p[2]);
                $("#art_tipo").val(p[3]);
                $("#art_est").val(p[4]); 
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