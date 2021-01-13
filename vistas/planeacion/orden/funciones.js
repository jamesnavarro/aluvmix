$(function() {
mostrarCot(1);
    $("#tip").change(function(){
        mostrarCot(1);
    });
    $("#doc").change(function(){
        mostrarCot(1);
    });
    $("#obr").change(function(){
        mostrarCot(1);
    });
    $("#reg").change(function(){
        mostrarCot(1);
    });
     $("#se").change(function(){
        mostrarCot(1);
    });
    $("#estado").change(function(){
        mostrarCot(1);
    }); 
    $("#freg").change(function(){
        mostrarCot(1);
    });
    $("#precio").change(function(){
        mostrarCot(1);
    });

});

function mostrarCotbk(page) {
    orden = $("#orden").val();
    opf = $("#opf").val();
    cot = $("#cot").val();
    doc = $("#doc").val();
    nom = $("#cli").val();
    obr = $("#obr").val();
    reg = $("#reg").val();
    est = $("#estado").val();
                $("#load").html('<img src="../images/load.gif"> Cargando...');
		$.post("../vistas/planeacion/orden/mostrar_cotizaciones.php", {
                    orden:orden, opf:opf, cot:cot, doc:doc, nom:nom,obr:obr,est:est,reg:reg
                },
                function(data) {
			$("#cotizacione").html(data);
                        $("#load").html('');
		});
}
function abrir_cotizacion(id){
    var c = confirm("Esta seguro de abrir la cotizacion");
    if(c){
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=1',
        url:'../vistas/planeacion/orden/acciones.php',
        success : function(){
            alert("Se ha abierto la cotizacion con exito");
            mostrarCot(1);
        }
    });
    }
}
function version_cotizacion(id){
    var c = confirm("Esta seguro de sacar una version de esta cotizacion?");
    if(c){
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=2',
        url:'../vistas/planeacion/orden/acciones.php',
        success : function(v){
            alert("Se ha generado una version nueva No."+v);
            mostrarCot(1);
        }
    });
    }
}
function copiar_cotizacion(id){
    var c = confirm("Esta seguro de copiar esta cotizacion?");
    if(c){
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=3',
        url:'../vistas/planeacion/orden/acciones.php',
        success : function(v){
            alert("Se ha generado una copia nueva No."+v);
            mostrarCot(1);
        }
    });
    }
}
function seguir(cot){
 window.open('ventas/seguimientos/index.php?cotis='+cot,'seg1','width=1200,height=900');  
}

function mostrarCot(page){
    var doc = $("#doc").val();
    var tip = $("#tip").val();
 

    if(doc==''){
        doc='*';
    }else{
        doc=doc;
    }
    $("#page").val(page);
    $("#mostrar_tabla").html('<tr><td colspan="2">Cargando<img src="../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAEPRO/lista/'+doc+'/'+tip+'/'+page+'/30/',
          dataType: 'json',
          success: function(da){
            
              //console.log('Resultado: '+da);
              render = "";
              $.each(da, function(i, item) {
                //console.log(item);
                render+= showRow(i,item);
              });
              $('#cotizacione').html(render);
          }
        
      });
  }
  function showRow(i, dev){
     // consultar_cod_alu(dev.CLI_CEDULA);
     
     var tipo = "'"+dev.PRO_TIPORD+"'";
     var doc = "'"+dev.PRO_NUMORD+"'";
      var ped = "'"+dev.PRO_NUMPED+"'";
     var est = dev.PRO_ACTIVO;
     var e;var d;
     if(est==true){
         e = 'Cerrada';
         d = 'disabled';
     }else{
         e = 'Autorizada';
         d = '';
     }
     
     consultar_orden_monty_lista(dev.PRO_TIPORD,dev.PRO_NUMORD,dev.PRO_NUMPED);
  var row= '<tr>'+
              '<td>'+dev.PRO_TIPORD+'</td>'+
              '<td>'+dev.PRO_NUMORD+'</td>'+
              '<td>'+dev.PRO_CEDULA+'</td>'+
              '<td>'+dev.PRO_OBSERV+'</td>'+
              '<td>'+dev.PRO_FECOPE+'</td>'+
               '<td>'+dev.PRO_NUMPED+'</td>'+
              '<td id="est'+dev.PRO_NUMORD+'">'+dev.PRO_USUARIO+'</td>'+
              '<td>'+e+'</td>'+
              '<td id="es'+dev.PRO_NUMORD+'"></td>'+
              '<td><button type="button" name="Ver" id="btnlist'+dev.PRO_NUMORD+'" onclick="vermov('+tipo+','+doc+')"> Ver</button></td></tr>';
  return row;

}
function paginacion(p){
    var page = $("#page").val();
    var t = parseInt(page) + parseInt(p);
    if(t==0){
        mostrarCot(1);
    }else{
        mostrarCot(t);
        $("#page").val(t);
    }
    
}
function consultar_orden_monty_lista(tip,num,ped){
   
    $.ajax({
                type: 'GET',
                data: 'tip='+tip+'&num='+num+'&ped='+ped+'&sw=9',
                url: '../vistas/planeacion/orden/acciones_tem.php',
                success: function(t) {
                    var p = eval(t);
                      console.log('Resultado: '+t);
                      if(p[0]=='0'){
                          $("#btnlist"+num).attr("class","btn-warning"); 
                      }else if(p[0]=='1'){
                          $("#btnlist"+num).attr("class","btn-success"); 
                      }else{
                          $("#btnlist"+num).attr("class","btn-danger"); 
                      }
                      if(p[1]==null){
                          $("#es"+num).html('<font color="red">Sin Generar</font>');
                      }else{
                          $("#es"+num).html(p[1]);
                      }
                     
                }
     });
}
function vermov(tip,num){

     window.open("../vistas/planeacion/orden/formulario.php?tipo="+tip+"&num="+num+"", "Productos", "width=1300px , height=800px"); 
 }
 function consultar_enc(tip,num){
  
     $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
           url:'http://172.16.0.30:8989/api/MAEPRO/'+num+'/'+tip+'/',
          contentType: 'application/json',
          success: function(p){
         
                 
                 $("#typo").val(p.PRO_TIPORD);

                 $("#nombrepro").val(p.PRO_CEDULA);
                 $("#cedula").val(p.PRO_CEDULA);
                 $("#doc").val(p.MOV_TIPMOV);
                 $("#factura").val(p.PRO_NUMPED);

                 $("#obs").val(p.PRO_OBSERV);
                  $("#compra").val(p.PRO_NUMORD);
                  $("#FecReg").val(p.PRO_FECOPE);
                   $("#por").val(p.PRO_USUARIO);
                  
                   bus_ter(p.PRO_CEDULA);
                   //bus_pedido(p.MOV_DOCAFE);
                   consultar_orden_monty(tip,num,p.PRO_NUMPED);
                  
                   
              
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             return false;
        });
 }
function consultar_detalle(tip,doc){

    //$("#mostrar_moviemientos").html('<tr><td colspan="9">Cargando<img src="../../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/DETPRO/'+tip+'/'+doc+'/1/100',
          dataType: 'json',
          success: function(da){
              var total = 0;
              var row = "";
              var ct=0;
              var x = 0;var xo = 0;
              $.each(da, function(i, dev) {
                  x++;
                   var cod = "'"+dev.PRO_REFER+"'";
                   var col = "'"+dev.PRO_LOTE+"'";
                   var med = "'"+dev.PRO_UBICA+"'";
                   var can = "'"+dev.PRO_CANORD+"'";
                   var undmed = dev.PRO_UNDMED;
                   var cantidad;
                   if(undmed=='94'){
                       cantidad = dev.PRO_CANORD;
                   }else{
                       cantidad = '1';
                   }
                  consultarproducto(dev.PRO_REFER,i);
                  consultar_items_id_cot(dev.PRO_REFER,dev.PRO_LOTE,dev.PRO_UBICA,i,dev.PRO_CANORD);
                  var doc = "'"+dev.PRO_NUMDOC+"'";
                  var t = dev.PRO_VALTOT / dev.PRO_CANORD;
                  total = parseFloat(total) + parseFloat(dev.PRO_VALTOT);
                  ct = parseFloat(ct) + parseFloat(dev.PRO_CANORD);
                 
                  
                  row+= '<tr>'+
                        '<td><input type="text" id="tip'+i+'" value="" disabled style="width: 100%">\n\
</td><td><input type="text" id="cod'+i+'" value="'+dev.PRO_REFER+'" disabled style="width: 100%">\n\
<input type="hidden" id="lado'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="id_r'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="caja'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="obs1'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="obs2'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="ancho1'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="anchod'+i+'" value="0" disabled style="width: 100%">\n\
<input type="hidden" id="anchocomp'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="anchohid'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="altohid'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="altod'+i+'" value="0" disabled style="width: 100%">\n\
<input type="hidden" id="alto1'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="cant'+i+'" value="" disabled style="width: 100%">\n\
<input type="hidden" id="cantid'+i+'" value="" disabled style="width: 100%">\n\
</td>'+
                        '<td><input type="text" id="des'+i+'" value="" disabled style="width: 100%"></td>'+
                        '<td><input type="text" id="col'+i+'" value="'+dev.PRO_LOTE+'" disabled style="width: 100%"></td>\n\
                         <td><input type="text" id="per'+i+'" value="" disabled style="width: 100%"></td>\n\
                         <td><input type="text" id="boq'+i+'" value="" disabled style="width: 100%"></td>'+
                        '<td><input type="text" id="med'+i+'" value="'+dev.PRO_UBICA+'" disabled style="width: 100%"></td>\n\
<td><input type="text" id="undmed'+i+'" value="'+undmed+'" disabled style="width: 100%"></td>'+
                        '<td><input type="text" id="can'+i+'" value="'+dev.PRO_CANORD+'" disabled style="width: 100%"></td>'+
                        '<td><input type="text" id="canpro'+i+'" value="0" disabled style="width: 100%"></td>'+
                        
                         '<td><input type="text" id="canpen'+i+'" value="0" disabled style="width: 100%"></td>'+
                        '<td><button type="button" name="Ver" id="btn'+i+'" onclick="generarstk('+cod+','+i+')"  data-toggle="modal" data-target="#ModalSticker"> Generar </button>\n\
                             <input type="checkbox" id="'+i+'" name="item" checked disabled>\n\
                             <input type="text" id="iditem'+i+'" value="" disabled style="width: 70px"><span id="m'+i+'"></span></td></tr>';
              });
              row+= '<tr><td><input type="text" id="ctitem" value="'+x+'" disabled style="width: 100%">\n\
<input type="hidden" id="ctitemori" value="'+xo+'" disabled style="width: 100%"></td><td colspan="7">TOTALES</td>\n\
<td><input type="text" id="ct" value="'+ct+'" disabled style="width: 100%"></td>\n\
<td>Pend:</td><td><input type="text" id="totalp" value="" disabled style="width: 100%"></td>\n\
<td><button onclick="generarall()" id="btnall">Generar Todos Stk</button></td>';
              //pasartotal(total);
              //sumar_pendientes();
              $('#mostrar_moviemientos').html(row);
          }
        
      });
  }
  function consultar_orden_monty(tip,num,ped){

    $.ajax({
                type: 'GET',
                data: 'tip='+tip+'&num='+num+'&ped='+ped+'&sw=1',
                url: '../../planeacion/orden/acciones_tem.php',
                success: function(t) {
                     var p = eval(t);
                     
                     $("#rad").val(p[0]);
                     $("#idcot").val(p[1]);
                     $("#idorden").val(p[4]);
                     $("#est").val(p[5]);
                     $("#e").html(p[6]);
                     if(p[5]==0){
                        $("#Guardar").attr("class","btn-danger");
                     }else{
                        $("#Guardar").attr("class","btn-success");
                     }
                      consultar_detalle(tip,num);
                     consultar_sticker(p[0]);
                    
                }
     });
}
function consultar_items_id_cot(cod,col,med,i,can){
    var idcot = $("#idcot").val();
    
        $.ajax({
                    type: 'GET',
                    data: 'idcot='+idcot+'&cod='+cod+'&med='+encodeURIComponent(med)+'&col='+col+'&can='+can+'&sw=2',
                    url: '../../planeacion/orden/acciones_tem.php',
                    success: function(data){
                       
                        $("#iditem"+i).val(data);
                       consultar_cantidad(data,i);
                    }
            });              
               
}
function consultar_cantidad(item,i){
        $.ajax({
                    type: 'GET',
                    data: 'iditem='+item+'&sw=3',
                    url: '../../planeacion/orden/acciones_tem.php',
                    success: function(data){
                       var p = eval(data);
                        $("#canpro"+i).val(p[8]);
                        $("#canpen"+i).val(p[3]);
                        $("#per"+i).val(p[9]);
                        $("#boq"+i).val(p[10]);
                        if(p[3]==0){
                            //$("#btn"+i).style("background-color","#4CAF50");
                            document.getElementById('btn'+i).style.color = 'green';
                        }else{
                            document.getElementById('btn'+i).style.color = 'red';
                        }
                        contar_items();

                           $("#obs1"+i).val(p[4]);
                            $("#obs2"+i).val(p[5]);
                             $("#ancho1"+i).val(p[0]);
                             $("#alto1"+i).val(p[1]);
                             $("#anchohid"+i).val(p[0]);
                             $("#anchocomp"+i).val(p[0]);
                             $("#altohid"+i).val(p[1]);
                               $("#cant"+i).val(p[3]);
                                $("#cantid"+i).val(p[3]);
                               $("#lado"+i).val(p[6]);
                               $('#id_r'+i).val(p[7]);                            
                                $("#tip"+i).val(p[11]);
                       
                    }
            });              
               
}
function consultar_cantidad_agregada(item,i){
        $.ajax({
                    type: 'GET',
                    data: 'iditem='+item+'&sw=3',
                    url: '../../planeacion/orden/acciones_tem.php',
                    success: function(data){
                       var p = eval(data);
                        $("#canpro"+i).val(p[8]);
                        $("#canpen"+i).val(p[3]);
                        if(p[3]==0){
                            //$("#btn"+i).style("background-color","#4CAF50");
                            document.getElementById('btn'+i).style.color = 'green';
                        }else{
                            document.getElementById('btn'+i).style.color = 'red';
                        }
                        contar_items();

                       
                    }
            });              
               
}
 function bus_ter(codt){

      $.ajax({
                type: 'GET',
                data: 'codt='+codt+'&sw=14',
                url: '../../inventario/movimientos/modelo.php',
         success: function(t) {
             var p = eval(t);
              $("#nterc").val(p[2]);  
         }
     
});
 }
  function consultarproducto(cod,i){
      $.ajax({
                type: 'GET',
                 data: 'cod='+cod+'&sw=4',
                url: 'acciones.php',
                success: function(t) {
                    var p = eval(t);
                     $("#des"+i).val(p[2]); 
                     //consultar_id_items()
                }
           });
 }
 function generarstk(pt,i){
     var iditem = $("#iditem"+i).val();
      var canped = $("#can"+i).val();
      $("#caja").val(i);
     var idcot = $("#idcot").val();
   
     $.ajax({
                    type: 'GET',
                    data: 'iditem='+iditem+'&idcot='+idcot+'&sw=3',
                    url: '../../planeacion/orden/acciones_tem.php',
                    success: function(data){
                       var p = eval(data);
                     
                         $("#ord").val(iditem);
                          $("#pt").val(pt);
                           $("#obs1").val(p[4]);
                            $("#obs2").val(p[5]);
                             $("#ancho1").val(p[0]);
                             $("#alto1").val(p[1]);
                             $("#anchohid").val(p[0]);
                             $("#anchocomp").val(p[0]);
                             $("#altohid").val(p[1]);
                               $("#cant").val(p[2]);
                                $("#cantid").val(p[3]);
                               $("#lado").val(p[6]);
                               console.log('Lado:'+p[6]);
                               $('#id_r').val(p[7]);
                               if(p[3]==0){
                                   $("#addstk").attr("disabled",true);
                               }else{
                                    $("#addstk").attr("disabled",false);
                               }
                                $("#per").val(p[9]);
                                $("#boq").val(p[10]);
                                $("#tip").val(p[11]);

                    }
            }); 
 }
 function add_orden(){
                var cot = $('#idcot').val();
        
                var op = $('#rad').val();
                var ord = $('#ord').val();
                var id = $('#id_r').val();
                var ancho = $('#ancho1').val();
                var anchohid = $('#anchohid').val();
                var anchod = $('#anchod').val();
                /*Ancho compuesto*/
                var anchocomp = $('#anchocomp').val();
                /*Ancho compuesto*/
                var alto = $('#alto1').val();
                var altohid = $('#altohid').val();
                var altod = $('#altod').val();
                var cantidad = $("#cant").val();
                 var cantidadid = $("#cantid").val();
                var ubicacion = $("#obs1").val();
                var observaciones = $("#obs2").val();
                var lado = $('#lado').val();
//                
                var per = $('#per').val();
                var boq = $('#boq').val();
                if(parseInt(cantidad)>parseInt(cantidadid)){
                    alert("La cantidad digitada supera a la cantidad pendiente");
                    $("#cant").val(cantidadid);
                    return false;
                }
                var i = $('#caja').val();
                var tipo = $('#tip').val();
                var producto = $('#des'+i).val();
                //alert(ancho + ' - ' + anchohid + ' - ' + anchod + ' - ' + alto + ' - ' + altohid + ' - ' + altod);
                if(cantidad.length > 0 && ubicacion.length > 0){
                        $.ajax({
                        type : 'GET',
                        url : '../../planeacion/orden/insertar_detalle_orden.php?cot='+cot+'&per='+per+'&boq='+boq+'&op='+op+'&ord='+ord+'&id='+id+'&ancho='+ancho+'&anchohid='+anchohid+'&anchod='+anchod+'&alto='+alto+'&altohid='+altohid+'&altod='+altod+'&cantidad='+cantidad+'&ubicacion='+ubicacion+'&observaciones='+observaciones+'&producto='+producto+'&tipo='+tipo+'&lado='+lado+'&anchocomp='+anchocomp,
                        beforeSend: function(){
                                    $("#addstk").html('<img src="../../images/load.gif"> Generando...');
                                    $('#addstk').attr('disabled',true);
                                },
                        success: function(data){
                        	//MostrarPR(page,op,cot,cli);
                                alert(data);
                            $('#ModalSticker').modal('hide');
                            $('#obs1').val('');
                            $('#cant').val('');
                            $('#anchod').val('0');
                            $('#altod').val('0');
                            //vercant();
                            $('#addstk').html('Generar');
                            $('#addstk').attr('disabled',false);
                            consultar_cantidad(ord,i);
                            consultar_sticker(op);
                            contar_items();
                        }
                        });

                    }else{
                        alert('Ingrese La Ubicacion y La Cantidad a Producir');
                    }
            
    }
    function consultar_sticker(op){
        var est = $("#est").val();
        $.ajax({
                        type : 'GET',
                        url : '../../planeacion/orden/acciones_tem.php?op='+op+'&est='+est+'&sw=4',
                        beforeSend: function(){
                                    $("#mostrar_ingresados").html('<img src="../../images/load.gif"> Generando...');
                                },
                        success: function(data){
                        	
                                   $('#mostrar_ingresados').html(data);
                                    contar_items();
                            }
                        });
    }
    function selectAll(i,ch) {
	//console.log('check -> '+i);
	if(i==0)
	var checkboxes = document.getElementsByName('anular');
	if(i==1)
	checkboxes = document.getElementsByName('anularsec');
		// body...
	//console.log(checkboxes);
	//console.log(ch);
	for(var i=0; i<checkboxes.length; i++){
		console.log(checkboxes[i].id);
		//alert(checkboxes[i].disabled);
		if(!checkboxes[i].disabled)
			checkboxes[i].checked =ch.checked;
	}
}
function contar_items(){
    var t=0;
    $("input[name=item]:checked").each(function(){
    
	var id = $(this).attr("id");
        var c = $("#canpen"+id).val();
        if(c==''){
            c = 0;
        }
        t = parseInt(c) + parseInt(t);
        //alert(c);
                                
});
$("#totalp").val(t);
}
function anularpri(){
    var estado = $("#est").val();
    var rad = $("#rad").val();
        if(estado=='0'){
    var eliminar = confirm('Desea Elminar este Items ');
			if (eliminar) {
				$("input[name=anular]:checked").each(function() {
					var i = $(this).attr("id");
                                        var c = $("#ido"+i).val();
                                        var item = $("#itemsx"+i).val();
                                       
					$.ajax({
						type: 'GET',
						data: 'orden='+c+'&item='+item+'&op='+rad,
						url: '../../planeacion/orden/eliminar_detalle_orden.php',
						success: function(data) {
							
							console.log(data);
							$("#msj").html('');
							return true;
						},
						beforeSend: function(){
                                    $("#msj").html('<img src="../../images/load.gif"> Cargando...');
                                },
                        complete: function () {
                        	$("#msj").html('');
                                var op = $("#rad").val();
                                var tip = $("#typo").val();
                                var doc = $("#compra").val();
                                consultar_sticker(op);
                                consultar_detalle(tip,doc);
                                
                        }
					});
				});
				
			}
                    }else{
                        alert("¡Esta op se encuentra guardada y no puedes anular items!");
                    }
}
function save_total(){
 
    var ct = $("#ct").val();
    var canord = $("#canord").val();
     var cot = $('#idcot').val();
  var cct = parseInt(canord) + 1;
    if(parseInt(cct)<parseInt(ct)){
        var c1 = confirm("¡AVISO! Hay item sin generar el sticker, ¿Deseas Seguir?");
        if(!c1){
            return false;
        }
    }
        var estado = $("#est").val();
        if(estado=='0'){
            var c = confirm("Estas segura de mandar esta OP a produccion?");
            if(c){
               var cantidad_total = $("#ct").val();
     		var cantidad_total_produccion = $("#ct").val();
     		var opf = $("#compra").val();
     		var nombre_obra= $("#obs").val();
     		var nombre_cliente= $("#nterc").val();
     		var clase_vid= $("#des0").val();
     		var observacion= $("#obs").val();
                var cli= $("#nombrepro").val();
                var op= $("#rad").val();
     		//alert('La cantidad total es ->'+cantidad_total+ ' Cantidad de principales -> '+cantidad_total_produccion + 'nombre_obra -> '+nombre_obra+' clase  -> '+clase_vid + ' observacion -> '+observacion);
            $.ajax({    
                type: 'GET',
                data:   'cot='+cot+
		                '&cli='+cli+
		                '&op='+op+
		                '&opf='+opf+
		                '&nombre_obra='+nombre_obra+
		                '&nombre_cliente='+nombre_cliente+
		                '&observacion='+observacion+
		                '&clase_vid='+clase_vid+
		                '&cant_total='+cantidad_total+
		                '&cant_total_p='+cantidad_total_produccion,
                url: 'guardar_op.php',
                success: function(data){
                    alert(data);
                    $("#est").val('1');
                    
                        $("#Guardar").attr("class","btn-success");
                     
                    consultar_sticker(op);
                }
            }); 
            }
        }else{
            alert("Esta OP se encuentra guardada.");
        }
    
}

function stiker_all(){
    var op = $("#rad").val();
    var cot = $("#idcot").val();
    var opf = $("#compra").val();
    var rep=0;
   window.open('http://172.16.0.40/planeacion/2/all_sticker.php?op='+op+'&cot='+cot+'&opf='+opf+'&rep='+rep , 'reposiciones', 'width=600,height=500');
       
    }
    function stiker_all2(){
    var op = $("#rad").val();
    var cot = $("#idcot").val();
    var opf = $("#compra").val();
    var rep=0;
   window.open('http://172.16.0.40/planeacion/2/all_sticker_1.php?op='+op+'&cot='+cot+'&opf='+opf+'&rep='+rep , 'reposiciones', 'width=600,height=500');
       
    }
    
    function stiker_all_usd(){
    var op = $("#rad").val();
    var cot = $("#idcot").val();
    var opf = $("#compra").val();
    var rep=0;
   window.open('http://172.16.0.40/planeacion/2/all_sticker_us.php?op='+op+'&cot='+cot+'&opf='+opf+'&rep='+rep , 'reposiciones', 'width=600,height=500');
       
    }
 function openop(){
     var estado = $("#est").val();
        if(estado=='1'){
  var op = $("#rad").val();
  var c = confirm("Estas segura de abrir esta OP a produccion?");
            if(c){
                
            
  var ob = prompt("Por que motivo vas a abrir esta OP?");
  if(ob=='' || ob==null){
      alert("Debes de escribir algun motivo para poder abrir esta OP!");
      return false;
      
  }
    $.ajax({
                type: 'GET',
                data: 'op='+op+'&ob='+ob+'&sw=5',
                url: '../../planeacion/orden/acciones_tem.php',
                success: function(t) {
                    alert("Se abrio la OP con exito");
                     $("#est").val(t);
                     consultar_sticker(op);
                    
                }
     });
     }
 }else{
     alert("Opcion no disponible");
 }
}

function anularop(){
    var anularOP = confirm("Desea Anular la O.P " + $("#rad").val() + "?");
			if (anularOP == true) {
				var id_cot = $("#idcot").val();
				var id_op = $("#rad").val();
				var id_cli = 0;
				var por = prompt("Por que se anulo esta orden de produccion?");
				if(por===''){
					alert("Describa por que se anulo esta orden");
					return false;
				}
				$.ajax({
					type: "GET",
					data: "id_cot="+id_cot+"&id_op="+id_op+"&por="+(por),
					url: "anular_orden.php",
					success: function(data) {
						 alert("Se anulo la OP con exito");
                                                 $("#est").val(data);
						
					}
				});
			}
}
 function upitemsop(item){
     var estado = $("#est").val();
        if(estado=='0'){
            var op = $("#rad").val();
            
               var per = $("#per"+item).val();
               var boq = $("#boq"+item).val();
               var m1 = $("#med1"+item).val();
               var m2 = $("#med2"+item).val();
               
               var ma1 = $("#meda1"+item).val();
               var ma2 = $("#meda2"+item).val();
               
                var idpro = $("#id"+item).val();
                var ubi = $("#ubicp"+item).val();
                $.ajax({
                            type: 'GET',
                            data: 'item='+item+'&per='+per+'&boq='+boq+'&m1='+m1+'&m2='+m2+'&ma1='+ma1+'&ma2='+ma2+'&idpro='+idpro+'&ubi='+ubi+'&sw=6',
                            url: '../../planeacion/orden/acciones_tem.php',
                            success: function(t) {
                                alert("Se edito el items con exito");
                               

                            }
                 });
                
            }else{
                alert("Opcion no disponible");
            }
}
function partes(item){
    var cot = $("#idcot").val();
    var op = $("#rad").val();
    $("#idre").val(item);
    $.ajax({
                            type: 'GET',
                            data: 'item='+item+'&cot='+cot+'&op='+op+'&sw=7',
                            url: '../../planeacion/orden/acciones_tem.php',
                            success: function(t) {
                                $("#mostrar_cantidad").html(t);
                            }
                 });
}
function addpartes(item){
    var cot = $("#idcot").val();
    var op = $("#rad").val();
    
    var ubi = $("#dubi").val();
    var m1 = $("#dmed1").val();
    var m2 = $("#dmed2").val();
    var can = $("#dcant").val();
    var dmt = $("#dmt").val();
    var mt = (m1/1000) * (m2/1000) * can ;
    if(parseFloat(mt) > parseFloat(dmt)){
        var c = confirm("El metro cuadrado del items "+mt+" supera al restante "+dmt+", deseas seguir ?");
        if(!c){
            
            return false;
        }
        
        
    }

    $.ajax({
                            type: 'GET',
                            data: 'item='+item+'&ubi='+encodeURIComponent(ubi)+'&m1='+m1+'&m2='+m2+'&can='+can+'&op='+op+'&sw=8',
                            url: '../../planeacion/orden/acciones_tem.php',
                            success: function(t) {
                                alert(t);
                                partes(item);
                                consultar_sticker(op);
                            }
                 });
}
function agregap(item) {
        window.open('http://172.16.0.40/planeacion/combos/viplane.php?item='+item, 'Vidrios', "width=1000, height=500");
      }
      
      function agregaespesor(item) {
        window.open('http://172.16.0.40/planeacion/combos/espesores.php?item='+item, 'Vidrios', "width=1000, height=500");
      }
function medidas()
{
    var op = $("#rad").val();
      window.open('http://172.16.0.40/planeacion/vistas/medidas.php?op='+op, 'contacto', 'width=500,height=400');
}
function generarall(){
    var op = $("#rad").val();
    var cot = $('#idcot').val();
    var cantt = $('#totalp').val();
    var ct = $('#ct').val();
    var ctitem = $('#ctitem').val();
    var ctitemori = $('#ctitemori').val();
    if(parseInt(ct)!=parseInt(cantt)){
        alert("Ya no puedes generar todos los sticker al mismo tiempo");
        return false;
    }
    if(cantt=='0'){
        alert("Ya se generaron los sticker");
        return false;
    }
    var conf = confirm("Estas seguro de generar todos los sticker?");
    if(conf){
      
        $("#btnall").html('<img src="../../images/load.gif"> Generando...');
        $('#btnall').attr('disabled',true);
        var contador = 0;
    $("input[name=item]:checked").each(function(){
         contador++;
	var i = $(this).attr("id");

                var ord = $('#iditem'+i).val();
                var id = $('#id_r'+i).val();
                var ancho = $('#ancho1'+i).val();
                var anchohid = $('#anchohid'+i).val();
                var anchod = $('#anchod'+i).val();
                var anchocomp = $('#anchocomp'+i).val();
                var alto = $('#alto1'+i).val();
                var altohid = $('#altohid'+i).val();
                var altod = $('#altod'+i).val();
                var cantidad = $("#cant"+i).val();
                 var cantidadid = $("#cantid"+i).val();
                var ubicacion = $("#obs1"+i).val();
                var observaciones = $("#obs2"+i).val();
                var lado = $('#lado'+i).val();               
                var per = $('#per'+i).val();
                var boq = $('#boq'+i).val();
               
                var tipo = $('#tip'+i).val();
                var producto = $('#des'+i).val();
                
                 $('#m'+i).html(contador);
                        $.ajax({
                        type : 'GET',
                        url : '../../planeacion/orden/insertar_detalle_orden.php?cot='+cot+'&per='+per+'&boq='+boq+'&op='+op+'&ord='+ord+'&id='+id+'&ancho='+ancho+'&anchohid='+anchohid+'&anchod='+anchod+'&alto='+alto+'&altohid='+altohid+'&altod='+altod+'&cantidad='+cantidad+'&ubicacion='+ubicacion+'&observaciones='+observaciones+'&producto='+producto+'&tipo='+tipo+'&lado='+lado+'&anchocomp='+anchocomp,
                        
                        success: function(data){
                                console.log(data);
                            consultar_cantidad_agregada(ord,i);
                            if(parseInt(ctitem)===parseInt(contador)){
                                $("#btnall").html('Sticker Generados');
                                $('#btnall').attr('disabled',false);
                                consultar_sticker(op);
                            } 
                        }
                        });
                               
    });
    
    }

    
}

function update_espesor(idv,item){
    var cot = $("#idcot").val();
    var op = $("#rad").val();

    $.ajax({
                            type: 'GET',
                            data: 'item='+item+'&cot='+cot+'&op='+op+'&idv='+idv+'&sw=10',
                            url: '../../planeacion/orden/acciones_tem.php',
                            success: function(t) {
                               consultar_sticker(op);
                            }
                 });
}