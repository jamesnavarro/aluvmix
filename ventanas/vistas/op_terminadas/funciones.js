 
$(function() {
     $("#mostrar_tabla").html(mostrar_terminadas(1));
    
     $('#termi').change(function(){
             mostrar_terminadas(1);  
     });
    
});
function mostrar_terminadas(page){
     var ter= $("#termi").val();
    
        $.ajax({
            type: 'GET',
            data: 'opnum='+ter+'&page='+page,
            url: '../vistas/op_terminadas/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}

function nuevo(){
    $("#FormularioProducto").modal("show");
    limpiar_act();
}
function guardar_actividad(){ 
     var id = $("#id_a").val(); 
     var asunt = $("#motivo").val();
     var f_ini = $("#fec_ini").val();
     var hora = $("#hra").val();
     var asig= $("#asig").val();
     var aviso = $("#alarma").val();
     var desc = $("#descrip").val();
     var llamad = $("#tip_llamada").val();
     var est = $("#est_llamada").val();
     var client = $("#cliente").val();

    if(asunt===''){
        alert("motivo");
        $("#motivo").focus();
        return false;
    }
      if(f_ini===''){
        alert("ingrese la fecha");
        $("#fec_ini").focus();
        return false;
    }
    if(hora===''){
        alert("escoja la hora");
        $("#hra").focus();
        return false;
    }
     if(asig===''){
        alert("asignado");
        $("#asig").focus();
        return false;
    }
      if(aviso===''){
        alert("aviso");
        $("#alarma").focus();
        return false;
    }
     if(desc===''){
        alert("motivo");
        $("#descrip").focus();
        return false;
    }

      if(llamad===''){
        alert("llamada");
        $("#llamad").focus();
        return false;
    }
      if(est===''){
        alert("estado llamada");
        $("#est_llamada").focus();
        return false;
    }
       if(client===''){
        alert("cliente");
        $("#client").focus();
        return false;
    }

        $.ajax({
            type: 'GET',
            data: 'radi='+id+'&asunt='+asunt+'&ini='+f_ini+'&hra='+hora+ '&asig='+asig+'&aviso='+aviso+'&descrip='+desc+'&llamada='+llamad+'&estado='+est+'&nom_cli='+client+'&sw=1',  
            url: '../vistas/actividades/acciones.php',
            success: function(resultado){
                $("#id_a").val(resultado); 
                alert("Se guardo con exito");
                mostrar_actividades(1); 
            }
           });
}
function limpiar_act(){
   $("#id_a").val(''); 
   $("#motivo").val('');
   $("#fec_ini").val('');
   $("#hra").val('');
   $("#asig").val('');
   $("#alarma").val('');
   $("#descrip").val('');
   $("#tip_llamada").val('');
   $("#est_llamada").val('');
   $("#cliente").val('');
   $("#nombre_cliente").val('');

}
function editar_act(id){
    $("#FormularioProducto").modal("show");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/actividades/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
   $("#id_a").val(t[0]);
   $("#motivo").val(t[1]);
   $("#descrip").val(t[2]);
   $("#fec_ini").val(t[3]);
   $("#est_llamada").val(t[4]);
   $("#tip_llamada").val(t[5]);
   $("#alarma").val(t[6]);
   $("#asig").val(t[7]);
   $("#cliente").val(t[8]);
   $("#hra").val(t[9]);
   $("#nombre_cliente").val(t[10]); 
   
 }
           });
}

function borrar(id){
     var page = $("#page").val();
     var c = confirm("Esta seguro de eliminar este usuario?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id_a='+id+'&sw=3',  //
            url: '../vistas/actividades/acciones.php', 
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_actividades(page);
            }
           });
       }
}
function cargarmun(){
     var depar = $("#ciud").val();
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=4',  
            url: '../vistas/clientes/acciones_clientes.php',
            success: function(resultado){
                $("#muni").html(resultado);
            }
           }); 
}

function validar(){
	
	verifi=$('#verifi').val();

	if (verifi.length>1){
            alert('minimo 1 caracteres');
                $('#verifi').val('');
		return false;
	}
	else { 
		return true;
	}
}

function caracteresCorreoValido(){
    var email = $("#email").val();
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (caract.test(email) == false){
        alert("digite un correo valido");
        $("#email").val('').focus();
        return false;
    }else{

        return true;
    }
} 

function buscar_cliente(){
    window.open("../ventanas/clientes/index.php" , "CLIENTES", " width= 600 , height=500 ");
}

 function obtener_variables(id, nombre){
    $("#cliente").val(id);
    $("#nombre_cliente").val(nombre);
}

function buscar_usuario(){
    window.open("../ventanas/usuarios/index.php" , "USUARIOS", " width= 600 , height=500 ");
}
 function obtener_usuario(nombre){
  
    $("#asig").val(nombre);
}