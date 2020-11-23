//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
MostrarUsuarios2(1);
     // 4- Buscar en la tabla
        $('#cod').change(function(){
		
		MostrarUsuarios2(1);
	});
        $('#des').change(function(){
		
		MostrarUsuarios2(1);
	});   
            $('#crgo').change(function(){
		
		MostrarUsuarios2(1);
	});
});

function MostrarUsuarios2(page){
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

