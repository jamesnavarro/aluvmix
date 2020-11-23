 
$(function(){
     $("#mostrar_tabla").html(mostrar_actividades(1));
     $('#nombre').change(function(){
             mostrar_actividades(1);  
     });
     $('#esta').change(function(){
             mostrar_actividades(1);
     });   
       $('#finicio').change(function(){
             mostrar_actividades(1); 
     });  
       $('#ffinal').change(function(){
             mostrar_actividades(1); 
     });  
       $('#usuarioc').change(function(){
             mostrar_actividades(1); 
     }); 
        $('#clienteb').change(function(){
             mostrar_actividades(1); 
     }); 
});
function mostrar_actividades(page){
     var cedu= $("#nombre").val();
     var estado = $("#esta").val();
     var ini = $("#finicio").val();
     var final =$("#ffinal").val();
     var fusuario =$("#usuarioc").val();
     var cli= $("#clienteb").val();
     $.ajax({
            type: 'GET',
            data: 'nom='+cedu+'&estad='+estado+'&ini='+ini+'&fin='+final+'&fusuarioc='+fusuario+'&cli='+cli+'&page='+page,
            url: '../vistas/cartera/actividades/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
function nuevo(){
    $("#FormularioProducto").modal("show");
    limpiar_act();
}
function escritura(){
    var desc = $("#descrip").val(); 
    if (desc!=''){
        $("#est_llamada").val('Completada');
    }
}
function buscar_contacto(id){
    window.open("../ventanas/contactos/index.php?id="+id , "CLIENTES", " width= 600 , height=500 ");
}
function obtener_contacto(user,nombre){
    $("#cliente").val(user);
    $("#nombre_cliente").val(nombre);
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
     
     if(est==='Completada'){
         sweetAlert("Upss, no se permite editar esta informacion, crea una nueva llamada!");
         return false;
     }
    if(asunt===''){
        sweetAlert("Digite el asunto de la llamada");
        $("#motivo").focus();
        return false;
    }
      if(f_ini===''){
        sweetAlert("Ingrese la fecha ¡");
        $("#fec_ini").focus();
        return false;
    }
    if(hora===''){
        sweetAlert("hora de llamada");
        $("#hra").focus();
        return false;
    }
     if(asig===''){
        sweetAlert("Seleccione el usuario");
        $("#asig").focus();
        return false;
    }
 
      if(llamad===''){
        sweetAlert("Seleccione el tipo de llamada");
        $("#tip_llamada").focus();
        return false;
    }
      if(est===''){
        sweetAlert("Seleccione el estado llamada");
        $("#est_llamada").focus();
        return false;
    }
       if(client===''){
        sweetAlert("Seleccione el cliente");
        $("#nombre_cliente").focus();
        return false;
    }

        $.ajax({
            type: 'GET',
            data: 'radi='+id+'&asunt='+asunt+'&ini='+f_ini+'&hra='+hora+ '&asig='+asig+'&aviso='+aviso+'&descrip='+desc+'&llamada='+llamad+'&estado='+est+'&nom_cli='+client+'&sw=1',
            url: '../vistas/cartera/actividades/acciones.php', 
            success: function(resultado){
                $("#id_a").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_actividades(1);
            }
           });
}
function limpiar_act(){
   $("#id_a").val(''); 
   $("#motivo").val('');
   $("#fec_ini").val('');
   $("#hra").val('');
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
            url: '../vistas/cartera/actividades/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
   $("#id_a").val(t[0]);
   $("#motivo").val(t[1]);
   $("#descrip").val(t[2]);
   $("#fec_ini").val(t[3]);
   
   if(t[4]==='Completada'){
       $("#est_llamada").attr("disabled",true);
   }else{
       $("#est_llamada").attr("disabled",false);    
   }
   $("#reprogramar").html('<button onclick="reprogramar('+id+');" type="button" class="btn btn-default">Reprogramar</button>');
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
function reprogramar(id){
         window.open("../vistas/cartera/actividades/reprogramar.php?id="+id, "Rep", "width=500 , height=200");
}
function programar(id,nombre){
    window.open("../vistas/cartera/terceros/detalles.php?id="+id+"&name="+nombre , "Llamadas", " width= 900 , height=500 ");
}
function add_reprogramar(id){
    var fec_ini = $("#fec_ini").val();
    var hra = $("#hra").val();
    if(fec_ini===''){
        alert("selecciona la fecha");
        $("#fec_ini").focus();
    }
    if(hra===''){
        alert("Seleccione la hora");
        $("#hra").focus();
    }
      var c = confirm("Se reprogramara la actividad");
      if(c){
             $.ajax({
            type: 'GET',
            data: 'id='+id+'&fecha='+fec_ini+'&hora='+hra+'&sw=8',  //
            url: 'acciones.php', 
            success: function(resultado){
                alert("Se programo la actividad con exito "+resultado);
                window.opener.mostrar_actividades(1);
            }
           });
       }
}
function borrar(id){
     var page = $("#page").val();
     var c = confirm("vas a cambiar el estado?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/cartera/actividades/acciones.php', 
            success: function(resultado){
                //sweetAlert("Se ha eliminado con exito");
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
            sweetAlert('minimo 1 caracteres');
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
    
    if (caract.test(email) === false){
        sweetAlert("digite un correo valido");
        $("#email").val('').focus();
        return false;
    }else{
        return true;
    }
} 

function buscar_cliente(){
    window.open("../ventanas/clientes/index.php" , "CLIENTES", " width= 600 , height=500 ");
}

 function obtener_cliente(id, nombre){
    $("#cliente").val(id);
    $("#nombre_cliente").val(nombre);
}

function buscar_usuario(){
    window.open("../ventanas/usuarios/index.php" , "USUARIOS", " width= 600 , height=500 ");
}
 function obtener_usuario(nombre){
  
    $("#asig").val(nombre);
}




 