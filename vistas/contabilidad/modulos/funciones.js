$(function(){
     $("#mostrar_tabla").html(mostrar_mod(1));
     
    $('#cod').change(function(){
        mostrar_mod(1);
      });
     $('#des').change(function(){
        mostrar_mod(1);
      }); 
      
     $('#res').change(function(){
         mostrar_mod(1);
     });
   
 });  

    function mostrar_mod(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
       
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&res='+res+'&page='+page,
                url: '../vistas/contabilidad/modulos/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
     function mostrarsub(m){
        $.ajax({
                type: 'GET',
                data: 'mod='+m+'&sw=3',
                url: '../vistas/contabilidad/modulos/acciones.php',
            success: function(d){
                 alert(d);
                $("#s"+m).html(d);
                
            }
        });
    }
   function guardar_mod(){
        var id_mod = $("#id_mod").val();
        var mod_nomb = $("#mod_nomb").val();
        var estado_mod = $("#estado_mod").val();
       var submenu = $("#submenu").val();
      
    $.ajax({
            type: 'GET',
            data: 'id_mod='+id_mod+'&mod_nomb='+mod_nomb+'&estado_mod='+estado_mod+'&submenu='+submenu+'&sw=1',
            url: '../vistas/contabilidad/modulos/acciones.php', 
            success: function(resultado){
              console.log(resultado)
                $("#id_mod").val(resultado); 
               alert("Se guardo con exito");
                mostrar_mod(1);
                $("#id_mod").val('');
               $("#mod_nomb").val('');
            }
           });
}

function limpiar_mod(){
  $("#id_mod").val('');
  $("#mod_nomb").val('');
  $("#estado_mod").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_mod();
}

function editar_mod(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/contabilidad/modulos/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
    
     $("#id_mod").val(t[0]);
     $("#mod_nomb").val(t[1]);
     $("#estado_mod").val(t[2]);
    
   
 }
});
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   