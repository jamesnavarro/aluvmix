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
		$.post("../vistas/planeacion/aprofom/mostrar_cotizaciones.php", {
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
                url: '../aprofom/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#numcot").val(t[24]+'.'+t[25]);
              //consulta de tercero
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
                url: '../aprofom/acciones.php',
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
             $("#codcue").val(da.CLI_TIPCTA);
             $("#direccion").val(da.CLI_DIRECC);
             $("#ciu").val(da.CLI_SUBZON);
              $("#codalm").focus();
             consultar_cuenta(da.CLI_TIPCTA);
             
             
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
                url: '../aprofom/acciones.php',
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
                url: '../aprofom/acciones.php',
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
              $("#cc").val(p.SEC_CODIGO);
              $("#centro").val(p.SEC_NOMBRE);
              $("#obs").focus();
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
                url: '../aprofom/acciones.php',
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
                url: '../aprofom/detalles_vidrio.php',
                success: function(t) {
                     $("#mostrar_moviemientos").html(t);
                }
           });
    }else{
       $.ajax({
                type: 'GET',
                data: 'cot='+id,
                url: '../aprofom/detalles.php',
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
                url: '../aprofom/detalles_pedido.php',
                success: function(t) {
                     $("#mostrar_moviemientos").html(t);
                }
           });
 
      
}
function inv_tercero_popup(cc){
    //validar_documento(); //validador si el documento se encuentra guardado
    
     window.open("../aprofom/terceros/tercero.php?cc="+cc, "tercero", "width=900px , height=600px");
}
function ImprimirPedido(){
   var cot = $("#cot").val();
    var ped = $("#pedido").val();
    if(ped!==''){
     window.open("../aprofom/PrintPedido.php?cot="+cot, "tercero", "width=900px , height=600px");
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
    //3114342468
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
          $.ajax({
                type: 'GET',
                data: 'cot='+cot+'&ciu='+ciu+'&ter='+ter+'&ciudad='+ciudad+'&direccion='+encodeURIComponent(direccion)+'&total='+total+'&cue='+cue+'&alm='+alm+'&tra='+tra+'&suc='+suc+'&cen='+cen+'&ven='+ven+'&obs='+encodeURIComponent(obs)+'&tp='+tipo+'&sw=6',
                url: '../aprofom/acciones.php',
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
                            data: 'cot='+cot+'&cod='+cod+'&cla='+cla+'&gru='+gru+'&ref='+ref+'&des='+des+'&und='+und+'&med='+med+'&col='+col+'&can='+can+'&vlr='+vlr+'&tot='+tot+'&obs='+obs+'&item='+item+'&sw=8',
                            url: '../aprofom/acciones.php',
                                    success: function(t) {
                                         //alert('Se actualizaron los detalles. '+t);
                                    }
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


function anul_p(){
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