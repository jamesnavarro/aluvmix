var idglobal;
var linea;
var idcompuesto;
var cot;
$(function() {


        $("#v_por").change(function () {
            $("#btn_ven").attr("disabled", false).focus();
            var max = $("#v_max").val();
            var por = $("#v_por").val();
            if(parseInt(por) < parseInt(max)){
            alert("El descuento permitido para este articulo es de "+max+" % ");
            $("#v_por").val('').focus();
            return false;

            }
            calcular_perfil();
        });
        //saltos de casilla de texto
        $("#ancho").change(function () {
            $("#alto").focus();

        });

        $("#alto").change(function () {
            $("#color").focus(); 
        });
        $("#cantidad").change(function () {
             $("#tipos").focus();
        });
        $("#tipos").change(function () {
             $("#ancho").focus();
        });
        $("#ubicacion").change(function () {
            $("#observacion").focus(); 
        });
        $("#observacion").change(function () {
            $("#laminas").focus(); 
        });
        $("#perforacion").change(function () {
            var per = $("#boquetes").val();
            if(per=='Si'){
               $("#boquetes").focus();
            }else{
               $("#laminas").focus();
            }
        });
        $("#boquetes").change(function () {
            $("#laminas").focus();
        });
        $("#ubicacion").change(function () {
            $("#observacion").focus();
        });
        $("#color").change(function () {
            $("#ubicacion").focus();
        });
  
        $("#cod").change(function () {
            var idp = $("#idp").val();
            if(idp!==''){
              $("#vid").focus();
            }
        });
        $("#desc").change(function () {
        var desc = $("#desc").val();
        var piva = $("#pivaOut").val();
        var max = $("#max").val();
        var ser = $("#ser").val();
        if(ser==='0'){
        if( parseInt(desc) < parseInt(max) ){
        alert("Supera el descuento maximo autorizado para el cliente. ");
        $("#desc").val('0');
        return false;
        }
        }
        cot();
        });
        $("#espesor").change(function () {
            ajuste_referencias();
        });
        $("#ajuste").change(function () {
        var a = $("#precio").val();
        var b = $("#ajuste").val();
        var c = parseInt(a) + parseInt(b);
        $("#unidad").val(c);
        });
        $("#unidad").change(function () {
        var a = $("#precio").val();
        var b = $("#unidad").val();
        var c = parseInt(b) - parseInt(a);
        $("#ajuste").val(c);
        });
        $("#codigo100").click(function () {
              var cot = $("#cot").val();
     var lam = $("#laminas").val();
    var cod = $("#codigo0").val();
    var des = $("#descripcion_final").val();
    var des0 = $("#descripcion0").val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var pelicula = $("#pelicula").val();
    var carton = $("#carton").val();
    var desp = $("#desperdicio").val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var inst = $("#instalacion").val();
    var ubc = $("#ubicacion").val();
    var obse = $("#observacion").val();
    var item = $("#tipos").val();
    var desc = $("#descuento").val();
    var precio = $("#subtotal").val();
    var estado = $("#estado").val();
    var item = $("#item").val();
    var comision = $("#comision").val();
    var reposicion = $("#reposicion").val();
    var imprevisto = $("#imprevisto").val();
    var utilidad = $("#utilidad").val();
    
    var anchocfd = $("#anchocfd").val();
    var altocfs = $("#altocfs").val();
    var anchocfi = $("#anchocfi").val();
    var altocfi = $("#altocfi").val();
    var altorej = $("#altorej").val();
    
    var rieles = $("#rieles").val();
    var alfajias = $("#alfajias").val();
    var rejillas = $("#rejillas").val();
    var cierres = $("#cierres").val();
    var rodajas = $("#rodajas").val();
    var entre_rej = $("#entre_rej").val();
    var linea = $("#linea").val();
    var color = $("#color").val();
    var comp = $("#compuesto").val();
    
    var traz1 = $("#codigo100").val();
    var traz2 = $("#codigo200").val();
    var traz3 = $("#codigo300").val();
    var traz4 = $("#codigo400").val();
    if(cod==''){
        alert("Seleccione el codigo");
        $("#codigo0").focus();
        return false;
    }
    if(ancho==''){
        $("#codigo100").val('');
        alert("Digite el ancho del producto");
        $("#ancho").focus();
        return false;
    }
    if(alto==''){
        $("#codigo100").val('');
        alert("Digite el alto del producto");
                $("#alto").focus();
        return false;
    }
    if(cant==''){
         $("#codigo100").val('');
        alert("Digite la cantidad");
        $("#cantidad").focus();
       
        return false;
    }
            if(anchocfd==''){
        alert("Digite el ancho del cuerpo fijo");
        $("#anchocfd").focus();
        return false;
    }
    if(altocfs==''){
        alert("Digite el alto cuerpo fijo superior");
        $("#altocfs").focus();
        return false;
    }
    if(anchocfi==''){
        alert("Digite el ancho cuerpo fijo inferior");
        $("#anchocfi").focus();
        return false;
    }
    if(altocfi==''){
        alert("Digite el alto cuerpo fijo inferior");
        $("#altocfi").focus();
        return false;
    }
    if(altorej==''){
        alert("Digite el alto de la rejilla");
        $("#altorej").focus();
        return false;
    }
    if(color==''){
        alert("Seleccione el color");
        $("#codigo100").val('');
        $("#color").focus();
        
        return false;
    }
    if($("#riel").val()=='true'){
        if($("#rieles").val()==''){
            
            alert("Seleccione el riel");
            $("#codigo100").val('');
            $("#rieles").focus();
            
            return false;
        }
    }
    if($("#alfajia").val()=='true'){
        if($("#alfajias").val()==''){

            alert("Seleccione la alfajia");
            $("#codigo100").val('');
            $("#alfajias").focus();
            
            return false;
        }
    }
    if($("#rejilla").val()=='true'){
        if($("#rejillas").val()==''){
         
            alert("Seleccione la rejilla");
            $("#codigo100").val('');
            $("#alfajias").focus();
           
            return false;
        }
    }
    if($("#cierre").val()=='true'){
        if($("#cierres").val()==''){
         
            alert("Seleccione el cierre");
            $("#codigo100").val('');
            $("#cierres").focus();
            return false;
        }
    }
    if($("#rodaja").val()=='true'){
        if($("#rodajas").val()==''){
            
            alert("Seleccione la rodaja");
            $("#codigo100").val('');
            $("#rodajas").focus();
            
            return false;
        }
    }
    get_referencias(100);
//              var c = confirm("Desea seguir con la cotizacion del item?");
//              if(c){ 
                  save_item();
                  //$("#ubicacion").focus();  
              //}
        });
        $("#instalacion").change(function () {
            var cierres = $("#cierres").val();
             var rodajas = $("#rodajas").val();
           insumos(cierres,rodajas);
        });
        
        $("#pelicula").change(function () {
             var pel = $("#pelicula").val();
             var und = $("#und_peli").val();
             var mt = $("#mtc_peli").val();
             var desp = $("#desperdicio_acc").val();
             if(pel=='Una Cara'){
                 tope = und * mt;
                 $('#result_tr').show('show');
             }else if(pel=='Dos Cara'){
                 tope = und * mt * 2;
                 $('#result_tr').show('show');
             }else{
                 tope = 0;
                 $('#result_tr').hide('hide');
             }
              var porcentaje = (100 - desp)/100;
              tope = tope;
               dtope = tope / porcentaje;
             $("#tot_peli").val(tope.toFixed(2));
             $("#tot_peli_desp").val(dtope.toFixed(2));
             totalizar();
        });
         $('#subida').submit(function(){
		var sob = $('#tso').val();
                //var pro = $('#prod').val();
                //var rad = $('#rad').val();
		var comprobar = $('#foto').val().length;
                //alert(pro);
		if(comprobar>0 && sob!==''){		
			var formulario = $('#subida');	
			var datos = formulario.serialize();		
			var archivos = new FormData();			
			var url = 'subir_foto.php';		
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
                                        alert(data);
                                        $('#foto').focus();
                                        if(data==='1'){
                                            $('#msg').html('<font color="green">Se cargo con exito</font>').show(200).delay(2500).hide(200);
                                        }else{
                                            $('#msg').html('<b>No se cargo correctamente</b>').show(200).delay(2500).hide(200);
                                        }
                                        
					$('#foto').val('');
                                        $('#tso').val(sob);
				        DatosBasicos();
				}
			});
			return false;
		}else{
			alert('Cargue la foto ó Verifique haber llenado todos los datos principales');
			return false;
		}
	});
});
function AddCompuesto(){
    idcompuesto = $("#item").val();
    linea = $("#linea").val();
    cot = $("#cot").val();
    idglobal =  '';
    var est = $("#estado").val();
    if(est=='Guardado'){
         window.open("aluminio.php","Cotizadorx","width=1400,height=800");
    }else{
        alert("Debes de guardar el items.");
    }
    
}
function laminas_items(){
    var lam = $("#laminas").val();
    var cod = $("#codigo0").val();
    var des = $("#descripcion0").val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var lamx = $("#lam").val();
    var pelicula = $("#pelicula").val();
    var inter = $("#interlayer").val();
    var espa = $("#espaciadores").val();
    var desp = $("#desperdicio").val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var despesp = $("#desperdicio_esp").val();
    var despint = $("#desperdicio_int").val();
    var inst = $("#instalacion").val();
    var est = $("#estado").val();
    var item = $("#item").val();
    
    var anchocfd = $("#anchocfd").val();
    var altocfs = $("#altocfs").val();
    var anchocfi = $("#anchocfi").val();
    var altocfi = $("#altocfi").val();
    var altorej = $("#altorej").val();
    var alfa = $("#alfajias").val();
    if(cod==''){
        alert("Debes de seleccionar el items principal");
         $("#codigo").val('').focus();
        return false;
    }
    if(ancho==''){
        alert("Debes de digitar el ancho");
         $("#ancho").val('').focus();
        return false;
    }
    if(alto==''){
        alert("Debes de sdigitar el alto");
         $("#alto").val('').focus();
        return false;
    }
    if(parseInt(lam)>parseInt(lamx)){
        alert("El maximo de laminas permitidos son "+lamx);
        $("#laminas").val('').focus();
        return false;
    }
    $.ajax({
        type:'GET',
        data:'lam='+lam+'&rej='+altorej+'&ancfd='+anchocfd+'&alfa='+alfa+'&ancfi='+anchocfi+'&alcfs='+altocfs+'&alcfi='+altocfi+'&cod='+cod+'&est='+est+'&item='+item+'&inst='+inst+'&despesp='+despesp+'&despint='+despint+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&inter='+inter+'&espa='+espa+'&des='+des+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&pelicula='+pelicula,
        url:'../productos_dos/laminas_alu.php',
                    success : function(t){
                        $("#formlaminas").html(t);
                        $("#costos").html('');
                        codvidrios(); //pasar valores de codigos de vidrios agrupados
                       
                    }
    });
}
function laminados(){
    var n = $("#con_num").val();
    var lam = $("#con_lam").val();
    var vid = $("#con_vid").val();
    var vidnom = $("#con_vid_nom").val();
    var cod = $("#codigo900").val();
    var descripcion = $("#descripcion900").val();
    var cod_pri = $("#codigo0").val();
    var des = $("#descripcion0").val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var lamx = $("#lam").val();
    var pelicula = $("#pelicula").val();
    var inter = $("#interlayer").val();
    var espa = $("#espaciadores").val();
    var desp = $("#desperdicio").val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var despesp = $("#desperdicio_esp").val();
    var despint = $("#desperdicio_int").val();
    var inst = $("#instalacion").val();
    var est = $("#estado").val();
    var item = $("#item").val();
    
    var anchocfd = $("#anchocfd").val();
    var altocfs = $("#altocfs").val();
    var anchocfi = $("#anchocfi").val();
    var altocfi = $("#altocfi").val();
    var altorej = $("#altorej").val();
    var alfa = $("#alfajias").val();
    if(cod==''){
        alert("Debes de seleccionar el items principal");
         $("#codigo").val('').focus();
        return false;
    }
    if(ancho==''){
        alert("Debes de digitar el ancho");
         $("#ancho").val('').focus();
        return false;
    }
    if(alto==''){
        alert("Debes de sdigitar el alto");
         $("#alto").val('').focus();
        return false;
    }

    $.ajax({
        type:'GET',
        data:'lam='+lam+'&rej='+altorej+'&vid='+vid+'&vidnom='+vidnom+'&cod_pri='+cod_pri+'&ancfd='+anchocfd+'&alfa='+alfa+'&ancfi='+anchocfi+'&alcfs='+altocfs+'&alcfi='+altocfi+'&cod='+cod+'&descripcion='+descripcion+'&est='+est+'&item='+item+'&inst='+inst+'&despesp='+despesp+'&despint='+despint+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&inter='+inter+'&espa='+espa+'&des='+des+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&pelicula='+pelicula,
        url:'../productos_dos/laminados.php',
                    success : function(t){
                        $("#confi").html(t);
                    },
                    complete: function (t) {
                      save_laminado(); 
                     }
    });
}

function insumos(cierres,rodajas,brazos,bisagras,canbis,cancie,canrod,canbra){
    //alert(' bis '+ bisagras+' cie'+cierres+' rod'+rodajas+' bra'+brazos);
         var lam = $("#laminas").val();
    var cod = $("#codigo0").val();
    var des = $("#descripcion0").val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var lamx = $("#lam").val();
    var pelicula = $("#pelicula").val();
    var inter = $("#interlayer").val();
    var espa = $("#espaciadores").val();
    var desp = $("#desperdicio").val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var inst = $("#instalacion").val();

    if(cod==''){
        alert("Debes de seleccionar el items principal");
         $("#codigo").val('').focus();
        return false;
    }
    if(ancho==''){
        alert("Debes de digitar el ancho");
         $("#ancho").val('').focus();
        return false;
    }
    if(alto==''){
        alert("Debes de sdigitar el alto");
         $("#alto").val('').focus();
        return false;
    }
    if(parseInt(lam)>parseInt(lamx)){
        alert("El maximo de laminas permitidos son "+lamx);
        $("#laminas").val('').focus();
        return false;
    }
    
    $.ajax({
        type:'GET',
        data:'lam='+lam+'&brazos='+brazos+'&bisagras='+bisagras+'&canrod='+canrod+'&canbra='+canbra+'&cancie='+cancie+'&canbis='+canbis+'&rodajas='+rodajas+'&cierres='+cierres+'&cod='+cod+'&inst='+inst+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&inter='+inter+'&espa='+espa+'&des='+des+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&pelicula='+pelicula+'&sw=43',
        url:'acciones_alu.php',
                    success : function(t){
                        $("#forminsumos").html(t);
                        //totalizar();
                    }
    });
}
function congelar_item(){
    
var c = confirm("Esta seguro de guardar este items?");
if(c){
        var cot = $("#cot").val();
         var lam = $("#laminas").val();
        var cod = $("#codigo0").val();
        var des = $("#descripcion_final").val();
        var des0 = $("#descripcion0").val();
        var ancho = $("#ancho").val();
        var alto = $("#alto").val();
        var cant = $("#cantidad").val();
        var per = $("#perforacion").val();
        var boq = $("#boquetes").val();
        var pelicula = $("#pelicula").val();
        var carton = $("#carton").val();
        var desp = $("#desperdicio").val();
        var despalu = $("#desperdicio_al").val();
        var despacc = $("#desperdicio_acc").val();
        var despesp = $("#desperdicio_esp").val();
        var despint = $("#desperdicio_int").val();
        var inst = $("#instalacion").val();
        var ubc = $("#ubicacion").val();
        var obse = $("#observacion").val();
        var tipo = $("#tipos").val();
        var desc = $("#descuento").val();
        var precio = $("#subtotal").val();
        var estado = $("#estado").val();
        var item = $("#item").val();
        var comision = $("#comision").val();
        var reposicion = $("#reposicion").val();
        var imprevisto = $("#imprevisto").val();
        var utilidad = $("#utilidad").val();
        var anchocfd = $("#anchocfd").val();
        var altocfs = $("#altocfs").val();
        var anchocfi = $("#anchocfi").val();
        var altocfi = $("#altocfi").val();
        var altorej = $("#altorej").val();
        var rieles = $("#rieles").val();
        var alfajias = $("#alfajias").val();
        var rejillas = $("#rejillas").val();
        var cierres = $("#cierres").val();
        var rodajas = $("#rodajas").val();
        var entre_rej = $("#entre_rej").val();
        var brazos = $("#brazos").val();
        var bisagras = $("#bisagras").val();
        var can_bis = $("#can_bis").val();
        var can_cie = $("#can_cie").val();
        var can_rod = $("#can_rod").val();
        var can_bra = $("#can_bra").val();
        var anchototal = $("#anchototal").val();
        var altototal = $("#altototal").val(); 
        var color = $("#color").val();
        var compuesto = $("#compuesto").val();
        var traz1 = $("#codigo100").val();
        var traz2 = $("#codigo200").val();
        var traz3 = $("#codigo300").val();
        var traz4 = $("#codigo400").val();
        var hor = $("#hor").val();
        var ver = $("#ver").val();
        if(item==''){
            alert("Debes de generar el documento");
            $("#codigo0").focus();
            return false;
        }

    $.ajax({
            post:'GET',
            data:'cod='+cod+'&hor='+hor+'&ver='+ver+'&color='+color+'&traz1='+traz1+'&traz2='+traz2+'&traz3='+traz3+'&traz4='+traz4+'&anchototal='+anchototal+'&altototal='+altototal+'&can_rod='+can_rod+'&can_bra='+can_bra+'&can_cie='+can_cie+'&brazos='+brazos+'&bisagras='+bisagras+'&can_bis='+can_bis+'&compuesto='+compuesto+'&entre_rej='+entre_rej+'&rodajas='+rodajas+'&cierres='+cierres+'&rejillas='+rejillas+'&alfajias='+alfajias+'&rieles='+rieles+'&anchocfd='+anchocfd+'&altocfs='+altocfs+'&anchocfi='+anchocfi+'&altocfi='+altocfi+'&altorej='+altorej+'desc='+desc+'&precio='+precio+'&despesp='+despesp+'&despint='+despint+'&utilidad='+utilidad+'&des='+encodeURIComponent(des)+'&des0='+encodeURIComponent(des0)+'&estado='+estado+'&item='+item+'&cot='+cot+'&lam='+lam+'&ubc='+ubc+'&obse='+obse+'&itemx='+tipo+'&pelicula='+pelicula+'&carton='+carton+'&inst='+inst+'&despvid='+desp+'&despalu='+despalu+'&despacc='+despacc+'&cot='+cot+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&despesp='+despesp+'&despint='+despint+'&utilidad='+utilidad+'&sw=31',
            url:'acciones_alu.php',
            success:function(a){

               $("#estado").val('Guardado');
               //console.log('resultado'+a);
               if(compuesto==='0'){
                   DatosBasicos();
                   alert("Se guardo con exito.");
                   //nuevo_aluminio();
                    window.opener.mostrar_items(cot);
                   
               }else{
                   window.opener.mostrar_items(cot);
                   window.close();
               }
               //guardar_total();
               setTimeout(guardar_total,1000);
               
            } 
        });
    }

}
function DatosBasicos(){
              
                $("#cot").val(window.opener.$("#idcot").val());
                $("#idcot").val(window.opener.$("#idcot").val());
                
                $("#linea").val(window.opener.linea);
                $("#descuento").val(window.opener.$("#max").val());
                $("#item").val(window.opener.idglobal);
                $("#compuesto").val(window.opener.idcompuesto);
                var idc = window.opener.idcompuesto;
                console.log('Cargando linea:'+linea+' , ='+idc);
                if(idc!=0){
                    $("#btncompuesto").html(idc);
                   
                }
                
                var item = window.opener.idglobal;
                if(item!==''){
                    //$("#carga").html('<div class="loader"></div>');
                    //$("#cargando").modal('show');
                    jsShowWindowLoad('Procesando datos..');
                    $("#tso").val(item);
                $.ajax({
                    post:'GET',
                    data:'item='+item+'&sw=32',
                    url:'acciones_alu.php',
                    success:function(a){
                        
                            var p = eval(a);
                            $("#codigo0").val(p[2]);
                            $("#laminas").val(p[9]);
                            $("#descripcion_final").val(p[3]);
                            $("#ancho").val(p[6]);
                            $("#alto").val(p[7]);
                            $("#cantidad").val(p[8]);
                            $("#perforacion").val(p[10]);
                            $("#boquetes").val(p[11]);
                            $("#pelicula").val(p[12]);
                            if(p[12]=='Una Cara'){
                                  $('#result_tr').show('show');
                            }else if(p[12]=='Dos Cara'){
                                 $('#result_tr').show('show');
                            }else{
                                 $('#result_tr').hide('hide');
                            }
                            $("#carton").val(p[13]);
                            $("#desperdicio").val(p[27]);
                            $("#desperdicio_al").val(p[28]);
                            $("#desperdicio_acc").val(p[29]);
                            $("#instalacion").val(p[19]);
                            $("#ubicacion").val(p[16]);
                            $("#observacion").val(p[17]);
                            $("#tipos").val(p[18]);
                            $("#estado").val(p[26]);          
                            $("#anchocfd").val(p[37]);
                            $("#altocfs").val(p[38]);
                            $("#anchocfi").val(p[39]);
                            $("#altocfi").val(p[40]);
                            $("#altorej").val(p[41]);
                            $("#compuesto").val(p[54]);
                            $("#rieles").val(p[46]);
                            $("#alfajias").val(p[47]);
                            $("#rejillas").val(p[48]);
                            $("#cierres").val(p[49]);
                            $("#rodajas").val(p[50]);
                            $("#entre_rej").val(p[51]);
                            $("#brazos").val(p[56]);
                            $("#bisagras").val(p[57]);
                            $("#can_bis").val(p[58]);
                            $("#can_cie").val(p[59]);
                            $("#can_rod").val(p[64]);
                            $("#can_bra").val(p[65]);

                            $("#utilidad").val(p[34]);
                            $("#descuento").val(p[21]);
                            $("#subtotal").val(p[20]);
                            $("#color").val(p[53]);
                            
                            $("#anchototal").val(p[61]);
                            $("#altototal").val(p[62]);
                            
                            $("#hor").val(p[73]);
                            $("#ver").val(p[72]);
                            
                            $("#codigo100").val(p[66]);
                            trazabilidad_lamina(p[66],100);
                            $("#codigo200").val(p[67]);
                            trazabilidad_lamina(p[67],200);
                            $("#codigo300").val(p[68]);
                            trazabilidad_lamina(p[68],300);
                            $("#codigo400").val(p[69]);
                            trazabilidad_lamina(p[69],400);
                            
                            laminas_items();
                            cargar_rieles(p[2],p[46]);
                            cargar_alfajias(p[2],p[47]);
                            cargar_cierres(p[2],p[49]);
                            cargar_rejillas(p[2],p[48]);
                            cargar_rodajas(p[2],p[50]);
                            cargar_brazos(p[2],p[56]);
                            cargar_bisagras(p[2],p[57]);
                            mostrar_compuestos();
                            mostrar_servicios(item);
                            mostrar_ventas(item);
                            console.log('paso: '+p[47]);
                           setTimeout(totalizar_aluminio,2500);
                           setTimeout(CargarDatosBasicos,1000);
                           setTimeout(totalizar,2500);
                           if(p[60]!==''){
                               $("#imagen").html(p[60]);
                           }
                            pasar_datos_dt(p[2],p[60]);

                            }
                });
            }
                
                
}
function pasar_datos_dt(id,img){
    var item = $("#item").val();
    $.ajax({
            type: 'GET',
            data:'id='+id+'&sw=2',
            url: '../productos_dos/acciones.php',
            success: function(resultado){
                
                var p = eval(resultado);
                console.log('rieles='+p[34]);
                    if(p[34]=='false'){
                         $("#rieles_new").attr("disabled",true);
                    }else{
                         $("#rieles_new").attr("disabled",false);   
                    }
                    if(p[35]=='false'){
                          $("#alfajias_new").attr("disabled",true);
                    }else{
                          $("#alfajias_new").attr("disabled",false);   
                    }
                    console.log('conf rej:'+p[38]);
                    if(p[38]=='false'){
                         $("#entre_rej").attr("disabled", true).val('0');
                         //$("#rejillas").html("<option value='0'>N/A</option>");
                         $("#rejillas_new").attr("disabled",true);
                    }else{
                        $("#rejillas_new").attr("disabled",false);
                        $("#entre_rej").attr("disabled", false); // pendiente por traer datos de entre
                    }
                    if(p[36]=='false'){
                          $("#cierres_new").attr("disabled",true);
                    }else{
                          $("#cierres_new").attr("disabled",false);   
                    }
                    if(p[45]=='false'){
                          $("#rodajas_new").attr("disabled",true);
                           $("#can_rod").attr("disabled",true).val('0');
                    }else{
                          $("#rodajas_new").attr("disabled",false);  
                           $("#can_rod").attr("disabled",false);
                    }
                    if(p[49]=='false'){
                          $("#brazos_new").attr("disabled",true);
                             $("#can_bra").attr("disabled",true).val('0');
                    }else{
                          $("#brazos_new").attr("disabled",false);
                          $("#can_bra").attr("disabled",false);
                    }
                    if(p[50]=='false'){
                           $("#bisagras_new").attr("disabled",true);
                           $("#can_bis").attr("disabled",true).val('0');
                    }else{
                           $("#bisagras_new").attr("disabled",false);
                           $("#can_bis").attr("disabled",false);
                    }

                    $("#id_pro").val(p[0]);
                    $("#idp").val(id);
                    $("#foto").attr("disabled",false);
                    $("#loadi").attr("disabled",false);
                    $("#codigo0").val(id);
                    $("#linea").val(p[1]);
                    $("#referencia").val(p[6]);
                    $("#sistema").val(p[30]); 
                    $("#anc_general").val(p[3]);
                    if(img==''){
                        $("#imagen").html(p[46]);
                    }
                    
                    $("#tipo").val(p[31]);
                    $("#alt_gener").val(p[5]);
                    $("#hojas").val(p[12]);
                    $("#alt_rejilla").val(p[10]);
                    $("#referencia").val(p[6]);
                    $("#configuracion").val(p[32]);
                    $("#cantidad").val();
                    $("#tipo_vid").val('');
                    $("#espesor_vid").val(p[33]);
                    $("#tipo_riel").val(p[34]);
                    $("#tipo_alfa").val(p[35]);
                    $("#ancho_max").val(p[16]);
                    $("#descripcion0").val(p[4]);
                    $("#tipo_rejilla").val(p[38]);
                    $("#alto_max").val(p[17]);
                    $("#tipo_cie").val(p[36]);
                    $("#cuerpo_fij").val(p[37]);
                    $("#per").val(p[8]);
                    $("#boq").val(p[9]);
                    if(p[8]=='No'){
                        $("#perforacion").val('0').attr("disabled",true);
                    }else{
                        $("#perforacion").val('0').attr("disabled",false);
                    }
                    if(p[9]=='No'){
                        $("#boquetes").val('0').attr("disabled",true);
                    }else{
                        $("#boquetes").val('0').attr("disabled",false);
                    }
                    $("#lam").val(p[15]);
                    $("#espaciadores").val(p[39]);
                    $("#interlayer").val(p[40]);
                    $("#rejilla").val(p[38]);
                    $("#riel").val(p[34]);
                    $("#alfajia").val(p[35]);
                    $("#rodaja").val(p[45]);
                    $("#cierre").val(p[36]);
                    $("#noti").html(p[47]);
                    
                    if(p[41]=='0'){
                        $("#anchocfd").attr("disabled", true).val(p[41]);
                    }else{
                        $("#anchocfd").attr("disabled", false);
                    }
                    if(p[43]=='0'){
                        $("#altocfs").attr("disabled", true).val(p[43]);
                    }else{
                        $("#altocfs").attr("disabled", false);
                    }
                    console.log("ancho cuerpo fijo:"+p[44]);
                    if(p[42]=='0'){
                        $("#anchocfi").attr("disabled", true).val(p[42]);
                    }else{
                        $("#anchocfi").attr("disabled", false);
                    }
                    if(p[44]=='0'){
                        $("#altocfi").attr("disabled", true).val(p[44]);
                    }else{
                        $("#altocfi").attr("disabled", false);
                    }
                    if(p[10]=='0'){
                        $("#altorej").attr("disabled", true).val(p[10]);
                    }else{
                        $("#altorej").attr("disabled", false);  
                    }
                    $("#modulos").val(p[37]);
                            console.log('Modulo: '+p[43]);
                            if(p[37]==1){
                                $("#codigo100").attr("disabled",false);
                                $("#codvidrio100").attr("disabled",false);
                                $("#codigo200").attr("disabled",true);
                                $("#codvidrio200").attr("disabled",true);
                                $("#codigo300").attr("disabled",true);
                                $("#codvidrio300").attr("disabled",true);
                                $("#codigo400").attr("disabled",true);
                                $("#codvidrio400").attr("disabled",true);
                            }else if(p[37]==2){
                                 $("#codigo100").attr("disabled",false);
                                $("#codvidrio100").attr("disabled",false);
                                $("#codigo200").attr("disabled",false);
                                $("#codvidrio200").attr("disabled",false);
                                $("#codigo300").attr("disabled",true);
                                $("#codvidrio300").attr("disabled",true);
                                $("#codigo400").attr("disabled",true);
                                $("#codvidrio400").attr("disabled",true);
                            }else if(p[37]==3){
                                 $("#codigo100").attr("disabled",false);
                                $("#codvidrio100").attr("disabled",false);
                                $("#codigo200").attr("disabled",false);
                                $("#codvidrio200").attr("disabled",false);
                                $("#codigo300").attr("disabled",false);
                                $("#codvidrio300").attr("disabled",false);
                                $("#codigo400").attr("disabled",true);
                                $("#codvidrio400").attr("disabled",true);
                            }else{
                                 $("#codigo100").attr("disabled",false);
                                $("#codvidrio100").attr("disabled",false);
                                $("#codigo200").attr("disabled",false);
                                $("#codvidrio200").attr("disabled",false);
                                $("#codigo300").attr("disabled",false);
                                $("#codvidrio300").attr("disabled",false);
                                $("#codigo400").attr("disabled",false);
                                $("#codvidrio400").attr("disabled",false);
                            }
                            
//                            if(item!=''){;
//                                 pruebas();
//                               // $.when(cargar_alfajias()).then($("#alfajias").val(p[0]));
//                            }
         
                    
            }
           });

}
function update_datos(){
     var item = $("#item").val();
     if(item==''){
         return false;
     }
        var cot = $("#cot").val();
        var lam = $("#laminas").val();
        var cod = $("#codigo0").val();
        var des = $("#descripcion_final").val();
        var des0 = $("#descripcion0").val();
        var ancho = $("#ancho").val();
        var alto = $("#alto").val();
        var cant = $("#cantidad").val();
        var per = $("#perforacion").val();
        var boq = $("#boquetes").val();
        var pelicula = $("#pelicula").val();
        var carton = $("#carton").val();
        var desp = $("#desperdicio").val();
        var despalu = $("#desperdicio_al").val();
        var despacc = $("#desperdicio_acc").val();
        var despesp = $("#desperdicio_esp").val();
        var despint = $("#desperdicio_int").val();
        var inst = $("#instalacion").val();
        var ubc = $("#ubicacion").val();
        var obse = $("#observacion").val();
        var tipo = $("#tipos").val();
        var desc = $("#descuento").val();
        var precio = $("#subtotal").val();
        var estado = $("#estado").val();
       
        var comision = $("#comision").val();
        var reposicion = $("#reposicion").val();
        var imprevisto = $("#imprevisto").val();
        var utilidad = $("#utilidad").val();
        var anchocfd = $("#anchocfd").val();
        var altocfs = $("#altocfs").val();
        var anchocfi = $("#anchocfi").val();
        var altocfi = $("#altocfi").val();
        var altorej = $("#altorej").val();
        var rieles = $("#rieles").val();
        var alfajias = $("#alfajias").val();
        var rejillas = $("#rejillas").val();
        var cierres = $("#cierres").val();
        var rodajas = $("#rodajas").val();
        var entre_rej = $("#entre_rej").val();
        var brazos = $("#brazos").val();
        var bisagras = $("#bisagras").val();
        var can_bis = $("#can_bis").val();
        var can_cie = $("#can_cie").val();
        var can_rod = $("#can_rod").val();
        var can_bra = $("#can_bra").val();
        var anchototal = $("#anchototal").val();
        var altototal = $("#altototal").val(); 
        var color = $("#color").val();
        var compuesto = $("#compuesto").val();
        var traz1 = $("#codigo100").val();
        var traz2 = $("#codigo200").val();
        var traz3 = $("#codigo300").val();
        var traz4 = $("#codigo400").val();
        if(item==''){
            alert("Debes de generar el documento");
            $("#codigo0").focus();
            return false;
        }

    $.ajax({
            post:'GET',
            data:'cod='+cod+'&color='+color+'&traz1='+traz1+'&traz2='+traz2+'&traz3='+traz3+'&traz4='+traz4+'&anchototal='+anchototal+'&altototal='+altototal+'&can_rod='+can_rod+'&can_bra='+can_bra+'&can_cie='+can_cie+'&brazos='+brazos+'&bisagras='+bisagras+'&can_bis='+can_bis+'&compuesto='+compuesto+'&entre_rej='+entre_rej+'&rodajas='+rodajas+'&cierres='+cierres+'&rejillas='+rejillas+'&alfajias='+alfajias+'&rieles='+rieles+'&anchocfd='+anchocfd+'&altocfs='+altocfs+'&anchocfi='+anchocfi+'&altocfi='+altocfi+'&altorej='+altorej+'desc='+desc+'&precio='+precio+'&despesp='+despesp+'&despint='+despint+'&utilidad='+utilidad+'&des='+encodeURIComponent(des)+'&des0='+encodeURIComponent(des0)+'&estado='+estado+'&item='+item+'&cot='+cot+'&lam='+lam+'&ubc='+ubc+'&obse='+obse+'&itemx='+tipo+'&pelicula='+pelicula+'&carton='+carton+'&inst='+inst+'&despvid='+desp+'&despalu='+despalu+'&despacc='+despacc+'&cot='+cot+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&despesp='+despesp+'&despint='+despint+'&utilidad='+utilidad+'&sw=31',
            url:'acciones_alu.php',
            success:function(a){ 
               console.log('Guardado antes. '+a);
               DatosBasicos();
            } 
        });
    
}
function CargarDatosBasicos(){
    var item = $("#item").val();
                    $.ajax({
                    post:'GET',
                    data:'item='+item+'&sw=32',
                    url:'acciones_alu.php',
                    success:function(a){
                        
                        var p = eval(a);   
                        //pasar_datos_dt(p[2]);
                        //laminas_items();
                        cargar_perfiles(p[2],p[46],p[47]);
                        perfiles_rieles(p[2],p[46],p[53]);
                        perfiles_alfajia(p[2],p[47],p[53]);
                       //insumos(cierres,rodajas,brazos,bisagras,canbis,cancie,canrod,canbra)
                        insumos(p[49],p[50],p[56],p[57],p[58],p[59],p[64],p[65]);
                        pre_mostrar_rejilla(p[48],p[51],p[53]);//NO
                        mostrar_instalacion(p[2]); //NO
    
                    }
                });
}
function traz(n){
     var cod = $("#codigo"+n).val();
     $.ajax({
        type:'GET',
        data:'cod='+cod+'&sw=24',
        url:'acciones.php',
                    success : function(t){
                        $("#Trazabilidad").html(t);
                    }
    });
}

function dt(n){
          var cod = $("#codigo"+n).val();
    var codv = $("#codvidrio"+n).val();
    var ancho = $("#ancho"+n).val();
    var alto = $("#alto"+n).val();
    var can = $("#can"+n).val();
    var per = $("#per"+n).val();
    var boq = $("#boq"+n).val();
        var desp = $("#desp"+n).val();
     $.ajax({
        type:'GET',
        data:'cod='+cod+'&codv='+codv+'&desp='+desp+'&per='+per+'&boq='+boq+'&can='+can+'&ancho='+ancho+'&alto='+alto,
        url:'calculos_vidrios_ver.php',
                    success : function(t){
                        $("#costos").html(t);
                    }
    });
}
function dt_calculo(n){
     var cod = $("#codigo"+n).val();
    var codv = $("#codvidrio"+n).val();
    var ancho = $("#ancho"+n).val();
    var alto = $("#alto"+n).val();
    var can = $("#can"+n).val();
    var per = $("#per"+n).val();
    var boq = $("#boq"+n).val();
    var desp = $("#desp"+n).val();

     $.ajax({
        type:'GET',
        data:'cod='+cod+'&codv='+codv+'&desp='+desp+'&per='+per+'&boq='+boq+'&can='+can+'&ancho='+ancho+'&alto='+alto+'&sw=0',
        url:'calculos_vidrios.php',
                    success : function(t){
                        //console.log('mano de obra '+t);
                        var p = eval(t);
                        $("#und"+n).val(p[1]);
                        $("#tot"+n).val(p[2]);
                        $("#tiva"+n).val(p[3]);
                        $("#tmob"+n).val(p[5]);
                        $("#totdes"+n).val(p[6]);
                        $("#gtot"+n).val(p[7]);
                        dt_sumar();
                        save_vidrio(n);
                    }
    });
}
function dt_sumar(){
    
    var total = 0;
    var tund = 0;
    var stotal = 0;
    var tmob = 0;
    var tt = 0;
    var gtot=0;
       $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var und = $("#und"+id).val();
                                var tot = $("#tot"+id).val();
                                var tiva = $("#tiva"+id).val();
                                 var mob = $("#tmob"+id).val();
 
                                 var gtota = $("#gtot"+id).val();
                                 var totdes = $("#totdes"+id).val();

                                
                                tund = parseInt(tund) + parseInt(und);
                                stotal = parseInt(stotal) + parseInt(tot);
                                total = parseInt(total) + parseInt(tiva);
                                tmob = parseInt(tmob) + parseInt(mob);
                                
                                tt = parseInt(tt) + parseInt(totdes);
                                 gtot = parseInt(gtot) + parseInt(gtota);
		});
                $("#tund").val(tund);
                $("#ttot").val(stotal);
                $("#dtot").val(stotal);
                $("#ttiva").val(total);
                $("#tmob").val(tmob);
                 $("#gtot").val(gtot);
                 $("#totdes").val(tt);
                $("#costos").html('');
    
}
function update_costo_item(){

           $("input[name=item]:checked").each(function(){
				var n = $(this).attr("id");
                                
                                dt_calculo(n);
		});
                totalizar();
}

function planilla(){
     var cperfil1 = $("#total_perfil_costo1").val();
     var cperfil2 = $("#total_perfil_costo2").val();
     var cperfil3 = $("#total_perfil_costo3").val();
     var cperfil4 = $("#total_perfil_costo4").val();
     var t_alu = parseFloat(cperfil1) + parseFloat(cperfil2) + parseFloat(cperfil3) + parseFloat(cperfil4);
     var t_vid = $("#dtot").val() * $("#cantidad").val();
     
     var cinsumo1 = $("#total_insumo_costo1").val();
     var cinsumo2 = $("#total_insumo_costo2").val();
     var cinsumo3 = $("#total_insumo_costo3").val();
     var t_acc = parseFloat(cinsumo1) + parseFloat(cinsumo2) + parseFloat(cinsumo3); // total costo de accesorios

     var t_mob = $("#total_fabricacion").val();
     var t_ins = $("#total_instalacion").val();
     var t_pol = $("#tot_peli").val();
     var gt = $("#subtotal").val();
     var desp = $("#desperdicio").val();
     var despalu = $("#desperdicio_al").val();
     var despacc = $("#desperdicio_acc").val();
     var despace = $("#desperdicio_ace").val();
     var totdesvid = $("#totdes").val() * $("#cantidad").val();
     var total_comp_desp = $("#total_comp_desp").val();
     var total_comp = $("#total_comp").val();
     
     var item = $("#item").val();
     var cot = $("#cot").val();
     var utilidad = $("#utilidad").val();

     
     window.open("../costos/planilla_costo.php?item="+item+"&utilidad="+utilidad+"&cot="+cot+"&gt="+gt+"&total_comp="+total_comp+"&totdesvid="+totdesvid+"&total_comp_desp="+total_comp_desp+"&desp="+desp+"&despalu="+despalu+"&despacc="+despacc+"&despace="+despace+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol,"Planilla","width=1200,height=800");
}
function planilla_total(){
     var idcot = $("#idcot").val();
     var gt = $("#subgrantotal").val();
     
     window.open("presupuestos/ventas/reporte_costos.php?gt="+gt+"&idcot="+idcot,"terceros","width=1200,height=800");
}
function totalizarx(){
    var t1 = $("#ttot").val();
    var t2 = 0;
    var t3 = 0;
    var t4 = $("#tot_peli").val();
    var t5 = $("#tacc").val();
    var t6 = $("#total_comp").val();
    var tp = $("#tp").val(); //porcentaje totales 
    var d = ($("#descuento").val()/100);


                total = parseFloat(t1) + parseFloat(t2) + parseFloat(t3) + parseFloat(t4) + parseFloat(t5) + parseFloat(t6);
                totalpor = total;// * (tp/100)
                //total = parseFloat(total) + parseFloat(totalpor);
                totaldes = total * d;
                totalr = total + totaldes;
                console.log(totaldes);
                iva = (totalr * 0.19);
                gt = (totalr + iva);
           
                 
                 $("#gran_descuento").val(totaldes.toFixed(2));
                $("#gran_iva").val(iva.toFixed(2));
                $("#gran_totalpagar").val(gt.toFixed(2));
                $("#gran_subtotal").val(total.toFixed(2));
             
                 calcular_planilla();
    
}
function totalizarbk(){
     var t_alu = 0;
     var t_vid = $("#ttot").val();
     var t_acc = parseFloat($("#total_comp").val()) + parseFloat($("#tacc").val());
     var t_mob = $("#tmob").val();
     var t_ins = 0;
     var t_pol = $("#tot_peli").val();
     var gt = $("#subtotal2").val();
     var d = ($("#descuento").val()/100);
     var desp = $("#desperdicio").val();
     var despalu = $("#desperdicio_al").val();
     var despacc = $("#desperdicio_acc").val();
     var despace = $("#desperdicio_ace").val(); // desperdicio_esp
     
     
             $.ajax({
                    type:'GET',
                    data:'gt='+gt+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&despace='+despace+'&t_alu='+t_alu+'&t_vid='+t_vid+'&t_acc='+t_acc+'&t_mob='+t_mob+'&t_ins='+t_ins+'&t_pol='+t_pol,
                    url:'calculo_costo.php',
                    success : function(t){
                          $("#subtotal").val(t);
                           totaldes = t * d;
                           totalr = parseFloat(t) + parseFloat(totaldes);
                           console.log(totaldes);
                           iva = (totalr * 0.19);
                           gt = parseFloat(totalr + iva);
                          $("#tdescuento").val(totaldes.toFixed(2));
                           $("#subtotal2").val(totalr.toFixed(2));
                           $("#iva").val(iva.toFixed(2));
                           $("#gran_total").val(gt.toFixed(2));
                           
                           total = parseFloat(t_alu) + parseFloat(t_vid-t_mob) + parseFloat(t_acc) + parseFloat(t_mob) + parseFloat(t_ins) + parseFloat(t_pol);
                           $("#costos").html(parseFloat(t_alu) +' + '+ parseFloat(t_vid-t_mob) +' + '+ parseFloat(t_acc) +' + '+  parseFloat(t_mob)  +' + '+  parseFloat(t_ins) +' + '+  parseFloat(t_pol));
                           $("#totalcosto").val(total.toFixed(2));
                    }
                });
     
     //window.open("../costos/planilla_costo.php?gt="+gt+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol,"terceros","width=1200,height=800");
}
//?item=371&utilidad=15&cot=46755&gt=%203469637.01&total_comp=0.00&totdesvid=109210.83&total_comp_desp=0.00&desp=20&despalu=20&despacc=5&despace=30&t_alu=1679548.296&t_vid=90678.00&t_acc=8016&t_mob=14247.00&t_ins=13167&t_pol=0.00
function totalizar(){
    
    var cperfil1 = $("#total_perfil_costo1").val();
    var cperfil2 = $("#total_perfil_costo2").val();
    var cperfil3 = $("#total_perfil_costo3").val();
    var cperfil4 = $("#total_perfil_costo4").val();
     var t_alu = parseFloat(cperfil1) + parseFloat(cperfil2) + parseFloat(cperfil3) + parseFloat(cperfil4);

     var despalu = $("#desperdicio_al").val();// aluminio mas desperdicio
     var t_vid = $("#dtot").val() * $("#cantidad").val() ; //total costo vidrio
     var totdesvid = $("#totdes").val() * $("#cantidad").val();  // vidrio mas desperdicio
     
     var cinsumo1 = $("#total_insumo_costo1").val();
     var cinsumo2 = $("#total_insumo_costo2").val();
     var cinsumo3 = $("#total_insumo_costo3").val();
     var t_acc = parseFloat(cinsumo1) + parseFloat(cinsumo2) + parseFloat(cinsumo3); // total costo de accesorios

     var t_mob = $("#total_fabricacion").val(); // total de mano de obratotdesvid
     var t_ins = $("#total_instalacion").val();
     var t_pol = $("#tot_peli").val(); // total de pelicula
     var gt = $("#subtotal").val();
     var desp = $("#desperdicio").val();    // x no
     
     var despacc = $("#desperdicio_acc").val();// x no
     var despace = $("#desperdicio_ace").val();// x no
     var utilidad = $("#utilidad").val();
     var total_espa = $("#total_comp").val(); // costo de espaciadores e interlayer
     var total_espa_desp = $("#total_comp_desp").val(); // espaciadores  + desperdicio
     
     var d = ($("#descuento").val()/100);
     var item = $("#item").val();

     // gt="+gt+"&total_comp="+total_comp+"&totdesvid="+totdesvid+"&total_comp_desp="+total_comp_desp+"&desp="+desp+"&despalu="+despalu+"&despacc="+despacc+"&despace="+despace+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol
             $.ajax({
                    type:'GET',
                    data:'gt='+gt+'&item='+item+'&utilidad='+utilidad+'&total_espa='+total_espa+'&totdesvid='+totdesvid+'&total_espa_desp='+total_espa_desp+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&despace='+despace+'&t_alu='+t_alu+'&t_vid='+t_vid+'&t_acc='+t_acc+'&t_mob='+t_mob+'&t_ins='+t_ins+'&t_pol='+t_pol,
                    url:'calculo_costo_alu.php',
                    success : function(t){
                          $("#subtotal").val(t);
                           totaldes = t * d;
                           totalr = parseFloat(t) + parseFloat(totaldes);
                           console.log(totaldes);
                           iva = (totalr * 0.19);
                           gt = parseFloat(totalr + iva);
                          $("#tdescuento").val(totaldes.toFixed(2));
                           $("#subtotal2").val(totalr.toFixed(2));
                           $("#iva").val(iva.toFixed(2));
                           $("#gran_total").val(gt.toFixed(2));
                           
                           total = parseFloat(t_alu) + parseFloat(t_vid) + parseFloat(t_acc) + parseFloat(t_mob) + parseFloat(t_ins)+ parseFloat(t_pol) + parseFloat(total_espa);
                           $("#totalcosto").val(total.toFixed(2));
                            $("#costos").html(parseFloat(t_alu) +' + '+ parseFloat(t_vid) +' + '+ parseFloat(t_acc) +' + '+  parseFloat(t_mob)  +' + '+  parseFloat(t_ins) +' + '+  parseFloat(t_pol)+'+' + parseFloat(total_espa));
                           
                    }
                });
     //guardar_total();
     //window.open("../costos/planilla_costo.php?gt="+gt+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol,"terceros","width=1200,height=800");
}
function guardar_total(){
    var total = $("#subtotal").val();
    var item = $("#item").val();
     var cot = $("#cot").val();
    $.ajax({
                    type:'GET',
                    data:'gt='+total+'&item='+item+'&sw=46',
                    url:'acciones_alu.php',
                    success : function(t){
                         window.opener.mostrar_items(cot);
//                         $("#carga").html('');
//                         $("#cargando").modal('hide');
                    }
                });
}
function totalizar_aluminio(){

    var cperfil1 = $("#total_perfil_costo1").val();
    var cperfil2 = $("#total_perfil_costo2").val();
    var cperfil3 = $("#total_perfil_costo3").val();
    var cperfil4 = $("#total_perfil_costo4").val();
    var cvidrio = $("#dtot").val();
    var cinsumo1 = $("#total_insumo_costo1").val();
    var cinsumo2 = $("#total_insumo_costo2").val();
    var cinsumo3 = $("#total_insumo_costo3").val();
    var instalacion = $("#total_instalacion").val();
    var fabricacion = $("#total_fabricacion").val();
    var total_costo = parseFloat(fabricacion) + parseFloat(cperfil1) + parseFloat(cperfil2) + parseFloat(cperfil3) + parseFloat(cperfil4) + parseFloat(cvidrio) + parseFloat(cinsumo1) + parseFloat(cinsumo2) + parseFloat(cinsumo3) + parseFloat(instalacion);
    $("#totalcosto").val(total_costo.toFixed(2));
    
}
function agregar_ven(){
    var cot = $("#idcot").val();
    var cod = $("#v_cod").val();
    var id = $("#v_id").val();
    var descri = $("#v_des").val();
    var col = $("#v_color").val();
    var med = $("#v_med_real").val();
    var can = $("#v_can").val();
    var pre = $("#v_vund").val();
    var pre_r = $("#v_vund_real").val();
    var neto = $("#v_vtot").val();
    var tota = $("#v_pagar").val();
    var des = $("#v_por").val();
    var m = $("#v_med").val();
    
    if(cot===''){
        alert("Debes llenar los datos para generar la cotizacion.");
        return false;
    }
    if(cod===''){
        alert("Debes de escoger un producto.");
        return false;
    }
    if(col===''){
        alert("Debes de escoger un color.");
        return false;
    }
    if(can===''){
        alert("Debes de digitar la cantidad.");
        return false;
    }
    if(des===''){
        alert("Debes de digitar el porcentaje");
        return false;
    }
    $("#btn_ven").attr("disabled", true).html("<img src='../imagenes/load.gif'> Cargando..");
    $.ajax({
                    type:'GET',
                    data:'cot='+cot+'&cod='+cod+'&id='+id+'&descri='+descri+'&col='+col+'&med='+med+'&pre='+pre+'&can='+can+'&pre_r='+pre_r+'&neto='+neto+'&tota='+tota+'&des='+des+'&m='+m+'&sw=20',
                    url:'../vistas/presupuestos/ventas/acciones.php',
                    success : function(t){
                          alert("Se ha guardado con exito .."+t);
                          mostrar_ventas();
                          limpiar_vnt();
                          $("#btn_ven").attr("disabled", false).html("Agregar");
                    }
                });
}

function limpiar_vnt(){
 
    var cod = $("#v_cod").val('');
    var id = $("#v_id").val('');
    var descri = $("#v_des").val('');
    var col = $("#v_color").val('');
    var med = $("#v_med_real").val('');
    var can = $("#v_can").val('');
    var pre = $("#v_vund").val('');
    var pre_r = $("#v_vund_real").val('');
    var neto = $("#v_vtot").val('');
    var tota = $("#v_pagar").val('');
    var des = $("#v_por").val('');
    var m = $("#v_med").val('');
    $("#btn_buscar_vnt").focus();
}
function del_ventas(id){
    var item = $("#item").val();
    var c = confirm("Esta seguro de eliminar este registro ? ");
    if(c){
        $("#btn_del_ven").attr("disabled", true).html("<img src='../imagenes/load.gif' style='width:20px'> Eliminando..");
            $.ajax({
                    type:'GET',
                    data:'id='+id+'&sw=22',
                    url:'acciones.php',
                    success : function(t){
                        if(t==='1'){
                            alert("se ha eliminado con exito ");
                        }else{
                            alert("Ocurrio un error, intentelo de nuevo ");
                        }
                          mostrar_ventas(item);
                       
                          window.opener.mostrar_ventas();
                    }
                });
            }
}
function calcular_perfil(){
    var can = $("#v_can").val();
    var pre = $("#v_vund").val();
    var med = $("#v_med_real").val();
    var des = $("#v_por").val();
    var m = $("#v_med").val();
    if(m==='1'){
        var medr = 1;
    }else{
       var medr = med / 1000;
    }
    var n = medr * parseInt(pre);
    $("#v_vund_real").val(n);
    
    t = n * can;
    d = t * (des / 100);
    tot = parseInt(t) + parseInt(d);
    iva = tot * 0.19;
    total = parseInt(tot) + parseInt(iva);
    $("#v_vtot").val(tot);
    $("#v_pagar").val(total);
}


function pre(){
    var cot = $("#idcot").val();
    mostrar_items(cot);
}

function referencias(){
    window.open("../vistas/lista_vidrios.php?linea=Vidrio","terceros","width=800,height=600");
}


function mostrar_items(cot){
    var  ser = $("#ser").val();
     var  est = $("#est").val();
      $.ajax({
            post:'GET',
            data:'cot='+cot+'&ser='+ser+'&est='+est+'&sw=7',
            url:'../vistas/presupuestos/ventas/acciones.php',
            success:function(a){
                $("#boton").html('<button onclick="agregar_item();" id="bot" disabled>Agregar</button>');
               $("#mostrar_lineas").html(a);
              
            } 
        });
}
function validar_vidrios(){
    var cot = $("#idcot").val();
    $.ajax({
        type:'GET',
        data:'cot='+cot+'&sw=36',
        url:'../vistas/presupuestos/ventas/acciones.php',
        success : function(r){
            console.log(r);
            var p = eval(r);
            if(p[0]==='disabled'){
                      $("#desperdicio").attr("disabled", true);
                      $("#desperdicio_al").attr("disabled", true);
                      $("#desperdicio_acc").attr("disabled", true);
                      $("#desperdicio_ace").attr("disabled", true);
                      $("#desperdicio_esp").attr("disabled", true);
                      $("#desperdicio_int").attr("disabled", true);
                      $("#utilidad").attr("disabled", true);
                  }else{
                      $("#desperdicio").attr("disabled", false);
                      $("#desperdicio_al").attr("disabled", false);
                      $("#desperdicio_acc").attr("disabled", false);
                      $("#desperdicio_ace").attr("disabled", false);
                      $("#desperdicio_esp").attr("disabled", false);
                      $("#desperdicio_int").attr("disabled", false);
                      $("#utilidad").attr("disabled", false);
                  }
                   $("#mensajes").html(p[1]);
        }
    });
}
function del_item(item, id){
    var cot = $("#idcot").val();
     con = confirm("Esta seguro de quitar este items?");
     if(con){
         $("#boton"+item).html(" <img src='../images/load.gif'>Eliminando.. ");
      $.ajax({
            post:'GET',
            data:'id='+id+'&sw=8',
            url:'../vistas/presupuestos/ventas/acciones.php',
            success:function(a){
               mostrar_items(cot);
              
            } 
        });
    }else{
        return false;
    }
}
function rep_item(item, id){
    var cot = $("#idcot").val();
    var rep = $("#rep"+item).val();
     var ct = $("#ct").val();
     con = confirm("Esta seguro de repetir este items?");
     if(con){
         $("#boton"+item).html(" <img src='../images/load.gif'>Duplicando.. ");
      $.ajax({
            post:'GET',
            data:'id='+id+'&ct='+ct+'&rep='+rep+'&sw=9',
            url:'../vistas/presupuestos/ventas/acciones.php',
            success:function(a){
                console.log(a);
               mostrar_items(cot);
              
            } 
        });
    }else{
        return false;
    }
}
function lista_vidrios(item){
     window.open("../combos/lista_vidrios.php?item="+item,"terceros","width=500,height=400");
}
function lista_vidrios2(item){
     window.open("../combos/lista_vidrios_1.php?item="+item,"terceros","width=500,height=400");
}
function lista_vidrios3(item){
     window.open("../combos/lista_vidrios_2.php?item="+item,"terceros","width=500,height=400");
}
function lista_vidrios4(item){
     window.open("../combos/lista_vidrios_3.php?item="+item,"terceros","width=500,height=400");
}
function sumaritem(){
    var ct = $("#ct").val();
    gt = 0;ctt = 0;
    for(i=1;i<=ct;i++){
        var piva = $("#piva"+i).val();
        var cant = $("#cant"+i).val();
        gt = parseInt(gt) + parseInt(piva);
        ctt = parseInt(ctt) + parseInt(cant);
    }
    $("#grantotal").val(gt);
    $("#cantotal").val(ctt);
    
}
function save_item(){
    var cot = $("#cot").val();
     var lam = $("#laminas").val();
    var cod = $("#codigo0").val();
    var des = $("#descripcion_final").val();
    var des0 = $("#descripcion0").val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var pelicula = $("#pelicula").val();
    var carton = $("#carton").val();
    var desp = $("#desperdicio").val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var inst = $("#instalacion").val();
    var ubc = $("#ubicacion").val();
    var obse = $("#observacion").val();
    var item = $("#tipos").val();
    var desc = $("#descuento").val();
    var precio = $("#subtotal").val();
    var estado = $("#estado").val();
    var item = $("#item").val();
    var comision = $("#comision").val();
    var reposicion = $("#reposicion").val();
    var imprevisto = $("#imprevisto").val();
    var utilidad = $("#utilidad").val();
    
    var anchocfd = $("#anchocfd").val();
    var altocfs = $("#altocfs").val();
    var anchocfi = $("#anchocfi").val();
    var altocfi = $("#altocfi").val();
    var altorej = $("#altorej").val();
    
    var anchototal = $("#anchototal").val();
    var altototal = $("#altototal").val();

    
    var rieles = $("#rieles").val();
    var alfajias = $("#alfajias").val();
    var rejillas = $("#rejillas").val();
    var cierres = $("#cierres").val();
    var rodajas = $("#rodajas").val();
    
    var brazos = $("#brazos").val();
    var bisagras = $("#bisagras").val();
    var can_bis = $("#can_bis").val();
    var can_cie = $("#can_cie").val();
     var can_rod = $("#can_rod").val();
    var can_bra = $("#can_bra").val();
    
    var entre_rej = $("#entre_rej").val();
    var linea = $("#linea").val();
    var color = $("#color").val();
    var comp = $("#compuesto").val();
    
    var traz1 = $("#codigo100").val();
    var traz2 = $("#codigo200").val();
    var traz3 = $("#codigo300").val();
    var traz4 = $("#codigo400").val();
    
    if(cod==''){
        alert("Seleccione el codigo");
        $("#codigo0").focus();
        return false;
    }
    if(ancho==''){
        $("#codigo100").val('');
        alert("Digite el ancho del producto");
        $("#ancho").focus();
        return false;
    }
    if(alto==''){
       
        alert("Digite el alto del producto");
         $("#codigo100").val('');
                $("#alto").focus();
        return false;
    }
    if(cant==''){
         $("#codigo100").val('');
        alert("Digite la cantidad");
        $("#cantidad").focus();
       
        return false;
    }
        if(anchocfd==''){
        alert("Digite el ancho del cuerpo fijo");
        $("#anchocfd").focus();
        return false;
    }
    if(altocfs==''){
        alert("Digite el alto cuerpo fijo superior");
        $("#altocfs").focus();
        return false;
    }
    if(anchocfi==''){
        alert("Digite el ancho cuerpo fijo inferior");
        $("#anchocfi").focus();
        return false;
    }
    if(altocfi==''){
        alert("Digite el alto cuerpo fijo inferior");
        $("#altocfi").focus();
        return false;
    }
    if(altorej==''){
        alert("Digite el alto de la rejilla");
        $("#altorej").focus();
        return false;
    }
    if(color==''){
        alert("Seleccione el color");
        $("#codigo100").val('');
        $("#color").focus();
        
        return false;
    }
    if($("#riel").val()=='true'){
        if($("#rieles").val()==''){
            
            alert("Seleccione el riel");
             $("#codigo100").val('');
            $("#rieles").focus();
            
            return false;
        }
    }
    if($("#alfajia").val()=='true'){
        if($("#alfajias").val()==''){
            
            alert("Seleccione la alfajia");
            $("#codigo100").val('');
            $("#alfajias").focus();
            
            return false;
        }
    }
    if($("#rejilla").val()=='true'){
        if($("#rejillas").val()==''){
          
            alert("Seleccione la rejilla");
            $("#codigo100").val('');
            $("#alfajias").focus();
           
            return false;
        }
    }
    if($("#cierre").val()=='true'){
        if($("#cierres").val()==''){

            alert("Seleccione el cierre");
            $("#codigo100").val('');
            $("#cierres").focus();
            return false;
        }
    }
    if($("#rodaja").val()=='true'){
        if($("#rodajas").val()==''){

            alert("Seleccione la rodaja");
            $("#codigo100").val('');
            $("#rodajas").focus();
            
            return false;
        }
    }
    $.ajax({
            post:'GET',
            data:'cod='+cod+'&linea='+linea+'&traz1='+traz1+'&traz2='+traz2+'&traz3='+traz3+'&traz4='+traz4+'&can_cie='+can_cie+'&can_bra='+can_bra+'&can_rod='+can_rod+'&anchototal='+anchototal+'&altototal='+altototal+'&color='+color+'&brazos='+brazos+'&bisagras='+bisagras+'&can_bis='+can_bis+'&comp='+comp+'&entre_rej='+entre_rej+'&rodajas='+rodajas+'&cierres='+cierres+'&rejillas='+rejillas+'&alfajias='+alfajias+'&rieles='+rieles+'&anchocfd='+anchocfd+'&altocfs='+altocfs+'&anchocfi='+anchocfi+'&altocfi='+altocfi+'&altorej='+altorej+'&des='+encodeURIComponent(des)+'&des0='+encodeURIComponent(des0)+'&estado='+estado+'&item='+item+'&cot='+cot+'&lam='+lam+'&ubc='+ubc+'&obse='+obse+'&item='+item+'&pelicula='+pelicula+'&carton='+carton+'&inst='+inst+'&despvid='+desp+'&despalu='+despalu+'&despacc='+despacc+'&cot='+cot+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&precio='+precio+'&comision='+comision+'&reposicion='+reposicion+'&imprevisto='+imprevisto+'&utilidad='+utilidad+'&sw=27',
            url:'acciones_alu.php',
            success:function(a){
                var p = eval(a);
               $("#estado").val('En proceso');
               $("#item").val(p[0]);
               window.opener.idglobal=p[0];
               laminas_items();
               console.log(p[1]);
            } 
        });
    
}

function save_vidrio(n){
    //alert('paso'+n);
    var cot = $("#cot").val();
     var lam = $("#laminas").val();
    var cod = $("#codvidrio"+n).val();
    var traz = $("#codigo"+n).val();
    var des0 = $("#descripcion"+n).val();
    var des = $("#desvidrio"+n).val();
    var ancho = $("#ancho"+n).val();
    var alto = $("#alto"+n).val();
    var cant = $("#can"+n).val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var pelicula = $("#pelicula").val();
    var carton = $("#carton").val();
    var desp = $("#desp"+n).val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var inst = $("#instalacion").val();
    var ubc = $("#ubicacion").val();
    var obse = $("#observacion").val();
    var itemv = $("#item"+n).val();
    var desc = $("#descuento").val();
    var precio = $("#tot"+n).val();
    var estado = $("#estado").val();
    var item = $("#item").val();
    var idlam = $("#idlam"+n).val();
    var comision = $("#comision").val();
    var reposicion = $("#reposicion").val();
    var imprevisto = $("#imprevisto").val();
    var utilidad = $("#utilidad").val();
    var mobt = $("#tmob"+n).val();
    var idparvid = $("#idparvid"+n).val();
    var desparvid = $("#desparvid"+n).val();
    var modulo = $("#idmodulo"+n).val();
    
    var traz1 = $("#codigo100").val();
    var traz2 = $("#codigo200").val();
    var traz3 = $("#codigo300").val();
    var traz4 = $("#codigo400").val();
    var hor = $("#hor").val();
    var ver = $("#ver").val();
    
    $.ajax({
            post:'GET',
            data:'cod='+cod+'&hor='+hor+'&ver='+ver+'&traz1='+traz1+'&traz2='+traz2+'&traz3='+traz3+'&traz4='+traz4+'&idparvid='+idparvid+'&modulo='+modulo+'&desparvid='+desparvid+'&traz='+traz+'&mob='+mobt+'&des='+encodeURIComponent(des)+'&des0='+encodeURIComponent(des0)+'&estado='+estado+'&idlam='+idlam+'&item='+item+'&cot='+cot+'&lam='+lam+'&ubc='+ubc+'&obse='+obse+'&itemv='+itemv+'&pelicula='+pelicula+'&carton='+carton+'&inst='+inst+'&despvid='+desp+'&despalu='+despalu+'&despacc='+despacc+'&cot='+cot+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&precio='+precio+'&comision='+comision+'&reposicion='+reposicion+'&imprevisto='+imprevisto+'&utilidad='+utilidad+'&sw=28',
            url:'acciones_alu.php',
            success:function(a){
                var p = eval(a);
               $("#idlam"+n).val(p[0]);
               console.log('error '+a);
               
               totalizar();
            } 
        });   
}
function save_laminado(){
    $("input[name=item]:checked").each(function(){
                     var id = $(this).attr("id");
                      dt_calculo(id);            
		});
}
function imprimir(){ 
      var cot = $("#idcot").val();
      var ct = $("#ct").val();
      var col = $("#columnas").val();
     if(cot!==''){
    window.open("presupuestos/ventas/imprimir_vidrios.php?cot="+cot+"&total_item="+ct+"&col="+col+"&ciudad=Barranquilla","Imprimir","width=1200,height=800");
     }
}

function nuevo(){
    window.location.href='../vistas/sala_ventas.php';
}
function porcentajes(){
      var cot = $("#idcot").val();
      var cli = $("#idc").val();
     window.open("../vistas/porcentajes.php?cot="+cot+"&cli="+cli+"","Porcentajes","width=1200,height=800");
    
}
function porcentajes_ventas(){
      var cot = $("#idcot").val();
      var cli = $("#idc").val();
      var max = $("#max").val();
     window.open("../vistas/porcentajes.php?cot="+cot+"&cli="+cli+"&max="+max,"Porcentajes","width=1200,height=800");
    
}
function vendedor(usu){
    $("#ase").val(usu);
}
function obtener_usuario(nombre){
    $("#ase").val(nombre);
}
function obtener_municipio(nombre){
    $("#ciu").val(nombre);
}
function pasar_tercero(cod,nom,idt,dir,tel,ciu,mun,des){
                $("#idc").val(idt);
                $("#cli").val(nom);
                $("#dir").val(dir);
                $("#tel").val(tel);
                $("#dep").val(mun);
                $("#ciu").val(ciu);
                $("#max").val(des);
                $("#doc").val(cod);
}
function nuevo_aluminio(){

 
    window.opener.idglobal='';
    location.reload();

}

function trazabilidad_lamina(cod,n){
    $.ajax({
                    post:'GET',
                    data:'cod='+cod+'&n='+n+'&sw=48',
                    url:'acciones_alu.php',
                    success:function(a){
                        $("#mod"+n).html(a);   
                    }
                });
}

function pruebas(){

    var item = $("#item").val();
    $.ajax({
            post:'GET',
            data:'item='+item+'&sw=32.1',
            url:'acciones_alu.php',
            success:function(a){
                var p = eval(a);
                
                $("#rieles").val(p[0]);
                $("#alfajias").val(p[1]);
                $("#rejillas").val(p[2]);
                $("#cierres").val(p[3]);
                $("#rodajas").val(p[4]);
                $("#entre_rej").val(p[5]);
                 
                 
            } 
        });
    $("#alfajias").val('21');
}
function obtener_variables(){
    var idcot = window.opener.$("#idcot").val();
    alert("obteniendo datos "+idcot);

}
function get_referencias(n){
     linea = $("#linea").val();

     if(n==0){
          linea = $("#linea").val();
  
     }else{
          linea = 'Vidrio';
     }
    window.open("../../../popup/dt/?linea="+linea+'&n='+n,"Referencias","width=900,height=600");
}
function get_referencias2(n){
          linea = 'Vidrio';
    window.open("../../../popup/dt/?linea="+linea+'&n='+n,"Referencias","width=900,height=600");
}
function form_vidrio(i){
    var cod = $("#codigo").val();
    if(cod==''){
        alert("Debes de seleccionar el codigo principal.");
        return false;
        
    }
    window.open("../../../popup/tipo_vidrios/?n="+i,"Tipos","width=900,height=600");
}
function pasar_vidrio(cod,de,n){
     $("#codvidrio"+n).val(cod);
      $("#desvidrio"+n).val(de);
       dt_calculo(n);
       concatenar();
       if(n==0){
           $("#ancho").focus();    
       }
       if(n>=100 && n<1000){
           pasar_codvidrios(n);
           CargarDatosBasicos();
       }
}
function concatenar(){
    var des = $("#descripcion0").val();
    var dest = '';
    var codigo = '';
    
    $("input[name=item]:checked").each(function(){
                     var id = $(this).attr("id");
                     var de = $("#desvidrio"+id).val();
                     var cod = $("#codigo"+id).val();
                      var descripcion = $("#descripcion"+id).val();
                     if(codigo==''){
                         dest = descripcion + ' '+ de;
                     }else{
                         dest = dest + '+ '+ descripcion + ' '+ de;
                     }
                     codigo = cod;                  
		});
     conca = dest; 
     var linea = $("#linea").val();
     if(linea=='Vidrio'){
         $("#descripcion_final").val(conca);
     }else{
         $("#descripcion_final").val(des);
     }
    
    
}
function obtener_dt(cod,des,n,lam){
    if(n==0){
        pasar_datos_dt(cod);
         $("#ancho").focus();
    }
    if(lam>=2){
         $("#mod"+n).html('<button onclick="lam_ventanas('+n+')">Laminado</button>');
    }else{
       
    }
    $("#codigo"+n).val(cod);
    $("#descripcion"+n).val(des);
          dt_calculo(n);
    if(n>=100 && n<1000){
        pasar_vidrios(n);
    }
    
            
}
function tabla_espaciadores2(n){ 
      var cod = $("#con_cod").val();
      window.open("../popup/interlayer/index.php?cod="+cod+"&num="+n,"Imprimir","width=900,height=600");
}

function pasar_vidrios(n){
    var modulo = $("#modulos").val();
    
    
    for(i=1;i<=modulo;i++){
        var cod = $("#codigo"+i+"00").val();
        var desc = $("#descripcion"+i+"00").val();
       console.log(desc+' n: '+n);
        $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var modu = $("#idmodulo"+id).val();
                                console.log('contador'+i+' modulo '+modu+' , cod:'+cod+' , descr:'+desc+' - id item:'+id);
                                if(i==modu){
                                    $("#codigo"+id).val(cod);
                                   $("#descripcion"+id).val(desc);
                                   dt_calculo(id);
                                 }
		});
        
    }
}
function codvidrios(){
    $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var modu = $("#idmodulo"+id).val();
                                var cod = $("#codigo"+id).val();
                                var desc = $("#descripcion"+id).val();
                                var cod2 = $("#codvidrio"+id).val();
                                var desc2 = $("#desvidrio"+id).val();

                                $("#codvidrio"+modu+"00").val(cod2);
                                $("#desvidrio"+modu+"00").val(desc2);
		});
}
function pasar_codvidrios(n){
    var modulo = $("#modulos").val();

    for(i=1;i<=modulo;i++){
        var cod = $("#codvidrio"+i+"00").val();
        var desc = $("#desvidrio"+i+"00").val();
       console.log(desc+' n: '+n);
        $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var modu = $("#idmodulo"+id).val();
                                console.log('contador'+i+' modulo '+modu+' , cod:'+cod+' , descr:'+desc+' - id item:'+id);
                                if(i==modu){
                                    $("#codvidrio"+id).val(cod);
                                   $("#desvidrio"+id).val(desc);
                                   dt_calculo(id);
                                 }

		});
        
    }
}

function precios_interlayer(n){
    var item = $("#item").val();
    var cot = $("#cot").val();
    var idins = $("#idins"+n).val();
     var cod = $("#inter"+n).val();
     var des = $("#desp_mat"+n).val();
     var dtx = $("#con_cod").val();
     var can = $("#cantidad").val();
     var ancho = $("#anchoi"+n).val();
     var alto = $("#altoi"+n).val();
     var tipo = $("#tipomat"+n).val();
     console.log(dtx);
             $.ajax({
            post:'GET',
            data:'cod='+cod+'&dt='+dtx+'&tipo='+tipo+'&item='+item+'&cot='+cot+'&idins='+idins+'&can='+can+'&n='+n+'&ancho='+ancho+'&alto='+alto+'&desp='+des+'&extra=No&sw=25',
            url:'acciones.php',
            success:function(a){
                var p = eval(a);
               $("#und_int"+n).val(p[0]);
               $("#tot_int"+n).val(p[1]);
               $("#mtc_int"+n).val(p[2]);
               $("#med_int"+n).val(p[3]);
               $("#iteme"+n).val(p[5]);
               $("#idpp"+n).val(p[6]);
               $("#idins"+n).val(p[7]);
                $("#tot_desp"+n).val(p[8]);
               console.log(p[4]);
//               sumar_interlayer();
//               totalizar();
            } 
        });
    }
    function sumar_interlayer(){
        var tt = 0;
        var td = 0;
         $("input[name=item2]:checked").each(function(){
				var n = $(this).attr("id");
                                var tot = $("#tot_int"+n).val();
                                var totdes = $("#tot_desp"+n).val();
                                tt = parseFloat(tt) + parseFloat(tot);
                                 td = parseFloat(td) + parseFloat(totdes);
                               
		});
               $("#total_comp").val(tt);
                $("#total_comp_desp").val(td);
    }
function agregar_compuesto(){
    var item = $("#item").val();
    var cot = $("#cot").val();
    var idins = $("#idins").val();
     var cod = $("#extra_comp").val();
     var des = $("#despacc").val();
     var dtx = $("#codigo0").val();
     var can = $("#cantidad").val();
     var ancho = $("#ancho").val();
     var alto = $("#alto").val();
     console.log(dtx);
             $.ajax({
            post:'GET',
            data:'cod='+cod+'&dt='+dtx+'&item='+item+'&cot='+cot+'&idins='+idins+'&can='+can+'&ancho='+ancho+'&alto='+alto+'&desp='+des+'&extra=Si&sw=25',
            url:'acciones.php',
            success:function(a){
                var p = eval(a);
               $("#precio_unidad").val(p[0]);
               $("#precio_total").val(p[1]);
               $("#mtc_int_comp").val(p[2]);
               $("#med_int_comp").val(p[3]);
               $("#idins").val(p[7]);
               console.log(p[4]);
               alert('Sa agrego con exito');
               extras_comp();
               totalizar();
            } 
        });
    }
    function limpiar_form_extra(){
         $("#idins").val('');
         $("#extra_comp").val('');
         //$("#extra_codigo").val('');
         $("#extra_comp").val('');
         $("#mtc_int_comp").val('');
         $("#precio_unidad").val('');
         $("#precio_total").val('');
         $("#modalmasacc").modal('hide');
    }
    function extras_comp(){
        var dtx = $("#item").val();
        var can = $("#cantidad").val();
        $.ajax({
             post:'GET',
             data:'dtx='+dtx+'&can='+can+'&sw=29',
             url:'acciones.php',
             success : function(r){
                 console.log('paso '+dtx+' - '+r);
                 $("#mostrar_comp_extra").html(r);
             }
         });
    }
    function mas_acc(n){
        var tesp = $("#totalesp").val();
        $("#modalmasacc").modal('show');
         var item = $("#iteme"+n).val();
         var inter = $("#inter"+n).val();
         $("#extra_item").val(item);
         $("#extra_codigo").val(inter);
         var idpp = $("#idpp"+n).val();
          var codigo = $("#codigo0").val();
          console.log(idpp);
         $.ajax({
             post:'GET',
             data:'codigo='+codigo+'&codigoitem='+inter+'&item='+item+'&idpp='+idpp+'&sw=26',
             url:'acciones.php',
             success : function(r){
                 $("#extra_comp").html(r);
             }
         });
         
    }
    function borrar_comp(id){
         var item = $("#item").val();
         var c = confirm("Esta seguro de eliminar este item?");
         if(c){
            $.ajax({
                 post:'GET',
                 data:'id='+id+'&sw=30',
                 url:'acciones.php',
                 success : function(r){
                     DatosBasicos();
                 }
             });
       }
    }
    function calcular_item(n,item,gen){
        var cant = $("#cant"+n).val();
        var ancho = $("#ancho"+n).val();
        var alto = $("#alto"+n).val();
        var per = $("#per"+n).val();
        var boq = $("#boq"+n).val();
        var desc = $("#desc"+n).val();
        var cod = $("#cod"+n).val();
        var itemv = $("#tipo"+n).val();
        var ubc = $("#ubc"+n).val();
        var obse = $("#obse"+n).val();
        var por_vid = $("#desperdicio").val();
        var por_alu = $("#desperdicio_al").val();
        var por_acc =$("#desperdicio_acc").val();
        var por_ace= $("#desperdicio_ace").val();
        var por_esp =$("#desperdicio_esp").val();
        var por_int= $("#desperdicio_int").val();
        var utilidad= $("#utilidad").val();
        var pel = $("#pel").val();
        var ins = $("#ins").val();

        //alert(por_vid);
        $.ajax({
                 post:'GET',
                 data:'item='+item+'&utilidad='+utilidad+'&gen='+gen+'&ubc='+ubc+'&por_esp='+por_esp+'&por_int='+por_int+'&obse='+obse+'&itemv='+itemv+'&cod='+cod+'&pel='+pel+'&ins='+ins+'&cant='+cant+'&ancho='+ancho+'&alto='+alto+'&per='+per+'&boq='+boq+'&desc='+desc+'&por_vid='+por_vid+'&por_alu='+por_alu+'&por_acc='+por_acc+'&por_ace='+por_ace,
                 url:'presupuestos/ventas/calcular_general_alu.php',
                 success : function(r){
                   console.log(r);
                   var p = eval(r);
                   
                   
                   
                   $("#pud"+n).val(p[0]);
                   $("#ptd"+n).val(p[1]);
                   $("#piva"+n).val(p[2]);
                   sumar_item_cot();
                 }
             });
        
    }
        function update_costo_por_itemx(){
            if(!navigator.onLine){
                alert('uff sin conexion :(');
                return false;
            }
            
            var cant = $("#cantidad").val();
            var ancho = $("#ancho").val();
            var alto = $("#alto").val();
            var per = $("#perforacion").val();
            var boq = $("#boquetes").val();
            var desc = $("#descripcion_final").val();
            var cod = $("#codigo0").val();
            var itemv = $("#tipos").val();
            var ubc = $("#ubicacion").val();
            var obse = $("#observacion").val();
            var por_vid = $("#desperdicio").val();
            var por_alu = $("#desperdicio_al").val();
            var por_acc =$("#desperdicio_acc").val();
            var por_ace= $("#desperdicio_ace").val();
            var por_esp =$("#desperdicio_esp").val();
            var por_int= $("#desperdicio_int").val();
            var pel = $("#pelicula").val();
            var ins = $("#instalacion").val();
            var comision = $("#comision").val();
            var reposicion = $("#reposicion").val();
            var imprevisto = $("#imprevisto").val();
            var utilidad = $("#utilidad").val();
            var item = $("#item").val();
            var cot = $("#cot").val();
            
            var anchocfd = $("#anchocfd").val();
            var altocfs = $("#altocfs").val();
            var anchocfi = $("#anchocfi").val();
            var altocfi = $("#altocfi").val();
            var altorej = $("#altorej").val();
            if(item===''){
                return false;
            }
            idglobal=item;
            $.ajax({
                     post:'GET',
                     data:'item='+item+'&rej='+altorej+'&ancfd='+anchocfd+'&ancfi='+anchocfi+'&alcfs='+altocfs+'&alcfi='+altocfi+'&ubc='+ubc+'&ubc='+ubc+'&ubc='+ubc+'&ubc='+ubc+'&ubc='+ubc+'&ubc='+ubc+'&por_esp='+por_esp+'&por_int='+por_int+'&obse='+obse+'&itemv='+itemv+'&cod='+cod+'&pel='+pel+'&ins='+ins+'&cant='+cant+'&ancho='+ancho+'&alto='+alto+'&per='+per+'&boq='+boq+'&desc='+desc+'&comision='+comision+'&reposicion='+reposicion+'&imprevisto='+imprevisto+'&utilidad='+utilidad+'&por_vid='+por_vid+'&por_alu='+por_alu+'&por_acc='+por_acc+'&por_ace='+por_ace,
                     url:'calcular_general_alu.php',
                     success : function(r){
                        window.opener.mostrar_items(cot);
                       var p = eval(r);
                       console.log('resultado calculo general: '+p[3]);
                       DatosBasicos();
                     }
                 });
        
    }
    function update_costo_general(){
         var idcot = $("#idcot").val();
         var por_vid = $("#desperdicio").val();
         var por_alu = $("#desperdicio_al").val();
         var por_acc =$("#desperdicio_acc").val();
         var por_ace= $("#desperdicio_ace").val();
         var por_esp =$("#desperdicio_esp").val();
         var por_int= $("#desperdicio_int").val();
         var utilidad= $("#utilidad").val();
              $.ajax({
                 post:'GET',
                 data:'idcot='+idcot+'&utilidad='+utilidad+'&por_vid='+por_vid+'&por_alu='+por_alu+'&por_acc='+por_acc+'&por_ace='+por_ace+'&por_int='+por_int+'&por_esp='+por_esp+'&sw=33',
                 url:'presupuestos/ventas/acciones.php',
                 success : function(r){
                     console.log(r);
                 }
             });
         
    }

    function sumar_item_cot(){
            var total = 0;
            var stotal = 0;
            var can = 0;
            var id = $("#ct").val();
      for(i=1; i<=id; i++){
				
                                var tot = $("#ptd"+i).val();
                                var tiva = $("#piva"+i).val();
                                can = parseFloat(can) + parseFloat($("#cant"+i).val());
                                stotal = parseFloat(stotal) + parseFloat(tot);
                                total = parseFloat(total) + parseFloat(tiva);
		};
                $("#subgrantotal").val(stotal);
                $("#grantotal").val(total);
                 $("#cantotal").val(can);
                 
                 $("#gran_subtotal").val(stotal);
                  $("#gran_iva").val((total-stotal).toFixed(2));
                $("#gran_totalpagar").val(total);
                 
    }
      function update_costo(gen){
          if(!navigator.onLine){
                alert('uff sin conexion :(');
                return false;
            }
            
          var ca = $("#ct").val();
          for(i=1; i<=ca; i++){
              var id = $("#idtem"+i).val();
              calcular_item(i,id,gen);
              
          }
          
      }
      function sumar_p(){
           var a = $("#comision").val();
            var b = $("#reposicion").val();
             var c = $("#imprevisto").val();
              var d = $("#utilidad").val();
              var t = parseFloat(a) + parseFloat(b)+parseFloat(c)+parseFloat(d);
              $("#tp").val(t);
      }
function tabla_espaciadores(n){ 
      var cod = $("#codigo0").val();
      window.open("../popup/interlayer/index.php?cod="+cod+"&num="+n,"Imprimir","width=900,height=600");
}
function obtener_inter(cod,des,n,tipo){
    $("#inter"+n).val(cod);
    $("#interdes"+n).val(des);
    $("#tipomat"+n).val(tipo);
    var por_esp =$("#desperdicio_esp").val();
    var por_int= $("#desperdicio_int").val();
    if(tipo=='espaciadores'){
        $("#desp_mat"+n).val(por_esp);
    }else{
        $("#desp_mat"+n).val(por_int);
    }
    
    precios_interlayer(n);
    
}
function cargar_rieles(cod,id){
    
    $.ajax({
         type:'GET',
                    data:'cod='+cod+'&id='+id+'&sw=37',
                    url:'acciones_alu.php',
                    success : function(t){
                          $("#rieles_new").val(t);

                    }
    });
}
function cargar_alfajias(cod,id){
    
    $.ajax({
         type:'GET',
                    data:'cod='+cod+'&id='+id+'&sw=37',
                    url:'acciones_alu.php',
                    success : function(t){
                          $("#alfajias_new").val(t);

                    }
    });
}
function cargar_cierres(cod,id){
    
    $.ajax({
         type:'GET',
                    data:'cod='+cod+'&id='+id+'&sw=39.1',
                    url:'acciones_alu.php',
                    success : function(t){
                          $("#cierres_new").val(t);

                    }
    });
}
function cargar_rodajas(cod,id){
    
    $.ajax({
         type:'GET',
                    data:'cod='+cod+'&id='+id+'&sw=40.11',
                    url:'acciones_alu.php',
                    success : function(t){
                          $("#rodajas_new").val(t);

                    }
    });
}
function cargar_brazos(cod,id){
    $.ajax({
         type:'GET',
                    data:'cod='+cod+'&id='+id+'&sw=40.11',
                    url:'acciones_alu.php',
                    success : function(t){
                          $("#brazos_new").val(t);

                    }
    });
}
function cargar_bisagras(cod,id){
    $.ajax({
         type:'GET',
                    data:'cod='+cod+'&id='+id+'&sw=40.11',
                    url:'acciones_alu.php',
                    success : function(t){
                          $("#bisagras_new").val(t);

                    }
    });
}
function cargar_rejillas(cod,id){
    
    $.ajax({
         type:'GET',
                     data:'cod='+cod+'&id='+id+'&sw=41.1',
                    url:'acciones_alu.php',
                    success : function(t){
                          $("#rejillas_new").val(t);
                    }
    });
}
function cargar_perfiles(cod,riel,alfa){
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var rej = $("#altorej").val();
    var ancfd = $("#anchocfd").val();
    var ancfi = $("#anchocfi").val();
    var alcfs = $("#altocfs").val();
    var alcfi = $("#altocfi").val();
    var cant = $("#cantidad").val();
    var desp = $("#desperdicio_al").val();
    var color = $("#color").val();
    var hor = $("#hor").val();
    var ver = $("#ver").val();
    
    console.log('cod:'+cod);
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&hor='+hor+'&ver='+ver+'&color='+color+'&riel='+riel+'&alfa='+alfa+'&cant='+cant+'&desp='+desp+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=42',
        url:'acciones_alu.php',
        success : function(d){
            $("#formperfiles").html(d);
            
        }
    });
}

function perfiles_rieles(cod,idper,color){
  var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var rej = $("#altorej").val();
    var ancfd = $("#anchocfd").val();
    var ancfi = $("#anchocfi").val();
    var alcfs = $("#altocfs").val();
    var alcfi = $("#altocfi").val();
    var cant = $("#cantidad").val();
    var desp = $("#desperdicio_al").val();
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&color='+color+'&idper='+idper+'&cant='+cant+'&desp='+desp+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=42.1',
        url:'acciones_alu.php',
        success : function(d){
            $("#formperfiles_riel").html(d);
            
        }
    });
}
function perfiles_alfajia(cod,idper,color){
  var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var rej = $("#altorej").val();
    var ancfd = $("#anchocfd").val();
    var ancfi = $("#anchocfi").val();
    var alcfs = $("#altocfs").val();
    var alcfi = $("#altocfi").val();
    var cant = $("#cantidad").val();
    var desp = $("#desperdicio_al").val();
 
    
console.log('color:'+color);
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&color='+color+'&idper='+idper+'&cant='+cant+'&desp='+desp+'&ancho='+ancho+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=42.2',
        url:'acciones_alu.php',
        success : function(d){
            $("#formperfiles_alfa").html(d);
            
        }
    });
}
function pre_mostrar_rejilla(cod,med,color){
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var rej = $("#altorej").val();
    var ancfd = $("#anchocfd").val();
    var ancfi = $("#anchocfi").val();
    var alcfs = $("#altocfs").val();
    var alcfi = $("#altocfi").val();
     var cant = $("#cantidad").val();
    var desp = $("#desperdicio_al").val();

    
    var medrej = med;
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&color='+color+'&altorej='+medrej+'&cant='+cant+'&desp='+desp+'&ancho='+ancho+'&med='+med+'&alto='+alto+'&rej='+rej+'&ancfd='+ancfd+'&ancfi='+ancfi+'&alcfs='+alcfs+'&alcfi='+alcfi+'&sw=44',
        url:'acciones_alu.php',
        success : function(d){
            $("#MostrarRejillas").html(d);
        }
    });
}
function mostrar_instalacion(cod){
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    
    var anchocfd = $("#anchocfd").val();
    var altocfs = $("#altocfs").val();
    var anchocfi = $("#anchocfi").val();
    var altocfi = $("#altocfi").val();
    $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&anchocfd='+anchocfd+'&altocfs='+altocfs+'&anchocfi='+anchocfi+'&altocfi='+altocfi+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&sw=45',
            url: 'acciones_alu.php',
            success: function(resultado){
                $("#mostrar_instalacion").html(resultado);

            }
  });
}
function mostrar_compuestos(){
    var  ser = '';
     var  est = '';
     var cot = $("#item").val();
      $.ajax({
            post:'GET',
            data:'cot='+cot+'&ser='+ser+'&est='+est+'&sw=7',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_lineas_comp").html(a);     
            } 
        });
}
function pasar_mas(){
    var selected = '';
     $('select option:checked').each(function(){
           var cs = $(this).val();
          if(cs){
          selected += cs+',' ;
          }
     });
     fin = selected.length - 1;  
     selected = selected.substr( 0, fin );
     $("#msg").html(selected);
}
function seleccionar(id,nom){
    $("#rieles").val(id);
    $("#rieles_new").val(nom);
    $("#modalselect").modal('hide');
}
function seleccionara(id,nom){
    $("#alfajias").val(id);
    $("#alfajias_new").val(nom);
    $("#modalselect").modal('hide');
}
function seleccionarc(id,nom){
    var cnt = $("#cnt"+id).val();
    var r = $("#riel"+id).is(":checked");
    //alert(r);
    if(cnt==''){
        alert("Digite la cantidad de cierres");
        $("#riel"+id).prop('checked',false);
        $("#cnt"+id).focus();
        return false;
    }
    if(r==true){
    var c = $("#cierres").val();
    var cn = $("#cierres_new").val();
    var ct =  $("#can_cie").val();
    //$("#cierres_new").val(nom);
    var t , n , tc;
    if(c==''){
       t = id;
       n = nom;
       tc = cnt;
    }else{
       t = c+','+id;
       n = cn+','+nom;
       tc = ct+','+cnt;
    }
    
    $("#cierres").val(t);
    $("#cierres_new").val(n);
    $("#can_cie").val(tc);
}else{
    $("#riel"+id).prop('checked',false);
 
}
    //$("#modalselect").modal('hide');
}
function seleccionarr(id,nom){
    $("#rejillas").val(id);
    $("#rejillas_new").val(nom);
    $("#modalselect").modal('hide');
}
function seleccionarro(id,nom){
    $("#rodajas").val(id);
    $("#rodajas_new").val(nom);
    $("#modalselect").modal('hide');
}
function seleccionarbr(id,nom){
    $("#brazos").val(id);
    $("#brazos_new").val(nom);
    $("#modalselect").modal('hide');
}
function seleccionarbi(id,nom){
    $("#bisagras").val(id);
    $("#bisagras_new").val(nom);
    $("#modalselect").modal('hide');
}
function rieles(nom){
    var codigo = $("#codigo0").val();
    $("#titu").html(nom);
    $("#modalselect").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=37.1',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function alfajias(nom){
    var codigo = $("#codigo0").val();
    $("#titu").html(nom);
    $("#modalselect").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=38',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function rejillas(nom){
    var codigo = $("#codigo0").val();
    $("#titu").html(nom);
    $("#modalselect").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=41',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function cierres(nom){
    var c = confirm("Al abrir esta ventana, tendra que seleccionar los items de nuevo,\n ¿Esta seguro de abrir este formulario?");
    if(c){
    var codigo = $("#codigo0").val();
    $("#titu").html(nom);
    $("#modalselect").modal('show');
    
    $("#cierres").val('');
    $("#cierres_new").val('');
     $("#can_cie").val('');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=39',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
    }
}
function rodajas(nom){
    var codigo = $("#codigo0").val();
    $("#titu").html(nom);
    $("#modalselect").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=40',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function brazos(nom){
    var codigo = $("#codigo0").val();
    $("#titu").html(nom);
    $("#modalselect").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=40.1',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function bisagras(nom){
    var codigo = $("#codigo0").val();
    $("#titu").html(nom);
    $("#modalselect").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=40.2',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function quitar_img(){
    var item = $("#item").val();
    var c = confirm("Esta seguro de eliminar esta imagen");
    if(c){
    $.ajax({
            post:'GET',
            data:'item='+item+'&sw=47',
            url:'acciones_alu.php',
            success:function(a){
              DatosBasicos();     
            } 
        });
    }
}
function lam_ventanas(n){
    $("#modallam").modal('show');
    $("#con_num").val(n);
    var cod = $("#codigo"+n).val();
     var vid = $("#codvidrio"+n).val();
     var des = $("#desvidrio"+n).val();
     if(cod==''){
         alert('Selecciona el codigo');
         $("#codigo"+n).focus();
         return false;
     }
     if(vid==''){
         alert('Selecciona el espesor');
         $("#codvidrio"+n).focus();
         return false;
     }
    $("#con_cod").val(cod);
    $("#con_vid").val(vid);
    $("#con_vid_nom").val(des);
    laminassave(n);
}
function laminassave(n){
     var n = $("#con_num").val();
    var lam = $("#con_lam").val();
    var vid = $("#con_vid").val();
    var vidnom = $("#con_vid_nom").val();
    var cod = $("#codigo"+n).val();
    var cod_pri = $("#codigo0").val();
    var des = $("#descripcion0").val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var lamx = $("#lam").val();
    var pelicula = $("#pelicula").val();
    var inter = $("#interlayer").val();
    var espa = $("#espaciadores").val();
    var desp = $("#desperdicio").val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var despesp = $("#desperdicio_esp").val();
    var despint = $("#desperdicio_int").val();
    var inst = $("#instalacion").val();
    var est = $("#estado").val();
    var item = $("#item").val();
    
    var anchocfd = $("#anchocfd").val();
    var altocfs = $("#altocfs").val();
    var anchocfi = $("#anchocfi").val();
    var altocfi = $("#altocfi").val();
    var altorej = $("#altorej").val();
    var alfa = $("#alfajias").val();
   $.ajax({
        type:'GET',
        data:'lam='+lam+'&rej='+altorej+'&vid='+vid+'&vidnom='+vidnom+'&cod_pri='+cod_pri+'&ancfd='+anchocfd+'&alfa='+alfa+'&ancfi='+anchocfi+'&alcfs='+altocfs+'&alcfi='+altocfi+'&cod='+cod+'&est='+est+'&item='+item+'&inst='+inst+'&despesp='+despesp+'&despint='+despint+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&inter='+inter+'&espa='+espa+'&des='+des+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&pelicula='+pelicula,
        url:'../productos_dos/laminados_save.php',
                    success : function(t){
                        $("#confi").html(t);
                    }
    }); 
}
function AddServicios(){
     $("#modalserviciosmas").modal('show');
}
function mostrar_servicios(cot){
        $.ajax({
                    type:'GET',
                    data:'cot='+cot+'&sw=49',
                    url:'acciones_alu.php',
                    success : function(t){
                          $("#mostrar_servicios").html(t);
                    }
                });
}
function mostrar_ventas(cot){

        $.ajax({
                    type:'GET',
                    data:'cot='+cot+'&sw=50',
                    url:'acciones_alu.php',
                    success : function(t){
                          $("#mostrar_ventas").html(t);
                    }
                });
}
function ver_servicios(id){
    $("#modalservicios").modal('show');
     $("#saventa2").attr("disabled",false);
    $.ajax({
                 post:'GET',
                 data:'id='+id+'&sw=44',
                 url:'acciones.php',
                 success : function(r){
                     var p = eval(r);
                     $("#mat_id3").val(p[0]);
                     $("#mat_cod3").val(p[3]);
                     $("#mat_can3").val(p[6]);
                     $("#mat_precio").val(p[5]);
                     $("#mat_desc3").val(p[4]);
                     $("#mat_par").val(p[8]);
                     $("#mat_obs3").val(p[12]);
                     $("#mat_val2").val(p[9]);
                     $("#mat_aca").val(p[15]);
                     $("#mat_desp2").val(p[13]);
                     $("#mat_pro").val(p[11]);
                     $("#mat_val3").val(p[9]);
                     $("#mat_valt3").val(p[10]);
                     $("#mat_items3").val(p[2]);
                     $("#mat_des3").val(p[7]);
                    $("#saventa3").attr('disabled',false);
                 }
             });
}
function del_servicios(id){
    var c = confirm("Estas seguro de eliminar este items?");
    var cot = $("#item").val();
    if(c){
        $.ajax({
                 post:'GET',
                 data:'id='+id+'&sw=22.1',
                 url:'acciones.php',
                 success : function(r){
                    alert(r);
                    mostrar_servicios(cot);
                    
                    window.opener.mostrar_servicios($("#cot").val());
                 }
             });
    }
}
function savecostos(){
    var cot = $("#cot").val();
    var idcot = $("#item").val();
    
     var cperfil1 = $("#total_perfil_costo1").val();
     var cperfil2 = $("#total_perfil_costo2").val();
     var cperfil3 = $("#total_perfil_costo3").val();
     var cperfil4 = $("#total_perfil_costo4").val();
     
     
     var cinsumo1 = $("#total_insumo_costo1").val();
     var cinsumo2 = $("#total_insumo_costo2").val();
     var cinsumo3 = $("#total_insumo_costo3").val();
     var t_alu = parseFloat(cperfil1) + parseFloat(cperfil2) + parseFloat(cperfil3) + parseFloat(cperfil4);
     var t_vid = $("#dtot").val() * $("#cantidad").val();
     var t_acc = parseFloat(cinsumo1) + parseFloat(cinsumo2) + parseFloat(cinsumo3); // total costo de accesorios
     var t_mob = $("#total_fabricacion").val();
     var t_ins = $("#total_instalacion").val();
     var t_pol = $("#tot_peli").val();
     var gt = $("#subtotal").val();
     var desp = $("#desperdicio").val();
     var despalu = $("#desperdicio_al").val();
     var despacc = $("#desperdicio_acc").val();
     var despace = $("#desperdicio_ace").val();
     var totdesvid = $("#totdes").val() * $("#cantidad").val();
     var total_comp_desp = $("#total_comp_desp").val();
     var total_comp = $("#total_comp").val();
     
     $.ajax({
         type:'GET',
         data:'sw=1&item='+idcot+'&cot='+cot+'&gt='+gt+'&total_comp='+total_comp+'&totdesvid='+totdesvid+'&total_comp_desp='+total_comp_desp+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&despace='+despace+'&t_alu='+t_alu+'&t_vid='+t_vid+'&t_acc='+t_acc+'&t_mob='+t_mob+'&t_ins='+t_ins+'&t_pol='+t_pol,
         url:'acciones_planilla.php',
         success: function(d){
             alert(d);
         }
     });

    
}