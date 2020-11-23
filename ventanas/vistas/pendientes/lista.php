<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

     $nombre= $_GET['nomb'];
     $page= $_GET['page'];
   
            $request = mysqli_query($con,"SELECT count(*) from informacion_obras a, cont_terceros b, cotizacion c where a.id_ter = b.id_ter and a.numero_cot = c.numero_cotizacion and a.version=c.version and concat(b.nom_ter,' ',a.nombre_obra) like '%".$nombre."%'  ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 7;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_pendientes(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_pendientes(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_pendientes(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_pendientes(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro  '.$num_items; 
             
    ?>
                        <div style="float: right">
                            <button onclick="nuevo()"><img src="../imagenes/trato.png" width="26px" height="26px"><b>CONTRATO</b></button>
                        </div><br>
                        
                        <div class="table-responsive"> <br>         
    <table class="table">
    <tr class="bg-info">   
        <th>Rad.</th>
        <th width="20%">Nombre Cliente</th>
        <th width="20%">Nombre de obra</th>
        <th>Vendedor</th> 
        <th>#Contrato</th>
        <th><b>$</b>Contrato</th>
        <th>Valor anticipo</th>
        <th>Notas</th> 
        <th>Valor cobro</th>
        <th>Estado de cobro</th> 
        <th>Fecha de pago</th> 
        <th>DETALLES</th> 

    </tr>
    <?php
   
    $query = mysqli_query($con,"SELECT *,a.vendedor from informacion_obras a, cont_terceros b, cotizacion c where a.id_ter = b.id_ter and a.numero_cot = c.numero_cotizacion and a.version=c.version and concat(b.nom_ter,' ',a.nombre_obra) like '%".$nombre."%' order by id_inf desc ".$limit);
    
    $cancecont = 0; 
    $nocance = 0;
    while ($fila = mysqli_fetch_array($query)){
        if($fila['estado_cont']=='NC'){
            $stilos = ' style="background-color:red;" ';
            $nocance += 1; 
        }else{
             $stilos = ' style="background-color:#428bca;" ';
             $cancecont   += 1;
        }
        
        
        echo '<tr>'
       . '<td>'.$fila['id_inf'].'</td>'
        . '<td  width="20%">'.$fila['nom_ter'].'</td>'
        . '<td width="20%">'.$fila['nombre_obra'].'</td>'
//        . '<td>'.$fila['obj_contra'].'</td>'
        . '<td>'.$fila['vendedor'].'</td>'
//        . '<td>'.$fila['cor_obra'].'</td>'
//        . '<td>'.$fila['sup_obra'].'</td>'
//        . '<td>'.$fila['instalacion'].'</td>'
        . '<td>'.$fila['numero_contrato'].'</td>'
        . '<td>'.$fila['valor_cont'].'</td>'
//        . '<td>'.$fila['limite_pago_c'].'</td>'
        . '<td>'.$fila['val_antici'].'</td>'
        . '<td>'.$fila['observaciones'].'</td>'
        . '<td>'.$fila['val_antici'].'</td>'
        . '<td '.$stilos.'> '.$fila['estado_cont'].'</td>'
        . '<td>'.$fila['fecha_pago'].'</td>'
        . '<td> <button onclick="detalles('.$fila['id_inf'].')" class="glyphicon glyphicon-list-alt"></button><button onclick="editar_pendientes('.$fila['id_inf'].')" class="glyphicon glyphicon-pencil"></button></td>';
      
    
    }
    ?>
</table>
   <?php
    echo 'no cancelados : <font color="red"> <b>'.$nocance.'</b> </font>'
   ?> <br>
    <?php
    echo 'cancelados : <font color="#428bca"> <b>'.$cancecont.'</b> </font>'
    ?>
                        </div> <br>
<?php  }else {
    header("location:../index.php");
} ?>

