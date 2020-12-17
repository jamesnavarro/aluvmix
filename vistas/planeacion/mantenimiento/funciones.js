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
		$.post("../vistas/planeacion/mantenimiento/mostrar_mantenimiento.php", {
                    cot:cot, nom:nom, obr:obr, reg:reg, page:page,ana:ana,est:est,freg:freg,pre:pre,ped:ped
                },
                function(data) {
			$("#cotizacione").html(data);
                        $("#load").html('');
		});
}
function ver_cotizacion(cot,linea){
             window.open('../vistas/planeacion/mantenimiento/pedido.php?cot='+cot+'&linea='+linea,'seg1','width=1300px,height=700');  
        }
        function sucursales(){
            var cot = $("#cot").val();
             window.open('../../inventario/popup/sucursales/sucursales.php?cot='+cot,'sucursales','width=600px,height=600');  
        }
function mostrar_cotizacion(id,lin){
      $.ajax({
                type: 'GET',
                data: 'id='+id+'&sw=1',
                url: 'acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#numcot").val(t[24]+'.'+t[25]);
              //consulta de tercero
              //en esta parte se consulta el pedido sin haberse guardado en fomplus
//             if(t[64]==''){
//                 consultar_tercero(t[33]);
//                 detalles_cotizacion(id,lin);
//             }else{
                 validar_tercero(t[64]);
                 detalles_pedido(id,lin);
                 $("#obs").val(t[62]);
             //}
              if(t[54]!=''){
                $("#codcue").val(t[56]);
                consultar_cuenta(t[56]);
              }
              
              //fin
              $("#codalm").val();
              $("#nomalm").val();
              $("#est").val(t[7]);
              $("#tipo").val(t[53]);
              $("#pedido").val(t[54]);
              pedidofom(t[53],t[54]);
              
              $("#codalm").val(t[57]);
              $("#cc").val(t[58]);
             
              $("#sucursal").val(t[60]);
               $("#ciudad").val(t[67]);
             $("#msg").html(t[71]);
             $("#idven").val(t[61]);
         consultar_usuarios(t[6]);

             
         }
    
});
}
function consultar_tercero(ced){
      $.ajax({
                type: 'GET',
                data: 'cod='+ced+'&sw=2',
                url: '../mantenimiento/acciones.php',
         success: function(t) {
             var t = eval(t);
              //consulta de tercero
              
              $("#nombrepro").val(t[0]);
              $("#nterc").val(t[2]);
              $("#direccion").val(t[4]);
              $("#ciudad").val(t[7]);
              
              validar_tercero(t[0]);
              //fin
              
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
             
             $("#direccion").val(da.CLI_DIRECC);
             $("#ciu").val(da.CLI_SUBZON);
              $("#codalm").focus();
              var cu = $("#pedido").val();
              if(cu==''){
                  $("#codcue").val(da.CLI_TIPCTA);
                  consultar_cuenta(da.CLI_TIPCTA);
              }
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
                url: '../mantenimiento/acciones.php',
         success: function(t) {
             var t = eval(t);
               $("#idven").val(t[4]);
               $("#por").val(t[7]+' '+t[8]);  
               historial();
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
function consultar_cuenta(id){
      $.ajax({
                type: 'GET',
                data: 'id='+id+'&sw=4',
                url: '../mantenimiento/acciones.php',
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
             //validarcolor(codtem,ref,gru,cla,codf,i);
             
             var co = confirm("PT ENCONTRADO: "+nom+", Deseas relacionar el pt a monty?");
             if(co){
                actualizarpt(codtem,ref,gru,cla,codf);
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
                url: '../mantenimiento/acciones.php',
         success: function(t) {
              alert('Se actualizo el codigo de fomplus con la PT de Monty.');
         }
});
}
function detalles_cotizacion(id,lin){

    if(lin=='Vidrio'){
        $.ajax({
                type: 'GET',
                data: 'cot='+id,
                url: '../mantenimiento/detalles_vidrio.php',
                success: function(t) {
                     $("#mostrar_moviemientos").html(t);
                }
           });
    }else{
       $.ajax({
                type: 'GET',
                data: 'cot='+id,
                url: '../mantenimiento/detalles.php',
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
                url: '../mantenimiento/detalles_pedido.php',
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
     window.open("../mantenimiento/PrintPedido.php?cot="+cot, "tercero", "width=900px , height=600px");
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
    if(est=='Aprobado'){
        alert("¡Ya esta cotizacion esta aprobada! ");
        return false;
    }
    if(tipo==''){
        alert("Selecciona el tipo de Orden");
        $('#tipo').focus();
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
    if(cv!==ct){
        
    }
    $('#Guardar').attr("disabled",true);
          $.ajax({
                type: 'GET',
                data: 'cot='+cot+'&ciu='+ciu+'&ter='+ter+'&ciudad='+ciudad+'&direccion='+encodeURIComponent(direccion)+'&total='+total+'&cue='+cue+'&alm='+alm+'&tra='+tra+'&suc='+suc+'&cen='+cen+'&ven='+ven+'&obs='+encodeURIComponent(obs)+'&tp='+tipo+'&sw=6',
                url: '../mantenimiento/acciones.php',
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
                            url: '../mantenimiento/acciones.php',
                                    success: function(t) {
                                         //alert('Se actualizaron los detalles. '+t);
                                         
                                    }
                           });
                    });
      detalles_pedido(cot,1);
}
function validarpt(){
    var c = 0;
    $("input[name=item]:checked").each(function(){
                        var id = $(this).attr("id");
                        var cod = $('#cod'+id).val();
                        validarcolor(id);
                       if(cod!==''){
                           c++;
                           
                       }
                    });
                    $("#cv").val(c);
} 
function update_fom(){

     var ped = $("#pedido").val();
     var cot = $("#cot").val();
     var est = $("#est").val();
     var cue = $("#codcue").val();
   if(est=='Anulado'){
       alert("Ya este pedido se encuentra anulado.");
       return false;
   }
     if(cue==''){
         alert("No puedes editar este pedido, no tiene tipo de cuenta, agregalo en fomplus");
         return false;
     }
     var c = confirm("Esta seguro de actualizar este pedido?..");
     if(c){
         var ct = $('#ct').val();
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
                                
                        }
                     }).fail( function( jqXHR, textStatus, errorThrown ) {  
                           alert( 'Este color '+cod+' no existe en fomplus, cambie el color' );
                           $("#col"+i).val('');
                           contador = 0;
                            return false;
                     });
          });
         
       
}
    
}
function validarcolor(i){
    var cod = $('#col'+i).val();
    $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAELOTE/'+cod,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {  
             alert( 'Este color '+cod+' no existe en fomplus, cambie el color' );
             $("#col"+i).val('');
            
             return false;
        });

}
function pasar_saveoc(datos,ord){  

      $.ajax({
          type:'POST',
          data: JSON.stringify(datos),
           url:'http://172.16.0.30:8989/api/Pedidos/PostDetalle',
          contentType: 'application/json',
          success: function(da){
             // debugger;
             var p = eval(da);
              console.log('Resultado: '+p.DocumentoFomplus+' orden ='+ord);
               var f = p.DocumentoFomplus;
              $("#pedido").val(f);
              updatepedidofom();
             
             alert("El pedido se ha Editado en fomplus con exito "+f);
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( '¡ERROR! al actualizar el detalle de los items del pedido. ' );
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

function anular_pedido(){
       var est = $("#est").val();
        var cot = $("#cot").val();
   if(est=='Anulado'){
       alert("Ya este pedido se encuentra anulado.");
       return false;
   }
        var c = confirm("Esta seguro de anular este pedido");
        if(c){
            var d = prompt("Por que se anula este pedido?");
            if(d==''){
                alert("---ERROR----\nDebes de digitar alguna descripcion!");
                return false;
            }
        $.ajax({
          type:'GET',
          data:'sw=9&cot='+cot+'&d='+d,
          url:'acciones.php',
          success: function(data){
              alert(data);
              $("#est").val('Anulado');
          }
      });
        }  
           
}
function updateitemped(id){
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
                         var cot = $('#cot').val();
                         var lin = '';
                         $.ajax({
                            type: 'GET',
                            data: 'cod='+cod+'&cla='+cla+'&gru='+gru+'&ref='+ref+'&des='+encodeURIComponent(des)+'&und='+und+'&med='+encodeURIComponent(med)+'&col='+col+'&can='+can+'&vlr='+vlr+'&tot='+tt+'&obs='+obs+'&item='+item+'&sw=10',
                            url: 'acciones.php',
                                    success: function(t) {
                                         alert(t);
                                         detalles_pedido(cot,lin);
                                         historial();
                                         
                                    }
                           });
}
function uppedido(){
       var est = $("#est").val();
        var cot = $("#cot").val();
        var obs = $("#obs").val();
        var ven = $("#idven").val();
   if(est=='Anulado'){
       alert("Ya este pedido se encuentra anulado.");
       return false;
   }
        var c = confirm("Esta seguro de editar este pedido");
        if(c){
            
        $.ajax({
          type:'GET',
          data:'sw=11&cot='+cot+'&obs='+obs+'&ven='+ven,
          url:'acciones.php',
          success: function(data){
              alert(data);  
              historial();
          }
      });
        }  
           
}
function contar(id){
    var texto = $("#des"+id).val();
     var x = texto.length;
     $("#con"+id).html(x);
}
function pedidofom(tipo,pedido){
//    var tipo = $("#tipo").val();
//    var pedido = $("#pedido").val();

      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAEPEDCXC/'+pedido+'/'+tipo+'',
          dataType: 'json',
          success: function(da){
           $("#PED_TIPPED").val(da.PED_TIPPED);
$("#PED_NUMPED").val(da.PED_NUMPED);
$("#PED_CIUDAD").val(da.PED_CIUDAD);
$("#PED_CEDULA").val(da.PED_CEDULA);
$("#PED_CEDCON").val(da.PED_CEDCON);
$("#PED_FECPED").val(da.PED_FECPED);
$("#PED_FECINI").val(da.PED_FECINI);
$("#PED_FECVEN").val(da.PED_FECVEN);
$("#PED_ORDCOM").val(da.PED_ORDCOM);
$("#PED_AGENTE").val(da.PED_AGENTE);
$("#PED_DESPP").val(da.PED_DESPP);
$("#PED_DESPF").val(da.PED_DESPF);
$("#PED_PLAZO").val(da.PED_PLAZO);
$("#PED_VENDED").val(da.PED_VENDED);
$("#PED_TIPCLI").val(da.PED_TIPCLI);
$("#PED_LISPRE").val(da.PED_LISPRE);
$("#PED_TIPCTA").val(da.PED_TIPCTA);
$("#PED_TIPNOT").val(da.PED_TIPNOT);
$("#PED_VALFLE").val(da.PED_VALFLE);
$("#PED_VALSEG").val(da.PED_VALSEG);
$("#PED_TASARM").val(da.PED_TASARM);
$("#PED_MONEDA").val(da.PED_MONEDA);
$("#PED_BODEGA").val(da.PED_BODEGA);
$("#PED_ALMCON").val(da.PED_ALMCON);
$("#PED_CODSEC").val(da.PED_CODSEC);
$("#PED_CODTRA").val(da.PED_CODTRA);
$("#PED_OBSERV").val(da.PED_OBSERV);
$("#PED_OBSADI").val(da.PED_OBSADI);
$("#PED_DIRENV").val(da.PED_DIRENV);
$("#PED_ESTREG").val(da.PED_ESTREG);
$("#PED_ACTIVO").val(da.PED_ACTIVO);
$("#PED_CIERRE").val(da.PED_CIERRE);
$("#PED_ESTADO").val(da.PED_ESTADO);
$("#PED_COPIAS").val(da.PED_COPIAS);
$("#PED_NOMEMP").val(da.PED_NOMEMP);
$("#PED_VERSIO").val(da.PED_VERSIO);
$("#PED_EQUIPO").val(da.PED_EQUIPO);
$("#PED_CODOPE").val(da.PED_CODOPE);
$("#PED_FECOPE").val(da.PED_FECOPE);
$("#PED_USUARIO").val(da.PED_USUARIO);
$("#PED_PROREG").val(da.PED_PROREG);
$("#PED_SECTOR").val(da.PED_SECTOR);
$("#PED_NUMREQ").val(da.PED_NUMREQ);
$("#PED_TIPREQ").val(da.PED_TIPREQ);
$("#PED_TIPOPE").val(da.PED_TIPOPE);
$("#PED_CEDREF").val(da.PED_CEDREF);
$("#PED_NUMEVE").val(da.PED_NUMEVE);
$("#PED_VALPED").val(da.PED_VALPED);
$("#PED_TIPINV").val(da.PED_TIPINV);
$("#PED_PREFIJ").val(da.PED_PREFIJ);
$("#PED_OBSINT").val(da.PED_OBSINT);
$("#PED_FECAUT").val(da.PED_FECAUT);
$("#PED_PORIMP").val(da.PED_PORIMP);
$("#PED_PORADM").val(da.PED_PORADM);
$("#PED_CODCLI").val(da.PED_CODCLI);
$("#PED_FECENT").val(da.PED_FECENT);
$("#PED_CONENT").val(da.PED_CONENT);
$("#PED_TIPANT").val(da.PED_TIPANT);
$("#PED_PREANT").val(da.PED_PREANT);
$("#PED_NUMANT").val(da.PED_NUMANT);
$("#PED_FECANT").val(da.PED_FECANT);
$("#PED_VALANT").val(da.PED_VALANT);
$("#PED_AUTCOS").val(da.PED_AUTCOS);
$("#PED_CONREQ").val(da.PED_CONREQ);
$("#PED_SOLANT").val(da.PED_SOLANT);
$("#PED_FECCOS").val(da.PED_FECCOS);
$("#PED_USUCOS").val(da.PED_USUCOS);
$("#PED_USUSOL").val(da.PED_USUSOL);
$("#PED_FECSOL").val(da.PED_FECSOL);
$("#PED_NUMCON").val(da.PED_NUMCON);
$("#PED_CONPRO").val(da.PED_CONPRO);
$("#PED_FECORD").val(da.PED_FECORD);
$("#PED_CODICA").val(da.PED_CODICA);

          }
        
      });
  }
  
function updatepedidofom(){
var PED_TIPPED=$("#PED_TIPPED").val();
var PED_NUMPED=$("#PED_NUMPED").val();
var PED_CIUDAD=$("#PED_CIUDAD").val();
var PED_CEDULA=$("#PED_CEDULA").val();
var PED_CEDCON=$("#PED_CEDCON").val();
var PED_FECPED=$("#PED_FECPED").val();
var PED_FECINI=$("#PED_FECINI").val();
var PED_FECVEN=$("#PED_FECVEN").val();
var PED_ORDCOM=$("#PED_ORDCOM").val();
var PED_AGENTE=$("#PED_AGENTE").val();
var PED_DESPP=$("#PED_DESPP").val();
var PED_DESPF=$("#PED_DESPF").val();
var PED_PLAZO=$("#PED_PLAZO").val();
var PED_VENDED=$("#idven").val();
var PED_TIPCLI=$("#PED_TIPCLI").val();
var PED_LISPRE=$("#PED_LISPRE").val();
var PED_TIPCTA=$("#PED_TIPCTA").val();
var PED_TIPNOT=$("#PED_TIPNOT").val();
var PED_VALFLE=$("#PED_VALFLE").val();
var PED_VALSEG=$("#PED_VALSEG").val();
var PED_TASARM=$("#PED_TASARM").val();
var PED_MONEDA=$("#PED_MONEDA").val();
var PED_BODEGA=$("#PED_BODEGA").val();
var PED_ALMCON=$("#PED_ALMCON").val();
var PED_CODSEC=$("#PED_CODSEC").val();
var PED_CODTRA=$("#PED_CODTRA").val();
var PED_OBSERV=$("#obs").val();
var PED_OBSADI=$("#PED_OBSADI").val();
var PED_DIRENV=$("#PED_DIRENV").val();
var PED_ESTREG=$("#PED_ESTREG").val();
var PED_ACTIVO=$("#PED_ACTIVO").val();
var PED_CIERRE=$("#PED_CIERRE").val();
var PED_ESTADO=$("#PED_ESTADO").val();
var PED_COPIAS=$("#PED_COPIAS").val();
var PED_NOMEMP=$("#PED_NOMEMP").val();
var PED_VERSIO=$("#PED_VERSIO").val();
var PED_EQUIPO=$("#PED_EQUIPO").val();
var PED_CODOPE=$("#PED_CODOPE").val();
var PED_FECOPE=$("#PED_FECOPE").val();
var PED_USUARIO=$("#PED_USUARIO").val();
var PED_PROREG=$("#PED_PROREG").val();
var PED_SECTOR=$("#PED_SECTOR").val();
var PED_NUMREQ=$("#PED_NUMREQ").val();
var PED_TIPREQ=$("#PED_TIPREQ").val();
var PED_TIPOPE=$("#PED_TIPOPE").val();
var PED_CEDREF= $("#PED_CEDREF").val();
var PED_NUMEVE=$("#PED_NUMEVE").val();
var PED_VALPED=$("#PED_VALPED").val();
var PED_TIPINV=$("#PED_TIPINV").val();
var PED_PREFIJ=$("#PED_PREFIJ").val();
var PED_OBSINT=$("#PED_OBSINT").val();
var PED_FECAUT=$("#PED_FECAUT").val();
var PED_PORIMP=$("#PED_PORIMP").val();
var PED_PORADM=$("#PED_PORADM").val();
var PED_CODCLI=$("#PED_CODCLI").val();
var PED_FECENT=$("#PED_FECENT").val();
var PED_CONENT=$("#PED_CONENT").val();
var PED_TIPANT=$("#PED_TIPANT").val();
var PED_PREANT=$("#PED_PREANT").val();
var PED_NUMANT=$("#PED_NUMANT").val();
var PED_FECANT=$("#PED_FECANT").val();
var PED_VALANT=$("#PED_VALANT").val();
var PED_AUTCOS=$("#PED_AUTCOS").val();
var PED_CONREQ=$("#PED_CONREQ").val();
var PED_SOLANT=$("#PED_SOLANT").val();
var PED_FECCOS=$("#PED_FECCOS").val();
var PED_USUCOS=$("#PED_USUCOS").val();
var PED_USUSOL=$("#PED_USUSOL").val();
var PED_FECSOL=$("#PED_FECSOL").val();
var PED_NUMCON=$("#PED_NUMCON").val();
var PED_CONPRO=$("#PED_CONPRO").val();
var PED_FECORD=$("#PED_FECORD").val();
var PED_CODICA=$("#PED_CODICA").val();
 $.ajax({
          type:'GET',
          data:'PED_TIPPED='+PED_TIPPED+'\
&PED_NUMPED='+PED_NUMPED+'\
&PED_CIUDAD='+PED_CIUDAD+'\
&PED_CEDULA='+PED_CEDULA+'\
&PED_CEDCON='+PED_CEDCON+'\
&PED_FECPED='+PED_FECPED+'\
&PED_FECINI='+PED_FECINI+'\
&PED_FECVEN='+PED_FECVEN+'\
&PED_ORDCOM='+PED_ORDCOM+'\
&PED_AGENTE='+PED_AGENTE+'\
&PED_DESPP='+PED_DESPP+'\
&PED_DESPF='+PED_DESPF+'\
&PED_PLAZO='+PED_PLAZO+'\
&PED_VENDED='+PED_VENDED+'\
&PED_TIPCLI='+PED_TIPCLI+'\
&PED_LISPRE='+PED_LISPRE+'\
&PED_TIPCTA='+PED_TIPCTA+'\
&PED_TIPNOT='+PED_TIPNOT+'\
&PED_VALFLE='+PED_VALFLE+'\
&PED_VALSEG='+PED_VALSEG+'\
&PED_TASARM='+PED_TASARM+'\
&PED_MONEDA='+PED_MONEDA+'\
&PED_BODEGA='+PED_BODEGA+'\
&PED_ALMCON='+PED_ALMCON+'\
&PED_CODSEC='+PED_CODSEC+'\
&PED_CODTRA='+PED_CODTRA+'\
&PED_OBSERV='+PED_OBSERV+'\
&PED_OBSADI='+PED_OBSADI+'\
&PED_DIRENV='+PED_DIRENV+'\
&PED_ESTREG='+PED_ESTREG+'\
&PED_ACTIVO='+PED_ACTIVO+'\
&PED_CIERRE='+PED_CIERRE+'\
&PED_ESTADO='+PED_ESTADO+'\
&PED_COPIAS='+PED_COPIAS+'\
&PED_NOMEMP='+PED_NOMEMP+'\
&PED_VERSIO='+PED_VERSIO+'\
&PED_EQUIPO='+PED_EQUIPO+'\
&PED_CODOPE='+PED_CODOPE+'\
&PED_FECOPE='+PED_FECOPE+'\
&PED_USUARIO='+PED_USUARIO+'\
&PED_PROREG='+PED_PROREG+'\
&PED_SECTOR='+PED_SECTOR+'\
&PED_NUMREQ='+PED_NUMREQ+'\
&PED_TIPREQ='+PED_TIPREQ+'\
&PED_TIPOPE='+PED_TIPOPE+'\
&PED_CEDREF='+PED_CEDREF+'\
&PED_NUMEVE='+PED_NUMEVE+'\
&PED_VALPED='+PED_VALPED+'\
&PED_TIPINV='+PED_TIPINV+'\
&PED_PREFIJ='+PED_PREFIJ+'\
&PED_OBSINT='+PED_OBSINT+'\
&PED_FECAUT='+PED_FECAUT+'\
&PED_PORIMP='+PED_PORIMP+'\
&PED_PORADM='+PED_PORADM+'\
&PED_CODCLI='+PED_CODCLI+'\
&PED_FECENT='+PED_FECENT+'\
&PED_CONENT='+PED_CONENT+'\
&PED_TIPANT='+PED_TIPANT+'\
&PED_PREANT='+PED_PREANT+'\
&PED_NUMANT='+PED_NUMANT+'\
&PED_FECANT='+PED_FECANT+'\
&PED_VALANT='+PED_VALANT+'\
&PED_AUTCOS='+PED_AUTCOS+'\
&PED_CONREQ='+PED_CONREQ+'\
&PED_SOLANT='+PED_SOLANT+'\
&PED_FECCOS='+PED_FECCOS+'\
&PED_USUCOS='+PED_USUCOS+'\
&PED_USUSOL='+PED_USUSOL+'\
&PED_FECSOL='+PED_FECSOL+'\
&PED_NUMCON='+PED_NUMCON+'\
&PED_CONPRO='+PED_CONPRO+'\
&PED_FECORD='+PED_FECORD+'\
&PED_CODICA='+PED_CODICA+'&sw=12',
          url:'acciones.php',
          success: function(data){
              console.log('res:'+data);   
              editar_pedido_fomplus(data);
          }
      });

  }
  
  function editar_pedido_fomplus(datos){  
      console.log(datos);
      $.ajax({
          type:'PUT',
          data: (datos),
          url:'http://172.16.0.30:8989/api/MAEPEDCXC', 
          contentType: 'application/json',
          success: function(da){
              console.log('Se edito el encabezado');
              registrar_historial();

          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( '¡ERROR! al editar el pedido, verifique la informacion del cliente. ');
             return false;
        });
  }
  function vendedores(){
             window.open('../../planeacion/mantenimiento/popup/vendedores/sucursales.php','sucursales','width=600px,height=600');  
        }
        function buscarcolor(id){
             window.open('../../planeacion/mantenimiento/popup/colores/color.php?posicion='+id,'sucursales','width=600px,height=600');  
        }
  function historial(){
        var cot = $("#cot").val(); 
        $.ajax({
          type:'GET',
          data:'sw=13&cot='+cot+'',
          url:'acciones.php',
          success: function(data){
               $("#modificaciones").html(data);   
          }
      });
       
           
}      
function registrar_historial(){
        var cot = $("#cot").val(); 
        $.ajax({
          type:'GET',
          data:'sw=14&cot='+cot+'',
          url:'acciones.php',
          success: function(data){
              historial();   
          }
      });
       
           
}