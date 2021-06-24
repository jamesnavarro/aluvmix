$(function(){
     $("#mostrar_tabla").html(mostrar_lista(1));
     
    $('#doc').change(function(){
        mostrar_lista(1);
      });
     $('#tip').change(function(){
        mostrar_lista(1);
      }); 
      
     $('#alm').change(function(){
         mostrar_lista(1);
     });
     $('#fec').change(function(){
        mostrar_lista(1);
      });
 });  
 function mostrar_lista(page){
    var doc = $("#doc").val();
    var tip = $("#tip").val();
     var alm = ('000'+$("#alm").val()).slice(-4);
  
    var fec = $("#fec").val();
//    if(tip==''){
//        alert("Seleccione el tipo de movimiento");
//        return false;
//    }
    if(alm==''){
        alert("Digita el codigo del almacen");
        return false;
    }
    if(fec==''){
        alert("Selecciona la fecha del pedido");
        return false;
    }
    if(doc==''){
        doc='*';
    }else{
        doc=doc;
    }
    $("#page").val(page);
    $("#mostrar_tabla").html('<tr><td colspan="2">Cargando<img src="../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/DOCINV2021/lista/'+tip+'/'+doc+'/'+page+'/30/'+fec+'/'+alm+'',
          dataType: 'json',
          success: function(da){
            
              //console.log('Resultado: '+da);
              render = "";
              $.each(da, function(i, item) {
                //console.log(item);
                render+= showRow(i,item);
              });
              $('#mostrar_tabla').html(render);
          }
        
      });
  }
  function showRow(i, dev){
     // consultar_cod_alu(dev.CLI_CEDULA);
     
     var tipo = "'"+dev.MOV_TIPMOV+"'";
     var doc = "'"+dev.MOV_NUMDOC+"'";
     consultar_orden_monty_lista(dev.MOV_TIPMOV,dev.MOV_NUMDOC);
  var row= '<tr id="color'+dev.MOV_NUMDOC+'">'+
              '<td>'+dev.MOV_NUMDOC+'</td>'+
              '<td>'+dev.MOV_TIPMOV+'</td>'+
              '<td>'+dev.MOV_BODEGA+'</td>'+
              '<td>'+dev.MOV_DOCAFE+'</td>'+
              '<td>'+dev.MOV_FECHA+'</td>'+
              '<td id="est'+dev.MOV_NUMDOC+'"></td>'+
              '<td id="rad'+dev.MOV_NUMDOC+'"></td>'+
               '<td>'+dev.MOV_OBSERV+'</td><td>'+dev.MOV_CODOPE+'</td>'+
              '<td><button type="button" name="Ver" onclick="vermov('+tipo+','+doc+')"> Ver</button></td></tr>';
  return row;

}
function paginacion(p){
    var page = $("#page").val();
    var t = parseInt(page) + parseInt(p);
    if(t==0){
        mostrar_lista(1);
    }else{
        mostrar_lista(t);
        $("#page").val(t);
    }
    
}

 function vermov(tip,num){

      $.ajax({
                type: 'GET',
                data: 'tipo='+tip+'&sw=1',
                url: '../vistas/inventario/movimiento_fom/acciones.php',
         success: function(t) {
            var t = eval(t);
              window.open("../vistas/inventario/movimiento_fom/formulario.php?tipo="+t[2]+"&num="+num+"&mov="+tip, "Productos", "width=1300px , height=800px"); 
         }
     
});
 }
 function consultar_enc(tip,num){
   
     $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
           url:'http://172.16.0.30:8989/api/DOCINV2021/'+tip+'/'+num+'/1/1',
          contentType: 'application/json',
          success: function(da){
             $.each(da, function(i, p) {
                 console.log('Resultado: '+p.MOV_BODEGA);
                 $("#typo").val(p.MOV_PREAFE);
                 $("#compra").val(p.MOV_DOCAFE);
                 $("#loc").val(p.MOV_BODEGA);
                 $("#nombrepro").val(p.MOV_CEDULA);
                 $("#cedula").val(p.MOV_CEDULA);
                 $("#doc").val(p.MOV_TIPMOV);
//                 $("#ndoc").val(p.name_tipo);
                 $("#cc").val(p.MOV_COSTOS);
                 $("#obs").val(p.MOV_OBSERV);
                  $("#docfom").val(p.MOV_NUMDOC);
                  $("#FecReg").val(p.MOV_FECHA);
                   $("#por").val(p.MOV_CODOPE);
                  
                   busca_mov(p.MOV_TIPMOV);
                   bus_cencost(p.MOV_COSTOS);
                   bus_bodega(p.MOV_BODEGA);
                   bus_ter(p.MOV_CEDULA);
                   //bus_pedido(p.MOV_DOCAFE);
                   consultar_detalle(tip,num);
                   consultar_orden_monty(tip,num);
              });    
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             return false;
        });
 }
 function consultar_detalle(tip,doc){

    $("#mostrar_moviemientos").html('<tr><td colspan="9">Cargando<img src="../../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MOVINV2021/'+tip+'/'+doc+'/1/100',
          dataType: 'json',
          success: function(da){
              var total = 0;
              var row = "";
              $.each(da, function(i, dev) {
                   var cod = "'"+dev.MOV_REFER+"'";
                   var col = "'"+dev.MOV_LOTE+"'";
                   var med = "'"+dev.MOV_UBICA+"'";
                   var can = "'"+dev.MOV_CANTID+"'";
                  consultarproducto(dev.MOV_REFER,i);
                  
                  var doc = "'"+dev.MOV_NUMDOC+"'";
                  var t = dev.MOV_VALOR / dev.MOV_CANTID;
                  total = parseFloat(total) + parseFloat(dev.MOV_VALOR);
                  row+= '<tr>'+
                        '<td><input type="text" id="cod'+i+'" value="'+dev.MOV_REFER+'" disabled style="width: 100%"></td>'+
                        '<td><input type="text" id="des'+i+'" value="" disabled style="width: 100%"></td>'+
                        '<td><input type="text" id="col'+i+'" value="'+dev.MOV_LOTE+'" disabled style="width: 100%"></td>'+
                        '<td><input type="text" id="med'+i+'" value="'+dev.MOV_UBICA+'" disabled style="width: 100%"></td>'+
                        '<td><input type="text" id="can'+i+'" value="'+dev.MOV_CANTID+'" disabled style="width: 100%"></td>'+
                        '<td><input type="text" id="pre'+i+'" value="'+t+'" disabled style="width: 100%"></td>'+
                        
                         '<td><input type="text" id="tot'+i+'" value="'+dev.MOV_VALOR+'" disabled style="width: 100%"></td>'+
                         '<td><input type="text" id="pen'+i+'" value="" disabled style="width: 100%"></td>'+
                        '<td><button type="button" name="Ver" onclick="darubicacion('+cod+','+col+','+med+','+can+','+i+')"> Ubicacion </button>\n\
                             <input type="checkbox" id="'+i+'" name="item" checked disabled>\n\
                             <input type="text" id="idi'+i+'" value="" disabled style="width: 50px"> <button onclick="devolver('+can+','+i+')">?</button></td></tr>';
                   setTimeout(consultar_items_id(dev.MOV_REFER,dev.MOV_LOTE,dev.MOV_UBICA,i,dev.MOV_CANTID),4000);
                   //consultar_productos_monty();
              });
              
              row+= '<tr><td colspan="7"></td><td><input type="text" id="totalp" value="" disabled style="width: 100%"></td>';
              pasartotal(total);
         
              
              $('#mostrar_moviemientos').html(row);
          }
        
      }).done(function() {
          setTimeout(consultar_productos_monty,1000);
       });
      
  }
  
  function devolver(can,i){
      var est = $("#est").val();
      if(est==1){
          alert("Este documento ya se encuentra guardado, No puedes devolver las cantidades pendientes.");
          return false;
      }
      var c = confirm("Estas seguro de reestablecer las cantidades pendientes?");
      if(c){
      var bod= $("#loc").val();
      var rad= $("#rad").val();
      var descarga= $("#descarga").val();
      var pen= $("#pen"+i).val();
      var idi= $("#idi"+i).val();
      $.ajax({
                type: 'GET',
                 data: 'idi='+idi+'&bod='+bod+'&rad='+rad+'&descarga='+descarga+'&sw=6.2',
                url: 'acciones.php',
         success: function(t) {
             alert(t);
             $("#pen"+i).val(can);
         }
      });
    }
      
  }
  function pasartotal(t){
   $("#totalx").val(t);
  }
function busca_mov(cod){
      $.ajax({
                type: 'GET',
                 data: 'tipo='+cod+'&sw=1',
                url: 'acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#ndoc").val(t[1]);     
         }
});
 }
   function bus_cencost(codc){

      $.ajax({
                type: 'GET',
                data: 'codcc='+codc+'&sw=12',
                url: '../../inventario/movimientos/modelo.php',
         success: function(d) {
             var t = eval(d);

              $("#centro").val(t[2]);
     
         }
    
});
 }
  function bus_bodega(codb){
     var codb = $("#loc").val();
     var tm = $("#doc").val();
      $.ajax({
                type: 'GET',
                data: 'codb='+codb+'&sw=13',
                url: '../../inventario/movimientos/modelo.php',
         success: function(p) {
             var t = eval(p);
              $("#loc").val(t[1]);
              $("#nloc").val(t[2]); 
              $("#sede").val(t[3]); 
              if(tm=='59'){
                consultar_puesto(t[3]);
              }
         }
     
});
 }
 function consultar_puesto(sede){

      $.ajax({
                type: 'GET',
                data: 'sede='+sede,
                url: '../../inventario/movimientos/puestos.php',
         success: function(t) {
              $("#puesto").html(t);  
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
                 data: 'cod='+cod+'&sw=2',
                url: 'acciones.php',
                success: function(t) {
                    var p = eval(t);
                     $("#des"+i).val(p[2]); 
                     //consultar_id_items()
                }
           });
 }
 function darubicacion(cod,col,med,can,i){
     consultar_productos_monty();
      var rad = $("#rad").val();
      if(rad==''){
          alert("Debes de procesar el documento primero.");
          $("#continuar").focus();
          return false;
      }
     var idi = $("#idi"+i).val();
     var pen = $("#pen"+i).val();
     var tipo = $("#descarga").val();
 
      $("#cod").val(cod);  
      $("#cant").val(pen);
      $("#colo").val(col);
      $("#med").val(med);
      $("#codid").val(idi);
      var d = $("#des"+i).val();
       $("#descri").val(d);
       buscarubicaciones(tipo);
//       if(tipo=='SALIDA'){
     $("#inventario_send").modal('show');
     buscarubicacionesingresados();
// }else{
//     $("#inventario_sal").modal('show');
//     buscarubicacionesingresadosin();
// }
       
 }
 function buscarubicaciones(tipo){
     var bod = $("#loc").val();
     var cod = $("#cod").val();
     var med = $("#med").val();
      
     var col = $("#colo").val();
     $.ajax({
                type: 'GET',
                data: 'bod='+bod+'&cod='+cod+'&med='+med+'&col='+col+'&tipo='+tipo+'&sw=3',
                url: 'acciones.php',
                success: function(t) {
                    $("#mostrar_ubi_pro").html(t);
                }
     });
 }
 function buscarubicacionesingresados(){
     var bod = $("#loc").val();
     var cod = $("#cod").val();
     var med = $("#med").val();
     var col = $("#colo").val();
     var item = $("#cod").val();
     $.ajax({
                type: 'GET',
                data: 'bod='+bod+'&cod='+item+'&med='+med+'&col='+col+'&item='+item+'&sw=3.1',
                url: 'acciones.php',
                success: function(t) {
                    $("#mostrar_ingresado").html(t);
                }
     });
 }
  function buscarubicacionesingresadosin(){
     var bod = $("#loc").val();
     var cod = $("#cod").val();
     var med = $("#med").val();
     var col = $("#colo").val();
     var item = $("#codid").val();
     $.ajax({
                type: 'GET',
                data: 'bod='+bod+'&cod='+item+'&med='+med+'&col='+col+'&item='+item+'&sw=3.1',
                url: 'acciones.php',
                success: function(t) {
                    $("#mostrar_ingresadoin").html(t);
                }
     });
 }
  function bus_pedido(ord){

     $.ajax({
                type: 'GET',
                data: 'ord='+ord+'&sw=3',
                url: 'acciones.php',
                success: function(t) {
                    $("#factura").val(t);
                }
     });
 }
 function addubi(id){
    var canpri = $("#cant").val();
    var caning = $("#u_ing"+id).val();
    var canubi = $("#u_can"+id).val();
    var tipo = $("#descarga").val();
    var color_solicitado = $("#colo").val();
    var color_bodega = $("#u_col"+id).val();
    
    if(tipo=='SALIDA'){
    if(parseFloat(caning)>parseFloat(canubi)){
        alert("La cantidad digitada supera la cantidad de la ubicacion");
        $("#u_ing"+id).val('');
        return false;
    }
    if(color_solicitado!=color_bodega){
        alert("El color solicitado no es igual al que estas seleccionando");
        return false;
    }
   }
    if(parseFloat(caning)>parseFloat(canpri)){
        alert("La cantidad digitada supera la cantidad solicitada del items");
        $("#u_ing"+id).val('');
        return false;
    }
    save_mod_ubi_sal(id);
 }
 function save_mod_ubi_sal(id){
    var cc = confirm("Estas seguro de dar salida a este items?");
    if(cc){
    var loc = $("#loc").val(); 
    var rad = $("#rad").val(); 
    var cod = $("#cod").val(); 
   
    var cans = $("#cant"+id).val(); 
    var st = $("#u_can"+id).val();// restar a este campo
    var color = $("#colo").val();
    var tipo = $("#descarga").val();
    if(tipo=='SALIDA'){
       var ubi = $("#u_ubi"+id).val();
        var cant = $("#u_ing"+id).val(); // caja de resta en caso de salida
        var desc = st - cant;
        $("#u_can"+id).val(desc);
    }else{
        var ubi = $("#u_ubi").val();
         var cant = $("#u_ing").val(); 
    }
    var cost = '0';
    var idmd = $("#codid").val();
    
    if(cant=='' || cant=='0'){
        alert("Debes de digitar la cantidad "+ubi);
        $("#u_ing"+id).val('').focus();
        return false;
    }
    if(parseFloat(cant) > parseFloat(cans)){
        alert('La cantidad digitada es mayor al cantidad solicitada');
        $("#ca"+id).val('').focus();
        return false;
    }
//    if(parseInt(cant) > parseInt(st)){
//        alert('La cantidad digitada es mayor al stock actual');
//        $("#ca"+id).val('').focus();
//        return false;
//    }
    var tip = $("#doc").val(); 
    var num = $("#docfom").val();
    $("#botonubi").attr("disabled",true);
    $.ajax({
            type: 'GET',
            data: 'rad='+rad+'&loc='+loc+'&cod='+cod+'&idmd='+idmd+'&cost='+cost+'&cant='+cant+'&st='+st+'&ubi='+ubi+'&color='+color+'&tipo='+tipo+'&sw=7',  //
            url: 'acciones.php', //
            success: function(resultado){
//                mostrar_ubi_can();
//                cargadatos(rad);
alert(resultado);
                $("#inventario_send").modal('hide');
                $("#inventario_sal").modal('hide');
                $("#ubi").val('');
                consultar_detalle(tip,num);
                
                $("#botonubi").attr("disabled",false);
            }
        });
    }
}
 function continuar(){
    
    var rad = $("#rad").val();//id_mov
    var doc = $("#doc").val();//codigo_tm
    var cc = $("#cc").val();//cen_codigo
    var obs = $("#obs").val();//obs
    var compra = $("#compra").val();//id_orden
    var factura = $("#factura").val();//num_docuemnto
    var almori = $("#loc").val();//bod_codigo
    var totalx = $("#totalx").val();//total
    var est = $("#est").val();//save
    var ter = $("#nombrepro").val();//codigo_ter
    var diferencia = $("#diferencia").val();//diferencia
    var por = $("#por").val();//usuario
    var descarga = $("#descarga").val();//tipo_movimiento
    var sede = $("#sede").val();//tipo_movimiento
    var docfom = $("#docfom").val();//tipo_movimiento
    var ced = $("#cedula").val();//tipo_movimiento
    var tipo = $("#typo").val();//tipo_movimiento
    var puesto = $("#puesto").val();//tipo_movimiento
    
    if(rad==''){
        var c = confirm("Esta seguro de procesar el documento de inventario en monty?");
    }else{
        return false;
    }
    if(doc=='59'){
        if(puesto=='0'){
            alert("Debes de seleccionar el puesto de trabajo");
            $("#puesto").focus();
            return false;
        }
    }
    if(c){
     $.ajax({
            type: 'GET',
            data: 'rad='+rad+'&ced='+ced+'&tipo='+tipo+'&doc='+doc+'&docfom='+docfom+'&cc='+cc+'&sede='+sede+'&obs='+encodeURIComponent(obs)+'&compra='+compra+'&factura='+factura+
                    '&almori='+almori+'&totalx='+totalx+'&est='+est+'&ter='+ter+'&diferencia='+diferencia+'&por='+por+'&descarga='+descarga+'&puesto='+puesto+'&sw=4',
            url: 'acciones.php',
            success: function(resultado){
               var p = eval(resultado);
               //alert(resultado);
                   if(rad==''){
                        save_item_fom(p[0]);
                    }else{
                        $("#estado").val('Completado');
                    }
                    $("#rad").val(p[0]);
                    //$("#FecReg").val(p[1]);
                    $("#por").val(p[2]);
                    console.log(p[3]);

            }
    });
    }
    
}
function verificaritem(){
    var cod = $("#rad").val();
    save_item_fom(cod);
}
function save_item_fom(idmov){
    var orden = $("#compra").val();
    var rad = idmov;
    $("input[name=item]:checked").each(function(){
	var i = $(this).attr("id");
        var cod = $("#cod"+i).val();
        var med = $("#med"+i).val();
        var col = $("#col"+i).val();
        var can = $("#can"+i).val();
        var pcan = $("#pen"+i).val();
        var bod = $("#loc").val();
        var idcot = '';
        var pre = $("#pre"+i).val();
        var des = $("#des"+i).val();
        var t;
        var line = '';
        $.ajax({
				type: 'POST',
				data: 'rad='+rad+'&cod='+cod+'&line='+line+'&pcan='+pcan+'&idcot='+idcot+'&pre='+pre+'&des='+encodeURIComponent(des)+'&med='+med+'&col='+col+'&bod='+bod+'&can='+can+'&orden='+orden+'&id='+i,
				url: 'agregar_prod.php',
				success: function(data){
                                    console.log(data);
                                    $("#idi"+i).val(data);
                              
				}
			});
        
                                
});
}
function validacion_referencias(){
    var ok = 0;
    $("input[name=item]:checked").each(function(){
	var i = $(this).attr("id");
        var cod = $("#cod"+i).val();
        var med = $("#med"+i).val();
        var col = $("#col"+i).val();
        var can = $("#can"+i).val();
        var pcan = $("#pen"+i).val();
        var bod = $("#loc").val();
        var idcot = '';
        var pre = $("#pre"+i).val();
        var des = $("#des"+i).val();
        var t;
        var line = ''; 
        $.ajax({
				type: 'POST',
				data: 'cod='+cod+'&line='+line+'&pcan='+pcan+'&idcot='+idcot+'&pre='+pre+'&des='+encodeURIComponent(des)+'&med='+med+'&col='+col+'&bod='+bod+'&can='+can+'&id='+i,
				url: 'validacion.php',
				success: function(data){
                                    if(data==0){
                                         $("#continuar").attr('disabled',true);
                                         alert('Hay referencias que no estan guardadas en monty.');
                                         return false;
                                    }else{
                                        $("#continuar").attr('disabled',false);
                                    }

				}
			});                            
});


}

function consultar_productos_monty(){
 
    $("input[name=item]:checked").each(function(){
        
	var i = $(this).attr("id");
        var cod = $("#cod"+i).val();
        var med = $("#med"+i).val();
        var col = $("#col"+i).val();
        var can = $("#can"+i).val();
        console.log('esta passando'+cod);
      
       consultar_items_id(cod,col,med,i,can);                            
   });

}
function consultar_orden_monty(tip,num){
   
    $.ajax({
                type: 'GET',
                data: 'tip='+tip+'&num='+num+'&sw=5',
                url: 'acciones.php',
                success: function(t) {
                     var p = eval(t);
                    $("#rad").val(p[0]);
                    $("#FecReg").val(p[3]);
                    $("#por").val(p[1]);
                    $("#est").val(p[2]);
                    
                    
                    if(p[2]==null){
                         $("#estado").val('En proceso');
                         //$("#loc").val('');
                    }else if(p[2]==0){
                        $("#estado").val('En proceso');
                        $("#loc").val(p[4]);
                         bus_bodega(p[4]);
                    }else{
                        $("#estado").val('Completado');
                        $("#loc").val(p[4]);
                         bus_bodega(p[4]);
                    }
//                    if(p[0]==null){
//                        $("#loc").attr("disabled",false);
//                    }else{
//                        $("#loc").attr("disabled",true);
//                    }
                    
                
                    
                }
     });
}
//864743 -- 14752
function consultar_items_id(cod,col,med,i,can){
    var rad = $("#rad").val();

        $.ajax({
                    type: 'GET',
                    data: 'rad='+rad+'&cod='+cod+'&med='+med+'&col='+col+'&can='+can+'&sw=6',
                    url: 'acciones.php',
                    success: function(data){
                        console.log('que:'+data);
                         var p = eval(data);
                        $("#idi"+i).val(p[0]);
                        $("#pen"+i).val(p[1]);

                    }
            });              
               
}
function consultar_orden_monty_lista(tip,num){

    $.ajax({
                type: 'GET',
                data: 'tip='+tip+'&num='+num+'&sw=5',
                url: '../vistas/inventario/movimiento_fom/acciones.php',
                success: function(t) {
                     var p = eval(t);
                    $("#rad"+num).html(p[0]);
//                    $("#FecReg").val(p[3]);
//                    $("#por").val(p[1]);
                    //$("#est"+num).val(p[2]);
                    if(p[0]!==null){
                        if(p[2]==0){
                            $("#est"+num).html('En proceso');
                             $("#color"+num).attr('BGCOLOR','#F2F5A9');
                        }else{
                            $("#est"+num).html('Completado');
                             $("#color"+num).attr('BGCOLOR','#81D470');
                        }
                   }else{
                       $("#color"+num).attr('BGCOLOR','#F6CECE');
                   }
                }
     });
}
function save_total() {
    var t=0;
    var i=0;
    
    $("input[name=item]:checked").each(function(){
	
        var pen = $("#pen"+i).val();
        //alert(pen);
        t = parseFloat(t) + parseFloat(pen);
        i++;             
     });
     $("#totalp").val(t);

//    if(t!='0'){
//        var cc = confirm("Hay items pendientes por dar ubicaciones, estas seguro de seguir?");
//        if(cc){
//            return true;
//        }else{
//            return false;
//        }
//        
//    }
    
    var co = confirm("Esta seguro de guardar este movimiento?");
    if(co){
     var rad = $("#rad").val();
     var tipo = $("#descarga").val();
     var loc = $("#loc").val();
     var ord = $("#compra").val();
     var fom = $("#docfom").val();
     var puesto = $("#puesto").val();
     var dif = 0;
     $.ajax({
            type: 'GET',
            data: 'rad='+rad+'&tipo='+tipo+'&loc='+loc+'&dif='+dif+'&ord='+ord+'&fom='+fom+'&puesto='+puesto+'&sw=9',  //
            url: 'acciones.php', //
            success: function(re){
                $("#estado").val('Guardado');
                $("#est").val('1');
                alert("Se guardo con exito.");
                window.opener.mostrar_lista(1);
                
            }
        });
    }
}
function sumar_pendientes(){
    var t=0;
    var i=0;
    
    $("input[name=item]:checked").each(function(){
	
        var pen = $("#pen"+i).val();
        //
        //
        //
        //alert(pen);
        t = parseFloat(t) + parseFloat(pen);
        i++;             
     });
     $("#totalp").val(t);
}
function Imprimir() {
            var x = document.getElementById('rad').value;
            var es = $("#estado").val();
            if(es=='Guardado' || es=='Completado'){
             $('<form action="../reportes/imprimir_resporte_mov.php" method="post" target="_blank"><input type="hidden" name="id_mov" value="'+x+'"/></form>')
              .appendTo('body').submit();
            }else{
                alert("El documento debe estar guardado.");
            }
            }
            
function buscarb(){
    var sede = $("#sede").val();
    window.open("ubicaciones_beta.php?sede="+sede, "Ubicaciones", "width=1600px , height=600px");
}
function pasar_info(ref) {
    document.getElementById('u_ubi').value = ref;
    //document.getElementById('ubip').value = ref;
    //mostrar_ubi_can();
}