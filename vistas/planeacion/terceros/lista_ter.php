<?php 
include '../../../modelo/conexioni.php';
$con2 = $con;
session_start();
//9488
if(isset($_SESSION['k_username'])){
    $cod= $_GET['busTER'];
    $des= $_GET['busDOC'];
    $page= $_GET['page'];
            $request = mysqli_query($con2, "SELECT count(*) FROM cont_terceros where cod_ter like '%".$cod."%' and nom_ter like '%".$des."%' and estado_ter='0' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 200; 
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con2, "SELECT * FROM cont_terceros where cod_ter like '%".$cod."%' and nom_ter like '%".$des."%' and estado_ter='0' " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
            $ced = "'".$fila['cod_ter']."'";
            if($fila['validado']=='0'){
                $color="red";
                //$checked='checked';
            }else{
                $color="green";
                //$checked='';
            }
            $checked='checked';
        echo '<tr>'
        . '<td><input type="checkbox" name="item" id="'.$fila['id_ter'].'" '.$checked.' disabled></td>'
        . '<td><input type="text" value="'.$fila['doc_ter'].'" style="width:100%" disabled></td>'
        . '<td><input type="text" id="ced'.$fila['id_ter'].'" value="'.$fila['cod_ter'].'" style="width:100%" disabled></td>'
        . '<td><input type="text" id="nom'.$fila['id_ter'].'" value="'.$fila['nom_ter'].'" style="width:100%" disabled></td>'
        . '<td>'.$fila['telfijo_ter'].'.<br><b>movil: </b>.'.$fila['telmovil_ter'].'</td><td>'.$fila['estado_ter'].'</td>'
        
//        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar('.$fila['id_ter'].')" ><img src="images/modificar.png"></button></a>'
                . '<td bgcolor="'.$color.'" id="td'.$fila['id_ter'].'"><img style="cursor:pointer" onclick="existefom('.$ced.')" src="../imagenes/verificar.png" width="20px">'
        . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="
                            (1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_terp(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" onchange="mostrar_terp(this.value)" value="<?php echo $page;?>" style="width: 50px; height: 20px"><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_terp(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_terp(<?php echo $last_page;?>)" style="cursor: pointer;">
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
