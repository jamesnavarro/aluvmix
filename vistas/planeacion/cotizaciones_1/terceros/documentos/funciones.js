//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
MostrarUsuarios2(1);
     // 4- Buscar en la tabla
        $('#buscar_empleado').change(function(){
		
		MostrarUsuarios2(1);
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
