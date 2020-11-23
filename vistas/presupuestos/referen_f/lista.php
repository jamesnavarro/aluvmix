<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $est_b= $_GET['est_b'];
    $page= $_GET['page'];
     $sistema= $_GET['sistema'];
            $request = mysqli_query($con,"SELECT count(*) FROM productos where tipo_ref='' and pro_referencia like '%".$cod."%' and pro_nombre like '%".$est_b."%' and sistema like '%".$sistema."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM productos where  tipo_ref='' and pro_referencia like '%".$cod."%' and pro_nombre like '%".$est_b."%' and sistema like '%".$sistema."%' ".$limit);
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
         {         
          
            $ref = "'".$fila['pro_referencia']."'";
        echo '<tr>'
       . '<td>'.$fila['sistema'].'</td>'
       . '<td nowrap>'.$fila['pro_referencia'].'</td>'
       . '<td>'.$fila['pro_nombre'].'</td>'
      . '<td nowrap>'.$fila['peso'].'</td>'
      . '<td nowrap>'.$fila['perimetro'].'</td>'
      . '<td nowrap>'.$fila['perimetro_t'].'</td>'
      . '<td nowrap>'.$fila['costo_aluminio'].'</td>'
       . '<td style="text-align:left"><a data-toggle="tab" href="#agregar"><img onclick="editar_reff('.$ref.')"src="images/modificar.png"></a> &nbsp; &nbsp; <img onclick="borrar_ref('.$ref.')" src="images/no.png">'
       . '</td>' ;
  }
   echo '<tr class="bg-info"><td colspan="8">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_reff(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_reff(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_reff(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_reff (<?php echo $last_page;?>)" style="cursor: pointer;">
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
