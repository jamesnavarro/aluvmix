 $(function(){
     $("#mostrar_tabla").html(mostrar_reff(1));
     
        $('#cod').change(function(){
             mostrar_reff(1);
     });   
          $('#est_b').change(function(){
             mostrar_reff(1);
     }); 
      $('#sistema').change(function(){
             mostrar_reff(1);
     }); 
     
      $('#doc_cli').change(function(){
        bcar_ref();
      });
      
 });  

function bcar_ref(){
     var cod = $("#referen_pre").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/presupuestos/referen_f/acciones.php', //
         success: function(t) {
             var t = eval(t);
             $("#referen_pre").val(cod);
             $("#desc_pre").val(t[1]);
             $("#sist_pre").val(t[2]);
             $("#pes_pre").val(t[3]);
             $("#perime_pre").val(t[4]);
             $("#perit_pre").val(t[5]);
             $("#costalum_pre").val(t[6]);
         }
     
});
 }
 
 
    function mostrar_reff(page){
          var cod =$("#cod").val();
          var est_b =$("#est_b").val();
          var sistema =$("#sistema").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&est_b='+est_b+'&sistema='+sistema+'&page='+page,
                url: '../vistas/presupuestos/referen_f/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_refer(){
        var referen_pre = $("#referen_pre").val();
        var desc_pre = $("#desc_pre").val();
        var sist_pre = $("#sist_pre").val();
        var pes_pre = $("#pes_pre").val();
        var perime_pre = $("#perime_pre").val();
       var perit_pre = $("#perit_pre").val();
       var costalum_pre = $("#costalum_pre").val();
     
       var reff_usu = $("#reff_usu").val();
       var reff_inst = $("#reff_inst").val();
            
       $.ajax({
            type: 'GET',
            data: 'referen_pre='+referen_pre+'&desc_pre='+encodeURIComponent(desc_pre)+'&sist_pre='+encodeURIComponent(sist_pre)+'&pes_pre='+pes_pre+'&perime_pre='+perime_pre+'&perit_pre='+perit_pre+
                  '&costalum_pre='+costalum_pre+'&reff_usu='+reff_usu+'&reff_inst='+reff_inst+'&sw=1',
            url: '../vistas/presupuestos/referen_f/acciones.php', 
            success: function(resultado){
               alert(resultado);
                mostrar_reff(1);
                limpiar_reff();
            }
           });
}

function limpiar_reff(){
        $("#referen_pre").val('');
        $("#desc_pre").val('');
        $("#sist_pre").val('');
        $("#pes_pre").val('');
        $("#perime_pre").val('');
        $("#perit_pre").val('');
        $("#costalum_pre").val('');
}
function nuevo(){
    limpiar_col();
}

function editar_reff(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/presupuestos/referen_f/acciones.php', //
               success: function(resultado){
                 var t = eval(resultado);
                 $("#referen_pre").val(id);
                 $("#desc_pre").val(t[1]);
                 $("#sist_pre").val(t[2]);
                 $("#pes_pre").val(t[3]);
                 $("#perime_pre").val(t[4]);
                 $("#perit_pre").val(t[5]);
                 $("#costalum_pre").val(t[6]);
 }
});
}

function borrar_ref(id){
     var c = confirm("Esta seguro de eliminar los datos?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=5',  //
            url: '../vistas/presupuestos/referen_f/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_reff(1);
            }
           });
       }
}


