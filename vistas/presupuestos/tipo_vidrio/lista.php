<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM configuracion_vidrios where descripcion_vidrio like '%".$cod."%'");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT *  FROM configuracion_vidrios where descripcion_vidrio like '%".$cod."%' order by id desc " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  


        echo '<tr>'
        . '<td>'.$fila['id'].'</td>'
       . '<td>'.$fila['descripcion_vidrio'].'</td>'
       . '<td>'.$fila['estado'].'</td>'
      
       . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar_tvidrios('.$fila['id'].')" ><img src="images/modificar.png"></button></a>'
       . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_tvidrios(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_tvidrios(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_tvidrios(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_tvidrios (<?php echo $last_page;?>)" style="cursor: pointer;">
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
