<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
     $nom= $_GET['nom'];
      $categorias= $_GET['categorias'];
   $page= $_GET['page'];
           $request = mysqli_query($con,"SELECT count(*) FROM colores_acc  where color like '%".$nom."%' and estado like '%".$categorias."%' ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);
            
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
                echo '</td>';


$request_a = mysqli_query($con,"SELECT * FROM colores_acc where color like '%".$nom."%' and estado like '%".$categorias."%' ".$limit );

  while ($fila = mysqli_fetch_array($request_a)){
        if($fila['estado']=='0'){
            $stilo = 'Activo';
            $plan += 1; 
        }else{
             $stilo = 'Inactivo';
             $com += 1;
        }
        echo '<tr>'
        . '<td>'.$fila['id_color'].'</td>'
        . '<td>'.$fila['color'].'</td>'
        . '<td>'.$stilo.'</td>'
        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar_a('.$fila['id_color'].')"data-toggle="tab" href="#agregar" > <img src="../imagenes/modificar.png"></button></a>'
        . '<button onclick="borrar('.$fila['id_color'].')" class="glyphicon glyphicon-remove"> </button></td>';
  }
echo '<tr><td colspan="5">';

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_ace(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_ace(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_ace(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_ace(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
  }else {
   
    header("location:../index.php");
    
}  ?>
