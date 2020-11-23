 $(function(){
     $("#mostrar_tabla").html(mostrar_car(1));
     
    $('#cod').change(function(){
        mostrar_car(1);
     });
     $('#des').change(function(){
        mostrar_car(1);
     }); 
        
     $('#nombre_carg').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#nombre_carg").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/contabilidad/cargo/acciones.php',
         success: function(t) {
      var p = eval(t);
     $("#nombre_carg").val(cod);
    $("#id_car").val(p[0]);
     $("#estado_carg").val(p[2]);
         }
});
 }
    function mostrar_car(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
       
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&page='+page,
                url: '../vistas/contabilidad/cargo/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_car(){
        var id = $("#id_car").val();
        var nombcarg = $("#nombre_carg").val();
        var estadcarg = $("#estado_carg").val();
       
        if(nombcarg===''){
        alert("Ingrese el usuario");
        $("#nombre_carg").focus();
        return false;
        }
    
           $.ajax({
            type: 'GET',
            data: 'id='+id+'&nombcarg='+nombcarg+'&estadcarg='+estadcarg+'&sw=1',
            url: '../vistas/contabilidad/cargo/acciones.php', 
            success: function(resultado){
                console.log(resultado)
                $("#id_car").val(resultado); 
                sweetAlert("Se guardo el cargo con exito");
                mostrar_car(1);
            }
           });
}

function limpiar_car(){
     $("#id_car").val('');
     $("#nombre_carg").val('');
     $("#estado_carg").val('');
    
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_car();
}

function editar_car(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
         $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/contabilidad/cargo/acciones.php', //
        success: function(resultado){
       var p = eval(resultado);
     $("#id_car").val(p[0]);
     $("#nombre_carg").val(p[1]);
     $("#estado_carg").val(p[2]);
 }
 });
}


   
