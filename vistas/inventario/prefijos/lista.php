<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $resT=$_GET['resT'];
    $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM prefijosinv where pre_codigo like '%".$cod."%' and pre_tipmov like '%".$des."%' and pre_fuente like '%".$resT."%' ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM prefijosinv where pre_codigo like '%".$cod."%' and pre_tipmov like '%".$des."%' and pre_fuente like '%".$resT."%' " .$limit );
	while($fila=mysqli_fetch_array($request_ac))
	{  
        echo '<tr>'
        . '<td>'.$fila['id_prefijo'].'</td>'
        . '<td>'.$fila['pre_codigo'].'</td>'
        . '<td>'.$fila['pre_tipmov'].'</td>'
        . '<td>'.$fila['pre_fuente'].'</td>'
        . '<td>'.$fila['pre_ultimo'].'</td>'
        . '<td><a data-toggle="tab" href="#lin2"><button onclick="editar_pref('.$fila['id_prefijo'].')" ><img src="images/modificar.png"></button></a>'
        . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_pref(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_pref(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_pref(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_pref(<?php echo $last_page;?>)" style="cursor: pointer;">
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
