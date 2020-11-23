<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){


             $columna = ' and a.descripcion like "%'.$_GET['desc'].'%" and b.nombre_tipo like "%'.$_GET['tip'].'%" and c.nombres like "%'.$_GET['usu'].'%" and a.fecha_reg like "'.$_GET['fec'].'%" ';


            $page = $_GET['page'];

            $request = mysqli_query($con,"SELECT count(id_a) FROM articulos a, tipos b, usuarios c where a.id_tipo=b.id_tipo and a.registrado_por=c.id_usuario $columna ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 2;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_productos(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_productos(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_productos(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_productos(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?>
                        <div style="float: right">
                            <button onclick="nuevo()"> Nuevo Producto</button>
                        </div>
<div class="table-responsive">          
  <table class="table">
    <tr>
        <th>Id</th>
        <th>DESCRIPCION</th>
        <th>PRECIO</th>
        <th>TIPO</th>
        <th>REGISTRADO POR</th>
        <th>FECHA DE REGISTRO</th>
        <th>Opciones</th>
        
    </tr>
    <?php

       $query = mysqli_query($con,"SELECT a.id_a, a.descripcion, a.precio, b.nombre_tipo, c.nombres, a.fecha_reg FROM articulos a, tipos b, usuarios c where a.id_tipo=b.id_tipo and a.registrado_por=c.id_usuario $columna ".$limit);

  
    while ($fila = mysqli_fetch_array($query)){
        echo '<tr>'
        . '<td>'.$fila['id_a'].'</td>'
        . '<td>'.$fila['descripcion'].'</td>'
        . '<td>'.$fila['precio'].'</td>'
        . '<td>'.$fila['nombre_tipo'].'</td>'
        . '<td>'.$fila['nombres'].'</td>'
        . '<td>'.$fila['fecha_reg'].'</td>'
        . '<td><button onclick="borrar('.$fila['id_a'].')"> <img src="../imagenes/borrar.png"> Borrar </button> '
        . '<button onclick="editar('.$fila['id_a'].')"> <img src="../imagenes/modificar.png"> Editar </button></td>';
    }
    
    ?>
</table>
    </div>
<?php  }else {

    header("location:../index.php");
    
} ?>

