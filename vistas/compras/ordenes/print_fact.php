<?php
include '../../../modelo/conexioni.php';
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
		<title>.</title>
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

        <body style="background: white;" onload="window.print();"> 
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
                                $retica=$inf['retica'];
                                $codica=$inf['codica'];
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
                                if($retica==1){
                                    $query4 =mysqli_query($con, "SELECT porica FROM actecocxp WHERE codica='".$codica."'");
                                    $pi = mysqli_fetch_array($query4);
                                    $ica = $pi[0];
                                }else{
                                    $ica = 0;
                                }
                                $base = $tp[1];
                                //$ica = $tp[2];
                                

                                
			
		?>
			<div class="main-content">
				<div class="main-content-inner">
				 <div class="container" style="margin-top: 3;font-size: 14px;">
				 	<div style="width: 40%;float: left;">
				 		<b>TEMPLADO S.A.S</b><br>
				 		<b>800112904-6</b><br>
				 		CL 72 65-228<br>
				 		TEL:  3530128-3600173<br>
				 		<b>BARRANQUILLA</b><br>
				 		<b>SEÑOR(ES):</b><br>
				 		<?php echo $prove;?><br>
				 		<?php echo $idter;?><br>
				 	</div>
				 	<div style="width: 60%;float: right;">
				 		<b>ORDEN DE COMPRA</b><br>
				 		<b style="margin-right: 15%;">No... <?php echo $fom;?>   </b>Fecha: <?php echo $fecha_hoy;?><br>
				 		<hr>
				 		TEMPLADO S.A.S  Tiene el agrado de adjudicarle la ORDEN<br>
				 		por los items indicados en este documento. La Facturacion<br>
				 		debe ser emitida a nombre de: TEMPLADO S.A.S  Nit.800112904-6<br>
				 		Para el pago de la factura es indispensable adjuntar<br>
				 		la presente ORDEN.<?php echo $porret;?><br>
				 		<hr>
				 	</div>
				 	<div style="width: 100%;font-size: 11px">
				 		<hr style="width: 100%;">
				 		<table id="dynamic-table" style="width: 100%;font-size: 11px">
							<thead>
								<tr>
									<th class="center">CODIGO</th>
                                                                        <th class="center">REF</th>
									<th class="center">DESCRIPCION</th>
									<th class="center">MEDIDA</th>
									<th class="center">COLOR</th>
									<th class="center">UNIDAD</th>
									<th class="center">CANTIDAD</th>
									<th class="center">VR UND</th>
                                                                        <th class="center">VR TOTAL</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql=mysqli_query($con, "SELECT * FROM orden_compra_detalle WHERE codigo_orden='".$_GET['id']."'");
								$total = 0;
                                                                while ($row=mysqli_fetch_assoc($sql)) {
                                                                    $total += $row['precio']*$row['cantidad'];
                                                                    $codigo=$row['codigo'];
                                                                   
                                                                    $resux = mysqli_query($con,"select referencia from productos_var where codigo='$codigo' ");
                                                                    $r = mysqli_fetch_array($resux);
                                                                    $re = mysqli_error($con);
                                                                    $ref = $r['referencia'];
									echo "<tr>";
									echo '<td>'.$row['codigo'].'</td>';
                                                                        echo '<td>'.$ref.'</td>';
									echo '<td>'.$row['descripcion'].'</td>';
										echo '<td><center>'.$row['medida'].'</center></td>';
										echo '<td><center>'.$row['color'].'</center></td>';
										echo '<td><center>'.$row['undmed'].'</center></td>';
										echo '<td><center>'.$row['cantidad'].'</center></td>';
										echo '<td style="text-align:right">'.number_format($row['precio'],2).'</center></td>';
                                                                                echo '<td style="text-align:right">'.number_format(($row['precio']*$row['cantidad']),2).'</center></td>';
										echo "</tr>";
								}
								?>
							</tbody>
						</table>
						<hr style="width: 100%;">
						<div style="width: 100%;font-size: 11px;margin-bottom: 4%;">
                                                    <b>OBSERVACIONES</b><br>
                                                    <b><?php echo $cobserv;?><br>
                                                      <b><?php 
                                                        
                                                        if($sede=='GALAPA'){
                                                            $dire = '<b>UBICADO EN  GALAPA  </b> KM 104 + 200MT FRENTE LA HACIENDA EL SOCORRO<br>';
                                                            $tele=  '<b>CONTACTO: </b>3530218 EXT 132';
                                                        }else{
                                                            $dire= '<b>UBICADO EN BQUILLA  </b> CALLE 71 #67-58<br>';
                                                            $tele= '<b>CONTACTO: </b>3530218 EXT 114';
                                                        }
                                                        
                                                        ?><br>
                                                           </b>
						</div>
						<div style="width: 100%;font-size: 12px;margin-bottom: 12%;">
							<b> AGRADECEMOS TENER EN CUENTA LAS SIGUIENTES OBSERVACIONES:<br>
								1. FAVOR CONFIRMAR CORREO RECIBIDO<br>
								2. CONFIRMAR DISPONIBILIDAD<br>
								3. CUALQUIER DIFERENCIA DE PRECIOS COMUNICAR DE MANERA INMEDIATA.<br>
                                                                &nbsp; &nbsp; O SE DARA COMO ACEPTADO EL VALOR DE LOS PRECIOS EN LA ORDEN DE COMPRA<br>
                                                                4. CONFIRMAR DESPACHO CON NUMERO DE GUIA<b>,</b> NUMERO DE FACTURA Y ORDEN DE COMPRA<br>
								5. COLOCAR EN LA FACTURA EL NUMERO DE ORDEN DE COMPRA.<br>
								6. ENVIAR CON LOS PRODUCTOS COPIA DE FACTURA Y ORIGINAL POR CORREO CERTIFICADO<br>
								<br>
                                                                <?php echo $cobserv;?><br>
								<br>
								CUALQUIER DUDA O INQUIETUD COMUNIQUESE CON EL DEPARTAMENTO DE COMPRAS<br>
								<br>
								GRACIAS
						</div>
						<hr style="width: 100%;">
						<div style="width: 50%;font-size: 12px;float: left;">
							CONDICIONES:<br>
							a) Precios Fijos En Pesos<br>
							b) Fecha maxima de entrega  <?PHP ECHO $nuevafecha ?><br>
							c) Direccion de Envio: <?php echo $dire.' '.$tele ?> <br>
							d) Termino de Pago: 30 Dias<br>
							e)Observaciones: <?php echo $cobserv ?><br>
							<br>
							<br>
							<br>
							<br><br><br>
							____________________________<br>
                                                    
                                                        Generado por: <?php echo $nombreuser ?><BR>
                                                        Cel: <?php echo $cel ?>

						</div>
                                                <?php
                                                $iva = $total * ($piva/100);
                                                $porret;
                                                if($total>=$base){
                                                    
                                                    $rete = $total * ($porret/100);
                                                    $tica = $total * ($ica/100);
                                                }else{
                                                    $rete = 0.00;
                                                    $tica = 0.00;
                                                }
                                                ?>
						<div style="width: 50%;font-size: 12px;float: right;">
                 
                                                    <table style="width: 100%">
                                                            <tr>
                                                                <td>VALOR SUBTOTAL:</td>
                                                                <td style="text-align: right">$ <?php echo number_format($total,2); ?> </td> 
                                                            </tr>
                                                            <tr>
                                                                <td>VR. DESCUENTOS:</td>
                                                                <td style="text-align: right">$ 0.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td>VR. IVA  </td>
                                                                <td style="text-align: right">$ <?php echo number_format($iva,2); ?></td>
                                                            </tr><tr>
                                                                <td>RETENCION </td>
                                                                <td style="text-align: right">$ <?php echo number_format($rete,2); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>VR. ICA <?php echo $ica ?>%</td>
                                                                <td style="text-align: right">$ <?php echo number_format($tica,2); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>VR. CREE</td>
                                                                <td style="text-align: right">$ 0.00</td> 
                                                            </tr>
                                                            <tr>
                                                                <td>TOTAL ORDEN:</td>
                                                                <td style="text-align: right"><?php echo '$: '.number_format(($total+$iva-$rete-$tica),2);?></td>
                                                            </tr>
                                                          
                                                    </table><br><br><br><br>
                                                    <table>
                                                          <tr> <td>
                                                            ______________________________<br>
                                                    JEFE DE COMPRAS
                                                        </td></tr>
                                                    </table>
						</div>
				 	</div>
				</div>
			</div>
		</div>
<script type="text/javascript">
 			//window.print();
 		</script>
  </body>
</html>
