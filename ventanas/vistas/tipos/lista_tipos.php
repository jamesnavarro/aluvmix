<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

     $tipo=$_GET['tipo'];
     $estado=$_GET['estado'];
     $page = $_GET['page'];

            $request = mysqli_query($con,"  SELECT count(*) FROM tipos where nombre_tipo like '%".$tipo."%' and estado like '%".$estado."%' ");

            if($request){
                    $request = mysqli_fetch_row($request)or die(mysqli_error());
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 2;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_tipos(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_tipos(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_tipos(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_tipos(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?>
                        <div style="float: right">
                            <button onclick="nuevo()"> Nuevo tipo</button>
                        </div><br>
<div class="table-responsive">          
  <table class="table">
    <tr>
        <th>tipo</th> 
        <th>estado</th>
        <th>opciones</th> 
    </tr>
    <?php
 
    $query = mysqli_query($con,"SELECT * FROM tipos where nombre_tipo like '%".$tipo."%' and estado like '%".$estado."%' ".$limit);

  
    while ($fila = mysqli_fetch_array($query)){
        echo '<tr>'
       
        . '<td>'.$fila['nombre_tipo'].'</td>'
        . '<td>'.$fila['estado'].'</td>'
        
        . '<td><button onclick="borrar('.$fila['id_tipo'].')"> <img src="../imagenes/borrar.png"> Borrar </button> '
        . '<button onclick="editar('.$fila['id_tipo'].')"> <img src="../imagenes/modificar.png"> Editar </button></td>';
    }
    
    ?>
</table>
    </div>
<?php  }else {

    header("location:../index.php");
    
}  ?>

