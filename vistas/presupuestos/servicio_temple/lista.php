<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $spesr= $_GET['espe_nue'];
   $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM servicio_temple where  espesor like '%".$spesr."%'" );

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_temple(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_temple(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_temple(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_temple(<?php echo $last_page;?>)" style="cursor: pointer;">
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
        <th>ITEMS</th>
        <th>ESPESOR</th>
        <th>COSTO TEMPLE</th> 
        <th>EDITAR</th> 
    </tr>
 <?php 
 echo $spesr;
$query = mysqli_query($con,"SELECT * FROM servicio_temple where  espesor like '%".$spesr."%'" .$limit );

  while ($fila = mysqli_fetch_array($query)){
        echo '<tr>'
        . '<td>'.$fila['id_temple'].'</td>'
        . '<td>'.$fila['espesor'].'</td>'
        . '<td>'.$fila['costo'].'</td>'
        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar('.$fila['id_temple'].')" > <img src="../imagenes/modificar.png"></button></a></td>';
 
  }
?>
</table>
 </div>
                        </div>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
