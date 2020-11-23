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
  var ref = $('#ref').val();
   var col = $('#col').val();
   var medi = $('#medi').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&cod='+cod+'&medi='+medi+'&ref='+ref+'&col='+col+'&des='+des,
				url: '../../popup/productos_var_1/mostrar_tabla.php',
				success: function(data){
                      
						$('#usuarios').html(data);
						
				}
			});
		return false;
}

