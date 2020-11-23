<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
   $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM productos_var where codigo like '%".$cod."%'");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM productos_var where codigo like '%".$cod."%'" .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
 if ($fila['cla_estado']== '1') {
  $estado='images/no.png';
}else{
  $estado='images/ok.png';
}
$cod = "'".$fila['cla_codigo']."'";
$stock='';
$sear=mysqli_query($con,"SELECT stock_actual FROM pro_stock WHERE codigo_pro='".$fila['codigo']."'");
if($rw=mysqli_fetch_assoc($sear)){
    if($rw['stock_actual']>$fila['stock_max']){
        $stock='<b style="color: blue;font-size: 20px">'.$rw['stock_actual'].'</b>';
    }elseif ($rw['stock_actual']<$fila['stock_max'] and $rw['stock_actual']>$fila['stock_min']) {
        $stock='<b style="color: green;font-size: 20px">'.$rw['stock_actual'].'</b>';
    }elseif ($rw['stock_actual']<$fila['stock_min'] and $rw['stock_actual']>$fila['stock_seg']) {
        $stock='<b style="color: yellow;font-size: 20px">'.$rw['stock_actual'].'</b>';
    }elseif ($rw['stock_actual']<=$fila['stock_seg']) {
        $stock='<b style="color: red;font-size: 20px">'.$rw['stock_actual'].'</b>';
    }
}
        echo '<tr>'

        . '<td>'.$fila['codigo'].'</td>'
        . '<td>'.$fila['descripcion'].'</td>'
        . '<td>'.$stock.'</td>'
       ;
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
