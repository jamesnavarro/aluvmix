<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
include '../../../modelo/conexioni.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TEMPLADOS SAS</title>
            <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="../../../bootstrap-3.3.7/dist/css/bootstrap.min.css">
          <style> 
              table{
                 border-color: #dcdcdc;
                  
              }
              body {
                font-size: 90%;
              }
          </style>
    </head>
    <body onload="window.print()">
       
         <?php 

$request_ac = mysqli_query($con,"SELECT * FROM orden_compra a,orden_compra_detalle b where a.codigo=b.codigo_orden  and a.ordenfom like '%".$_GET['sol']."' and a.nom_ter like '%".$_GET['pro']."%'  and b.codigo like '%".$_GET['cod']."%' and b.descripcion like '%".$_GET['des']."%' order by b.codigo_orden desc " );
 
$total2=0;

 echo "<table border=2>";
echo '<tr>'
 . '<td>PROVEEDOR</td>'
 . '<td>ORDEN</td>'
 . '<td>CODIGO</td>'
 . '<td>DESCRIPCION</td>'
 . '<td>FECHA REGISTRO</td>'
        . '<td>CANT SOL</td>'
 . '<td>CANT PED</td>'
 . '<td>VALOR UNIDAD</td>'
 . '<td>VALOR TOTAL</td>'
        . '</tr>';
   
	while($fila=mysqli_fetch_array($request_ac))
	{  
                $query = mysqli_query($con, "select mod_fec, b.codigo,ordenfom from orden_compra_detalle a, orden_compra b where a.codigo_orden=b.codigo and a.id_sol='".$fila['id_sol']."' and a.codigo='".$fila['codigo']."' and a.color='".$fila['color']."' and a.medida='".$fila['medida']."'  ");
                $f = mysqli_fetch_array($query);
                $opf = substr($f[2],-5);
                $op = $f[1];
                $queryorden = mysqli_query($con, "select fecha_pro from mov_inventario where id_orden ='$op' or id_orden='$opf'  ");
                $o = mysqli_fetch_array($queryorden);
                if($fila['estado']=='En Proceso'){
                    $tiempos = 'x';
                    $tiempos2 = 'x';
                    $tiempos3 = 'x';
                    $FechaAprobada = '';
                    $FechaOrden = '';
                    $FechaEntrada = '';
                    
                }else{
                    $tiempos = interval_date($fila['date_added'], $fila['fecha_aprobada']);
                    $tiempos2 = interval_date2($fila['date_added'], $f[0]);
                    $FechaAprobada = $fila['fecha_aprobada'];
                    $FechaOrden = $f[0];
                    $FechaEntrada = $o[0];
                    if($o){
                        $tiempos3 = interval_date2($fila['date_added'], $o[0]);
                    }else{
                        $tiempos3 = 'x';
                    } 
                }
                
                
                echo '<tr style="background:#'.$color.'">'
                . '<td>'.$fila['nom_ter'].'</td>'
                . '<td>'.$fila['ordenfom'].'</td>'
                . '<td>'.$fila['codigo'].'</td>'
                . '<td>'.$fila['descripcion'].'<br>'.$fila['estado'].' '.$fila['aprobado_por'].'</td>'
                . '<td>'.$fila['mod_fec'].'</td>'  
                . '<td>'.$fila['cantidad'].'</td>'
                . '<td>'.($fila['cantidad_rec']).'</td>'
                . '<td>'.number_format($fila['precio'],0,',','.').'</td>'
                . '<td>'.number_format($fila['cantidad']*$fila['precio'],0,',','.').'</td>';
                echo "</tr>";
  }
  echo "</table>";

?>
    </body>
</html>





