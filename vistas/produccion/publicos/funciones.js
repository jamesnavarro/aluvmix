 $(function(){
     $("#mostrar_tabla").html(mostrar_public(1));
     
        $('#cod').change(function(){
             mostrar_public(1);
     });   
          $('#est_b').change(function(){
             mostrar_public(1);
     }); 
    
 });  

    function mostrar_public(page){
          var cod =$("#cod").val();
          var est_b =$("#est_b").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&est_b='+est_b+'&page='+page,
                url: '../vistas/produccion/publicos/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_public(){
        var id_public = $("#id_public").val();
        var descrip_public = $("#descrip_public").val();
        var servi_public = $("#servi_public").val();
        var fech_public = $("#fech_public").val();
       
     
       $.ajax({
            type: 'GET',
            data: 'id='+id_public+'&descrip_public='+descrip_public+'&servi_public='+servi_public+'&fech_public='+fech_public+'&sw=1',
            url: '../vistas/produccion/publicos/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_public").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_public(1);
            }
           });
}

function limpiar_public(){
         $("#id_public").val('');
         $("#descrip_public").val('');
        
}

function nuevo(){
    limpiar_public();
}

function editar_public(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/produccion/publicos/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
            $("#id_public").val(t[0]);
            $("#descrip_public").val(t[1]);
            $("#servi_public").val(t[2]);
            $("#fech_public").val(t[3]);
 }
});
}


