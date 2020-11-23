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
     var tipo = $('#tipo').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&nombre='+nombre+'&tipo='+tipo,
				url: '../popup/documentos/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
		return false;
}

