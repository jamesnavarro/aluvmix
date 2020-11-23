//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
Mostrarcontablesf2(1);
     // 4- Buscar en la tabla
        $('#cod').change(function(){
		Mostrarcontablesf2(1);
	});
        $('#des').change(function(){
		Mostrarcontablesf2(1);
	});
});

function Mostrarcontablesf2(page){
      var cod = $('#cod').val();
      var des = $('#des').val();
		$.ajax({
		type: 'GET',
		data: 'page='+page+'&cod='+cod+'&des='+des,
		url: '../../popup/fuente/mostrar_tabla.php',
		success: function(data){
		$('#codconta').html(data);
						
		}
		});
		return false;
}

