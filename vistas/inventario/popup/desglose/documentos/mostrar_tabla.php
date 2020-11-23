<?php
include('../../../../../modelo/conexion.php');
$orden = $_GET['orden'];
$result = mysql_query("SELECT ref FROM orden_produccion a, cont_terceros b where a.id_cliente=b.id_ter and a.opf ='".$orden."' ");
                   $r = mysql_fetch_array($result);
                   echo $r[0];
 ?>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                      
                                        <TH>PRODUCTO</TH> 
                                        <TH>COLOR</TH>
                                        <TH>PRECIO</TH>
                                        <TH>CANTIDAD</TH>
                                        <TH>C.P</TH>
                                        <TH>C.AGREGAR</TH>
                                        <TH>OPC</TH>
               
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($rad==''){
                                        $disa = 'disabled';
                                    }  else {
                                        $disa = '';
                                    }

                        $sql = mysql_query("SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can FROM desgloses_material a, referencias b where a.linea='Perfileria' and  a.codigo_pro=b.codigo and a.id_cot=".$r[0]." and cantidad!=0 group by a.referencia order by b.sistema asc ");
			$item = 0;
                        $bod = '';
			if(mysql_num_rows($sql)>0){
				   $contador=0;
                $ref = '';
                $sw=0;
                $sistema = '';
                 while($rowp=mysql_fetch_array($sql)){
                     $contador++;
                     
                     $medtotal = $rowp['med'];
                     $canper = $rowp['med']/$rowp['perfil'];
                   
                     $pst = (($rowp['peso'] * $rowp['perfil']) / 1000)*$canper;
                     
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
                     $resultc = mysql_query("select color_ta from cotizaciones where id_cotizacion='".$rowp['id_cot_item']."' ");
                     $rc = mysql_fetch_array($resultc);
                     
                     
                     $alum_porr = "SELECT costo_a,rendimiento,variable FROM tipo_aluminio where color_a='".$rc[0]."'";
                    $fia4 =mysql_fetch_array(mysql_query($alum_porr));
                    $vc= $fia4["costo_a"]*$fia4["variable"];  //se le agrego la variable que multiplica la pintura
                    $rendimiento= $fia4["rendimiento"];
                    $tipopintura= $fia4["variable"];
                    
                    $canpin = ( $areat * ceil($canper) ) / $rendimiento;
                    
                    $costo_total_pintura = $canpin * $vc;
                    
                    $valor_aluminio = $pst * $rowp['costo_fom'];
                    
                    $queryma = mysql_query("select tipo from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' group by tipo ");
                    $ventana = '';
                    while ($row1 = mysql_fetch_array($queryma)) {
                        $ventana = $ventana.$row1[0].' ,';
                    }
                    $mystring = $rowp['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $rowp['descripcion'];
                    } else {
                        $descripcion = substr($rowp['descripcion'],0,-6);
                    }
//                    if($contador==1){
//                            echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
//                          
//                        }
//                    if($sistema!=$rowp['sistema']){
//                         
//                            echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
//                         
//                     }
                    
                     $ref = $rowp['referencia'];
                     $sistema = $rowp['sistema'];
                     $codigo = $ref.'-'.$rowp['color'].substr($rowp['perfil'],0,2);

                                    $bod = "'".$rowp['bod_codigo']."'";
                                        $precio = $rowp['precio'];
					echo '<tr><input type="hidden" id="des'.$rowp['id_oc_de'].'"  value="'.$rowp['descripcion'].'">
                                            <input type="hidden" id="med'.$rowp['id_oc_de'].'"  value="'.$rowp['medida'].'">
                                                <input type="hidden" id="col'.$rowp['id_oc_de'].'"  value="'.$rowp['color'].'">
                                                    <input type="hidden" id="bod'.$rowp['id_oc_de'].'"  value="'.$rowp['bod_codigo'].'">
                                                        <input type="hidden" id="cod'.$rowp['id_oc_de'].'"  value="'.$rowp['codigo'].'">
                                                            <input type="hidden" id="pre'.$rowp['id_oc_de'].'"  value="'.$precio.'">
                                        <td>'.$rowp['codigo'].'</td>'
                                      
                                        . '<td>'.$rowp['descripcion'].'</td>'
                                                . '<td>'.$rowp['color'].'</td>'
                                                 . '<td>'.$precio.'</td>'
                                        . '<td>'.$rowp['cantidad'].'</td>'
                                        . '<td><input type="text" id="pcant'.$rowp['id_oc_de'].'" disabled style="width: 70px" value="'.$rowp['cantidad_pend'].'"></td>'
                                        . '<td><input type="text" id="ncant'.$rowp['id_oc_de'].'" onchange="veri('.$rowp['id_oc_de'].')" '.$disa.' style="width: 70px" value="'.$rowp['cantidad_pend'].'"></td>'
                                        . '<td><input type="checkbox" name="item" id="'.$rowp['id_oc_de'].'" '.$disable.' style="width: 100px"></td>';}
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    echo '<tr><td colspan="7"></td><td style="text-align:center"><button '.$disa.' onclick="agregar_productos('.$rad.','.$orden.')">Recibir</button></td></tr>';
                                    ?>
                                </tbody>
                            </table>
                        
