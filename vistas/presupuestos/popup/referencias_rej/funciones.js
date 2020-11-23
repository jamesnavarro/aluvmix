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
function pasar(ref,desc){
    window.opener.$("#rej_ref").val(ref); 
    window.opener.$("#rej_des").val(desc); 
    window.close();
}
