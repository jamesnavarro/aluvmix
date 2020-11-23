 $(function(){
     $("#mostrar_tabla").html(mostrar_pinsta(1));
     
        $('#cod').change(function(){
             mostrar_pinsta(1);
     });   
          $('#est_b').change(function(){
             mostrar_pinsta(1);
     }); 
    
 });  

    function mostrar_pinsta(page){
          var cod =$("#cod").val();
          var est_b =$("#est_b").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&est_b='+est_b+'&page='+page,
                url: '../vistas/presupuestos/precio_instalacion/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    
   function guardar_preinst(){
        var cod_inst = $("#cod_inst").val();
        var desc_inst = $("#desc_inst").val();
        var sis_inst = $("#sis_inst").val();
        var vt1 = $("#vt1").val();
        var vt2 = $("#vt2").val();
        var por_of = $("#por_of").val();
        var por_ayu = $("#por_ayu").val();
        var est_precio = $("#est_precio").val();
        var inst_usu = $("#inst_usu").val();
        var fech_inst = $("#fech_inst").val();   
        var unid_inst = $("#unid_inst").val();
        var parafis_inst = $("#parafis_inst").val();
        var page = $("#page").val();
       $.ajax({
            type: 'GET',
            data: 'id='+cod_inst+'&desc_inst='+desc_inst+'&sis_inst='+sis_inst+'&vt1='+vt1+'&vt2='+vt2+'&por_of='+por_of+'&por_ayu='+por_ayu+'&est_precio='+est_precio+'&inst_usu='+inst_usu+'&fech_inst='+fech_inst+'&unid_inst='+unid_inst+'&parafis_inst='+parafis_inst+'&sw=1',
            url: '../vistas/presupuestos/precio_instalacion/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_servi").val(resultado); 
                sweetAlert("Se ha guardo con exito.."); 
                mostrar_pinsta(page);
                //limpiar_preinst();
                
            }
           });
}

function limpiar_preinst(){
       $("#cod_inst").val('');
       $("#desc_inst").val('');
       $("#sis_inst").val('');
       $("#vt1").val('');
       $("#vt2").val('');
       $("#por_of").val('');
       $("#por_ayu").val('');
       $("#est_precio").val('');
       $("#unid_inst").val('');
       $("#parafis_inst").val('44.79');
      
}
function nuevo(){
    limpiar_preinst();
}

function editar_precio(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/presupuestos/precio_instalacion/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
            $("#cod_inst").val(t[0]);
            $("#desc_inst").val(t[1]);
            $("#sis_inst").val(t[2]);
            $("#vt1").val(t[3]);
            $("#vt2").val(t[4]);
            $("#por_of").val(t[5]);
            $("#por_ayu").val(t[6]);
            $("#est_precio").val(t[7]); 
            $("#inst_usu").val(t[8]);
            $("#fech_inst").val(t[9]);
            $("#unid_inst").val(t[10]);
            $("#parafis_inst").val(t[11]);
            
 }
});
}
function agregar_sistemas(){
      var codigo = $("#codigo").val();
      var sis = $("#sis").val();
      var page = $("#page").val();
         $.ajax({
            type: 'GET',
            data: 'codigo='+codigo+'&sis='+sis+'&sw=5',  //
            url: '../vistas/presupuestos/precio_instalacion/acciones.php', 
            success: function(){
                mostrar_sistema_kit();
                mostrar_pinsta(page);
            }
           });
}
function mostrar_sistema_kit(){
     var codigo = $("#codigo").val();
      $.ajax({
            type: 'GET',
            data: 'codigo='+codigo+'&sw=6',  //
            url: '../vistas/presupuestos/precio_instalacion/acciones.php', 
            success: function(resultado){
                $("#ver_sistema").html(resultado);
            }
           });
}
function del_sis(id,idp){
     var c = confirm("Esta seguro de eliminar este items?");
     if(c){
           var page = $("#page").val();
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&idp='+idp+'&sw=7',  //
            url: '../vistas/presupuestos/precio_instalacion/acciones.php', 
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_sistema_kit();
                mostrar_pinsta(page);
            }
           });
       }
}
function cam(id,est){
    var page = $("#page").val();
     var c = confirm("Esta seguro de cambiar el estado?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&est='+est+'&sw=8',  //
            url: '../vistas/presupuestos/precio_instalacion/acciones.php', 
            success: function(resultado){
                alert("Se ha editado con exito el estado");
                //mostrar_kits(page);
                mostrar_pinsta(page);
            }
           });
       }
}
function sisins(id){
    $("#codigo").val(id);   
    mostrar_sistema_kit();
}
versistema
function versistema(){
    var id = $("#cod_inst").val(); 
    $("#codigo").val(id);   
    if(id==''){
        alert("Debes de generar el documento");
        $("#modalsistema").modal('hide');
        return false;
    }else{
        $("#modalsistema").modal('show');
    }
    mostrar_sistema_kit();
}
