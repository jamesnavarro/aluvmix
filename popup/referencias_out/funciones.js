
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
});

function MostrarReferencias(page){
    var cod = $('#cod').val();
    var des = $('#des').val();
    var ref = $('#ref').val();
    var col = $('#col').val();
    var med = $('#med').val();
    var lin = $('#lin').val();
     var ubi = $('#ubi').val();
     var bod = $('#bod').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&cod='+cod+'&des='+des+'&ref='+ref+'&col='+col+'&med='+med+'&ubi='+ubi+'&lin='+lin+'&bod='+bod,
				url: '../popup/referencias_out/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
		return false;
}
function ubicacion(id){
    window.open("../popup/ubicaciones.php?casilla="+id,"Ubicaciones","width=1000px , height=600px");
}
function ubica(cod,c){
    $("#ubicacion"+c).val(cod);
}

function adicionar(id){
    var sto = $("#stock"+id).val();
    var can = $("#cantidadx"+id).val();
    var ubi = $("#ubicacion"+id).val();
    var col = $("#col"+id).val();
    var med = $("#med"+id).val();
    var costo = $("#costo"+id).val();
    var unidad = $("#unidad"+id).val();
    var idr = $("#idr"+id).val();
    var mov = $("#mov").val();
     var bod = $("#bod").val();
     var carga = $("#carga").val();
    if(can===''){
        
        alert("La cantidad debe ser mayor a 0.");
        $("#cantidadx"+id).val('').focus();
        return false;
    }
    if(parseInt(can)>parseInt(sto)){
         alert("La cantidad supera el stock de la ubicacion");
        $("#cantidadx"+id).val('').focus();
        return false;
    }
      $.ajax({
            type: 'GET',
            data: 'idr='+idr+'&col='+col+'&med='+med+'&bod='+bod+'&costo='+costo+'&carga='+carga+'&unidad='+unidad+'&can='+can+'&stoi='+sto+'&idrm='+id+'&mov='+mov+'&ubi='+ubi+'&sw=17',
            url: '../vistas/movimientos/acciones.php',
            success: function(data){
                alert("Se ha dado salida " + data);
                var total = parseInt(sto) - parseInt(can);  
                $("#cantidadx"+id).val('');
                $("#stock"+id).val(total);
                window.opener.Llenar(mov);
            }
	});
   
    
}

