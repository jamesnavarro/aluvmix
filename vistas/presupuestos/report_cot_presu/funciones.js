$(function() {
mostrarCot(1);
    $("#cot").change(function(){
        mostrarCot(1);
    });
    $("#nom").change(function(){
        mostrarCot(1);
    });
    $("#obr").change(function(){
        mostrarCot(1);
    });
    $("#reg").change(function(){
        mostrarCot(1);
    });
     $("#se").change(function(){
        mostrarCot(1);
    });
    $("#estado").change(function(){
        mostrarCot(1);
    }); 
});
function mostrarCot(page) {
		cot = $("#cot").val();
		nom = $("#nom").val();
		obr = $("#obr").val();
		reg = $("#reg").val();
                ana = $("#se").val();
                est = $("#estado").val();
                $("#load").html('<img src="../images/load.gif"> Cargando...');
		$.post("../vistas/cotizaciones/mostrar_cotizaciones.php", {cot:cot, nom:nom, obr:obr, reg:reg, page:page,ana:ana,est:est}, function(data) {
			$("#cotizacione").html(data);
                        $("#load").html('');
		});
}






