<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $est_b= $_GET['est_b'];
    $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM tipo_aluminio where color_a like '%".$cod."%' and codigo like '%".$est_b."%'");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM tipo_aluminio where color_a like '%".$cod."%' and codigo like '%".$est_b."%' order by id_ta ASC " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
         {         

            
        echo '<tr>'
       . '<td>'.$fila['id_ta'].'</td>'
       . '<td nowrap>'.$fila['color_a'].'</td>'
       . '<td>'.number_format($fila['costo_a']).'</td>'
       . '<td>'.$fila['variable'].'</td>'
       . '<td>'.$fila['codigo'].'</td>'
       . '<td>'.$fila['rendimiento'].'</td>'
       . '<td><a data-toggle="tab" href="#agregar"><img onclick="editar_col('.$fila['id_ta'].')" src="images/modificar.png"></a>'
       . '</td>';
  }
   echo '<tr class="bg-info"><td colspan="7">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_col1(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_col1(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_col1(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_col1 (<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="images/sig1.png"> <img src="images/sig2.png"> <?php
                }
                
                echo 'Total registro '.$num_items; 
                echo '</td></tr>';
                 ?>
  
<?php  }else {
      echo 'error';
}  ?>
