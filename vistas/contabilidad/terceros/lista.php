<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $est=$_GET['est'];
    $res=$_GET['res'];
    $tpdoc=$_GET['tpd'];
    $page= $_GET['page'];
            $request = mysqli_query($con, "SELECT count(*) FROM cont_terceros where cod_ter like '%".$cod."%' and nom_ter like '%".$des."%' and estado_ter like '%".$res."%' and doc_ter like '%".$tpdoc."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con, "SELECT * FROM cont_terceros where cod_ter like '%".$cod."%' and nom_ter like '%".$des."%' and estado_ter like '%".$res."%' and doc_ter like '%".$tpdoc."%'  " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
 if ($fila['estado_ter']== '1') {
  $esta='images/no.png';
}else{
  $esta='images/ok.png';
}
$cod = "'".$fila['cod_ter']."'";
        echo '<tr>'

        
        . '<td>'.$fila['doc_ter'].'</td>'
        . '<td>'.$fila['cod_ter'].'</td>'
        . '<td>'.$fila['nom_ter'].'</td>'
        . '<td>'.$fila['telmovil_ter'].$fila['telfijo_ter'].'</td>'
        . '<td><img src="'.$esta.'"></td>'
       
        . '<td><a data-toggle="tab" href="#lin2"><button onclick="editar_ter('.$cod.')" ><img src="images/modificar.png"></button></a>'
        . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_ter(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_ter(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_ter(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_ter(<?php echo $last_page;?>)" style="cursor: pointer;">
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
