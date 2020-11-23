<?php 
include '../../../modelo/conexionv1.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $est=$_GET['est'];
    $lin=$_GET['lin'];
    $tra=$_GET['tra'];
    $cp=$_GET['cp'];
    $cc=$_GET['cc'];
   $page= $_GET['page'];
            $request = mysqli_query($con2,"SELECT count(*) FROM subproceso where id_subpro like '%".$cod."%' and nombre_subpro like '%".$des."%' and sede_sub like '%".$lin."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con2,"SELECT * FROM subproceso where id_subpro like '%".$cod."%' and nombre_subpro like '%".$des."%' and sede_sub like '%".$lin."%'  " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  

  $estado='images/ok.png';

 if ($fila['asignacion']== '1') {
  $tra='Automatica';
}else{
  $tra='Manual';
}
$cod = "'".$fila['id_subpro']."'";
$des = "'".$fila['nombre_subpro']."'";
        echo '<tr>'

        . '<td>'.$fila['id_subpro'].'</td>'
        . '<td>'.$fila['nombre_subpro'].'</td>'
        . '<td>'.$fila['sede_sub'].'</td>'
        . '<td>'.$tra.'</td>'
        . '<td>'.$fila['codigo_cp'].'</td>'
                . '<td>'.$fila['codigo_cc'].'</td>'
        . '<td>'.$fila['fecha_reg'].'</td>'
        . '<td>-</td>'
        . '<td><img src="'.$estado.'"></td>'
                . '<td><button data-toggle="modal" data-target="#ModalPrecios" onclick="verprecio('.$fila['id_subpro'].','.$des.')">Precios</button></td>'
        . '<td><a data-toggle="tab" href="#lin2"><button onclick="editar_lin('.$cod.')" ><img src="images/modificar.png"></button></a>'
        . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_line(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_line(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_line(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_line(<?php echo $last_page;?>)" style="cursor: pointer;">
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
