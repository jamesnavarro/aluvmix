
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
});
function psc(d){
    var can = $('#cantidadx'+d).val();
    if(isNaN(can)){
        alert("Digite un numero");
        return false;
        $('#cantidadx'+d).val('').focus();
    }
    ubicacion(d);
}
function MostrarReferencias(page){
    var cod = $('#cod').val();
    var des = $('#des').val();
    var ref = $('#ref').val();
    var col = $('#col').val();
    var med = $('#med').val();
    var lin = $('#lin').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&cod='+cod+'&des='+des+'&ref='+ref+'&col='+col+'&med='+med+'&lin='+lin,
				url: '../popup/referencias/mostrar_tabla.php',
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
function agregar(id){
    var can = $('#cantidad'+id).val();
    var ubi = $('#ubicacion'+id).val();
    $.ajax({
				type: 'GET',
				data: 'ref='+id+'&can='+can+'&ubi='+ubi+'&sw=',
				url: '../popup/referencias/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
}
function adicionar(id){

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
      $.ajax({
            type: 'GET',
            data: 'idr='+idr+'&col='+col+'&med='+med+'&bod='+bod+'&carga='+carga+'&costo='+costo+'&unidad='+unidad+'&can='+can+'&stoi=0&idrm='+id+'&mov='+mov+'&ubi='+ubi+'&sw=17',
            url: '../vistas/movimientos/acciones.php',
            success: function(data){
                alert("Se ha dado salida " + data);
               
                $("#cantidadx"+id).val('');
                $("#ubicacion"+id).val('');
                window.opener.Llenar(mov);
            }
	});
   
    
}
function ubicacion(id){
    window.open("../popup/ubicaciones.php?casilla="+id,"Ubicaciones","width=1000px , height=600px");
}
function ubica(cod,c){
    $("#ubicacion"+c).val(cod);
     $('#addi'+c).focus();
   
}