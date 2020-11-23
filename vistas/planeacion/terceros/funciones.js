 
$(function(){
     $("#mostrar_tabla").html(mostrar_terp(1)); 
     
   $('#busTER').change(function(){
             mostrar_terp(1);
     });   
   $('#busDOC').change(function(){
            mostrar_terp(1);
     }); 
  
 
});

function mostrar_terp(page){
          var busTER =$("#busTER").val();
          var busDOC =$("#busDOC").val();
        $.ajax({
            type: 'GET',
            data: 'busTER='+busTER+'&busDOC='+busDOC+'&page='+page,
            url: '../vistas/planeacion/terceros/lista_ter.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_terp(){ 
     var id_t = $("#id_t").val(); 
     var tipo_doct = $("#tipo_doct").val();
     var num_t = $("#num_t").val();
     var nombre_t = $("#nombre_t").val();
     var dir_t = $("#dir_t").val();
     var tel_t = $("#tel_t").val();
     var movil_t = $("#movil_t").val();
     var dep_p = $("#dep_p").val();
     var ciu_t = $("#ciu_t").val();
     var correo_t = $("#correo_t").val();     
     var est_tp = $("#est_tp").val();
     if(num_t===''){
        sweetAlert("variable prima");
        $("#num_t").focus();
        return false;
    }
     if(dep_p===''){
        sweetAlert("elija el departamento");
        $("#dep_p").focus();
        return false;
    }
    
        $.ajax({
            type: 'GET',
            data: 'id_t='+id_t+'&tipo_doct='+tipo_doct+'&num_t='+num_t+'&nombre_t='+nombre_t+'&dir_t='+dir_t+'&tel_t='+tel_t+'&movil_t='+movil_t+'&dep_p='+dep_p+'&ciu_t='+ciu_t+'&correo_t='+correo_t+'&est_tp='+est_tp+'&sw=1',
            url: '../vistas/planeacion/terceros/acciones.php', 
            success: function(resultado){
                $("#id_t").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_terp(1);
            }
           });
}

function limpiar_terp(){
 $("#id_t").val(''); 
 $("#tipo_doct").val('');
 $("#num_t").val('');
 $("#nombre_t").val('');
 $("#dir_t").val('');
 $("#tel_t").val('');
 $("#movil_t").val('');
 $("#dep_p").val('');
 $("#ciu_t").val('');
 $("#correo_t").val('');
 $("#est_tp").val('');
}

function nuevo(){
    limpiar_terp();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/planeacion/terceros/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_t").val(p[0]);
 $("#tipo_doct").val(p[1]);
 $("#num_t").val(p[2]);
 $("#nombre_t").val(p[3]);
 $("#dir_t").val(p[4]);
 $("#tel_t").val(p[5]);
 $("#movil_t").val(p[6]);
 $("#dep_p").val(p[7]);
 $("#ciu_t").val(p[8]);
 $("#correo_t").val(p[9]);  
 $("#est_tp").val(p[10]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar este tercero?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/planeacion/terceros/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_terp(1);
            }
           });
       }
}

function cargarmundo(){
     var dep_p = $("#dep_p").val(); // 
         $.ajax({
            type: 'GET',
            data: 'dep='+dep_p+'&sw=4',  //
            url: '../vistas/planeacion/terceros/acciones.php', //
            success: function(resultado){
                $("#ciu_t").html(resultado);
            }
           }); 
}



function existefom(ced){
     $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAECXC/'+ced,
          contentType: 'application/json',
          success: function(da){
     
             var est = da.CLI_ACTIVO;
             if(est=='1'){
//                 alert('¡Este tercero se encuentra inactivo!');
                 cambiar_estado_tercero(ced);
                 return false;
             }   
             validar_estado_tercero(ced);
          }
        }).fail( function( jqXHR, textStatus, errorThrown ) {  
//             alert( 'Cliente no encontrado en fomplus.' );
             cambiar_estado_tercero(ced);

             return false;
        });
    
}
function existefomfull(ced,i){
     $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAECXC/'+ced,
          contentType: 'application/json',
          success: function(da){
     
             var est = da.CLI_ACTIVO;
             var nom = da.CLI_NOMBRE;
             //console.log('Activo: '+nom+' ced:'+ced);
             if(est=='1'){
//                 alert('¡Este tercero se encuentra inactivo!');
                 cambiar_estado_tercero(ced,i);
                 return false;
             }else{   
               validar_estado_tercero(ced,i,nom);
             }
          }
        }).fail( function( jqXHR, textStatus, errorThrown ) {  
//             alert( 'Cliente no encontrado en fomplus.' );
             cambiar_estado_tercero(ced,i);
              console.log('no activo: '+ced);
             return false;
        });
    
}

function cambiar_estado_tercero(ced,i){
    var page = $("#page").val();
    $.ajax({
            type: 'GET',
            data: 'ced='+ced+'&sw=5',  //
            url: '../vistas/planeacion/terceros/acciones.php', //
            success: function(resultado){
//                alert("El cliente  se ha desactivado."+resultado);
                //mostrar_terp(page);
                $("#td"+i).attr("bgcolor","green");
            }
           }); 
}
function validar_estado_tercero(ced,i,nom){
    var page = $("#page").val();
    $.ajax({
            type: 'GET',
            data: 'ced='+ced+'&nom='+nom+'&sw=6',  //
            url: '../vistas/planeacion/terceros/acciones.php', //
            success: function(resultado){
                $("#td"+i).attr("bgcolor","green");
                //mostrar_terp(page);
            }
           }); 
}
function validarfull(){
    
   $("input[name=item]:checked").each(function(){
    
	var id = $(this).attr("id");
        var ced = $("#ced"+id).val();
        
        existefomfull(ced,id);
                                
}); 
    
}
   

