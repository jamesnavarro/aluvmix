<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $ngast= $_GET['gast_nue'];
   $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM subproceso where concat(nombre_subpro,' ',sede_sub) like '%".$ngast."%'");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_prearea(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_prearea(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_prearea(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_prearea(<?php echo $last_page;?>)" style="cursor: pointer;">
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
        <th>DESCRIPCION DE AREA</th>
        <th>LINEA</th> 
        <th>ASIGNACION</th>
        <th>PRECIO FABRICACION</th>
        <th>PRECIO ADICIONAL</th>
        <th>MEDIDA MAQUINAS</th>
        <th>OPCIONES</th>
    </tr>
 <?php 

$query = mysqli_query($con,"SELECT * FROM subproceso where concat(nombre_subpro,' ',sede_sub) like '%".$ngast."%' ".$limit );
 
 
  while ($fila = mysqli_fetch_array($query)){
  
        if($fila['asignacion']=='0'){
           $ma = 'Manual';
        }else{
            $ma = 'Automatico'; 
        }
      
        echo '<tr>'
        . '<td>'.$fila['id_subpro'].'</td>'
        . '<td>'.$fila['nombre_subpro'].'</td>'
        . '<td>'.$fila['sede_sub'].'</td>'
        . '<td>'.$ma.'</td>'
        . '<td>'.$fila['precio'].'</td>'
        . '<td>'.$fila['precio_adicional'].'</td>'
        . '<td>'.$fila['medida'].'</td>'
        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar_p('.$fila['id_subpro'].')" > <img src="../imagenes/modificar.png"></button></a>'
        . '<button onclick="borrar('.$fila['id_subpro'].')" class="glyphicon glyphicon-remove"> </button></td>';
  }
?>
</table>
 </div>
</div>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
