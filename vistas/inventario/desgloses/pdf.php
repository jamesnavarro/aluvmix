<?php
include '../../../modelo/conexionv1.php';
session_start();
	  if(!isset($_SESSION['k_username'])){ 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
       
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Lista de Accesorios</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="shortcut icon" type="image/png" href="../assets/images/warehouse.png"/>
                 <style> 
              body {
                font-size: 90%;
              }
          </style>
	</head>

        <body style="background: white;"  onload="window.print();"> 
		<?php
			$info=mysqli_query($con, "SELECT * FROM orden_compra WHERE codigo='".$_GET['id']."'");
			$inf=mysqli_fetch_assoc($info);
			$prove=$inf['nom_ter'];
			$idter=$inf['cod_ter'];
			$fecha_hoy=$inf['fecha'];
			$sede=$inf['sede_dir'];
			$precio=$inf['total'];
                        $fom=$inf['ordenfom'];
                        $cobserv=$inf['observaciones_compra'];
                        $user=$inf['usuario'];
                        $cuenta=$inf['cod_cuenta'];
                        $piva=$inf['PORIVA'];
                        $noretefuente=$inf['PORRET'];
                        $fecha = date('Y-m-j');
                                $nuevafecha = strtotime ( '+2 day' , strtotime ( $fecha_hoy ) ) ;
                                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                                $usuarios =mysqli_query($con, "SELECT concat(nombre,' ',apellido) as ali,celular  FROM usuarios WHERE usuario='".$user."'");
                                $u = mysqli_fetch_array($usuarios);
                                $nombreuser= $u[0];
                                $cel = $u[1];
                                $usuarios2 =mysqli_query($con, "SELECT porfte,base,porica  FROM intercxp WHERE codigo='".$cuenta."'");
                                $tp = mysqli_fetch_array($usuarios2);
                                if($noretefuente==1){
                                    $porret = 0;
                                }else{
                                    $porret = $tp[0];
                                }
                                
                                $base = $tp[1];
                                $ica = $tp[2];
                              
		?>
			<div class="main-content">
				<div class="main-content-inner">
				 <div class="container" style="margin-top: 3;font-size: 14px;">
				 	<div style="width: 40%;float: left;">
				 		<b>TEMPLADO S.A</b><br>
				 		<b>800112904-6</b><br>
				 		CL 72 65-228<br>
				 		TEL:  3530128-3600173<br>
				 		<b>BARRANQUILLA</b><br>
				 		
				 	</div>
				 	<div style="width: 60%;float: right;">
				 		<b>LISTA DE ACCESORIOS</b><br>
				 		<b>Fecha: <?php echo $fecha_hoy;?></b><br>
				 		<hr>
                                             
				 		<b><?php echo $_GET['obs'];?></b><br>
				 		<hr>
				 		
				 	</div>
				 	<div style="width: 100%;font-size: 11px">
				 		<hr style="width: 100%;">
				 		<table id="dynamic-table" style="width: 100%;font-size: 11px">
							<thead>
								<tr>
									<th class="center">CODIGO</th>
                                                                        <th class="center">REFERENCIA</th>
									<th class="center">DESCRIPCION</th>
									<th class="center">MEDIDA</th>
									<th class="center">COLOR</th>
									<th class="center">UNIDAD</th>
									<th class="center">CANTIDAD</th>
									
								</tr>
							</thead>
							<tbody>
	<?php
	$reques=mysqli_query($con2,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can FROM desgloses_material a, referencias b where $sol a.linea='Accesorios' and  a.codigo_pro=b.codigo and a.id_cot=".$_GET["cot"]." and cantidad!=0 group by a.codigo_pro order by a.referencia asc ");
                $contador=0;
                $ref = '';
                $sw=0;
                $sistema = '';
                 while($rowp=mysqli_fetch_array($reques)){
                     $contador++;
                     if($rowp['dado']=='0' || $rowp['dado']==''){
                         $dado = $rowp['referencia'];
                     }else{
                         $dado = $rowp['dado'];
                     }
  
                     if($rowp['color']=='02'){
                         $area=$rowp['area']/1000;
                     }else{
                          $area=$rowp['area'];
                     }
                     if($rowp['color']=='01'){
                         $crudo = 'ANONIZADO';
                     }else{
                         $crudo = 'CRUDO';
                     }
                     $areat = $area*($rowp['perfil']/1000);
                     // sacar color del items
                     $resultc = mysqli_query($con2,"select color_ta from cotizaciones where id_cotizacion='".$rowp['id_cot_item']."' ");
                     $rc = mysql_fetch_array($resultc);
                     
                     
                     $alum_porr = "SELECT costo_a,rendimiento,variable FROM tipo_aluminio where color_a='".$rc[0]."'";
                    $fia4 =mysqli_fetch_array(mysqli_query($con2,$alum_porr));
                    $vc= $fia4["costo_a"]*$fia4["variable"];  //se le agrego la variable que multiplica la pintura
                    $rendimiento= $fia4["rendimiento"];
                    $tipopintura= $fia4["variable"];
                    
                  
                    $queryma = mysqli_query($con2,"select tipo from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' group by tipo ");
                    $ventana = '';
                    while ($row1 = mysqli_fetch_array($queryma)) {
                        $ventana = $ventana.$row1[0].' ,';
                    }
                    $mystring = $rowp['descripcion'];
                   
                   $descripcion = $rowp['descripcion'];
                   
//                    if($contador==1){
//                            echo '<tr style="background-color:#C5E9C0"><td colspan="19"> - '.$rowp['sistema'].'-</td>';
//                          
//                        }
                    if($sistema!=$rowp['sistema']){
                         
                            echo '<tr style="background-color:#C5E9C0"><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                         
                     }
//                     $consulta=mysql_query($con,"select sum(stock_ubi) as st FROM `relacion_ubicaciones` where bod_codigo='".$_GET['bod']."' and codigo_pro='$codigo' ");
//                     $s = mysqli_fetch_array($consulta);
//                     $stock = $s[0];
//                     if($stock==null){
//                         $st = 0;
//                     }else{
//                         $st = $stock;
//                     }
                    
                     $ref = $rowp['referencia'];
                     $sistema = $rowp['sistema'];
                     $codigo = $rowp['codigo'];
                     if($rowp['existefom']=='1'){ 
                         $bcolor='#F4CACA';
                         $ch2 = '';
                     }else{
                         $bcolor='#C5E9C0';
                         $ch2='<input type="checkbox" id="'.$contador.'" name="item2" checked>';
                     }
                     echo '<tr id="td'.$contador.'">'
                            . '<td>'.$codigo.'</td>'
                            . '<td>'.$dado.' </td>'
                            . '<td>'.$descripcion.' </td>'
                            . '<td>- </td>'
                            . '<td>'.$rowp['color'].' </td>'
                            . '<td>Und</td>'
                            . '<td>'.number_format($rowp['can']).' </td>';

                 }
		?>
	</tbody>
	</table>
		<hr style="width: 100%;">
		<hr style="width: 100%;">

				 	</div>
				</div>
			</div>
		</div>
<script type="text/javascript">
 			//window.print();
 		</script>
  </body>
</html>
