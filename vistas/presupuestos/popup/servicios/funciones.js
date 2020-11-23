//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
MostrarEmpleados2(1);
     // 4- Buscar en la tabla
        $('#ref').change(function(){
			 MostrarEmpleados2(1);
	});
        $('#des').change(function(){
			 MostrarEmpleados2(1);
	});
});

function MostrarEmpleados2(page){
    var ref = $('#ref').val();
     var des = $('#des').val();
     var linea = $('#linea').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&ref='+ref+'&des='+des+'&linea='+linea,
				url: 'mostrar_tabla.php',
				success: function(data){
                
						$('#empleados').html(data);
						
				}
			});
		return false;
}
function pasar(ref,desc,pre){
    window.opener.enviar_servicios(ref,desc,pre); 
    window.close();
}
