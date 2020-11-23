 <?php 
include '../../../modelo/conexioni.php';
session_start();
function interval_date($init, $finish) {
        //formateamos las fechas a segundos tipo 1374998435
        $diferencia = strtotime($finish) - strtotime($init);
        //comprobamos el tiempo que ha pasado en segundos entre las dos fechas  3146644438
        //floor devuelve el n�mero entero anterior, si es 5.7 devuelve 5
        if ($diferencia < 60) {
                $tiempo = "Duró " . floor($diferencia) . " segundos";
        } else if ($diferencia > 60 && $diferencia < 3600) {
                $tiempo = "Duró " . floor($diferencia / 60) . " minutos'";
        } else if ($diferencia > 3600 && $diferencia < 86400) {
                $tiempo = "Duró " . floor($diferencia / 3600) . " horas";
        } else if ($diferencia > 86400 && $diferencia < 2592000) {
                $tiempo = "Duró " . floor($diferencia / 86400) . " dias";
        } else if ($diferencia > 2592000 && $diferencia < 31104000) {
                $tiempo = "Duró " . floor($diferencia / 2592000) . " meses";
        } else if ($diferencia > 31104000) {
                $tiempo = "Duró " . floor($diferencia / 31104000) . " a�os";
        } else {
                $tiempo = "Error";
        }
        return $tiempo;
}
function interval_date2($init, $finish) {
        //formateamos las fechas a segundos tipo 1374998435
        $diferencia = strtotime($finish) - strtotime($init);
        //comprobamos el tiempo que ha pasado en segundos entre las dos fechas  3146644438
        //floor devuelve el n�mero entero anterior, si es 5.7 devuelve 5
        if ($diferencia < 60) {
                $tiempo = "Duró " . floor($diferencia) . " segundos";
        } else if ($diferencia > 60 && $diferencia < 3600) {
                $tiempo = "Duró " . floor($diferencia / 60) . " minutos'";
        } else if ($diferencia > 3600 && $diferencia < 86400) {
                $tiempo = "Duró " . floor($diferencia / 3600) . " horas";
        } else if ($diferencia > 86400 && $diferencia < 2592000) {
                $tiempo = "Duró " . floor($diferencia / 86400) . " dias";
        } else if ($diferencia > 2592000 && $diferencia < 31104000) {
                $tiempo = "Duró " . floor($diferencia / 2592000) . " meses";
        } else if ($diferencia > 31104000) {
                $tiempo = "Duró " . floor($diferencia / 31104000) . " a�os";
        } else {
                $tiempo = "Error";
        }
        return $tiempo;
}
function interval_date3($init, $finish) {
        //formateamos las fechas a segundos tipo 1374998435
        $diferencia = strtotime($finish) - strtotime($init);
        //comprobamos el tiempo que ha pasado en segundos entre las dos fechas  3146644438
        //floor devuelve el n�mero entero anterior, si es 5.7 devuelve 5
        if ($diferencia < 60) {
                $tiempo = "Duró " . floor($diferencia) . " segundos";
        } else if ($diferencia > 60 && $diferencia < 3600) {
                $tiempo = "Duró " . floor($diferencia / 60) . " minutos'";
        } else if ($diferencia > 3600 && $diferencia < 86400) {
                $tiempo = "Duró " . floor($diferencia / 3600) . " horas";
        } else if ($diferencia > 86400 && $diferencia < 2592000) {
                $tiempo = "Duró " . floor($diferencia / 86400) . " dias";
        } else if ($diferencia > 2592000 && $diferencia < 31104000) {
                $tiempo = "Duró " . floor($diferencia / 2592000) . " meses";
        } else if ($diferencia > 31104000) {
                $tiempo = "Duró " . floor($diferencia / 31104000) . " a�os";
        } else {
                $tiempo = "Error";
        }
        return $tiempo;
}
if(isset($_SESSION['k_username'])){
    $cod= $_GET['sol'];
    $des= $_GET['area'];
    $page= $_GET['page'];
    $pro= $_GET['pro'];   
    $n_fech= $_GET['n_fech'];
    $h_fech= $_GET['h_fech'];
    $n_obs= $_GET['n_obs'];
    $pen= $_GET['pen'];
    $fac= $_GET['fac'];
    if($pen==0){
        $pendientes = ' and cantidad_rec="0" ' ;
    }else if($pen==1){
        $pendientes = ' and cantidad_rec>0 ' ;
    }else{
         $pendientes = ' ' ;
    }
      if($_GET['n_fech']=='' && $_GET['h_fech']==''){
   $fb ='';
   }else{
   $fb =' and fecha >= "'.$n_fech.'" and fecha <= "'.$h_fech.'" ';
   }
if($fac==''){
        $fat = ' and factura_pedido="" ' ;
    }else{
        $fat = ' and factura_pedido>0 ' ;
    }

            $request = mysqli_query($con,"SELECT count(*) FROM orden_compra a,orden_compra_detalle b where a.codigo=b.codigo_orden $pendientes $fat  and a.ordenfom like '%".$_GET['sol']."' and a.nom_ter like '%".$_GET['pro']."%' and b.codigo like '%".$_GET['cod']."%' and b.descripcion like '%".$_GET['des']."%' and a.observaciones_compra like '%".$_GET['n_obs']."%' $fb ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            //wiston 
            $rows_by_page = 12;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM orden_compra a,orden_compra_detalle b where a.codigo=b.codigo_orden $pendientes $fat and a.ordenfom like '%".$_GET['sol']."' and a.nom_ter like '%".$_GET['pro']."%'  and b.codigo like '%".$_GET['cod']."%' and b.descripcion like '%".$_GET['des']."%' and  a.observaciones_compra like '%".$_GET['n_obs']."%' $fb order by b.codigo_orden desc " .$limit );
 $total2=0;
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
                $ped = "'".$fila['ordenfom']."'";
                echo '<tr style="background:#'.$color.'">'
                . '<td>'.$fila['nom_ter'].'</td>'
                . '<td>'.$fila['observaciones_compra'].'</td>'
                . '<td nowrap>'.$fila['ordenfom'].'</td>'
//                . '<td>'.$fila['codigo'].'</td>'
                . '<td>'.$fila['descripcion'].'<br>'.$fila['estado'].' '.$fila['aprobado_por'].'</td>'
                . '<td>'.$fila['fecha'].'</td>'  
                . '<td>'.$fila['cantidad'].'</td>'
                . '<td>'.($fila['cantidad_rec']).'</td>'
                . '<td>'.$fila['factura_pedido'].'</td>'
                . '<td><button onclick="recibir('.$fila['id_oc_de'].','.$ped.')" data-toggle="modal" data-target="#myModal">Recibir</button></td>';
                echo "</tr>";
  }
   echo '<tr><td colspan="6">';
   
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_FEC(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_FEC(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                 }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_FEC(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_FEC(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="images/sig1.png"> <img src="images/sig2.png"> <?php
                }
                echo 'Cantidad de registro* '.$num_items; 
                echo '</td></tr>';
?>
 </div>
</div>
<?php  }else {
      echo 'error';
}  ?>
