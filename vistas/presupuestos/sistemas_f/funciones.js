 $(function(){
     $("#mostrar_tabla").html(mostrar_sist(1));
     
        $('#cod').change(function(){
             mostrar_sist(1);
     });   
 });  

    function mostrar_sist(page){
          var cod =$("#cod").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&page='+page,
                url: '../vistas/presupuestos/sistemas_f/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_sist(){
        var id_sist = $("#id_sist").val();
        var descrip_sist = $("#descrip_sist").val();
       
     
       $.ajax({
            type: 'GET',
            data: 'id='+id_sist+'&descrip_sist='+descrip_sist+'&sw=1',
            url: '../vistas/presupuestos/sistemas_f/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_sist").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_sist(1);
            }
           });
}

function limpiar_sist(){
        $("#id_sist").val('');
        $("#descrip_sist").val('');
        
}

function nuevo(){
    limpiar_sist();
}

function editar_sist(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/presupuestos/sistemas_f/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
             $("#id_sist").val(t[0]);
             $("#descrip_sist").val(t[1]);
 }
});
}
function borrar_sist(id){
     var c = confirm("eliminar este sistema?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/sistemas_f/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_sist(1);
            }
           });
       }
}



