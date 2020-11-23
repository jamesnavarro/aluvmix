 $(function(){
     $("#mostrar_tabla").html(mostrar_servi(1));
     
        $('#cod').change(function(){
             mostrar_servi(1);
     });   
          $('#est_b').change(function(){
             mostrar_servi(1);
     }); 
    
 });  

    function mostrar_servi(page){
          var cod =$("#cod").val();
          var est_b =$("#est_b").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&est_b='+est_b+'&page='+page,
                url: '../vistas/produccion/servicios/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_servi(){
        var id_servi = $("#id_servi").val();
        var descrip_servi = $("#descrip_servi").val();
        var valor_u = $("#valor_u").val();
        var estado_servi = $("#estado_servi").val();
        var usu_servi = $("#servi_usu").val();
        var fecha_servi = $("#fech_servi").val();
       
     
       $.ajax({
            type: 'GET',
            data: 'id='+id_servi+'&descrip_servi='+descrip_servi+'&valor_u='+valor_u+'&estado_servi='+estado_servi+'&usu_servi='+usu_servi+'&fecha_servi='+fecha_servi+'&sw=1',
            url: '../vistas/produccion/servicios/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_servi").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_servi(1);
            }
           });
}

function limpiar_servi(){
         $("#id_servi").val('');
         $("#descrip_servi").val('');
         $("#valor_u").val('');
         $("#estado_servi").val('');
}
function nuevo(){
    limpiar_servi();
}

function editar_servi(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/produccion/servicios/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
            $("#id_servi").val(t[0]);
            $("#descrip_servi").val(t[1]);
            $("#valor_u").val(t[2]);
            $("#estado_servi").val(t[3]); 
 }
});
}


