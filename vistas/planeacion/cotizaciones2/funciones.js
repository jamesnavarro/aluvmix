$(function() {

    $("#cot").change(function(){
        mostrarCot(1);
    });
    $("#ped").change(function(){
        mostrarCot(1);
    });
    $("#nom").change(function(){
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
    $("#obs").change(function(){
        $("#cod1").focus();
    });
});
function mostrarCot(page) {
		cot = $("#cot").val();
		nom = $("#nom").val();
		obr = $("#obr").val();
		reg = $("#reg").val();
                ana = $("#se").val();
                est = $("#estado").val();
                freg = $("#freg").val();
                pre = $("#precio").val();
                ped = $("#ped").val();
                $("#load").html('<img src="../images/load.gif"> Cargando...');
		$.post("../vistas/planeacion/cotizaciones/mostrar_cotizaciones.php", {
                    cot:cot, nom:nom, obr:obr, reg:reg, page:page,ana:ana,est:est,freg:freg,pre:pre,ped:ped
                },
                function(data) {
			$("#cotizacione").html(data);
                        $("#load").html('');
		});
}
function ver_cotizacion(cot,linea){
             window.open('../vistas/planeacion/cotizaciones/pedido.php?cot='+cot+'&linea='+linea,'seg1','width=1300px,height=700');  
        }
        function sucursales(){
            var cot = $("#cot").val();
             window.open('../../inventario/popup/sucursales/sucursales.php?cot='+cot,'sucursales','width=600px,height=600');  
        }
function mostrar_cotizacion(id,lin){
      $.ajax({
                type: 'GET',
                data: 'id='+id+'&sw=1',
                url: '../cotizaciones/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#numcot").val(t[24]+'.'+t[25]);
              $("#de").html(t[70]);
              $("#Guardar").html(t[69]);
              if(t[71]=='1'){
                  $("#Guardar").attr("disabled",false);
              }else{
                   $("#Guardar").attr("disabled",true);
              }
              //consulta de tercero Guardar
              //en esta parte se consulta el pedido sin haberse guardado en fomplus
             if(t[64]==''){
                 consultar_tercero(t[33]);
                 detalles_cotizacion(id,lin);
             }else{
                 validar_tercero(t[64]);
                 detalles_pedido(id,lin);
                 $("#obs").val(t[62]);
             }
              
              consultar_usuarios(t[6]);
              
              //fin
              $("#codalm").val();
              $("#nomalm").val();
              $("#est").val(t[7]);
              $("#tipo").val(t[53]);
              $("#pedido").val(t[54]);
              
              $("#codalm").val(t[57]);
              $("#cc").val(t[58]);
             
              $("#sucursal").val(t[60]);
               $("#ciudad").val(t[67]);
             

             
         }
    
});
}
function consultar_tercero(ced){
      $.ajax({
                type: 'GET',
                data: 'cod='+ced+'&sw=2',
                url: '../cotizaciones/acciones.php',
         success: function(t) {
             var t = eval(t);      
              $("#nombrepro").val(t[0]);
              $("#nterc").val(t[2]);
              $("#direccion").val(t[4]);
              //$("#ciudad").val(t[7]);              
              validar_tercero(t[0]);   
         }
       });
}
function validar_ciudad(cod){
    $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=11',
                url: '../cotizaciones/acciones.php',
         success: function(t) {
             //alert(cod);
             $("#ciudad").val(t);        
         }
       });
}
function validar_tercero(ced){
   
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAECXC/'+ced,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
             var est = da.CLI_ACTIVO;
             if(est=='1'){
                 alert('¡Este tercero se encuentra inactivo!');
                 return false;
             }
             $("#nombrepro").val(da.CLI_CEDULA);
             $("#nterc").val(da.CLI_NOMBRE); 
             $("#codcue").val(da.CLI_TIPCTA);
             $("#direccion").val(da.CLI_DIRECC);
             $("#ciu").val(da.CLI_SUBZON);
             $("#cre").val(da.CLI_FORPAG);
              $("#codalm").focus();
             consultar_cuenta(da.CLI_TIPCTA);
             validar_ciudad(da.CLI_SUBZON);
             consultar_tercero_monty(da.CLI_CEDULA,da.CLI_NOMBRE,da.CLI_TIPCTA,da.CLI_DIRECC,da.CLI_SUBZON,da.CLI_TELEFO,da.CLI_EMAIL,da.CLI_VENDED);
             
             
          }
        }).fail( function( jqXHR, textStatus, errorThrown ) {  
             alert( 'Cliente no encontrado en fomplus.' );
             inv_tercero_popup(ced);
             
             $("#nombrepro").val('');
              $("#nterc").val('');
//           $("#est"+ced).html('');
             return false;
        });
}
function consultar_usuarios(id){
      $.ajax({
                type: 'GET',
                data: 'id='+id+'&sw=3',
                url: '../cotizaciones/acciones.php',
         success: function(t) {
             var t = eval(t);
               $("#idven").val(t[4]);
               $("#por").val(t[7]+' '+t[8]);
              
         }
    
});
}
function consultar_cuenta(id){
      $.ajax({
                type: 'GET',
                data: 'id='+id+'&sw=4',
                url: '../cotizaciones/acciones.php',
         success: function(t) {
             var t = eval(t);
                $("#codcue").val(t[0]);
               $("#nomcue").val(t[1]);  
         }
});
}
function bus_cencost(){
    var cc = $('#cc').val();
    var cen = ('00000000'+cc).slice(-8);
    $('#cc').val(cen);
    $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAESEC/'+cen,
          //url:'http://172.16.0.30:8989/api/MAESEC/'+cen,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
             var est = p.SEC_ACTIVO;
             if(est==false){
              $("#cc").val(p.SEC_CODIGO);
              $("#centro").val(p.SEC_NOMBRE);
              // agregar observaciones
              var nterc = $('#nterc').val();
              var ciudad = $('#ciudad').val();
              var fecha = $('#fecha').val();
              $("#obs").val(nterc+'/');
              $("#obs").focus();
             }else{
                  $("#cc").val('');
                  $("#centro").val('');
                  return false;
             }
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {  
             $("#cc").val('');
              $("#centro").val('');
             return false;
        });

}
function bus_almacen(){
    var cc = $('#codalm').val();
    var cen = ('0000'+cc).slice(-4);
    $('#codalm').val(cen);
    $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAEALM/'+cen,
          //url:'http://172.16.0.30:8989/api/MAESEC/'+cen,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
              $("#codalm").val(p.ALM_CODIGO);
              $("#nomalm").val(p.ALM_NOMBRE);
               $("#cc").focus();
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {  
             $("#codalm").val('');
              $("#nomalm").val('');
             return false;
        });

}
function buscarpt(i){
    var cod = $('#cod'+i).val();
    var codtem = $('#codtem'+i).val();
    $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod,
          //url:'http://172.16.0.30:8989/api/MAESEC/'+cen,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
             var ref = p.INV_REFER;
             var nom = p.INV_NOMBRE;
             var gru = p.INV_GRUPO;
             var cla = p.INV_CLASE;
             var codf = p.INV_CODIGO;
             $("#cod"+i).val(ref);
             $("#gru"+i).val(gru);
             $("#cla"+i).val(cla);
             var co = confirm("PT ENCONTRADO: "+nom+", Deseas relacionar el pt a monty?");
             if(co){
                //actualizarpt(codtem,ref,gru,cla,codf);
                var ti = parseInt(i) + 1;
              
                $("#cod"+ti).focus();
             }else{
                 $("#cod"+i).val('');
             }

          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {  
             alert( 'PT no encontrado en fomplus' );
             $("#cod"+i).val('');
             return false;
        });
    validarpt();
}
function actualizarpt(t,c,gru,cla,ref){
      $.ajax({
                type: 'GET',
                data: 'cod='+t+'&pt='+c+'&gru='+gru+'&cla='+cla+'&ref='+ref+'&sw=5',
                url: '../cotizaciones/acciones.php',
         success: function(t) {
              //alert('Se actualizo el codigo de fomplus con la PT de Monty.');
         }
});
}
function consultar_tercero_monty(ced,nom,cuenta,dire,zona,tel,ema,ven){
      $.ajax({
                type: 'GET',
                data: 'ced='+ced+'&nom='+nom+'&cuenta='+cuenta+'&dire='+dire+'&zona='+zona+'&tel='+tel+'&ema='+ema+'&ven='+ven+'&sw=1',
                url: '../cotizaciones/modelo.php',
         success: function(t) {
             console.log(t); 
         }
    
});
}
function detalles_cotizacion(id,lin){

    if(lin=='Vidrio'){
        $.ajax({
                type: 'GET',
                data: 'cot='+id,
                url: 'detalles_vidrio.php',
                success: function(t) {
                     $("#mostrar_moviemientos").html(t);
                }
           });
    }else{
       $.ajax({
                type: 'GET',
                data: 'cot='+id,
                url: 'detalles.php',
                success: function(t) {
                     $("#mostrar_moviemientos").html(t);
                }
           });
    }
      
}
function detalles_pedido(id,lin){

        $.ajax({
                type: 'GET',
                data: 'cot='+id,
                url: 'detalles_pedido.php',
                success: function(t) {
                     $("#mostrar_moviemientos").html(t);
                }
           });
 
      
}
function inv_tercero_popup(cc){
    //validar_documento(); //validador si el documento se encuentra guardado
    
     window.open("../cotizaciones/terceros_fom/tercero.php?cc="+cc, "tercero", "width=900px , height=600px");
}
function ImprimirPedido(){
   var cot = $("#cot").val();
    var ped = $("#pedido").val();
    if(ped!==''){
     window.open("../cotizaciones/PrintPedido.php?cot="+cot, "tercero", "width=900px , height=600px");
 }
}
function save_total(){
    validarpt();
    var cot = $('#cot').val();
    var ciu = $('#ciu').val();
    var ter = $('#nombrepro').val();
    var cue = $('#codcue').val();
    var alm = $('#codalm').val();
    var tra = $('#tran').val();
    var suc = $('#sucursal').val();
    var ven = $('#idven').val();
    var obs = $('#obs').val();
    var cen = $('#cc').val();
    var tipo = $('#tipo').val();
    var total = $('#gran_total').val();
    var direccion = $('#direccion').val();
    var ciudad = $('#ciudad').val();
    var est = $('#est').val();
    var cre = $('#cre').val();
    if(est=='Aprobado'){
        alert("¡Ya esta cotizacion esta aprobada! ");
        return false;
    }
    if(tipo==''){
        alert("Selecciona el tipo de Orden");
        $('#tipo').focus();
        return false;
    }
    if(cue==''){
        alert("El cliente no tiene tipo de cuenta, !!Agreguelo en fomplus!!");
 
        return false;
    }
    if(ter==''){
        alert("Digita el tercero");
        $('#nombrepro').focus();
        return false;
    }
    if(alm==''){
        alert("Digita el codigo del almacen");
        $('#codalm').focus();
        return false;
    }
     if(cen==''){
        alert("Digita el centro de costo");
        $('#cc').focus();
        return false;
    }
    if(obs==''){
        alert("Digite alguna observacion");
        $('#obs').focus();
        return false;
    }
    var ct = $('#ct').val();
    var cv = $('#cv').val(); 
    var contador = 0;
         $("input[name=item]:checked").each(function(){
                   var i = $(this).attr("id");
                   var cod = $('#col'+i).val();
                  $.ajax({
                      type:'GET',
                      url:'http://172.16.0.30:8989/api/MAELOTE/'+cod,
                      contentType: 'application/json',
                      success: function(da){
                         var p = eval(da);
                         contador++;
                      },
                        complete: function () {
                        	if(parseInt(ct)==parseInt(contador)){
                                        $('#Guardar').attr("disabled",true);
                                        $.ajax({
                                              type: 'GET',
                                              data: 'cot='+cot+'&ciu='+ciu+'&ter='+ter+'&ciudad='+ciudad+'&direccion='+encodeURIComponent(direccion)+'&total='+total+'&cue='+cue+'&alm='+alm+'&tra='+tra+'&suc='+suc+'&cen='+cen+'&ven='+ven+'&obs='+encodeURIComponent(obs)+'&tp='+tipo+'&cre='+cre+'&sw=6',
                                              url: '../cotizaciones/acciones.php',
                                                      success: function(t) {
                                                           alert('Se actualizaron los datos hacia fomplus. '+t);
                                                           $('#est').val('Aprobado');

                                                      }
                                             });
                                             $("input[name=item]:checked").each(function(){
                                                      var id = $(this).attr("id");
                                                      var cod = $('#cod'+id).val();
                                                      var cla = $('#cla'+id).val();
                                                      var gru = $('#gru'+id).val();
                                                      var ref = $('#ref'+id).val();
                                                      var des = $('#des'+id).val();
                                                      var und = $('#und'+id).val();
                                                      var med = $('#med'+id).val();
                                                      var col = $('#col'+id).val();
                                                      var can = $('#can'+id).val();
                                                      var vlr = $('#vlr'+id).val();
                                                      var tot = $('#tot'+id).val();
                                                      var obs = $('#obs'+id).val();
                                                      var item = $('#item'+id).val();
                                                                 $.ajax({
                                                          type: 'GET',
                                                          data: 'cot='+cot+'&cod='+cod+'&cla='+cla+'&gru='+gru+'&ref='+ref+'&des='+encodeURIComponent(des)+'&und='+und+'&med='+encodeURIComponent(med)+'&col='+col+'&can='+can+'&vlr='+vlr+'&tot='+tot+'&obs='+obs+'&item='+item+'&sw=8',
                                                          url: '../cotizaciones/acciones.php',
                                                                  success: function(t) {
                                                                       //alert('Se actualizaron los detalles. '+t);

                                                                  }
                                                         });
                                                  });
                                                  detalles_pedido(cot,1);
                                  }
                                
                        }
                     }).fail( function( jqXHR, textStatus, errorThrown ) {  
                           alert( 'Este color '+cod+' no existe en fomplus, cambie el color' );
                           $("#col"+i).val('');
                           contador = 0;
                            return false;
                     });
          });

}
function validarpt(){
    var c = 0;
    $("input[name=item]:checked").each(function(){
                        var id = $(this).attr("id");
                        var cod = $('#cod'+id).val();
                       if(cod!==''){
                           c++;
                           
                       }
                    });
                    $("#cv").val(c);
}
function save_fom(){
    var ped = $("#pedido").val();
    if(ped==''){
     var cot = $("#cot").val();
     var est = $("#est").val();
     if(est=='En proceso'){
         alert("Debes de aprobar la cotizacion primero");
         return false;
     }
     var c = confirm("Esta seguro de guardar la orden en fomplus?.");
     if(c){
         $('#GuardarFom').attr("disabled",true);
      $.ajax({
          type:'GET',
          dataType: "json",
          data:'cot='+cot+'&sw=7',
          url:'acciones.php',
          success: function(da){
             console.log(da);
             pasar_saveoc(da,cot);
          }
      });
}
    }else{
        alert("Ya se genero el pedido");
        return false;
    }
}
function pasar_saveoc(datos,ord){  
      $.ajax({
          type:'POST',
          data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/Pedidos', 
          contentType: 'application/json',
          success: function(da){
              debugger;
             var p = eval(da);
              console.log('Resultado: '+p.DocumentoFomplus+' orden ='+ord);
               var f = p.DocumentoFomplus;
              $("#pedido").val(f);
             
             pasar_num_oc(f,ord);
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( '¡ERROR! al generar el pedido, verifique la informacion del cliente o las medidas que no esten duplicadas. ' +datos);
//           $("#est"+ced).html('');
             return false;
        });
  }
   function pasar_num_oc(fom,ord){
      $.ajax({
          type:'GET',
          data:'ord='+ord+'&fom='+fom+'&sw=9',
          url:'acciones.php',
          success: function(da){
             console.log('save: '+da+' ord: '+ord);
             alert("El pedido se ha guardado en fomplus con el numero "+fom);
             ImprimirPedido();
          }
      });
      
  }

function buscarcodfom(id){
    $("#contador").val(id);
    $("#modalfom").modal('show');
}
function buscarptfon(page){
    var cod = $("#fom_cod").val();
    if(cod==''){
        cod='*';
    }else{
        cod=cod;
    }
    $("#page").val(page);
    $("#mostrar_tabla2").html('<tr><td colspan="2">Cargando<img src="../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod+'/'+page+'/50',
          dataType: 'json',
          success: function(da){
            
              //console.log('Resultado: '+da);
              render = "";
              $.each(da, function(i, item) {
                //console.log(item);
                render+= showRow(i,item);
              });
              $('#productos_fom').html(render);
          }
        
      });
  }
  function showRow(i, dev){
             var ref = "'"+dev.INV_REFER+"'";
             var nom = "'"+dev.INV_NOMBRE+"'";
             var gru = "'"+dev.INV_GRUPO+"'";
             var cla = "'"+dev.INV_CLASE+"'";
             var codf = "'"+dev.INV_CODIGO+"'";
             
  var row = '<tr>'+
              '<td>'+dev.INV_REFER+'\
<input type="hidden" id="cod'+dev.INV_REFER+'" value="'+dev.INV_REFER+'">\n\
<input type="hidden" id="nom'+dev.INV_REFER+'" value="'+dev.INV_NOMBRE+'">\n\
<input type="hidden" id="gru'+dev.INV_REFER+'" value="'+dev.CLI_TELEFO+'">\n\
<input type="hidden" id="cla'+dev.INV_REFER+'" value="'+dev.CLI_EMAIL+'">\n\
<input type="hidden" id="ref'+dev.INV_REFER+'" value="'+dev.INV_CODIGO+'">\n\
</td><td><a href="#" onclick="pasarptfon('+ref+','+gru+','+cla+','+codf+')">'+dev.INV_NOMBRE+'</a></td></tr>';
  return row;

}
function pasarptfon(ref,gru,cla,codf){
    var id = $("#contador").val();
    $("#cod"+id).val(ref);
    $("#gru"+id).val(gru);
    $("#cla"+id).val(cla);
    $("#ref"+id).val(codf);
    alert(ref);
     $("#modalfom").modal('hide');
}

function anul_c(){
       var est = $("#est").val();
//    if(est=='En Proceso'){
        var c = confirm("Esta seguro de anular este pedido");
//        if(c){
//        $.ajax({
//          type:'GET',
//          data:'anular=1&ordenx='+$("#idorden").val(),
//          url:'../vistas/planeacion/aprofom/acciones.php',
//          success: function(data){
//              alert(data);
//              $("#est").val('Anulado');
//          }
//      });
//        }  
           
}
function updateitemped(id){
    var est = $('#est').val();
    var pedido = $('#pedido').val();
    if(est=='Aprobado' && pedido!=''){
        alert("¡Ya no puedes modificar los items, tienes que ir al modulo de mantenimiento!");
        return false;
    }
                        var cod = $('#cod'+id).val();
                        var cla = $('#cla'+id).val();
                        var gru = $('#gru'+id).val();
                        var ref = $('#ref'+id).val();
                        var des = $('#des'+id).val();
                        var und = $('#und'+id).val();
                        var med = $('#med'+id).val();
                        var col = $('#col'+id).val();
                        var can = $('#can'+id).val();
                        var vlr = $('#vlr'+id).val();
                       
                        var obs = $('#obs'+id).val();
                        var item = $('#item'+id).val();
                        var tt = can * vlr;
                         var tot = $('#tot'+id).val(tt);
                                   $.ajax({
                            type: 'GET',
                            data: 'cod='+cod+'&cla='+cla+'&gru='+gru+'&ref='+ref+'&des='+encodeURIComponent(des)+'&und='+und+'&med='+encodeURIComponent(med)+'&col='+col+'&can='+can+'&vlr='+vlr+'&tot='+tt+'&obs='+obs+'&item='+item+'&sw=10',
                            url: '../cotizaciones/acciones.php',
                                    success: function(t) {
                                         alert(t);
                                         
                                    }
                           });
}

function aiu(id,lin){
$("#e").html('Pasando..<img src="../../images/guardando.gif" style="height: 30px">');
$('#codcue').val('21');
$('#nomcue').val('VENTAS OBRAS AIU');
       $.ajax({
                type: 'GET',
                data: 'cot='+id,
                url: '../cotizaciones/detallesaiu.php',
                success: function(t) {
                     $("#mostrar_moviemientos").html(t);
                     $("#e").html('AIU');
                }
           });
    
      
}
function contar(id){
    var texto = $("#des"+id).val();
     var x = texto.length;
     $("#con"+id).html(x);
}
function buscarcolor(id){
             window.open('../../planeacion/cotizaciones/popup/colores/color.php?posicion='+id,'sucursales','width=600px,height=600');  
        }