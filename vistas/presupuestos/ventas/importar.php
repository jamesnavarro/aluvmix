 <?php
 header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=desglose_agrupado.xls");
 ?>
<table id="simple-table" class="table  table-bordered table-hover">
       <tr><th  style="text-align:center;background: #438EB9" colspan="9">Desglose de Materiales Agrupado</th></tr>
                  <tr class="bg-info" align="center">
                      <th nowrap>#</th>
                      <th nowrap>Codigo</th>
                      <th>Referencia</th>
                      <th>Descripcion</th>     
                      <th>Color</th>
                      <th nowrap>Cantidad</th>
                      <th nowrap>Medida </th>
                      
                      
                 </tr>
                 <tbody id="mostrar_desglose_sol">
                     <?php
                     include '../../../modelo/conexioni.php';
                     $idcot = $_GET['idc'];
                            //$resultdes = mysqli_query($con,"select * from desgloses a LEFT JOIN productos b ON a.referencia=b.pro_referencia and a.id_cot='$idcot' and a.linea='Aluminio' order by a.id_cot_item ");
                           echo '<tr style="background:#efefef"><td colspan="8" ><center>LISTA DE PERFILES</center></td>';
                            $resultdes = mysqli_query($con,"select *, sum(cantidad) as cantidad from desgloses where id_cot='$idcot' and linea='Aluminio' group by codigo_pro order by  id_cot_item ");
                            $c =0;
                            while($r = mysqli_fetch_array($resultdes)){
                                $c++;
                                if($r['linea']=='Aluminio'){
                                   $nombres = mysqli_query($con,"select pro_nombre from productos where pro_referencia='".$r['referencia']."' ");
                                   $n = mysqli_fetch_array($nombres);
                                   $descripcion = $n['pro_nombre'];
                                }else{
                                    $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                                    $n = mysqli_fetch_array($nombres);
                                     $descripcion = $n['descripcion'];
                                }

                                echo '<tr>'
                                . '<td>'.$c.'</td>'
                                . '<td>'.$r['codigo_pro'].'</td>'
                                . '<td>'.$r['referencia'].'</td>'
                                . '<td>'.$descripcion.'</td>'
                                . '<td>'.$r['color'].'</td>'
                                . '<td>'.$r['cantidad'].' Und</td>'
                                . '<td>'.$r['medida'].' mm</td>';
                            }
                            echo '<tr style="background:#efefef"><td colspan="8" ><center>LISTA DE ACCESORIOS</center></td>';
                            $resultmat = mysqli_query($con,"select *, sum(cantidad) as cantidad from desgloses where id_cot='$idcot' and linea='Accesorios' group by codigo_pro order by  id_cot_item ");
                            $c =0;
                            while($r = mysqli_fetch_array($resultmat)){
                                $c++;
                                if($r['linea']=='Aluminio'){
                                   $nombres = mysqli_query($con,"select pro_nombre from productos where pro_referencia='".$r['referencia']."' ");
                                   $n = mysqli_fetch_array($nombres);
                                   $descripcion = $n['pro_nombre'];
                                }else{
                                    $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                                    $n = mysqli_fetch_array($nombres);
                                     $descripcion = $n['descripcion'];
                                }

                                echo '<tr>'
                                . '<td>'.$c.'</td>'

                                . '<td>'.$r['codigo_pro'].'</td>'
                                . '<td>'.$r['referencia'].'</td>'
                                . '<td>'.$descripcion.'</td>'
                                . '<td>'.$r['color'].'</td>'
                                . '<td>'.$r['cantidad'].' Und</td>'
                                . '<td>-</td>';
                            }
                            echo '<tr style="background:#efefef"><td colspan="8" ><center>LISTA DE VIDRIOS</center></td>';
                            $resultvid = mysqli_query($con,"select *, sum(cantidad) as cantidad from desgloses where id_cot='$idcot' and linea='Vidrios' group by codigo_pro order by  id_cot_item ");
                            $c =0;
                            while($r = mysqli_fetch_array($resultvid)){
                                $c++;

                                    $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                                    $n = mysqli_fetch_array($nombres);
                                     $descripcion = $n['descripcion'];


                                echo '<tr>'
                                . '<td>'.$c.'</td>'

                                . '<td>'.$r['codigo_pro'].'</td>'
                                . '<td>'.$r['referencia'].'</td>'
                                . '<td>'.$descripcion.'</td>'
                                . '<td>'.$r['color'].'</td>'
                                . '<td>'.$r['cantidad'].' Mt<sup>2</sup></td>'
                                . '<td>'.$r['medida'].'</td>';
                            }
                     ?>
                 </tbody>
               </table>

