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
        $('#sis').change(function(){
		
		MostrarUsuarios2(1);
	});
        $('#item').change(function(){
		
		MostrarUsuarios2(1);
	});
});

function MostrarUsuarios2(page){
 var cod = $('#cod').val();
 var des = $('#des').val();
 var ref = $('#ref').val();
  var sis = $('#sis').val();
   var item = $('#item').val();
		$.ajax({
                    type: 'GET',
                    data: 'page='+page+'&cod='+cod+'&ref='+ref+'&sis='+sis+'&item='+item+'&des='+des,
                    url: '../../popup/dt/mostrar_tabla.php',
                    success: function(data){
                                    $('#usuarios').html(data);
                    }
			});
		return false;
}


