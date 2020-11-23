 $(function(){
     $("#mostrar_tabla").html(mostrar_col1(1));
     
        $('#cod').change(function(){
             mostrar_col1(1);
     });   
          $('#est_b').change(function(){
             mostrar_col1(1);
     }); 
    
 });  

    function mostrar_col1(page){
          var cod =$("#cod").val();
          var est_b =$("#est_b").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&est_b='+est_b+'&page='+page,
                url: '../vistas/presupuestos/color_alum/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    
    
   function guardar_col(){
        var id_col = $("#id_col").val();
        var desc_col = $("#desc_col").val();
        var costo_col = $("#costo_col").val();
        var vari_col = $("#vari_col").val();
        var cod_col = $("#cod_col").val();
        var rendi_col = $("#rendi_col").val();
        var me_max = $("#me_max").val();
     
     
       $.ajax({
            type: 'GET',
            data: 'id='+id_col+'&desc_col='+desc_col+'&costo_col='+costo_col+'&vari_col='+vari_col+'&cod_col='+cod_col+'&rendi_col='+rendi_col+'&me_max='+me_max+'&sw=1',
            url: '../vistas/presupuestos/color_alum/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_servi").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_col1(1);
            }
           });
}

function limpiar_col(){
        $("#id_col").val('');
        $("#desc_col").val('');
        $("#costo_col").val('');
        $("#vari_col").val('');
        $("#cod_col").val('');
        $("#rendi_col").val('');
        $("#me_max").val('');
}


function nuevo(){
    limpiar_col();
}

function editar_col(id){
    $("#marca2").attr("class","");
    $("#marca1").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/presupuestos/color_alum/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
            $("#id_col").val(t[0]);
            $("#desc_col").val(t[1]);
            $("#costo_col").val(t[2]);
            $("#vari_col").val(t[3]);
            $("#cod_col").val(t[4]);
            $("#rendi_col").val(t[5]);  
            $("#me_max").val(t[6]);  
 }
});
}


