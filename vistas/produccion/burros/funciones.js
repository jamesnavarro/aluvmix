 $(function(){
     $("#mostrar_tabla").html(mostrar_burros(1));
     
        $('#cod').change(function(){
             mostrar_burros(1);
     });   
          $('#est_b').change(function(){
             mostrar_burros(1);
     }); 
    
 });  

    function mostrar_burros(page){
          var cod =$("#cod").val();
          var est_b =$("#est_b").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&est_b='+est_b+'&page='+page,
                url: '../vistas/produccion/burros/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_burros(){
        var id_bur = $("#id_bur").val();
        var descrip_bur = $("#descrip_bur").val();
        var esta_b = $("#esta_b").val();   
        var planta_b = $("#planta_b").val(); 
     
       $.ajax({
            type: 'GET',
            data: 'id='+id_bur+'&descrip_bur='+descrip_bur+'&esta_b='+esta_b+'&planta_b='+planta_b+'&sw=1',
            url: '../vistas/produccion/burros/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_bur").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_burros(1);
            }
           });
}

function limpiar_burros(){
        $("#id_bur").val('');
        $("#descrip_bur").val('');
        $("#esta_b").val('');
        $("#planta_b").val(''); 
        
}
function nuevo(){
    limpiar_burros();
}

function editar_burros(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/produccion/burros/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
            $("#id_bur").val(t[0]);
            $("#descrip_bur").val(t[1]);
            $("#esta_b").val(t[2]);
            $("#planta_b").val(t[3]);
 }
});
}


