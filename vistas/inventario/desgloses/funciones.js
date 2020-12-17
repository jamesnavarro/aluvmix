
function inv_ti_mov_popup() {
    validar_documento();
    window.open("../popup/tmovi/movimiento.php", "Tipos de Movimientos", "width=1000px , height=600px");
}

function imprimir() {
    var obs = $("#obs").val(); 
    var cot = $("#cot").val(); 
    window.open("pdf.php?cot="+cot+"&obs="+obs, "Lista de Accesorios", "width=1000px , height=600px");
}      
function imprimir_acc() {
    var obs = $("#obs").val(); 
    var cot = $("#cot").val(); 
    window.open("pdf_acc.php?cot="+cot+"&obs="+obs, "Lista de Accesorios", "width=1000px , height=600px");
}  
function imprimir_alum() {
    var obs = $("#obs").val(); 
    var cot = $("#cot").val(); 
    window.open("pdf_alum.php?cot="+cot+"&obs="+obs, "Lista de aluminio", "width=1000px , height=600px");
}

function inv_ti_mov_especial() {
    window.open("../popup/movi_especial/movimiento.php", "Tipos de Movimientos Salida", "width=500px , height=600px");
}
function mostrar_desglose(id){
var bod = $("#bodega").val(); 
var sol = $("#solicitudes").val();
    			$.ajax({
				type: 'GET',
                                data:'cot='+id+'&bod='+bod+'&sol='+sol,
                                url: 'lista_1.php',
				success: function(data){
					$('#mostrar_tabla').html(data);
				}
			}); 
} 
function mostrar_desglose_acc(id){
var bod = $("#bodega").val();
var sol = $("#solicitudes").val();
    			$.ajax({
				type: 'GET',
                                data:'cot='+id+'&bod='+bod+'&sol='+sol,
                                url: 'lista_acc.php',
				success: function(data){
					$('#mostrar_tabla_acc').html(data);
				}
			}); 
} 
function mostrar_obs(id) {
    			$.ajax({
				type: 'GET',
                                data:'cot='+id+'&sw=2',
                                url: 'acciones.php',
				success: function(data){
					$('#obs').val(data);
				}
			}); 
}
function verificar_stock(id){
    var bod = $("#bodega").val();
    var cod = $("#cod"+id).val();
    	$.ajax({
		type: 'GET',
                data:'bod='+bod+'&cod='+cod+'&sw=2',
                url: 'accionesv2.php',
		success: function(data){
		$('#sto'+id).val(data);
		}
	}); 
}

function verificar(id){
    var cod = $("#cod"+id).val();
    var cot = $("#cot").val();
     $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
             var pre = da.INV_VALCOM;
             var und= da.INV_UNDMED;
             var iva = da.INV_IVA;
             var color = da.INV_LOTE;

             agregarnolista(cod,id,0,pre,und,iva);
 
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             //alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             agregarnolista(cod,id,1,0,0,0);
             return false;
        });
        mostrar_desglose(cot);
        
        
}
function verificaracc(id){
    var cod = $("#cod"+id).val();
    var cot = $("#cot").val();
     $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
             var pre = da.INV_VALCOM;
             var und= da.INV_UNDMED;
             var iva = da.INV_IVA;
             var color = da.INV_LOTE;
             $("#aca"+id).val(color);
             //alert(pre);
             agregarnolistaacc(cod,id,0,pre,und,iva,color);
 
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             //alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             agregarnolistaacc(cod,id,1,0,0,0,0);
             return false;
        });
        mostrar_desglose_acc(cot);
        
        
}
function agregarnolistaacc(cod,con,sw,pre,und,iva,color) {
var cot = $("#cot").val();
var ref = $("#dad"+con).val();
var per = $("#per"+con).val();
    	$.ajax({
	type: 'GET',
        data:'cod='+cod+'&cot='+cot+'&ref='+ref+'&per='+per+'&c='+sw+'&pre='+pre+'&und='+und+'&iva='+iva+'&color='+color+'&sw=11',
        url: 'acciones.php',
	success: function(data){
             //alert(data);
             if(sw===1){
               $('#td'+con).attr({'style':'background-color:#F4CACA'}); // no existe rojo
               //$('#'+con).prop("checked",false);
               }else{
               $('#td'+con).attr({'style':'background-color:#C5E9C0'}); // si existe verde
               //$('#'+con).prop("checked",true);
               }
              }
	}); 
}
function agregarnolista(cod,con,sw,pre,und,iva) {
var cot = $("#cot").val();
var ref = $("#dad"+con).val();
var per = $("#per"+con).val();
    	$.ajax({
	type: 'GET',
        data:'cod='+cod+'&cot='+cot+'&ref='+ref+'&per='+per+'&c='+sw+'&pre='+pre+'&und='+und+'&iva='+iva+'&sw=1',
        url: 'acciones.php',
	success: function(data){
        //alert(data);
        if(sw===1){
        $('#td'+con).attr({'style':'background-color:#F4CACA'}); // no existe rojo
        //$('#'+con).prop("checked",false);
         }else{
             $('#td'+con).attr({'style':'background-color:#C5E9C0'}); // si existe verde
             //$('#'+con).prop("checked",true);
             }				
	}
	}); 
}
function cambiarestado(con) {
var cot = $("#cot").val();
var ref = $("#ref"+con).val();
var per = $("#per"+con).val();
    	$.ajax({
		type: 'GET',
                data:'cot='+cot+'&ref='+ref+'&per='+per+'&sw=3',
                url: 'acciones.php',
		success: function(data){	
		}
		}); 
}
function verificartotal(){
    $("#stock").attr("disabled", false);
    $("input[name=item]:checked").each(function(){
    
	var id = $(this).attr("id");
        verificar(id);
        
                                
});
}
function verificartotalacc(){
    $("#stock").attr("disabled", false);
    $("input[name=item]:checked").each(function(){
    
	var id = $(this).attr("id");
        verificaracc(id);
        
                                
});
}
function verificartotalstock(){
    $("#Guardar").attr("disabled", false);
    $("input[name=item2]:checked").each(function(){
    
	var id = $(this).attr("id");
  
        verificar_stock(id);
                                
});
}
function save_solicitud(){
    var c = confirm("Esta seguro de generar la presolicitud");
    if(c){
     $("input[name=item2]:checked").each(function(){
    
	var id = $(this).attr("id");
        guardarpresol(id);
        cambiarestado(id);
                                
});
    }
}
function guardarpresol(id) {

var cod = $("#cod"+id).val();
var ref = $("#ref"+id).val();
var can = $("#can"+id).val();
var des = $("#des"+id).val();
var per = $("#per"+id).val();
var col = $("#aca"+id).val();
var pre = $("#pre"+id).val();
var und = 'Und';
var iva = $("#iva"+id).val();
var cot = $("#cot").val();
var obs = $("#obs").val();
    			$.ajax({
				type: 'GET',
                                data:'cod='+cod+'&ref='+ref+'&obs='+obs+'&can='+can+'&des='+des+'&per='+per+'&col='+col+'&pre='+pre+'&und='+und+'&iva='+iva+'&cot='+cot+'&sw=1',
                                url: 'accionesv2.php',
				success: function(data){
                                    //alert(data);
					$('#td'+id).html('');
				}
			}); 
}
function verperfiles(ref,med){
     var cot = $("#cot").val();
            $.ajax({
                            post:'GET',
                            data:'cot='+cot+'&ref='+ref+'&med='+med+'&sw=4',
                            url:'acciones.php',
                            success:function(d){
                                $("#mostrar_editar").html(d);
                            } 
                        });
     
 }
  function UpPerfil(id){
     var c = confirm("Estas seguro de editar este perfil?");
     if(c){
     var cot = $("#cot").val();
     var cod = $("#xcod"+id).val();
     var ref = $("#xref"+id).val();
     var can = $("#xcan"+id).val();
     var per = $("#xmed"+id).val();
     $.ajax({
           post:'GET',
           data:'id='+id+'&cot='+cot+'&ref='+ref+'&cod='+cod+'&can='+can+'&per='+per+'&sw=5',
           url:'acciones.php',
           success:function(d){
           alert(d);
              mostrar_desglose(cot);
             } 
           });
         }
     
 }
 function pedir(id){
     var c = confirm("Mandar a crear este producto?");
     if(c){
     var cot = $("#cot").val();
     var cod = $("#cod"+id).val();
     var ref = $("#ref"+id).val();
     var can = $("#can"+id).val();
     var per = $("#med"+id).val();
     $.ajax({
          post:'GET',
          data:'id='+id+'&cot='+cot+'&ref='+ref+'&cod='+cod+'&can='+can+'&per='+per+'&sw=6',
          url:'acciones.php',
              success:function(d){
                alert(d);
                mostrar_desglose(cot);
            } 
          });
       }
     
 }
  function creado(cod,cot){
     var c = confirm("Ya se creo este producto?");
     if(c){

     $.ajax({
        post:'GET',
        data:'cot='+cot+'&cod='+cod+'&sw=7',
        url:'acciones.php',
           success:function(d){
           alert(d);
           location.reload();
                               
           } 
                        });
                    }
     
 }