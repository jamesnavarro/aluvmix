
//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
MostrarReferencias(1);
     // 4- Buscar en la tabla
        $('#cod').change(function(){
		MostrarReferencias(1);
	});
        $('#des').change(function(){
		MostrarReferencias(1);
	});
        $('#ref').change(function(){
		MostrarReferencias(1);
	});
        $('#col').change(function(){
		MostrarReferencias(1);
	});
        $('#med').change(function(){
		MostrarReferencias(1);
	});
        $('#lin').change(function(){
		MostrarReferencias(1);
	});
        $('#ubi').change(function(){
		MostrarReferencias(1);
	});
        $('#colu').change(function(){
		MostrarReferencias(1);
	});
        
});

function MostrarReferencias(page){
    var cod = $('#cod').val();
    var des = $('#des').val();
    var ref = $('#ref').val();
    var col = $('#col').val();
    var med = $('#med').val();
    var lin = $('#lin').val();
     var ubi = $('#ubi').val();
     var idr = $('#colu').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&cod='+cod+'&des='+des+'&idr='+idr+'&ref='+ref+'&col='+col+'&med='+med+'&ubi='+ubi+'&lin='+lin,
				url: '../popup/reporte_ubicaciones_1/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						 $('#rep1').html('<a href="../vistas/movimientos/excel_inv_und.php?page='+page+'&cod='+cod+'&des='+des+'&idr='+idr+'&ref='+ref+'&col='+col+'&med='+med+'&ubi='+ubi+'&lin='+lin+'"><button id="boton1">Imprimir</button></a>');
						$('#rep2').html('<a href="../vistas/movimientos/excel_inv_und_1.php?page='+page+'&cod='+cod+'&des='+des+'&idr='+idr+'&ref='+ref+'&col='+col+'&med='+med+'&ubi='+ubi+'&lin='+lin+'"><button id="boton1">Exportar Excel</button></a>');
				}
			});
		return false;
}
function can(id){
    ubicaciond(id);
}
function ubicaciond(id){
    window.open("../popup/ubicaciones.php?casilla="+id,"Ubicaciones","width=1000px , height=600px");
}
function ubica(cod,c){
    $("#ubicaciond"+c).val(cod);
     $("#boton"+c).focus();
}

