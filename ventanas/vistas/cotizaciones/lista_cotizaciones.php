<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

     $ubi= $_GET['cot'];
     $clien= $_GET['clien'];
     $obra= $_GET['nom_o'];
     $guard=$_GET['guardad'];
     $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM cotizacion a,  cont_terceros b, usuarios c where a.id_tercero= b.id_ter and c.usuario= a.grabado and numero_cotizacion like '%".$ubi."%' and nom_ter like '%".$clien."%' and obra like '%".$obra."%' and grabado like '%".$guard."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_cotizaciones(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_cotizaciones(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_cotizaciones(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_cotizaciones(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?>
                        <div style="float: right">
                            <button onclick="nuevo()"><img src="../imagenes/pesos.png" width="23px" height="21px"><b>Nueva cotizacion</b></button>
                        </div><br>
<div class="table-responsive">          
  <table class="table">
    <tr class="bg-info">
        <th>Numero de cotizacion</th> 
        <th>Documento</th> 
        <th>Cliente</th> 
        <th>Nombre de la obra</th>
        <th>Fecha de registro</th> 
        <th>Ultima modificaciom</th> 
        <th>Ultima impresion</th> 
        <th>Guardado</th>
        <th>Responsable</th> 
        <th>Guardado por</th> 
        <th>Estado</th> 
        <th>Opciones</th> 
    </tr>
    <?php

    echo $ubi;
    $query = mysqli_query($con,"SELECT a.numero_cotizacion,b.nom_ter, a.obra, a.grabado, a.responsable, a.fecha_modificacion, a.fecha_reg_c, a.impresion, a.estado, b.cod_ter FROM cotizacion a, cont_terceros b, usuarios c where a.id_tercero= b.id_ter and c.usuario= a.grabado and a.numero_cotizacion like '%".$ubi."%' and b.nom_ter like '%".$clien."%' and a.obra like '%".$obra."%' and a.grabado like '%".$guard."%' order by id_cot desc ".$limit);
 
    while ($fila = mysqli_fetch_array($query)){
        echo '<tr>'
        . '<td>'.$fila['numero_cotizacion'].'.'.$fila['version'].'</td>'
        . '<td>'.$fila['cod_ter'].'</td>'
        . '<td>'.$fila['nom_ter'].'</td>'
        . '<td>'.$fila['obra'].'</td>'
        . '<td>'.$fila['fecha_reg_c'].'</td>'  
        . '<td>'.$fila['fecha_modificacion'].'</td>'
        . '<td>'.$fila['impresion'].'</td>'
        . '<td>'.$fila['fecha_guardado'].'</td>'
        . '<td>'.$fila['responsable'].'</td>'
        . '<td>'.$fila['grabado'].'</td>'
        . '<td>'.$fila['estado'].'</td>'
        . '<td><button onclick="imprimir('.$fila['id_cot'].')"> <img src="../imagenes/print.png"> Imp </button></td>';
    }
    
    ?>
</table>
    </div>
<?php  }else {

    header("location:../index.php");
    
} ?>

