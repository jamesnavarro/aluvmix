function cargarinvfom(op){


    $("#mostrar_tabla").html('<tr><td colspan="2">Cargando<img src="../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MOVINV2020/57/'+op,
          dataType: 'json',
          success: function(da){
            
              //console.log('Resultado: '+da);
              render = "";
              var tref = 0;
              
              $.each(da, function(i, item) {
                consultarref(item.MOV_REFER);
                u = item.MOV_VENTA / item.MOV_CANTID;
                tref += item.MOV_VENTA;
               render += '<tr>'+
              '<td style="">'+item.MOV_REFER+'</td>\n\
               <td id="des'+item.MOV_REFER+'">'+i+'</td>\n\
               <td style="text-align:center">'+item.MOV_UBICA+'</td>\n\
               <td style="text-align:right">'+(item.MOV_CANTID)+'</td>\n\
               <td style="text-align:right">'+number_format(u)+'</td>\n\
               <td style="text-align:right">0.00</td>\n\
               <td style="text-align:right">'+number_format(item.MOV_VENTA)+'</td></tr>';
               
              });
              render +='<tr><td colspan="6">Total materia prima</td><td style="text-align:right"><input type="hidden" id="to" value="'+tref+'">'+number_format(tref)+'</td>'
              var tf = $("#tofinal").val();
              var can = $("#can").val();
              var pre = $("#pre").val();
              var t = parseFloat(tf) + parseFloat(tref);
              var utilidad = pre - t;
              var tu = t / can;
              $("#utix").html('$'+number_format(utilidad));
              $("#tt").html('$'+number_format(t));
              $("#ttu").html('$'+number_format(tu));
              $('#mostrar_invfom').html(render);
          }
        
      });
  
}
 function consultarvalorop(tipo,op){
     
     $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
           url:'http://172.16.0.30:8989/api/MAEPRO/'+op+'/'+tipo,
          contentType: 'application/json',
          success: function(da){
                 $("#vlrop").html(number_format(da.PRO_VALORD));
                  $("#pre").val(da.PRO_VALORD);
                 var ca = da.PRO_CANORD;
                 var und = da.PRO_VALORD / ca;
                 $("#vlropund").html(number_format(und));
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             $("#des"+ref).html('Material no registrado en monty');
//           $("#est"+ced).html('');
             return false;
        });
 }
function cargarinvfomxreferencia(op,cod,ref,linea){


     var can = $("#can"+cod).val();
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MOVINV2020/57/'+op,
          dataType: 'json',
          success: function(da){
            
  
              var tref = 0;
              var tref_extra = 0;
              var descripcion = '';
              $.each(da, function(i, item) {
               console.log('Cod sistema'+cod+' vs '+item.MOV_REFER+' cant:'+item.MOV_CANTID);
               if(cod==item.MOV_REFER){
                   tref = parseFloat(tref) + parseFloat(item.MOV_CANTID);
               }
               var nref;
               
               if(linea=='Perfileria'){
                   var str = item.MOV_REFER;
                   var res = str.slice(0,-5);
                   if(ref==res){
                       if(cod!=item.MOV_REFER){
                          descripcion = item.MOV_REFER;
                          tref_extra = parseFloat(tref_extra) + parseFloat(item.MOV_CANTID);
                      }else{
                          tref_extra=0;
                      }
                   }
                   //tref = parseFloat(tref) + parseFloat(item.MOV_CANTID);
               }
               
              });
              var dif = parseFloat(can) - parseFloat(tref);
             
              $("#cons"+cod).html(tref);
              $("#cons2"+cod).html(tref_extra);
              if(linea=='Perfileria'){
                   $("#ref"+cod).html(descripcion);
                   if(tref_extra!=0){
                      var dif2 = parseFloat(can) - parseFloat(tref_extra);
                   }else{
                       var dif2 = 0;
                   }
              }else{
                   $("#ref"+cod).html(descripcion);
                    var dif2 = '';
              }
             
              var color, color2;
              if(dif<0){
                  color = 'red';
              }else if(dif==0){
                  color = 'green';
              }else{
                  color = 'blue';
              }
              if(dif2<0){
                  color2 = 'red';
              }else if(dif2==0){
                  color2 = 'green';
              }else{
                  color2 = 'blue';
              }
              
               $("#dif"+cod).html('<font color="'+color+'">'+parseInt(dif)+'</font>');
                $("#dif2"+cod).html('<font color="'+color2+'">'+(dif2)+'</font>');
          }
        
      });
  
}

function consultarref(ref){

     $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
           url:'http://172.16.0.30:8989/api/MAEINV/'+ref,
          contentType: 'application/json',
          success: function(da){
                 $("#des"+ref).html(da.INV_NOMBRE);
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             $("#des"+ref).html('Material no registrado en monty');
//           $("#est"+ced).html('');
             return false;
        });
 }
 function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');

    return amount_parts.join('.');
}


