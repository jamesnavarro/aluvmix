<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

     $num= $_GET['opnum'];
     $page= $_GET['page'];
   
            $request = mysqli_query($con,"SELECT count(*) from master_produccion where estado ='terminado' and op like '%".$num."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 5;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_terminadas(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_terminadas(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_terminadas(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_terminadas(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro  '.$num_items; 
             
    ?>
                        <div style="float: right">
                            <button onclick="nuevo()">Nueva actividad</button>
                        </div><br>
<div class="table-responsive">          
    <table class="table"><br>
       
    <tr class="bg-info">
        <th>OP</th>
        <th>OPF</th> 
        <th>Fecha De La Op</th> 
        <th>Fecha Despacho</th> 
        <th>Nombre Obra-Cliente</th> 
        <th>Clase</th>  
        <th>Ubicacion</th> 
        <th>Cant</th>
        <th>Observacones</th>
        <th>Estado</th>
      
      
    </tr>
    <?php
 
    $query = mysqli_query($con,"SELECT * from master_produccion where estado = 'terminado' and op like '%".$num."%' ".$limit);

  
    while ($fila = mysqli_fetch_array($query)){
        echo '<tr>'
        . '<td>'.$fila['op'].'</td>'      
        . '<td>'.$fila['opf'].'</td>'
        . '<td>'.$fila['fecha_orden'].'</td>'
        . '<td>'.$fila['fecha_despachada'].'</td>'
        . '<td>'.$fila['nombre_obra'].'.'.$fila['nombre_cliente'].'</td>'
        . '<td>'.$fila['clase'].'</td>'
        . '<td>'.$fila['ubicacion'].'</td>'
        . '<td>'.$fila['cantidad'].'</td>'
        . '<td>'.$fila['observacion'].'</td>'
        . '<td>'.$fila['estado'].'</td>'
    
        . '<td><button onclick="borrar('.$fila['id_m'].')"><img src="../imagenes/print.png"> imprimir </button> '
        ;
    }
    
    ?>
</table>
    </div>
<?php  }else {

    header("location:../index.php");
    
}  ?>

