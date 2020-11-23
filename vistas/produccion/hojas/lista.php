<?php 
include '../../../modelo/conexionv1.php';
session_start();
if(isset($_SESSION['k_username'])){
    $tipo= $_GET['tipo'];
    $opf= $_GET['opf'];
    $page= $_GET['page'];
    $ped= $_GET['ped'];
    $ord= $_GET['ord'];
    $fec= $_GET['fec'];
            $request = mysqli_query($con2,"SELECT COUNT(*) FROM orden_produccion a, usuarios b, cont_terceros c WHERE a.generado_user = b.id_user AND a.id_cliente = c.id_ter AND a.opf like '%".$_GET['opf']."' AND a.tipofom like '%".$_GET['tipo']."' AND a.pedido  like '%".$_GET['ped']."' and a.id_orden like '%".$ord."%' AND a.fecha_registro  like '".$_GET['fec']."%' and a.congelado='1' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con2,"SELECT *, a.id_orden,a.fecha_registro FROM orden_produccion a, usuarios b, cont_terceros c WHERE a.generado_user = b.id_user AND a.id_cliente = c.id_ter AND a.opf like '%".$_GET['opf']."' AND a.tipofom like '%".$_GET['tipo']."' AND a.pedido  like '%".$_GET['ped']."'  and a.id_orden like '%".$ord."%' AND a.fecha_registro  like '".$_GET['fec']."%' and a.congelado='1' ORDER BY a.id_orden DESC " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
         {    
            $OPx = str_pad( $fila["opf"], 9, "0", STR_PAD_LEFT);
            $ped = str_pad( $fila['pedido'], 9, "0", STR_PAD_LEFT);
            $opf = "'".$OPx."'";
            $resultcot = mysqli_query($con2,"select numero_cotizacion, version from cotizacion where id_cot='".$fila['ref']."' ");
            $cot = mysqli_fetch_array($resultcot);
            $ti = "'Vidrio'";
            
        echo '<tr>'
            
       . '<td><a href="../../../planeacion/vistas/?id=detalle_op&cot='.$fila['ref'].'&cli=0&op='.$fila['id_orden'].'" target="_blank">'.$fila['id_orden'].'</a></td>'
                . '<td>'.$fila['tipofom'].'</td>'
                . '<td>'.$OPx.'</td>'
       . '<td><a href="#" onclick="ver_cotizacion('.$fila['ref'].','.$ti.');">'.$fila['pedido'].'</a></td>'
       . '<td>'.$fila['nom_ter'].'</td>'
       . '<td>'.$fila['fecha_registro'].'</td>'
                . '<td><a href="../../../cotizacionv2/vistas/?id=new_fac&cot='.$fila['ref'].'&cli=0" target="_blank">'.$cot[0].'.'.$cot[1].'</a></td>'
                . '<td><button onclick="opciones('.$fila['id_orden'].','.$opf.')"  class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Opciones</button></td>';
  }
        echo '<tr class="bg-info"><td colspan="7">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_burros(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_burros(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_burros(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png"  onclick="mostrar_burros (<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="images/sig1.png"> <img src="images/sig2.png"> <?php
                }
                echo 'Cantidad de registro '.$num_items. ' Fecha:'.$_GET['fec']; 
                 echo '</td></tr>';
                 ?>
  
<?php  }else {
   
      echo 'error';
    
}  ?>
