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
     
                <script src="fncfom.js?<?php echo rand(1,100) ?>"></script>
                 <style> 
              body {
                font-size: 80%;
              }
              
          </style>
	</head>

        <body style="background: white;"> 
		<?php
                
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
                                $OPFC = str_pad( $fom, 9, "0", STR_PAD_LEFT);
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

                                //3014531669
			
		?>
            <script>                                                   
            consultarvalorop('<?php echo $tipofom ?>','<?php echo $OPFC ?>');
            </script>
			<div class="main-content">
				<div class="main-content-inner">
				 <div class="container" style="margin-top: 3;font-size: 10px;">
                                     <center><b>---------PRESUPUESTOS vs CONSUMIDAS---------</b></center>
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
                                                                <th colspan="2"></th>
                                                                <th colspan="2">====Cantidad====</th>
                                                                <th colspan="3">====Valor Total====</th>
                                                            </tr>
								<tr>
									<th class="center">Referencia</th>
                                                                        <th class="center">Descripcion Articulo</th>
									<th class="center">Unidad</th>
									<th class="center" style="text-align:right">Cantidad</th>
									
									<th class="center" style="text-align:right">Vlr Und</th>
                                                                        <th class="center" style="text-align:right"></th>
									<th class="center" style="text-align:right">Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql=mysqli_query($con_duos, "SELECT *,sum(a.cant_ordenada) as can ,sum(b.precio_item/b.cantidad_c) as pre, sum((a.medida1/1000)*(a.medida2/1000)*cant_ordenada) as m2, sum(b.cantidad_c) as cantidad_general  FROM virtuald_templadosa.orden_detalle a, virtuald_templadosa.cotizaciones b, virtuald_templadosa.producto c where a.codigo=".$_GET['id']." and a.parte_otro = 0 AND a.relacionado = b.id_cotizacion AND b.id_referencia = c.id_p group by c.id_p");
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
                                                                    
                                                                    
                                                                     $per=$row['per'];
                                                                     $boq=$row['boq'];
                                                                     $cantidad = $row['can'];
                                                                     $cantidad_general = $row['cantidad_general'];
                                                                     
                                                                     $can_real = $cantidad_general / $cantidad;
                                                                     if($row['linea_cot']=='Vidrio'){
                                                                         $m2 += $row['m2'];
                                                                          $idtrazvid = $row['id_p'];
                                                                     }else{
                                                                          $idtrazvid = $row['id_p'];
                                                                     }
                                                                     
                                                                     $espesor = $row['medida3'];
                                                                    
                                                                     
                                                                     
									$tabla_principal = $tabla_principal."<tr>";
									$tabla_principal = $tabla_principal.'<td>'.$row['codigo'].'</td>';
                                                                        $tabla_principal = $tabla_principal.'<td>'.$row['producto'].' ('.$row['can'].' de '.$cantidad_general.')</td>';
									$tabla_principal = $tabla_principal.'<td><center>Und</center></td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:center">'.$row['can'].'</td>';
                                                                        
                                                                        $tabla_principal = $tabla_principal.'<td  style="text-align:right" id="vlropund"></td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right"></td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right" id="vlrop"></td>';
                                                                        
								        $tabla_principal = $tabla_principal."</tr>";
								}
                                                                 $sql2=mysqli_query($con_duos, "SELECT *,sum(a.cant_ordenada) as can ,sum(b.precio_item/b.cantidad_c) as pre, sum((a.medida1/1000)*(a.medida2/1000)) as m2  FROM virtuald_templadosa.orden_detalle a, virtuald_templadosa.cotizaciones b, virtuald_templadosa.producto c where a.codigo=".$_GET['id']." and a.parte_otro = 1 AND a.relacionado = b.id_cotizacion AND b.id_referencia = c.id_p group by c.id_p");
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
                                                                    
                                                                    $resux2 = mysqli_query($con_duos,"SELECT sum(((medida1/1000)*(medida2/1000))*cant_ordenada) as m2,sum(cant_ordenada) as ct FROM virtuald_templadosa.orden_detalle where parte_otro=1 and codigo=".$_GET['id']." ");
                                                                     $m = mysqli_fetch_array($resux2);
                                                            
                                                                    
                                                                    $codigo=$row['codigo'];
                                                                     //$totalp +=$row['precio_item'];
                                                                    
                                                                     
                                                                     
                                                                     $vidrio1 = $row['traz_vid'];
                                                                     $vidrio2 = $row['traz_vid'];
                                                                     $espesor = $row['medida3'];
                                                                    
                                                                     $mt22 += $m[0];
                                                                     
									$tabla_principal = $tabla_principal."<tr>";
									$tabla_principal = $tabla_principal.'<td>'.$row['codigo'].'*</td>';
                                                                        $tabla_principal = $tabla_principal.'<td>'.$producto_vidrio.' '.$row['color'].' x '.$row['can'].' </td>';
									$tabla_principal = $tabla_principal.'<td><center>M2</center></td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right">'.number_format($m[0],2).'</td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right">0.00</td>';
                                                                        $tabla_principal = $tabla_principal.'<td  style="text-align:right">0.00</td>';
                                                                        $tabla_principal = $tabla_principal.'<td style="text-align:right">0.00</center></td>';
                                                                        
								        $tabla_principal = $tabla_principal."</tr>";
								}
                                                        
                                                                if($mt22==0){
                                                                    $m2 = $m2;
                                                                }else{
                                                                    $m2 = $mt22;
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
                                                        </table>
                                                <?php
                                                //consultar items 
                                                        $result_cotizaciones = mysqli_query($con_duos,"SELECT relacionado, medida1,medida2,cant_ordenada FROM virtuald_templadosa.orden_detalle where codigo=".$_GET['id']." and parte_otro = 0");
                                                        $id_items2 = '';
                                                        while($it = mysqli_fetch_array($result_cotizaciones)){
                                                            $id_items2 = $id_items2.$it[0].',';
                                                        }
                                                
                                                ?>
                                                <table id="dynamic-table"  style="width: 100%;font-size: 10px">
                                                            <tr>
                                                                <td colspan="7">MATERIA PRIMA <?php echo $id_cot.' '.substr($id_items2,0,-1) ?></td>
                                                        </tr>
                                                        <tr>
									<th class="center">Referencia*</th>
                                                                        <th class="center">Descripcion Articulo</th>
									<th class="center">Unidad</th>
									<th class="center" style="text-align:right">Cant Pre.</th>
									<th class="center" style="text-align:right">Cant Cons</th>
									<th class="center" style="text-align:right">Dife</th>
                                                                        <th class="center" style="text-align:right">Med.Diferente</th>
                                                                        <th class="center" style="text-align:right">Cons</th>
									<th class="center" style="text-align:right">Dife</th>
									
								</tr>
                                                        <?php
                                                        
                                                        
                                                        //echo $con;
                                                        //formatear id_items 
                                                        $id_items = substr($id_items2,0,-1);
                                                            $c = 0;$t = 0;$tr=0;
                                                             $total = 0;
                                                            $reques=mysqli_query($con_duos,"SELECT *,sum(cantidad) as canacc, sum(canperfil) as canper FROM virtuald_templadosa.desgloses_material a, virtuald_templadosa.referencias b where a.codigo_pro=b.codigo and id_cot=".$id_cot." and id_cot_item in (".$id_items.") group by a.codigo_pro ");
                                                            $contador=0;
                                                            $tott = 0;
                                                            
                                                            while($row=mysqli_fetch_array($reques)){
                                                                $c++;
                                                                 

                                                                if($row['linea']=='Perfileria'){
                                                                    $medres = mysqli_query($con_duos,"select sum(medida*cantidad) as med from virtuald_templadosa.desgloses_material where id_cot='".$id_cot."' and referencia='".$row['referencia']."' and perfil='".$row['perfil']."' ");
                                                                    $md = mysqli_fetch_array($medres);

                                                                     $medtotal = $md['med'];
                                                                     $canper = $md['med']/($row['perfil']-100);
                     
                                                                    $canti = ceil($canper);
                                                                    $unidad = $row['perfil'];
                                                                    
                                                                    $ct = ($canti * $cantidad)/$cantidad_general;
                                                                    $tot = ($unidad/1000)*$ct*$row['costo_mt'];
                                                                    
                                                                    if($row['color']=='01'){
                                                                        $crudo = 'ANONIZADO';
                                                                        $codcolor = '01';
                                                                    }else{
                                                                        $crudo = 'CRUDO';
                                                                        $codcolor = '00';
                                                                    }
                                                                    $ref = $row['referencia'];
                                                                   $codigo = $ref.'-'.$codcolor.substr($row['perfil'],0,2);
                                                                   $descripcion = substr($row['descripcion'],0,-6) .' '.$row['perfil'];
                                                                
                                                                }else{
                                                                     $canti = $row['canacc'];
                                                                     $unidad = $row['und_medida'];
                                                                     $ct = ($canti * $cantidad)/$cantidad_general;
                                                                      $tot = $ct*$row['costo_mt'];
                                                                      $codigo = $row['codigo_pro'];
                                                                      $descripcion = $row['descripcion'];
                                                                }
                                                                
                                                                
                                                                $canti_pedida = $canti / $can_real;
                                                                //$tot = $canti_pedida * $row['costo_mt'];
                                                                $tott += $tot;
                                                                 

                                                                echo '<tr>'
                                                                        . '<td>'.$codigo.'</td>'
                                                                        . '<td>'.$descripcion.' Ref.'.$row['referencia'].'</td>'
                                                                        . '<td>'.$unidad.'</td>'
                                                                        . '<td style="text-align:right"><input type="hidden" id="can'.$codigo.'" value="'.$canti_pedida.'">'.$canti_pedida.'</td>'
                                                                        . '<td style="text-align:right" id="cons'.$codigo.'"></td>'
                                                                        . '<td style="text-align:right" id="dif'.$codigo.'"></td>'
                                                                        . '<td style="text-align:right" id="ref'.$codigo.'"></td>'
                                                                        . '<td style="text-align:right" id="cons2'.$codigo.'"></td>'
                                                                        . '<td style="text-align:right" id="dif2'.$codigo.'"></td>';
                                                                ?>
                                                                <script>
                                                                    
                                                                    cargarinvfomxreferencia('<?php echo $ffom ?>','<?php echo $codigo ?>','<?php echo $row['referencia'] ?>','<?php echo $row['linea'] ?>');
                                                                    </script>
                                                                <?php

                                                             }
                                                             
                                                             $requesv=mysqli_query($con_duos,"SELECT id_op,color, sum((medida1/1000)*(medida2/1000)*cant_ordenada) as mt2 FROM virtuald_templadosa.orden_detalle WHERE codigo=".$_GET['id']."  ");
                                              
                                                            $tottvid = 0;
                                                            while($row=mysqli_fetch_array($requesv)){
                                                                
                                                                $resvid = mysqli_query($con_duos,"SELECT costo_v,codigo_vid FROM virtuald_templadosa.tipo_vidrio where color_v = '".$row['color']."' ");
                                                                $cv =mysqli_fetch_array($resvid);
                                                                
                                                                $canti = $row['mt2'];
                                                                $totv = $cv[0]*$canti;
                                                                $tottvid += $totv;
                                                                echo '<tr>'
                                                                        . '<td>'.$cv['codigo_vid'].'</td>'
                                                                        . '<td>LAMINA '.$row['color'].'</td>'
                                                                        . '<td>mt2*</td>'
                                                                        . '<td style="text-align:right"><input type="hidden" id="can'.$cv['codigo_vid'].'" value="'.number_format($m2,2,',','.').'">'.number_format($m2,2,',','.').'</td>'
                                                                        . '<td style="text-align:right" id="cons'.$cv['codigo_vid'].'"></td>'
                                                                        . '<td style="text-align:right" id="dif'.$cv['codigo_vid'].'"></td>'
                                                                        . '<td style="text-align:right" id="ref'.$cv['codigo_vid'].'"></td>';
                                                                ?>
                                                                <script>
                                                                    
                                                                    cargarinvfomxreferencia('<?php echo $ffom ?>','<?php echo $cv['codigo_vid'] ?>','<?php echo $cv['codigo_vid'] ?>','Vidrio');
                                                                    </script>
                                                                <?php

                                                             }

                                                              echo '<tr><td></td>';
//                                                                       
//                                                           
//                                                                       echo '<tbody id="mostrar_invfom"><input type="hidden" id="to" value="0"></tbody>';
//                                                                   
//                                                                   echo '<tr><td colspan="4">Totales</td>';
                                                        $total +=$tottvid;
                                                        $total +=$tott;
                                                        ?>
                                                               <tr>
                                                            <td colspan="7">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                                                        </tr>

                                                        </table>
						</div>
				 	</div>
				</div>
			</div>
		</div>
             
<script type="text/javascript">
$(function(){
   
});

 		</script>
  </body>
</html>
