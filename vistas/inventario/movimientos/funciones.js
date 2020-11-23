function inv_ti_mov_popup() {
    validar_documento();
    window.open("../popup/tmovi/movimiento.php", "Tipos de Movimientos", "width=500px , height=600px");
}
function inv_ti_mov_especial() {
    window.open("../popup/movi_especial/movimiento.php", "Tipos de Movimientos Salida", "width=500px , height=600px");
}
function inv_centro_costo_popup() {
    validar_documento();
    window.open("../popup/centrocosto/centro_costo.php", "Centro de Costo", "width=500px , height=600px");
}
function inv_bodega_popup() {
    validar_documento();
    window.open("../popup/bodegas/bodega.php", "Bodegas", "width=500px , height=600px");
}
function inv_bodega_popup2() {
    window.open("../popup/bodega/bodega.php", "Bodegas", "width=500px , height=600px");
}

function inv_bodega_especial() {
    validar_documento(); //validador si el documento se encuentra guardado
    window.open("../popup/bodega_especial/bodega.php", "Bodegas", "width=500px , height=600px");
}
function inv_tercero_popup(){
    validar_documento(); //validador si el documento se encuentra guardado
     window.open("../popup/terceros/tercero.php", "tercero", "width=500px , height=600px");
}  
function comp_popup(){
    var tipo = $("#descarga").val();
    if(tipo=='ENTRADA'){
        window.open("../popup/compras/clases.php", "compra", "width=1200px , height=600px");
    }else{
        window.open("../popup/salidas/clases.php", "compra", "width=1200px , height=600px");
    }
}

function inv_mov_sald(tipo) {
    validar_documento();
    var loc = $("#loc").val();
    if(tipo=='ENTRADA'){
        window.open("../popup/productos/producto.php", "Productos", "width=1000px , height=600px");
    }else{
        window.open("../popup/existencias/producto.php?loc="+loc, "Productos", "width=1000px , height=600px");
    }
}
function validar_documento(){
    var est = $("#estado").val();
    if(est=='Guardado'){
       $("#continuar").attr("disabled", true);
       $("#Guardar").attr("disabled", true);
       $("#btn_mov").attr("disabled", true);
       $("#btn_cc").attr("disabled", true);
       $("#btn_ter").attr("disabled", true);
       $("#btn_bod").attr("disabled", true);
       $("#additem").attr("disabled", true);
    }else{
       $("#continuar").attr("disabled", false);
       $("#Guardar").attr("disabled", false);
       $("#btn_mov").attr("disabled", false);
       $("#btn_cc").attr("disabled", false);
       $("#btn_ter").attr("disabled", false);
       $("#btn_bod").attr("disabled", false);
       $("#additem").attr("disabled", false);
    }
}
function inv_mov_prores() {
    window.open("../popup/pro_reserva/producto.php", "Productos Reserva", "width=500px , height=600px");
}

function salir() {
    window.close();
}

function prueba() {
    $.post("../movimientos/ejecutar_entrada.php", { "tipdoc": $("#doc").val(), "ndoc": $("#ndoc").val(), "cc": $("#cc").val(), "centro": $("#centro").val(), "obs": $("#obs").val(), "compra": $("#compra").val(), "loc": $("#loc").val(), "nloc": $("#nloc").val(), "des": $("#des").val(), "ndes": $("#ndes").val(), "nombrepro": $("#nombrepro").val(), "nter": $("#nterc").val(), "FecReg": $("#FecReg").val(), "factura": $("#factura").val(), "totalx": $("#totalx").val(), "est": $("#est").val(), "estado": $("#estado").val(), "diferencia": $("#diferencia").val(), "rad": $("#rad").val(), "descarga": $("#descarga").val(), "por": $("#por").val() }, function (data) {
        if (data.sucess == 1) {
            alert('Se realizo operacion con exito');
            document.getElementById("hiddentab").style.visibility='visible';
            document.getElementById('FecReg').value = data.fecha;
            document.getElementById('rad').value = data.radicado;
            document.getElementById('est').value = data.estado;
            document.getElementById("cc").disabled = true;
            document.getElementById("nombrepro").disabled = true;
            document.getElementById("doc").disabled = true;
            document.getElementById("loc").disabled = true;
            document.getElementById("obs").disabled = true;
            document.getElementById("compra").disabled = true;
            document.getElementById("totalx").disabled = true;
            document.getElementById("diferencia").disabled = true;
            document.getElementById("factura").disabled = true;
            if (data.estado == 0) {
                document.getElementById('estado').value = 'En proceso';
            } else if (data.estado == 1) {
                document.getElementById('estado').value = 'Guardado';
            } else {
                document.getElementById('estado').value = 'Anulado';
            }
        }else {
            alert('Error al intentar registrar movimiento de inventario');
        }
    }, "json");
}

function entrada_tras() {
    $.post("../movimientos/ejecutar_traslado.php", { "tipdoc": $("#doc").val(), "ndoc": $("#ndoc").val(), "cc": "0", "centro": "Vacio", "obs": $("#obs").val(), "traslado": $("#traslado").val(), "loc": $("#loc").val(), "nloc": $("#nloc").val(), "des": $("#des").val(), "ndes": $("#ndes").val(), "nombrepro": $("#nombrepro").val(), "nter": $("#nterc").val(), "FecReg": $("#FecReg").val(), "factura": $("#factura").val(), "totalx": $("#totalx").val(), "est": $("#est").val(), "estado": $("#estado").val(), "diferencia": $("#diferencia").val(), "rad": $("#rad").val(), "descarga": $("#descarga").val(), "por": $("#por").val() }, function (data) {
        if (data.sucess == 1) {
            window.opener.moventrada();
            document.getElementById('FecReg').value = data.fecha;
            document.getElementById('rad').value = data.radicado;
            document.getElementById('est').value = data.estado;
            document.getElementById("loc").disabled = true;
            if (data.estado == 0) {
                document.getElementById('estado').value = 'En proceso';
            } else if (data.estado == 1) {
                document.getElementById('estado').value = 'Guardado';
            } else {
                document.getElementById('estado').value = 'Anulado';
            }
            document.getElementById('radicado').value=1;
            document.getElementById('crear_tras_en').style.visibility = "hidden";
        }else {
            alert('Error al intentar registrar movimiento de inventario');
        }
    }, "json");
}

function prueba2() {
    $.post("../movimientos/ejecutar_salida.php", { "idpues":$("#idpues").val(), "tipdoc": $("#doc").val(), "ndoc": $("#ndoc").val(), "cc": $("#cc").val(), "centro": $("#centro").val(), "obs": $("#obs").val(), "compra": $("#orden").val(), "loc": $("#loc").val(), "loc2": $("#loc2").val(), "nloc": $("#nloc").val(), "nloc2": $("#nloc2").val(), "des": $("#des").val(), "ndes": $("#ndes").val(), "nombrepro": $("#nombrepro").val(), "nter": $("#nterc").val(), "FecReg": $("#FecReg").val(), "factura": $("#factura").val(), "totalx": $("#totalx").val(), "est": $("#est").val(), "estado": $("#estado").val(), "diferencia": $("#diferencia").val(), "rad": $("#rad").val(), "descarga": $("#descarga").val(), "por": $("#por").val() }, function (data) {
        if (data.sucess == 1) {
            alert('Se guardo movimiento con exito');
            observer();
            document.getElementById('FecReg').value = data.fecha;
            document.getElementById('rad').value = data.radicado;
            document.getElementById('est').value = data.estado;
            document.getElementById("cc").disabled = true;
            document.getElementById("nombrepro").disabled = true;
            document.getElementById("doc").disabled = true;
            document.getElementById("loc").disabled = true;
            document.getElementById("loc2").disabled = true;
            document.getElementById("obs").disabled = true;
            document.getElementById("orden").disabled = true;
            document.getElementById("totalx").disabled = true;
            document.getElementById("diferencia").disabled = true;
            document.getElementById("factura").disabled = true;
            if (data.estado == 0) {
                document.getElementById('estado').value = 'En proceso';
            } else if (data.estado == 1) {
                document.getElementById('estado').value = 'Guardado';
            } else {
                document.getElementById('estado').value = 'Anulado';
            }
            var tip=document.getElementById('doc').value;
            if(tip=='P028'){
                buscar_dato_res();
            }else{
                cargar_da_salida();
            }
            document.getElementById('continuar').style.visibility='hidden';
        }else {
            alert('Error al intentar registrar movimiento de inventario');
        }
    }, "json");
}

function observer() {
  document.getElementById('tabhidden').style.display='block';
}

function inv_send(id,cod,des,can,col,med) {
    document.getElementById('codid').value = id;
    document.getElementById('cod').value = cod;
    document.getElementById('des').value = des;
    document.getElementById('med').value = med;
    document.getElementById('col').value = col;
    document.getElementById('canr').value = '';
    document.getElementById('ubi').value = '';
    document.getElementById('cant').value = can;
    document.getElementById('movi').value = $("#rad").val();
    if(can==0){
        document.getElementById('canr').disabled = true;
        document.getElementById('ubi').disabled = true;
    }else{
        document.getElementById('canr').disabled = false;
        document.getElementById('ubi').disabled = false;
    }
    $("#inventario_send").modal();
    sacarinfo(cod);
}

function dar_ubicacion(cod,des,can,idf,idm) {
    document.getElementById('cod').value = cod;
    document.getElementById('descb').value = des;
    document.getElementById('cant').value = can;
    document.getElementById('refid').value = idf;
    document.getElementById('codid').value = idm;
    estraccion(cod,idm,idf,can);
    sacarinfo(cod,idf,idm);
    $("#salida_inven_ubic").modal();
}

function estraccion(cod,idm,idf,can) {
    $.post("sacarinfo.php", {"res": "1","cod": cod,"idm": idm,"idf": idf}, function(data){
            if(data.result==0 || data.result==null || data.result==''){
                  document.getElementById('canf').value = can;
                  document.getElementById('resp').innerHTML='';
                  document.getElementById('candes').disabled = false;
                  document.getElementById('ubi').disabled = false;
            }else{
                var total= parseInt(can) - parseInt(data.result);
                  document.getElementById('canf').value = total;
                if(total==0 || total<0){
                  document.getElementById('resp').innerHTML='<b style="color: red;">Elemento Descargado</b>';
                  document.getElementById('candes').disabled = true;
                  document.getElementById('ubi').disabled = true;
                }else{
                  document.getElementById('resp').innerHTML='';
                  document.getElementById('candes').disabled = false;
                  document.getElementById('ubi').disabled = false;
                }
            }
        },"json");
}

function pasar_info(ref) {
    document.getElementById('ubi').value = ref;
    //document.getElementById('ubip').value = ref;
    mostrar_ubi_can();
}
function pasar_ubicacion(ref,id) {
    document.getElementById('ub'+id).value = ref;
    //document.getElementById('ubip').value = ref;
    update_ubi(id,ref);
}
function update_ubi(id,ub){
    var ubi = $("#upubi"+id).val();
    var bod = $("#upbod"+id).val();
    var med = $("#upmed"+id).val();
    var col = $("#upcol"+id).val();
    var cod = $("#upcod"+id).val();
    var can = $("#upcan"+id).val();
    var tipo = $("#descarga").val();
    var c = confirm("Esta seguro de cambiar la ubicacion "+ubi+" por "+ub+" ?");
    if(c){
    $.ajax({
        type: 'GET',
        data: 'ubi='+ubi+'&tipo='+tipo+'&bod='+bod+'&med='+med+'&col='+col+'&cod='+cod+'&can='+can+'&id='+id+'&ub='+ub+'&sw=18',
        url: '../../inventario/movimientos/modelo.php',
        success: function (d) {
            alert(d);
            
        }
    });
    }
}
function mostrar_ubi_can(){
    var rad = $("#codid").val();
    var cod = $("#cod").val();
    $.ajax({
        type: 'GET',
        data: 'rad='+rad+'&cod='+cod+'&sw=5',
        url: '../../inventario/movimientos/modelo.php',
        success: function (d) {
            $("#mostrar_ubi_pro").html(d);
            
        }
    });
}
function mostrar_ubi_can_sal(){
    var rad = $("#codid").val();
    var cod = $("#cod").val();
    $.ajax({
        type: 'GET',
        data: 'rad='+rad+'&cod='+cod+'&sw=5',
        url: '../../inventario/movimientos/modelo.php',
        success: function (d) {
            $("#mostrar_ubi_pro_sal").html(d);
            
        }
    });
}
function buscarb() {
    var sede = $("#sede").val();
    window.open("ubicaciones_beta.php?sede="+sede, "Ubicaciones", "width=1600px , height=600px");
}
function buscarb2(id) {
    var sede = $("#sede").val();
    window.open("ubicaciones_beta.php?sede="+sede+"&id="+id, "Ubicaciones", "width=1600px , height=600px");
}
function cargar_resmate() {
  $.post("acciones_reservas.php", {"save":"1","bod_codigo":$("#loc").val(),"pro_codigo":$("#coder").val(),"cantidad":$("#can").val(),"obra":$("#nloc").val()}, function(data){
              if(data.result==1){
                alert('Se realizo operacion con exito.');
                carga_list_res();
              }else{
                alert(data.result);
              }
        },"json");
}

function carga_list_rest(cod) {
   var obra=cod;
     $.ajax({
        type: 'POST',
        data: 'obrares=' + obra,
        url: 'acciones_reservas.php',
        success: function (d) {
            $("#mostrar_movi_res").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}

function carga_list_res() {
   var obra=$("#loc").val();
     $.ajax({
        type: 'POST',
        data: 'obrares=' + obra,
        url: 'acciones_reservas.php',
        success: function (d) {
            $("#mostrar_movi_res").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}

function descarga_ubica() {
 $.post("acciones_salidas.php", {"save":"1","id_mov":$("#rad").val(),"bod_codigo":$("#loc").val(),"pro_codigo":$("#coder").val(),"descripcion":$("#des").val(),"cantidad":$("#can").val(),"medida":$("#med").val(),"color":$("#col").val(),"orden":$("#orden").val(),"idpro":$("#codid").val(),"ubic":$("#ubi").val(),"tiac":$("#descarga").val()}, function(data){
              if(data.sucess==1){
                alert('Se realizo operacion con exito.');
                cargar_da_salida();
              }else{
                alert('no llego');
              }
        },"json");
}

function cargar_da_salida() {
    var mov=$("#rad").val();
     $.ajax({
        type: 'POST',
        data: 'mov=' + mov + '&tab=1',
        url: 'sacarinfo.php',
        success: function (d) {
            $("#mostrar_movi_salida").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}

function cargar_da_salidas() {
    var mov=$("#rad").val();
     $.ajax({
        type: 'POST',
        data: 'mov=' + mov + '&tabf=1',
        url: 'sacarinfo.php',
        success: function (d) {
            $("#mostrar_movi_salida").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}

function save_datos() {
     var rad= document.getElementById('rad').value;
     document.getElementById('est').value='1';
     document.getElementById('estado').value='Guardado';
     $.post("salidas_mov.php", {"save_total":"1", "rad":rad}, function(data){
              if(data.sucess==1){
                alert('Se realizo operacion con exito.');
                document.getElementById('hidden_add').style.display='none';
                cargar_da_salida();
              }else{
                alert('no llego');
              }
        },"json");
}

function trash_item(id) {
    $.post("salidas_mov.php", {"delete":"1", "id":id}, function(data){
              if(data.sucess==1){
                alert('Se realizo operacion con exito.');
                cargar_da_salida();
              }else{
                alert('No se puedo realizar esta accion!');
              }
        },"json");
}

//function save_total() {
//    var cr = $("#totalp").val();
//    if(cr!='0'){
//        alert("Debes de dar ubicacion a todos los productos.");
//        return false;
//    }
//     var rad= document.getElementById('rad').value;
//     $.post("acciones.php", {"save_total":"1", "rad":rad, "compra": $("#compra").val()}, function(data){
//              if(data.sucess==1){
//                alert('Se realizo operacion con exito.');
//                document.getElementById('est').value='1';
//                document.getElementById('estado').value='Guardado';
//                document.getElementById('hiddentab').style.visibility='hidden';
//                validar_documento();
//              }else{
//                alert('Operacion rechazada.!');
//              }
//    },"json");
//}