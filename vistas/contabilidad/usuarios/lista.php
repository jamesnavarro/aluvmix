<?php 
include '../../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $res=$_GET['res'];
    $tpdoc=$_GET['tpd'];
    $est=$_GET['est'];
    $page= $_GET['page'];
            $request = mysqli_query($conexion, "SELECT count(*) FROM usuarios  where usuario like '%".$cod."%' and nombre like '%".$des."%' and apellido like '%".$res."%' and celular like '%".$tpdoc."%' and estado like '".$est."%' ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($conexion, "SELECT * FROM usuarios where usuario like '%".$cod."%' and nombre like '%".$des."%' and apellido like '%".$res."%' and celular like '%".$tpdoc."%' and estado like '".$est."%' " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
 if ($fila['estado']=="No Activo") {
  $esta='<input type="checkbox" id="e'.$fila['id_user'].'" onclick="upest('.$fila['id_user'].')">';
}else{
  $esta='<input type="checkbox" id="e'.$fila['id_user'].'" checked onclick="upest('.$fila['id_user'].')">';
}
$total2++;
if($total2==1){
    $dis='';//disabled
}else{
    $dis='';
}
//<a data-toggle="tab" href="#lin2"><button onclick="editar_usu('.$fila['id_user'].')" ><img src="images/modificar.png"></button></a>
$cod = "'".$fila['usuario']."'";
        echo '<tr>'
        . '<td>'.$fila['id_user'].'</td>'
        . '<td>'.$fila['usuario'].'</td>'
        . '<td>'.$fila['userfom'].'</td>'
        . '<td>'.$fila['nombre'].'</td>'
        . '<td>'.$fila['apellido'].'</td>'
        . '<td>'.$fila['email'].'</td>'
        . '<td>'.$fila['telefono'].'<br>'.$fila['celular'].'</td>'
        . '<td>'.$esta.'</td>'
        . '<td>'
        . '</td><td><button onclick="roluser('.$fila['id_user'].')" '.$dis.'>Rol</button></td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_usu(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_usu(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_usu(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_usu(<?php echo $last_page;?>)" style="cursor: pointer;">
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
