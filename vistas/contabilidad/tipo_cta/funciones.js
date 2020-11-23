 $(function(){
     $("#mostrar_tabla").html(mostrar_cta(1));
     
    $('#cod').change(function(){
        mostrar_cta(1);
     });
     $('#des').change(function(){
        mostrar_cta(1);
     }); 
     $('#cod_cta').change(function(){
        bus_cod(1);
     }); 
 }); 
 
 function bus_cod(){
     var cod = $("#cod_cta").val();
       $.ajax({
          type: 'GET',
          data: 'cod='+cod+'&sw=4',
          url: '../vistas/contabilidad/tipo_cta/acciones.php',
          success: function(t) {
              var t = eval(t);
              $("#cod_cta").val(cod);
              $("#id_cta").val(t[0]);
              $("#desc_cta").val(t[2]);
              $("#cuenta_cta").val(t[3]);
    
         }
     
});
 }

    function mostrar_cta(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
       
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&page='+page,
                url: '../vistas/contabilidad/tipo_cta/lista.php',
                success: function(d){
                  $("#mostrar_tabla").html(d);
                    if(d==='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    
   function guardar_cta(){
        var id = $("#id_cta").val();
        var cod_cta = $("#cod_cta").val();
        var desc_cta = $("#desc_cta").val();
        var cuenta_cta = $("#cuenta_cta").val(); 
        if(desc_cta===''){
        alert("Descripcion de la cuenta");
        $("#desc_cta").focus();
        return false;
        } 
           $.ajax({
            type: 'GET',
            data: 'id='+id+'&cod_cta='+cod_cta+'&desc_cta='+desc_cta+'&cuenta_cta='+cuenta_cta+'&sw=1',
            url: '../vistas/contabilidad/tipo_cta/acciones.php', 
            success: function(resultado){
                console.log(resultado)
                $("#id_cta").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_cta(1);
            }
           });
}

function limpiar_cta(){
    $("#id_cta").val('');
    $("#cod_cta").val('');
    $("#desc_cta").val('');
    $("#cuenta_cta").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_cta();
}

function editar_car(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
         $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/contabilidad/tipo_cta/acciones.php', //
        success: function(resultado){
       var p = eval(resultado);
         $("#id_cta").val(p[0]);
         $("#cod_cta").val(p[1]);
         $("#desc_cta").val(p[2]);
         $("#cuenta_cta").val(p[3]);
    
 }
 });
}


   
