<?php 
include '../../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $des= $_GET['des'];
    $est=$_GET['est'];
    $res=$_GET['res'];
   $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM mov_inventario where codigo_tm!=2006 and  id_mov like '%".$des."%' and codigo_tm like '%".$res."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM mov_inventario where codigo_tm!=2006 and id_mov like '%".$des."%' and codigo_tm like '%".$res."%' order by id_mov DESC  " .$limit. "" );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
        $ti=mysqli_query($con,"SELECT movimiento FROM tipos_movimientos WHERE codigo_tm='".$fila['codigo_tm']."' LIMIT 1");
        $tip=mysqli_fetch_assoc($ti);
 if ($fila['save_mov']>0) {
     $estado='<font color="green">Guardado</font>';
}else{
     $estado='<font color="red">En proceso</font>';
} 
$cod = "'".$fila['codigo_tm']."'";
$send=$fila['id_mov'].",'".trim($fila['tipo_movimiento'])."',".$fila['save_mov'];
        echo '<tr>'

            . '<td>'.$fila['id_mov'].'</td>'
        . '<td>'.$fila['codigo_tm'].'</td>'
         . '<td>'.$fila['tipo_movimiento'].'</td>'
        . '<td>'.$tip['movimiento'].'</td>'
        . '<td>'.$estado.'</td><td>'.$fila['fecha_pro'].'</td><td>'.$fila['usuario'].'</td>'
        . '<td><button onclick="volver_cargar('.$send.');">Ver</button></td>'
        . '</tr>';
  }
   echo '<tr style="background:#E7E7E7"><td colspan="8">';
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
