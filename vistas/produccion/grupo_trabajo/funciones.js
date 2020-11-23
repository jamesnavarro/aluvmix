 
$(function(){
     $("#mostrar_tabla").html(mostrar_grupo(1)); 
     
   $('#busgrupo').change(function(){
             mostrar_grupo(1);
     });   
   $('#busarea').change(function(){
            mostrar_grupo(1);
     }); 
  
 
});

function mostrar_grupo(page){
          var busgrupo =$("#busgrupo").val();
          var busarea =$("#busarea").val();
        $.ajax({
            type: 'GET',
            data: 'busgrupo='+busgrupo+'&busarea='+busarea+'&page='+page,
            url: '../vistas/produccion/grupo_trabajo/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_grupo(){ 
     var idg = $("#id_grupo").val(); 
     var nom = $("#nombre").val();
     var area_g = $("#area").val();
     var met_g = $("#met_pago").val();
     var estado_g = $("#estado_g").val();
   
     if(nom===''){
        sweetAlert("precio");
        $("#nombre").focus();
        return false;
    }
     if(area_g===''){
        sweetAlert("variable prima");
        $("#area").focus();
        return false;
    }
     if(met_g===''){
        sweetAlert("pre_actu");
        $("#met_pago").focus();
        return false;
    }
    
        $.ajax({
            type: 'GET',
            data: 'idg='+idg+'&nom='+nom+'&area_g='+area_g+'&met_g='+met_g+'&estado_g='+estado_g+'&sw=1',
            url: '../vistas/produccion/grupo_trabajo/acciones.php', 
            success: function(resultado){
                $("#id_grupo").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_grupo(1);
            }
           });
}

function limpiar_grupo(){
   $("#id_grupo").val(''); 
   $("#nombre").val('');
   $("#area").val('');
   $("#met_pago").val('');
}

function nuevo(){
    limpiar_grupo();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/produccion/grupo_trabajo/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
    $("#id_grupo").val(p[0]);
    $("#nombre").val(p[1]);
    $("#area").val(p[2]);
    $("#met_pago").val(p[3]);
    $("#estado_g").val(p[4]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta grupo?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/produccion/grupo_trabajo/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_grupo(1);
            }
           });
       }
}

function pasar_id(id){
    $("#numero").val(id);
    mostrar_usuarios(id) ;
    
    
}
function mostrar_usuarios(id){
    
        $.ajax({
            type: 'GET',
            data: 'id='+id,
            url: '../vistas/produccion/grupo_trabajo/lista_usuarios.php',
            success: function(resultado){
                 $("#mostrar_grupo").html(resultado);
            }
  }); 
}


function guardar_usuario_gr(){ 
     var idnum = $("#numero").val(); 
     var nomusu = $("#nom_usu").val();
     
     if(nomusu===''){
        sweetAlert("precio");
        $("#nom_usu").focus();
        return false;
    }
 
        $.ajax({
            type: 'GET',
            data: 'idnum='+idnum+'&nomusu='+nomusu+'&sw=4',
            url: '../vistas/produccion/grupo_trabajo/acciones.php', 
            success: function(res){
                if (res=='0'){
                sweetAlert("Se guardo con exito");
            }else{
                sweetAlert("el usuario ya existe!");
            }
                 mostrar_usuarios(idnum);
            }
           });
}

function borrar_u(idnum,grupo){
     var c = confirm("Esta seguro de registrar la inasistencia");
     if(c){
         var nov = prompt("Ingrese el motivo de la inasistencia");
         $.ajax({
            type: 'GET',
            data: 'user='+idnum+'&nov='+nov+'&sw=6',  //
            url: '../vistas/produccion/grupo_trabajo/acciones.php', //
            success: function(resultado){
               sweetAlert(resultado);
               mostrar_usuarios(grupo);
            }
           });
       }
}
function editar_u(idnum,grupo,est){
     var c = confirm("Esta seguro de editar el estado del usuario?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'idgd='+idnum+'&est='+est+'&sw=5',  //
            url: '../vistas/produccion/grupo_trabajo/acciones.php', //
            success: function(resultado){
                sweetAlert("Se ha editado con exito");
                
               mostrar_usuarios(grupo);
            }
           });
       }
}       

