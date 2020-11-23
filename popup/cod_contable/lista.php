<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $est= $_GET['est'];
   
    $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM cont_codigos_contables where cod_cod_cont like '%".$cod."%' and nom_cod_cont like '%".$des."%' and estado_cod_cont like '%".$est."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM cont_codigos_contables where cod_cod_cont like '%".$cod."%' and nom_cod_cont like '%".$des."%' and estado_cod_cont like '%".$est."%' " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
 if ($fila['estado_cod_cont']== '1') {
  $estado='images/no.png';
}else{
  $estado='images/ok.png';
}
        echo '<tr>'

        . '<td>'.$fila['id_cod_cont'].'</td>'
        . '<td>'.$fila['cod_cod_cont'].'</td>'
        . '<td>'.$fila['nom_cod_cont'].'</td>'
        . '<td>'.$fila['cod_tri_cod_cont'].'</td>'
        . '<td><img src="'.$estado.'"></td>'
        . '<td><a data-toggle="tab" href="#lin2"><button onclick="editar_cod('.$fila['id_cod_cont'].')"  ><img src="images/modificar.png"></button></a>'
        . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_cod(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_cod(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_cod(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_cod(<?php echo $last_page;?>)" style="cursor: pointer;">
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
