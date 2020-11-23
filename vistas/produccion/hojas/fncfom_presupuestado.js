function cargarinvfom2(can){

              var t = $("#total").val();
     
              var pre = $("#valorop").val();
             
              var utilidad = pre - t;
              var tu = t / can;
              if(utilidad<0){
                  $("#utix").html('$-'+number_format(utilidad));
              }else{
                  $("#utix").html('$'+number_format(utilidad));
              }
              
              $("#tt").html('$'+number_format(t));
              $("#ttu").html('$'+number_format(tu));
  
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
 function consultarvalorop(tipo,op,can,med,item){
//var can = $("#canop").val();
//     alert(can);
     $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
           url:'http://172.16.0.30:8989/api/MAEPRO/'+op+'/'+tipo,
          contentType: 'application/json',
          success: function(da){
                  var ca = da.PRO_CANORD;
             if(item=='Si'){
                 var ca = da.PRO_CANORD;
                 var ct = ca / ca;
                 var total = da.PRO_VALORD / ct;
                 $("#canopf").html(number_format(ca));
                 $("#sc").html(number_format(ca));
                 $("#csv").html(number_format(ca));
                 $("#vlrop").html(number_format(total));
                  $("#valorop").val(total);
                  $("#canop").val(ca);
                 var und = total / ca;
                 $("#vlropund").html(number_format(und));
                 console.log(total);
                 cargarinvfom2(ca);
                 
                 
             }else{
                 
                 consultarvaloropxitems(tipo,op,med,da.PRO_TIPPED,da.PRO_NUMPED);
             }
             consultar_materiales(ca);
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert('Material no registrado en monty');
//           $("#est"+ced).html('');
             return false;
        });
 }
 function consultarvaloropxitems(tipo,op,med,tped,numped){

     $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
           url:'http://172.16.0.30:8989/api/MOVPRO/'+op+'/'+tipo+'/'+med,
          contentType: 'application/json',
          success: function(da){
                 ConsultarPedidopxItems(tped,numped,med,da.PRO_REFER);
                 
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert('Material no registrado en monty');
//           $("#est"+ced).html('');
             return false;
        });
 }
 function ConsultarPedidopxItems(tipo,ped,med,ref){

     $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
           url:'http://172.16.0.30:8989/api/MOVPEDCXC/'+ped+'/'+tipo+'/'+med+'/'+ref,
          contentType: 'application/json',
          success: function(da){
              var t = da.PED_VALUND * da.PED_CANDES;
                 $("#vlropund").html(number_format(da.PED_VALUND));
                 $("#vlrop").html(number_format(t));
                 $("#valorop").val(t);
                 cargarinvfom2(da.PED_CANDES);
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert('Material no registrado en monty');
//           $("#est"+ced).html('');
             return false;
        });
 }
 
 function consultar_materiales(co){
var cg = $("#cg").val();
var id_tems = $("#id_items").val();
var id_cot = $("#id_cot").val();
var idtrazvid = $("#idtrazvid").val();
       $.ajax({
            type: 'GET',
            data: 'id_cot='+id_cot+'&id_item='+id_tems+'&cg='+cg+'&co='+co+'&idtrazvid='+idtrazvid+'&sw=1',
            url: 'modulos.php', 
           success: function(resultado){
               console.log(resultado);
                 $("#materia_prima").html(resultado);
            }
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


