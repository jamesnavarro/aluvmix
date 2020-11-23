//----------------------------MODULO DE AUDITORES---------------------------
$(function(){
     lista_contactos(1);
     lista_visitas(1);
//     lista_necesidad(1);
     lista_cotizaciones(1);
     $('#obs').change(function(){
		seleccionar();
     });
});
function nuevo(id){
    window.open("nuevo.php?id="+id,"Detalle2","width=1000 , height=600 ");
}
function guardar_p(){
                        var obra = $("#obra").val();
                        var pro = $("#pro").val();
                        var emp = $("#emp").val();
                        var tel1 = $("#tel1").val();
                        var tel2 = $("#tel2").val();
                        var reg = $("#reg").val();
                        var ciu = $("#ciu").val();
                        var zon = $("#zon").val();
                        var dir = $("#dir").val();
                        var bar = $("#bar").val();
                        var estr = $("#estr").val();
                        var tip = $("#tip").val();
                        var fas = $("#fas").val();
                        var est = $("#est").val();
                        var asi = $("#asi").val();
                        var nit = $("#nit").val();
                        var con = $("#con").val();
                        var estg = $("#estg").val();
                        var porque = $("#porque").val();
                        
                        $.ajax({
				type: 'GET',
                                data:'con='+con+'&obra='+obra+'&porque='+porque+'&nit='+nit+'&pro='+pro+'&emp='+emp+'&tel1='+tel1+'&tel2='+tel2+'&reg='+reg+'&ciu='+ciu+'&zon='+zon+'&dir='+encodeURIComponent(dir)+'&bar='+bar+'&estr='+estr+'&tip='+tip+'&fas='+fas+'&est='+est+'&estg='+estg+'&asi='+asi+'&sw=11',
				url: 'acciones.php',
				success: function(d){
                                   alert('Se guardo correctamente '+d);  
                                   opener.window.location.reload(); 
                                   self.close();
				}
			});
}
function lista_contactos(page){
    var id_obra = $("#id_obra").val();

            $.ajax({
		type: 'GET',
                data:'page='+page+'&id_obra='+id_obra,
		url: 'contactos.php',
		success: function(d){
                $('#mostrar_contactos').html(d);  
		}
	});
}
function des(){
    var est = 'Descartado';
    var asig = $("#asignado").val();
    var id = $("#id_obra").val();
    var con = confirm("Desea descartar esta obra?");
    if(con){
           var  nov = prompt("Digite la causal de descarte");
        $.ajax({
				type: 'GET',
                                data:'id='+id+'&asig='+asig+'&nov='+nov+'&est='+est+'&sw=1',
				url: 'acciones.php',
				success: function(d){
                                    alert("Se descarto esta obra"); 
                                    location.reload(); 
                                    
				}
			});
    }else{
      return false;
    }
}
function seleccionar(){
    var punto = $("#punto").val();
    var obs = $("#obs").val();
    var id = $("#id_obra").val();
  
     $.ajax({
				type: 'GET',
                                data:'id='+id+'&punto='+punto+'&obs='+obs+'&sw=2',
				url: 'acciones.php',
				success: function(d){
                                   
				}
			});
}
function lista_visitas(page){
    var id_obra = $("#id_obra").val();

            $.ajax({
				type: 'GET',
                                data:'page='+page+'&id_obra='+id_obra,
				url: 'visitas.php',
				success: function(d){
                                    $('#mostrar_visitas').html(d);  
				}
			});
}
function lista_necesidad(page){
    var id_obra = $("#id_obra").val();

            $.ajax({
				type: 'GET',
                                data:'page='+page+'&id_obra='+id_obra,
				url: 'necesidades.php',
				success: function(d){
                                    $('#mostrar_necesidades').html(d);  
				}
			});
}
function lista_cotizaciones(page){
    alert('hpp');
    var id_obra = $("#id_obra").val();

            $.ajax({
				type: 'GET',
                                data:'page='+page+'&id_obra='+id_obra,
				url: 'cotizaciones.php',
				success: function(d){
                                    $('#mostrar_cotizaciones').html(d);  
				}
			});
}
function new_contacto(id){
    var id_obra = $("#id_obra").val();
     $("#idp").val(id_obra);
     if(id!==''){
         datos_contacto(id);
     }
}
function new_necesidad(id){
    var id_obra = $("#id_obra").val();
     if(id!==''){
         datos_necesidad(id);
     }
}
function new_visita(id){
    var id_obra = $("#id_obra").val();
   $('#myModalvisita').modal({
			show:true,
			backdrop:'static',
		});
     $("#idp").val(id_obra);
     $("#con").val('');
     if(id!==''){
         datos_visita(id);
     }
}
function limpiar(){
    $("#idc").val('');
    $("#nom").val('');
    $("#tel").val('');
    $("#cargo").val('');
    $("#area").val('');
    $("#email").val('');
    $("#obs").val('');
}
function datos_contacto(id){
             $.ajax({
				type: 'GET',
                                data:'idc='+id+'&sw=3',
				url: 'acciones_v.php',
				success: function(d){
                                    var a = eval(d);
                                    $("#idc").val(a[0]);
                                    $("#nom").val(a[1]);
                                    $("#tel").val(a[2]);
                                    $("#cargo").val(a[3]);
                                    $("#area").val(a[4]);
                                    $("#email").val(a[5]);
				}
			});
}
function datos_necesidad(id){
             $.ajax({
				type: 'GET',
                                data:'idn='+id+'&sw=7',
				url: 'acciones_v.php',
				success: function(d){
                                    var a = eval(d);
                                    $("#idn").val(a[0]);
                                    $("#necesidad").val(a[1]);  
				}
			});
}
function datos_visita(id){
             $.ajax({
				type: 'GET',
                                data:'id='+id+'&sw=5',
				url: 'acciones_v.php',
				success: function(d){
                                    var a = eval(d);
                                    $("#id").val(a[0]);
                                    $("#asunto").val(a[1]);
                                    $("#lugar").val(a[2]);
                                    $("#fi").val(a[3]);
                                    $("#ff").val(a[4]);
                                    $("#tipo").val(a[6]);
                                    $("#estado").val(a[5]); 
                                    $("#obs2").val(a[7]);
                                    $("#hi").val(a[8]);
                                    $("#hf").val(a[9]);
                                    $("#con").val(a[10]);
				}
			});
}
function add_contacto(){
    var idp = $("#id_obra").val();
     var idc = $("#idc").val();
     var nom = $("#nom").val();
     var tel = $("#tel").val();
     var cargo= $("#cargo").val();
     var area = $("#area").val();
     var email = $("#email").val();
     var obs = $("#obs").val();
     if(nom===''){
         alert("Digite el nombre");
         $("#nom").focus();
         return false;
     }
     if(nom===''){
         alert("Digite el telefono");
         $("#tel").focus();
         return false;
     }
     if(email===''){
         alert("Digite el email");
         $("#email").focus();
         return false;
     }
     $("#btn").attr("disabled", true);
     var page = $("#page").val();
     $.ajax({
            type: 'GET',
            data:'idc='+idc+'&idp='+idp+'&nom='+nom+'&nom='+nom+'&tel='+tel+'&cargo='+cargo+'&area='+area+'&email='+email+'&obs='+obs+'&sw=4',
            url: 'acciones_v.php',
            success: function(d){
                console.log(d);
                lista_contactos(page);
                alert("Se ha guardado el contacto");
                $("#btn").attr("disabled", false);
                //location.reload();
            }
	     });
}
function add_necesidad(){
    var file = $("#file").val();
     var id = $("#idn").val();
     var nec = $("#necesidad").val();
 var obra = $("#id_obra").val();
     if(nec===''){
         alert("Describa la necesidad");
         $("#necesidad").focus();
         return false;
     }
     $("#btn4").attr("disabled", true);
     var page = $("#page4").val();
     $.ajax({
            type: 'GET',
            data:'idn='+id+'&file='+file+'&obra='+obra+'&nec='+nec+'&sw=8',
            url: 'acciones_v.php',
            success: function(d){
                  lista_necesidad(page);
                  alert("Se guardo con exito "+d);
                  $("#btn4").attr("disabled", false);
            }
	     });
}
function editar_cotizacion(id){
     $.ajax({
            type: 'GET',
            data:'idc='+id+'&sw=14',
            url: 'acciones_v.php',
            success: function(d){  
                 var a = eval(d);
                 var idcot = $("#idcot").val(a[0]);
                 var obrac = $("#obrac").val(a[1]);
                 var numero = $("#numero").val(a[2]);
                 var analista = $("#analista").val(a[5]);
                 var asesor = $("#asesor").val(a[6]);
                 var fecha = $("#obs_cot").val(a[9]);
                 var est_cot = $("#est_cot").val(a[7]);
                 var foto = $("#foto").val(a[9]);
            }
	   });
}
function new_cotizacion(){
    var idcot = $("#idcot").val();
    var obrac = $("#obrac").val();
    var numero = $("#numero").val();
    var analista = $("#analista").val();
    var asesor = $("#asesor").val();
    var fecha = $("#obs_cot").val();
    var est_cot = $("#est_cot").val();
    var foto = $("#foto").val();

     if(numero===''){
         alert("Digite el numero de cotizacion");
         $("#numero").focus();
         return false;
     }
     if(analista===''){
         alert("Seleccione el analista");
         $("#analista").focus();
         return false;
     }
     if(asesor===''){
         alert("Seleccione el asesor");
         $("#asesor").focus();
         return false;
     }
     $("#loadi").attr("disabled", true);
     var page = $("#page4").val();
     $.ajax({
            type: 'GET',
            data:'idcot='+idcot+'&obrac='+obrac+'&numero='+numero+
                  '&analista='+analista+'&asesor='+asesor+
                  '&fecha='+fecha+'&est_cot='+est_cot+
                  '&foto='+foto+'&sw=13',
            url:  'acciones_v.php',
            success: function(d){
                   //lista_necesidad(page);
                    alert("Se guardo con exito "+d);
                    $("#loadi").attr("disabled", false);
                    lista_cotizaciones(1);
                   
            }
	     });
}
function add_visita(){
     var id = $("#id").val();
     var idp = $("#id_obra").val();
     var asunto = $("#asunto").val();
     var lugar = $("#lugar").val();
     var hi = $("#hi").val();
     var hf= $("#hf").val();
     var fi = $("#fi").val()+' '+hi;
     var ff= $("#ff").val()+' '+hf;
     var tipo = $("#tipo").val();
     var estado = $("#estado").val();
     
     var obs = $("#obs2").val();
     var con = $("#con").val();
     if(asunto===''){
         alert("Digite el asunto x");
         $("#asunto").focus();
         return false;
     }
     if(lugar===''){
         alert("Digite el lugar");
         $("#lugar").focus();
         return false;
     }
     if(fi===''){
         alert("Digite la fecha inicial");
         $("#fi").focus();
         return false;
     }
     if(ff===''){
         alert("Digite la fecha final");
         $("#ff").focus();
         return false;
     }
console.log('paso por aqui');
     var page = $("#page2").val();
     $.ajax({
            type: 'GET',
            data:'id='+id+'&idp='+idp+'&asunto='+asunto+'&con='+con+'&lugar='+lugar+'&fi='+fi+'&ff='+ff+'&tipo='+tipo+'&estado='+estado+'&obs='+obs+'&sw=6',
            url: 'acciones_v.php',
            success: function(d){
                console.log('paso '+d);
                $("#id").val(d);
                   lista_visitas(page);
                    alert("Se guardo con exito" +d);
                    $('#myModalvisita').modal('hide');
                    
                    
            }
	     });
}