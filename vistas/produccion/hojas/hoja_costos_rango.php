<?php
include '../../../modelo/conexion_multiple.php';
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
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="shortcut icon" type="image/png" href="../assets/images/warehouse.png"/>
                <script src="../../../js/jquery.min.js"></script>
                <script src="fncfom.js"></script>
                 <style> 
              body {
                font-size: 80%;
              }
              
          </style>
	</head>

        <body style="background: white;"> 
		<?php
                
                $request_ac = mysqli_query($con_duos,"SELECT id_orden FROM virtuald_templadosa.orden_produccion WHERE fecha_registro between '".$_GET['fi']."' and '".$_GET['ff']."' " );

                while($fe=mysqli_fetch_array($request_ac))
                 {
                    $_GET['id'] = $fe[0];
			$info=mysqli_query($con_duos, "SELECT *, a.id_orden FROM virtuald_templadosa.orden_produccion a, virtuald_templadosa.usuarios b, virtuald_templadosa.cont_terceros c WHERE a.generado_user = b.id_user AND a.id_cliente = c.id_ter AND a.id_orden like '%".$_GET['id']."' ");
			$inf=mysqli_fetch_assoc($info);
				$prove=$inf['nom_ter'];
				$idter=$inf['cod_ter'];
				$fecha_hoy=$inf['fecha_registro'];
				$sede=$inf['sede_dir'];
				$precio=$inf['total'];
                                $fom=$inf['opf'];
                                $pedido=$inf['pedido'];
                                $tipofom=$inf['tipofom'];
                                $OPF = $tipofom.str_pad( $fom, 9, "0", STR_PAD_LEFT);
                                $ffom = str_pad( $fom, 9, "0", STR_PAD_LEFT);
                                $cobserv=$inf['observaciones'];
                                $user=$inf['generado_user'];
                                $piva=$inf['PORIVA'];
                                $fecha = date('Y-m-j');
                                $nuevafecha = strtotime ( '+2 day' , strtotime ( $fecha_hoy ) ) ;
                                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                                $usuarios =mysqli_query($con2, "SELECT concat(nombre,' ',apellido) as ali,celular  FROM virtuald_templadosa.usuarios WHERE usuario='".$user."'");
                                $u = mysqli_fetch_array($usuarios);
                                $nombreuser= $u[0];
                                $cel = $u[1];

                                //3014531669
			
		?>
			<div class="main-content">
				<div class="main-content-inner">
				 <div class="container" style="margin-top: 3;font-size: 10px;">
				 	<div style="width: 40%;float: left;">
				 		<b>TEMPLADO S.A</b><br>
				 		<b>HOJA DE COSTOS COMPUESTA A <?php echo date("Y-m-d") ?></b><br>
				 		
				 		<b>PERIODO COMPRENDIDO ENTRE <?php echo $fecha_hoy.' AL '.date("Y-m-d") ?></b><br>
				 		
				 	</div>
				 	<div style="width: 60%;float: right;">
				 		<b>ORDEN </b>
				 		<b style="margin-right: 15%;">No... <?php echo $OPF;?><br>
                                                    
                                                    <b>Tercero. </b>  <?php echo $prove;?><br>
				 		 <b>Observaciones:</b> <?php echo $cobserv;?>
				 	</div>
				 	<div style="width: 100%;font-size: 9px">
				 		<hr style="width: 100%;">
				 		<table id="dynamic-table"  style="width: 100%;font-size: 10px">
							<thead>
                                                            <tr>
                                                                <th colspan="3"></th>
                                                                <th colspan="2">====Cantidad====</th>
                                                                <th colspan="2">====Valor Total====</th>
                                                            </tr>
								<tr>
									<th class="center">Referencia</th>
                                                                        <th class="center">Descripcion Articulo</th>
									<th class="center">Unidad</th>
									<th style="text-align:right">Cantidad</th>
									<th  style="text-align:right">Tarifa</th>
									<th  style="text-align:right">Presupuesto</th>
									<th  style="text-align:right">Consumida</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql=mysqli_query($con_duos, "SELECT *,sum(a.cant_ordenada) as can ,sum(b.precio_item/b.cantidad_c) as pre, sum((a.medida1/1000)*(a.medida2/1000)) as m2  FROM virtuald_templadosa.orden_detalle a, virtuald_templadosa.cotizaciones b, virtuald_templadosa.producto c where a.codigo=".$_GET['id']." and a.parte_otro = 0 AND a.relacionado = b.id_cotizacion AND b.id_referencia = c.id_p group by c.id_p");
								$totalp = 0;
                                                                $idtraz=0;
                                                                $per=0;
                                                                $boq=0;
                                                                $cantidad=0;
                                                                $m2=0;
                                                                $espesor=0;
                                                                $terminadas_totales = 0;
                                                                $tabla_principal='';
                                                                while ($row=mysqli_fetch_assoc($sql)) {
                                                                    //$total += $row['precio']*$row['cantidad'];
                                                                    //consulta de cantidades de dt despachadas
                                                                    $resux = mysqli_query($con_duos,"SELECT count(id_op) FROM virtuald_templadosa.procesos_activos where id_op='".$_GET['id']."' and estado='' ");
                                                                    $r = mysqli_fetch_array($resux);
                                                                    $re = mysqli_error($con2);
                                                                    $terminadas = $r[0];
                                                                    $terminadas_totales += $terminadas;
                                                                    
                                                                    $codigo=$row['codigo'];
                                                                     $totalp +=$row['pre'];
                                                                    
                                                                     $per=$row['per'];
                                                                     $boq=$row['boq'];
                                                                     $cantidad = $row['can'];
                                                                     if($row['linea_cot']=='Vidrio'){
                                                                         $m2 += $row['mtv'];
                                                                          $idtrazvid = $row['id_p'];
                                                                     }else{
                                                                          $idtrazalu = $row['id_p'];
                                                                     }
                                                                     
                                                                     $espesor = $row['medida3'];
                                                                    
                                                                     
                                                                     
									$tabla_principal = $tabla_principal."<tr>";
									$tabla_principal = $tabla_principal.'<td>'.$row['codigo'].'</td>';
                                                                        $tabla_principal = $tabla_principal.'<td>'.$row['producto'].'</td>';
									$tabla_principal = $tabla_principal.'<td><center>Und</center></td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right">'.$row['can'].'</td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right">0.00</td>';
                                                                        $tabla_principal = $tabla_principal.'<td  style="text-align:right">'.number_format($row['pre'],0,',','.').'</td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right">0.00</center></td>';
                                                                        
								        $tabla_principal = $tabla_principal."</tr>";
								}
                                                                echo $tabla_principal;
                                                                ?>
                                                            <tr>
                                                                <td colspan="6">TOTAL PRODUCTOS TERMINADOS: <?php echo number_format($m2,2); ?> Mt2
                                                                    <input type="hidden" value="<?php echo ($cantidad); ?>" id="can"></td>
                                                                <td style="text-align: right">$ <?php echo number_format($total2,2); ?> </td>
                                                            </tr>
                                                            <tr>
                                                            <td colspan="7">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                                                        </tr>
                                                            <tr>
                                                            <td colspan="7">MATERIA PRIMA</td>
                                                        </tr>
                                                        <tr>
									<th class="center">Referencia*</th>
                                                                        <th class="center">Descripcion Articulo</th>
									<th class="center">Unidad</th>
									<th class="center">Cantidad</th>
									<th class="center">Tarifa</th>
									<th class="center">Presupuesto</th>
									<th class="center">Total</th>
								</tr>
                                                        <?php
                                                        
                                                        //echo $con;
                                                            $c = 0;$t = 0;$tr=0;
                                                             $total = 0;
                                                             echo '<tr><td></td>';
                                                                       
                                                                   
                                                            $sql2=mysqli_query($con_duos,"SELECT * FROM aluvmixv2.mov_inventario a, aluvmixv2.mov_detalle b WHERE a.id_mov=b.id_mov and a.id_orden='".$fom."' and a.bod_codigo!='0003' ");
                                                                   $cinv = 0;
                                                            while($row=mysqli_fetch_array($sql2)){
                                                                        $sqlx=mysqli_query($con_duos, "SELECT descripcion,  costo_promedio FROM aluvmixv2.productos_var WHERE codigo='".$row['pro_codigo']."'");
                                                                        $res=mysqli_fetch_assoc($sqlx);
                                                                        $lis=mysqli_query($con_duos, "SELECT SUM(cantidad_mov) FROM aluvmixv2.mov_detalle_ubi WHERE id_ref_mov='".$row['id_ref_mov']."' and codigo_pro='".$row['pro_codigo']."'");
                                                                        $ress=mysqli_fetch_assoc($lis);
                                                                        $resta=intval($row['cantidad']-$ress['SUM(cantidad_mov)']);
                                                                        $send= "'".$row['pro_codigo']."','".trim($row['desc_prod'])."',".$resta.','.$row['id_ref_mov'].','.$row['id_mov'].','.$row['valor_unidad'].','."'".trim($row['color'])."'";
                                                                        $c +=$row['cantidad'];
                                                                        $t +=$row['valor_unidad']*$row['cantidad'];
                                                                        $tr +=$resta;
                                                                        $cinv++;
                                                                        echo '<tr>'.
                                                                                 '<td><center><b>'.$row['pro_codigo'].'</center></td>'.
                                                                                 '<td><b>'.$row['desc_prod'].'</td>'.
                                                                                 '<td><center>'.$row['medida'].'</td>'
                                                                                . '<td style="text-align:right">'.$row['cantidad'].'</td>'.
                                                                                 '<td style="text-align:right">0.00</td>'.
                                                                   
                                                                                 '<td style="text-align:right">'.$resta.'</td>'                                                                 
                                                                               . '<td style="text-align:right">'.number_format($row['valor_unidad']*$row['cantidad'],0,',','.').'</td>'.

                                                                                 '</tr>';
                                                                   }
                                                                   if($cinv==0){
                                                                       echo '<tbody id="mostrar_invfom"><input type="hidden" id="to" value="0"></tbody>';
                                                                   }
                                                                   echo '<tr><td colspan="4">Totales</td>';
                                                        $total +=$t;
                                                        ?>
                                                               <tr>
                                                            <td colspan="7">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                                                        </tr>
                                                             <tr>
                                                            <td colspan="7">MANO DE OBRA VARIABLE </td>
                                                        </tr>
                                                        <?php
                                                                 $sql3=mysqli_query($con_duos,"SELECT sum(((a.medida1/1000)*(a.medida2/1000))*cant_ordenada) as m2,sum((((a.medida1/1000)*2)+((a.medida2/1000))*2)*cant_ordenada) as ml, sum(cant_ordenada) as can FROM virtuald_templadosa.orden_detalle a, virtuald_templadosa.cotizaciones b, virtuald_templadosa.producto c where a.codigo=".$_GET['id']." and a.parte_otro = 0 AND a.relacionado = b.id_cotizacion AND b.id_referencia = c.id_p and a.sede_od='Vidrio' ");
                                                             $fmt=mysqli_fetch_array($sql3);
                                                             $m2 = $fmt[0];
                                                             $cantidad = $fmt[2];
                                                             $ml = $fmt[1];
                                                              $peso = ($m2 * $espesor * 2.5);
                                                                //trazabilidad del producto
                                                                
                                                                $consulta= 'SELECT * FROM virtuald_templadosa.pt_procesos a, virtuald_templadosa.subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$idtrazvid.'"';                     
                                                                $result=  mysqli_query($con_duos,$consulta);
                                                                //$total = 0;
                                                                $stt = 0;     
                                                                $tabla='';
                                                                while($fila=  mysqli_fetch_array($result)){
                                                                $valor1=$fila['id_subpro'];
                                                                $valor2=$fila['nombre_subpro'];
                                                                $precio_a = $fila['precio'];
                                                                $und_med = $fila['medida'];
                                                                $precio_adicional = $fila['precio_adicional'];

                                                                if($valor1==4){
                                                                $pa = $precio_adicional * $per;
                                                                $cp = $per;
                                                                }else{
                                                                    if($valor1==5){
                                                                       $pa = $precio_adicional * $boq;
                                                                       $cp = $boq;
                                                                    }else{
                                                                    $pa = $precio_adicional;
                                                                    $cp = 1;
                                                                    }
                                                                }
                                                                $cod = str_pad( $fila['id_subpro'], 4, "0", STR_PAD_LEFT);
                                                                if($valor1=='7'){
                                                                        $strw = "SELECT * FROM virtuald_templadosa.servicio_temple where espesor='".$espesor."'";
                                                                        $fit =mysqli_fetch_array(mysqli_query($con_duos,$strw));
                                                                        $cost= $fit['costo'];

                                                                    $st = $m2 * $cost;
                                                                     $cod = str_pad( $fila['id_subpro'], 4, "0", STR_PAD_LEFT);
                                                                    echo  '<tr><td>'.$cod.'</td><td>SERVICIO DE TEMPLE x M<sup>2</sup></td>'
                                                                            . '<td><center> KG</center></td>'
                                                                            . '<td style="text-align:right">'.number_format($m2,2).'</td>'
                                                                            . '<td style="text-align:right">$ '.number_format($cost,0,',','.').'</td>'
                                                                            
                                                                            . '<td style="text-align:right">0.00</td>'
                                                                            . '<td style="text-align:right">$ '.number_format($st,0,',','.').'</td></td><td>'
                                                                            . '</tr>';
                                                                }else{ $st = 0;}
                                                                if($und_med=='Kg'){
                                                                    $pat = $peso * $pa;
                                                                    $ti = $peso * $precio_a * $cp;
                                                                    $unidades = 'KG';
                                                                    $unm = $peso;
                                                                    
                                                                }
                                                                if($und_med=='Und'){
                                                                    $pat = $cantidad * $pa;
                                                                    $ti = $cantidad * $precio_a * $cp;
                                                                    $unidades = 'UND';
                                                                    $unm = $cantidad;
                                                                }
                                                                if($und_med=='M2'){
                                                                     $pat = $m2 * $pa;
                                                                    $ti = $m2 * $precio_a * $cp;
                                                                    $unidades = 'M<sup2</sup>';
                                                                    $unm = $m2;
                                                                }
                                                                $total2 += $ti + $pa;
                                                                echo '<tr><td>'.$cod.'</td><td>MANO DE OBRA '.$valor2.' </td>'
                                                                        . '<td><center> '.$unidades.'</center></td>'
                                                                        
                                                                        . '<td  style="text-align:right">'.number_format($unm,0,',','.').'</td>'
                                                                        . '<td align="right">$ '.number_format($precio_a,0,',','.').'</td>'
                                                                        . '<td  style="text-align:right">0.00</td>'
                                                                        . '<td  style="text-align:right">$ '.number_format($ti + $pa,0,',','.').'</td>'
                                                                      
                                                                        . '</tr>';
                                                                
                                                               
                                                               }
                                                               $total +=$total2;
								?>
                                                        <tr>
                                                                <td colspan="6">TOTAL MANO DE OBRA:</td>
                                                                <td style="text-align: right">$ <?php echo number_format($total2,0,',','.'); ?> </td>
                                                            </tr>
                                                        
                                                        
                                                        <tr>
                                                            <td colspan="7">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7">MANO OBRA FIJA </td>
                                                        </tr>
                                                        <?php
                                                            
                                                                //trazabilidad del producto
                                                                
                                                                $consulta4= 'SELECT * FROM virtuald_templadosa.pt_procesos a, virtuald_templadosa.subproceso b, virtuald_templadosa.puestos_relacion c , virtuald_templadosa.puestos d where a.id_subpro=b.id_subpro and b.id_subpro=c.id_area and c.id_puesto=d.id_puesto and d.sede="CALLE 72" AND a.id_proceso="'.$idtrazvid.'"  group by d.id_puesto ';                     
                                                                $result4=  mysqli_query($con_duos,$consulta4);
                                                                //$total = 0;
                                                                $maT = 0;     
                                                                
                                                                while($fila=  mysqli_fetch_array($result4)){
                                                                $valor1=$fila['id_subpro'];
                                                                $valor2=$fila['nombre_subpro'];
                                                                $precio_a = $fila['precio'];
                                                                $und_med = $fila['medida'];
                                                                $precio_adicional = $fila['valmo'];
                                                                if($fila['um1']=='m2'){
                                                                    $undmed = $m2;
                                                                    $precio_t1 = $fila['valmo'] * $undmed;
                                                                }else if($fila['um1']=='ml'){
                                                                    $undmed = $ml;
                                                                    $precio_t1 = $fila['valmo'] * $undmed;
                                                                }else if($fila['um1']=='und'){
                                                                    $undmed = $cantidad;
                                                                    $precio_t1 = $fila['valmo'] * $undmed;
                                                                }else if($fila['um1']=='kg'){
                                                                    $undmed = $peso;
                                                                    $precio_t1 = $fila['valmo'] * $undmed;
                                                                }else{
                                                                    $undmed = $cantidad;
                                                                    $precio_t1 = $fila['valmo'] * $undmed;
                                                                }
                                                                
                                                                $maT += $precio_t1; 

                                                                echo '<tr><td>'.$fila['id_subpro'].'</td><td>'.$fila['nombrepuesto'].'</td>'
                                                                        . '<td><center> '.$fila['um1'].'</center></td>'
                                                                        
                                                                        . '<td  style="text-align:right">'.number_format($undmed,2).'</td>'
                                                                        . '<td align="right">$ '.number_format($fila['valmo'],0,',','.').'</td>'
                                                                        . '<td  style="text-align:right">0.00</td>'
                                                                        . '<td  style="text-align:right">$ '.number_format($precio_t1,0,',','.').'</td>'
                                                                      
                                                                        . '</tr>';
                                                                
                                                               
                                                               }
                                                               $total +=$maT;
								?>
                                                        <tr>
                                                                <td colspan="6">TOTAL MANO DE OBRA FIJA:</td>
                                                                <td style="text-align: right">$ <?php echo number_format($maT,0,',','.'); ?> </td>
                                                            </tr>
                                                        
                                                        
                                                        <tr>
                                                            <td colspan="7">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7">MAQUINARIA FIJA </td>
                                                        </tr>
                                                        <?php
                                                            
                                                                //trazabilidad del producto
                                                                
                                                                $consulta5= 'SELECT * FROM virtuald_templadosa.pt_procesos a, virtuald_templadosa.subproceso b, virtuald_templadosa.puestos_relacion c , virtuald_templadosa.puestos d where a.id_subpro=b.id_subpro and b.id_subpro=c.id_area and c.id_puesto=d.id_puesto and d.sede="CALLE 72" AND a.id_proceso="'.$idtrazvid.'"  group by d.id_puesto  ';                     
                                                                $result5=  mysqli_query($con_duos,$consulta5);
                                                                //$total = 0;
                                                                $maqT = 0;     
                                                                
                                                                while($fila=  mysqli_fetch_array($result5)){
                                                                $valor1=$fila['id_subpro'];
                                                                $valor2=$fila['nombre_subpro'];
                                                                $precio_a = $fila['precio'];
                                                                $und_med = $fila['medida'];
                                                                $precio_adicional = $fila['valmq'];
                                                                if($fila['um1']=='m2'){
                                                                    $undmed = $m2;
                                                                    $precio_t1 = $fila['valmq'] * $undmed;
                                                                }else if($fila['um1']=='ml'){
                                                                    $undmed = $ml;
                                                                    $precio_t1 = $fila['valmq'] * $undmed;
                                                                }else if($fila['um1']=='und'){
                                                                    $undmed = $cantidad;
                                                                    $precio_t1 = $fila['valmq'] * $undmed;
                                                                }else if($fila['um1']=='kg'){
                                                                    $undmed = $peso;
                                                                    $precio_t1 = $fila['valmq'] * $undmed;
                                                                }else{
                                                                    $undmed = $cantidad;
                                                                    $precio_t1 = $fila['valmq'] * $undmed;
                                                                }
                                                                
                                                                $maqT += $precio_t1; 

                                                                echo '<tr><td>'.$fila['id_subpro'].'</td><td>'.$fila['nombrepuesto'].'</td>'
                                                                        . '<td><center> '.$fila['um2'].'</center></td>'
                                                                        
                                                                        . '<td  style="text-align:right">'.number_format($undmed,2).'</td>'
                                                                        . '<td align="right">$ '.number_format($fila['valmq'],0,',','.').'</td>'
                                                                        . '<td  style="text-align:right">0.00</td>'
                                                                        . '<td  style="text-align:right">$ '.number_format($precio_t1,0,',','.').'</td>'
                                                                        . '</tr>';

                                                               }
                                                               $total +=$maqT;
								?>
                                                        <tr>
                                                                <td colspan="6">TOTAL MAQUINARIA FIJA:</td>
                                                                <td style="text-align: right">$ <?php echo number_format($maqT,0,',','.'); ?> </td>
                                                            </tr>
                                                        
                                                        
                                                        <tr>
                                                            <td colspan="7">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7">CIF FIJA <?php echo $idtrazvid ?></td>
                                                        </tr>
                                                        <?php
                                                            
                                                                //trazabilidad del producto
                                                                
                                                                $consulta6= 'SELECT * FROM virtuald_templadosa.pt_procesos a, virtuald_templadosa.subproceso b, virtuald_templadosa.puestos_relacion c , virtuald_templadosa.puestos d where a.id_subpro=b.id_subpro and b.id_subpro=c.id_area and c.id_puesto=d.id_puesto and d.sede="CALLE 72" AND a.id_proceso="'.$idtrazvid.'" group by d.id_puesto ';                     
                                                                $result6=  mysqli_query($con_duos,$consulta6);
                                                                //$total = 0;
                                                                $cifT = 0;     
                                                                
                                                                while($fila=  mysqli_fetch_array($result6)){
                                                                $valor1=$fila['id_subpro'];
                                                                $valor2=$fila['nombre_subpro'];
                                                                $precio_a = $fila['precio'];
                                                                $und_med = $fila['medida'];
                                                                $precio_adicional = $fila['valcif'];
                                                                if($fila['um1']=='m2'){
                                                                    $undmed = $m2;
                                                                    $precio_t1 = $fila['valcif'] * $undmed;
                                                                }else if($fila['um1']=='ml'){
                                                                    $undmed = $ml;
                                                                    $precio_t1 = $fila['valcif'] * $undmed;
                                                                }else if($fila['um1']=='und'){
                                                                    $undmed = $cantidad;
                                                                    $precio_t1 = $fila['valcif'] * $undmed;
                                                                }else if($fila['um1']=='kg'){
                                                                    $undmed = $peso;
                                                                    $precio_t1 = $fila['valcif'] * $undmed;
                                                                }else{
                                                                    $undmed = $cantidad;
                                                                    $precio_t1 = $fila['valcif'] * $undmed;
                                                                }
                                                                
                                                                $cifT += $precio_t1; 

                                                                echo '<tr><td>'.$fila['id_subpro'].'</td><td>'.$fila['nombrepuesto'].'</td>'
                                                                        . '<td><center> '.$fila['um2'].'</center></td>'
                                                                        
                                                                        . '<td  style="text-align:right">'.number_format($undmed,0,',','.').'</td>'
                                                                        . '<td align="right">$ '.number_format($fila['valcif'],0,',','.').'</td>'
                                                                        . '<td  style="text-align:right">0.00</td>'
                                                                        . '<td  style="text-align:right">$ '.number_format($precio_t1,0,',','.').'</td>'
                                                                      
                                                                        . '</tr>';
                                                                
                                                               
                                                               }
                                                               $total +=$cifT;
								?>
                                                        <tr>
                                                                <td colspan="6">TOTAL CIF:</td>
                                                                <td style="text-align: right">$ <?php echo number_format($cifT,0,',','.'); ?> </td>
                                                            </tr>
                                                        
                                                        
                                                         <tr>
                                                            <td colspan="7">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                                                        </tr>
							</tbody>
                                                        
						
						
						
                                                <?php
                                                $iva = $total * ($piva/100);
                                                
                                                ?>
					
                                                            <tr>
                                                                <td colspan="6">VALOR ORDEN DE PRODUCCION No. <?php echo $OPF ?>:</td>
                                                                <td style="text-align: right"><?php echo number_format($total,0,',','.'); ?> 
                                                                <input type="hidden" id="tofinal" value="<?php echo $total; ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6">VALOR GENERAL:</td>
                                                                <td style="text-align: right" id="tt">$ <?php echo number_format($total,2); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6">COSTO DE PRODUCCION X UNIDAD :</td>
                                                                <td style="text-align: right" id="ttu">$ <?php echo number_format(($total/$cantidad),2); ?></td>
                                                            </tr>
                                                           
                                                           
                                                        </table>
						</div>
				 	</div>
				</div>
			</div>
		</div>
 
<script type="text/javascript">
$(function(){
    cargarinvfom('<?php echo $ffom ?>');
});

 		</script>
                
                 <?php } ?>
  </body>
</html>
