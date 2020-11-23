$(function(){
});
function inv_amortiguadores() {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                    url: '../vistas/inventario/amortiguadores/index.php',
				success: function(data){
                    $('#encabezado').html('Amortiguadores');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}   
function reporte_inv() {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                    url: '../vistas/inventario/list_ubicaciones_1/index.php',
				success: function(data){
                                        $('#encabezado').html('Reporte de Inventario');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
} 
function inv_kardex() {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                    url: '../vistas/inventario/kardex/index.php',
				success: function(data){
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}
function prefijos_s() {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                    url: '../vistas/inventario/prefijos/index.php',
				success: function(data){
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}
function inv_marcas(){
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/marca/index.php',
				success: function(data){
                                       $('#encabezado').html('MARCAS');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}      

function inv_modelo(){
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/modelos/index.php',
				success: function(data){
                                       $('#encabezado').html('MODELO');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}

function inv_medidas(){
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/medida/index.php',
				success: function(data){
                                        $('#encabezado').html('MEDIDAS');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}   
function inv_unidad(){
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/unidad/index.php',
				success: function(data){
                                       $('#encabezado').html('UNIDADES');
				       $('#controlador').html(data);
                                       $('#cargar').html('');
				}
			}); 
}

function inv_list_reserva() {
		$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/movimientos/list_res/index.php',
				success: function(data){
                    $('#encabezado').html('<b>Lista de reserva por obras</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}


function inv_grupos(){
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/grupos/index.php',
				success: function(data){
                    $('#encabezado').html('Lista de Grupos');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			});   
}
function inv_lineas(){       
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/lineas/index.php',
				success: function(data){
                    $('#encabezado').html('Lista de Lineas');
					$('#controlador').html(data);
                                        $('#cargar').html('');
			 	}
			}); 
}



function inv_cap_inv(id){       
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                data: 'id='+id,
                                url: '../vistas/inventario/captura/index.php',
				success: function(data){
                    $('#encabezado').html('<B>CAPTURA DE INVENTARIO FISICO</B>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
			 	}
			}); 
}
function inv_lis_cap(){       
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/captura/capturas.php',
				success: function(data){
                    $('#encabezado').html('<B>LISTA CAPTURAS</B>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
			 	}
			}); 
}


function inv_colores(){   
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/colores/index.php',
				success: function(data){
                    $('#encabezado').html('Colores');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}   

function inv_orden_compra(tipo) {
    
    window.open("../vistas/inventario/movimientos/index.php?tipo="+tipo, "Entrada", "width=1300px , height=600px");
}
function inv_traslado(tipo) {
    
    window.open("../vistas/inventario/traslado/index.php?tipo="+tipo, "Entrada", "width=1300px , height=600px");
}

function inv_reserva_material() {
	window.open("../vistas/inventario/movimientos/generar_reserva.php", "Reserva", "width=1300px , height=600px");
}

function inv_ajuste_stock() {
	window.open("../vistas/inventario/movimientos/ajuste_inventario.php", "Ajuste", "width=1300px , height=600px");
}


function inv_mov_entrada(id) {
    window.open("../vistas/inventario/movimientos/index_1.php?tipo=SALIDA", "Salida Inventario", "width=1200px , height=600px");
}
function desglose2() {
    window.open("../vistas/inventario/desgloses/singuardar.php", "Ss", "width=1200px , height=600px");
}
function inv_list_mov_entrada(id) {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                data: 'pend='+id,
                                url: '../vistas/inventario/movimientos/list_mov/index.php',
				success: function(data){
                    $('#encabezado').html('<b>Lista de movimientos</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}
function desglose1(id) {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                data: 'pend='+id,
                                url: '../vistas/inventario/cotizaciones/index.php',
				success: function(data){
                    $('#encabezado').html('<b>Listado de desgloses pendientes</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}
function pre_costosinstalacion(id) {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                data: 'pend='+id,
                                url: '../vistas/inventario/cotizaciones_instalacion/index.php',
				success: function(data){
                    $('#encabezado').html('<b>Listado de Presupuestos</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}
function inv_list_mov_traslado() {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/traslado/list_tras/index.php',
				success: function(data){
                    $('#encabezado').html('<b>Traslados de bodega</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
} 

function inv_ubicaciones() {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/ubicaciones/index.php',
				success: function(data){
                    $('#encabezado').html('<b>Lista de ubicaciones</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}
function inv_ti_mov_popup2() {
    window.open("inventario/popup/tmovi/movimiento.php", "Tipos de Movimientos", "width=500px , height=600px");
}
function kardex_pro() {
	$("#kardex_modal").modal();
	document.getElementById('cod_pro').value='';
}
function kardex_pdf() {
	var cod=document.getElementById('cod_pro').value;
	window.location.assign("../vistas/inventario/movimientos/hojas/hoja_kardex.php?pro="+cod)
}

function kardex_gene() {
	$("#kardex_general").modal();
}

function kardex_g_pdf() {
	window.location.assign("../vistas/inventario/movimientos/hojas/kardex_general.php");
}
function informe_tm() {
	$("#informe_movimiento").modal();
	document.getElementById('doc').value='';
}
function Informe_mov() {
	var cod=document.getElementById('doc').value;
	window.location.assign("../vistas/inventario/movimientos/hojas/hoja_movimientos.php?tipo="+cod);
}
function informe_in_out() {
	$("#infom_ent_sal").modal();
	document.getElementById('fecin').value='';
	document.getElementById('fecout').value='';
}
function impre_sal_in() {
	var fec1=document.getElementById('fecin').value;
	var fec2=document.getElementById('fecout').value;
	window.location.assign("../vistas/inventario/movimientos/hojas/hoja_in_out.php?fecin="+fec1+'&fecout='+fec2);
}
function informe_planilla() {
	//window.location.assign("../vistas/inventario/planilla_inventario.php");
        window.location = "../vistas/inventario/planilla_inventario.php";
    target = "_blank";     
}
function materialesx() {
	$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/materiales/index.php',
				success: function(data){
                    $('#encabezado').html('<b>Mantenimiento de Referencias</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}
function inv_referenciaxx(){
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/referencias/index.php',
				success: function(data){
                                       $('#encabezado').html('Referencias');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}
function inv_clases(){
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
				url: '../vistas/inventario/clases/index.php',
				success: function(data){
                                        $('#encabezado').html('Lista de Clases');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			});   
}
function lista_fomplus(){
		$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/movimiento_fom/index.php',
				success: function(data){
                    $('#encabezado').html('<b>Lista de Movimientos Fom</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}

function inv_stock(){
$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/stock/index.php',
				success: function(data){
                                       $('#encabezado').html('<b>Stock Inventario</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}
function edit_ubic(){
		$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/list_ubicaciones/index.php',
				success: function(data){
                    $('#encabezado').html('<b>Editar ubicaciones</b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}


function inv_clasif(){
		$('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
                                url: '../vistas/inventario/conf_clasificaciones/index.php',
				success: function(data){
                    $('#encabezado').html('<b></b>');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			}); 
}