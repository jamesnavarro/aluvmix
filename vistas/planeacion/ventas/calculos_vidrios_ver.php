<?php
include '../../../modelo/conexioni.php';
$cod= $_GET['cod'];
$codv= $_GET['codv'];
$can= $_GET['can'];
$per= $_GET['per'];
$boq= $_GET['boq'];
$ancho= $_GET['ancho'];
$alto=  $_GET['alto'];
$desp=  $_GET['desp'];
$mt2 = ($ancho/1000) * ($alto/1000)*$can; 
$mt = (($ancho/1000) + ($alto/1000))*$can*2;

$result_vidrio = mysqli_query($con, "select costo_v, descripcion_inventario,espesor_v from tipo_vidrio where codigo_vid='$codv' ");
$cv = mysqli_fetch_array($result_vidrio);
$peso = $mt2*2.5*$cv[2];


echo '<table border="1" style="width:100%">';
echo '<tr><td>Costo Vidrio M2 '.$cv[1].'<td style="text-align:right">$'.number_format($cv[0]).'';

echo '<tr><td>Metros Cuadrado<td>'.$mt2. ' mt<sup>2</sup>';
echo '<tr><td>Metros Lineales<td>'.$mt. ' mt';
echo '<tr><td>Peso del vidrio<td>'.$peso. ' Kg.';
$cost = $mt2*$cv[0];
$porcentaje = (100 - $desp)/100;
$subtotal2 = $cost / $porcentaje;
echo '<tr><td>Costo del vidrio:<td style="text-align:right">$'.number_format($cost). '';
echo '<tr><td>Costo Vidrio M2 + Desperdicio '.$cv[1].'<td style="text-align:right">$'.number_format($subtotal2).'';
$result = mysqli_query($con,"select a.secuencia,b.nombre_puesto,b.id_puesto from hojas_rutas a, puestos_trabajos b where a.codigo_pue=b.id_puesto and a.codigo_pro='$cod' ORDER BY secuencia asc ");
echo '<tr><td colspan="2">Hoja de Rutas | Costos por area :';
echo '<tr><td colspan="2"><ul>';
$total_vidrio = 0;
while($r = mysqli_fetch_array($result)){
    echo '<li>'.$r[0].' '.$r[1];
    $idpuesto=$r[2];
            $result_act = mysqli_query($con, "select a.act_codigo,a.valor_std,b.act_umb,b.act_nombre, b.parafiscales from puesto_actividades a, clases_actividad b where a.act_codigo=b.act_codigo and a.id_puesto='$idpuesto'  ");
            $total1 = 0;
            $total_vidrio += $total1;
            echo '<table border="1" style="width:100%">'
            . '<tr><td>Codigo</td><td>Actividad</td><td>Valor</td><td>Und</td><td>Total</td>';
            while ($r = mysqli_fetch_array($result_act)){
                
                $codigo = "'".$r[0]."'";
                
                if($r[2]=='m2'){
                    $st = $mt2 * $r[1];
                }else if($r[2]=='mt'){
                    $st = $mt * $r[1];
                }else if($r[2]=='und'){
                    $st = $can * $r[1];
                }else if($r[2]=='kg'){
                    $st = $r[1] * $peso;
                }else{
                    $st = $can * $r[1];
                }
                $parafiscales = ($r[4]/100) * $st;
                $st = $st + $parafiscales;
                $total1 += $st;
                $total_vidrio += $st;
                echo '<tr>'
                        . '<td>'.$r[0].'</td>'
                        . '<td>'.$r[3].'</td>'
                        . '<td>'.number_format($r[1],2,'.','').'</td>'
                        . '<td>'.$r[2].'</td>'
                        . '<td style="text-align:right">'.number_format($st).'</td>';
            }
            echo '<tr><td colspan="3"></td><td>Total x Area: </td><td style="text-align:right">$'.number_format($total1).'</td>';
            echo '</table>';
} 
echo '<li>Costo Total: $'.number_format($total_vidrio);
$subtotal1 = $total_vidrio + $cost;
//$desp = mysqli_query($con,"select porc_desp,porc_venta from porcentajes where nombre='Vidrio' ");
//$d = mysqli_fetch_row($desp);

$utilidad = (100 - 10)/100;

$subtotal3 = $subtotal2 / $utilidad;
echo '<tr><td>SubTotal 1: <td style="text-align:right">$'.number_format($subtotal1).' ';
echo '</table>';

