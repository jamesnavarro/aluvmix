 $(function(){
     $("#mostrar_tabla").html(mostrar_cuentac(1));
     //BUSCADORES DE LA LISTA CUENTA DE COBRO
     
    $('#clien_b').change(function(){
             mostrar_cuentac(1);
     });  
     
       $('#cod').change(function(){
             mostrar_cuentac(1);
     }); 
        $('#ope_b').change(function(){
             mostrar_cuentac(1);
     }); 
       $('#esta_b').change(function(){
             mostrar_cuentac(1);
     }); 
       $('#usu_b').change(function(){
             mostrar_cuentac(1);
     }); 
     
       $('#fec_b').change(function(){
             mostrar_cuentac(1);
     }); 
     
     // BUSCADOR DE LA LISTA DE CLIENTES PARA EL FORMULARIO DE CUENTA  DE COBRO 
      $('#doc_cli').change(function(){
        bcar_tercero();
      });
    
 });  

    function mostrar_cuentac(page){
         var clien_b =$("#clien_b").val();
         var cod =$("#cod").val();
         var ope_b =$("#ope_b").val();
         var esta_b =$("#esta_b").val(); 
         var usu_b =$("#usu_b").val();
         var fec_b =$("#fec_b").val();
            
        $.ajax({
                type:'GET',
                data:'clien_b='+clien_b+'&cod='+cod+'&ope_b='+ope_b+'&esta_b='+esta_b+'&usu_b='+usu_b+'&fec_b='+fec_b+'&page='+page,
                url: '../vistas/produccion/cuentas_cobro/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_cuentac(){
        var id_cta_c = $("#id_cta_c").val();
        var puesto_c = $("#puesto_c").val();
        var estado_c = $("#estado_c").val();
        var operacion_c = $("#operacion_c").val();
        var usu_cuenta = $("#usu_cuenta").val();
        var fecha_cuenta = $("#fecha_cuenta").val();
        var doc_cli = $("#doc_cli").val();
        var cli_nom = $("#cli_nom").val();
     
         
     if(puesto_c===''){
        sweetAlert("Seleccione el puesto de trabajo");
        $("#puesto_c").focus();
        return false;
        }
          if(puesto_c===''){
        sweetAlert("Escoja la operacion");
        $("#operacion_c").focus();
        return false;
        }
        
        if(estado_c=='Guardado'){
             sweetAlert("Ya este documento esta guardado");
             return false;
        }
     
        $.ajax({
            type: 'GET',
            data: 'id='+id_cta_c+'&puesto_c='+puesto_c+'&estado_c='+estado_c+'&operacion_c='+operacion_c+'&usu_cuenta='+usu_cuenta+'&fecha_cuenta='+fecha_cuenta+'&doc_cli='+doc_cli+'&cli_nom='+cli_nom+'&sw=1',
            url: '../vistas/produccion/cuentas_cobro/acciones.php', 
           success: function(resultado){
                var p = eval(resultado);
                $("#id_cta_c").val(p[0]); 
                $("#estado_c").val(p[3]);
                $("#usu_cuenta").val(p[1]);
                $("#fecha_cuenta").val(p[2]);
                sweetAlert("Se ha guardo con exito");
                mostrar_cuentac(1);
            }
           });
}

function limpiar_cuentac(){
       $("#id_cta_c").val('');
       $("#puesto_c").val('');
       $("#estado_c").val('');
       $("#operacion_c").val('');
       $("#usu_cuenta").val('');
       $("#fecha_cuenta").val('');
       $("#mostrar_item").html('');//aqui se limpia una tabla independiente html('')
       $("#doc_cli").val('');
       $("#cli_nom").val('');
      
}
function nuevo(){
    limpiar_cuentac();
}

function editar_cuentac(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/produccion/cuentas_cobro/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
   
       $("#id_cta_c").val(t[0]);
       $("#puesto_c").val(t[1]);
       $("#estado_c").val(t[2]);
       $("#operacion_c").val(t[3]);
       $("#usu_cuenta").val(t[4]);
       $("#fecha_cuenta").val(t[5]);
       $("#doc_cli").val(t[6]);
       $("#cli_nom").val(t[7]);
       mostrar_s_item();
        
 }
});
}

function serv(){
    window.open("../popup/servicio_b/index.php" ,"SERVICIOS", " width=900 , height=500 ");
}

function bus_cli(){
    window.open("../popup/terceros/index.php" ,"CLIENTES", " width=900 , height=500 ");
}
function pasar_tercero(cod,nom){
                $("#doc_cli").val(cod);
                $("#cli_nom").val(nom);
}


 function bcar_tercero(){
     var cod = $("#doc_cli").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=8',
         url: '../vistas/produccion/cuentas_cobro/acciones.php', //
         success: function(t) {
             var t = eval(t);
              $("#doc_cli").val(t[0]);
              $("#cli_nom").val(t[1]);
         } 
});
 }


function operacion_item(){
     var cant_s = $("#cuatro").val();
     var vlr_u = $("#cinco").val();
     var total= parseFloat(cant_s) * parseFloat(vlr_u);
     $("#seis").val(total);
    
}


function guardar_item(){
      var estado_c = $("#estado_c").val();
          
    if(estado_c=='Guardado'){
      sweetAlert("No puedes relizar mas cambios ya esta guardado");
      return false;
      }
     var cod_s = $("#dos").val();
     var des_s = $("#tres").val();
     var cant_s = $("#cuatro").val();
     var val_s = $("#cinco").val();
     var totl_s = $("#seis").val();
     var id_cta_c = $("#id_cta_c").val();
     var id_itm = $("#id_itm").val();
     var puesto = $("#puesto").val();
     var movimiento = $("#movimiento").val();
     
       if(des_s===''){   
        sweetAlert("Debes escojer el servicio");
        $("#tres").focus();
        return false;
        }
         
        if(cant_s===''){
        sweetAlert("no agregaste la cantidad");
        $("#cuatro").focus();
        return false;
        }
        
       
        if(id_cta_c===''){
        sweetAlert("no se puede agregar !no existe cuenta de cobro");
        $("#id_cta_c").focus();
        return false;
        }
  
       $.ajax({
            type: 'GET',
            data: 'id_servicio='+cod_s+'&des_s='+des_s+'&cant_s='+cant_s+'&val_s='+val_s+'&totl_s='+totl_s+'&id_cta_c='+id_cta_c+'&id_itm='+id_itm+'&puesto='+puesto+'&movimiento='+movimiento+'&sw=5',
            url: '../vistas/produccion/cuentas_cobro/acciones.php', 
           success: function(resultado){
                console.log(resultado);
                sweetAlert("Se ha guardo con exito");
                limpia_items();
                mostrar_s_item();
            }
           });
}
 function mostrar_s_item(){
          var id_cta_c = $("#id_cta_c").val();
          $.ajax({
                type:'GET',
                data:'id_cuenta='+id_cta_c,
                url: '../vistas/produccion/cuentas_cobro/lista_item.php',
                success: function(d){
                $("#mostrar_item").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    
    function limpia_items(){
         $("#dos").val('');
         $("#tres").val('');
         $("#cuatro").val('');
         $("#cinco").val('');
         $("#seis").val('');
         $("#puesto").val('');
         $("#movimiento").val('');
    }
    function eliminar_items(id){
          var estado_c = $("#estado_c").val();
          
           if(estado_c=='Guardado'){
             sweetAlert("Este documento no se puede eliminar");
             return false;
           }
         var c = confirm("Esta seguro de eliminar este items?");
     if(c){
         $.ajax({
            type: 'GET',
            data:'id='+id+'&sw=6',  //
            url: '../vistas/produccion/cuentas_cobro/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_s_item();
            }
           });
       } 
       
    }
    
    function editar_items(id){
        var estado_c = $("#estado_c").val();
           if(estado_c=='Guardado'){
             sweetAlert("No se puede editar el documento");
             return false;
           }
        $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=7',  //
            url: '../vistas/produccion/cuentas_cobro/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
   
         $("#id_cta_c").val(t[0]);
         $("#dos").val(t[1]);
         $("#tres").val(t[2]);
         $("#cuatro").val(t[3]);
         $("#cinco").val(t[4]);
         $("#seis").val(t[5]);
         $("#puesto").val(t[6]);
         $("#movimiento").val(t[7]);
         $("#id_itm").val(id);
 
    }
        });
    }
    
   
 function pdf(){
    var id = $("#id_cta_c").val();
    if(id==''){
             sweetAlert("No hay datos para mostrar");
             return false;
           }
      window.open("../vistas/produccion/cuentas_cobro/pdf.php?id="+id , "resumen", " width= 800 , height=600 ");
}

 
