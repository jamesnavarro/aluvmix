<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $page= $_GET['page'];
            $request = mysqli_query($con, "SELECT count(*) FROM areas  where area like '%".$cod."%' and estado_areat like '%".$des."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con, "SELECT * FROM areas where area like '%".$cod."%' and estado_areat like '%".$des."%' " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
 if ($fila['estado_areat']=="1") {
  $estat='images/no.png';
}else{
  $estat='images/ok.png';
}
        echo '<tr>'
        . '<td>'.$fila['id'].'</td>'
        . '<td>'.$fila['area'].'</td>'
        . '<td><img src="'.$estat.'"></td>'
        . '<td><a data-toggle="tab" href="#lin2"><button onclick="editar_areat('.$fila['id'].')" ><img src="images/modificar.png"></button></a>'
        . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_areat(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_areat(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_areat(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_areat(<?php echo $last_page;?>)" style="cursor: pointer;">
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
