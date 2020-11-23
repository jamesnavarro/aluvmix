function comp_solicitudesxy() {
     $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/solicitudes/index.php',
        success: function (data) {
            $('#encabezado').html('Solicitudes Compra');
            $('#controlador').html(data);
            $('#cargar').html('');
        }
    });
}
function comp_list_solicitudes() {
    $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/solicitudes/list_solicitud.php',
        success: function (data) {
            $('#encabezado').html('Lista Solicitudes');
            $('#controlador').html(data);
            $('#cargar').html('');
        }
    });
}
function comp_list_ordenes() {
     $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/ordenes/index.php',
        success: function (data) {
            $('#encabezado').html('Lista ordenes compra');
            $('#controlador').html(data);
            $('#cargar').html('');
        }
    });
}

function time_gest() {
     $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/gestion_time/index.php',
        success: function (data) {
            $('#encabezado').html('Gestion de Tiempo');
            $('#controlador').html(data);
            $('#cargar').html('');
        }
    });
}

function com_cuentas() {
     $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/cuentas/index.php',
        success: function (data) {
            $('#encabezado').html('Lista de tipo de cuentas');
            $('#controlador').html(data);
            $('#cargar').html('');
        }
    });
}
function agregap(){
    window.open("../vistas/compras/popup/productos/producto.php", "Selecccion Producto", "width=600px , height=500px");
}
function ReporteProveedores() {
     $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/reportes/index.php',
        success: function (data) {
            $('#encabezado').html('Reportes por Proveedores');
            $('#controlador').html(data);
            $('#cargar').html('');
        }
    });
}
function Reporte9999() {
     $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/reportes_9/index.php',
        success: function (data) {
            $('#encabezado').html('Reportes 9999');
            $('#controlador').html(data);
            $('#cargar').html('');
        }
    });
}
//segun plantilla numero2