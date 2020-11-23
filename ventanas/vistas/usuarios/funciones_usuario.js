 
$(function() {
    $("#mostrar_tabla").html(mostrar_usuario(1));
    
     $('#nombres').change(function(){
             mostrar_usuario(1);
     });
     $('#fecha').change(function(){
             mostrar_usuario(1);
     });
   
});
function mostrar_usuario(page){
     var nombres = $("#nombres").val();
     var fecha = $("#fecha").val();   
 
     
        $.ajax({
            type: 'GET',
            data: 'nombres='+nombres+'&fecha='+fecha+'&page='+page,
            url: '../vistas/usuarios/lista_usuarios.php',
            success: function(resultado){
                     $("#mostrar_tabla").html(resultado);
            }
           });
     
}
function nuevo(){
    $("#FormularioProducto").modal("show");
}
function guardar_usuario(){
   
    var cd = $("#cod").val();
    var nom = $("#nombrex").val();
    var usu = $("#usuario").val();
    var cla = $("#clave").val();
    var est = $("#estado").val();

    if(nom===''){
        alert("Debes de digitar el nombre");
        $("#nombrex").focus();
        return false;
    }
      if(usu===''){
        alert("ingresa el usuario");
        $("#usuario").focus();
        return false;
    }
    if(cd===''){
        if(cla===''){
            alert("ingresa la clave");
            $("#clave").focus();
            return false;
        }
    }
  
    if(est===''){
        alert("selecciona estado");
        $("#estado").focus();
        return false;
    }
    
        $.ajax({
            type: 'GET',
            data: 'nombres='+nom+'&usuario='+usu+'&clave='+cla+'&estado='+est+'&codigo='+cd+'&sw=1', 
            url: '../vistas/usuarios/acciones_usuario.php',
            success: function(resultado){
                $("#cod").val(resultado);
                alert("Se guardo con exito");
                mostrar_usuario(1);
            }
           });
}

function limpiar_formulario(){
    $("#cod").val(''); 
    $("#usuario").val('');
    $("#clave").val('');
    $("#nombrex").val('');
    $("#estado").val('');
}

function editar(id){

    $("#FormularioProducto").modal("show");
 
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/usuarios/acciones_usuario.php', //
            success: function(resultado){
                var t = eval(resultado);
                $("#cod").val(t[0]);
                $("#usuario").val(t[1]);
                $("#nombrex").val(t[2]); 
                $("#estado").val(t[5]);
            }
           });
}

function borrar(id){
     var page = $("#page").val(); 
     var c = confirm("Esta seguro de eliminar este usuario?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/usuarios/acciones_usuario.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_usuario(page);
            }
           });
       }
}



 

