<?php
include '../../../modelo/conexioni.php';
if(isset($_GET['sw'])){
$cod= $_GET['cod'];
$codv= $_GET['codv'];
$can= $_GET['can'];
$per= $_GET['per'];
$boq= $_GET['boq'];
$ancho= $_GET['ancho'];
$alto=  $_GET['alto'];
$desp=  $_GET['desp'];
//$despalu=  $_GET['despalu'];
//$despacc=  $_GET['despacc'];
}

$mt2 = ($ancho/1000) * ($alto/1000)*$can; 
$mt = (($ancho/1000) + ($alto/1000))*$can*2;

$result_vidrio = mysqli_query($con, "select costo_v, descripcion_inventario,espesor_v from tipo_vidrio where codigo_vid='$codv' ");
$cv = mysqli_fetch_array($result_vidrio);
$peso = $mt2*2.5*$cv[2];

$cost = $mt2*$cv[0];

$result = mysqli_query($con,"select  a.secuencia,b.nombre_puesto,b.id_puesto from hojas_rutas a, puestos_trabajos b where a.codigo_pue=b.id_puesto and a.codigo_pro='$cod' ");
$total_vidrio = 0;
while($r = mysqli_fetch_array($result)){
//    echo '<li>'.$r[0].' '.$r[1];
    $idpuesto=$r[2];
            $result_act = mysqli_query($con, "select a.act_codigo,a.valor_std,b.act_umb,b.act_nombre, b.parafiscales from puesto_actividades a, clases_actividad b where a.act_codigo=b.act_codigo and a.id_puesto='$idpuesto'  ");
            $total1 = 0;
            $total_vidrio += $total1;

            while ($r = mysqli_fetch_array($result_act)){
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
            }

} 

$subtotal1 = $cost;

$porcentaje = (100 - $desp)/100;
$utilidad = (100 - 10)/100;
$subtotal2 = $subtotal1; //  / $porcentaje
$subtotal3 = $subtotal2 / $porcentaje;
$unidad = $subtotal2 / $can;
$iva = $subtotal2 * 0.19;
$gt = $subtotal2 + $iva;
$grantotal = $total_vidrio + $subtotal3;
if(isset($_GET['sw'])){
$p = array();
$p[0] = number_format(0);
$p[1] = number_format($unidad,2,'.','');
$p[2] = number_format($subtotal2,2,'.','');
$p[3] = number_format($gt,2,'.','');
$p[4] = number_format($cost,2,'.','');
$p[5] = number_format($total_vidrio,2,'.','');
$p[6] = number_format($subtotal3,2,'.','');
$p[7] = number_format($grantotal,2,'.','');
echo json_encode($p);
}


