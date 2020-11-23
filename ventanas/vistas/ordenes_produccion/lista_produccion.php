<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 

     $ordenp= $_GET['ncot'];
     $nombre= $_GET['obra'];
     $fom= $_GET['fplus'];
     $page= $_GET['page']; 
            $request = mysqli_query($con,"SELECT count(*) FROM cotizacion a, orden_produccion b, cont_terceros c where a.id_cot= b.ref and a.id_tercero=c.id_ter and numero_cotizacion like '%".$ordenp."%' and nom_ter like '%".$nombre."%' and opf like '%".$fom."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_ordenes_produccion(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_ordenes_produccion(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_ordenes_produccion(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_ordenes_produccion(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .','.$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?>
                        <div style="float: right">
                            <button onclick="nuevo()">Nueva produccion</button>
                        </div><br>
<div class="table-responsive">          
  <table class="table">
    <tr class="bg-info">
        <th>id</th> 
        <th>Numero de cotizacion</th> 
        <th>OPF</th> 
        <th>Nombre de la obra</th> 
        <th>Opciones</th> 
    </tr>
    <?php
    $query = mysqli_query($con,"SELECT * FROM cotizacion a, orden_produccion b, cont_terceros c where a.id_cot= b.ref and a.id_tercero=c.id_ter and numero_cotizacion like '%".$ordenp."%' and nom_ter like '%".$nombre."%' and opf like '%".$fom."%'  ".$limit);
 
    while ($fila = mysqli_fetch_array($query)){
        echo '<tr>'
        . '<td>'.$fila['id_orden'].'</td>'
        . '<td>'.$fila['numero_cotizacion'].'.'.$fila['version'].'</td>'
        . '<td>'.$fila['opf'].'</td>'
        . '<td>'.$fila['nom_ter'].'</td>'
        . '<td><button onclick="editar('.$fila['id_orden'].')"><img src="../imagenes/ojo.png"><class="fa-unlock">editar</button></td>';
    }
    
    ?>
</table>
    </div>
<?php  }else {

    header("location:../index.php");
    
} ?>

