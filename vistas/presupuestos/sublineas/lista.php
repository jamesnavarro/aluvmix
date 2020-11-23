<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

   $page= $_GET['page'];
           $request = mysqli_query($con,"SELECT count(*) FROM sublineas a, lineas b where a.id_linea=b.id_linea ");
             if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_slineas(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_slineas(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_slineas(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_slineas(<?php echo $last_page;?>)" style="cursor: pointer;">
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
        <th>linea</th> 
         <th>Grupo</th>
        <th nowrap>Precio Dolar X KG</th> 
        <th>Anonisado</th>
        <th nowrap>Transporte Descargue</th>
        <th>Anonisado</th>
    </tr>
 <?php 

$request_b = mysqli_query($con,"SELECT * FROM sublineas a, lineas b where a.id_linea=b.id_linea " .$limit );

  while ($fila = mysqli_fetch_array($request_b)){
        echo '<tr>'
        . '<td>'.$fila['id_sublineas'].'</td>'
        . '<td>'.$fila['linea'].'</td>'
        . '<td>'.$fila['descripcion_sl'].'</td>'
        . '<td>$'.$fila['precio_kg'].'</td>'
        . '<td>'.$fila['anonisado'].'%</td>'
        . '<td>'.$fila['transporte'].'%</td>'
        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar('.$fila['id_sublineas'].')" > <img src="../imagenes/modificar.png"></button></a>'
        . '<button onclick="borrar('.$fila['id_sublineas'].')" class="glyphicon glyphicon-remove"> </button></td>';
  }
?>
     
  </table><br>
</div><br>
  </div>
                        
                        
                        
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
