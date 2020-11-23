//----------------------------------- Modulo de Almacenes---------------------------
$(function() {

     // 4- Buscar en la tabla
        $('#buscar_empleado').change(function(){
		
		MostrarUsuarios2(1);
	});
        $('#buscar_color').change(function(){
		
		MostrarColores(1);
	});
});

function MostrarUsuarios2(page){
    var nombre = $('#buscar_empleado').val();
    var bod = $('#bod').val();
		$.ajax({
                        type: 'GET',
                        data: 'page='+page+'&nombre='+nombre+'&bod='+bod,
                        url: '../existencias/documentos/mostrar_tabla.php',
                        success: function(data){
                                        $('#usuarios').html(data);

                        }
			});
		return false;
}
function MostrarColores(page){
    var nombre = window.opener.$('#codxd').val();
    var bod = $('#bod').val();
		$.ajax({
                        type: 'GET',
                        data: 'page='+page+'&nombre='+nombre+'&bod='+bod,
                        url: '../existencias/documentos/mostrar_tabla_color.php',
                        success: function(data){
                                        $('#usuarios').html(data);

                        }
			});
		return false;
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
             $("#cant"+i).val('');
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
                //$("#ubi"+i).attr("disabled",false);
                 //$("#"+i).focus();
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             $("#cant"+i).val('');
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
//            if(d=='SI'){
//                alert("El stock de las ubicaciones se actualizo correctamente");
//            }
           
        }
    });
}
function agregarproductos(i){
    var cod = $("#cod"+i).val();
    var med = $("#med"+i).val();
    var col = $("#col"+i).val();
    var can = $("#cant"+i).val();
    var pcan = 0;
    var sto = $("#sto"+i).val();
    var rad = window.opener.$("#rad").val();
    var bod = $("#bod").val();
    var idcot = $("#idcot").val();
    var pre = $("#pre"+i).val();
    var des = $("#des"+i).val();
    var ubi = $("#ubi"+i).val();
    //alert('cod: '+i);
    if(can==0 || can =='undefined'){
                    alert("Debes de digitar un valor real");
                    $("#cant"+i).val('');
                    return false;
                }
       if(parseFloat(can)>parseFloat(sto)){
                    alert("La cantidad solicitada supera el stock actual");
                    $("#cant"+i).val('');
                    return false;
                }  
    var c = confirm("Deseas agregar esta cantidad?");
    if(c){
    
    $.ajax({
                            type: 'POST',
                            data: 'rad='+rad+'&cod='+cod+'&pcan='+pcan+'&idcot='+idcot+'&ubi='+ubi+'&pre='+pre+'&des='+encodeURIComponent(des)+'&med='+med+'&col='+col+'&bod='+bod+'&can='+can+'&id='+i,
                            url: '../../popup/salidas/documentos/agregar_prod.php',
                            success: function(data){
                                console.log(data);
                                $("#cant"+i).val('');
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

