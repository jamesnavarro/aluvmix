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
                <script src="fncfom_presupuestado.js?v=1.6"></script>
                 <style> 
              body {
                font-size: 80%;
              }
              
          </style>
	</head>

        <body style="background: white;"> 
		<?php
			$info=mysqli_query($con_duos, "SELECT *, a.id_orden FROM virtuald_templadosa.orden_produccion a, virtuald_templadosa.usuarios b, virtuald_templadosa.cont_terceros c WHERE a.generado_user = b.id_user AND a.id_cliente = c.id_ter AND a.id_orden = '".$_GET['id']."' ");
			
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
                                 $OPFC = str_pad( $fom, 9, "0", STR_PAD_LEFT);
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
                                if($tipofom==6){
                                    $sede = 'GALAPA';
                                }else{
                                    $sede = 'CALLE 72';
                                }
?>
          

			<div class="main-content">
				<div class="main-content-inner">
				 <div class="container" style="margin-top: 3;font-size: 10px;">
                                     <center><b>---------HOJA DE COSTO PRESUPUESTOS---------</b></center>
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
									<th class="center" style="text-align:right">Cantidad</th>
									<th class="center" style="text-align:right"></th>
									<th class="center" style="text-align:right">Und</th>
									<th class="center" style="text-align:right">Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                                                if(isset($_GET['item'])){
                                                                    $consulta_items = " and relacionado='".$_GET['item']."' ";
                                                                }else{
                                                                    $consulta_items = '';
                                                                }
								$sql=mysqli_query($con_duos, "SELECT *,sum(a.cant_ordenada) as can ,sum(b.precio_item/b.cantidad_c) as pre, sum((a.medida1/1000)*(a.medida2/1000)*cant_ordenada) as m2, sum(b.cantidad_c) as cantidad_general  FROM virtuald_templadosa.orden_detalle a, virtuald_templadosa.cotizaciones b, virtuald_templadosa.producto c where a.codigo=".$_GET['id']." and a.parte_otro = 0 AND a.relacionado = b.id_cotizacion AND b.id_referencia = c.id_p $consulta_items group by c.id_p");
								$totalp = 0;
                                                                $idtraz=0;
                                                                $per=0;
                                                                $boq=0;
                                                                $cantidad=0;
                                                                $m2=0;
                                                                $espesor=0;
                                                                $terminadas_totales = 0;
                                                                $tabla_principal='';
                                                                $id_cot = 0;
                                                                $id_items = 0;
                                                                $cantidad_general = 0;
                                                                $can_real = 0;
                                                                $cantidad_ordenada=0;
                                                                $medida_general = '';
                                                                $color_aluminio='';
                                                                while ($row=mysqli_fetch_assoc($sql)) {
                                                                    //$total += $row['precio']*$row['cantidad'];
                                                                    //consulta de cantidades de dt despachadas
                                                                    $resux = mysqli_query($con_duos,"SELECT count(id_op) FROM virtuald_templadosa.procesos_activos where id_op='".$_GET['id']."' and estado='' ");
                                                                    $r = mysqli_fetch_array($resux);
                                                                    $re = mysqli_error($con2);
                                                                    $terminadas = $r[0];
                                                                    $terminadas_totales += $terminadas;
                                                                    
                                                                    $codigo=$row['codigo'];
                                                                    $totalp +=$row['precio_item'];
                                                                    $id_cot = $row['id_cot'];
                                                                    $id_items = $row['relacionado'];
                                                                    $color_aluminio = $row['color_ta'];
                                                                    
                                                                    
                                                                     $per=$row['per'];
                                                                     $boq=$row['boq'];
                                                                     $cantidad = $row['can'];
                                                                     $cantidad_general = $row['cantidad_general'];
                                                                     
                                                                     $can_real = $cantidad_general / $cantidad;
                                                                     $cantidad_ordenada = $row['can'];
                                                                     if($row['linea_cot']=='Vidrio'){
                                                                         $m2 += $row['m2'];
                                                                          $idtrazvid = $row['id_p'];
                                                                     }else{
                                                                          $idtrazvid = $row['id_p'];
                                                                     }
                                                                     
                                                                     $espesor = $row['medida3'];
                                                                    
                                                                     $medida_general = $row['ancho_c'].'X'.$row['alto_c'];
                                                                     
									$tabla_principal = $tabla_principal."<tr>";
									$tabla_principal = $tabla_principal.'<td>'.$row['codigo'].'</td>';
                                                                        $tabla_principal = $tabla_principal.'<td>'.$row['producto'].' (<span id="sc"></span> de '.$cantidad_general.') '.$medida_general.'</td>';
									$tabla_principal = $tabla_principal.'<td><center>Und</center><input type="hidden" id="canop" value="'.$row['can'].'"></td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right" id="canopf"></td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right"><input type="hidden" id="valorop"></td>';
                                                                        $tabla_principal = $tabla_principal.'<td  style="text-align:right" id="vlropund"></td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right" id="vlrop">0.00</center></td>';
                                                                        
								        $tabla_principal = $tabla_principal."</tr>";
								}
                                                                 $sql2=mysqli_query($con_duos, "SELECT *,sum(a.cant_ordenada) as can ,sum(b.precio_item/b.cantidad_c) as pre, sum((a.medida1/1000)*(a.medida2/1000)) as m2  FROM virtuald_templadosa.orden_detalle a, virtuald_templadosa.cotizaciones b, virtuald_templadosa.producto c where a.codigo=".$_GET['id']." and a.parte_otro = 1 AND a.relacionado = b.id_cotizacion AND b.id_referencia = c.id_p $consulta_items group by c.id_p");
								$totalp2 = 0;
                                                                $idtraz2=0;
                                                                $per2=0;
                                                                $boq2=0;
                                                                $cantidad2=0;
                                                                $m22=0;$mt22=0;
                                                                $espesor2=0;
                                                                $terminadas_totales2 = 0;
                                                               
                                                              
                                                                while ($row=mysqli_fetch_assoc($sql2)) {
                                                                    //$total += $row['precio']*$row['cantidad'];
                                                                    //consulta de cantidades de dt despachadas
                                                                    $resux = mysqli_query($con_duos,"SELECT producto FROM virtuald_templadosa.producto where id_p='".$row['traz_vid']."'  ");
                                                                    $r = mysqli_fetch_array($resux);
                                                                    $re = mysqli_error($con2);
                                                                    $producto_vidrio = $r[0];
                                                                    
                                                                    $resux2 = mysqli_query($con_duos,"SELECT sum(((medida1/1000)*(medida2/1000))*cant_ordenada) as m2,sum(cant_ordenada) as ct FROM virtuald_templadosa.orden_detalle where parte_otro=1 and codigo=".$_GET['id']." $consulta_items ");
                                                                     $m = mysqli_fetch_array($resux2);
                                                            
                                                                    
                                                                    $codigo=$row['codigo'];
                                                                     //$totalp +=$row['precio_item'];
                                                                    
                                                                     
                                                                     
                                                                     $vidrio1 = $row['traz_vid'];
                                                                     $vidrio2 = $row['traz_vid'];
                                                                     $espesor = $row['medida3'];
                                                                    
                                                                     $mt22 += $m[0];
                                                                     
									$tabla_principal = $tabla_principal."<tr>";
									$tabla_principal = $tabla_principal.'<td>'.$row['codigo'].'*</td>';
                                                                        $tabla_principal = $tabla_principal.'<td>'.$producto_vidrio.' '.$row['color'].' x <span id="csv"></span> </td>';
									$tabla_principal = $tabla_principal.'<td><center>M2</center></td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right">'.number_format($m[0],2).'</td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right">0.00</td>';
                                                                        $tabla_principal = $tabla_principal.'<td  style="text-align:right">0.00</td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right">0.00</center></td>';
                                                                        
								        $tabla_principal = $tabla_principal."</tr>";
								}
                                                        
                                                                if($mt22==0){
                                                                    $m2 = ($m2);
                                                                }else{
                                                                    $m2 = ($mt22);
                                                                }
                                                                echo $tabla_principal;
                                                                $result_cotizaciones = mysqli_query($con_duos,"SELECT relacionado, medida1,medida2,cant_ordenada FROM virtuald_templadosa.orden_detalle where codigo=".$_GET['id']." and parte_otro = 0");
                                                        $id_items2 = '';$id_items3 = '';
                                                        while($it = mysqli_fetch_array($result_cotizaciones)){
                                                            $id_items3 = $id_items3.'<a href="?id='.$_GET['id'].'&item='.$it[0].'" target="_blank">'.$it[0].'</a>,';
                                                            $id_items2 = $id_items2.$it[0].',';
                                                        }
                                                        if(isset($_GET['item'])){
                                                             $id_items = $_GET['item'];
                                                             $opgeneral = 'No';
                                                        }else{
                                                             $id_items = substr($id_items2,0,-1);
                                                             $opgeneral = 'Si';
                                                        }
                                                       
                                                         $link = substr($id_items3,0,-1);
                                                                ?>
                                                            <tr>
                                                                <td colspan="6">TOTAL PRODUCTOS TERMINADOS: <?php echo ($m2); ?> Mt2
                                                                    <input type="hidden" value="<?php echo ($cantidad); ?>" id="can"></td>
                                                                <td style="text-align: right">$ <?php echo number_format($total2,2); ?> </td>
                                                            </tr>
                                                            <tr>
                                                            <td colspan="7">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                                                        </tr>
                                                         <script>                                                   
                                                        consultarvalorop('<?php echo $tipofom ?>','<?php echo $OPFC ?>','<?php echo $cantidad_ordenada ?>','<?php echo $medida_general ?>','<?php echo $opgeneral ?>');
                                                        </script>
                                                        <input type="text" id="id_items" value="<?php echo $id_items ?>">
                                                        <input type="text" id="id_cot" value="<?php echo $id_cot ?>">
                                                        <input type="text" id="cg" value="<?php echo $cantidad_general ?>">
                                                        <input type="text" id="idtrazvid" value="<?php echo $idtrazvid ?>">
                                                            <tr>
                                                            <td colspan="7">MATERIA PRIMA <?php echo $link ?></td>
                                                        </tr>
                                                        <tr>
									<th class="center">Referencia*</th>
                                                                        <th class="center">Descripcion Articulo</th>
									<th class="center">Unidad</th>
									<th class="center" style="text-align:right">Cantidad</th>
									<th class="center" style="text-align:right">Tarifa</th>
									<th class="center" style="text-align:right">Presupuesto</th>
									<th class="center" style="text-align:right">Total</th>
								</tr>
                                                                <tbody id="materia_prima">
                                                                    
                                                                </tbody>
                                                        
                                                        
                                                          <tr>
                                                            <td colspan="7">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                                                        </tr>
                                                             <tr>
                                                            <td colspan="7">MANO DE OBRA VARIABLE <?php echo $id_items ?></td>
                                                        </tr>
                                                        <?php
                                                                 $sql3=mysqli_query($con_duos,"SELECT sum(((a.medida1/1000)*(a.medida2/1000))*cant_ordenada) as m2,sum((((a.medida1/1000)*2)+((a.medida2/1000))*2)*cant_ordenada) as ml, sum(cant_ordenada) as can FROM virtuald_templadosa.orden_detalle a, virtuald_templadosa.cotizaciones b, virtuald_templadosa.producto c where a.codigo=".$_GET['id']." and a.parte_otro = 0 AND a.relacionado = b.id_cotizacion AND b.id_referencia = c.id_p and b.id_cotizacion in ($id_items) ");
                                                             $fmt=mysqli_fetch_array($sql3);
                                                             $m2 = $fmt[0];
                                                             
                                                             if($sede=='GALAPA'){
                                                                 $cantidad = $cantidad;
                                                             }else{
                                                                 $cantidad = $fmt[2];
                                                             }
                                                             
                                                             $ml = $fmt[1];
                                                             $sql4=mysqli_query($con_duos,"SELECT sum(((a.medida1/1000)*(a.medida2/1000))*cant_ordenada) as m2,sum((((a.medida1/1000)*2)+((a.medida2/1000))*2)*cant_ordenada) as ml, sum(cant_ordenada) as can FROM virtuald_templadosa.orden_detalle a, virtuald_templadosa.cotizaciones b, virtuald_templadosa.producto c where a.codigo=".$_GET['id']." and a.parte_otro = 1 AND a.relacionado = b.id_cotizacion AND b.id_referencia = c.id_p and b.id_cotizacion in ($id_items) ");// se quito al final  and a.sede_od='$sede'
                                                             $fmt4=mysqli_fetch_array($sql4);
                                                             $metro_lineal = $fmt4[1];
                                                             
                                                             if($mt22==0){
                                                                    $m2 = $m2;
                                                                }else{
                                                                    $m2 = $mt22;
                                                                }
                                                                
                                                              $peso = ($m2 * $espesor * 2.5);
                                                                //trazabilidad del producto
                                                                
                                                                $consulta= 'SELECT * FROM virtuald_templadosa.pt_procesos a, virtuald_templadosa.subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso  in ("'.$idtrazvid.'","'.$vidrio1.'","'.$vidrio2.'")  ';                     
                                                                $result=  mysqli_query($con_duos,$consulta);
                                                                //$total = 0;
                                                                $stt = 0;     
                                                                $tabla='';
                                                                while($fila=  mysqli_fetch_array($result)){
                                                                $valor1=$fila['id_subpro'];
                                                                $valor2=$fila['nombre_subpro'];
                                                                //$precio_a = $fila['precio'];
                                                                $und_med = $fila['medida'];
                                                                $precio_adicional = $fila['precio_adicional'];
                                                                
                                                                 if($fila['id_subpro']=='16'){
                                                                    $consulta4= 'SELECT valor_mo, descripcion_mo FROM virtuald_templadosa.referencia_mo a, virtuald_templadosa.producto_rep_mo b where a.id_ref_mo=b.id_ref_mo and id_p='.$idtrazvid.' and instalacion="No"  ';                     
                                                                    $resx=  mysqli_query($con_duos,$consulta4);
                                                                    $prc = mysqli_fetch_array($resx);
                                                                    $precio_a = $prc['valor_mo'];
                                                                    $descrip = $prc['descripcion_mo'];
                                                                }else{
                                                                    $precio_a = $fila['precio'];
                                                                     $descrip = 'Mano de obra'.$valor2;
                                                                }

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
//                                                                        $strw = "SELECT * FROM virtuald_templadosa.servicio_temple where espesor='".$espesor."'";
//                                                                        $fit =mysqli_fetch_array(mysqli_query($con_duos,$strw));
//                                                                        $cost= $fit['costo'];
//
//                                                                    $st = $m2 * $cost;
//                                                                    $total2 += $st;
//                                                                     $cod = str_pad( $fila['id_subpro'], 4, "0", STR_PAD_LEFT);
//                                                                    echo  '<tr><td>'.$cod.'</td><td>SERVICIO DE TEMPLE x M<sup>2</sup></td>'
//                                                                            . '<td><center> M<sup>2</center></td>'
//                                                                            . '<td style="text-align:right">'.number_format($m2,2).'</td>'
//                                                                            . '<td style="text-align:right">$ '.number_format($cost,0,',','.').'</td>'
//                                                                            
//                                                                            . '<td style="text-align:right">0.00</td>'
//                                                                            . '<td style="text-align:right">$ '.number_format($st,0,',','.').'</td></td><td>'
//                                                                            . '</tr>';
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
                                                                $rtt = $ti + $pa;
                                                                
                                                                if($rtt!='0'){
                                                               
                                                                echo '<tr><td>'.$cod.'</td><td>'.$descrip.' </td>'
                                                                        . '<td><center> '.$unidades.'</center></td>'
                                                                        
                                                                        . '<td  style="text-align:right">'.number_format($unm,0,',','.').'</td>'
                                                                        . '<td align="right">$ '.number_format($precio_a,0,',','.').'</td>'
                                                                        . '<td  style="text-align:right">0.00</td>'
                                                                        . '<td  style="text-align:right">$ '.number_format($ti + $pa,0,',','.').'</td>'
                                                                      
                                                                        . '</tr>';
                                                             
                                                                }
                                                               
                                                               }
                                                               
                                                               $consulta_instalacion= mysqli_query($con_duos,'SELECT * FROM virtuald_templadosa.referencia_mo a, virtuald_templadosa.producto_rep_mo b where a.id_ref_mo=b.id_ref_mo and id_p='.$idtrazvid.' and instalacion="Si"  ');                     
                                                                   
                                                                    while($prc = mysqli_fetch_array($consulta_instalacion)){
                                                                        $precio_a = $prc['valor_mo'];
                                                                        $descrip = $prc['descripcion_mo'];
                                                                        
                                                                         $total2 += $pat;
                                                                          if($prc['unidad_cobro']=='Und'){
                                                                           
                                                                                $ti = $cantidad * $precio_a;
                                                                                $unidades = 'UND';
                                                                                $unm = $cantidad;
                                                                            }
                                                                            if($prc['unidad_cobro']=='M2'){
                                                                              
                                                                                 $ti = $m2 * $precio_a;
                                                                                 $unidades = 'M<sup2</sup>';
                                                                                 $unm = $m2;
                                                                            }
                                                                        echo '<tr><td>'.$prc['referencia'].'</td><td>'.$descrip.' </td>'
                                                                        . '<td><center> '.$prc['unidad_cobro'].'</center></td>'
                                                                        
                                                                        . '<td  style="text-align:right">'.number_format($unm,0,',','.').'</td>'
                                                                        . '<td align="right">$ '.number_format($precio_a,0,',','.').'</td>'
                                                                        . '<td  style="text-align:right">0.00</td>'
                                                                        . '<td  style="text-align:right">$ '.number_format($ti,0,',','.').'</td>'
                                                                      
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
                                                                
                                                                $consulta4= 'SELECT * FROM virtuald_templadosa.pt_procesos a, virtuald_templadosa.subproceso b, virtuald_templadosa.puestos_relacion c , virtuald_templadosa.puestos d where a.id_subpro=b.id_subpro and b.id_subpro=c.id_area and c.id_puesto=d.id_puesto and d.sede="'.$sede.'" AND a.id_proceso  in ("'.$idtrazvid.'","'.$vidrio1.'","'.$vidrio2.'")   group by d.id_puesto ';                     
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
                                                                    if($metro_lineal==0){
                                                                        $undmed = $ml;
                                                                    }else{
                                                                       $undmed = $metro_lineal; 
                                                                    }
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
                                                                
                                                                $consulta5= 'SELECT * FROM virtuald_templadosa.pt_procesos a, virtuald_templadosa.subproceso b, virtuald_templadosa.puestos_relacion c , virtuald_templadosa.puestos d where a.id_subpro=b.id_subpro and b.id_subpro=c.id_area and c.id_puesto=d.id_puesto and d.sede="'.$sede.'" AND a.id_proceso  in ("'.$idtrazvid.'","'.$vidrio1.'","'.$vidrio2.'")   group by d.id_puesto  ';                     
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
                                                            <td colspan="7">CIF FIJA</td>
                                                        </tr>
                                                        <?php
                                                            
                                                                //trazabilidad del producto
                                                                
                                                                $consulta6= 'SELECT * FROM virtuald_templadosa.pt_procesos a, virtuald_templadosa.subproceso b, virtuald_templadosa.puestos_relacion c , virtuald_templadosa.puestos d where a.id_subpro=b.id_subpro and b.id_subpro=c.id_area and c.id_puesto=d.id_puesto and d.sede="'.$sede.'" AND a.id_proceso  in ("'.$idtrazvid.'","'.$vidrio1.'","'.$vidrio2.'")   group by d.id_puesto ';                     
                                                                $result6=  mysqli_query($con_duos,$consulta6);
                                                                //$total = 0;
                                                                $cifT = 0;     
                                                                
                                                                while($fila=  mysqli_fetch_array($result6)){
                                                                $valor1=$fila['id_subpro'];
                                                                $valor2=$fila['nombre_subpro'];
                                                                $precio_a = $fila['precio'];
                                                                $und_med = $fila['medida'];
                                                                $precio_adicional = $fila['valcif'];
                                                                if($fila['um3']=='m2'){
                                                                    $undmed = $m2;
                                                                    $precio_t1 = $fila['valcif'] * $undmed;
                                                                }else if($fila['um3']=='ml'){
                                                                    $undmed = $ml;
                                                                    $precio_t1 = $fila['valcif'] * $undmed;
                                                                }else if($fila['um3']=='und'){
                                                                    $undmed = $cantidad;
                                                                    $precio_t1 = $fila['valcif'] * $undmed;
                                                                }else if($fila['um3']=='kg'){
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
                                                               $consulta7= mysqli_query($con_duos,'SELECT * FROM virtuald_templadosa.puestos where sede="'.$sede.'" AND id_puesto in (20) ');                     
                                                                $re= mysqli_fetch_array($consulta7);
                                                                $precio_t1 = $m2 * $re['valcif'];
                                                                $cifT += $precio_t1; 
                                                                echo '<tr><td>1111</td><td>'.$re['nombrepuesto'].'</td>'
                                                                        . '<td><center> '.$re['um3'].'</center></td>'
                                                                        
                                                                        . '<td  style="text-align:right">'.number_format($m2,2,',','.').'</td>'
                                                                        . '<td align="right">$ '.number_format($re['valcif'],0,',','.').'</td>'
                                                                        . '<td  style="text-align:right">0.00</td>'
                                                                        . '<td  style="text-align:right">$ '.number_format($precio_t1,0,',','.').'</td>'
                                                                      
                                                                        . '</tr>';
                                                               
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
                                                                <td colspan="6">TOTAL COSTO PRODUCCION OP No. <?php echo $OPF ?>:</td>
                                                                <td style="text-align: right">$<?php echo number_format($total,0,',','.'); ?> 
                                                                    <input type="hidden" value="<?php echo $total; ?>" id="total">
                                                                <input type="hidden" id="tofinal" value="<?php echo $total; ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6">UTILIDAD OPERACIONAL:</td>
                                                                <td style="text-align: right" id="utix"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6">COSTO DE PRODUCCION X UNIDAD :</td>
                                                                <td style="text-align: right" id="ttu"></td>
                                                            </tr>
                                                            
                                                            
                                                           
                                                           
                                                        </table>
						</div>
				 	</div>
				</div>
			</div>
		</div>
             
<script type="text/javascript">
$(function(){
    //cargarinvfom2('<?php echo $id_cot ?>','<?php echo $id_items ?>','<?php echo $cantidad ?>','<?php echo $can_gen ?>');
});

 		</script>
  </body>
</html>
