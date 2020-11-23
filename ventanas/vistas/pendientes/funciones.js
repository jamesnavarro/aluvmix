 
$(function(){
     $("#mostrar_tabla").html(mostrar_pendientes(1));
     
    $('#nombre').change(function(){
             mostrar_pendientes(1);  
     });
       $('#btn_guardar').click(function(){
             guardar_contacto();  
     });
         $('#bac_guardar').click(function(){
             guardar_actividad();  
     });
      $('#nuefact_guardar').click(function(){
             
             guardar_nueva_factura();  
     });
     
     
     $('#btn_guardar_cot').click(function(){
             $("#btn_guardar_cot").attr("disabled",true );
             agregar_cot();  
     });
     // cajas de texto de porcentaje para calcular 
         $('#val_t_fac').change(function(){
             calculos_rete();
         });
          $('#porc_rete_f').change(function(){
             calculos_rete();
         });
         $('#porc_rica_f').change(function(){
             calculos_rete();
         });
         $('#porc_riva').change(function(){
             calculos_rete();
         });
         $('#porc_re_garan').change(function(){
             calculos_rete();
         });
     //fin
     $('#anticipo').change(function(){
             var valor = $("#valor").val(); 
             var antici = $("#anticipo").val(); 
             if(parseInt(antici) > parseInt(valor)){
                sweetAlert('el anticipo supera al valor del contrato');
                $("#anticipo").val('').focus();    
                return false;  
             }     
             var total = valor-antici;
              $("#saldo").val(total);
     });
     //subir archivos de documentos
      $('#subida').submit(function(){
                        var iddoc = $("#consecutivo").val(); 
                        var idcon = $("#idcontra").val();
                        var tipo = $("#tipo_doc").val();
                        var suge = $("#sugeren").val();
                        var arch = $("#archivo").val();
                        var reg = $("#regis_arc").val();
                        var fec = $("#fecha_doc").val();
                        var formulario = $('#subida');	
			var datos = formulario.serialize();		
			var archivos = new FormData();			
			var url = 'subir_documentos.php';		
			for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 			
               	        archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));		 
      		 	}	
			$.ajax({			
				url: url+'?'+datos,			
				type: 'POST',			
				contentType: false, 			
            	                data: archivos,			
               	                processData:false,
                                beforeSend : function (){
                                    $('#imagenes').html('<img width="100px" src="../../images/loading.gif">');
                                },
				success: function(data){
                                        $('#archivo').focus();
                                        $('#imagenes').html('<font color="green">Se cargo con exito '+data+'</font>').show(200).delay(2500).hide(200);
                                        
                                        mostrar_documentos();
					$('#archivo')[0].reset();
                                        $('#consecutivo').val(data);
					return false;
				}
			});
			return false;
		
	});
});
function ver_doc_n(id){
    window.open("lista_documento_ver.php?archivo="+id,"visualiza","width=800px,height=600px");  
}
function calculos_rete(){
    var valor = $("#val_t_fac").val(); //valor contrato
    
    var rfue = $("#porc_rete_f").val(); //porcentajes
    var rica = $("#porc_rica_f").val(); //porcentajes
    var riva = $("#porc_riva").val(); //porcentajes
    var rgar = $("#porc_re_garan").val(); //porcentajes
    //calculo retefuente
        var trfue = valor * (rfue / 100);
        $("#rete_fact").val(trfue);
    //fin calculo retefuente
    //calculo rete ica
        var trica = valor * (rica / 100);
        $("#rete_ica_f").val(trica);
    //fin calculo
    //calculo rete iva
        var triva = valor * (riva / 100);
        $("#rete_iva_f").val(triva);
    //fin calculo
    //calculo retegarantia
       var trgar = valor * (rgar / 100);
       $("#valor_reteg_f").val(trgar);
    //fin calculo
   
}
function desplegar(cot){
  
    $.ajax({
            type: 'GET',
            data: 'cot='+cot,
            url: 'lista_items.php',
            success: function(resultado){
                 $("#mostrar_resumen").html(resultado);
            }
           }); 
}
function mostrar_pendientes(page){
     var nombre= $("#nombre").val();
  
        $.ajax({
            type: 'GET',
            data: 'nomb='+nombre+'&page='+page,
            url: '../vistas/pendientes/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}
//function para mostrar tabla de docuemntos PARAMETROS PARA DOCUENTOS
function mostrar_documentos(){
     var doc = $("#radicado_doc").val();
  
        $.ajax({
            type: 'GET',
            data: 'id='+doc,
            url: 'lista_documento.php',
            success: function(resultado){
                 $("#mostrar_documentos").html(resultado);
            }
           }); 
}
function mostrar_cotizaciones_cont(){
    var id = $("#radicado_doc").val();
        $.ajax({
            type: 'GET',
            data: 'id='+id,
            url: 'lista_cotizaciones.php',
            success: function(resultado){
                 $("#mostrar_cotizacion").html(resultado);
            }
           }); 
}
function borrar_doc(id){
    var c = confirm("Esta seguro de eliminar este documento?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=6',  //
            url: 'acciones.php', 
            success: function(){
                sweetAlert("Se ha eliminado con exito");
                mostrar_documentos();
            }
           });
       }
}
function editar_doc(id){
    $("#Modaldoc").modal("show"); 
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=7',  //
            url: 'acciones.php', 
            success: function(datos){
                var p = eval(datos);
                var iddoc = $("#consecutivo").val(p[0]); 
                var idcon = $("#idcontra").val(p[1]);
                var tipo = $("#tipo_doc").val(p[2]);
                var suge = $("#sugeren").val(p[3]);
                var reg = $("#regis_arc").val(p[5]);
                var fec = $("#fecha_doc").val(p[4]);

            }
           });
}
function agregar_cot(){
 var cot = $("#cot").val(); 
 var ver = $("#ver").val(); 
 var rad = $("#radicado_doc").val(); 
 var con = confirm("Esta seguro de agregar esta cotizacion al contrato");
 if(con){
    $.ajax({
            type: 'GET',
            data: 'cot='+cot+'&ver='+ver+'&rad='+rad+'&sw=14',  //
            url: 'acciones.php', 
            success: function(datos){
                sweetAlert(datos);
                mostrar_cotizaciones_cont();
                $("#btn_guardar_cot").attr("disabled",false );
            }
           });
       }
}


function nuevo(){
    $("#FormularioProducto").modal("show");
    limpiar_pen();
}
function guardar_pendientes(){ 
     var id_pen = $("#id_inf").val(); 
     var num_cont=$("#n_cot").val();
     var numcot = $("#nume_cot").val();
     var versi = $("#version").val();
     var pedid = $("#pedido").val();
     var id_cliente = $("#cliente").val();
     var nombre = $("#nombre_cliente").val();
     var obra = $("#nom_o").val();
     var obj = $("#objeto").val();
     var vended= $("#vende").val();
     var cordin = $("#cor_o").val();
     var supervi = $("#supervi").val();
     var insta = $("#instal").val();
     var valor = $("#valor").val();
     var antici = $("#anticipo").val();
     var saldo = $("#saldo").val();
     var forma = $("#for_pag").val();
     var otro = $("#otros").val();
     var firma = $("#recibe").val();
     var fpago = $("#fpago").val();
     var observa = $("#obser").val();
     var est = $("#estado_c").val();
     var reg_por = $("#registrado").val();
     var regis_fecha = $("#fe_registro").val();
     var limi_p = $("#limit_pago").val();


     if(num_cont===''){
        sweetAlert("numero de contrato!");
        $("#n_cot").focus();
        return false;
    }
    if(numcot===''){
        sweetAlert("numero de cotizacion");
        $("#nume_cot").focus();
        return false;
    }
     if(versi===''){
        sweetAlert("version");
        $("#version").focus();
        return false;
     }
      if(obra===''){
        sweetAlert("nombre de la obra");
        $("#nom_o").focus();
        return false;
    }
    if(obj===''){
        sweetAlert("objeto de la obra");
        $("#objeto").focus();
        return false;
    }

       if(valor===''){
        sweetAlert("ingrese valor de contrato");
        $("#valor").focus();
        return false;
    }
     if(antici===''){
        sweetAlert("ingrese valor de anticipo");
        $("#anticipo").focus();
        return false;
    }
      if(est===''){
      sweetAlert("escoja el estado");
      $("#estado_c").focus();
      return false;
   }
    
      if(forma===''){
        sweetAlert("forma de pago");
        $("#for_pag").focus();
        return false;
    }

      if(firma===''){
        sweetAlert("firma?");
        $("#recibe").focus();
        return false;
    }
    if(fpago===''){
        sweetAlert("digite fecha de pago");
        $("#fpago").focus();
        return false;
    }

      if(limi_p===''){
        sweetAlert("ingresar limite de pago!");
        $("#limit_pago").focus();
        return false;
    }
   
        $.ajax({
            type: 'GET',
            data: 'id_pend='+id_pen+'&numero_cont='+num_cont+'&cotiz='+numcot+'&versio='+versi+'&pedido='+pedid+'&id_cli='+id_cliente+'&nomcliente='+nombre+'&nomobra='+obra+
                  '&objeto='+obj+ '&vendedor='+vended+'&cordina='+cordin+'&superv='+supervi+'&intalacion='+insta+'&valor='+valor+'&anticip='+antici+'&est_c='+est+'&sald='+saldo+'&forpago='+forma+'&otros='+otro+'&firm='+firma+'&fechap='+fpago+'&observaci='+observa+'&por='+reg_por+'&fechareg='+regis_fecha+'&pago_limi='+limi_p+'&sw=1',
            url: '../vistas/pendientes/acciones.php', 
            success: function(resultado){
                $("#id_inf").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_pendientes(1);
            }
           });
}
function limpiar_pen(){
 var user_gen = $("#user_general").val();
 var fecha_gen = $("#fecha_general").val();
   $("#id_inf").val('');
   $("#nom_o").val('');
   $("#nombre_cliente").val('');
   $("#objeto").val('');
   $("#vende").val('');
   $("#cor_o").val('');
   $("#supervi").val('');
   $("#instal").val('');
   $("#nume_cot").val('');
   $("#valor").val('');
   $("#anticipo").val('');
   $("#saldo").val('');
   $("#for_pag").val(''); 
   $("#otros").val('');
   $("#recibe").val('');
   $("#pedido").val('');
   $("#version").val('');
   $("#fpago").val('');
   $("#obser").val('');
   $("#estado_c").val('');
   $("#cliente").val('');
   $("#n_cot").val('');
   $("#limit_pago").val('');
  
   $("#registrado").val(user_gen);
   $("#fe_registro").val(fecha_gen);
}
function editar_pendientes(id){
    $("#FormularioProducto").modal("show");
     $.ajax({
            type: 'GET',
            data: 'id_inf='+id+'&sw=2',  //
            url: '../vistas/pendientes/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
   $("#id_inf").val(t[0]);
   $("#nom_o").val(t[1]);
   $("#nombre_cliente").val(t[2]);
   $("#objeto").val(t[3]);
   $("#vende").val(t[4]);
   $("#cor_o").val(t[5]);
   $("#supervi").val(t[6]);
   $("#instal").val(t[7]);
   $("#nume_cot").val(t[8]);
   $("#valor").val(t[9]);
   $("#anticipo").val(t[10]);
   $("#saldo").val(t[11]);
   $("#for_pag").val(t[12]); 
   $("#otros").val(t[13]);
   $("#recibe").val(t[14]);
   $("#pedido").val(t[15]);
   $("#version").val(t[16]);
   $("#fpago").val(t[17]);
   $("#obser").val(t[18]);
   $("#estado_c").val(t[19]);
   $("#cliente").val(t[20]);
   $("#n_cot").val(t[21]);
   $("#registrado").val(t[22]);
   $("#fe_registro").val(t[23]);
   $("#limit_pago").val(t[24]);
   
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
                sweetAlert("Se ha eliminado con exito");
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
    var emailc = $("#mail_contac").val();
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (caract.test(emailc) == false){
        sweetAlert("digite un correo valido");
        $("#mail_contac").val('').focus();
        return false;
    }else{
        return true;
    }
} 
function buscar_cliente(){
    window.open("../ventanas/clientes/index.php" , "CLIENTES", " width= 600 , height=500 ");
}
function buscar_contacto(id){
    window.open("../../ventanas/contactos/index.php?id="+id , "CLIENTES", " width= 600 , height=500 ");
}
function imprimir(cot){
    var col = prompt("Digite la cantidad de filas a imprimir ");
    if(col){
        var c = col;
    }else{
        var c = 7;
    }
    window.open("/cotizacion/vistas/print.php?cot="+cot+"&c=&total_item=20&col="+c+"&ciudad=Barranquilla" , "CLIENTES", " width= 600 , height=500 ");
}
 function obtener_cliente(id, nombre){
    $("#cliente").val(id);
    $("#nombre_cliente").val(nombre);
}
 function obtener_contacto(id, nombre){
    $("#contacto_lla").val(id);
    $("#nombre_contacto_lla").val(nombre);
}

function buscar_usuario(){
    window.open("../ventanas/usuarios/index.php" , "USUARIOS", " width= 600 , height=500 ");
}
function buscar_usuario_ag(){
    window.open("../../ventanas/usuarios/index.php" , "USUARIOS", " width= 600 , height=500 ");
}
 function obtener_usuario(nombre){
    $("#vende").val(nombre);
    $("#asig_nueva").val(nombre);
}

function buscar_cotizaciones(){
    window.open("../ventanas/cotizaciones/index.php" , "COTIZACION", " width= 600 , height=500 ");
}
 function obtener_variables(num_cot,version,id_tercero,nom_tercero,nombre_obra,vendedor,costo){
     
    $("#nume_cot").val(num_cot);
    $("#version").val(version);
    $("#cliente").val(id_tercero);
    $("#nombre_cliente").val(nom_tercero);
    $("#nom_o").val(nombre_obra);
    $("#vende").val(vendedor);
    $("#valor").val(costo);
  
}

function formdoc(){
    $("#Modaldoc").modal("show"); 
}
function formcotizacion(){
    $("#ModalCotizacion").modal("show"); 
}



//FUNCIONES DE LOS CONTACTOS
function formcontac(){
    $("#Modalcont").modal("show"); 
    limpiar_loscont();
}
function mostrar_loscontactos(){
     var contac = $("#la_Relacion").val();
  
        $.ajax({
            type: 'GET',
            data: 'id='+contac,
            url: 'lista_nuecontac.php',
            success: function(resultado){
                 $("#mostrar_loscontactos").html(resultado);
            }
           }); 
}

function guardar_contacto(){ 
                var id_conse = $("#consecu_contacto").val(); 
                var namecon= $("#nom_contact").val();
                var tl_co = $("#tel_contact").val();
                var mail_con= $("#mail_contac").val();
                var carg_con = $("#cargo_contact").val();
                var sug_con = $("#sug_contact").val();
                var por_cont = $("#regis_contac").val();
                var fec_cont= $("#fecha_reg_contac").val();
                var se_relaci= $("#la_Relacion").val();

     if(namecon===''){
        sweetAlert("nombre!");
        $("#nom_contact").focus();
        return false;
    }
    if(tl_co===''){
        sweetAlert("telefono");
        $("#tel_contact").focus();
        return false;
    }
     if(mail_con===''){
        sweetAlert("email");
        $("#mail_contac").focus();
        return false;
     }
      if(carg_con===''){
        sweetAlert("numero de pedido");
        $("#cargo_contact").focus();
        return false;
     }
 
        $.ajax({
            type: 'GET',
            data: 'id_nuevocont='+id_conse+'&nom_nuevocon='+namecon+'&tel_nuevocont='+tl_co+'&emai_nuevocont='+mail_con+'&carg_nuevocont='+carg_con+'&suge_nuevocon='+sug_con+'&guardo_nuevo='+por_cont+'&fech_nuevocont='+fec_cont+
                  '&cruse_relaci='+se_relaci+'&sw=10',
            url: 'acciones.php', 
            success: function(resultado){
                $("#consecu_contacto").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_loscontactos(1);
            }
           });
}

function borrar_loscontactos(id){
    var p = confirm("Esta seguro de eliminar este contacto?");
     if(p){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=8',  //
            url: 'acciones.php', 
            success: function(){
                sweetAlert("Se ha eliminado con exito");
                mostrar_loscontactos();
            }
           });
       }
}

function editar_loscontactos(id){
    $("#Modalcont").modal("show"); 
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=9',  //
            url: 'acciones.php', 
            success: function(datos){
                var p = eval(datos);
                var id_consecont = $("#consecu_contacto").val(p[0]); 
                var nameconta= $("#nom_contact").val(p[1]);
                var tl_contac = $("#tel_contact").val(p[2]);
                var mail_contac= $("#mail_contac").val(p[3]);
                var carg_contac = $("#cargo_contact").val(p[4]);
                var sug_cont = $("#sug_contact").val(p[5]);
                var por_contac = $("#regis_contac").val(p[6]);
                var fec_conta= $("#fecha_reg_contac").val(p[7]);
                //var su_relacion= $("#la_Relacion").val(p[8]);

            }
           });
}

function limpiar_loscont(){
                $("#consecu_contacto").val(''); 
                $("#nom_contact").val('');
                $("#tel_contact").val('');
                $("#mail_contac").val('');
                $("#cargo_contact").val('');
                $("#sug_contact").val('');


} 
//FIN DEL MODULO DE contactos


// MODULO DE ACTIVIDADES
 function formllamada(){
    $("#FormularioAgenda").modal("show");
    limpiar_nuacti(); 
 }
function guardar_actividad(){ 
                var id_n = $("#id_a_nuevo").val(); 
                var mot= $("#motivo_nue").val();
                var fec = $("#fec_ini_nueva").val();
                var hor= $("#hra_nueva").val();
                var use = $("#asig_nueva").val();
                var ala = $("#alarma_nueva").val();
                var des = $("#descrip_nueva").val();
                var tip= $("#tip_llamada_nue").val();
                var est= $("#est_llamada_nu").val();
                var idco= $("#contacto_lla").val();
                var con= $("#nombre_contacto_lla").val();
                var rel= $("#relacion_con").val();
                var obra = $("#radicado_doc").val();
     if(mot===''){
        sweetAlert("Digite el asunto!");
        $("#motivo_nue").focus();
        return false;
    }
    if(fec===''){
        sweetAlert("Seleccione la fecha");
        $("#fec_ini_nueva").focus();
        return false;
     }
      if(hor===''){
        sweetAlert("Seleccione la hora");
        $("#hra_nueva").focus();
        return false;
     }
    if(use===''){
        sweetAlert("Seleccione el usuario");
        $("#asig_nueva").focus();
        return false;
    }
      if(des===''){
        sweetAlert("Digite alguna Descripcion");
        $("#descrip_nueva").focus();
        return false;
    }
       if(tip===''){
        sweetAlert("Digite tipo de llamada");
        $("#tip_llamada_nue").focus();
        return false;
    }
       if(est===''){
        sweetAlert("Digite estado de la llamada");
        $("#est_llamada_nu").focus();
        return false;
    }
    if(idco===''){
        sweetAlert("Seleccione el contacto");
        $("#nombre_contacto_lla").focus();
        return false;
    }
     $("#bac_guardar").attr("disabled", true );
        $.ajax({
            type: 'GET',
            data: 'id_lla='+id_n+'&asunto='+mot+'&fecha='+fec+'&hora='+hor+'&asi='+use+'&aviso='+ala+'&desc='+des+'&llamada='+tip+
                  '&est_lla='+est+'&id_con='+idco+'&nom_con='+con+'&rel='+rel+'&obra='+obra+'&sw=11',
            url: 'acciones.php', 
            success: function(resultado){
                $("#id_a_nuevo").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_llamadas();
                $("#bac_guardar").attr("disabled", false );
            }
           });
}

function mostrar_llamadas(){
     var nue_rel = $("#radicado_doc").val();
        $.ajax({
            type: 'GET',
            data: '&radicado='+nue_rel,
            url: 'lista_nuevacti.php',
            success: function(resultado){
                 $("#mostrar_llamadas").html(resultado);
            }
           }); 
}
function editar_act_nue(id){
    $("#FormularioAgenda").modal("show"); 
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=13',  //
            url: 'acciones.php', 
            success: function(datos){
                var p= eval(datos);
                var id_nue_a = $("#id_a_nuevo").val(p[0]); 
                var moti_nue= $("#motivo_nue").val(p[1]);
                var des_nu= $("#descrip_nueva").val(p[2]);
                var fech_nue = $("#fec_ini_nueva").val(p[3]);
                var est_nue = $("#est_llamada_nu").val(p[4]);
                var tipo_nuev = $("#tip_llamada_nue").val(p[5]);
                var cont_nuevo = $("#contacto_lla").val(p[6]);
                var nom_nuevact = $("#nombre_contacto_lla").val(p[7]);
                var hor_nuev= $("#hra_nueva").val(p[8]);
                var alarnuev= $("#alarma_nueva").val(p[9]);
 }
           });
}

function borrar_las_acti(id){
    var p = confirm("Esta seguro de eliminar este contacto?");
     if(p){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=12',  //
            url: 'acciones.php', 
            success: function(){
                sweetAlert("Se ha eliminado con exito");
                mostrar_llamadas();
            }
           });
       }
}
function limpiar_nuacti(){
                 $("#id_a_nuevo").val(''); 
                 $("#motivo_nue").val('');
                 $("#fec_ini_nueva").val('');
                 $("#hra_nueva").val('');
//                 $("#asig_nueva").val('');
//                 $("#alarma_nueva").val('');
                 $("#descrip_nueva").val('');
                 $("#tip_llamada_nue").val('Saliente');
                 $("#est_llamada_nu").val('');
                 $("#contacto_lla").val('');
                 $("#nombre_contacto_lla").val('');
//                 $("#relacion_con").val('');
                 //$("#radicado_doc").val('');

}    //FIN DE ACTIVIDAD 

//INICIO FACTURAS PENDIENTES POR COBRAR
 function formpendnue(){
    $("#Modalpendnue").modal("show");
    limpiar_nuefact();
 }
function guardar_nueva_factura(){ 
                var conse_fact = $("#conse_nuevafact").val(); 
                var fpls= $("#fomplus_n").val();
                var num_pe_fa= $("#pedi_fact").val();
                var re_fact = $("#remi_fact").val();
                var total_fact= $("#val_t_fac").val();
                var ret_fact = $("#rete_fact").val();
                var ica_rete = $("#rete_ica_f").val();
                var iva_rete = $("#rete_iva_f").val();
                var cat_despa= $("#cant_desp").val();
                var rete_valor= $("#valor_reteg_F").val();
                var otro_des_f = $("#otros_Des_f").val();
                var fac_suge= $("#obser_nuefac").val();
                var nue_esta= $("#est_nuev_f").val();
                var pago_dias= $("#dia_pag").val();
                var nue_fact_re= $("#reg_nue_fac").val();
                var nue_fac_fe= $("#fech_nuev_fac").val();
                var contra_f= $("#radicado_doc").val();
                var terc_id= $("#id_tercero_f").val();
                var retporc= $("#porc_rete_f").val();
                var ricaporc= $("#porc_rica_f").val();
                var rivaporc= $("#porc_riva").val();
                var regarporc= $("#porc_re_garan").val();  

     if(num_pe_fa===''){
        sweetAlert("numero pedido!");
        $("#pedi_fact").focus();
        return false;
    }
    if(re_fact===''){
        sweetAlert("remision");
        $("#remi_fact").focus();
        return false;
    }
     if(total_fact===''){
        sweetAlert("valor");
        $("#val_t_fac").focus();
        return false;
     }
      if(ret_fact===''){
        sweetAlert("retefuente");
        $("#rete_fact").focus();
        return false;
     }
 
      if(ica_rete===''){
        sweetAlert("rete ica");
        $("#rete_ica_f").focus();
        return false;
    }
    
      if(iva_rete===''){
        sweetAlert("rete iva");
        $("#rete_iva_f").focus();
        return false;
    }
      if(cat_despa===''){
        sweetAlert("cantidad despachada");
        $("#cant_desp").focus();
        return false;
    }
      if(rete_valor===''){
        sweetAlert("retegarantia");
        $("#valor_reteg_F").focus();
        return false;
    }
      if(otro_des_f===''){
        sweetAlert("otros descuentos");
        $("#otros_Des_f").focus();
        return false;
    }
      if(nue_esta===''){
        sweetAlert("estado");
        $("#est_nuev_f").focus();
        return false;
    }
     if(pago_dias===''){
        sweetAlert("dia de pago");
        $("#dia_pag").focus();
        return false;
    }
    if(retporc===''){
        sweetAlert("porcentaje retefuente digite 0 si no aplica");
        $("#porc_rete_f").focus();
        return false;
    }
    if(ricaporc===''){
        sweetAlert("reteICA digite 0 si no aplica");
        $("#porc_rica_f").focus();
        return false;
    }
     if(rivaporc===''){
        sweetAlert("reteIVA digite 0 si no aplica");
        $("#porc_riva").focus();
        return false;
     }
      if(regarporc===''){
        sweetAlert("retegarantia digite 0 si no aplica");
        $("#porc_re_garan").focus();
        return false;
     }   
     $("#nuefact_guardar").attr("disabled",true );
        $.ajax({
            type: 'GET',
            data: 'rad_ped_f='+conse_fact+'&num_fpls='+fpls+'&num_pedifac='+num_pe_fa+'&remi_factura='+re_fact+'&fact_total='+total_fact+'&rete_factu='+ret_fact+'&rete_icafac='+ica_rete+'&rete_ivafact='+iva_rete+'&cant_desfsact='+cat_despa+
                  '&rete_valorfact='+rete_valor+'&otro_desfact='+otro_des_f+'&sug_nuefact='+fac_suge+'&est_nuefact='+nue_esta+'&dias_hasta='+pago_dias+'&re_nuefact='+nue_fact_re+'&fecha_nuefact='+nue_fac_fe+
                  '&contra='+contra_f+'&tercer='+terc_id+'&porcenrete='+retporc+'&porcenrica='+ricaporc+'&porcenriva='+rivaporc+'&porcengaran='+regarporc+
                   '&sw=15',
            url: 'acciones.php', 
            success: function(resultado){
                $("#conse_nuevafact").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_nueva_fact(1);
                $("#nuefact_guardar").attr("disabled",false );
            }
           });
}
 function mostrar_nueva_fact(){
     var relac= $("#id_tercero_f").val();
     var saldo= $("#saldo_total").val();
        $.ajax({
            type: 'GET',
            data: 'id='+relac+'&saldo='+saldo,
            url: 'lista_nue_fatc.php',
            success: function(resultado){
                 $("#mostrar_nueva_fact").html(resultado);
                 mostrar_retegarantias();
            }
           }); 
}
 function mostrar_retegarantias(){
     var relac= $("#id_tercero_f").val();
        $.ajax({
            type: 'GET',
            data: 'id='+relac,
            url: 'lista_retegarantias.php',
            success: function(resultado){
                 $("#mostrar_retegarantias").html(resultado);
            }
           }); 
}

function editar_nuefact(id){
    $("#Modalpendnue").modal("show"); 
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=16',  //
            url: 'acciones.php', 
            success: function(datos){
                var p= eval(datos);
                $("#conse_nuevafact").val(p[0]); 
                $("#fomplus_n").val(p[1]);
                $("#pedi_fact").val(p[2]);
                $("#remi_fact").val(p[3]);
                $("#val_t_fac").val(p[4]);
                $("#rete_fact").val(p[5]);
                $("#rete_ica_f").val(p[6]);
                $("#rete_iva_f").val(p[7]);
                $("#cant_desp").val(p[8]);
                $("#valor_reteg_F").val(p[9]);
                $("#otros_Des_f").val(p[10]);
                $("#obser_nuefac").val(p[11]);
                $("#est_nuev_f").val(p[12]);
                $("#dia_pag").val(p[13]);
                $("#porc_rete_f").val(p[14]);
                $("#porc_rica_f").val(p[15]);
                $("#porc_riva").val(p[16]);
                $("#porc_re_garan").val(p[17]);
               
 }
           });
}

function limpiar_nuefact(id){
                $("#conse_nuevafact").val(''); 
                $("#fomplus_n").val('');
                $("#pedi_fact").val('');
                $("#remi_fact").val('');
                $("#val_t_fac").val('');
                $("#rete_fact").val('');
                $("#rete_ica_f").val('');
                $("#rete_iva_f").val('');
                $("#cant_desp").val('');
                $("#valor_reteg_F").val('');
                $("#otros_Des_f").val('');
                $("#obser_nuefac").val('');
                $("#est_nuev_f").val('');
                $("#dia_pag").val('');
                $("#porc_rete_f").val('');
                $("#porc_rica_f").val('');
                $("#porc_riva").val('');
                $("#porc_re_garan").val('');
               
 }



















