<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

     $nom= $_GET['nom_ter'];
     $page= $_GET['page'];
   
            $request = mysqli_query($con,"SELECT count(*) FROM usuarios where concat(nombre,' ',apellido) like '%".$nom."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../../imagenes/at1.png"  onclick="mostrar_usuario(1)" style="cursor: pointer;">
                        <img src="../../imagenes/at2.png"  onclick="mostrar_usuario(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../../imagenes/at1.png"> <img src="../../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../../imagenes/sig1.png"  onclick="mostrar_usuario(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../imagenes/sig2.png" onclick="mostrar_usuario(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../imagenes/sig1.png"> <img src="../../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?>

<div class="table-responsive">          
  <table class="table">
    <tr class="bg-info">
        <th>Usuario</th> 
        <th>Nombre</th>  
        <th>Cargo</th> 
    </tr>
    <?php
  
    $query = mysqli_query($con,"SELECT * FROM usuarios where concat(nombre,' ',apellido) like '%".$nom."%' ".$limit);
 
    while ($fila = mysqli_fetch_array($query)){
        $nombre = "'".$fila['usuario']."'";
        echo '<tr>'
        . '<td><a href="javascript:void(0);" onclick="seleccionar('.$nombre.')" >'.$fila['usuario'].'</a></td>'
        . '<td>'.$fila['nombre'].' '.$fila['apellido'].'</td>'
        . '<td>'.$fila['cargo'].'</td>';
  
    }
    
    ?>
</table>
    </div>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>

 