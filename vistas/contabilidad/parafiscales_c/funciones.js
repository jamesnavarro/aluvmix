 $(function(){
     $("#mostrar_tabla").html(mostrar_paraf(1));
     
        $('#cod').change(function(){
             mostrar_paraf(1);
     });   
          $('#est_b').change(function(){
             mostrar_paraf(1);
     }); 
    
 });  

    function mostrar_paraf(page){
          var cod =$("#cod").val();
          var est_b =$("#est_b").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&est_b='+est_b+'&page='+page,
                url: '../vistas/contabilidad/parafiscales_c/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_paraf(){
        var id_paraf = $("#id_paraf").val();
        var descrip_paraf = $("#descrip_paraf").val();
        var instala_paraf = $("#instala_paraf").val();
        var fabri_paraf = $("#fabri_paraf").val();
       $.ajax({
            type: 'GET',
            data: 'id='+id_paraf+'&descrip_paraf='+descrip_paraf+'&instala_paraf='+instala_paraf+'&fabri_paraf='+fabri_paraf+'&sw=1',
            url: '../vistas/contabilidad/parafiscales_c/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_paraf").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_paraf(1);
            }
           });
}

function limpiar_paraf(){
       $("#id_paraf").val('');
       $("#descrip_paraf").val('');
       $("#instala_paraf").val('');
       $("#fabri_paraf").val('');
        
}

function nuevo(){
    limpiar_paraf();
}

function editar_public(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/contabilidad/parafiscales_c/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
            $("#id_paraf").val(t[0]);
            $("#descrip_paraf").val(t[1]);
            $("#instala_paraf").val(t[2]);
            $("#fabri_paraf").val(t[3]);
 }
});
}


