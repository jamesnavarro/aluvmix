//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
MostrarUsuarios2(1);
     // 4- Buscar en la tabla
       var compra = window.opener.$('#compra').val();
        var loc = window.opener.$('#loc').val();
        var tipo = window.opener.$('#typo').val();
       $('#idop').val(compra);
       $('#bod').val(loc);
       $('#tipoorden').val(tipo);
        $('#buscar_empleado').change(function(){
		
		MostrarUsuarios2(1);
	});
        $('#tipo').change(function(){
		
		MostrarUsuarios2(1);
	});
});

function MostrarUsuarios2(page){
    var nombre = $('#buscar_empleado').val();
    var orden = window.opener.$('#compra').val();
    var rad = window.opener.$('#rad').val();
     var tipoop = window.opener.$('#typo').val();
    var tipo = $('#tipo').val();
    
    if(tipo=='Vidrios'){
        $.ajax({
				type: 'GET',
				data: 'page='+page+'&orden='+orden+'&tipo='+tipo+'&tipoop='+tipoop+'&rad='+rad+'&nombre='+nombre,
				url: '../salidas/documentos/mostrar_vidrios.php',
				success: function(data){
                                    
						$('#usuarios').html(data);
						
				}
			});
    }else if(tipo=='ORDEN'){
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&orden='+orden+'&tipo='+tipo+'&tipoop='+tipoop+'&rad='+rad+'&nombre='+nombre,
				url: '../salidas/documentos/despacho.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
                    }else if(tipo=='ORDENACC'){
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&orden='+orden+'&tipo='+tipo+'&tipoop='+tipoop+'&rad='+rad+'&nombre='+nombre,
				url: '../salidas/documentos/despacho_acc.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
                    }else{
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&orden='+orden+'&tipo='+tipo+'&tipoop='+tipoop+'&rad='+rad+'&nombre='+nombre,
				url: '../salidas/documentos/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
                    }
		return false;
}

function agregar_productos(rad,orden){

    $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var can = $("#ncant"+id).val();
                                var des = $("#des"+id).val();
                                var med = $("#med"+id).val();
                                var col = $("#col"+id).val();
                                var bod = $("#bod"+id).val();
                                var cod = $("#cod"+id).val();
                                var pre = $("#pre"+id).val();
                                //alert(id);
                         $.ajax({
				type: 'POST',
				data: 'rad='+rad+'&orden='+orden+'&cod='+cod+'&pre='+pre+'&des='+encodeURIComponent(des)+'&med='+med+'&col='+col+'&bod='+bod+'&can='+can+'&id='+id,
				url: '../salidas/documentos/agregar.php',
				success: function(data){
                                    console.log(data);
						
				}
			});
                  });
                  $.ajax({
                  success: function(){
                                  MostrarUsuarios2(1);	
                                  window.opener.cargadatos(rad);
				}
                        });
                  
}
function veri(id){
    var pcan = $("#pcant"+id).val();
    var can = $("#ncant"+id).val();
    if(parseFloat(can)>parseFloat(pcan)){
        alert("La cantidad digitada supera a la pendiente.");
        $("#ncant"+id).val('');
        return false;
    }
    buscarcod(id);
}
function buscarcod(i){
    var cod = $("#cod"+i).val();
    if(cod==''){
        alert("Digite el codigo!");
        $("#cod"+i).focus();
        return false;
    } 

      $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod,
          contentType: 'application/json',
          success: function(da){
             
                //document.getElementById("#cod"+i).value=cod;
                $("#des"+i).val(da.INV_NOMBRE);
                $("#col"+i).val(da.INV_LOTE);
	        $("#med"+i).val(da.INV_UBICA);
                $("#pre"+i).val(da.INV_VALCOM);
                buscarcodstock(i);
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             $("#ncant"+i).val('');
             return false;
        });
}
function buscarcodstock(i){
    var cod = $("#cod"+i).val();
    var med = $("#med"+i).val();
    var col = $("#col"+i).val();
    var alm = $("#bod").val();
    if(cod==''){
        alert("Digite el codigo!");
        $("#cod"+i).focus();
        return false;
    } 

      $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/Inventarios/GetSaldoRefLoteUbica/'+alm+'/'+cod+'/'+col+'/'+med+'',
          contentType: 'application/json',
          success: function(da){
                $("#sto"+i).val(da.CanAct);
                var cc = da.CanAct;
                if(cc==0){
                    alert("No hay stock de esta referencia");
                    return false;
                }
                consultar_stock(i,cc);
                $("#"+i).attr("disabled",false);
                $("#ubi"+i).attr("disabled",false);
                 $("#"+i).focus();
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             $("#ncant"+i).val('');
             $("#"+i).attr("disabled",true);
             return false;
        });
}
//agregar solo vidrios
function consultar_stock(i,cc){
    var cod = $("#cod"+i).val();
    var med = $("#med"+i).val();
    var col = $("#col"+i).val();
    var bod = $("#bod").val();
    var pre = $("#pre"+i).val();
    $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&loc='+bod+'&color='+col+'&med='+med+'&sto='+cc+'&pre='+pre+'&i='+i+'&sw=4',
        url: '../salidas/documentos/modelo.php',
        success: function (d) {
            if(d=='SI'){
                alert("El stock de las ubicaciones se actualizo correctamente");
            }
           
        }
    });
}
function agregarpro(i){
    var cod = $("#cod"+i).val();
    var med = $("#med"+i).val();
    var col = $("#col"+i).val();
    var can = $("#ncant"+i).val();
    var pcan = $("#pcant"+i).val();
    var sto = $("#sto"+i).val();
    var rad = window.opener.$("#rad").val();
    var bod = $("#bod").val();
    var idcot = $("#idcot").val();
    var pre = $("#pre"+i).val();
    var des = $("#des"+i).val();
    var t;
    if(can==0 || can ==''){
                    alert("Debes de digitar un valor real");
                    $("#ncant"+i).val('');
                    return false;
                }
       if(parseFloat(can)>parseFloat(sto)){
                    alert("La cantidad solicitada supera el stock actual");
                    $("#ncant"+i).val('');
                    return false;
                }         
    var c = confirm("Deseas agregar esta cantidad?");
    if(c){
    
    $.ajax({
				type: 'POST',
				data: 'rad='+rad+'&cod='+cod+'&pcan='+pcan+'&idcot='+idcot+'&pre='+pre+'&des='+encodeURIComponent(des)+'&med='+med+'&col='+col+'&bod='+bod+'&can='+can+'&id='+i,
				url: '../salidas/documentos/agregar_prod.php',
				success: function(data){
                                    console.log(data);
                                    t = parseFloat(pcan)-parseFloat(can);
                                    $("#pcant"+i).val(t);
                                    $("#ncant"+i).val('');
                                    
				}
			});
                        
                        // actualiza el control de despacho
                        $.ajax({
				type: 'POST',
				data: 'rad='+rad+'&cod='+cod+'&pcan='+pcan+'&idcot='+idcot+'&pre='+pre+'&des='+encodeURIComponent(des)+'&med='+med+'&col='+col+'&bod='+bod+'&can='+can+'&id='+i,
				url: '../salidas/documentos/actualizar_control.php',
				success: function(data){
                                    console.log(data);
                                   
                                    
				}
			});
                        $.ajax({
                  success: function(){
                                  //MostrarUsuarios2(1);	
                                  window.opener.cargadatos(rad);
				}
                        });
                    }
}
//agregar solo perfiles y accesorios
function agregarproductos(i,orden,line){
    var cod = $("#cod"+i).val();
    var med = $("#med"+i).val();
    var col = $("#col"+i).val();
    var can = $("#ncant"+i).val();
    var pcan = $("#pcant"+i).val();
    var sto = $("#sto"+i).val();
    var rad = window.opener.$("#rad").val();
    var bod = $("#bod").val();
    var idcot = $("#idcot").val();
    var pre = $("#pre"+i).val();
    var des = $("#des"+i).val();
    var t;
    var c = confirm("Deseas agregar esta cantidad?");
    if(c){
    
    $.ajax({
				type: 'POST',
				data: 'rad='+rad+'&cod='+cod+'&line='+line+'&pcan='+pcan+'&idcot='+idcot+'&pre='+pre+'&des='+encodeURIComponent(des)+'&med='+med+'&col='+col+'&bod='+bod+'&can='+can+'&orden='+orden+'&id='+i,
				url: '../salidas/documentos/agregar_prod.php',
				success: function(data){
                                    console.log(data);
                                    t = parseFloat(pcan)-parseFloat(can);
                                    $("#pcant"+i).val(t);
                                    $("#ncant"+i).val('');
                                    
				}
			});
                        
                        // actualiza el control de despacho
                        $.ajax({
				type: 'POST',
				data: 'rad='+rad+'&cod='+cod+'&pcan='+pcan+'&idcot='+idcot+'&pre='+pre+'&des='+encodeURIComponent(des)+'&med='+med+'&col='+col+'&bod='+bod+'&can='+can+'&id='+i,
				url: '../salidas/documentos/actualizar_materia.php',
				success: function(data){
                                    console.log(data);
                                   
                                    
				}
			});
                        $.ajax({
                  success: function(){
                                  //MostrarUsuarios2(1);	
                                  window.opener.cargadatos(rad);
				}
                        });
                    }
}
function veruni(n){
    //window.open("","","");
   dar_acesso(n);
}
function dar_acesso(i){
    var cod = $("#cod"+i).val();
    var med = $("#med"+i).val();
    var col = $("#col"+i).val();
    var can = $("#ncant"+i).val();
    var pcan = $("#pcant"+i).val();
    var sto = $("#sto"+i).val();
    var rad = window.opener.$("#rad").val();
    var bod = $("#bod").val();
    var idcot = $("#idcot").val();
    var pre = $("#pre"+i).val();
    var des = $("#des"+i).val();
    $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&loc='+bod+'&can='+can+'&color='+col+'&med='+med+'&sto='+sto+'&pre='+pre+'&i='+i+'&sw=2',
        url: '../salidas/documentos/modelo.php',
        success: function (d) {
            $("#mostrar_cantidad").html(d);

        }
    });
       
}
function seleccionarubi(ubi,i){
    $("#ubi"+i).val(ubi);
     $("#inventario_sal").modal('hide');
}
function agregarubi(cod,col,med,sto,bod,pre){
     var ubi = $("#ubi").val();
     if(pre==''){
         alert("Debes de haber un stock valido");
         return false;
     }
     if(ubi==''){
         alert("Debes de digitar la ubicacion");
         return false;
     }
     var c = confirm("Esta seguro de actualizar la ubicacion de esta referencia? ");
     if(c){
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&loc='+bod+'&ubi='+ubi+'&color='+col+'&med='+med+'&sto='+sto+'&sw=3',
        url: '../salidas/documentos/modelo.php',
        success: function (d) {
          alert(d);

        }
    });
     }
}
function generar_desglose(){
    var cot = $("#idcot").val();
    window.open("http://172.16.0.40/cotizacionv2/vistas/hoja_materiales_1.php?cot="+cot,"Desglose de Materiales","width=800px, height=600px");  
}
function verop(){
    var op = $("#idorden").val();
    var op = $("#idorden").val();
    window.open("ordenes.php?op="+op,"Desglose de Materiales","width=800px, height=600px");  
}