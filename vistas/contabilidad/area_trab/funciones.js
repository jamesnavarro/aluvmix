 $(function(){
     $("#mostrar_tabla").html(mostrar_areat(1));
    $('#cod').change(function(){
        mostrar_areat(1);
     });
     $('#des').change(function(){
        mostrar_areat(1);
     });  
     $('#nombre_aret').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#nombre_aret").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/contabilidad/area_trab/acciones.php',
         success: function(t) {
      var p = eval(t);
      $("#nombre_aret").val(cod);
      $("#id_areat").val(p[0]);
      $("#est_areat").val(p[2]);
         }
});
 }
    function mostrar_areat(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&page='+page,
                url: '../vistas/contabilidad/area_trab/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_areat(){
        var id = $("#id_areat").val();
        var nombart = $("#nombre_aret").val();
        var estart = $("#est_areat").val();
        if(nombart===''){
        alert("Ingrese el usuario");
        $("#nombre_aret").focus();
        return false;
        }
           $.ajax({
            type: 'GET',
            data: 'id='+id+'&nombart='+nombart+'&estart='+estart+'&sw=1',
            url: '../vistas/contabilidad/area_trab/acciones.php', 
            success: function(resultado){
                console.log(resultado)
                $("#id_areat").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_areat(1);
            }
           });
}
function limpiar_areat(){
     $("#id_areat").val('');
     $("#nombre_aret").val('');
     $("#est_areat").val('');
    
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_areat();
}
function editar_areat(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
         $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/contabilidad/area_trab/acciones.php', //
        success: function(resultado){
       var p = eval(resultado);
     $("#id_areat").val(p[0]);
     $("#nombre_aret").val(p[1]);
     $("#est_areat").val(p[2]);
 }
 });
}


   
