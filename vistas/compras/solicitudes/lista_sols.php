<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['n_sol'];
    $des= $_GET['area_s'];
    $desf= $_GET['fec_s'];
    $page= $_GET['page'];
    $est= $_GET['est'];
    $ord= $_GET['ord'];
    if($ord==''){
        $orden = '';
    }else if($ord==1){
        $orden = ' and ordencompra!="" ';
    }else{
        $orden = ' and ordencompra="" '; 
    }
    if($_SESSION['k_username']=='grueda' ||$_SESSION['k_username']=='admin' || $_SESSION['k_username']=='MGUTIERREZ' || $_SESSION['k_username']=='YTURIZO' || $_SESSION['k_username']=='CEXTERIOR'|| $_SESSION['k_username']=='AALVAREZ'|| $_SESSION['k_username']=='Omarvilla'){
        $usua = '';
    }else{
        $usua = ' and user_id="'. $_SESSION["id_user"].'" ';
    }
            $request = mysqli_query($con,"SELECT count(*) FROM solicitudes_new where estado like '%".$est."%' and id_sol like '%".$cod."%' and area_reg like '%".$des."%' and fecha_reg like '%".$desf."%' and id_sol!=0 $orden $usua ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 12;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM solicitudes_new where estado like '%".$est."%' and  id_sol like '%".$cod."%' and area_reg like '%".$des."%' and fecha_reg like '%".$desf."%' and id_sol!=0 $orden $usua ".'Order by fecha_reg DESC ' .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
 if ($fila['estado']== 'En Proceso') {
  $estado='blue';
}else if ($fila['estado']== 'Anulado'){
  $estado='red';
}else{
   $estado='green'; 
}
$cod = "'".trim($fila['id_sol'])."'".','."'".trim($fila['area_reg'])."'";
        $sqlu=mysqli_query($con,"SELECT usuario FROM usuarios WHERE id_user='".$fila['user_id']."' LIMIT 1");
        $row=mysqli_fetch_assoc($sqlu);
        $usuario=$row['usuario'];
        if($fila['ordencompra']!=''){
        $sqlc=mysqli_query($con,"SELECT ordenfom FROM orden_compra WHERE id_sol='".$fila['id_sol']."' and estado!='Anulado'  ");
        $op = '';
        while($opf=  mysqli_fetch_array($sqlc)){
            $op .=$opf[0].'<br>';
        }
//        $sqlc=mysqli_query($con,"SELECT ordenfom FROM orden_compra WHERE id_sol='".$fila['id_sol']."' ");
//        $op = '';
//        while($opf=  mysqli_fetch_array($sqlc)){
//            $op .=$opf[0].'<br>';
//        }
        
        }else{
            $op='';
        }
        if($fila['estado']=='aprobado'){
        $sqlcant=mysqli_query($con,"SELECT codigo_orden FROM orden_compra_detalle WHERE id_sol='".$fila['id_sol']."' ");
            $c1 = 0;
            $ct = 0;
            while($o=  mysqli_fetch_array($sqlcant)){
                $ct++;
                if($o[0]!=0){
                    $c1++;
                }      
            }
            $porc = ceil(($c1 * 100) / $ct);
            if($op!=''){
                if($porc<=25){
                    $color = 'FCF3B9';
                }else if($porc>25 && $porc<50){
                    $color = 'F9B894';
                }else if($porc>=50 && $porc<100){
                    $color = 'FDE968';
                }else{
                    $color = 'C7F5CC';
                }
                 
            }else{
                 $color = 'FAD2D0';
            }
           
        }else{
            $porc = 0;
            $color = 'FEFEFE';
        }
       if($fila['fecha_aprobada']=='0000-00-00 00:00:00'){
           $fechaa = '';
       }else{
           $fechaa = '<br>'.$fila['fecha_aprobada'];
       }
        $co = strtoupper(substr($fila['area_reg'],0, 4));
        echo '<tr style="background:#'.$color.'">'
        . '<td nowrap><div><button onclick="cargadatos('.$fila['id_sol'].');">'.$fila['id_sol'].'</button>'
                . ' <img src="../imagenes/imp.png" width="25px"onclick="pdf2('.$fila['id_sol'].');" /></div></td>'
        . '<td>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$co.'-'.$fila['cosecutivo'].'</td>'
        . '<td>'.$fila['area_reg'].'<br><i style="font-size:9px;color:red">'.$fila['obs_solicitud'].'</i></td>'
        . '<td>'.$fila['fecha_reg'].'<br> <i>Items: '.($porc).' %</i></td>'
        . '<td>'.$usuario.'</td>'   
        . '<td>'.$fila['pre_aprobado'].'</td>'
        . '<td>'.$fila['aprobado_por'].' '.$fechaa.'</td><td><font color="'.$estado.'">'.$fila['estado'].'</font></td>'
        . '<td>'.$op.'</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_table(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_table(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_table(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_table(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="images/sig1.png"> <img src="images/sig2.png"> <?php
                }
                echo 'Cantidad de registro '.$num_items; 
                echo '</td></tr>';
?>
 </div>
</div>
<?php  }else {
      echo 'error';
}  ?>
