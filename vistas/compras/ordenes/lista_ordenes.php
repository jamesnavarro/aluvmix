<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $nit= $_GET['nit'];
    $provee= $_GET['provee'];
    $fec= $_GET['fec'];
    $est= $_GET['est'];
    $page= $_GET['page'];
    $usu= $_GET['usu'];
    $fom= $_GET['fom'];
    
            $request = mysqli_query($con,"SELECT count(*) FROM orden_compra where ordenfom like '%".$fom."%' and usuario like '%".$usu."%' and codigo like '%".$cod."%' and id_sol like '%".$des."%' and cod_ter like '%".$nit."%' and nom_ter like '%".$provee."%' and fecha like '%".$fec."%' and estado like '%".$est."%' and id_sol!=0");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 15;
            $last_page = ceil($num_items/$rows_by_page);
            $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
            $request_ac = mysqli_query($con,"SELECT * FROM orden_compra where ordenfom like '%".$fom."%' and usuario like '%".$usu."%' and codigo like '%".$cod."%' and id_sol like '%".$des."%' and cod_ter like '%".$nit."%' and nom_ter like '%".$provee."%' and fecha like '%".$fec."%' and estado like '%".$est."%' and id_sol!=0 ".'Order by fecha DESC ' .$limit);
            $total2=0;
            
               echo '<tr><td colspan="10">';
              if($page>1){?>
                     <img src="images/at1.png" onclick="mostrar_table(1)" style="cursor: pointer;">
                     <img src="images/at2.png" onclick="mostrar_table(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
                ?>
                        (<b>Pagina</b><input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="images/sig1.png" onclick="mostrar_table(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_table(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                ?><img src="images/sig1.png"><img src="images/sig2.png"> <?php
                } 
                 echo 'Cantidad de registro '.$num_items.'&nbsp;&nbsp;<img onclick="printer_rep()" style="width:25px" src="../images/print.png">'; 
                 echo '</td></tr>';
	    while($fila=mysqli_fetch_array($request_ac))
{  
 if ($fila['estado']== 'En Proceso') {
         $estado='blue';
     }else if ($fila['estado']== 'Anulado') {
        $estado='red';
     }else{
         $estado='green';
     }
     if ($fila['enviado']== 0) {
         $send = '<font color="red">Sin enviar</font>';
     }else{
          $send = '<font color="green">Enviado</font>';
     }
     $cod = "'".trim($fila['id_sol'])."'".','."'".trim($fila['codigo'])."'";
     $codfom = "'".trim($fila['ordenfom'])."'";
     $pro = "'".trim($fila['nom_ter'])."'";
        echo '<tr>'
        . '<td>'.$fila['codigo'].'</td>'
	. '<td>'.$fila['id_sol'].'</td>'
        . '<td>'.$fila['ordenfom'].'</td>'
        . '<td>'.$fila['cod_ter'].'</td>'
        . '<td>'.$fila['nom_ter'].' <button onclick="DetalleOC('.$fila['codigo'].','.$codfom.','.$pro.')"> ! </button> <button onclick="AnularOC('.$fila['codigo'].')"> x </button></td>'
        . '<td>'.$fila['fecha'].'</td>'
        . '<td><font color="'.$estado.'">'.$fila['estado'].'</font></td>'
        . '<td>'.$fila['usuario'].'</td>'
        . '<td>'.$send.'</td>'
        . '<td nowrap><button class="btn btn-info" onclick="ver_ord('.$fila['codigo'].');"><i  class="glyphicon glyphicon-eye-open"></i></button> <button class="btn btn-inverse" onclick="printer('.$fila['codigo'].');" ><i class="glyphicon glyphicon-print"></i></button></td>'
        . '</tr>';
  }
   echo '<tr><td colspan="10">';
              if($page>1){?>
                     <img src="images/at1.png" onclick="mostrar_table(1)" style="cursor: pointer;">
                     <img src="images/at2.png" onclick="mostrar_table(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
                ?>
                        (<b>Pagina</b><input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="images/sig1.png" onclick="mostrar_table(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_table(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                ?><img src="images/sig1.png"><img src="images/sig2.png"> <?php
                } 
                 echo 'Cantidad de registro '.$num_items; 
                 echo '</td></tr>';
?>

<?php }else {
      echo 'error';
}?>
