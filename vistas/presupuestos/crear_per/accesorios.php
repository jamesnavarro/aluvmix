<?php // 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    
   $cod= $_GET['cod'];
   $des= $_GET['des'];
   $ref= $_GET['ref'];

   $page= $_GET['page'];
            $request = mysqli_query($con, "SELECT count(*) FROM productos_var where codigo like '%".$cod."%' and descripcion like '%".$des."%' and referencia like '%".$ref."%' and linea='Accesorios' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);
            echo '<tr><td colspan="5">';
                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_accesorios(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_accesorios(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_accesorios(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_accesorios(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro: '.$num_items; 
    ?> 


 <?php 

$query = mysqli_query($con, "SELECT *  FROM productos_var where codigo like '%".$cod."%' and descripcion like '%".$des."%' and referencia like '%".$ref."%' and linea='Accesorios' ".$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($query))
	{
?>
               <tr>

                    <td><?php echo $fila['codigo']; ?></td>
                    <td><?php echo $fila['descripcion']; ?></td>
                    <td><?php echo $fila["referencia"]; ?></td>
                    <td><?php echo $fila["color"]; ?></td>
                    <td>$<?php echo number_format($fila["costo_promedio"]); ?></td>
                    <td><?php echo $fila["usuario"]; ?>
                   </td>
                   <td><input type="checkbox" name="item" id="<?php echo $fila['codigo']; ?>"></td>
                </tr>
    
    
        <?php } ?>

<?php  }else {
   
    header("location:../index.php");
    
}  ?>
