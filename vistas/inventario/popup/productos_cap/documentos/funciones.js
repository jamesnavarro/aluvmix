//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
MostrarUsuarios2(1);
     // 4- Buscar en la tabla
        $('#buscar_empleado').change(function(){
		MostrarUsuarios2(1);
	});
        $('#referencia').change(function(){
		MostrarUsuarios2(1);
	});
        $('#color').change(function(){
		MostrarUsuarios2(1);
	});
});

function MostrarUsuarios2(page){
    var nombre = $('#buscar_empleado').val();
    var referencia = $('#referencia').val();
    var color = $('#color').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&referencia='+referencia+'&color='+color+'&nombre='+nombre,
				url: '../productos_cap/documentos/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
				}
			});
		return false;
}

function guardar_item_cap(cod){
    var bodega = window.opener.$('#al_cap').val();
    var id_c = window.opener.$('#rad_cap').val();
    var est = window.opener.$('#est_cap').val();
    if(est==1){
        alert("No puedes agregar mas items a este documento.");
        return false;
    }
    var can = $('#can'+cod).val();
    var ubi = $('#ubi'+cod).val();
    var col = $('#col'+cod).val();
    if(can==''){
        alert("Digita la cantidad ");
        $('#can'+cod).focus();
        return false;
    }
    if(ubi==''){
        alert("Selecciona la ubicacion.");
        $('#ubi'+cod).focus();
        return false;
    }
    $.ajax({
				type: 'GET',
				data: 'bodega='+bodega+'&col='+col+'&id_c='+id_c+'&cod='+cod+'&can='+can+'&ubi='+ubi+'&sw=1',
				url: '../productos_cap/documentos/acciones.php',
				success: function(data){
						alert(data);
                                                $('#can'+cod).val('');
                                                $('#ubi'+cod).val('');
                                                window.opener.MostrarCapturas();
				}
			});
}
function ubi(cod) {
    var sede = window.opener.$("#sede").val();
    window.open("ubicaciones_beta.php?sede="+sede+"&cod="+cod, "Ubicaciones", "width=1600px , height=600px");
}

function buscarcolor(cod){
    $("#codtemp").val(cod);
    
}
function pasarcol(col){
    var c = $("#codtemp").val();
    $("#col"+c).val(col);
    $("#myModal").modal('hide');
    
}