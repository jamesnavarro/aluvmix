//TABLAS DE LISTA DE ORDENES DE COMPRA
$(function () {
   $("#mostrar_tabla").html(mostrar_table(1));

    $('#cod').change(function(){
        mostrar_table(1);
      });
     $('#des').change(function(){
        mostrar_table(1);
      }); 
       $('#nit').change(function(){
        mostrar_table(1);
      }); 
       $('#provee').change(function(){
        mostrar_table(1);
      }); 
       $('#fec').change(function(){
        mostrar_table(1);
      }); 
         $('#est').change(function(){
        mostrar_table(1);
      }); 
       $('#usu').change(function(){
        mostrar_table(1);
      }); 
      $('#fom').change(function(){
        mostrar_table(1);
      });
});

function mostrar_table(page){
    var cod = $("#cod").val();
    var des = $("#des").val();
    var nit = $("#nit").val();
    var provee = $("#provee").val();
    var fec = $("#fec").val();
    var est = $("#est").val();
    var usu = $("#usu").val();
    var fom = $("#fom").val();
    $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&des='+des+'&nit='+nit+'&provee='+provee+'&fec='+fec+'&est='+est+'&usu='+usu+'&fom='+fom+'&page=' + page,
        url: '../vistas/compras/ordenes/lista_ordenes.php',
        success: function (d) {
            $("#mostrar_tabla").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}
function printer_rep(){
    var cod = $("#cod").val();
    var des = $("#des").val();
    var nit = $("#nit").val();
    var provee = $("#provee").val();
    var fec = $("#fec").val();
    var est = $("#est").val();
    var usu = $("#usu").val();
    var fom = $("#fom").val();
    window.open('../vistas/compras/ordenes/reporte_ord.php?cod='+cod+'&des='+des+'&nit='+nit+'&provee='+provee+'&fec='+fec+'&est='+est+'&usu='+usu+'&fom='+fom,'_blank');
}
function ver_ord(ord) {
    $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/ordenes/detalles_or.php',
        success: function (data) {
            $('#encabezado').html('Orden de compras');
            $('#controlador').html(data);
            $('#cargar').html('');
            $('#ordenz').val(ord);
            Encabezados(ord);
            mostrar_tablz(ord);
        }
    });
}

function mostrar_tablz(page) {
    $.ajax({
        type: 'POST',
        data: 'ids=' + page,
        url: '../vistas/compras/ordenes/list_products.php',
        success: function (d) {
            $("#mostrar_tabla_products").html(d);
            if (d === 'error') {
                location.href = '../index.php';
            }
        }
    });
}

function Encabezados(x) {

       $.post("../vistas/compras/ordenes/acciones.php", {"enca":x}, function(data){
        
              if(data.sucess=='1'){
                  document.getElementById('ord').innerHTML=x;
                  document.getElementById('fecc').innerHTML=data.feccx;
                  document.getElementById('emp').innerHTML=data.empresax;
                  document.getElementById('bod').innerHTML=data.bodegax;
                  document.getElementById('crp').innerHTML=data.userx;
                  document.getElementById('est').innerHTML=data.estadox;
                  document.getElementById('prove').innerHTML=data.provex;
                  document.getElementById('cen').innerHTML=data.cenx;
                  $("#fom").val(data.fom);
                  $("#cor").val(data.correo);
                  $("#orden").val(x);
              }else{
                alert('Error al intentar buscar solicitud!');
              }
           },"json");
}

function printer(ord){
    window.open('../vistas/compras/ordenes/print_fact.php?id='+ord,'_blank');
}

function printerop(){
    var ord = $("#orden").val();
    window.open('../vistas/compras/ordenes/print_fact.php?id='+ord,'_blank');
}
function enviar_orden(){
    var orden = $("#orden").val();
    var cor = $("#cor").val();
    var asunto = $("#asunto").val();
    var cuerpo = $("#cuerpo").val();
    if(asunto==''){
        alert("Llene el asunto");
        $("#asunto").focus();
        return false;
    }
    if(cor==''){
        alert("Llene el correo");
        $("#cor").focus();
        return false;
    }
    //996070389
    $.ajax({
        type: 'GET',
        data: 'id='+orden+'&asunto='+asunto+'&cuerpo='+encodeURIComponent(cuerpo)+'&correo='+encodeURIComponent(cor),
        url: '../vistas/compras/ordenes/enviar.php',
        success: function (d) {
            console.log(d);
             window.open("http://aluvmix.softmediko.com/Enviar.php?orden="+d,"form","width=100px, height=100px");
        }
    });
    
}
function editar(id,col,texto) {
     
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&col='+col+'&texto='+texto+'&sw=1',
        url: '../vistas/compras/ordenes/modelo.php',
        success: function (d) {
            $("#"+col+id).html(d);
        }
    });
}
function delitemorden(idord, idsol,orden){
    var c = confirm("Estas seguro de anular este items?");
    $.ajax({
        type: 'GET',
        data: 'idord='+idord+'&idsol='+idsol+'&orden='+orden+'&sw=4',
        url: '../vistas/compras/ordenes/modelo.php',
        success: function (d) {
           mostrar_tablz(orden);
        }
    });
}
function AnularOC(idord){
    var c = confirm("Estas seguro de anular esta Orden?"+idord);
    if(c){
    $.ajax({
        type: 'GET',
        data: 'idord='+idord+'&sw=5',
        url: '../vistas/compras/ordenes/modelo.php',
        success: function (d) {
            alert(d);
           comp_list_ordenes();
        }
    });
}
}
function upord(id,col){
    var texto = $("#caja"+col).val();
    $.ajax({
        type: 'GET',
        data: 'id='+id+'&col='+col+'&texto='+texto+'&sw=2',
        url: '../vistas/compras/ordenes/modelo.php',
        success: function (d) {
            mostrar_tablz($("#orden").val());
            $("#msg").html(d);
        }
    });
}

function updatecorreo(){
    var ord = $("#orden").val();
    var cor = $("#cor").val();
    $.ajax({
        type: 'GET',
        data: 'ord='+ord+'&cor='+cor+'&sw=3',
        url: '../vistas/compras/ordenes/modelo.php',
        success: function (d) {
            console.log('Re:'+d);
        }
    });
}

function DetalleOC(ord,fom,pro){
    $("#DetalleOrden").modal('show');
    $("#enca").html('Orden: '+fom+' Proveedor: '+pro);
    mostrar_tablz(ord);
}
