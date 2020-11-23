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

        <body style="background: white;" onload="window.print()">  
		<?php
			$info=mysqli_query($con2, "SELECT * FROM cotizacion WHERE id_cot='".$_GET['cot']."'");
			$p=mysqli_fetch_array($info);
                        
			$query1=mysqli_query($con2, "SELECT * FROM cont_terceros WHERE id_ter='".$p['id_tercero']."'");
			$t =mysqli_fetch_array($query1);	
                                

                                
			
		?>
			<div class="main-content">
				<div class="main-content-inner">
				 <div class="container" style="margin-top: 3;font-size: 14px;">
				 	<div style="width: 40%;float: left;">
				 		<b>TEMPLADO S.A</b><br>
				 		<b>800112904-6</b><br>
				 		CL 72 65-228<br>
				 		TEL:  3530128-3600173<br>
				 		<b>SUCURSAL</b><br>
		
				 		<?php echo $t[2];?><br>
				 		<?php echo $p[64];?><br>
                                                <?php echo $p[66];?><br>
                                                <?php echo $p[67];?><br>
				 	</div>
				 	<div style="width: 60%;float: right;">
				 		<b>PEDIDO</b><br>
				 		<b style="margin-right: 15%;">No... <?php echo $p[54];?>   </b>Fecha: <?php echo $p[65];?><br>
				 		<hr>
				 		<b>CLIENTE</b><br>
		
				 		<?php echo $t[2];?><br>
				 		<?php echo $p[64];?><br>
                                                <?php echo $p[5];?><br>
                                                <?php echo $p[6];?><br>
				 		<hr>
				 	</div>
				 	<div style="width: 100%;font-size: 11px">
				 		<hr style="width: 100%;">
				 		<table id="dynamic-table" style="width: 100%;font-size: 11px">
							<thead>
								<tr>
								
                                                                        <th class="center">REFERENCIA</th>
									<th class="center">DESCRIPCION</th>
									<th class="center">MEDIDA</th>
									<th class="center">COLOR</th>
							
									<th class="center">CANTIDAD</th>
									<th class="center">VR UNITARIO</th>
                                                                        <th class="center">VR TOTAL</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql=mysqli_query($con2, "SELECT * FROM cotizacion_pedidos WHERE id_cot='".$_GET['cot']."'");
								$total = 0;
                                                                while ($row=mysqli_fetch_assoc($sql)) {
                                                                    $total += $row['valor_und']*$row['cantidad'];
                                                                    $codigo=$row['codigo'];
                                                                   
                                                                    $ref = $row['referencia'];
									echo "<tr>";
									echo '<td>'.$row['referencia'].'</td>';
           
									echo '<td>'.$row['descripcion'].'</td>';
										echo '<td><center>'.$row['medida'].'</center></td>';
										echo '<td><center>'.$row['color'].'</center></td>';
										
										echo '<td><center>'.$row['cantidad'].'</center></td>';
										echo '<td style="text-align:right">'.number_format($row['valor_und'],2).'</center></td>';
                                                                                echo '<td style="text-align:right">'.number_format(($row['valor_und']*$row['cantidad']),2).'</center></td>';
										echo "</tr>";
								}
								?>
							</tbody>
						</table>
						<hr style="width: 100%;">
						
						<div style="width: 100%;font-size: 12px;margin-bottom: 12%;">
							
						</div>
						<hr style="width: 100%;">
						<div style="width: 50%;font-size: 12px;float: left;">
							CONDICIONES:<br>
							a) Precios Fijos En Pesos<br>
							b) Fecha maxima de entrega  <?PHP ECHO $nuevafecha ?><br>
							c) Direccion de Envio: <?php echo $p[66].' ' ?> <br>
							d) Termino de Pago: 30 Dias<br>
							e)Observaciones: <?php echo $p[62] ?><br>
							<br>
							<br>
							<br>
							<br><br><br>
							____________________________<br>
                                                    
                                                        Generado por: <?php echo $p[68] ?><BR>
                                                       

						</div>
                                                <?php
                                                $porret=0;
                                                $ica = 0;
                                                $piva = 19;
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
                                                                <td>VR. ICA</td>
                                                                <td style="text-align: right">$ <?php echo number_format($tica,2); ?></td>
                                                            </tr>
                                                     
                                                            <tr>
                                                                <td>TOTAL ORDEN:</td>
                                                                <td style="text-align: right"><?php echo '$: '.number_format(($total+$iva-$rete-$tica),2);?></td>
                                                            </tr>
                                                          
                                                    </table><br><br><br><br>
                                                    <table>
                                                          <tr> <td>
                                                            ______________________________<br>
                                                    
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
