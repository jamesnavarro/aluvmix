<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $codi= $_GET['cod'];
    $ubi_b= $_GET['ubi_b'];
    $color_b= $_GET['color_b'];
    $med_b= $_GET['med_b'];
    $bod_bn= $_GET['bod_bn'];
    $page= $_GET['page'];
    $sto= $_GET['sto'];
    if($sto=='1'){
        $bussto = " and stock_ubi>0 ";
    }elseif($sto=='0'){
        $bussto = " and stock_ubi=0 ";
    }elseif($sto=='2'){
        $bussto = " and stock_ubi<0 ";
    }else{
        $bussto = " ";
    }
            $request = mysqli_query($con, "SELECT count(*) FROM relacion_ubicaciones  where codigo_pro like '%".$codi."%' $bussto and  ubicacion like '%".$ubi_b."%' and  color_ubi like '%".$color_b."%' and  medida like '%".$med_b."%' and  bod_codigo like '%".$bod_bn."%' ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 15;
            $last_page = ceil($num_items/$rows_by_page);

            $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
            $request_ac = mysqli_query($con, "SELECT * FROM relacion_ubicaciones  where codigo_pro like '%".$codi."%' $bussto and  ubicacion like '%".$ubi_b."%'  and  color_ubi like '%".$color_b."%'  and  medida like '%".$med_b."%'  and  bod_codigo like '%".$bod_bn."%'  order by  id_ru  desc " .$limit );
            $total2=0;
	    while($fila=mysqli_fetch_array($request_ac))
	{  
                $cod = "'".$fila['codigo_pro']."'";

             echo '<tr>'
             . '<td>'.$fila['bod_codigo'].'</td>'
             . '<td>'.$fila['codigo_pro'].' </td>'
             . '<td>'.$fila['color_ubi'].'</td>'
               . '<td>'.$fila['medida'].'</td>'
             . '<td>'.$fila['stock_ubi'].'</td>'
             . '<td>'.$fila['ubicacion'].'</td>'
             . '<td><button onclick="traslado('.$fila['id_ru'].')" data-toggle="modal" data-target="#ModalCambiar"><img src="images/modificar.png"></button>'
             . '</td>'
                     . '<td><button onclick="verlist('.$fila['id_ru'].')" data-toggle="modal" data-target="#ModalMovimientos"><img src="images/ver.png"></button>'
             . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_ubicedit(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_ubicedit(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"><img src="images/at2.png"><?php       }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_ubicedit(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_ubicedit(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="images/sig1.png"> <img src="images/sig2.png"> <?php
                }
                
                echo 'Cantidad de registro '.$num_items; 
                 echo '</td></tr>';
                 ?>
  
<?php  }else {
   
      echo 'error';
    
}  ?>
