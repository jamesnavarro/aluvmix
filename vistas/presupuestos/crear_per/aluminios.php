<?php // 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    
   $cod= $_GET['cod'];
   $des= $_GET['des'];
   $ref= $_GET['ref'];
   $gru= $_GET['gro'];
   if($gru==0){
       $agrupado = ' group by referencia ';
   }else{
       $agrupado = '';
   }

   $page= $_GET['page'];
            $request = mysqli_query($con, "SELECT referencia FROM productos_var where codigo like '%".$cod."%' and descripcion like '%".$des."%' and referencia like '%".$ref."%' and linea='Aluminio' $agrupado ");

            if($request){
                    $req = mysqli_num_rows($request);
                    $num_items = $req;//holaeric
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);
            echo '<tr><td colspan="5">';
                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_aluminio(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_aluminio(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_aluminio(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_aluminio(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro: '.$num_items.' | <span id="msg"></span>'; 
    ?> 


 <?php 

$query = mysqli_query($con, "SELECT *  FROM productos_var where codigo like '%".$cod."%' and descripcion like '%".$des."%' and referencia like '%".$ref."%' and linea='Aluminio' $agrupado  ".$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($query))
	{
            $cadena = $fila['codigo'];
            $pieces = explode("-", $cadena);
            $fila["color"];
            $color = substr($pieces[1],-2);
            $co = $color.'00';
                     
?>
               <tr>
                    <td><?php echo $fila['codigo']; ?></td>
                    <td><?php echo $fila['descripcion']; ?></td>
                    <td><?php echo $fila['referencia']; ?></td>
                    <td><?php echo $fila['color']; ?></td>
                    <td>$<?php echo number_format($fila["costo_calculado"]); ?></td>
                    <td><input type="text" id="peso<?php echo $fila['referencia']; ?>" value="<?php echo $fila['peso']; ?>" onchange="actuaper('<?php echo $fila['referencia']; ?>')" style="width:80px"></td>
                    <td><input type="text" id="area<?php echo $fila['referencia']; ?>" value="<?php echo $fila['area']; ?>" onchange="actuaper('<?php echo $fila['referencia']; ?>')" style="width:80px"></td>
                    <td><input type="text" id="areat<?php echo $fila['referencia']; ?>" value="<?php echo $fila['areat']; ?>" onchange="actuaper('<?php echo $fila['referencia']; ?>')" style="width:80px"></td>
                    <td><input type="checkbox" name="item" id="<?php echo $fila['codigo']; ?>"></td>
               </tr>
    
    
        <?php } ?>

<?php  }else {
   
    header("location:../index.php");
    
}  ?>
