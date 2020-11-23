<?php
include "../../../modelo/conexioni.php";
 $ite= $_GET['ite'];
      if($ite==''){
          $it = '';
      }else{
          $it = ' and id_p = '.$ite.' ';
      }
      $codi= $_GET['codi'];
      $desc= $_GET['desc'];
      $refe= $_GET['refe'];
      $line= $_GET['line'];
      $ulti= $_GET['ulti'];
      $modi= $_GET['modi'];
      $page= $_GET['page'];
       $request = mysqli_query($con,"SELECT count(*) FROM producto where "
               . "revisado=0 and linea like '%".$line."%' and codigo like '%".$codi."%' and producto like '%".$desc."%' "
               . " and  fecha_adm like '%".$ulti."%' and modificado like '%".$modi."%'  and aprobado='0' and estado_producto='1' $it ");

           if($request){
  $request = mysqli_fetch_row($request);
  $num_items = $request[0];
        }else{
  $num_items = 0;
        }
          $rows_by_page = 10;

           $last_page = ceil($num_items/$rows_by_page);

           if(isset($_GET['page'])){
          $page = $_GET['page'];
             }else{
          $page = 1;
                }
        
             if(isset($_POST['linea'])){
  
                $lin = '&linea='.$_POST['linea'].'&b='.$_POST['b'].'&rev='.$_POST['rev'].'&des='.$_POST['des'].' ';
              }else{
           if(isset($_GET['linea'])){
    
             $lin = '&linea='.$_GET['linea'].'&b='.$_GET['b'].'&rev='.$_GET['rev'].'&des='.$_GET['des'].' ';
            }else{
             $lin ='';
         }
           }
           echo '<tr><td colspan="14">';         
                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_lis(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_lis(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_lis(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_lis(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
               $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
              echo '</td></tr>';
$result2 = mysqli_query($con, "SELECT * FROM producto where  revisado=0 and linea like '%".$line."%' and codigo like '%".$codi."%' and producto like '%".$desc."%'  and  fecha_adm like '%".$ulti."%' and modificado like '%".$modi."%' $it  and aprobado='0' and estado_producto='1' order by id_p desc  ".$limit);
while ($fila = mysqli_fetch_array($result2)) {

                    $res = 'select count(*) from hojas_rutas where codigo_pro="'.$fila['codigo'].'" ';
                    $f =mysqli_fetch_array(mysqli_query($con,$res));
                    $a = $f['count(*)'];

                    if($a==0){
                        $led = '<img src="../imagenes/warning.png">';
                    }else{
                        $led = '<img src="../imagenes/procesos.png">';
                    }
                    $codigo = "'".$fila['codigo']."'";
                    $sistema = "'".$fila['sistemas']."'";
                    $linea = "'".$fila['linea']."'";
                    $led2 = '<img src="../imagenes/ojo.png">';
                    $x = '<a href="#Crear Items" onclick="productos_dos('.$codigo.')">'.$led2.'</a>';
      
       if($fila['ruta']==''){
            $ima = '<img src="../producto/noimagen.png" style="width:80px">';
        }else{
            $ima = '<img src="../producto/'.$fila['ruta'].'" style="width:80px">';
        }
        if($fila['ok']=='1'){
            $ok = '#1DA200';
        }else{
            $ok = '';
        }

      $led2 = '<img src="../imagenes/ojo.png">';
           echo '<tr>'
        . '<td>'.$fila['id_p'].'</td>'
        . '<td>'.$ima.'</td>'
        . '<td><font color="'.$ok.'"><b>'.$fila['codigo'].'</b></font></td>'
        . '<td>'.$fila['producto'].'<br>Ref:'.$fila['referencia'].'</td>'
        . '<td>'.$fila['linea'].'</td>'
        . '<td>'.$fila['sistemas'].'</td>'
        . '<td>'.$fila['fecha_adm'].'</td>'
        . '<td style="cursor:pointer" onclick="pro_crearrutas()" data-toggle="modal" data-target="#myModal">'.$led.'</td>'
        . '<td>'.$x.'</td>'
       . '<td class="hidden-phone"><a href="../vistas/?id=compuestos&cod='.$fila['codigo'].'&linea='.$fila["linea"].'"><img src="../imagenes/puzzle_3.png"></a></td>'
       . '<td class="hidden-phone"><a href="#" onclick="pre_copiar_producto('.$fila['id_p'].','.$codigo.','.$sistema.','.$linea.');"><img src="../imagenes/copiar.png"></a></td></tr>';               
                     
        
}
?>