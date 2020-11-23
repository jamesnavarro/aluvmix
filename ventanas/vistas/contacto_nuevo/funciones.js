 
$(function() {
     $("#mostrar_tabla").html(mostrar_contacto_nuevo(1));
     
        $('#nombre').change(function(){
             mostrar_contacto_nuevo(1);  
     });
      $('#guardar_contacto_nuevo').click(function(){
             guardar_contacto_nuevo();  
     });
  
});

function nuevo(){
    $("#FormularioProducto").modal("show");
    limpiar_nuecont();
}

function buscar_clientes(id){
    window.open("../ventanas/clientes/index.php?id="+id , "CLIENTES", " width= 600 , height=500 ");
}
function obtener_cliente(user,nombre){
    $("#cliente").val(user);
    $("#nombre_cliente").val(nombre);
}


function mostrar_contacto_nuevo(page){
     var cont_nue= $("#nombre").val();
        $.ajax({
            type: 'GET',
            data: 'nom_conc='+cont_nue+'&page='+page,
            url: '../vistas/contacto_nuevo/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado); 
            }
           });
     
}
function guardar_contacto_nuevo(){ 
                var id_conse_nu = $("#consecu_contact_nu").val(); 
                var nameconnu= $("#nom_contact_nue").val();
                var tl_conu = $("#tel_contact_nue").val();
                var mail_conu= $("#mail_contac_nue").val();
                var carg_conu = $("#cargo_contact_nu").val();
                var sug_conu = $("#sug_contact_nue").val();
                var por_contu = $("#regis_contac_nue").val();
                var fec_contu= $("#fecha_reg_contac_nue").val();
                var id_clienn= $("#nombre_cliente").val();

     if(nameconnu===''){
        sweetAlert("nombre!");
        $("#nom_contact_nue").focus();
        return false;
    }
    if(tl_conu===''){
        sweetAlert("telefono");
        $("#tel_contact_nue").focus();
        return false;
    }
     if(mail_conu===''){
        sweetAlert("email");
        $("#mail_contac_nue").focus();
        return false;
     }
      if(carg_conu===''){
        sweetAlert("cargo");
        $("#cargo_contact_nu").focus();
        return false;
     }
     
       if(id_clienn===''){
        sweetAlert("Con que cliente se relaciona este contacto, de lo contrario escoja CLIENTES VARIOS");
        $("#nombre_cliente").focus();
        return false;
     }
   
        $.ajax({
            type: 'GET',
            data: 'id_nuevocontn='+id_conse_nu+'&nom_nuevoconn='+nameconnu+'&tel_nuevocontn='+tl_conu+'&emai_nuevocontn='
                  +mail_conu+'&carg_nuevocontn='+carg_conu+'&suge_nuevoconn='+sug_conu+'&guardo_nuevon='+por_contu+
                  '&fech_nuevocontn='+fec_contu+'&id_nomclien='+id_clienn+'&sw=1',
            url: '../vistas/contacto_nuevo/acciones.php', 
            success: function(resultado){
                $("#consecu_contact_nu").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_contacto_nuevo(1);
            }
           });
}


function editar_loscontactosn(id){
   $("#FormularioProducto").modal("show");
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/contacto_nuevo/acciones.php', 
            success: function(datos){
                var p = eval(datos);
                var id_consecont = $("#consecu_contact_nu").val(p[0]); 
                var nameconta= $("#nom_contact_nue").val(p[1]);
                var tl_contac = $("#tel_contact_nue").val(p[2]);
                var mail_contac= $("#mail_contac_nue").val(p[3]);
                var carg_contac = $("#cargo_contact_nu").val(p[4]);
                var sug_cont = $("#sug_contact_nue").val(p[5]);
                var por_contac = $("#regis_contac_nue").val(p[6]); 
                var fec_conta= $("#fecha_reg_contac_nue").val(p[7]);
                var fec_conta= $("#cliente").val(p[8]);
                var fec_conta= $("#nombre_cliente").val(p[9]);
                //var su_relacion= $("#la_Relacion").val(p[8]);

            }
           });
}

function limpiar_nuecont(){
    var user_gen = $("#user_general").val();
    var fecha_gen = $("#fecha_general").val();
    
             $("#consecu_contact_nu").val(''); 
             $("#nom_contact_nue").val('');
             $("#tel_contact_nue").val('');
             $("#mail_contac_nue").val('');
             $("#cargo_contact_nu").val('');
             $("#sug_contact_nue").val('');
             $("#regis_contac_nue").val(user_gen); 
             $("#fecha_reg_contac_nue").val(fecha_gen);
             $("#cliente").val('');
             $("#nombre_cliente").val('');
   
}

function cargarmun(){
     var depar = $("#ciud").val(); // 
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=4',  //
            url: '../vistas/clientes/acciones_clientes.php', //
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
    var email = $("#mail_contac_nue").val();
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (caract.test(email) == false){
        alert("digite un correo valido");
        $("#mail_contac_nue").val('').focus();
        return false;
    }else{

        return true;
    }
} 
function borrar(id){
     var page = $("#page").val();
     var c = confirm("Esta seguro de eliminar este contacto?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/contacto_nuevo/acciones.php', //
            success: function(resultado){
                alert("Se eliminó con exito");
                mostrar_contacto_nuevo(page);
            }
           });
       }
}

