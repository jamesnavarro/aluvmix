 $(function(){
     $("#mostrar_tabla").html(mostrar_tvidrios(1));
     
        $('#cod').change(function(){
             mostrar_tvidrios(1);
     });   
    
 });  

    function mostrar_tvidrios(page){
          var cod =$("#cod").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&page='+page,
                url: '../vistas/presupuestos/tipo_vidrio/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_tvidrios(){
        var id_tvidrio = $("#id_tvidrio").val();
        var descrip_vi = $("#descrip_vi").val();
        var estado_tvi = $("#estado_tvi").val();
       
     
       $.ajax({
            type: 'GET',
            data: 'id='+id_tvidrio+'&descrip_vi='+descrip_vi+'&estado_tvi='+estado_tvi+'&sw=1',
            url: '../vistas/presupuestos/tipo_vidrio/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_tvidrio").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_tvidrios(1);
            }
           });
}

function limpiar_tvidrios(){
         $("#id_tvidrio").val('');
         $("#descrip_vi").val('');
         $("#estado_tvi").val('');
      
}
function nuevo(){
    limpiar_tvidrios();
}

function editar_tvidrios(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/presupuestos/tipo_vidrio/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
       $("#id_tvidrio").val(t[0]);
         $("#descrip_vi").val(t[1]);
         $("#estado_tvi").val(t[2]);
        
 }
});
}


