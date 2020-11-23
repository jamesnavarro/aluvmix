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
    var orden = window.opener.$('#compra').val();
    var rad = window.opener.$('#rad').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&orden='+orden+'&rad='+rad+'&nombre='+nombre,
				url: '../compras/documentos/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
		return false;
}

function agregar_productos(rad,orden){

    $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var can = $("#ncant"+id).val();
                                var des = $("#des"+id).val();
                                var med = $("#med"+id).val();
                                var col = $("#col"+id).val();
                                var bod = $("#bod"+id).val();
                                var cod = $("#cod"+id).val();
                                var pre = $("#pre"+id).val();
                                //alert(id);
                         $.ajax({
				type: 'POST',
				data: 'rad='+rad+'&orden='+orden+'&cod='+cod+'&pre='+pre+'&des='+encodeURIComponent(des)+'&med='+med+'&col='+col+'&bod='+bod+'&can='+can+'&id='+id,
				url: '../compras/documentos/agregar.php',
				success: function(data){
                                    console.log(data);
						
				}
			});
                  });
                  $.ajax({
                  success: function(){
                                  MostrarUsuarios2(1);	
                                  window.opener.cargadatos(rad);
				}
                        });
                  
}
function veri(id){
    var pcan = $("#pcant"+id).val();
    var can = $("#ncant"+id).val();
    if(parseFloat(can)>parseFloat(pcan)){
        alert("La cantidad digitada supera a la pendiente.");
        $("#ncant"+id).val(pcan);
        return false;
    }
}