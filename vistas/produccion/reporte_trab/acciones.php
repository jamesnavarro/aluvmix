<?php
include('../../../modelo/conexionv1.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
           $area = $_GET['area'];
           $query=mysqli_query($con2,"select * from grupo where id_area='$area' and name!='' and estado_gr=0  ");
           echo '<option value="">Seleccione el grupo</option>';
           while ($row = mysqli_fetch_array($query)) {
               echo '<option value="'.$row['id_g'].'">'.$row['id_g'].' '.$row['name'].'</option>';
           }
            
           break;
            case 2:
           $id = $_GET['id'];
           $query=mysqli_query($con2,"SELECT * FROM grupo_det a, usuarios b where a.id_user=b.id_user and a.id_g='$id'  ");
         
           while ($row = mysqli_fetch_array($query)) {
               if($row['est']=='0'){
                   $esta = 'Act';
               }else{
                   $esta = '<b>X</b>';
               }
               echo '<tr>'
               . '<td>'.'<b>'.$row['cargo'].'&nbsp;&nbsp;&nbsp;</b>'.'</td>'
               . '<td>'.$row['nombre'].' '.$row['apellido'].'-'.$row['id_user'].'</td>'
               . '<td>'.'<b>'.$im.'</b>'.'</td>'
                       . '<td><button onclick="VerInc('.$row['id_user'].')" class="glyphicon glyphicon-list" data-toggle="modal" data-target="#Formulario"> </button></td>';
           }
            
           break;
            case 2.1:
           $id = $_GET['id'];
           $query=mysqli_query($con2,"SELECT precio_oficial, precio_ayud, tipo, observacion FROM grupo a, pagos_rangos b, pagos c where a.id_pago=b.id_pago and b.id_pago=c.id_pago and a.id_g='$id'  ");
           $row = mysqli_fetch_array($query);
           $p = array();
           $p[0] = $row[0];
           $p[1] = $row[1];
           $p[2] = $row[2];
           $p[3] = $row[3];
           echo json_encode($p);
           break;
           case 3:
               $area = $_GET['area'];
               $grupo = $_GET['grupo'];
               $inicio= $_GET['inicio'].' 00:00:00';
               $fin = $_GET['fin'].' 23:59:00';
               $opf = $_GET['opf'];
               $ofi = $_GET['ofi'];
               $ayu = $_GET['ayu'];
               $tipo = $_GET['tipo'];
               if($opf==''){
                   $op = " ";
               }else{
                    $op = " and opf in ($opf) ";
               }
           $query=mysqli_query($con2,"SELECT  count(id_registro) as can, sum((ancho/1000)*(alto/1000)) as cuadrados, sum(mtl) as lienales, sum(per_ing) as per, sum(boq_ing) as boq, sum(peso) as peso FROM registro_trabajo where id_area='$area' and usuario='$grupo' and fecha_reg between '$inicio' and '$fin' $op ");
           //echo "<tr><td colspan='10'>SELECT  count(id_registro) as can, sum((ancho/1000)*(alto/1000)) as cuadrados, sum(mtl) as lienales, sum(per_ing) as per, sum(boq_ing) as boq, sum(peso) as peso FROM registro_trabajo where id_area='$area' and usuario='$grupo' and fecha_reg between '$inicio' and '$fin' $op </td>";
           while ($row = mysqli_fetch_array($query)) {
               if($tipo=='Kg'){
                   $pofi = $ofi * $row[5];
                   $payu = $ayu * $row[5];
               }elseif ($tipo=='Und') {
                   if($area=='4'){
                       $pofi = $ofi * $row[3];
                       $payu = $ayu * $row[3];
                   }elseif($area=='5'){
                       $pofi = $ofi * $row[4];
                       $payu = $ayu * $row[4];
                   }else{
                       $pofi = $ofi * $row[0];
                       $payu = $ayu * $row[0];
                   }
                   
               }elseif ($tipo=='Ml') {
                   $pofi = $ofi * $row[2];
                   $payu = $ayu * $row[2];
               }else{
                   $pofi = $ofi * $row[1];
                   $payu = $ayu * $row[1];
               }
               echo '<tr>'
                . '<td>'.number_format($row[0]).'</td>'
                . '<td>'.number_format($row[1],2).'</td>'
                . '<td>'.number_format($row[2],2).'</td>'
                . '<td>'.number_format($row[3],2).'</td>'
                . '<td>'.number_format($row[4],2).'</td>'
                . '<td>'.number_format($row[5],2).' Kg</td>'
                . '<td>'.number_format($payu).'</td>'
                . '<td>'.number_format($pofi).'</td>'
                . '<td><button onclick="DetalleGenerarReporte()" id="btn"  class="btn btn-info">Ver Detalle</button> <button class="btn btn-success" onclick="printer2();" >Exportar Excel</button> <button class="btn btn-inverse" onclick="printer();" ><i class="glyphicon glyphicon-print"></td>';
           }
            
           break;
           case 4:
               $area = $_GET['area'];
               $grupo = $_GET['grupo'];
               $inicio= $_GET['inicio'].' 00:00:00';
               $fin = $_GET['fin'].' 23:59:00';
               $opf = $_GET['opf'];
               if($opf==''){
                   $op = " ";
               }else{
                   $op = " and opf in ($opf) ";
               } 
           $query=mysqli_query($con2,"SELECT  count(id_registro) as can, sum((ancho/1000)*(alto/1000)) as cuadrados, sum(mtl) as lienales, sum(per_ing) as per, sum(boq_ing) as boq, sum(peso) as peso, opf,fecha_reg FROM registro_trabajo where id_area='$area' and usuario='$grupo' and fecha_reg between '$inicio' and '$fin' $op group by opf order by fecha_reg asc ");
           $total = 0;
           $peso=0;
           $und=0;
           $c = 0;
           //echo "<tr><td colspan='9'>SELECT  count(id_registro) as can, sum(mt2) as cuadrados, sum(mtl) as lienales, sum(per_ing) as per, sum(boq_ing) as boq, sum(peso) as peso, opf,fecha_reg FROM registro_trabajo where id_area='$area' and usuario='$grupo' and fecha_reg between '$inicio' and '$fin' $op group by opf order by fecha_reg asc</td>";
           while ($row = mysqli_fetch_array($query)) {
               $total ++;
               $peso +=$row[5];
               $und +=$row[0];
               $c = 0;
               echo '<tr>'
               . '<td>'.$row[6].'</td>'
               . '<td>'.number_format($row[0]).'</td>'
               . '<td>'.number_format($row[1],2).'</td>'
               . '<td>'.number_format($row[2],2).'</td>'
               . '<td>'.number_format($row[3],2).'</td>'
               . '<td>'.number_format($row[4],2).'</td>'
               . '<td style="text-align:right">'.number_format($row[5],2).'</td>'
               . '<td><center>'.$row[7].'</center></td>'
               . '<td><button onclick="DetallePorOp('.$total.','.$row[6].')" id="btn'.$total.'&opf='.$_GET['opf'].'">Ver mas Detalle</button></td>';
                echo '<tr><td id="'.$total.'" colspan="9"></td>';
           }
           echo '<tr>'
           . '<td>'.$total.'</td>'
           . '<td>'.$und.'</td>'
           . '<td>-</td>'
           . '<td>-</td>'
           . '<td>-</td>'
           . '<td>-</td>'
           . '<td style="text-align:right">'.number_format($peso).'</td>'
           . '<td style="text-align:right"><button class="btn btn-success"><a href="../vistas/produccion/reporte_trab/reporte_excel.php?area='.$area.'&grupo='.$grupo.'&inicio='.$_GET['inicio'].'&fin='.$_GET['fin'].'">Exportar Excel</a></button></td>';
            
           break;
            case 5:
               $area = $_GET['area'];
               $grupo = $_GET['grupo'];
               $inicio= $_GET['inicio'].' 00:00:00';
               $fin = $_GET['fin'].' 23:59:00';
               $opf = $_GET['opf'];
               $id = $_GET['id'];
               if($opf==''){
                   $op = " ";
               }else{
                    $op = " and opf='$opf' ";
               }
           $query=mysqli_query($con2,"SELECT (id_registro) as can, ((ancho/1000)*(alto/1000)) as cuadrados, (mtl) as lienales, (per_ing) as per, (boq_ing) as boq, (peso) as peso, opf,fecha_reg, ancho,alto,espesor, id_op,codigo FROM registro_trabajo where id_area='$area' and usuario='$grupo' and fecha_reg between '$inicio' and '$fin' $op  order by fecha_reg asc ");
           $total = 0;
           $peso=0;
           $und=0;
           $mt2=0;
           $ml=0;
           $per=0;
           $boq=0;
           $c = 0;
           echo '<table style="width:100%; background-color:#D2CFCE">';
           ?>
<tr  style="background-color:#F7F8B7">
           <th>MEDIDAS</th>
           <th>MT2</th>
           <th>ML</th>
           <th>PER</th>
           <th>BOQ</th>
           <th>PESO KG</th>
           <th>FECHA REGISTRO</th>
           <th>REGISTRO</th>
        </tr>
<?php
           while ($row = mysqli_fetch_array($query)) {
               $total ++;
               $mt2t = ($row[8]/1000)*($row[9]/1000);
               $peso +=$row[5];
               $mt2 +=$mt2t;
               $ml +=$row[2];
               $per +=$row[3];
               $boq +=$row[4];
               $c = 0;
               echo '<tr>'
               . '<td>'.$row[8].' x '.$row[9].' e'.$row[10].'</td>'
               . '<td>'.number_format($mt2t,2).'</td>'
               . '<td>'.number_format($row[2],2).'</td>'
               . '<td>'.number_format($row[3],2).'</td>'
               . '<td>'.number_format($row[4],2).'</td>'
               . '<td style="text-align:right">'.number_format($row[5],2).'</td>'
               . '<td>'.$row[7].'</td><td><button onclick="verop('.$row[12].','.$row[6].')"  data-toggle="modal" data-target="#modaltrabajo">Registro Trabajo</button></td>';
     
           }
           echo '<tr>'
           . '<td>Items:'.$total.'</td>'
           . '<td>'.number_format($mt2,2,'.',',').'</td>'
           . '<td>'.number_format($ml,2,'.',',').'</td>'
           . '<td>'.number_format($per,2,'.',',').'</td>'
           . '<td>'.number_format($boq,2,'.',',').'</td>'
           . '<td style="text-align:right">'.number_format($peso,2,'.',',').'</td>'
           . '<td style="text-align:right"> <button onclick="ocultar('.$id.')">Ocultar</button></td>';
           echo '</table>';
            
           break;
           case 6:
            $id=$_GET['id'];
            $opf=$_GET['opf'];
            $resultx = mysqli_query($con2,"select * from registro_trabajo where codigo='$id' and opf='$opf' ");
        
             while($f = mysqli_fetch_array($resultx)){
                 echo '<tr>'
                    . '<td>'.$f['id_area'].'</td>'
                    . '<td>'.$f['area'].'</td>'
                    . '<td>'.$f['namegroup'].'</td>'
                    . '<td>'.$f['fecha_reg'].'</td>';
            }
            
            break;
          
            }

