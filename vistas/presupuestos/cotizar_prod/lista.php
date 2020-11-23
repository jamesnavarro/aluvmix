<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
 
   $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM dolares ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_doll(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_doll(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_doll(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_doll(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?> 
<div class="table-responsive">  
    <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
 <table class="table table-hover">
    <tr class="bg-info">
        <th>Items</th>
        <th>% L.M.A</th> 
        <th>Precio dolar</th>
        <th>Variable prima</th>
         <th>Costo aluminio</th>
         <th>Fecha registro</th>
         <th>Registrado por</th>
         <th>OPCIONES</th>
    </tr>
 <?php 

$request_ac = mysqli_query($con,"SELECT * FROM dolares order by id_dolar desc " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
        echo '<tr>'
        . '<td>'.$fila['id_dolar'].'</td>'
        . '<td>'.$fila['lma'].'</td>'
        . '<td>'.$fila['precio_dolar'].'</td>'
        . '<td>'.$fila['prima'].'</td>'
        . '<td>'.$fila['precio_actual'].'</td>'
        . '<td>'.$fila['fecha_reg_dolar'].'</td>'
        . '<td>'.$fila['ingresado_por'].'</td>'
        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar('.$fila['id_dolar'].')" > <img src="../imagenes/modificar.png"></button></a>'
        . '<button onclick="borrar('.$fila['id_dolar'].')" class="glyphicon glyphicon-remove"> </button></td>';
  }
?>
</table>
 </div>
</div>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
