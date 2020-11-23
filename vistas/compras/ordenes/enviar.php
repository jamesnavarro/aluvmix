<?php
session_start();
	  if(!isset($_SESSION['k_username'])){ 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
        include '../../../modelo/conexioni.php';
			$info=mysqli_query($con, "SELECT * FROM orden_compra WHERE codigo='".$_GET['id']."'");
			if($inf=mysqli_fetch_assoc($info)){
				$prove=$inf['nom_ter'];
				$idter=$inf['cod_ter'];
				$fecha_hoy=$inf['fecha'];
				$sede=$inf['sede_dir'];
				$precio=$inf['total'];
                                $cobserv=$inf['observaciones_compra'];
                                $fom=$inf['ordenfom'];
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
                                if($retica==1){
                                    $query4 =mysqli_query($con, "SELECT porica FROM actecocxp WHERE codica='".$codica."'");
                                    $pi = mysqli_fetch_array($query4);
                                    $ica = $pi[0];
                                }else{
                                    $ica = 0;
                                }
                                $base = $tp[1];
                                
                                
                                
			}
                        $ordenc = $_GET['id']+999999999999999;
                        $oc = base64_encode($ordenc);
                        $pdf = '<a href="http://aluvmix.softmediko.com/OrdenCompraTemplado.php?orden='.$oc.'"><img src="http://aluvmix.softmediko.com/pdf.png">Descargar Orden No.'.$fom.'</a>';
                        $sql=mysqli_query($con, "SELECT * FROM orden_compra_detalle WHERE codigo_orden='".$_GET['id']."'");
			$tabla='';
                            $total = 0;    
                        while ($row=mysqli_fetch_assoc($sql)) {
                            $query = mysqli_query($con, "select referencia from productos_var where codigo='".$row['codigo']."' ");
                            $r = mysqli_fetch_array($query);
       
                            $total += $row['precio']*$row['cantidad'];
										$tabla= $tabla."<tr>";
										$tabla= $tabla. '<td>'.$r['referencia'].'</td>';
										$tabla= $tabla. '<td>'.$row['descripcion'].'</td>';
                                                                                $tabla= $tabla. '<td>'.$row['codigo'].'</td>';
										$tabla= $tabla. '<td><center>'.$row['medida'].'</center></td>';
										$tabla= $tabla. '<td><center>'.$row['color'].'</center></td>';
										$tabla= $tabla. '<td><center>Und</center></td>';
										$tabla= $tabla. '<td><center>'.$row['cantidad'].'</center></td>';
										$tabla= $tabla. '<td><center>'.number_format($row['precio'],2).'</center></td>';
                                                                                $tabla= $tabla. '<td><center>'.number_format(($row['precio']*$row['cantidad']),2).'</center></td>';
										$tabla= $tabla. "</tr>";
									}
                                                                        $sedex='';
                                                         if($sede=='GALAPA'){
                                                            $sedex = $sedex. '<b>DIRECCION GALAPA: </b> KM 104 + 200MT FRENTE LA HACIENDA EL SOCORRO<br>';
                                                            $sedex = $sedex.  '<b>CONTACTO: </b>3530218 EXT 132';
                                                        }else{
                                                            $sedex = $sedex.  '<b>DIRECCION BQUILLA: </b> CALLE 71 #67-58<br>';
                                                            $sedex = $sedex.  '<b>CONTACTO: </b>3530218 EXT 114';
                                                        }
                                                         $iva = $total * ($piva/100);
                                                        if($total>=$base){
                                                    
                                                    $rete = $total * ($porret/100);
                                                    $tica = $total * ($ica/100);
                                                }else{
                                                    $rete = 0.00;
                                                    $tica = 0.00;
                                                }
                                                
	
$mensaje = '<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>TempladoOrdenCompraNo. '.$fom.'</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	</head>

	<body style="background: white;">
		
			<div class="main-content">
				<div class="main-content-inner">
				 <div class="container" style="margin-top: 3;font-size: 14px;">
				 	<div style="width: 40%;float: left;">
				 		<b>TEMPLADO S.A.S</b><br>
				 		<b>800112904-6</b><br>
				 		CL 72 65-228<br>
				 		TEL:  3530128-3600173<br>
				 		<b>BARRANQUILLA</b><br>
				 		<b>SEÑORES:</b><br>
				 		'.$prove.'<br>
				 		'.$idter.'<br>


				 	</div>
				 	<div style="width: 60%;float: right;">
				 		<b>ORDEN DE COMPRA</b><br>
				 		<b style="margin-right: 15%;">No... '.$fom.'   </b>Fecha: '.$fecha_hoy.'<br>
				 		<hr>
				 		TEMPLADO S.A.S  Tiene el agrado de adjudicarle la ORDEN<br>
				 		por los items indicados en este documento. La Facturacion<br>
				 		debe ser emitida a nombre de: TEMPLADO S.A.S  Nit.800112904-6<br>
				 		Para el pago de la factura es indispensable adjuntar<br>
				 		la presente ORDEN.<br>
				 		<hr>
				 	</div>
				 	<div style="width: 100%;">
				 		<hr style="width: 100%;">
				 		<table id="dynamic-table" class="table table-striped  table-hover">
							<thead>
								<tr>
									<th class="center">REFERENCIA</th>
									<th class="center">DESCRIPCION</th>
                                                                        <th class="center">COD. EMP</th>
									<th class="center">MEDIDA</th>
									<th class="center">COLOR</th>
									<th class="center">UNIDAD</th>
									<th class="center">CANTIDAD</th>
                                                                        <th class="center">VR UND</th>
									<th class="center">VR TOTAL</th>
								</tr>
							</thead>
							<tbody>'.$tabla.'</tbody>
						</table>
						<hr style="width: 100%;">
						<div style="width: 100%;font-size: 10px;margin-bottom: 4%;">
                                                    <b>OBSERVACIONES</b><br>
                                                      <b>'.$cobserv.'<br>
                                                    
                                                           </b>
						</div>
<div style="width: 90%;font-size: 10px;margin-bottom: 14%;">
<br>
<b><h5>**AVISO IMPORTANTE**:<br>
ME PERMITO COMPARTIRLES QUE LOS  HORARIOS DE RECIBO DE MERCANCIAS EN LAS DOS PLANTAS (SEDE GALAPA Y BARRANQUILLA) 
QUEDAN DE LA SIGUIENTE FORMA: <br>
<br>

LUNES A VIERNES<br>
8:00 am a 11:30 am<br>
1:00 pm a 4:30 pm<br>
<br>

Sábados<br>
8:00 am a 11:30 am
<br>
<br>


<b> AGRADECEMOS TENER EN CUENTA LAS SIGUIENTES OBSERVACIONES:<br>
	1. FAVOR CONFIRMAR CORREO RECIBIDO<br>
	2. CONFIRMAR DISPONIBILIDAD<br>
	3. CUALQUIER DIFERENCIA DE PRECIOS COMUNICAR DE MANERA INMEDIATA.<br>
           &nbsp; &nbsp; O SE DARA COMO ACEPTADO EL VALOR DE LOS PRECIOS EN LA ORDEN DE COMPRA<br>
        4. CONFIRMAR DESPACHO CON NUMERO DE GUIA<b>,</b> NUMERO DE FACTURA Y ORDEN DE COMPRA<br>
	5. COLOCAR EN LA FACTURA EL NUMERO DE ORDEN DE COMPRA.<br>
	6. ENVIAR CON LOS PRODUCTOS COPIA DE FACTURA Y ORIGINAL POR CORREO CERTIFICADO<br>

	   <br><br>
	   GRACIAS
           !</h2></b>
	   </div>
		<hr style="width: 100%;">
		<div style="width: 50%;font-size: 14px;float: left;">
			CONDICIONES:<br>
			a) Precios Fijos En Pesos<br>
			b) Fecha maxima de entrega  '.$nuevafecha.'<br>
			c) '.$sedex.'
			d) Termino de Pago: 30 Dias<br>
			e)Observaciones: '.$cobserv.'<br>
			<br>
			<br>
			<br>
			<br>
			____________________________<br>
                        Registrado por: '.$nombreuser.'<br>
                        Cel: '.$cel.'<br>

			</div>
			<div style="width: 50%;font-size: 12px;float: right;">
				VALOR SUBTOTAL:         '.number_format($total,2).'<br>
				VR. DESCUENTOS:        0<br>
				VR. IVA                 '.number_format($iva,2).'<br>
				RETENCION               '.number_format($rete,2).'<br>
				VR. ICA                 '.number_format($tica,2).'<br>
				VR. CREE                0.00<br>
				TOTAL ORDEN:          $ '.number_format(($total+$iva-$rete-$tica),2).'<br>
				</div>
		</div>
		</div>
		</div>
	</div>
  </body>
</html>';
$texto = base64_encode($mensaje);
mysqli_query($con,"update orden_compra set enviado=1 where codigo='".$_GET['id']."' ");

include '../../../api/conexion.php';
$cuerpo = $pdf.'<br>'.$_GET['cuerpo'];
mysqli_query($conw,"insert into ordenes (id_orden,mensaje,usuario,correo,asunto,cuerpo) "
        . "values ('".$_GET['id']."','".trim($mensaje)."','".$_SESSION['k_username']."','".htmlspecialchars($_GET['correo'], ENT_QUOTES)."','".$_GET['asunto']."','".$cuerpo."')");
echo mysqli_insert_id($conw);