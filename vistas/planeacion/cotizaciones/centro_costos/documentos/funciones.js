//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
tabla_sucursales(1);
     // 4- Buscar en la tabla
        $('#buscar_empleado').keyup(function(){
		
		tabla_sucursales(1);
	});
});

function MostrarUsuarios2(page){
    var nombre = $('#buscar_empleado').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&nombre='+nombre,
				url: '../terceros/documentos/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
		return false;
}
function tabla_sucursales(page){
    
    var cod = $("#buscar_empleado").val();
    if(cod==''){
        cod='*';
    }else{
        cod=cod;
    }
    //alert(cod);
    //$("#page").val(page);
    $("#mostrar_sucursales").html('<tr><td colspan="2">Cargando>>>>> </td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAESEC/'+cod+'/'+page+'/50',
          dataType: 'json',
          success: function(da){

              render = "";
              $.each(da, function(i, item) {
                render+= showRow(i,item);
              });
              $('#mostrar_sucursales').html(render);
          }
        
      });
  }
  function showRow(i, dev){
 var p = "'"+dev.SEC_CODIGO+"'";
  var v = "'"+dev.SEC_NOMBRE+"'";
  var row = '<tr>'+
              '<td>'+dev.SEC_CODIGO+'</td>\n\
               <td><a href="#" onclick="pasar('+p+','+v+')">'+dev.SEC_NOMBRE+'</a></td></tr>';
  return row;

}
function verificar(){
    var ced = $('#buscar_empleado').val();
    $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAESEC/'+ced,
          contentType: 'application/json',
          success: function(da){
            
             var p = eval(da);
              console.log('Resultado: '+p.CLI_NOMBRE);
             $('#resultado').val(p.CLI_NOMBRE);
          }
      });
}

function pasar(cod,nom){

  window.opener.$('#cc').val(cod);
  window.opener.$('#centro').val(nom);
  window.close();
}
function buscartipocuenta(cod){
    $.ajax({
				type: 'GET',
				data: 'cod='+cod,
				url: '../terceros/documentos/buscartp.php',
				success: function(data){
					window.opener.document.getElementById("siva").value=data;	
				}
			});
}
