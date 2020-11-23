$(function() {
    
cargar_productos();
});

function cargar_productos(){
//alert("pasa");
     $.ajax({
        type:'GET',
        data:'sw=1',
        url:'presupuestos/conexiones/acciones.php',
                    success : function(t){
                        $("#mostrar_tabla").html(t);
                    }
    });
}



      
