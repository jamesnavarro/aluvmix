<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $res=$_GET['res'];
    $est=$_GET['est'];
   $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM medidas where cod_medida like '%".$cod."%' and nom_medida like '%".$des."%' and resu_medida like '%".$res."%' and esta_medida like '%".$est."%'");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM medidas where cod_medida like '%".$cod."%' and nom_medida like '%".$des."%' and resu_medida like '%".$res."%' and esta_medida like '%".$est."%' " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
 if ($fila['esta_medida']== '1') {
  $estado='images/ok.png';
}else{
  $estado='images/no.png';
}
$cod = "'".$fila['cod_medida']."'";
        echo '<tr>'

        . '<td>'.$fila['cod_medida'].'</td>'
        . '<td>'.$fila['nom_medida'].'</td>'
        . '<td>'.$fila['resu_medida'].'</td>'
        . '<td>'.$fila['tipo_medida'].'</td>'
        . '<td><img src="'.$estado.'"></td>'
        . '<td><a data-toggle="tab" href="#lin2"><button onclick="editar_medida('.$cod.')" ><img src="images/modificar.png"></button></a>'
        . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_medidas(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_medidas(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_medidas(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_medidas(<?php echo $last_page;?>)" style="cursor: pointer;">
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
