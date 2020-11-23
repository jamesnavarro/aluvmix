//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
con_fom_cod(1);
     // 4- Buscar en la tabla
        $('#buscar_empleado').change(function(){
		
		con_fom_cod(1);
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
function verificar(){
    var ced = $('#buscar_empleado').val();
    $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAECXC/'+ced,
          contentType: 'application/json',
          success: function(da){
            
             var p = eval(da);
              console.log('Resultado: '+p.CLI_NOMBRE);
             $('#resultado').val(p.CLI_NOMBRE);
          }
      });
}

function pasar(cod,nom){

  window.opener.validar_tercero(cod);
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
function con_fom_cod(page){
    var cod = $("#buscar_empleado").val();
    if(cod==''){
        cod='*';
    }else{
        cod=cod;
    }
    $("#page").val(page);
    $("#mostrar_tabla2").html('<tr><td colspan="2">Cargando<img src="../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAECXC/'+cod+'/'+page+'/25',
          dataType: 'json',
          success: function(da){
            
              //console.log('Resultado: '+da);
              render = "";
              $.each(da, function(i, item) {
                //console.log(item);
                render+= showRow(i,item);
              });
              $('#mostrar_tabla2').html(render);
          }
        
      });
  }
  function showRow(i, dev){
      //consultar_cod_alu(dev.CLI_CEDULA);
      var ced = "'"+dev.CLI_CEDULA+"'";
       var nom = "'"+dev.CLI_NOMBRE+"'";
       var link;
       var est;
       if(dev.CLI_ACTIVO==false){
           link = '<a href="#PasarVariable" onclick="pasar('+ced+','+nom+')">'+dev.CLI_NOMBRE+'</a>';
           est = 'Activo';
       }else{
           link = dev.CLI_NOMBRE;
           est = 'No Activo';
       }
  var row = '<tr id="v'+dev.CLI_CEDULA+'">'+
              '<td>'+dev.CLI_CEDULA+'\
<input type="hidden" id="ced'+dev.CLI_CEDULA+'" value="'+dev.CLI_CEDULA+'">\n\
<input type="hidden" id="nom'+dev.CLI_CEDULA+'" value="'+dev.CLI_NOMBRE+'">\n\
<input type="hidden" id="tel'+dev.CLI_CEDULA+'" value="'+dev.CLI_TELEFO+'">\n\
<input type="hidden" id="ema'+dev.CLI_CEDULA+'" value="'+dev.CLI_EMAIL+'">\n\
<input type="hidden" id="use'+dev.CLI_CEDULA+'" value="'+dev.CLI_USUARIO+'">\n\
</td><td>'+link+'</td><td>'+est+'</td></tr>';
       
  return row;

}
function paginacion(p){
    var page = $("#page").val();
    var t = parseInt(page) + parseInt(p);
    if(t==0){
        con_fom_cod(1);
    }else{
        con_fom_cod(t);
        $("#page").val(t);
    }
    
}