
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
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&cod='+cod+'&des='+des+'&ref='+ref+'&col='+col+'&med='+med+'&ubi='+ubi+'&lin='+lin,
				url: '../popup/referencias_traslado/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						
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

function adicionar(id){
    
    var sto = $("#stock"+id).val();
    var can = $("#cantidadx"+id).val();
    var ubi = $("#ubicacion"+id).val();
    var ubid = $("#ubicaciond"+id).val();
    var ref = $("#idref"+id).val();
    //no se utilizan
    var n = ubi.localeCompare(ubid);
    if(can===''){
        
        alert("La cantidad debe ser mayor a 0.");
        $("#cantidadx"+id).val('').focus();
        return false;
    }
    if(ubid===''){
        
        alert("Seleccione alguna ubicacion");
        $("#ubicaciond"+id).val('').focus();
        return false;
    }
    if(parseInt(can)>parseInt(sto)){
         alert("La cantidad supera el stock de la ubicacion");
        $("#cantidadx"+id).val('').focus();
        return false;
    }
    if(n==0){
        alert("Debes de seleccionar otra ubicacion");
        $("#ubicaciond"+id).val('').focus();
        return false;
        
    }
      $.ajax({
            type: 'GET',
            data: 'can='+can+'&stoi='+sto+'&idrm='+id+'&ref='+ref+'&ubid='+ubid+'&ubio='+ubi+'&sw=18',
            url: '../vistas/movimientos/acciones.php',
            success: function(data){
                alert("Se ha dado salida " + data);
                var total = parseInt(sto) - parseInt(can);  
                $("#cantidadx"+id).val('');
                $("#stock"+id).val(total);
                
               MostrarReferencias($("#page").val());
            }
	});
   
    
}

