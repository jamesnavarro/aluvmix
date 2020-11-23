//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
Mostrarcontables2(1);
     // 4- Buscar en la tabla
        $('#cod').change(function(){
		
		Mostrarcontables2(1);
	});
        $('#des').change(function(){
		
		Mostrarcontables2(1);
	});
});

function Mostrarcontables2(page){
    var cod = $('#cod').val();
 var des = $('#des').val();
		$.ajax({
		    type: 'GET',
	            data: 'page='+page+'&cod='+cod+'&des='+des,
		    url: '../../popup/contables/mostrar_tabla.php',
		    success: function(data){
			$('#codconta').html(data);
	            }
			});
		return false;
}

