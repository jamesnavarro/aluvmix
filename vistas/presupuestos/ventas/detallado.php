 <?php
 header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=desglose_detallado.xls");
 ?>
<table id="simple-table" class="table  table-bordered table-hover">
       <tr><th  style="text-align:center;background: #438EB9" colspan="9">Desglose de Materiales</th></tr>
                  <tr class="bg-info" align="center">
                      <th nowrap>#</th>
                      <th nowrap>Ventana</th>
                      <th nowrap>Codigo</th>
                      <th>Referencia</th>
                      <th>Descripcion</th>     
                      <th>Color</th>
                      <th nowrap>Cantidad</th>
                      <th nowrap>Unidad</th>
                      <th nowrap>Medida </th>
                      
                      
                 </tr>
                 <tbody id="mostrar_desglose_mat">
                     <?php
                     include '../../../modelo/conexioni.php';
                      $idcot = $_GET['idc'];
                      if(isset($_GET['alu'])){
       echo '<tr style="background:#efefef"><td colspan="8" ><center>LISTA DE PERFILES</center></td>';
        $resultdes = mysqli_query($con,"select * from desgloses where id_cot='$idcot' and linea='Aluminio' order by  id_cot_item ");
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
            . '<td>'.$r['tipo'].'</td>'
            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['referencia'].'</td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$r['color'].'</td>'
            . '<td>'.$r['cantidad'].'</td>'
            . '<td>Und</td>'
            . '<td>'.$r['medida'].' mm</td>';
        }
                      }
                      if(isset($_GET['acc'])){
        echo '<tr style="background:#efefef"><td colspan="8" ><center>LISTA DE ACCESORIOS</center></td>';
        $resultmat = mysqli_query($con,"select * from desgloses where id_cot='$idcot' and linea='Accesorios' order by  id_cot_item ");
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
            . '<td>'.$r['tipo'].'</td>'
            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['referencia'].'</td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$r['color'].'</td>'
           . '<td>'.$r['cantidad'].'</td>'
            . '<td>Und</td>'
            . '<td>-</td>';
        }
                      }
                      if(isset($_GET['vid'])){
        echo '<tr style="background:#efefef"><td colspan="8" ><center>LISTA DE VIDRIOS</center></td>';
        $resultvid = mysqli_query($con,"select * from desgloses where id_cot='$idcot' and linea='Vidrios' order by  id_cot_item ");
        $c =0;
        while($r = mysqli_fetch_array($resultvid)){
            $c++;

                $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                $n = mysqli_fetch_array($nombres);
                 $descripcion = $n['descripcion'];
 
            
            echo '<tr>'
            . '<td>'.$c.'</td>'
            . '<td>'.$r['tipo'].'</td>'
            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['referencia'].'</td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$r['color'].'</td>'
            . '<td>'.$r['cantidad'].'</td>'
            . '<td>Mt<sup>2</sup></td>'
            . '<td>'.$r['medida'].'</td>';
        }
                      }
                     
                     ?>
                 </tbody>
               </table>
