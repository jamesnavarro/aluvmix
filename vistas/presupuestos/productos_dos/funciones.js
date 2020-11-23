 $(function(){
     //$("#mostrar_tabla").html(mostrar_cotn(1)); 
              $('#subida').submit(function(){
		var sob = $('#idp').val();
		var comprobar = $('#foto').val().length;
		if(comprobar>0 && sob!==''){		
			var formulario = $('#subida');	
			var datos = formulario.serialize();		
			var archivos = new FormData();			
			var url = '../vistas/presupuestos/productos_dos/subir_foto.php';		
			for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 			
               	        archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));		 
      		 	}	
			$.ajax({			
				url: url+'?'+datos,			
				type: 'POST',			
				contentType: false, 			
            	                data: archivos,			
               	                processData:false,
				success: function(data){
                                    console.log(data);
                                        $('#foto').focus();
                                        if(data==='1'){
                                            $('#msg').html('<font color="green">Se cargo con exito</font>').show(200).delay(2500).hide(200);
                                        }else{
                                            $('#msg').html('<b>No se cargo correctamente</b>').show(200).delay(2500).hide(200);
                                        }
                                         pre_mostrar_detalle_productos(sob);
                                        //mostrar_imagen(sob);
					$('#subida')[0].reset();
                                        $('#idp').val(sob);
					return false;
				}
			});
			return false;
		}else{
			alert('Cargue la foto ó archivo y verifique que esta el numero de sobre este digitado');
			return false;
		}
	});
        
        $('#acc_cod').click(function(){
            window.open("../popup/productos_var/", "ProductosVar" ,"width=800  , height=500");
        });
        $('#frefe').click(function(){
            window.open("../popup/productos_var_1/", "ProductosVar" ,"width=800  , height=500");
        });
        $('#esp_cod').click(function(){
            window.open("../popup/productos_var_1/", "ProductosVar" ,"width=800  , height=500");
        });
        $('#alu_formula').change(function(){
            var formula = $("#alu_formula").val();
            if(formula=='Si'){
                 var perfil = $("#alu_perfil").attr("disabled", false);
                var ope1 = $("#operador1").attr("disabled", false);
                var cifra1 = $("#cifra1").attr("disabled", false);
                var cifra2 = $("#cifra2").attr("disabled", false);
                var ope2 = $("#operador2").attr("disabled", false);
                var fija = $("#medida_fija").attr("disabled", true).val('1');
            }else{
                var perfil = $("#alu_perfil").attr("disabled", true).val('');
                var ope1 = $("#operador1").attr("disabled", true).val('');
                var cifra1 = $("#cifra1").attr("disabled", true).val('');
                var cifra2 = $("#cifra2").attr("disabled", true).val('');
                var ope2 = $("#operador2").attr("disabled", true).val('');
                var fija = $("#medida_fija").attr("disabled", false);
            }
   
        });
        $('#piezas').change(function(){
            var formula = $(this).val();
            if(formula=='Si'){
               $("#cadav").attr("disabled", false);
               $("#cadah").attr("disabled", false);
               calcular_piezas();
            }else{
               $("#cadav").attr("disabled", true).val('0');
               $("#cadah").attr("disabled", true).val('0');
               calcular_piezas();
            }
        });
        $('#lado_per').change(function(){
            var formula = $("#alu_formula").val();
            var lado = $("#lado_per").val();
                var ancho = $("#anc_general").val();
                var alto = $("#alt_gener").val();
                var rej = $("#alt_rejilla").val();
                var ancfd = $("#ancho_cf_der").val();
                var ancfi = $("#ancho_cf_izq").val();
                var alcfd = $("#alto_cf_sup").val();
                var alcfi = $("#alto_cf_inf").val();
    
            if(formula=='Si'){
                $("#alu_perfil").val(lado);
            }
            $.ajax({
                type:'GET',
                data:'lado='+lado,
                url:'',
                success:function(vista){
                    
                }
            });
            
        });

     
        $('#cantidad_perfil').change(function(){
            var piezas = $("#piezas").val();
            if(piezas=='Si'){
               calcular_piezas();
            }else{
               calcular_piezas();
            }
            
        });
         $('#cuerpo_fij').change(function(){
              validar_cuerpo();
        });
        $('#linea').change(function(){
               validar_linea();
        });

        $('#vid_ref1').change(function(){
            var ref = $(this).val();
               pre_select_ref1_med(ref,1);
        });
         $('#vid_ref3').change(function(){
            var ref = $(this).val();
               pre_select_ref1_med(ref,2);
        });
        $('#rej_ref1').change(function(){
            var ref = $(this).val();
               pre_select_ref1_med(ref,3);
        });
         $('#rej_ref2').change(function(){
            var ref = $(this).val();
               pre_select_ref1_med(ref,4);
        });
        //alu_perfil
        $('#alu_perfil').change(function(){
            var ref = $(this).val();
               pre_select_ref1_med(ref,5);
        });
        $('#acc_conf').change(function(){
            var ref = $(this).val();
            if(ref=='Dinamico'){
                $("#acc_mod").attr("disabled", false);
            }else{
              $("#acc_mod").attr("disabled", true);
            }
        });
        $('#acc_dis').change(function(){
            var ref = $(this).val();
            if(ref=='Si'){
                $("#acc_cada").attr("disabled", false);
            }else{
                $("#acc_cada").val('0').attr("disabled", true);
            }
        });
       
});
function validar_cuerpo(){
    var cuerpo = $("#cuerpo_fij").val();
            if(cuerpo=='Si'){
                   $("#ancho_cf_der").attr("disabled", false);
                   $("#ancho_cf_izq").attr("disabled", false);
                   $("#alto_cf_sup").attr("disabled", false);
                   $("#alto_cf_inf").attr("disabled", false);
            }else{
                   $("#ancho_cf_der").attr("disabled", true).val('0');
                   $("#ancho_cf_izq").attr("disabled", true).val('0');
                   $("#alto_cf_sup").attr("disabled", true).val('0');
                   $("#alto_cf_inf").attr("disabled", true).val('0');
            }
}
function validar_linea(){
        var linea = $("#linea").val();
            if(linea=='Vidrio'){
                    //$("#sistema").attr("disabled", true); 
                    $("#tipo").attr("disabled", true).val('N/A');
                    $("#hojas").attr("disabled", true).val('1');
                    $("#alt_rejilla").attr("disabled", true).val('0');
                    $("#configuracion").attr("disabled", true).val('VIDRIO');
                    $("#tipo_vid").attr("disabled", true).val('');
                    $("#espesor_vid").attr("disabled", true).val('0');
                    $("#tipo_riel").attr("disabled", true);
                    $("#tipo_alfa").attr("disabled", true);
                    $("#tipo_rejilla").attr("disabled", true);
                    $("#tipo_cie").attr("disabled", true);
                     $("#tipo_rod").attr("disabled", true);
                    $("#cuerpo_fij").attr("disabled", true).val('No');
                    $("#per").attr("disabled", false);
                    $("#boq").attr("disabled", false);
                    $("#lam").attr("disabled", false);
                     $("#espaciadores").attr("disabled", false);
                     $("#interlayer").attr("disabled", false);
                     $("#ancho_cf_der").attr("disabled", true);
                     $("#ancho_cf_izq").attr("disabled", true);
                     $("#alto_cf_sup").attr("disabled", true);
                     $("#alto_cf_inf").attr("disabled", true);
            }else if(linea=='Aluminio'){
                   $("#sistema").attr("disabled", false); 
                    $("#tipo").attr("disabled", false).val();
                    $("#hojas").attr("disabled", false).val();
                    $("#alt_rejilla").attr("disabled", false);
                    $("#configuracion").attr("disabled", false);
                    $("#tipo_vid").attr("disabled", false);
                    $("#espesor_vid").attr("disabled", false);
                    $("#tipo_riel").attr("disabled", false);
                    $("#tipo_alfa").attr("disabled", false);
                    $("#tipo_rejilla").attr("disabled", false);
                    $("#tipo_cie").attr("disabled", false);
                    $("#tipo_rod").attr("disabled", false);
                    $("#cuerpo_fij").attr("disabled", false);
                    $("#per").attr("disabled", true).val('No');
                    $("#boq").attr("disabled", true).val('No');
                    $("#lam").attr("disabled", true).val('1');;
                     $("#espaciadores").attr("disabled", true).val('No');
                     $("#interlayer").attr("disabled", true).val('No');
                     $("#ancho_cf_der").attr("disabled", false);
                     $("#ancho_cf_izq").attr("disabled", false);
                     $("#alto_cf_sup").attr("disabled", false);
                     $("#alto_cf_inf").attr("disabled", false);
            }else{
                      $("#sistema").attr("disabled", false); 
                    $("#tipo").attr("disabled", false).val();
                    $("#hojas").attr("disabled", false).val();
                    $("#alt_rejilla").attr("disabled", false);
                    $("#configuracion").attr("disabled", false);
                    $("#tipo_vid").attr("disabled", false);
                    $("#espesor_vid").attr("disabled", false);
                    $("#tipo_riel").attr("disabled", false);
                    $("#tipo_alfa").attr("disabled", false);
                    $("#tipo_rejilla").attr("disabled", false);
                    $("#tipo_cie").attr("disabled", false);
                    $("#cuerpo_fij").attr("disabled", false);
                    $("#per").attr("disabled", true);
                    $("#boq").attr("disabled", true);
                    $("#lam").attr("disabled", true);
                     $("#espaciadores").attr("disabled", true);
                     $("#interlayer").attr("disabled", true);
                     $("#ancho_cf_der").attr("disabled", false);
                     $("#ancho_cf_izq").attr("disabled", false);
                     $("#alto_cf_sup").attr("disabled", false);
                     $("#alto_cf_inf").attr("disabled", false);
            }
}
function mostrar_cotn(page){
    
        $.ajax({
            type: 'GET',
            data: 'page='+page,
            url: '../vistas/crear_cot/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function pre_addsel(){
    var cod= $("#codigo").val();
    var tipo= $("#ftipo").val();
    var ref= $("#frefe").val();
    var can= $("#fcant").val();
    var und= $("#funid").val();
    if(cod=='' || tipo=='' || ref=='' || can=='' || und==''){
        alert("Debes de llenar todos los parametros");
        return false;
    }
         $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&tipo='+tipo+'&ref='+ref+'&can='+can+'&und='+und+'&sw=13',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                console.log(resultado);
                alert(resultado);
                pre_parametros1(cod);
                $("#fdesc").val('');
                $("#ftipo").val('');
                $("#frefe").val('');
                $("#fcant").val('');
                $("#funid").val('');
            }
  });
}
function pre_delparametro(id){
     var cod= $("#codigo").val();
     var c = confirm("Esta seguro de eliminar este items?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'cod='+id+'&sw=15',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                console.log(resultado);
                alert('SE ELIMINO CON EXITO');
                pre_parametros1(cod);
            }
  });
     }
}
function enviar_referencia(ref,desc){
    $("#alu_ref").val(ref);
    $("#alu_des").val(desc);
}
function pre_pasarparametro(tipo,ref,des,can,und){
    $("#fdesc").val(des);
    $("#ftipo").val(tipo);
    $("#frefe").val(ref);
    $("#fcant").val(can);
    $("#funid").val(und);
}
function pasar_accsel(cod,nom){
    $("#frefe").val(cod);
    $("#fdesc").val(nom);
     $("#fcant").focus();
     $("#esp_cod").val(cod);
     $("#esp_des").val(nom);
}
function guardar_producto(){ 
     var idp= $("#id_pro").val();
     var codigo= $("#codigo").val();
     var linea= $("#linea").val();
     var referencia= $("#referencia").val();
     var siste = $("#sistema").val(); 
     var ancho= $("#anc_general").val();
     var archi = $("#foto").val();
     var tipos = $("#tipo").val();
     var alto = $("#alt_gener").val();
     var hojas = $("#hojas").val();
     var alrejilla = $("#alt_rejilla").val();
     var refer = $("#referencia").val();
     var confi = $("#configuracion").val();

     var cant = $("#cantidad").val();
     var tipvid = $("#tipo_vid").val();
     var espsorvi = $("#espesor_vid").val();
     var tipriel = $("#tipo_riel").is(":checked");

     var alfa = $("#tipo_alfa").is(":checked");

     var anmax = $("#ancho_max").val();
     var descri = $("#descripcion").val();

     var tipreji = $("#tipo_rejilla").is(":checked");

     var almax = $("#alto_max").val();
     
     var tipcie = $("#tipo_cie").is(":checked");

     var tiprod = $("#tipo_rod").is(":checked");

     var cuerf = $("#cuerpo_fij").val();
     var per = $("#per").val();
     var boq = $("#boq").val();
     var lam = $("#lam").val();
     var esp = $("#espaciadores").val();
     var inter = $("#interlayer").val();
     var ancfd = $("#ancho_cf_der").val();
     var ancfi = $("#ancho_cf_izq").val();
     var alcfs = $("#alto_cf_sup").val();
     var alcfi = $("#alto_cf_inf").val();
     var obs = $("#obser").val();
     
     var can_cie = $("#can_cie").val();
     var can_rod = $("#can_rod").val();
     var can_bra = $("#can_bra").val();

     
     var tipbra = $("#tipo_bra").is(":checked");
     var tipbis = $("#tipo_bis").is(":checked");
     
     console.log('cierre: '+tipcie);
     
    if(siste===''){
        sweetAlert("Seleccione el sistema");
        $("#sistema").focus();
        return false;
    }
      if(ancho===''){
        sweetAlert("Digite el ancho del producto");
        $("#anc_general").focus();
        return false;
    }
//      if(archi===''){
//        sweetAlert("Adicione la imagen");
//        $("#archivo").focus();
//        return false;
//    }
      if(tipos===''){
        sweetAlert("Seleccione el tipo");
        $("#tipo").focus();
        return false;
    }
      if(alto===''){
        sweetAlert("Digite el alto del producto");
        $("#alt_gener").focus();
        return false;
    }
     if(linea===''){
        sweetAlert("Seleccione la linea del producto");
        $("#linea").focus();
        return false;
    }
     if(alrejilla===''){
        sweetAlert("Dijite el alto de la rejilla");
        $("#alt_rejilla").focus();
        return false;
    }

      if(confi===''){
        sweetAlert("Seleccione la configuiracion de las hojas");
        $("#configuracion").focus();
        return false;
    }
      if(hojas===''){
        sweetAlert("Digite la cantidad de hojas");
        $("#confi_text").focus();
        return false;
    }
        if(cant===''){
        sweetAlert("codigo del producto");
        $("#cantidad").focus();
        return false;
    }

        if(espsorvi===''){
        sweetAlert("Seleccione el espesor del vidrio para este producto");
        $("#espesor_vid").focus();
        return false;
    }
        if(tipriel===''){
        sweetAlert("Seleccione el parametro de riel");
        $("#tipo_riel").focus();
        return false;
    }
         if(alfa===''){
        sweetAlert("Selecione el parametro de alfajia");
        $("#tipo_alfa").focus();
        return false;
    }
         if(anmax===''){
        sweetAlert("Digite el ancho maximo");
        $("#ancho_max").focus();
        return false;
    }

          if(tipreji===''){
        sweetAlert("Seleccione el parametro de rejilla");
        $("#tipo_rejilla").focus();
        return false;
    }
          if(almax===''){
        sweetAlert("Digite la medida maxima ");
        $("#alto_max").focus();
        return false;
    }
    if(tipcie===''){
        sweetAlert("Seleccione el tipo de cierre");
        $("#tipo_cie").focus();
        return false;
    }
        $.ajax({
            type: 'GET',
            data: 'idp='+idp+'&obs='+obs+'&tipbis='+tipbis+'&tipbra='+tipbra+'&tiprod='+tiprod+'&siste='+siste+'&esp='+esp+'&inter='+inter+'&codigo='+codigo+'\
                 &referencia='+referencia+'&ancho='+ancho+'&archi='+archi+
                  '&tipos='+tipos+'&alto='+alto+'&linea='+linea+'\
                   &alrejilla='+alrejilla+
                  '&refer='+refer+'&confi='+confi+'&hojas='+hojas+
                  '&cant='+cant+'&tipvid='+tipvid+'&espsorvi='+espsorvi+
                  '&tipriel='+tipriel+'&alfa='+alfa+'&anmax='+anmax+
                  '&tipreji='+tipreji+'&almax='+almax+'&tipcie='+tipcie+
                  '&cuerf='+cuerf+'&descripcion='+descri+'&per='+per+'&boq='+boq+'&lam='+lam+'\
                  &ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&can_cie='+can_cie+'&can_rod='+can_rod+'&can_bra='+can_bra+'&alcfi='+alcfi+'&sw=1',
            url: '../vistas/presupuestos/productos_dos/acciones.php', 
            success: function(resultado){
                $("#id_pro").val(resultado); 
                $("#idp").val(resultado); 
                sweetAlert("Se guardo con exito" +resultado);
               $("#archivo").attr("disabled",false);
               $("#boton").attr("disabled",false);
               pre_mostrar_detalle_productos(codigo);
               
            }
           });
}
function guardar_perfil(){
        var id = $("#id_perfil").val();
        var ref = $("#alu_ref").val();
        var des= $("#alu_des").val();
        var des_opc= $("#alu_des_opc").val();
        var formula = $("#alu_formula").val();
        var lado = $("#lado_per").val();
        var perfil = $("#alu_perfil").val();
        var ope1 = $("#operador1").val();
        var cifra1 = $("#cifra1").val();
        var cifra2 = $("#cifra2").val();
        var ope2 = $("#operador2").val();
        var fija = $("#medida_fija").val();
        var codigo = $("#codigo").val();
        var cant = $("#cantidad_perfil").val();
        var piezas = $("#piezas").val();
        var cadav = $("#cadav").val();
        var cadah = $("#cadah").val();
        var alu_dim = $("#alu_dim").val();
        var alu_mod = $("#alu_mod").val();
        var alu_div = $("#alu_div").val();
        if(ref==''){
            alert("Debes de seleccionar el perfil");
            $("#alu_ref").focus();
            return false;
        }
        if(ref==''){
            alert("Debes de seleccionar el perfil");
            $("#alu_ref").focus();
            return false;
        }
        if(formula==''){
            alert("Campo requerido");
            $("#alu_formula").focus();
            return false;
        }
        if(lado==''){
            alert("Campo requerido");
            $("#lado_per").focus();
            return false;
        }
        if(alu_div==''){
            alert("Campo requerido");
            $("#alu_div").focus();
            return false;
        }
        $.ajax({
            type:'GET',
            data:'id='+id+'&alu_div='+alu_div+'&codigo='+codigo+'&alu_dim='+alu_dim+'&alu_mod='+alu_mod+'&cant='+cant+'&piezas='+piezas+'&cadav='+cadav+'&cadah='+cadah+'&ref='+ref+'&des='+des+'&des_opc='+des_opc+'&formula='+formula+'&lado='+lado+'&perfil='+perfil+'&ope1='+ope1+'&cifra1='+cifra1+'&cifra2='+cifra2+'&ope2='+ope2+'&fija='+fija+'&sw=19',
            url:'../vistas/presupuestos/productos_dos/acciones.php',
            success:function(res){
                var p = eval(res);
                alert(p[1]);
                $("#id_perfil").val(p[0]);
                pre_parametros_perfil(codigo);
                pre_parametros_rieles(codigo);
                pre_parametros_alfajia(codigo);
                limpiar_perfil();
            }
        });
}
function bloquear_formula(formula,piezas){
               if(formula=='Si'){
                 var perfil = $("#alu_perfil").attr("disabled", false);
                var ope1 = $("#operador1").attr("disabled", false);
                var cifra1 = $("#cifra1").attr("disabled", false);
                var cifra2 = $("#cifra2").attr("disabled", false);
                var ope2 = $("#operador2").attr("disabled", false);
                var fija = $("#medida_fija").attr("disabled", true).val('1');
            }else{
                var perfil = $("#alu_perfil").attr("disabled", true);
                var ope1 = $("#operador1").attr("disabled", true);
                var cifra1 = $("#cifra1").attr("disabled", true);
                var cifra2 = $("#cifra2").attr("disabled", true);
                var ope2 = $("#operador2").attr("disabled", true);
                var fija = $("#medida_fija").attr("disabled", false);
            }
            if(piezas=='Si'){
               $("#cadav").attr("disabled", false);
               $("#cadah").attr("disabled", false);
               calcular_piezas();
            }else{
               $("#cadav").attr("disabled", true).val('0');
               $("#cadah").attr("disabled", true).val('0');
               $("#canv").val('0');
               $("#canh").val('0');
            }
}
function del_perfil(id){
    var codigo = $("#codigo").val();
    var conf = confirm("Esta seguro de eliminar este item?");
    if(conf){
    $.ajax({
            type:'GET',
            data:'id='+id+'&codigo='+codigo+'&sw=21',
            url:'../vistas/presupuestos/productos_dos/acciones.php',
            success:function(res){
                alert(res);
                pre_recargar();
            }
        });
    }
}
function sel_perfil(id){
     $.ajax({
            type:'GET',
            data:'id='+id+'&sw=22',
            url:'../vistas/presupuestos/productos_dos/acciones.php',
            success:function(res){
                var p = eval(res);
                        $("#id_perfil").val(p[0]);
                        $("#alu_ref").val(p[2]);
                        $("#alu_des").val(p[3]);
                        $("#alu_formula").val(p[4]);
                        
                        $("#lado_per").val(p[5]);
                        $("#alu_perfil").val(p[6]);
                        $("#operador1").val(p[7]);
                        $("#cifra1").val(p[8]);
                        $("#cifra2").val(p[10]);
                        $("#operador2").val(p[9]);
                        $("#medida_fija").val(p[12]);
                        $("#cantidad_perfil").val(p[11]);
                        $("#piezas").val(p[13]);
                        if(p[13]=='Si'){
                            calcular_piezas();
                        }
                        $("#cadav").val(p[14]);
                        $("#cadah").val(p[15]);
                        $("#alu_des_opc").val(p[16]);
                        $("#alu_dim").val(p[17]);
                        $("#alu_mod").val(p[18]);
                        $("#alu_div").val(p[20]);
                        bloquear_formula(p[4],p[13]);
                        pre_select_ref1_med(p[6],5);
                        medidas_perfiles();
                        
            }
        });
}
function limpiar_perfil(){
    $("#id_perfil").val('');
    $("#alu_ref").val('');
    $("#alu_des").val('');
    $("#alu_formula").val('NO');
    $("#lado_per").val('');
    $("#alu_perfil").val('');
    $("#alu_dim").val('Fijo');
    $("#alu_mod").val('Principal');
    $("#operador1").val('');
    $("#cifra1").val('');
    $("#cifra2").val('');
    $("#operador2").val('');
    $("#medida_fija").val('');
    $("#cantidad_perfil").val('');
    $("#piezas").val('');
    $("#cadav").val('');
    $("#cadah").val('');
    $("#canh").val('');
     $("#canv").val('');
     $("#total_piezas").val('');
     $("#alu_des_opc").val('');
     $("#cifra0").val('');
}
function calcular_piezas(){
     var ancho = $("#anc_general").val();
     var alto = $("#alt_gener").val();
     
     var can1 = $("#cantidad_perfil").val();
     var cadav = $("#cadav").val();
     var cadah = $("#cadah").val();
     
     var ct1 = Math.ceil(ancho / cadah);
     var ct2 = Math.ceil(alto / cadav);
     $("#canh").val(ct1);
     $("#canv").val(ct2);
     console.log(ct1+' + '+ct2);
     var tt1 = ct1 * ct2;
     var tt =  tt1 * can1;
     
     $("#total_piezas").val(tt);
     $("#medida_fija").val();
}
function pre_BuscarReferencias(linea){
   window.open("presupuestos/popup/cuentas/?linea="+linea,"Referencias","width= 800px , height=600px");
}
function pre_BuscarReferenciasRej(linea){
   window.open("presupuestos/popup/referencias_rej/?linea="+linea,"Referencias","width= 800px , height=600px");
}
function limpiar_cotn(){
     var idp= $("#id_pro").val('');
     var codigo= $("#codigo").val('');
     var linea= $("#linea").val('');
     var referencia= $("#referencia").val('');
     var siste = $("#sistema").val(''); 
     var ancho= $("#anc_general").val('');
     var archi = $("#foto").val('');
     var tipos = $("#tipo").val('');
     var alto = $("#alt_gener").val('');
     var hojas = $("#hojas").val('');
     var alrejilla = $("#alt_rejilla").val('');
     var refer = $("#referencia").val('');
     var confi = $("#configuracion").val('');
     var cant = $("#cantidad").val('');
     var tipvid = $("#tipo_vid").val('');
     var espsorvi = $("#espesor_vid").val('');
     var tipriel = $("#tipo_riel").val('');
     var alfa = $("#tipo_alfa").val('');
     var anmax = $("#ancho_max").val('');
     var descri = $("#descripcion").val('');
     var tipreji = $("#tipo_rejilla").val('');
     var almax = $("#alto_max").val(''); 
     var tipcie = $("#tipo_cie").val('');
     var cuerf = $("#cuerpo_fij").val('');
     var per = $("#per").val('');
     var boq = $("#boq").val('');
     var lam = $("#lam").val('');
         var esp = $("#espaciadores").val('');
     var inter = $("#interlayer").val('');
     
}
function SaveRejillas(){
    var cod = $("#codigo").val();
    var idrefe = $("#idrefe").val();
    var rej_ref = $("#rej_ref").val();
    var rej_des = $("#rej_des").val();
    
    var rej_ref1 = $("#rej_ref1").val();
    
    var rej_ope1 = $("#rej_ope1").val();
    var rej_var1 = $("#rej_var1").val();
    var rej_ope2 = $("#rej_ope2").val();
    var rej_var2 = $("#rej_var2").val();
    
    var rej_ref2 = $("#rej_ref2").val();

    var rej_ope3 = $("#rej_ope3").val();
    var rej_var3 = $("#rej_var3").val();
    var rej_ope4 = $("#rej_ope4").val();
    var rej_var4 = $("#rej_var4").val();
    $.ajax({
            type: 'GET',
            data: 'idrefe='+idrefe+'&cod='+cod+'&rej_ref='+rej_ref+'&rej_des='+rej_des+'&rej_ref1='+rej_ref1+'&rej_ope1='+rej_ope1+'&rej_var1='+rej_var1+'\
    &rej_ope2='+rej_ope2+'&rej_var2='+rej_var2+'&rej_ref2='+rej_ref2+'&rej_ope3='+rej_ope3+'&rej_var3='+rej_var3+'\
    &rej_ope4='+rej_ope4+'&rej_var4='+rej_var4+'&sw=29',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                console.log(resultado);
                var p = eval(resultado);
                $("#idrefe").val(p[0]);
                alert(p[1]);
                pre_mostrar_rejilla(cod);
                limpiar_rejillas();
            }
           });
}
function limpiar_rejillas(){
    
    $("#idrefe").val('');
    $("#rej_ref").val('');
    $("#rej_des").val('');
    $("#rej_ref1").val('');
    $("#rej_ope1").val('');
    $("#rej_var1").val('');
    $("#rej_ope2").val('');
    $("#rej_var2").val('');
    $("#rej_ref2").val('');
    $("#rej_ope3").val('');
    $("#rej_var3").val('');
    $("#rej_ope4").val('');
    $("#rej_var4").val('');
     $("#rej_med1").val('');
    $("#rej_med2").val('');
}
function pre_mostrar_rejilla(cod){
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();

    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=30',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            $("#MostrarRejillas").html(d);
        }
    });
}
function pre_mostrar_rejilla_select(cod){
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();

    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=30.1',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            $("#acc_rej").html('<option value="0">No aplica</option>'+d);
        }
    });
}
function mostrar_med_rej(){
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();
    var cod = $("#acc_rej").val();
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=30.2',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            $("#acc_med_rej").val(d);
            cantidad_insumos();
        }
    });
}
function sel_rejilla(id){
    
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=31',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            var p = eval(d);
            $("#idrefe").val(p[0]);
            $("#rej_ref").val(p[2]);
            $("#rej_des").val(p[3]);
            $("#rej_ref1").val(p[4]);
            $("#rej_ope1").val(p[5]);
            $("#rej_var1").val(p[6]);
            $("#rej_ope2").val(p[7]);
            $("#rej_var2").val(p[8]);
            $("#rej_ref2").val(p[9]);
            $("#rej_ope3").val(p[10]);
            $("#rej_var3").val(p[11]);
            $("#rej_ope4").val(p[12]);
            $("#rej_var4").val(p[13]);

            
            pre_select_ref1_med(p[4],3);
            pre_select_ref1_med(p[9],4);
  
            
            
     
        }
    });
    
}
function del_rejilla(id){
    var cod = $("#codigo").val();
    var c = confirm("Esta seguro de eliminar este items?");
    if(c){
        $.ajax({
        type:'GET',
        data:'id='+id+'&sw=32',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
          
            pre_mostrar_rejilla(cod);
             alert(d);

        }
    });
    }
}
function nuevo(){
    limpiar_cotn();
}
function verificar_codigo(){
    var cod = $("#codigo").val();
    
        $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&sw=9',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                console.log(resultado);
                var p = eval(resultado);
                if(p[0]=='0'){
                    $("#verificar").html('Codigo no encontrado en el parametro de creacion de DT ');
                    if(p[1]!='0'){
                         limpiar_cotn();
                         mostrar_referencia_principal(p[1]);
                         $("#verificar").html('1 en producto encontrado en la tabla referencia');
                    }else{
                       limpiar_cotn();
                       $("#codigo").val(cod);
                    }
                }else{
                    $("#verificar").html('1 en producto encontrado');
                     pre_mostrar_detalle_productos(p[0]);
                }
                
                 
            }
  }); 
}
function mostrar_referencia_principal(cod){
            $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&sw=10',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                console.log(resultado);
                var p = eval(resultado);
                $("#codigo").val(p[0]);
                $("#referencia").val(p[0]);
                $("#descripcion").val(p[1]);
  
            }
  });
}
function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/conf_dolar/acciones.php', //
        success: function(resultado){
            console.log(resultado);
  var p = eval(resultado);
 $("#id_pronue").val(p[0]); 
 $("#lineaprod").val(p[1]);
 $("#codnupro").val(p[2]);
 $("#ancnup").val(p[3]);
 $("#descripcion").val(p[4]);
 $("#alt_nuep").val(p[5]);
 $("#ref_pronue").val(p[6]);
 $("#kit_nue").val(p[7]);
 $("#perfo_pronue").val(p[8]);
 $("#boque_nuep").val(p[9]);
 $("#alcu_pronue").val(p[10]);
 $("#alven_nuep").val(p[11]);
 $("#modn_nuep").val(p[12]);
 $("#ancf_pronue").val(p[13]);
 $("#alvendos_nuep").val(p[14]);
 $("#lami_nuep").val(p[15]);
 $("#ancmax_pronue").val(p[16]);
 $("#altmax_nuep").val(p[17]);
 $("#id_ok").val(p[18]);
 $("#btn_ok").html(p[19]);
 $("#apro_id").html(p[20]);
 $("#btn_apro").html(p[21]);
 $("#aprobado_id").html(p[22]);
 $("#btn_aproba").html(p[23]);
 $("#id_revi").html(p[24]);
 $("#btn_rev").html(p[25]);
 $("#id_actu").html(p[26]);
 $("#btn_actua").html(p[27]);
 $("#espaciadores").val(p[39]);
 $("#interlayer").val(p[40]);
     
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/conf_dolar/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_doll(1);
            }
           });
       }
}
function okr(id,ok){
    var con = confirm("Estas seguro de que revisaste este items?");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=4',
        url:'../vistas/presupuestos/productos_dos/acciones.php',
        success : function(d){
            alert("Se Reviso con exito");
            $("#id_ok").html(d);
            pre_recargar();
        }
    });
    }
}
function anular(id,ok){
     var cod = $("#codigo").val();
    var con = confirm("Estas seguro de cambiar el estado este producto?");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=5',
        url:'presupuestos/crear_cot/acciones.php',
        success : function(d){
           
            pre_mostrar_detalle_productos(cod);
             alert("Se guardo con exito");
        }
    });
    }
}

function aprobado(id,ok){
    var cod = $("#codigo").val();
    var con = confirm("Se ha modificado la DT");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=6',
        url:'presupuestos/crear_cot/acciones.php',
        success : function(d){
            
            pre_mostrar_detalle_productos(cod);
            alert("Se guardo con exito");
        }
    });
    }
}
function revisar(id,ok){
    var con = confirm("Se ha modificado la DT");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=7',
        url:'../vistas/crear_cot/acciones.php',
        success : function(d){
            alert("Se guardo con exito");
            $("#id_revi").html(d);
            consultar_prod(id);
        }
    });
    }
}
function actualizado(id,ok){
    var con = confirm("Se ha modificado la DT");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=8',
        url:'../vistas/crear_cot/acciones.php',
        success : function(d){
            alert("Se guardo con exito");
            $("#id_actu").html(d);
            consultar_prod(id);
        }
    });
    }
}

function historial(){
    var id = $("#id_pro").val();
    window.open("../vistas/historial.php?cod="+id,"Historial","width= 800px , height=600px");
}
function sistemas(){
    
    window.open("presupuestos/productos_dos/sistemas/index.php","Historial","width= 600px , height=550px");
    
}
function obtener(nombre){
    $("#sistema").val(nombre);
    colocar_nombre();
}
function tipos(){
    
    window.open("presupuestos/productos_dos/tipos/index.php","Historial","width= 600px , height=550px");
    
}
function obtener_tipo(nombre){
    $("#tipo").val(nombre);
    colocar_nombre();
}
function obtener_refe(nombre){
    $("#codigo").val(nombre);
    verificar_codigo();
    
}
function hojas(){
    var hoja = $("#hojas").val();
    if(hoja==''){
        alert("Debes de digitar la cantidad de hojas");
        $("#hojas").focus();
        return false;
    }
    window.open("presupuestos/productos_dos/hojas/index.php?h="+hoja,"Historial","width= 600px , height=550px");
    
}
function obtener_hoja(nombre){
    $("#configuracion").val(nombre);
    colocar_nombre();
}
function espesores(){
    
    window.open("presupuestos/productos_dos/espesores/index.php","Historial","width= 600px , height=550px");
    
}
function pre_referencias(){
    
    window.open("presupuestos/productos_dos/referencias/index.php","Historial","width= 600px , height=550px");
    
}
function obtener_espesor(nombre){
    $("#espesor_vid").val(nombre);
    colocar_nombre();
}
function colocar_nombre(){
//    var tip = $("#tipo").val();
//    var sis = $("#sistema").val();
//    var hoj = $("#hojas").val();
//    var con = $("#configuracion").val();
//    var nombre = 'Sistema '+sis+' '+tip+' '+hoj+' Hojas '+con+' ';
//    $("#descripcion").val(nombre);
//    var ref = 'DT-'+sis+'-001';
//    $("#codigo").val(ref);
//    $("#tipo_riel").attr("checked",true);
}
function pre_complementos(caja){
     var sel = $("#"+caja).is(":checked"); 
     var cod = $("#codigo").val();
     if(sel==true){
         window.open("presupuestos/productos_dos/referencias_complementos/index.php?parametro="+caja+"&cod="+cod,"Historial","width= 800px , height=550px");
     }else{
         alert("Debes habilitar el campo, seleccionandolo.");
     }
}
function pre_complementos_kit(caja){
     var sel = $("#"+caja).is(":checked"); 
     var cod = $("#codigo").val();
     var sistema = $("#sistema").val();
     if(sel==true){
         window.open("presupuestos/productos_dos/referencias_complementos/index_1.php?sistema="+sistema+"&cod="+cod+"&parametro="+caja,"Historial","width= 800px , height=550px");
     }else{
         alert("Debes habilitar el campo, seleccionandolo.");
     }
}

function pre_parametros1(cod){
    $.ajax({
        type:'GET',
        data:'cod='+cod,
        url:'presupuestos/productos_dos/listado_parametros1.php',
        success : function(d){
            $("#mostrar_parametros1").html(d);
        }
    });
}
function pre_parametros_perfil(cod){
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();
    

    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=20',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            $("#MostrarPerfil").html(d);
        }
    });
}
function addsis(){
    var sis1 = $("#sistemamas").val();
    var sis = $("#sistema").val();
     cadena = sis1;
     console.log(cadena.indexOf(sis));
//    if(cadena.indexOf(sis) != -1){
//       alert("Ya este sistema esta agregado");
//       return false;
//    }
if(sis==''){
    var ct = sis1;
}else{
    var ct = sis+','+sis1;
}
    
    $("#sistema").val(ct);
    
}
function pre_parametros_rieles(cod){
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();
    

    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=20.1',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            $("#MostrarRieles").html(d);
        }
    });
}
function pre_parametros_alfajia(cod){
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();
    

    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=20.2',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            $("#MostrarAlfajia").html(d);
        }
    });
}
function limpiar_vidrios(){
    pre_select_ref1();
}
function pre_select_ref1(){
    var cod = $("#codigo").val();
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();
    console.log(cod);

    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=23',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            
            $("#vid_ref1").html('<option value="">Seleccione</option><option value="ancho">Ancho ('+ancho+')</option>'+d);
            $("#vid_ref3").html('<option value="">Seleccione</option><option value="alto">Alto ('+alto+')</option>'+d);
            $("#rej_ref1").html('<option value="">Seleccione</option><option value="alto">Alto ('+alto+')</option>'+d);
            $("#rej_ref2").html('<option value="">Seleccione</option><option value="alto">Alto ('+alto+')</option>'+d);

        }
    });
}
function opction_medidas(){
    var cod = $("#codigo").val();
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();
    console.log(cod);

    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=23.1',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            
            $("#alu_perfil").html('<option value="">Seleccione</option>'+d);
            

        }
    });
}
function pre_select_ref1_med(id,num){

    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();

    $.ajax({
        type:'GET',
        data:'cod='+id+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=27',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            if(num === 1){
                $("#med1").val(d);
            }else if(num === 2){
                $("#med2").val(d);
            }else if(num === 3){
                $("#rej_med1").val(d);
            }else if(num === 4){
                $("#rej_med2").val(d);
            }else{
                $("#cifra0").val(d);
            }
            
            
        }
    });
 
}
function pre_addaccesorios(){
    var cod = $("#codigo").val();
    var acod = $("#acc_cod").val();
    var cant = $("#acc_can").val();
    var calc = $("#acc_cal").val();
    var dist = $("#acc_dis").val();
    var cada = $("#acc_cada").val();
    var lado = $("#acc_lado").val();
    var para = $("#acc_para").val();
    var id = $("#idacc").val();
    var acc_conf = $("#acc_conf").val();
    var acc_mod = $("#acc_mod").val();
    var acc_rej = $("#acc_rej").val();
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&acod='+acod+'&acc_rej='+acc_rej+'&conf='+acc_conf+'&insu='+acc_mod+'&id='+id+'&cant='+cant+'&calc='+calc+'&dist='+dist+'&cada='+cada+'&lado='+lado+'&para='+para+'&sw=11',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            console.log(d);
            pre_veracc(cod);
            pre_ver_cierres(cod);
           pre_ver_rodajas(cod);
           pre_ver_brazos(cod);
           pre_ver_bisagras(cod);
            $("#idacc").val(d);
            alert('Se guardo con exito');
            pre_limpiaeracc();
     
        }
    });
}
function pre_addvidrio(){
    var cod = $("#codigo").val();
    var ref_vidrio = $("#ref_vidrio").val();
    var vid_ref1 = $("#vid_ref1").val();
    var vid_ope1 = $("#vid_ope1").val();
    var vid_var1 = $("#vid_var1").val();
    var vid_ope2 = $("#vid_ope2").val();
    var vid_var2 = $("#vid_var2").val();
    var vid_ref3 = $("#vid_ref3").val();
    var vid_ope3 = $("#vid_ope3").val();
    var vid_var3 = $("#vid_var3").val();
    var vid_ope4 = $("#vid_ope4").val();
    var vid_var4 = $("#vid_var4").val();
    var vid_can = $("#vid_can").val();
    var vid_mod = $("#vid_mod").val();
    var vid_id = $("#vid_id").val();
    if(ref_vidrio===''){
        alert("Campo Requerido");
        $("#ref_vidrio").focus();
        return false;
    }
    if(vid_ref1===''){
        alert("Campo Requerido");
        $("#vid_ref1").focus();
        return false;
    }
    if(vid_ope1===''){
        alert("Campo Requerido");
        $("#vid_ope1").focus();
        return false;
    }
    if(vid_var1===''){
        alert("Campo Requerido");
        $("#vid_var1").focus();
        return false;
    }
    if(vid_ope2===''){
        alert("Campo Requerido");
        $("#vid_ope2").focus();
        return false;
    }
    if(vid_var2===''){
        alert("Campo Requerido");
        $("#vid_var2").focus();
        return false;
    }
    if(vid_ref3===''){
        alert("Campo Requerido");
        $("#vid_ref3").focus();
        return false;
    }
    if(vid_ope3===''){
        alert("Campo Requerido");
        $("#vid_ope3").focus();
        return false;
    }
    if(vid_var3===''){
        alert("Campo Requerido");
        $("#vid_var3").focus();
        return false;
    }
    if(vid_ope4===''){
        alert("Campo Requerido");
        $("#vid_ope4").focus();
        return false;
    }
    if(vid_var4===''){
        alert("Campo Requerido");
        $("#vid_var4").focus();
        return false;
    }
    if(vid_can===''){
        alert("Campo Requerido");
        $("#vid_can").focus();
        return false;
    }
     if(vid_mod===''){
        alert("Campo Requerido");
        $("#vid_mod").focus();
        return false;
    }
     $.ajax({
        type:'GET',
        data:'cod='+cod+'&ref_vidrio='+ref_vidrio+'&vid_ref1='+vid_ref1+'&vid_ope1='+vid_ope1+'&vid_var1='+vid_var1+'&vid_ope2='+vid_ope2+'\
&vid_var2='+vid_var2+'&vid_ref3='+vid_ref3+'&vid_ope3='+vid_ope3+'&vid_var3='+vid_var3+'&vid_ope4='+vid_ope4+'\
&vid_var4='+vid_var4+'&vid_can='+vid_can+'&vid_mod='+vid_mod+'&vid_id='+vid_id+'&sw=24',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            alert("Se guardo con exito "+d);
            $("#vid_id").val(d);
            pre_mostrarvidrios(cod);
            pre_limvidrio();
            
        }
    });
    
}
function pre_recargar(){
    var cod = $("#codigo").val();
    pre_mostrar_detalle_productos(cod);
}
function pre_mostrarvidrios(cod){
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var rej = $("#alt_rejilla").val();
    var ancfd = $("#ancho_cf_der").val();
    var ancfi = $("#ancho_cf_izq").val();
    var alcfs = $("#alto_cf_sup").val();
    var alcfi = $("#alto_cf_inf").val();

    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=25',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            $("#MostrarVidrios").html(d);
        }
    });
}
function pre_veracc(cod){
        var ancho = $("#anc_general").val();
        var alto = $("#alt_gener").val();
        var rej = $("#alt_rejilla").val();
        var ancfd = $("#ancho_cf_der").val();
        var ancfi = $("#ancho_cf_izq").val();
        var alcfs = $("#alto_cf_sup").val();
        var alcfi = $("#alto_cf_inf").val();
        $.ajax({
            type:'GET',
            data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=12',
            url:'presupuestos/productos_dos/acciones.php',
            success : function(d){

                $("#mostrar_parametrosacc").html(d);

            }
    });
}
function pre_limvidrio(){
    $("#ref_vidrio").val('');
    $("#vid_ref1").val('');
    $("#vid_var1").val('');
    $("#vid_var2").val('');
    $("#vid_ref3").val('');
    $("#vid_var3").val('');
    $("#vid_var4").val('');
    $("#vid_can").val('');
    $("#vid_mod").val('');
    $("#vid_id").val('');
    $("#ref_vid").val('');
    $("#med1").val('');
    $("#med2").val('');
    $("#vid_med1").val('');
    $("#vid_med2").val('');
}
function sel_vidrio(id){
    
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=26',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
            var p = eval(d);
            $("#vid_id").val(p[0]);
            $("#ref_vidrio").val(p[2]);
            $("#vid_ref1").val(p[3]);
            $("#vid_ope1").val(p[4]);
            $("#vid_var1").val(p[5]);
            $("#vid_ope2").val(p[6]);
            $("#vid_var2").val(p[7]);
            $("#vid_ref3").val(p[8]);
            $("#vid_ope3").val(p[9]);
            $("#vid_var3").val(p[10]);
            $("#vid_ope4").val(p[11]);
            $("#vid_var4").val(p[12]);
            $("#vid_can").val(p[13]);
            $("#vid_mod").val(p[14]);
            
            pre_select_ref1_med(p[3],1);
            pre_select_ref1_med(p[8],2);
  
            
            
     
        }
    });
    
}
function del_vidrio(id){
    var cod = $("#codigo").val();
    var c = confirm("Esta seguro de eliminar este items?");
    if(c){
        $.ajax({
        type:'GET',
        data:'id='+id+'&sw=28',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){
          
            pre_mostrarvidrios(cod);
             alert(d);

        }
    });
    }
}
function medidas_perfiles(){
    
    var med1 = $("#cifra0").val();
     var vid_ope1 = $("#operador1").val();
    var vid_var1 = $("#cifra1").val();
    var vid_ope2 = $("#operador2").val();
    var vid_var2 = $("#cifra2").val();

    if(vid_ope1=='/'){
        resu = med1 / vid_var1;
    }else if(vid_ope1=='*'){
        resu = med1 * vid_var1;
    }else if(vid_ope1=='+'){
        resu = parseFloat(med1) + parseFloat(vid_var1);
    }else{
        resu = parseFloat(med1) - parseFloat(vid_var1);
    }
    if(vid_ope2=='/'){
        resu2 = resu / vid_var2;
    }else if(vid_ope2=='*'){
        resu2 = resu * vid_var2;
    }else if(vid_ope2=='+'){
        resu2 = parseFloat(resu) + parseFloat(vid_var2);
    }else{
        resu2 = parseFloat(resu) - parseFloat(vid_var2);
    }
    console.log(med1+' '+vid_ope1+' '+vid_var1+' '+vid_ope2+' '+vid_var2);
    $("#cifrat0").val(resu2.toFixed(2));

}
function medida_vidrio(){
    
    var med1 = $("#med1").val();
     var vid_ope1 = $("#vid_ope1").val();
    var vid_var1 = $("#vid_var1").val();
    var vid_ope2 = $("#vid_ope2").val();
    var vid_var2 = $("#vid_var2").val();
    var med2 = $("#med2").val();
    var vid_ope3 = $("#vid_ope3").val();
    var vid_var3 = $("#vid_var3").val();
    var vid_ope4 = $("#vid_ope4").val();
    var vid_var4 = $("#vid_var4").val();
    if(vid_ope1=='/'){
        resu = med1 / vid_var1;
    }else if(vid_ope1=='*'){
        resu = med1 * vid_var1;
    }else if(vid_ope1=='+'){
        resu = parseFloat(med1) + parseFloat(vid_var1);
    }else{
        resu = parseFloat(med1) - parseFloat(vid_var1);
    }
    if(vid_ope2=='/'){
        resu2 = resu / vid_var2;
    }else if(vid_ope2=='*'){
        resu2 = resu * vid_var2;
    }else if(vid_ope2=='+'){
        resu2 = parseFloat(resu) + parseFloat(vid_var2);
    }else{
        resu2 = parseFloat(resu) - parseFloat(vid_var2);
    }
    console.log(med1+' '+vid_ope1+' '+vid_var1+' '+vid_ope2+' '+vid_var2);
    $("#vid_med1").val(resu2.toFixed(2));
    //--------------------------------------------------------
      if(vid_ope3=='/'){
        resu = med2 / vid_var3;
    }else if(vid_ope3=='*'){
        resu = med2 * vid_var3;
    }else if(vid_ope3=='+'){
        resu = parseFloat(med2) + parseFloat(vid_var3);
    }else{
        resu = parseFloat(med2) - parseFloat(vid_var3);
    }
    if(vid_ope4=='/'){
        resu = resu / vid_var4;
    }else if(vid_ope4=='*'){
        resu = resu * vid_var4;
    }else if(vid_ope4=='+'){
        resu = parseFloat(resu) + parseFloat(vid_var4);
    }else{
        resu = parseFloat(resu) - parseFloat(vid_var4);
    }
    $("#vid_med2").val(resu.toFixed(2));
}
function medida_rejilla(){
    
    var med1 = $("#rej_med1").val();
     var vid_ope1 = $("#rej_ope1").val();
    var vid_var1 = $("#rej_var1").val();
    var vid_ope2 = $("#rej_ope2").val();
    var vid_var2 = $("#rej_var2").val();
    var med2 = $("#rej_med2").val();
    var vid_ope3 = $("#rej_ope3").val();
    var vid_var3 = $("#rej_var3").val();
    var vid_ope4 = $("#rej_ope4").val();
    var vid_var4 = $("#rej_var4").val();
    if(vid_ope1=='/'){
        resu = med1 / vid_var1;
    }else if(vid_ope1=='*'){
        resu = med1 * vid_var1;
    }else if(vid_ope1=='+'){
        resu = parseFloat(med1) + parseFloat(vid_var1);
    }else{
        resu = parseFloat(med1) - parseFloat(vid_var1);
    }
    if(vid_ope2=='/'){
        resu2 = resu / vid_var2;
    }else if(vid_ope2=='*'){
        resu2 = resu * vid_var2;
    }else if(vid_ope2=='+'){
        resu2 = parseFloat(resu) + parseFloat(vid_var2);
    }else{
        resu2 = parseFloat(resu) - parseFloat(vid_var2);
    }
    console.log(med1+' '+vid_ope1+' '+vid_var1+' '+vid_ope2+' '+vid_var2);
    $("#rej_res1").val(resu2.toFixed(2));
    //--------------------------------------------------------
      if(vid_ope3=='/'){
        resu = med2 / vid_var3;
    }else if(vid_ope3=='*'){
        resu = med2 * vid_var3;
    }else if(vid_ope3=='+'){
        resu = parseFloat(med2) + parseFloat(vid_var3);
    }else{
        resu = parseFloat(med2) - parseFloat(vid_var3);
    }
    if(vid_ope4=='/'){
        resu = resu / vid_var4;
    }else if(vid_ope4=='*'){
        resu = resu * vid_var4;
    }else if(vid_ope4=='+'){
        resu = parseFloat(resu) + parseFloat(vid_var4);
    }else{
        resu = parseFloat(resu) - parseFloat(vid_var4);
    }
    $("#rej_res2").val(resu.toFixed(2));
}
function cantidad_insumos(){
    var ancho = $("#anc_general").val();
    var alto = $("#alt_gener").val();
    var dis = $("#acc_dis").val();
    var cada = $("#acc_cada").val();
    var lado = $("#acc_lado").val();
    
    var can = $("#acc_can").val();
    var can_rej = $("#acc_med_rej").val();
    var calculo = $("#acc_cal").val();
    
    mt2 = (ancho/1000) * (alto/1000); 
    mt = (parseFloat(ancho/1000) + (alto/1000))*2;
    
    if(lado=='Vertical'){
        medida = alto;
    }else{
        medida = ancho;
    }

    if(dis=='Si'){
        cant_calculada = medida / cada;
     }else{
        cant_calculada = 1;
     } 
    

    if(calculo=='mt'){
        variable = mt;
    }else if(calculo=='m2'){
        variable = mt2;
    }else{
        variable = 1;
    }
    var total = variable * can * can_rej * cant_calculada;
    $("#acc_ct").val(total.toFixed(2));
}
function pasar_acc(cod, nom){
    $("#acc_cod").val(cod);
    $("#acc_des").val(nom);
}

function pre_ver_cierres(cod){
      var ancho = $("#anc_general").val();
        var alto = $("#alt_gener").val();
        var rej = $("#alt_rejilla").val();
        var ancfd = $("#ancho_cf_der").val();
        var ancfi = $("#ancho_cf_izq").val();
        var alcfs = $("#alto_cf_sup").val();
        var alcfi = $("#alto_cf_inf").val();
        $.ajax({
            type:'GET',
            data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=12.1',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){

            $("#mostrar_cierres").html(d);
     
        }
    });
}
function pre_ver_rodajas(cod){
      var ancho = $("#anc_general").val();
        var alto = $("#alt_gener").val();
        var rej = $("#alt_rejilla").val();
        var ancfd = $("#ancho_cf_der").val();
        var ancfi = $("#ancho_cf_izq").val();
        var alcfs = $("#alto_cf_sup").val();
        var alcfi = $("#alto_cf_inf").val();
        $.ajax({
            type:'GET',
            data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=12.2',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){

            $("#mostrar_rodajas").html(d);
     
        }
    });
}
function pre_ver_brazos(cod){
      var ancho = $("#anc_general").val();
        var alto = $("#alt_gener").val();
        var rej = $("#alt_rejilla").val();
        var ancfd = $("#ancho_cf_der").val();
        var ancfi = $("#ancho_cf_izq").val();
        var alcfs = $("#alto_cf_sup").val();
        var alcfi = $("#alto_cf_inf").val();
        $.ajax({
            type:'GET',
            data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=12.3',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){

            $("#mostrar_brazos").html(d);
     
        }
    });
}
function pre_ver_bisagras(cod){
      var ancho = $("#anc_general").val();
        var alto = $("#alt_gener").val();
        var rej = $("#alt_rejilla").val();
        var ancfd = $("#ancho_cf_der").val();
        var ancfi = $("#ancho_cf_izq").val();
        var alcfs = $("#alto_cf_sup").val();
        var alcfi = $("#alto_cf_inf").val();
        $.ajax({
            type:'GET',
            data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=12.4',
            url:'presupuestos/productos_dos/acciones.php',
            success : function(d){
                $("#mostrar_bisagras").html(d);
              }
    });
}
function pre_delacc(id,cod){
    var c = confirm("Esta seguro de eliminar este producto");
    if(c){
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=14',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){

           pre_veracc(cod);
           pre_ver_cierres(cod);
           pre_ver_rodajas(cod);
           pre_ver_brazos(cod);
           pre_ver_bisagras(cod);
     
        }
    });
    }
}
function pre_pasaracc(cod,des,can,cal,dis,met,lad,par,id,con,mod,rej){
    $("#acc_des").val(des);
    $("#acc_cod").val(cod);
    $("#acc_can").val(can);
    $("#acc_cal").val(cal);
    $("#acc_dis").val(dis);
    $("#acc_cada").val(met);
    $("#acc_lado").val(lad);
    $("#acc_para").val(par);
    $("#acc_conf").val(con);
    $("#acc_mod").val(mod);
    $("#acc_rej").val(rej);
    $("#idacc").val(id);
    $("#modalaccesorios").modal('show');
    mostrar_med_rej();
    
}
function pre_limpiaeracc(){
    $("#acc_des").val('');
    $("#acc_cod").val('');
    $("#acc_can").val('');
    $("#acc_cal").val('');
    $("#acc_dis").val('');
    $("#acc_cada").val('');
    $("#acc_lado").val('');
    $("#acc_para").val('');
    $("#idacc").val('');
    $("#acc_rej").val('');
    $("#acc_med_rej").val('1');
    $("#acc_ct").val('0');

}
function pre_pasarparametrocomp(id,med){
    $("#esp_id").val(id);
    $("#esp_cal").val(med);
    mostrar_parametroscomp(id);
}
function mostrar_parametroscomp(id){
        $.ajax({
        type:'GET',
        data:'cod='+id+'&sw=16',
        url:'presupuestos/productos_dos/acciones.php',
        success : function(d){

          $("#esp_compuestos").html(d);
     
        }
    });
}
function del_espcomp(id){
    var cod = $("#esp_id").val();
    var c = confirm("Esta seguro de eliminar este item");
    if(c){
        $.ajax({
            type:'GET',
            data:'cod='+id+'&sw=17',
            url:'presupuestos/productos_dos/acciones.php',
            success : function(d){

              mostrar_parametroscomp(cod);

            }
        });
    }
}
function pre_addselcom(){
    var cod = $("#codigo").val();
    var tipo = 'Compuestos';
    var ref = $("#esp_cod").val();
    var can = $("#esp_can").val();
    var und = $("#esp_cal").val();
    var id = $("#esp_id").val();
     var tiposel = $("#esp_tipo").val();
    if(cod=='' || tipo=='' || ref=='' || can=='' || und==''){
        alert("Debes de llenar todos los parametros");
        return false;
    }
         $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&id='+id+'&tipo='+tipo+'&tiposel='+tiposel+'&ref='+ref+'&can='+can+'&und='+und+'&sw=18',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                console.log(resultado);
                alert(resultado);
                pre_parametros1(cod);
                 mostrar_parametroscomp(id);
                $("#fdesc").val('');
                $("#ftipo").val('');
                $("#frefe").val('');
                $("#fcant").val('');
                $("#funid").val('');
            }
  });
}
function pre_addfab(){
    var fab_id = $("#fab_id").val();
    var fab_cod = $("#fab_cod").val();
    var fab_hoja = $("#fab_hoja").val();
    var fab_rango = $("#fab_rango").val();
    var fab_lado = $("#fab_umb").val();
    var cod = $("#codigo").val();
    if(fab_cod==''){
        alert("Seleccione el servicio.");
        $("#fab_cod").focus();
        return false;
    }
    if(fab_lado==''){
        alert("Seleccione el modulo.");
        $("#fab_lado").focus();
        return false;
    }
$.ajax({
            type: 'GET',
            data: 'cod='+cod+'&fab_id='+fab_id+'&fab_cod='+fab_cod+'&fab_hoja='+fab_hoja+'&fab_rango='+fab_rango+'&fab_lado='+fab_lado+'&sw=33',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
               var p = eval(resultado);
                alert(p[1]);
                limpiar_fab();
                mostrar_instalacion();
            }
  });
    //42930.1
}
function limpiar_fab(){
        $("#fab_id").val('');
        $("#fab_cod").val('');
        $("#fab_hoja").val('');
        $("#fab_rango").val('');
        $("#fab_lado").val('');
        $("#fab_umb").val('');
        $("#fab_val1").val('');
        $("#fab_val2").val('');
}
function cargar_select_instalacion(){
var sistema = $("#sistema").val();
$.ajax({
            type: 'GET',
            data: 'sistema='+sistema+'&sw=34',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                $("#fab_cod").html(resultado);
            }
  });
}
function cargar_valores_instalacion(){
    var cod = $("#fab_cod").val();
    $.ajax({
            type: 'GET',
            data: 'id='+cod+'&sw=2',
            url: 'presupuestos/precio_instalacion/acciones.php',
            success: function(resultado){
                var p = eval(resultado);
                $("#fab_umb").val(p[10]);
                $("#fab_val1").val(p[3]);
                $("#fab_val2").val(p[4]);
            }
  });
}
function mostrar_instalacion(){
    var cod = $("#codigo").val();
    $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&sw=35',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                $("#mostrar_instalacion").html(resultado);

            }
  });
}
function pasar_instalacion(id,ins,umb,t1,t2,h,cal,ran){
           $("#fab_id").val(id);
        $("#fab_cod").val(ins);
        $("#fab_hoja").val(h);
        $("#fab_rango").val(ran);
        $("#fab_lado").val(cal);
        $("#fab_umb").val(umb);
        $("#fab_val1").val(t1);
        $("#fab_val2").val(t2);
}
function borrar_instalacion(id){
    var c = confirm("Esta seguro de eliminar este items?");
    if(c){
        $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=36',
            url: 'presupuestos/productos_dos/acciones.php',
            success: function(resultado){
                alert(resultado);
               mostrar_instalacion();

            }
  });
    }
}
function addalfajia(){
    var alf = $("#tipo_alfa").is(":checked");
    var cod = $("#codigo").val();
    
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&alf='+alf+'&sw=37',
                url: 'presupuestos/productos_dos/acciones.php',
                success: function(resultado){
                  alert(resultado);
                  pre_recargar();
                  // mostrar_instalacion();

                }
      });
    
}
function addriel(){
    var alf = $("#tipo_riel").is(":checked");
    var cod = $("#codigo").val();
    
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&alf='+alf+'&sw=38',
                url: 'presupuestos/productos_dos/acciones.php',
                success: function(resultado){
                  alert(resultado);
                  pre_recargar();
                  // mostrar_instalacion();

                }
      });
    
}
function crear(id,nombre,idarea){
    var cod = $("#codigo").val();
    var nom = $("#creado").val();
    var de = $("#cristal"+id).is(":checked");
    
    if(de==true){
       var t = nom+' '+nombre; 
       $("#creado").val(t);
       $("#descripcion").val(t);
       addtra(idarea,1);
    }else{

        $.ajax({
                type: 'GET',
                data: 'cad='+nom+'&del='+nombre+'&cod='+cod+'&idarea='+idarea+'&sw=40',
                url: 'presupuestos/productos_dos/acciones.php',
                success: function(r){
                  $("#creado").val(r);
                  $("#descripcion").val(r);
                  addtra(idarea,0);
                }
      });
    }
    
    
}
function addtra(area,c){
    var cod = $("#codigo").val();
    var linea = $("#linea").val();
    $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&area='+area+'&c='+c+'&linea='+linea+'&sw=41',
                url: 'presupuestos/productos_dos/acciones.php',
                success: function(r){
                  mostrar_trazabilidad();
                }
      });
}
function mostrar_trazabilidad(){
    var cod = $("#codigo").val();
    var linea = $("#linea").val();
    $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&linea='+linea+'&sw=39',
                url: 'presupuestos/productos_dos/acciones.php',
                success: function(r){
                  $("#mostrar_trazabilidad").html(r);
                }
      });
    
}
function sec(id){
    var sec = $("#sec"+id).val();
    $.ajax({
                type: 'GET',
                data: 'id='+id+'&sec='+sec+'&sw=42',
                url: 'presupuestos/productos_dos/acciones.php',
                success: function(r){
                  mostrar_trazabilidad();
                }
      });
    
}
function addtrazabilidad(){
    var cod = $("#codigo").val();
     var nom = $("#creado").val();
     if(nom==''){
         alert("debes de seleccionar alguna descripcion para este producto");
         return false;
     }
    $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&nom='+nom+'&sw=43',
                url: 'presupuestos/productos_dos/acciones.php',
                success: function(r){
                  $("#modalnombres").modal('hide');
                }
      });
    
}
function mostrar_uno(page){
    $.ajax({
                type: 'GET',
                data: 'page='+page,
                url: 'presupuestos/productos_dos/paginacion.php',
                success: function(r){
                  var p = eval(r);
                  $("#paginacion").html(p[0]);
                  //productos_dos(p[1]);
                  pre_mostrar_detalle_productos(p[1]);
                }
      });
}
function verite(){
    var page = $("#page").val();
    mostrar_uno(page);
}