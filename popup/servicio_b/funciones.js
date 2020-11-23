//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
Mostrarserv_b(1);
     // 4- Buscar en la tabla
        $('#cod').change(function(){
		
		Mostrarserv_b(1);
	});
        $('#des').change(function(){
		
		Mostrarserv_b(1);
	});   
            $('#crgo').change(function(){
		
		Mostrarserv_b(1);
	});
});

function Mostrarserv_b(page){
    var cod = $('#cod').val();
    var des = $('#des').val();
    var crg = $('#crgo').val();

		$.ajax({
				type: 'GET',
				data: 'page='+page+'&cod='+cod+'&des='+des+'&crg='+crg,
				url: 'mostrar_tabla.php',
				success: function(data){
						$('#usuario').html(data);
						
				}
			});
		return false;
}

