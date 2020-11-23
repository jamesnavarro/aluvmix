<?php 
include '../../../modelo/conexionv1.php';
include '../../../modelo/conexioni.php';
session_start();
if($_GET['sol']=='2'){
    $sol = "";
}else{
    $sol = " a.solicitud='".$_GET['sol']."' and ";
}
$reques=mysqli_query($con2,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can,a.observaciones FROM desgloses_material a, referencias b where $sol a.linea='Perfileria' and  a.codigo_pro=b.codigo and a.id_cot=".$_GET["cot"]." and cantidad!=0 group by a.referencia, a.perfil order by b.sistema, id_desglose asc  ");
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
                     
                 $medres = mysqli_query($con2,"select sum(medida*cantidad) as med from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' and perfil='".$rowp['perfil']."' ");
                 $md = mysqli_fetch_array($medres);
                 
                     $medtotal = $md['med'];
                     $canper = $md['med']/($rowp['perfil']-100);
                     $pst = (($rowp['peso'] * $rowp['perfil']) / 1000)*$canper;
                     $resultc = mysqli_query($con2,"select color_ta from cotizaciones where id_cotizacion='".$rowp['id_cot_item']."' ");
                     $rc = mysqli_fetch_array($resultc);
                     
                     if($rowp['color']=='02'){
                         $area=$rowp['area']/1000;
                     }else{
                          $area=$rowp['area'];
                     }
                     if($rowp['color']=='01'){
                         $crudo = $rc[0];
                         $codcolor = '01';
                     }else{
                         $crudo = 'CRUDO';
                         $codcolor = '00';
                     }
                     $areat = $area*($rowp['perfil']/1000);
                     // sacar color del items
                    
                     
                     
                    $alum_porr = "SELECT costo_a,rendimiento,variable FROM tipo_aluminio where color_a='".$rc[0]."'";
                    $fia4 =mysqli_fetch_array(mysqli_query($con2,$alum_porr));
                    $vc= $fia4["costo_a"]*$fia4["variable"];  //se le agrego la variable que multiplica la pintura
                    $rendimiento= $fia4["rendimiento"];
                    $tipopintura= $fia4["variable"];
                    
                    $canpin = ( $areat * ceil($canper) ) / $rendimiento;
                    $costo_total_pintura = $canpin * $vc;
                    $valor_aluminio = $pst * $rowp['costo_fom'];
                    $queryma = mysqli_query($con2,"select tipo from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' group by tipo ");
                    $ventana = '';
                    while ($row1 = mysqli_fetch_array($queryma)) {
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
                    if($contador==1){
                      echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                          
                        }
                    if($sistema!=$rowp['sistema']){
                         
                            echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                         
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
                     $codigo = $ref.'-'.$codcolor.substr($rowp['perfil'],0,2);
                     if($rowp['existefom']=='1'){ 
                         $bcolor='#F4CACA';
                         if($rowp['crear']=='1'){ 
                             $ch2 = 'Solicitado';
                         }else{
                            $ch2 = '<button onclick="pedir('.$contador.')">Solicitar</button>';
                         }
                     }else{ 
                         $bcolor='#C5E9C0';
                         $ch2='<input type="checkbox" id="'.$contador.'" name="item2" checked>';
                     }
                     $refe = "'".$rowp['referencia']."'";
                     echo '<tr style="background-color:'.$bcolor.'" id="td'.$contador.'">'
                             . '<td>'.$contador.'<input type="checkbox" id="'.$contador.'" name="item" checked> <button  data-toggle="modal" data-target="#ModalEditarX" onclick="verperfiles('.$refe.','.$rowp['perfil'].')">!</button></td>'
                             . '<td>'.ceil($canper).' </td>'
                             . '<td><input type="text" value="'.ceil($canper).'" style="width:60px" id="can'.$contador.'"></td>'
                             . '<td><input type="text" value="" style="width:60px" id="sto'.$contador.'" disabled></td>'
                             . '<td> <input type="text" value="'.$dado.'" style="width:70px" id="ref'.$contador.'" disabled> '.$ch2.'</td>'
                             . '<td><input type="text" value="'.$codigo.'" style="width:100px" id="cod'.$contador.'"></td>'
                             . '<td><textarea id="des'.$contador.'">'.$descripcion.' '.$rowp['perfil'].'MM</textarea></td>'
                             . '<td title="'.$crudo.'"><input type="text" value="'.$crudo.'" style="width:80px" id="aca'.$contador.'"></td>'
                             . '<td>'.$rc[0].'</td>'
                             . '<td>'.substr($ventana,0,-1).'</td>'
                             . '<td><input type="text" value="'.$rowp['perfil'].'" style="width:80px" id="per'.$contador.'"></td>'
                              
                             . '<td><input type="text" value="'.$rowp['referencia'].'" style="width:70px" id="dad'.$contador.'" disabled></td>'
                            
                             . '<td>'.number_format($rowp['peso'],2).' Kg</td>'
                             . '<td>'.number_format($pst,2).' Kg</td>'
                             . '<td>'.$area.'</td>'
                             . '<td>'.$areat.'</td>'
                             . '<td>'.$rendimiento.'</td>'
                             . '<td>'.number_format($canpin,2).'</td>'
                             . '<td>'.number_format($vc).'</td>'
                             . '<td>'.number_format($valor_aluminio).'</td>'
                             . '<td>'.number_format($costo_total_pintura).'<td>'.$rowp['observaciones']
                             . '<input type="hidden" value="'.$rowp['precio'].'" style="width:80px" id="pre'.$contador.'">'
                             . '<input type="hidden" value="'.$rowp['unidad'].'" style="width:80px" id="und'.$contador.'">'
                             . '<input type="hidden" value="'.$rowp['iva'].'" style="width:80px" id="iva'.$contador.'"></td>';

                 } ?>
