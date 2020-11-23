$(function() {


    
});

function buscar_cli(cotizacion){
    window.open("../ventanas/clientes?cotis="+cotizacion,"muestra","width=900, height=600")  
}

 function obtener_cli(user){
    $("#id_color").val(user);
}


