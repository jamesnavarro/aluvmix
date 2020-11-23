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
});

function MostrarUsuarios2(page){
    var cod = $('#cod').val();
 var des = $('#des').val();
		$.ajax({
		type: 'GET',
		data: 'page='+page+'&cod='+cod+'&des='+des,
		url: '../../popup/centro/mostrar_tabla.php',
		success: function(data){
		$('#usuarios').html(data);
						
	}
			});
		return false;
}

