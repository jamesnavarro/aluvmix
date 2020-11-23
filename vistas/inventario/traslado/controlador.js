 $(function(){
     $("#can").change(function(){
         alert('ok');
        calculo_total();
        $("#pre").focus();
      });
      $("#pre").change(function(){
        calculo_total();
        $("#additem").focus();
      });
   
});

 function busca_mov(){
     var cod = $("#doc").val();
     var est = $("#est").val();
     var tipo = $("#descarga").val();
      if(est==1){
          return false;
      }
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&tipo='+tipo+'&sw=11',
                url: '../../inventario/traslado/modelo.php',
         success: function(t) {
             var t = eval(t);
              $("#doc").val(t[1]);
              $("#ndoc").val(t[2]); 
              if (t[3]=='No'){
                  $("#cc").attr("disabled", true);
                  $("#btn_cc").attr("disabled", true);
              }else{
                  $("#cc").attr("disabled", false);
                  $("#btn_cc").attr("disabled", false);
                  $("#cc").focus();
              }
               
         }
     
});
 }
 
  function bus_cencost(){
     var codc = $("#cc").val();
      var est = $("#est").val();
      if(est==1){
          return false;
      }
      $.ajax({
                type: 'GET',
                data: 'codcc='+codc+'&sw=12',
                url: '../../inventario/traslado/modelo.php',
         success: function(t) {
             var t = eval(t);
              $("#cc").val(t[1]);
              $("#centro").val(t[2]);
               $("#obs").focus();
         }
    
});
 }
 function bus_bodega(){
     var codb = $("#loc").val();
      var est = $("#est").val();
      if(est==1){
          return false;
      }
      $.ajax({
                type: 'GET',
                data: 'codb='+codb+'&sw=13',
                url: '../../inventario/traslado/modelo.php',
         success: function(t) {
             var t = eval(t);
              $("#loc").val(codb);
              $("#nloc").val(t[2]); 
              $("#sede").val(t[3]); 
         }
     
});
 }
 
 
 
  function bus_bodega_tras(){
     var codb = $("#loc_tras").val();
      var est = $("#est").val();
      if(est==1){
          return false;
      }
      $.ajax({
                type: 'GET',
                data: 'codb='+codb+'&sw=13',
                url: '../../inventario/traslado/modelo.php',
         success: function(t) {
             var t = eval(t);
              $("#loc_tras").val(codb);
              $("#nloc_tras").val(t[2]); 
              $("#sede").val(t[3]); 
         }
     
});
 }
  function bus_ter(){
     var codt = $("#nombrepro").val();
      var est = $("#est").val();
      if(est==1){
          return false;
      }
      $.ajax({
                type: 'GET',
                data: 'codt='+codt+'&sw=14',
                url: '../../inventario/traslado/modelo.php',
         success: function(t) {
             var t = eval(t);
              $("#nombrepro").val(codt);
              $("#nterc").val(t[2]);  
         }
     
});
 }

function calculo_total(){
    var can = $("#can").val();
    var stc = $("#stc").val();
    var pre = $("#pre").val();
    var des = $("#descarga").val();
    if(des=='SALIDA'){
        if(parseInt(can)>parseInt(stc)){
            alert("La cantidad digitada es mayor al stock actual.");
            $("#can").val('').focus();
            return false;
        }
    }
    var t =  can * pre;
    $("#pret").val(t);
}
function dar_acesso(cod,des,res,idr,mov,pre){
      $("#cod").val(cod);
      $("#codid").val(idr);
      $("#descri").val(des);
      $("#cant").val(res);
      $("#canr").val(res);
      $("#movi").val(mov);
      $("#preu").val(pre);
      var des = $("#descarga").val();
      if(des=='ENTRADA'){
          mostrar_ubi_can();
          $("#inventario_send").modal('show');     
      }else{
          mostrar_cantidad_ubi(cod,des,res,idr,mov,pre);
          mostrar_ubi_can_sal();
          $("#inventario_sal").modal('show');
          $("#idre").val(idr);
      }
       
}
function mostrar_cantidad_ubi(cod,des,res,idr,mov,pre){
    var des = $("#descarga").val();
    var loc = $("#loc").val();
     $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&loc='+loc+'&can='+res+'&sw=10',
        url: '../../inventario/traslado/modelo.php',
        success: function (d) {
            $("#mostrar_cantidad").html(d);

        }
    });
    
}
function continuar(){
    validar_documento(); //validador si el documento se encuentra guardado
    var rad = $("#rad").val();//id_mov
    var doc = $("#doc").val();//codigo_tm
    var cc = $("#cc").val();//cen_codigo
    var obs = $("#obs").val();//obs
    var compra = $("#compra").val();//id_orden
    var factura = $("#factura").val();//num_docuemnto
    var almori = $("#loc").val();//bod_codigo
     var almorit = $("#loc_tras").val();//bod_codigo
    var totalx = $("#totalx").val();//total
    var est = $("#est").val();//save
    var ter = $("#nombrepro").val();//codigo_ter
    var diferencia = $("#diferencia").val();//diferencia
    var por = $("#por").val();//usuario
    var descarga = $("#descarga").val();//tipo_movimiento
    var sede = $("#sede").val();//tipo_movimiento
    if(doc==''){
        alert("Selecciona el tipo de movimiento!!");
        $("#doc").focus();
        return false;
    }
//    if(cc==''){
//        alert("Selecciona el centro de costo");
//        $("#cc").focus();
//        return false;
//    }
   
    if(almori==''){
        alert("Selecciona la bodega");
        $("#loc").focus();
        return false;
    }
    if(ter==''){
        alert("Selecciona el tercero");
        $("#nombrepro").focus();
        return false;
    }
     $.ajax({
            type: 'GET',
            data: 'rad='+rad+'&doc='+doc+'&cc='+cc+'&sede='+sede+'&obs='+obs+'&compra='+compra+'&factura='+factura+
                    '&almori='+almori+'&almorit='+almorit+'&totalx='+totalx+'&est='+est+'&ter='+ter+'&diferencia='+diferencia+'&por='+por+'&descarga='+descarga+'&sw=1',
            url: '../../inventario/traslado/modelo.php',
            success: function(resultado){
               var p = eval(resultado);
                $("#rad").val(p[0]);
                $("#FecReg").val(p[1]);
                $("#por").val(p[2]);
                console.log('resultado: '+p[3]);
                validar_informacion();
                // cargadatos(rad);
            }
    });
    
}
function add_pro(){
    validar_documento(); //validador si el documento se encuentra guardado
    var rad = $("#rad").val();
    var des = $("#des").val();
    var col = $("#col").val();
    var med = $("#med").val();
    var stc = $("#stc").val();
    var can = $("#can").val();
    var pre = $("#pre").val();
    var cod = $("#coder").val();
    var almori = $("#loc").val(); 
    var id_proadd = $("#id_proadd").val(); 
    
    //bod_codigo 
     if(rad==''){
         alert("Debes de generar el documento.");
         return false;
     }
     if(cod===''){
         alert("Debes escoger el codigo");
         $("#coder").focus();
         return false;
     }
    
    $.ajax({
            type: 'GET',
            data: 'rad='+rad+'&des='+des+'&col='+col+'&med='+med+'&stc='+stc+'&can='+can+'&pre='+pre+'&cod='+cod+'&almori='+almori+'&id_proadd='+id_proadd+'&sw=2',
            url: '../../inventario/traslado/modelo.php',
            success: function(resultado){
                cargadatos(rad);
                limpiar_form();
            }
    });
}
function limpiar_form(){
    $("#des").val('');
    $("#col").val('');
    $("#med").val('');
    $("#stc").val('');
    $("#can").val('');
    $("#pre").val('');
    $("#pret").val('');
    $("#coder").val('');
    $("#id_proadd").val('');
}
function cargadatos(rad) {

    $.ajax({
        type: 'GET',
        data: 'ord=' + rad + '&sw=4',
        url: '../../inventario/traslado/modelo.php',
        success: function (d) {
            $("#mostrar_moviemientos").html(d);

        }
    });
}

 function editar_cargadatos(id){
     
        $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../../inventario/traslado/modelo.php', //
            success: function(resultado){
            var t = eval(resultado);
   
    $("#id_cta_c").val(t[0]);
    $("#rad").val(t[1]);
    $("#des").val(t[2]);
    $("#col").val(t[3]);
    $("#med").val(t[4]);
    $("#stc").val(t[5]);
    $("#can").val(t[6]);
    $("#pre").val(t[7]);
    $("#coder").val(t[8]);
    $("#almori").val(t[9]);
    $("#id_proadd").val(t[10]); 
 
    }
        });
    }
     function sacarinfo3(id) {
            $.post("acciones.php", 
            {"api-rest":true,"id":id},
            function(data){
         
                          if(data.sucess==1){
                             $("#doc").val(data.tipo_mov);
                             $("#ndoc").val(data.name_tipo);
                             $("#cc").val(data.code_costo);
                             $("#centro").val(data.name_cc);
                             $("#loc").val(data.code_bodega);
                             $("#nloc").val(data.name_bodega);
                             $("#nombrepro").val(data.cod_ter);
                             $("#nterc").val(data.nom_ter);
                             $("#FecReg").val(data.fecha);
                             $("#factura").val(data.remision);
                             $("#totalx").val(data.totalr);
                             $("#diferencia").val(data.diferencia);
                             $("#por").val(data.por);
                             $("#compra").val(data.orden_c);
                             $("#obs").val(data.obs);
                             $("#nterc").val(data.nter);
                              $("#est").val(data.estado);
                              $("#sede").val(data.sede);
                              $("#descarga").val(data.desca);
                              $("#loc_tras").val(data.dest);
                              $("#nloc_tras").val(data.destn);
                              if(data.estado=='1'){
                                  $("#estado").val('Guardado');
                              }else{
                                  $("#estado").val('En proceso');
                              }
                              validar_documento();
                              validar_informacion();
                             cargadatos(id);
                          }else{
                            alert('Los datos no pudieron cargarse con exito.');
                          }
                    },"json");
          }
function inv_orden_compra(id) {
    location.href = 'index.php?tipo='+id;
}



 function editar_tabhidden(id){
     
        $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../../inventario/traslado/modelo.php', //
            success: function(resultado){
            var t = eval(resultado);
   
                  $("#").val(t[0]);
   
 
            }
        });
    }
function save_mod_ubi(){
    var loc = $("#loc").val(); 
    var rad = $("#rad").val(); 
    var cod = $("#cod").val(); 
  
    var cant = $("#canr").val();
    var ubi = $("#ubi").val();
    var cost = $("#preu").val();
    var idmd = $("#codid").val();

    $.ajax({
            type: 'GET',
            data: 'rad='+rad+'&loc='+loc+'&cod='+cod+'&idmd='+idmd+'&cost='+cost+'&cant='+cant+'&ubi='+ubi+'&sw=6',  //
            url: '../../inventario/traslado/modelo.php', //
            success: function(resultado){
                mostrar_ubi_can();
                cargadatos(rad);
                $("#inventario_send").modal('hide');
                $("#ubi").val('');
            }
        });
}
function save_mod_ubi_sal(id){
    var cc = confirm("Estas seguro de dar salida a este items?");
    if(cc){
    var loc = $("#loc").val(); 
    var rad = $("#rad").val(); 
    var cod = $("#co"+id).val(); 
    var cant = $("#ca"+id).val(); 
    var cans = $("#cas"+id).val(); 
    var st = $("#st"+id).val();
    var ubi = $("#ub"+id).val();
    var cost = $("#pr"+id).val();
    var idmd = $("#idre").val();
    
    if(cant=='' || cant=='0'){
        alert("Debes de digitar la cantidad "+ubi);
        $("#ca"+id).val('').focus();
        return false;
    }
    if(parseInt(cant) > parseInt(cans)){
        alert('La cantidad digitada es mayor al cantidad solicitada');
        $("#ca"+id).val('').focus();
        return false;
    }
    if(parseInt(cant) > parseInt(st)){
        alert('La cantidad digitada es mayor al stock actual');
        $("#ca"+id).val('').focus();
        return false;
    }

    $.ajax({
            type: 'GET',
            data: 'rad='+rad+'&loc='+loc+'&cod='+cod+'&idmd='+idmd+'&cost='+cost+'&cant='+cant+'&st='+st+'&ubi='+ubi+'&sw=6',  //
            url: '../../inventario/traslado/modelo.php', //
            success: function(resultado){
                mostrar_ubi_can();
                cargadatos(rad);
                $("#inventario_send").modal('hide');
                $("#inventario_sal").modal('hide');
                $("#ubi").val('');
            }
        });
    }
}
function del_ite(id){
    var est = $("#est").val(); 
    if(est==1){
        alert("No puedes eliminar este items, ya el documento esta guardado.");
        return false;
    }
    
    var c = confirm("Esta seguro de eliminar este items?");
    if(c){
    var rad = $("#rad").val(); 

    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=7',  //
            url: '../../inventario/traslado/modelo.php', //
            success: function(resultado){
                mostrar_ubi_can();
                cargadatos(rad);
            }
        });
    }
}
function save_total() {
    var cr = $("#totalp").val();
    if(cr!='0'){
        alert("Debes de dar ubicacion a todos los productos.");
        return false;
    }
    
    var co = confirm("Esta seguro de guardar este movimiento?");
    if(co){
     var rad = $("#rad").val();
     var tipo = $("#descarga").val();
     var loc = $("#loc").val();
     var too = $("#totalx").val();
     var tod = $("#totald").val();
     var dest = $("#loc_tras").val();
     var tt = too - tod;
     var dif = tt;
     $.ajax({
            type: 'GET',
            data: 'rad='+rad+'&tipo='+tipo+'&loc='+loc+'&dest='+dest+'&total='+too+'&dif='+dif+'&sw=8',  //
            url: '../../inventario/traslado/modelo.php', //
            success: function(re){
                console.log(re);
                $("#estado").val('Guardado');
                $("#est").val('1');
                alert("Se guardo con exito.");
                
            }
        });
    }
}
function revertir() {
    var cr = $("#totalp").val();
    if(cr!='0'){
        alert("Debes de dar ubicacion a todos los productos.");
        return false;
    }
    
    var co = confirm("Esta seguro de guardar este movimiento?");
    if(co){
     var rad = $("#rad").val();
     var tipo = $("#descarga").val();
     var loc = $("#loc").val();
     var too = $("#totalx").val();
     var tod = $("#totald").val();
     var tt = too - tod;
     var dif = tt;
     $.ajax({
            type: 'GET',
            data: 'rad='+rad+'&tipo='+tipo+'&loc='+loc+'&dif='+dif+'&sw=9',  //
            url: '../../inventario/traslado/modelo.php', //
            success: function(){
                $("#estado").val('En proceso');
                $("#est").val('0');
                
                
            }
        });
    }
}
function ordenes(){
    var orden = $("#compra").val();
    var descarga = $("#descarga").val();
    $.ajax({
            type: 'GET',
            data: 'orden='+orden+'&descarga='+descarga+'&sw=15',  //
            url: '../../inventario/traslado/modelo.php', //
            success: function(a){
                var p = eval(a);
                //bus_bodega();
                
                $("#loc").val(p[0]);
                $("#nombrepro").val(p[1]);
                $("#totalx").val(p[2]);
                bus_bodega();
                bus_ter();
                
                
            }
        });
    
}

function validar_informacion(){
   var rad = $("#rad").val();
    if(rad===''){
        $("#doc").attr("disabled", false);
       $("#btn_mov").attr("disabled", false);
        $("#cc").attr("disabled", false);
        $("#obs").attr("disabled", false);
        $("#compra").attr("disabled", false);   
        $("#loc").attr("disabled", false);   
        $("#nombrepro").attr("disabled", false);
        $("#btn_cc").attr("disabled", false);
        $("#btn_bod").attr("disabled", false);
        $("#btn_ter").attr("disabled", false);
        $("#btnn_mov").attr("disabled", false);   
        $("#factura").attr("disabled", false);
        $("#totalx").attr("disabled", false);
    }else{
        $("#doc").attr("disabled", true);
        $("#btn_mov").attr("disabled", true);
        $("#cc").attr("disabled", true);
        $("#obs").attr("disabled", true);
        $("#compra").attr("disabled", true);
        $("#loc").attr("disabled", true);
        $("#nombrepro").attr("disabled", true);
        $("#btn_cc").attr("disabled", true);
        $("#btn_bod").attr("disabled", true);
        $("#btn_ter").attr("disabled", true);
        $("#btnn_mov").attr("disabled", false); 
        $("#factura").attr("disabled", true); 
        $("#totalx").attr("disabled", true); 
    }
}