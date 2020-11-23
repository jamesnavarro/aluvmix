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
    var cod = $('#cod').val();
     var item = $('#item').val();
		$.ajax({
                        type: 'GET',
                        data: 'cod='+cod+'&item='+item,
                        url: 'mostrar_tabla.php',
                        success: function(data){
                                        $('#empleados').html(data);	
                        }
			});
		return false;
}
function pasar(ref,desc,num,tipo){
    window.opener.obtener_inter(ref,desc,num,tipo); 
    window.close();
}
