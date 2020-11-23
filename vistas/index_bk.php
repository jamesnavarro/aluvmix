<?php 
include '../modelo/conexioni.php';
session_start();
if(!isset($_SESSION['k_username'])){
     header("location:../index.php");    
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Aluvmix</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<script src="assets/js/ace-extra.min.js"></script>
                <script src="../js/jquery.min.js"></script>
                <script src="../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../js/sweetalert.css">
                <script src="../controlador/control.js"></script>
				<script src="../controlador/inventario.js"></script>
				<script src="../controlador/compras.js"></script>
                <script src="../controlador/configuraciones.js"></script>
                <script src="../controlador/contabilidad.js"></script>
                <script src="../controlador/produccion.js"></script>
                <script src="../controlador/cartera.js"></script>
                <script src="../controlador/popup.js"></script>
                <script src="../controlador/ventas.js"></script>
        <style type="text/css">
        	.ui-autocomplete {
				  z-index:2147483647;
				}
        </style>
               
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default  ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand">
						<small>
							<i class="fa fa-building"></i>
							Templado Soft
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									4 Tasks to complete
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Software Update</span>
													<span class="pull-right">65%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:65%" class="progress-bar"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Hardware Upgrade</span>
													<span class="pull-right">35%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:35%" class="progress-bar progress-bar-danger"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Unit Testing</span>
													<span class="pull-right">15%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:15%" class="progress-bar progress-bar-warning"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Bug Fixes</span>
													<span class="pull-right">90%</span>
												</div>

												<div class="progress progress-mini progress-striped active">
													<div style="width:90%" class="progress-bar progress-bar-success"></div>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See tasks with details
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
														New Comments
													</span>
													<span class="pull-right badge badge-info">+12</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												Bob just signed up as an editor ...
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
														New Orders
													</span>
													<span class="pull-right badge badge-success">+8</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									5 Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Alex:</span>
														Ciao sociis natoque penatibus et auctor ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>a moment ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Susan:</span>
														Vestibulum id ligula porta felis euismod ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>20 minutes ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Bob:</span>
														Nullam quis risus eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>3:15 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Kate:</span>
														Ciao sociis natoque eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>1:33 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Fred:</span>
														Vestibulum id penatibus et auctor  ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>10:09 am</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="inbox.html">
										See all messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Bienvenido,</small>
									<?php echo $_SESSION['k_username']; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Configuraciones
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Perfil
									</a>
								</li>
                                                                
                                                            	<li class="">
                                                                            <a href="#nuevo_usuario" onclick="nuevo_usuario();">
											<i class="ace-icon fa fa-user-plus"></i>
											Usuario
										</a>

								</li>
								<li class="divider"></li>

								<li>
									<a href="../salir.php">
										<i class="ace-icon fa fa-power-off"></i>
										Salir
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
		
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Presupuestos
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Cotizaciones
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
                                                                            <a href="#nueva_cotizacion" onclick="nueva_cotizacion();">
											<i class="menu-icon fa fa-plus purple"></i>
											Cotizar Producto
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#cotizae_prod" onclick="pre_cotizaciones();">
											<i class="menu-icon fa fa-eye pink"></i>
											Cotizaciones
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
                                                        <li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Configuracion
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="#crear_cot" onclick="productos_dos(0);"> 
											<i class="menu-icon fa fa-plus purple"></i>
											Nuevo Producto
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#" onclick="pre_lista()">
											<i class="menu-icon fa fa-eye pink"></i>
											Productos
										</a>

										<b class="arrow"></b>
									</li>
                                                                         <li class="">
										<a href="#pre_porcentaje" onclick="pre_porcentaje();">
											<i class="menu-icon fa fa-eye pink"></i>
											Porcentajes
										</a>
										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#pre_servitemple" onclick="pre_servitemple();">
											<i class="menu-icon fa fa-eye pink"></i>
											Servicio Temple
										</a>

										<b class="arrow"></b>
									</li>
                                                                         <li class="">
										<a href="#pre_gastos" onclick="pre_gastos();">
											<i class="menu-icon fa fa-eye pink"></i>
											Gastos administrativos
										</a>

										<b class="arrow"></b>
									</li>
                                                                         <li class="">
										<a nowrap href="#pre_manobra" onclick="pre_manobra();">
											<i class="menu-icon fa fa-eye pink"></i>
											Gastos mano de obras y maquina
										</a> 
										<b class="arrow"></b>
									</li>
                                                                        
                                                                        <li class="">
										<a nowrap href="#pre_otrogasto" onclick="pre_otrogasto();">
											<i class="menu-icon fa fa-eye pink"></i>
											Otros gastos
										</a>

										<b class="arrow"></b>
									</li>
                                                                        
                                                                        <li class="">
										<a nowrap href="#pre_prearea" onclick="pre_prearea();">
											<i class="menu-icon fa fa-eye pink"></i>
											Precios por area
										</a>
										<b class="arrow"></b>
									</li>
                                                                        
                                                                          <li class="">
										<a nowrap href="#pre_confialum" onclick="pre_confialum();">
											<i class="menu-icon fa fa-eye pink"></i>
											Configurar aluminio
										</a>
										<b class="arrow"></b>
									</li>
                                                                        
                                                                         <li class="">
										<a nowrap href="#pre_confivid" onclick="pre_confivid();">
											<i class="menu-icon fa fa-eye pink"></i>
											Configurar vidrio
										</a>
										<b class="arrow"></b>
									</li>
                                                                        
                                                                        <li class="">
										<a nowrap href="#pre_listmate" onclick="pre_listmate();">
											<i class="menu-icon fa fa-eye pink"></i>
											Lista de materiales
										</a>
										<b class="arrow"></b>
									</li>
                                                                     
                                                                        
                                                                           <li class="">
										<a nowrap href="#pre_listservi" onclick="pre_listservi();">
											<i class="menu-icon fa fa-eye pink"></i>
											Lista de Servicio
										</a>
										<b class="arrow"></b>
									</li>
                                                                        
                                                                         
                                                                           <li class="">
										<a nowrap href="#pre_mantedolar" onclick="pre_mantedolar();">
											<i class="menu-icon fa fa-eye pink"></i>
											Mantenimiento del dolar
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Planeacion </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="active">
								<a nowrap href="#pro_grupo" onclick="pro_grupo();">
									<i class="menu-icon fa fa-caret-right"></i>
									Grupos de trabajo
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a nowrap href="#pro_confipag" onclick="pro_confipag();">
									<i class="menu-icon fa fa-caret-right"></i>
									Conf de pagos
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
                                        <li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-shopping-cart"></i>
							<span class="menu-text">
								Compras
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Solicitudes
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
                                                                            <a href="#nueva_solicitud" onclick="comp_solicitudes();">
											<i class="menu-icon fa fa-plus purple"></i>
											Crear Solicitud
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
                                                                            <a href="#list_solicitud" onclick="comp_list_solicitudes();">
											<i class="menu-icon fa fa-list purple"></i>
											Lista Solicitudes
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Ordenes
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
                                                                            <a href="#list_ordenes" onclick="comp_list_ordenes();">
											<i class="menu-icon fa fa-list purple"></i>
											Lista ordenes
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
						</ul>
					</li>

                                        	<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o"></i>

							<span class="menu-text">
								Inventario
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Configuracion
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										  <a href="#Referencia" onclick="inv_referencia();">
											<i class="menu-icon fa fa-caret-right"></i>
											Referencias
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Lineas" onclick="inv_lineas();">
											<i class="menu-icon fa fa-caret-right"></i>
											Linea
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Clases" onclick="inv_clases();">
											<i class="menu-icon fa fa-caret-right"></i>
											Clases
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Grupos" onclick="inv_grupos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Grupo
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Medidas" onclick="inv_medidas();">
											<i class="menu-icon fa fa-caret-right"></i>
											Medida
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Colores" onclick="inv_colores();">
											<i class="menu-icon fa fa-caret-right"></i>
											Color
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Unidades" onclick="inv_unidad();">
											<i class="menu-icon fa fa-caret-right"></i>
											Unidades
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Espesores" onclick="inv_espesores();">
											<i class="menu-icon fa fa-caret-right"></i>
											Espesores
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Almacenes" onclick="inv_bodegas();">
											<i class="menu-icon fa fa-caret-right"></i>
											Almacenes
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Ubicaciones" onclick="inv_ubicaciones();">
											<i class="menu-icon fa fa-caret-right"></i>
											Ubicaciones
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										  <a href="#inv_bodegas" onclick="inv_bodegas();">
											<i class="menu-icon fa fa-caret-right"></i>
											Bodegas
										</a>

										<b class="arrow"></b>
									</li>
                                                                         <li class="">
										  <a href="#inv_tmovimientos" onclick="inv_tmovimientos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Tipo de movimiento
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Movimientos
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										  <a href="#Traslados" onclick="inv_reserva_material();">
											<i class="menu-icon fa fa-caret-right"></i>
											Reservas de Material
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#reservas" onclick="inv_list_reserva();">
											<i class="menu-icon fa fa-caret-right"></i>
											Lista Reservas
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Traslados" onclick="inv_ajuste_stock();">
											<i class="menu-icon fa fa-caret-right"></i>
											Ajuste Inventario
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#Traslados" onclick="inv_list_mov_traslado();">
											<i class="menu-icon fa fa-caret-right"></i>
											Traslados en Transito
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#OrdenCompra" onclick="inv_orden_compra();">
											<i class="menu-icon fa fa-caret-right"></i>
											Ent. Orden Compra
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#MovEntrada" onclick="inv_orden_compra();">
											<i class="menu-icon fa fa-caret-right"></i>
											Mov. de Entradas
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#MovEntrada" onclick="inv_mov_entrada();">
											<i class="menu-icon fa fa-caret-right"></i>
											Mov. de Salida
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#ListMovEntrada" onclick="inv_list_mov_entrada();">
											<i class="menu-icon fa fa-caret-right"></i>
											Lista Mov. de Inv
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Informes
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										  <a href="#" onclick="kardex_pro();">
											<i class="menu-icon fa fa-caret-right"></i>
											Kardex
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#" onclick="kardex_gene();">
											<i class="menu-icon fa fa-caret-right"></i>
											Kardex General
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#" onclick="informe_tm();">
											<i class="menu-icon fa fa-caret-right"></i>
											Informe Movimientos
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#" onclick="informe_in_out();">
											<i class="menu-icon fa fa-caret-right"></i>
											Informe Ent-Sal
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#" onclick="informe_planilla();">
											<i class="menu-icon fa fa-caret-right"></i>
											Planilla Fisico Inv
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>

							<li class="">
								<a href="#amortiguadores" onclick="inv_amortiguadores();">
									<i class="menu-icon fa fa-caret-right"></i>
									Amortiguadores
								</a>							
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Produccion </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                                                    <li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Reportes y Gestion
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#Referencia" onclick="pro_puestos();">
											<i class="menu-icon fa fa-caret-right"></i>
											En Construccion
										</a>

										<b class="arrow"></b>
									</li>
									
									
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Configuracion
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#Referencia" onclick="pro_puestos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Puestos de Trabajo
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#Referencia" onclick="pro_rutas();">
											<i class="menu-icon fa fa-caret-right"></i>
											Hoja de Rutas
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
								<a nowrap href="#pro_grupo" onclick="pro_grupo();">
									<i class="menu-icon fa fa-caret-right"></i>
									Grupos de trabajo
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a nowrap href="#pro_confipag" onclick="pro_confipag();">
									<i class="menu-icon fa fa-caret-right"></i>
									Conf de pagos
								</a>

								<b class="arrow"></b>
							</li>
									
									
								</ul>
							</li>
						</ul>
					</li>

				

					<li class="">
						<a href="calendar.html">
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
								Despacho

								<span class="badge badge-transparent tooltip-error" title="2 Important Events">
									<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
								</span>
							</span>
						</a>

						<b class="arrow"></b>
					</li>

					

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tag"></i>
							<span class="menu-text">Facturacion </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="profile.html">
									<i class="menu-icon fa fa-caret-right"></i>
									En Construccion
								</a>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
                                        	<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Cartera </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                                                   
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Embudo de Cartera
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#Referencia" onclick="car_terceros();">
											<i class="menu-icon fa fa-caret-right"></i>
											Terceros
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#Referencia" onclick="car_contactos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Contactos
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
								<a nowrap href="#car_contratos" onclick="car_contratos();">
									<i class="menu-icon fa fa-caret-right"></i>
									Contratos
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a nowrap href="#car_llamadas" onclick="car_llamadas();">
									<i class="menu-icon fa fa-caret-right"></i>
									Gestion de Llamadas
								</a>

								<b class="arrow"></b>
							</li>
									
									
								</ul>
							</li>
						</ul>
					</li>
                                        <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cogs"></i>
							<span class="menu-text">Conf. Contabilidad </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                                                    <li class="">
                                                            <a href="#" onclick="cont_jerarquias()">
									<i class="menu-icon fa fa-caret-right"></i>
									Jerarquias
								</a>

								<b class="arrow"></b>
							</li>
                                                    <li class="">
                                                            <a href="#" onclick="cont_clasescc()">
									<i class="menu-icon fa fa-caret-right"></i>
									Clases
								</a>

								<b class="arrow"></b>
							</li>
                                                    <li class="">
                                                            <a href="#" onclick="cont_areascc()">
									<i class="menu-icon fa fa-caret-right"></i>
									Areas
								</a>

								<b class="arrow"></b>
							</li>
                                                       <li class="">
                                                            <a href="#" onclick="cont_centroproduccion()">
									<i class="menu-icon fa fa-caret-right"></i>
									Centro de produccion
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
                                                            <a href="#" onclick="cont_centrocostos()">
									<i class="menu-icon fa fa-caret-right"></i>
									Centro de Costos
								</a>

								<b class="arrow"></b>
							</li>
                                                        <li class="">
                                                            <a href="#" onclick="cont_claseactividad()">
									<i class="menu-icon fa fa-caret-right"></i>
									Clase de Actividades
								</a>

								<b class="arrow"></b>
							</li>
                                                        <li class="">
                                                            <a href="#" onclick="cont_terceros()">
									<i class="menu-icon fa fa-caret-right"></i>
									Terceros
								</a>

								<b class="arrow"></b>
							</li>
                                                                             <li class="">
                                                            <a href="#" onclick="cont_empleados()">
									<i class="menu-icon fa fa-caret-right"></i>
									Empleados
							    </a>
							    <b class="arrow"></b>
							</li>
                                                        
							                      <li class="">
                                                            <a href="#cont_cargos" onclick="cont_cargos()">
									<i class="menu-icon fa fa-caret-right"></i>
									Cargos
							    </a>
							    <b class="arrow"></b>
							</li>
                                                        
							  <li class="">
                                                            <a href="#cont_areatrab" onclick="cont_areatrab()">
									<i class="menu-icon fa fa-caret-right"></i>
									Areas de trabajo
							    </a>
							    <b class="arrow"></b>
							</li>
                                                          <li class="">
                                                            <a href="#cont_contables" onclick="cont_contables()">
									<i class="menu-icon fa fa-caret-right"></i>
									Codigos contables
							    </a>
							    <b class="arrow"></b>
							</li>
						</ul>
					</li>
				                    <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon glyphicon glyphicon-usd"></i>
							<span class="menu-text"> Ventas </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                                                   
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Embudo de Ventas
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#ven_propescto" onclick="ven_propescto();">
											<i class="menu-icon fa fa-caret-right"></i>
											Prospectos
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#Referencia" onclick="car_contactos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Seguimientos
										</a>

										<b class="arrow"></b>
									</li>
                                                           
								</ul>
                                                                    
							</li>
						</ul>
                                                	<b class="arrow"></b>

						<ul class="submenu">
                                                   
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Actividades
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#Referencia" onclick="car_terceros();">
											<i class="menu-icon fa fa-caret-right"></i>
											Nueva llamada
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#Referencia" onclick="car_contactos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Nueva Reunion
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#Referencia" onclick="car_contactos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Nueva Tarea
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#Referencia" onclick="car_contactos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Nueva Nota
										</a>

										<b class="arrow"></b>
									</li>
                                                                       
								</ul>
                                                                    
							</li>
						</ul>
                                                        
                                                        
                                                        
                                                        
                                                        <b class="arrow"></b>

						<ul class="submenu">
                                                   
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Contactos
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#ven_propescto" onclick="ven_propescto();">
											<i class="menu-icon fa fa-caret-right"></i>
											Prospectos
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#Referencia" onclick="car_contactos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Seguimientos
										</a>

										<b class="arrow"></b>
									</li>
                                                           
								</ul>
                                                                    
							</li>
						</ul>
                                                         <b class="arrow"></b>
                                                     <ul class="submenu">
                                                   
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Usuarios
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#Referencia" onclick="car_terceros();">
											<i class="menu-icon fa fa-caret-right"></i>
											Prospectos
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#Referencia" onclick="car_contactos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Seguimientos
										</a>

										<b class="arrow"></b>
									</li>
                                                           
								</ul>
                                                                    
							</li>
						</ul>   
                                                       
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Inicio</a>
							</li>

							<li>
								<a href="#">Aluvmix</a>
							</li>
							<li class="active">V 3.0</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Cambiar Tema</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Encabezado Estatic.</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Menu Estatico</label>
									</div>

									
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu activado</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Menu Sidebar</label>
									</div>
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Contraer
											<b>.Pagina</b>
										</label>
									</div>
									
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1  id="encabezado">
								Pagina Principal
								
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12" id="controlador">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<div id="mostrar_contenido">
                                                                                     <center>
                                                                                         <h3>Bienvenidos a</h3>
                                                                                          <img src="../imagenes/aluvmix.png">
                                                                                     </center>
                                                                    </div> 
									</div><!-- /.span -->
								</div><!-- /.row -->

								<div class="hr hr-18 dotted hr-double"></div>

								<h4 class="pink">
									<i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
									<a href="#modal-table" role="button" class="green" data-toggle="modal"> Version del Sistema 3.0 </a>
								</h4>
								<div class="hr hr-18 dotted hr-double"></div>

								

								

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
		Copyright (R) 2018 | <span class="blue bolder">Templado S.A</span> | Usuario: 
                <input type="text" id="user_general" value="<?php echo $_SESSION['k_username'] ?>" style="height: 18px; width: 80px" disabled>
            | Fecha <input type="text"  id="fecha_general" value="<?php echo date("Y-m-d"); ?>" disabled  style="height: 18px; width: 100px">
            | Empresa <input type="text"  id="gen_empresa" value="<?php echo $_SESSION['empresa']; ?>" disabled  style="height: 18px; width: 100px">
                <span id="hora"></span>
		</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		<input id="gritter-light" checked="" type="checkbox" class="ace ace-switch ace-switch-5" />
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/bootbox.js"></script>
		<script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/jquery.gritter.min.js"></script>
		<script src="assets/js/spin.js"></script>
		<script>
		function moventrada(){
					$.gritter.add({
						title: 'Aluvmix',
						text: 'Se registro movimiento de inventario con Exito.',
						image: 'assets/images/avatars/user.jpg', 
						sticky: false,
						time: '',
						class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
					});
					return false;
					}
		</script>
		<!-- KARDEX POR PRODUCTOS -->
    <div class="modal fade" id="kardex_modal" tabindex="-1" role="dialog" aria-labelledby="kardex_modal">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="kardex_modal"><i class='glyphicon glyphicon-download'></i> Descarga de Kardex</h4>
            </div>
            <div class="modal-body" style="margin-bottom: 6%;">
           <br>
            <div>
              	<label><b>Codigo de Producto: </b></label><input type="text" name="cod_pro" id="cod_pro">
              </div><br>
             <div>
              	<img src="images/excel.png"> <b>Descargar Documento Excel</b><br><br><br><a href="#download-PDF-Kardex" onclick="kardex_pdf();"><img src="images/pdf.png"><b>Descargar Documento en Pdf </b></a>
              </div><br>
             
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
      </div>
  </div>

  	<!-- Kardex Genreal de elementos del Inventario -->
   <div class="modal fade" id="kardex_general" tabindex="-1" role="dialog" aria-labelledby="kardex_general">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="kardex_general"><i class='glyphicon glyphicon-download'></i> Descarga de Kardex</h4>
            </div>
            <div class="modal-body" style="margin-bottom: 6%;">
           <br>
              	<img src="images/excel.png"> <b>Descargar Documento Excel</b><br><br><br><a href="#download-PDF-Kardex" onclick="kardex_g_pdf();"><img src="images/pdf.png"><b>Descargar Documento en Pdf </b></a>
              </div><br>
             
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
      </div>
  </div>
	</body>
</html>
