<?php
session_start();
if(isset($_SESSION['acceso'])){
	$cedula=$_SESSION['acceso'][0];
	$usuario=$_SESSION['acceso'][1];
	$id_user=$_SESSION['acceso'][2];
	$celular=$_SESSION['acceso'][3];
	$cargo=$_SESSION['acceso'][4];
	$apellido=$_SESSION['acceso'][5];
	$nombre=$_SESSION['acceso'][6];
}
if($usuario!=''){}
else{header('location: ../index.php');}
include_once '../modelo/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Planta Vidrio</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<meta charset="utf-8">
		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<script src="assets/js/ace-extra.min.js"></script>
	</head>

	<body class="no-skin">
		<?php include 'header.php';?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar  navbar-collapse collapse          ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				

				<?php include 'menu.php';?>

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-cogs home-icon"></i>
								<b style="color: blue;">Planta Produccion Vidrio</b>
                                                                <a href="../vistas/supervisor.php" class="btn btn-inverse">Pagina principal</a>
							</li>
						</ul>
						<div style="float: right;padding-right: 3%;">
					<a onclick="entrega4();" class="tooltip-info" data-rel="tooltip" title="Guia Software"><img src="assets/images/info.png"></a>
				</div>
					</div>

					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
						</div>
						<form action="acciones/pasar_linea.php" method="POST" name="myform">
							<?php
							$area='';
							$grupo='';
							$area_id=0;
							$grupo_id=0;
							$ptotal=0;
							$m2total=0;
							$mltotal=0;
							$ctotal=0;
								$sql=mysqli_query($conexion,"SELECT s.nombre_subpro, g.name, g.id_area, s.id_subpro, g.id_g FROM grupo g INNER JOIN subproceso s ON s.id_subpro=g.id_area WHERE g.id_g='".$_GET['grupo']."'");
								if($row=mysqli_fetch_assoc($sql)){
									$area=$row['nombre_subpro'];
									$grupo=$row['name'];
									$area_id=$row['id_subpro'];
									$grupo_id=$row['id_g'];
								}
								$sqlx=mysqli_query($conexion,"SELECT  e.medida1, e.medida2, e.medida3 From orden_detalle e, procesos_activos f WHERE f.area_id='".$area_id."' and f.area_proceso  in ('Vidrio', 'Vidrios Decoracion Jamar') and e.codigo=f.id_op and e.id_orden_d=f.id_orden_d and f.usuario='".$grupo_id."'");
									while ($cont=mysqli_fetch_assoc($sqlx)) {
										$ctotal++;
										$ptotal+=floatval((($cont['medida1']/1000)*($cont['medida2']/1000)*($cont['medida3'])*(2.5))*1);
										$m2total+=floatval((($cont['medida1']/1000)+($cont['medida2']/1000)));
										$mltotal+=floatval(((($cont['medida1']/1000)*2)+(($cont['medida2']/1000)*2)));
									}
							?>
							<b>Area:</b><label style="color: red;padding-left: 1%;margin-right: 4%;"><b><?php echo $area;?></b></label>     <b>Grupo:</b><label style="color: red;padding-left: 1%;margin-right: 4%;"><b><?php echo $grupo?></b></label>     <b>Usuario:</b><label style="color: red;padding-left: 1%;margin-right: 4%;"><b><?php echo $nombre.' '.$apellido;?></b></label>
									<div style="width: 100%;margin-top: 1%;margin-bottom: 1%;text-align: right;">
										<label><b>Seleccione Burro:</b></label>
										<select style="width: 20%" name="burro" id="burro">
										<option> </option>
										<?php
											$lisb=mysqli_query($conexion,"SELECT b.id_burro, b.nombre FROM burro b, burros_areas ba WHERE ba.id_area='".$area_id."' and b.id_burro=ba.id_burro and b.estado_actual='Desocupado' and b.planta_sede='".$_SESSION['sede']."' ORDER BY b.id_burro");
											while ($encb=mysqli_fetch_assoc($lisb)) {
												echo '<option value='.$encb['id_burro'].'>'.$encb['nombre'].'</option>';
											}
										?>
										</select>
									<button class="btn btn-danger" onclick="finpro();" id="enviar" name="buscar" style="margin-right: 10%;">Enviar Paquete</button><img src="assets/images/loading.svg" align="right" width="64" height="64" id="loading"></div>

									<div style="width: 100%;">
										<input type="hidden" name="grupo" id="grupo" value="<?php echo $grupo_id;?>">
										<input type="hidden" name="id_u" id="id_u" value="<?php echo $id_user;?>">
										<input type="hidden" name="id_area" id="id_area" value="<?php echo $area_id;?>">
										<input type="hidden" name="id_name" id="id_name" value="<?php echo $grupo;?>">
										<input type="hidden" name="area_name" id="area_name" value="<?php echo $area;?>">
										<?php 
                                                                                if(isset($_POST['op'])){
                                                                                    $ops = $_POST['op'];
                                                                                    $buscar = " c.id_op IN ($ops)  and ";
                                                                                }elseif (isset($_POST['medida'])) {
                                                                                    $area_id = $_POST['medida'];
                                                                                     $buscar = " b.medida1='".$_POST['ancho']."' and b.medida2='".$_POST['alto']."' ";
                                                                                }elseif (isset($_POST['opf'])) {
                                                                                    echo $ops = $_POST['opf'];
                                                                                     $buscar = " a.opf IN ($ops) and ";
                                                                                }else{
                                                                                     $buscar = "";
                                                                                }
                                                                                
                                                                                
													$ctt=0;
													$conta=0;
													$items=0;
													$total2=0;
													$ta2 =0;
													$tacot =0;
													$status='';
													$pesov=0;
													$ptota=0;
													$x=0;
													$cotiza=0;
                                                                                                        $pert=0;
                                                                                                        $boqt=0;
                                                                                                        $totm2=0;
                                                                                                        $totml=0;
                                                                                                        //$sqlr=mysqli_query($conexion,"SELECT f.barra_item, f.malo, a.producto, f.id_op, e.color, e.id_producto, e.medida1, e.medida2, e.medida3, e.perforacion_item, e.boquete_item,c.per, c.boq,f.id_proceso From producto a, orden_detalle e, procesos_activos f, cotizaciones c WHERE $buscar f.area_id='".$area_id."' and f.area_proceso  in ('Vidrio', 'Vidrios Decoracion Jamar') and e.codigo=f.id_op and e.id_orden_d=f.id_orden_d and c.id_cotizacion=e.relacionado and a.id_p=e.id_producto  and f.usuario='".$grupo_id."'");
													$sqlr=mysqli_query($conexion,"SELECT a.opf,c.barra_item, c.malo, c.id_op,b.color, b.id_producto, b.medida1, b.medida2, b.medida3, b.perforacion_item, b.boquete_item,c.id_proceso ,d.per, d.boq FROM orden_produccion a, orden_detalle b, procesos_activos c, cotizaciones d where $buscar a.id_orden=b.codigo and b.id_orden_d=c.id_orden_d and d.id_cotizacion=b.relacionado and c.area_proceso in ('Vidrio', 'Vidrios Decoracion Jamar') and c.usuario='".$grupo_id."' and c.area_id='".$area_id."' ");
													if($sqlr){
													//    echo'<hr>'; and 
													             $table = '<table class="table table-bordered table-striped table-hover" id="tabla" style="border: 10px solid #307ECC;">';
													             $table = $table.'<thead >';
													              $table = $table.'<tr BGCOLOR="#C3D9FF">';
													              $table= $table.'<th width="3%">*Items</th>';
													              $table = $table.'<th width="3%">'.'O.P'.'</th>'; 
													              $table = $table.'<th width="3%">'.'OPF'.'</th>';
													               $table = $table.'<th width="3%">'.'Codigo'.'</th>';
													              $table = $table.'<th width="20%">'.'Producto'.'</th>';          
													              $table = $table.'<th width="7%">'.'Color Vid.'.'</th>';            
													               $table = $table.'<th  width="4%">'.'Cant Ordenadas'.'</th>';
													               $table = $table.'<th  width="4%">'.'Medidas'.'</th>';
													               $table = $table.'<th width="4%">'.'Peso(kgs)'.'</th>';
													               $table = $table.'<th width="4%">'.'m2'.'</th>';
													               $table = $table.'<th width="4%">'.'mL'.'</th>';
													               $table = $table.'<th width="4%">'.'Boq'.'</th>';
													               $table = $table.'<th width="4%">'.'Per'.'</th>';
													               $table = $table.'<th width="4%"><center><label><input id="todos" onclick="Todos(this);" class="ace ace-checkbox-2" type="checkbox">
														<span class="lbl"></span></label></center></th>';
													              $table = $table.'</tr>';
													              $table = $table.'</thead>';
													          }
                                                                                                                  $opfom ='';
														while($row=mysqli_fetch_array($sqlr))
														{
													            
													           
													      $opf=0;
													       $boq=0;
													      $per=0;
													      if($row['boquete_item']<=0){
													      	$boq=$row['boq'];
													      }else{
													      	$boq=$row['boquete_item'];
													      }
													      if($row['perforacion_item']<=0){
													      	$per=$row['per'];
													      }else{
													      	$per=$row['perforacion_item'];
													      }
													      $bopf=mysqli_query($conexion,"SELECT producto FROM producto WHERE id_p='".$row['id_producto']."'");
													      $ropf=mysqli_fetch_assoc($bopf);
                                                                                                               $producto=$ropf['producto'];
													      $opf=$row['opf'];
													      $ctt=1;
													       $cadena = $row['color']; 
 														  $resultado = intval(preg_replace('/[^0-9]+/', '', $cadena)); 
													       $pesov=(((($row['medida1']/1000)*($row['medida2']/1000))*($row['medida3'])*(2.5)));
													      if($ctt!=0){
													          $items++;
													          $valor='';
													          if($row['malo']=='si'){
													          	$valor=$row["id_op"].'<p style="color: red;">(R)';
													          }else{
													          	$valor=$row["id_op"];
                                                                                                                        }
                                                                                                                if($row['id_burro']=='0'){
                                                                                                                    $dis='disabled';
                                                                                                                }else{
                                                                                                                    $dis='';
                                                                                                                }
                                                                                                                 $opfom =$opf;
													          $ptota=$ptota+$pesov;
                                                                                                                  $pert +=$per;
                                                                                                                  $boqt +=$boq;
                                                                                                                  $totm2 +=((($row['medida1']/1000)+($row['medida2']/1000)));
                                                                                                                  $totml +=(((($row['medida1']/1000)*2)+(($row['medida2']/1000)*2)));
                                                                                                                  $top = $valor;
													             $table = $table.'<tr><td width="3%">'.$items.' </a></td>
													            			<td width="3%">'.$valor.'</a></td>
													            			<td width="3%">'.$opf.'</a></td>
													                        <td width="3%">'.$row["id_proceso"].'</a></td>
													                        <td width="45%">'.$producto.'</td>
													                        <td width="10%">'.$row['medida3'].' - '.$row['color'].'</a></td>
													                        <td width="4%">'.'1'.'</a></td>
													                        <td width="7%">'.$row['medida1'].'x'.$row['medida2'].'</a><input type="hidden" value='.$row['medida1'].' name="anc'.$row["id_proceso"].'"><input type="hidden" value='.$row['medida2'].' name="alt'.$row["id_proceso"].'"><input type="hidden" value='.$row['medida3'].' name="esp'.$row["id_proceso"].'"></td>'.'
													                    <td width="5%"><p style="color: red;"><b>'.number_format($pesov).'Kgs'.'</b></p></td>
													                   <td width="5%"><p style="color: blue;"><b>'.floatval((($row['medida1']/1000)+($row['medida2']/1000))).'m2'.'</b></p></td>
													                   <td width="5%"><p style="color: blue;"><b>'.floatval(((($row['medida1']/1000)*2)+(($row['medida2']/1000)*2))).'mL'.'</b></p></td>
													                   <td width="5%"><p style="color: blue;"><b>'.$boq.'</b></p></td>
													                   <td width="5%"><p style="color: blue;"><b>'.$per.'</b></p></td>
													                    <td  width="4%" style="color: red;"><center><label><input name="valores[]" value='.$row["id_proceso"].' '.$dis.' class="ace ace-checkbox-2" type="checkbox"><span class="lbl"></span></label></center></td>
													                        </tr>'; 
															
														} 
													    }    
                                                                                                             $table = $table.'<tr>'
                                                                                                                     . '<td><input type="hidden" name="t_can" value="'.$items.'">'
                                                                                                                     . '<input type="hidden" name="t_idp" value="'.$top.'">'
                                                                                                                     . '<input type="hidden" name="t_opf" value="'.$opfom.'">'
                                                                                                                     . '<input type="hidden" name="t_peso" value="'.number_format($ptota,2).'">'
                                                                                                                     . '<input type="hidden" name="t_m2" value="'.number_format($totm2,2).'">'
                                                                                                                     . '<input type="hidden" name="t_ml" value="'.number_format($totml,2).'">'
                                                                                                                     . '<input type="hidden" name="t_per" value="'.$boqt.'">'
                                                                                                                     . '<input type="hidden" name="t_boq" value="'.$pert.'"></td><td></td>'
                                                                                                                     . '<td>'.$opfom.'</td>'
                                                                                                                     . '<td colspan="5"></td><td>'.number_format($ptota,2).'</td>'
                                                                                                                     . '<td>'.number_format($totm2,2).'</td>'
                                                                                                                     . '<td>'.number_format($totml,2).'</td>'
                                                                                                                     . '<td>'.$boqt.'</td>'
                                                                                                                     . '<td>'.$pert.'</td>';
														$table = $table.'</table>';
														echo $table;
													         
											 
										?>

											</tbody>
											</table>
										</div>
                                                        <?php include 'busqueda.php';?>
									</form>
									<?php if(isset($_GET['send'])){ echo "<script>alert('Paquete enviado con exito');</script>";}?>
									<?php if(isset($_GET['asigna'])){ echo "<script>alert('Carga asignada con exito');</script>";}?>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
			<div class="content" style="margin-bottom: 6%;"></div>
			<div  class="navbar-fixed-bottom" align="center" style="background-color: white;">
				<div class="footer-inner ">
					<div class="footer-content " >
						<span class="bigger-120">
							<span class="blue bolder">Templado</span>
							S.A &copy; 2017-2018
						</span>
						&nbsp; &nbsp;
						<img class="nav-user-photo" src="assets/images/avatars/tmplogo-01.png" alt="Jason's Photo" /> 
						&nbsp; &nbsp;
						
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
						
		<script type="text/javascript">
			document.getElementById('loading').style.visibility  = 'hidden';
			function finpro() {
				document.getElementById("enviar").disabled = true;
				document.getElementById('loading').style.visibility  = 'visible';
				document.myform.submit();
			}
		</script>
		<!-- basic scripts -->
		<script type="text/javascript">
			function Todos(source) {
				        if(source.checked){
				        	checkboxes = document.getElementsByName('valores[]'); 
				        for (i=0;i<checkboxes.length;i++) { 
				                if (checkboxes[i].type === "checkbox") { 
				                        checkboxes[i].checked = source.checked; 
				        }
				        } 
				    }else{
				    	checkboxes = document.getElementsByName('valores[]'); 
				        for (i=0;i<checkboxes.length;i++) { 
				                if (checkboxes[i].type === "checkbox") { 
				                        checkboxes[i].checked = source.checked; 
				        }
				        }
				    }
				}
		</script>
		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
	</body>
</html>
