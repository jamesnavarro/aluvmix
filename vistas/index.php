<?php 
include '../modelo/conexioni.php';
include('../modelo/roles_user.php');
session_start();
if(!isset($_SESSION['k_username'])){
     header("location:../../../principal/index.php");    
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Monty 2.0</title>
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
                <script src="../controlador/control.js?v=1.5"></script>
		<script src="../controlador/inventario.js?v=3.5"></script>
               <script src="../controlador/compras.js?<?php echo rand(1,100) ?>"></script> 
                <script src="../controlador/configuraciones.js?<?php echo rand(1,100) ?>"></script>
                <script src="../controlador/contabilidad.js?<?php echo rand(1,100) ?>"></script>
                <script src="../controlador/produccion.js?v=<?php echo rand(1,100) ?>"></script>
                <script src="../controlador/cartera.js?<?php echo rand(100,200) ?>"></script>
                <script src="../controlador/popup.js?<?php echo rand(1,100) ?>"></script>
                <script src="../controlador/ventas.js?<?php echo rand(1,100) ?>"></script>
                <script src="../controlador/planeacion.js?v=<?php echo rand(1,100) ?>"></script>
                <script src="../controlador/despacho.js?v=<?php echo rand(1,100) ?>"></script>
                <script>
                        function pass()
                         {
                          window.open('../vistas/form_contrasena.php', 'contacto', 'width=400,height=250');
                          } 
                         </script>
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
							Monty V.2.0
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
<!--						<li class="grey dropdown-modal">
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
						</li>-->

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
								<?php  if($acces_user[11]=='1'){  ?>
                                                                 <li>
									<a href="#conf_modulos" onclick="conf_modulos();">
										<i class="ace-icon fa fa-cog"></i>
										Modulos
									</a>
								</li>
                                                                <?php } ?>
								<li>
									
                                                                          <a href="lenguage:javascript()" onclick="pass();">
                                                                              <i class="ace-icon fa fa-user"></i>
                                                                              Cambiar Contraseña
                                                                          
                                                                          </a>
									
								</li>
                                                                <?php  if($acces_user[11]=='1'){  ?>
                                                            	<li class="">
                                                                            <a href="#nuevo_usuario" onclick="nuevo_usuario();">
											<i class="ace-icon fa fa-user-plus"></i>
											Usuario
										</a>

								</li>
                                                                <?php } ?>
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
                                        <?php  
//                                        if($acces_user[1]=='1*'){
                                        if($_SESSION['k_username']=='admin'){
                                            ?>
                                            <li>
                                                    <a href="#" class="dropdown-toggle">
                                                            <i class="menu-icon fa fa-desktop"></i>
                                                            <span class="menu-text">
                                                                <B>PRESUPUESTOS</B>
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
                                                                        <?php  if($acces_user[12]=='1'){  ?>
                                                                            <li class="">
                                                                                <a href="#nueva_cotizacion" onclick="nueva_cotizacion();">
                                                                                            <i class="menu-icon fa fa-plus purple"></i>
                                                                                            Cotizar Producto
                                                                                    </a>

                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                        <?php } ?>
                                                                             <?php  if($acces_user[13]=='1'){  ?>
                                                                            <li class="">
                                                                                    <a href="#cotizae_prod" onclick="pre_cotizaciones();">
                                                                                            <i class="menu-icon fa fa-list-alt"></i>
                                                                                            Cotizaciones
                                                                                    </a>

                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                             <?php } ?>

                                                                    </ul>
                                                            </li>
                                                               <?php  if($acces_user[17]=='1'){  ?>
                                                            <li class="">
                                                                    <a href="#" class="dropdown-toggle">
                                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                                            Productos
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
                                                                                            <i class="menu-icon fa fa-list green"></i>
                                                                                            Prod. Activos
                                                                                    </a>

                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                            <li class="">
                                                                                    <a href="#" onclick="pre_lista_sin()">
                                                                                            <i class="menu-icon fa fa-list purple" ></i>
                                                                                            Prod. Sin Aprobar
                                                                                    </a>

                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                            <li class="">
                                                                                    <a href="#" onclick="pre_lista_anulado()">
                                                                                            <i class="menu-icon fa fa-list red"></i>
                                                                                            Prod. Anulados
                                                                                    </a>

                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                    </ul>
                                                            </li>
                                                             <?php } ?>
                                                            <?php  if($acces_user[17]=='1'){  ?>
                                                            <li class="">
                                                                    <a href="#" class="dropdown-toggle">
                                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                                            Conf. Productos
                                                                            <b class="arrow fa fa-angle-down"></b>
                                                                    </a>

                                                                    <b class="arrow"></b>

                                                                    <ul class="submenu">
                                                                              <li class="">
                                                                                    <a href="#crear_refe" onclick="crear_refe(0);"> 
                                                                                            <i class="menu-icon fa fa-plus purple"></i>
                                                                                            Referencias
                                                                                    </a>

                                                                                    <b class="arrow"></b>
                                                                            </li>   


                                                                         <li class="">
                                                                                    <a href="#crear_sistm" onclick="crear_sistm(0);"> 
                                                                                            <i class="menu-icon fa fa-plus purple"></i>
                                                                                            Sistemas
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
                                                                                    <a nowrap href="#pre_coloralum" onclick="pre_coloralum();">
                                                                                            <i class="menu-icon fa fa-eye pink"></i>
                                                                                            Color aluminio
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                              <li class="">
                                                                                    <a nowrap href="#pre_acce" onclick="pre_acce();">
                                                                                            <i class="menu-icon fa fa-eye pink"></i>
                                                                                            Color accesorios
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                            <li class="">
                                                                                    <a nowrap href="#tipo_vi" onclick="tipo_vi();">
                                                                                            <i class="menu-icon fa fa-eye pink"></i>
                                                                                            Tipo vidrio
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                            <li class="">
                                                                                    <a nowrap href="#pre_inst" onclick="pre_inst();">
                                                                                            <i class="menu-icon fa fa-list pink"></i>
                                                                                            Precio instalacion
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                            <li class="">
                                                                                    <a nowrap href="#pre_inst" onclick="pre_grupos_ref();">
                                                                                            <i class="menu-icon fa fa-industry"></i>
                                                                                            Alfajias | Rejillas
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>
                                                                            <li class="">
                                                                                    <a nowrap href="#pre_inst" onclick="pre_grupos_kit();">
                                                                                            <i class="menu-icon fa fa-file-text"></i>
                                                                                            Configuración Kits
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>   
                                                                             <li class="">
                                                                                    <a nowrap href="#pre_cristal" onclick="pre_cristal();">
                                                                                            <i class="menu-icon fa fa-file-text"></i>
                                                                                            Cristales
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li> 


                                                                    </ul>
                                                            </li>
                                                            <?php } ?>
                                                             <?php  if($acces_user[17]=='1'){  ?>
                                                            <li class="">
                                                                    <a href="#" class="dropdown-toggle">
                                                                            <i class="menu-icon fa fa-cogs-right"></i>
                                                                            Otros. Parametros 
                                                                            <b class="arrow fa fa-angle-down"></b>
                                                                    </a>
                                                                    <b class="arrow"></b>

                                                                    <ul class="submenu">


                                                                            <li class="">
                                                                                    <a nowrap href="#pre_listmate" onclick="pre_update_productos();">
                                                                                            <i class="menu-icon fa fa-eye pink"></i>
                                                                                            Sincronizar
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

    <!--                                                                          <li class="">
                                                                                    <a nowrap href="#pre_confialum" onclick="pre_confialum();">
                                                                                            <i class="menu-icon fa fa-eye pink"></i>
                                                                                            Configurar aluminio
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>-->

                                                                             <li class="">
                                                                                    <a nowrap href="#pre_confivid" onclick="pre_confivid();">
                                                                                            <i class="menu-icon fa fa-eye pink"></i>
                                                                                            Configurar vidrio
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>

    <!--                                                                           <li class="">
                                                                                    <a nowrap href="#pre_listservi" onclick="pre_conefom();">
                                                                                            <i class="menu-icon fa fa-eye pink"></i>
                                                                                            Conexion a fomplus
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>-->


                                                                               <li class="">
                                                                                    <a nowrap href="#pre_mantedolar" onclick="pre_mantedolar();">
                                                                                            <i class="menu-icon fa fa-eye pink"></i>
                                                                                            Mantenimiento del dolar
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                            </li>

                                                                    </ul>
                                                            </li>
                                                              <?php } ?>
                                                    </ul>
                                            </li>
                                        <?php } ?>
                                        <?php  
                                        //if($_SESSION['k_username']=='admin'){
                                        if($acces_user[2]=='1'){
                                            ?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
                                                        <span class="menu-text"> <b>PLANEACION</b></span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                                                     <?php  if($acces_user[19]=='1'){  ?>
                                                            <li class="">
								<a nowrap href="#pla_apro" onclick="pla_apro();">
									<i class="menu-icon fa fa-caret-right"></i>
									Pend. por aprobar
								</a>
								<b class="arrow"></b>
							     </li>
                                                              <li class="">
								<a nowrap  href="#pla_aprofom" onclick="pla_aprofom();">
									<i class="menu-icon fa fa-caret-right"></i>
									Pedidos FOMPLUS
								</a>
								<b class="arrow"></b>
							     </li>
                                                              <li class="">
                                                                <a nowrap  href="#manteped" onclick="manteped();">
                                                                <i class="menu-icon fa fa-caret-right"></i>
                                                                <b>Mantenimiento de pedidos</b>
                                                                </a>
                                                                <b class="arrow"></b>
                                                                </li>
                                                                 <li class="">
								<a  href="#pla_ord" onclick="pla_ordenes();">
									<i class="menu-icon fa fa-caret-right"></i>
									Ordenes de produccion
								</a>
								<b class="arrow"></b>
							     </li>
                                                             <li class="">
								<a  href="#pla_ord" onclick="pla_ordenes_rep();">
									<i class="menu-icon fa fa-caret-right"></i>
									Ordenes de Reposicion
								</a>
								<b class="arrow"></b>
							     </li>
                                                                 <li class="">
                                                            <a href="#terce_pla" onclick="terce_pla();">
								<i class="menu-icon fa fa-plus purple"></i>
                                                                Terceros
							    </a>
							    <b class="arrow"></b>
							</li>
                                                           </ul>
     
                                                         
                                           <?php } ?>
					</li>
                                        <?php } ?>
                                        
                                         <?php  if($acces_user[3]=='1'){  ?>
                                        <li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-shopping-cart"></i>
							<span class="menu-text">
                                                            <b>COMPRAS</b>
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                                                    <?php  if($acces_user[78]=='1'){  ?>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Solicitudes
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>

								<ul class="submenu">
                                                                    
									<li class="">
                                                                            <a href="#nueva_solicitud" onclick="comp_solicitudesxy();">
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
                                                                        <li class="">
                                                                            <a href="#time_gest" onclick="time_gest();">
											<i class="menu-icon fa fa-list purple"></i>
											Gestion de tiempo
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
                              
							</li>
                                                         <?php } ?>
                                                         <?php  if($acces_user[25]=='1'){  ?>
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
                                                                        <?php  if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='YTURIZO' || $_SESSION['k_username']=='CAJA' || $_SESSION['k_username']=='MGUTIERREZ'){  ?>
                                                                        <li class="">
										<a href="#Referencia" onclick="car_terceroepro();">
											<i class="menu-icon fa fa-caret-right"></i>
											Proveedores
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <?php } ?>
                                                                         <?php  if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='YTURIZO' || $_SESSION['k_username']=='CAJA' || $_SESSION['k_username']=='MGUTIERREZ'){  ?>
                                                                        <li class="">
										<a href="#Referencia" onclick="car_terceroeprofom();">
											<i class="menu-icon fa fa-caret-right"></i>
											Proveedores Fom
										</a>

										<b class="arrow"></b>
									</li>
                              
                                                                        <li class="">
										<a href="#TipoCuentas" onclick="com_cuentas();">
											<i class="menu-icon fa fa-caret-right"></i>
											Tipo de Cuentas
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <li class="">
										<a href="#TipoCuentas" onclick="car_clientesfom();">
											<i class="menu-icon fa fa-caret-right"></i>
											Clientes Fom
										</a>

										<b class="arrow"></b>
									</li>
                                                                        <?php } ?>
								</ul>
							</li>
                                                        <?php  if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='YTURIZO' || $_SESSION['k_username']=='CAJA' || $_SESSION['k_username']=='MGUTIERREZ'){  ?>
                                                        <li class="">
                                                            <a href="#nueva_solicitud" onclick="ReporteProveedores();">
								<i class="menu-icon fa fa-plus purple"></i>
                                                                Reporte proveedor
							    </a>
							    <b class="arrow"></b>
							</li>
                                                        <li class="">
                                                            <a href="#nueva_solicitud" onclick="Reporte9999();">
								<i class="menu-icon fa fa-plus purple"></i>
                                                                Reporte <b>9999</b>
							    </a>
							    <b class="arrow"></b>
							</li>
                                                     
                                                         <?php }} ?>
						</ul>
					</li>
                                        <?php } ?>
                                         <?php  if($acces_user[4]=='1'){  ?>
                                        	<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o"></i>

                                                <span class="menu-text">
                                                  <b>INVENTARIO</b>
                                                </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                                                    <?php  if($acces_user[60]=='1'){  ?>
                                                    <li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Movimientos
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										  <a href="#MovEntrada" onclick="inv_orden_compra('ENTRADA');">
											<i class="menu-icon fa fa-caret-right"></i>
											Mov. de Entradas
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#MovEntrada" onclick="inv_orden_compra('SALIDA');">
											<i class="menu-icon fa fa-caret-right"></i>
											Mov. de Salida
										</a>
										<b class="arrow"></b>
									</li>
                                                                        
                                                                        <li class="">
										  <a href="#Traslados" onclick="inv_traslado('SALIDA');">
											<i class="menu-icon fa fa-caret-right"></i>
											Mov. Traslados
										</a>

										<b class="arrow"></b>
									</li>
                                                                          <?php } ?>
<!--                                                                        <li class="">
										  <a href="#MovEntrada" onclick="inv_mov_entrada();">
											<i class="menu-icon fa fa-caret-right"></i>
											Mov. de Salida old
										</a>
										<b class="arrow"></b>
									</li>-->
                                                              <?php  if($acces_user[61]=='1'){  ?>
									<li class="">
										  <a href="#ListMovEntrada" onclick="inv_list_mov_entrada(0);">
											<i class="menu-icon fa fa-caret-right"></i>
											Lista Movimientos
										</a>
										<b class="arrow"></b>
									</li>
                                                                         <?php } ?>
                                                                         <?php  if($acces_user[60]=='1'){  ?>
                                                                             	<li class="">
										  <a href="#inv_list_tras" onclick="inv_list_mov_entrada(1);">
											<i class="menu-icon fa fa-caret-right"></i>
											Recibir Traslado
										</a>
										<b class="arrow"></b>
									</li>
                                                                         <?php } ?>
<!--									<li class="">
										  <a href="#Traslados" onclick="inv_reserva_material();">
											<i class="menu-icon fa fa-caret-right"></i>
											Reservas de Material
										</a>

										<b class="arrow"></b>
									</li>-->
<!--									<li class="">
										  <a href="#reservas" onclick="inv_list_reserva();">
											<i class="menu-icon fa fa-caret-right"></i>
											Lista Reservas
										</a>

										<b class="arrow"></b>
									</li>-->
<!--									<li class="">
										  <a href="#Traslados" onclick="inv_ajuste_stock();">
											<i class="menu-icon fa fa-caret-right"></i>
											Ajuste Inventario
										</a>

										<b class="arrow"></b>
									</li>-->
									
                                                                   <?php  if($acces_user[60]=='1'){  ?>

                                                                        <li class="">
										  <a href="#Ajuste Inventario" onclick="inv_cap_inv(0);">
											<i class="menu-icon fa fa-caret-right"></i>
											Captura inventario F
										</a>

										<b class="arrow"></b>
									</li>
                                                                         <?php } ?>
                                                                         <?php  if($acces_user[61]=='1'){  ?>
                                                                        <li class="">
										  <a href="#Traslados" onclick="inv_lis_cap();">
											<i class="menu-icon fa fa-caret-right"></i>
											Lista de captura
										</a>

										<b class="arrow"></b>
									</li>
                                                                         <?php } ?>
									
								</ul>
							</li>
						<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Movimientos de FOM
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									 
          
                                                              <?php  if($acces_user[61]=='1'){  ?>
									<li class="">
										  <a href="#ListMovEntrada" onclick="lista_fomplus(1);"> 
											<i class="menu-icon fa fa-caret-right"></i>
											Lista Movimientos f
										</a>
										<b class="arrow"></b>
									</li>
                                                                         <?php } ?>

									
								</ul>
							</li>
                                                        
                                                        
                                                        
                                                        
                                                         
							  <?php  if($acces_user[61]=='1'){  ?>
                                                        <li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Desgloses
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
                                                                    
                                                                    <li class="">
										<a href="#inv_kardex" onclick="desglose1();">
											<i class="menu-icon fa fa-caret-right"></i>
											 Desgloses Pendientes
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										  <a href="#" onclick="desglose2();">
											<i class="menu-icon fa fa-caret-right"></i>
											Referencias sin Guardar
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
										  <a href="#" onclick="reporte_inv();">
											<i class="menu-icon fa fa-caret-right"></i>
											 Kardex
										</a>
										<b class="arrow"></b>
									</li>
<!--                                                                    <li class="">
										<a href="#inv_kardex" onclick="inv_kardex();">
											<i class="menu-icon fa fa-caret-right"></i>
											 KARDEX
										</a>
										<b class="arrow"></b>
									</li>-->
<!--									<li class="">
										  <a href="#" onclick="kardex_pro();">
											<i class="menu-icon fa fa-caret-right"></i>
											 Reporte de Inventario
										</a>
										<b class="arrow"></b>
									</li>-->
<!--									<li class="">
										  <a href="#" onclick="kardex_gene();">
											<i class="menu-icon fa fa-caret-right"></i>
											Kardex General
										</a>
										<b class="arrow"></b>
									</li>-->
<!--									<li class="">
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
									</li>-->
									<li class="">
										  <a href="#" onclick="informe_planilla();">
											<i class="menu-icon fa fa-caret-right"></i>
											Planilla Fisico Inv
										</a>
										<b class="arrow"></b>
									</li>
                                                                                                                                                                                        <li class="">
										  <a href="#" onclick="edit_ubic();">
											<i class="menu-icon fa fa-caret-right"></i>
											Traslado entre ubicaciones
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>
                                                      <?php } ?>
                                                        <li class="">
								<a href="#" onclick="inv_stock();">
									<i class="menu-icon fa fa-caret-right"></i>
									Consulta de stock
								</a>							
							</li>
							<li class="">
								<a href="#amortiguadores" onclick="inv_amortiguadores();">
									<i class="menu-icon fa fa-caret-right"></i>
									Amortiguadores
								</a>							
							</li>
                                                        	<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Conf clasificacion
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
                                                                     <li class="">
										  <a href="javascript:void(0)" onclick="inv_referenciaxx();">
                                                                                      
											<i class="menu-icon fa fa-caret-right"></i>
											Referencias
										</a>

										<b class="arrow"></b>
									</li>
                                                                         <li class="">
										<a href="#crear_refe" onclick="materialesx(0);"> 
											<i class="menu-icon fa fa-caret-right"></i>
											Lista de Materiales
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
										  <a href="#Lineas" onclick="inv_lineas();">
											<i class="menu-icon fa fa-caret-right"></i>
											Linea
										</a>

										<b class="arrow"></b>
									</li>
                                                                             	<li class="">
										  <a href="#inv_marcas" onclick="inv_marcas();">
											<i class="menu-icon fa fa-caret-right"></i>
											Marcas
										</a>

										<b class="arrow"></b>
									</li>
                                                                               	<li class="">
										  <a href="#inv_modelo" onclick="inv_modelo();">
											<i class="menu-icon fa fa-caret-right"></i>
											Modelo
										</a>

										<b class="arrow"></b>
									</li>
                                                                        	<li class="">
										  <a href="#inv_medidas" onclick="inv_medidas();">
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
										  <a href="#inv_unidad" onclick="inv_unidad();">
											<i class="menu-icon fa fa-caret-right"></i>
											Unidades
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
										  <a href="#inv_clasif" onclick="inv_clasif();">
											<i class="menu-icon fa fa-caret-right"></i>
											clasificaciones
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
										  <a href="#prefijos" onclick="prefijos_s();">
											<i class="menu-icon fa fa-caret-right"></i>
											Prefijos
										</a>

										<b class="arrow"></b>
									</li>
							 
								
								
									
<!--									<li class="">
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
									</li>-->
<!--                                                                        <li class="">
										  <a href="#inv_bodegas" onclick="inv_bodegas();">
											<i class="menu-icon fa fa-caret-right"></i>
											Bodegas
										</a>

										<b class="arrow"></b>
									</li>-->
                                                                         <li class="">
										  <a href="#inv_tmovimientos" onclick="inv_tmovimientos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Tipo de movimiento
										</a>

										<b class="arrow"></b>
									</li>
                                                                        
								</ul>
							</li>
                                                        
						</ul>
					</li>
                                        <?php } ?>
                                        <?php  
//                                        if($_SESSION['k_username']=='admin'){
                                            if($acces_user[5]=='1'){
                                            ?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
                                                        <span class="menu-text"> <B>PRODUCCION</B> </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
                                                <ul class="submenu">
                                                <li class="">
                                                        <a href="#MovEntrada" onclick="inv_orden_compra('SALIDA');">
                                                              <i class="menu-icon fa fa-caret-right"></i>
                                                              Movimiento de Materia Prima
                                                      </a>
                                                      <b class="arrow"></b>
                                              </li>
                                              
                                             
                                              <li class="">
                                                        <a href="#ListMovEntrada" onclick="inv_list_mov_entrada(0);">
                                                              <i class="menu-icon fa fa-caret-right"></i>
                                                              Lista Movimientos
                                                      </a>
                                                      <b class="arrow"></b>
                                              </li>
                                              
                                                        <li class="">
								 <a href="#pro_burro" onclick="lista_costo();">
								 <i class="menu-icon fa fa-caret-right"></i>
								 Hoja de Costos
								 </a>
								 <b class="arrow"></b>
							 </li>
 
                                                <li class="">
								<a nowrap href="#pro_repgrupo" onclick="pro_repgrupo();">
								<i class="menu-icon fa fa-caret-right"></i>
							              Reporte de trabajo
								</a>
								<b class="arrow"></b>
							</li>
                                                       
                                                <li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-cogs-right"></i>
									Configuracion
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#Referencia" onclick="pro_puestos_master();">
											<i class="menu-icon fa fa-caret-right"></i>
											Puestos de Trabajo
										</a>

										<b class="arrow"></b>
									</li>
                                                                        			<li class="">
										<a href="#infor_puesto" onclick="infor_puesto();">
											<i class="menu-icon fa fa-caret-right"></i>
											Inf puestos
										</a>

										<b class="arrow"></b>
									</li>
                                                                       <li class="">
										<a href="#Referencia" onclick="pro_puestos();">
											<i class="menu-icon fa fa-caret-right"></i>
											Procesos de Trabajo
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
								 <a href="#pro_burro" onclick="pro_burro();">
								 <i class="menu-icon fa fa-caret-right"></i>
								 Burros
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
								<a href="#pro_cuentaco" onclick="pro_cuentaco();">
									<i nowrap class="menu-icon fa fa-caret-right"></i>
									Cuenta cobro x servicios
								</a>

								<b class="arrow"></b>
							</li>
								    <li class="">
								<a href="#pro_servi" onclick="pro_servi();">
									<i nowrap class="menu-icon fa fa-caret-right"></i>
									Servicios
								</a>

								<b class="arrow"></b>
							</li>	
                                                        
                                                        
                                                        	    <li class="">
								<a href="#pro_publicos" onclick="pro_publicos();">
									<i nowrap class="menu-icon fa fa-caret-right"></i>
									Serv. Publicos
								</a>

								<b class="arrow"></b>
							</li>	
                                                        
                                                        
                                                        
									
								</ul>
							</li>

						
                                                </ul>
                                              
                                                   
							
                                                        	
						
					</li>

				<?php } ?>
                                        <?php  if($acces_user[6]=='1*'){  ?>

					<li class="">
						<a href="calendar.html">
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
                                                            <B>DESPACHO</B>

								<span class="badge badge-transparent tooltip-error" title="2 Important Events">
									<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
								</span>
							</span>
						</a>

						<b class="arrow"></b>
					</li>

					<?php } ?>
                                        <?php  if($acces_user[7]=='1*'){  ?>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tag"></i>
                                                        <span class="menu-text"><B>FACTURACION</B> </span>

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
                                        <?php } ?>
                                        <?php  if($acces_user[8]=='1*'){  ?>
                                        	<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
                                                        <span class="menu-text"> <B>CARTERA</B> </span>

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
                                        <?php } ?>
                                        <?php  if($acces_user[9]=='1*'){  ?>
                                        <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cogs"></i>
                                                        <span class="menu-text"><B>CONTABILIDAD</B> </span>

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
                                                          <li class="">
                                                            <a href="#cont_parafiscales" onclick="cont_parafiscales()">
									<i class="menu-icon fa fa-caret-right"></i>
									Parafiscales
							    </a>
							    <b class="arrow"></b>
							</li>
                                                             <li class="">
                                                            <a href="#cont_tcuentas" onclick="cont_tcuentas()">
									<i class="menu-icon fa fa-caret-right"></i>
									Tipo de cuentas
							    </a>
							    <b class="arrow"></b>
							</li>
						</ul>
					</li>
                                        <?php } ?>
                                        <?php  if($acces_user[10]=='1*'){  ?>
				                    <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon glyphicon glyphicon-usd"></i>
                                                        <span class="menu-text"> <B>VENTAS</B> </span>

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
                                        <?php } ?>
                                        <?php  if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='CESAR.F'){  ?>
                                         <li class="">
	<a href="#" class="dropdown-toggle">
			<i class="menu-icon glyphicon glyphicon-usd"></i>
                                                        <span class="menu-text"> <B>REPORTES</B> </span>

			<b class="arrow fa fa-angle-down"></b>
	</a>

	<b class="arrow"></b>

						<ul class="submenu">
                                                   
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Presupuestos
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#ven_propescto" onclick="pre_costosinstalacion();">
											<i class="menu-icon fa fa-caret-right"></i>
											Costos de Instalacion
										</a>

										<b class="arrow"></b>
									</li>
                                                                       
                                                           
								</ul>
                                                                    
							</li>
						</ul>
                                                
                                                	
                                                       
					</li>
                                        <?php } ?>
                                        
                                        
                                        <li class="">
	<a href="#" class="dropdown-toggle">
			<i class="menu-icon glyphicon glyphicon-check"></i>
                                                        <span class="menu-text"> <B>DESPACHO</B> </span>

			<b class="arrow fa fa-angle-down"></b>
	</a>

	<b class="arrow"></b>

		 <ul class="submenu">
                                                    <li class="">
				 <a href="#" class="dropdown-toggle">
				 <i class="menu-icon fa fa-caret-right"></i>
					 Facturacion
					 <b class="arrow fa fa-angle-down"></b>
			                     </a>
					<b class="arrow"></b>
                                                                                                     <ul class="submenu">
						
                                                                                 
                           <li class="">
		<a href="#pedidos_d " onclick="pedidos_d ();">
		<i class="menu-icon fa fa-caret-right"></i>
		Pedidos
		</a>
		<b class="arrow"></b>
	</li>                                
                                                                        
                                                                        
                   <li class="">
		<a href="# " onclick=" ();">
		<i class="menu-icon fa fa-caret-right"></i>
		Reportes
		</a>
		<b class="arrow"></b>
	</li>
                                                        
                   <li class="">
		<a href="# " onclick=" ();">
		<i class="menu-icon fa fa-caret-right"></i>
		Consultas
		</a>
		<b class="arrow"></b>
		</li>
                                                        
                   <li class="">
		<a href="# " onclick=" ();">
		<i class="menu-icon fa fa-caret-right"></i>
		útilidades
		</a>
		<b class="arrow"></b>
	</li>
                                                        
                                                        
                  </ul>
                                                                
                                                                
	
                                                                       
                                                           
	</ul>
                                                                    
		</li>
			</ul>
                                                
                                                	
                                                       
					
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <li class="">
                                        
                                             <ul>
                                                <input type="hidden" id="usuarioy" value="<?php echo $_SESSION['id_user']; ?>">
                                               <div class="sidebar-form" id="chat">
                                                   <B>Usuarios</B>

                                                   <?php
                                     //                                include 'usuarios_online.php';
                                                   ?>

                                               </div>
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
								<a href="../../../principal/vistas/">Inicio</a>
							</li>

							<li>
								<a href="#">Aluvmix</a>
							</li>
							<li class="active">V 3.0</li>
                                                        <li><a href="http://172.16.0.40/laboratorio/aluvmix/vistas/compras/solicitudes/tutorial_solicitud.php?archivo=manual.pdf" target="_blank">Manual de compras</a></li>
                                                       
						</ul><!-- /.breadcrumb -->
                                                                      <ul class="breadcrumb">
<!--                            <li><a href="http://sample.virtualdiseno.com/templado/vistas/?id=stad">ERP V 2.0</a> <span class="divider"></span></li>-->
                            <li><a href="https://anydesk.com/es" target="_blank"><b><font color="red"> Necesitas ayuda?  Descarga  Anydesk y el area de sistemas podra ayudarte CLICK AQUI</font> </b></a> <span class="divider"></span></li>
                            <li class="active"></li>
                        </ul>

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
										<span>&nbsp; 
                                                                                    Cambiar Tema</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Encabezado Estatic.</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar">Menu Estatico</label>
									</div>

									
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover">Submenu activado</label>
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
