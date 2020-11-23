 
$(function(){
     $("#mostrar_tabla").html(mostrar_conf(1)); 
     
  
  
 
});

function mostrar_conf(page){
    
        $.ajax({
            type: 'GET',
            data: 'page='+page,
            url: '../vistas/produccion/conf_pagos/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_conf(){ 
     var idconf = $("#id_conf").val(); 
     var descri = $("#des_pago").val();
     var codi = $("#cod_pag").val();
     var pago = $("#pago_por").val();
   
     if(descri===''){
        sweetAlert("precio");
        $("#des_pago").focus();
        return false;
    }
     if(codi===''){
        sweetAlert("variable prima");
        $("#cod_pag").focus();
        return false;
    }
     if(pago===''){
        sweetAlert("pre_actu");
        $("#pago_por").focus();
        return false;
    }
        $.ajax({
            type: 'GET',
            data: 'idconf='+idconf+'&descri='+descri+'&codi='+codi+'&pago='+pago+'&sw=1',
            url: '../vistas/produccion/conf_pagos/acciones.php', 
            success: function(resultado){
                $("#id_conf").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_conf(1);
            }
           });
}

function limpiar_conf(){
   $("#id_conf").val(''); 
   $("#des_pago").val('');
   $("#cod_pag").val('');
   $("#pago_por").val('');
}

function nuevo(){
    limpiar_conf();
}
function editar_pagos(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/produccion/conf_pagos/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
            $("#id_conf").val(t[0]);
            $("#des_pago").val(t[1]);
            $("#cod_pag").val(t[2]);
            $("#pago_por").val(t[3]);
 }
});
}
//function editar(id){
//    $("#marcar1").attr("class","");
//    $("#marcar2").attr("class","active");
//     $.ajax({
//        type: 'GET',
//        data: 'id='+id+'&sw=2',  //
//        url: '../vistas/produccion/conf_pagos/acciones.php', //
//        success: function(resultado){
//  var p = eval(resultado);
//    $("#id_conf").val(p[0]);
//    $("#des_pago").val(p[1]);
//    $("#cod_pag").val(p[2]);
//    $("#pago_por").val(p[3]);
// }
// });
//}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta grupo?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/produccion/grupo_trabajo/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_conf(1);
            }
           });
       }
}

function pasar_id(id){
    $("#numero").val(id);
    mostrar_usuarios(id) 
    
    
}
function mostrar_usuarios(id){
    
        $.ajax({
            type: 'GET',
            data: 'id='+id,
            url: '../vistas/produccion/grupo_trabajo/lista_usuarios.php',
            success: function(resultado){
                 $("#mostrar_usuarios").html(resultado);
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
     var c = confirm("Esta seguro de eliminar esta usuario?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'idnum='+idnum+'&sw=6',  //
            url: '../vistas/produccion/grupo_trabajo/acciones.php', //
            success: function(resultado){
                sweetAlert("Se ha eliminado con exito");
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
