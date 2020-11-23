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
		<title>Cotizacion</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
		<script src="../assets/js/ace-extra.min.js"></script>
                <script src="../js/jquery.min.js"></script>
                <script src="../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../js/sweetalert.css">
                <script src="../controlador/control.js"></script>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default navbar-fixed-top         ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header  pull-left">
					<a href="index.php" class="navbar-brand">
					<small><img src="../imagenes/logotem.png" width="15%" style="margin-right: 5%;">Cotizacion</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="../assets/images/avatars/avatar.png" alt="Jason's Photo" />
								<span class="user-info">
									<small>Usuario,</small>
									Admin
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

	<!-- CODE MENU SEND -->
			<div id="sidebar" class="sidebar responsive ace-save-state">
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
						      <li class="">
							   <a href="index.php">
							   <i class="menu-icon fa fa-home"></i>
							   <span class="menu-text">Pagina Principal</span>
							   </a>
						           <b class="arrow"></b>
						       </li>

						        <li class="">
							    <a href="#facturacion" class="dropdown-toggle">
							    <i class="menu-icon fa fa-edit"></i>
							    <span class="menu-text"> Cotizacion</span>
						            <b class="arrow fa fa-sort-desc"></b>
							    </a>
						                <b class="arrow"></b>
							           <ul class="submenu">
						                 <li class="">
							                <a href="#nueva_cotizacion" onclick="nueva_cotizacion();">
							                 <i class="menu-icon fa fa-caret-right"></i>
							                 Nueva cotizacion
							                </a>
						                        </li>
						                  </ul>
						                <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#factura_remisiones" onclick="factura_remisiones();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							               Sala de Ventas
							              </a>
						                        </li>
						                    </ul>
						                
						                 <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#cotizaciones" onclick="cotizaciones();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							               Cotizaciones
							              </a>
						                        </li>
						                    </ul>
						                 
						                   <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#cotizaciones_aprobadas" onclick="cotizaciones_aprobadas();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							               Cotizaciones aprobadas
							              </a>
						                        </li>
						                    </ul>
						                   
						                  <b class="arrow"></b>
							                <ul class="submenu">
							                <li class="">
							                <a href="#report_cot_presu" onclick="report_cot_presu();"> 
							                <i class="menu-icon fa fa-caret-right"></i>
							                Reporte cot presupuesto
							              </a>
						                        </li>
						                    </ul>
						                      
						                    <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#planilla_movi" onclick="planilla_movi();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							              Reporte cot Aserores
							              </a>
						                        </li>
						                    </ul>     
						    <li class="">
							    <a href="#facturacion" class="dropdown-toggle">
							    <i class="menu-icon fa fa-calculator"></i>
							    <span class="menu-text">Presupuesto</span>
						            <b class="arrow fa fa-sort-desc"></b>
							    </a>
						                <b class="arrow"></b>
							           <ul class="submenu">
							                 <li class="">
							                <a href="#lista" onclick="lista();">
							                 <i class="menu-icon fa fa-caret-right"></i>
							                 Listado de productos 1
							                 </a>
						                        </li>
						                   </ul>
						                <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#listad" onclick="listad();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							              Listado de productos 2
							              </a>
						                        </li>
						                    </ul>
						                
						                 <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#lista_sin_aprobar" onclick="lista_sin_aprobar();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							               Productos sin aprobar
							              </a>
						                        </li>
						                    </ul>
						                 
						                   <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#crear_cot" onclick="crear_cot(0);"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							               Crear producto
							              </a>
						                        </li>
						                    </ul>
						                   
						                      
						                          <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#lineas" onclick="lineas();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							             Lineas
							              </a>
						                        </li>
						                    </ul>
                                                                          
                                                                     <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#sublineas" onclick="sublineas();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							             Sub Lineas
							              </a>
						                        </li>
						                    </ul>
						                      
						      </li> 
						      
						      <li class="">
							    <a href="#facturacion" class="dropdown-toggle">
							    <i class="menu-icon fa fa-level-down"></i>
							    <span class="menu-text">Reportes</span>
						            <b class="arrow fa fa-sort-desc"></b>
							    </a>
						                <b class="arrow"></b>
							           <ul class="submenu">
							                 <li class="">
							                <a href="#cap_pedidos" onclick="cap_pedidos();">
							                 <i class="menu-icon fa fa-caret-right"></i>
							                 Gestion de tiempo
							                </a>
						                        </li>
						                  </ul>
						                <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#factura_remisiones" onclick="factura_remisiones();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							             Liquidacion del trabajo
							              </a>
						                        </li>
						                    </ul>        
						      </li> 
						      
						       <li class="">
							    <a href="#facturacion" class="dropdown-toggle">
							    <i class="menu-icon fa fa-cogs"></i>
							    <span class="menu-text">Configuracion</span>
						            <b class="arrow fa fa-sort-desc"></b>
							    </a>
                                                            <b class="arrow"></b>
							           <ul class="submenu">
							                 <li class="">
							                <a href="#productos" onclick="maestroinv();">
							                 <i class="menu-icon fa fa-caret-right"></i>
							                Maestro de Productos
							                </a>
						                        </li>
						                  </ul>
						                <b class="arrow"></b>
							           <ul class="submenu">
							                 <li class="">
							                <a href="#porcentajes" onclick="porcentajes();">
							                 <i class="menu-icon fa fa-caret-right"></i>
							                Porcentaje
							                </a>
						                        </li>
						                  </ul>
						                <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#servicio_temple" onclick="servicio_temple();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							             Servicio Temple
							              </a>
						                        </li>
						                    </ul>      
						                
						                 <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							                <a href="#crear_gastos" onclick="crear_gastos();"> 
							                <i class="menu-icon fa fa-caret-right"></i>
							                Gastos administrativos
							                </a>
						                       </li>
						                    </ul>   
						                 
						                  <b class="arrow"></b>
							            <ul class="submenu">
							              <li class="">
							              <a href="#crear_mo" onclick="crear_mo();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							              Gastos manos de obra y maq
							              </a>
						                      </li>
						                    </ul> 
						                  
						                   <b class="arrow"></b>
							            <ul class="submenu">
							              <li class="">
							              <a href="#crear_otro" onclick="crear_otro();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							              otros gastos
							              </a>
						                      </li>
						                    </ul> 
						                   
						                    <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							              <a href="#precios_areas" onclick="precios_areas();"> 
							              <i class="menu-icon fa fa-caret-right"></i>
							              Precios por areas
							              </a>
						                      </li>
						                    </ul>
						                    
						                     <b class="arrow"></b>
							             <ul class="submenu">
							                <li class="">
							                <a href="#crear_color" onclick="crear_color();"> 
							                <i class="menu-icon fa fa-caret-right"></i>
							                configuracion aluminio
							                </a>
						                        </li>
						                    </ul>  
                                                                      <b class="arrow"></b>
							            <ul class="submenu">
							                <li class="">
							                <a href="#confi_vidrio" onclick="confi_vidrio();"> 
							                <i class="menu-icon fa fa-caret-right"></i>
							                configuracion vidrio
							                </a>
						                        </li>
						                    </ul>  
                                                                     
						                     
						                      <b class="arrow"></b>
							             <ul class="submenu">
							                <li class="">
							                <a href="#crear_per" onclick="crear_per();"> 
							                <i class="menu-icon fa fa-caret-right"></i>
							                Lista de materiales
							                </a>
						                        </li>
						                     </ul>
						                      
						                       <b class="arrow"></b>
							               <ul class="submenu">
							                <li class="">
							                <a href="#crear_servicios" onclick="crear_servicios();"> 
							                <i class="menu-icon fa fa-caret-right"></i>
							                Lista de servicios
							                </a>
						                        </li>
						                       </ul>  
                                                                       
						                       
						                        <b class="arrow"></b>
							                <ul class="submenu">
							                <li class="">
							                <a href="#conf_dolar" onclick="conf_dolar();"> 
							                <i class="menu-icon fa fa-caret-right"></i>
							                Mantenimiento Dollar
							                </a>
						                        </li>
						                        </ul>  
                                                                        
                                                                         <b class="arrow"></b>
							               <ul class="submenu">
							                <li class="">
							                <a href="#sistemas" onclick="sistemas();"> 
							                <i class="menu-icon fa fa-caret-right"></i>
							                Sistemas
							                </a>
						                        </li>
						                       </ul>  
						      </li> 
						      
						       <li class="">
							    <a href="#facturacion" class="dropdown-toggle">
							    <i class="menu-icon fa fa-rss"></i>
							    <span class="menu-text">Soporte en linea</span>
						            <b class="arrow fa fa-sort-desc"></b>
							    </a>
						              <b class="arrow"></b>
							      <ul class="submenu">
							      <li class="">
							      <a href="#cap_pedidos" onclick="cap_pedidos();">
							      <i class="menu-icon fa fa-caret-right"></i>
							       Lista de requerimientos
							      </a>
						              </li>
						              </ul>      
						      </li> 
	      
	   </ul>

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>
    <!-- FINISH MENU SEND PHP By Nilson Benitez -->

			<div class="main-content">
				<div class="main-content-inner">
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
										<span>&nbsp; Choose Skin</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
										 Inside
										 <b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
							         </div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

								
						<div class="page-content">
                                                    
						<div class="row">
							<div class="col-xs-12">	
								<!-- PAGE CONTENT BEGINS -->
								<div id="encabezado">
                                                                       <h2 class="header smaller lighter blue"><b>Modulo de Presupuesto</b></h2> 
                                                                    </div>
                                                                    <div id="mostrar_contenido">
                                                                        <center>
                                                                            <img src="../imagenes/cotizacion.jpg" width="85%">
                                                                        </center>
                                                                    </div> 
								
								<!-- PAGE CONTENT ENDS -->
							
						</div><!-- /.row -->
						</div>
					</div><!-- /.page-content -->
				</div>
			
        
			<div class="navbar-buttons navbar-header pull-right" role="navigation">			
			</div>
						

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
	
		</div><!-- /.main-container -->
	<div class="footer">
		<div class="footer-inner">
		<div class="footer-content">
		<span class="bigger-120">
		Copyright (R) 2017 | <span class="blue bolder">Templado S.A</span> | Usuario: 
                <input type="text" id="user_general" value="<?php echo $_SESSION['k_username'] ?>" style="height: 18px; width: 80px" disabled>
            | Fecha <input type="text"  id="fecha_general" value="<?php echo date("Y-m-d"); ?>" disabled  style="height: 18px; width: 100px">
                <span id="hora"></span>
		</span>
                 </div>
		</div>
	</div>
               <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i></a>
		</div><!-- /.main-container -->
		<script src="../assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
                
	</body>
</html>

