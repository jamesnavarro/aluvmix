<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

     $num= $_GET['buscar'];
     $page= $_GET['page'];
   
            $request = mysqli_query($con,"SELECT count(*) FROM cotizacion a,  cont_terceros b where a.estado='Aprobado' and a.id_tercero= b.id_ter and concat(a.numero_cotizacion,' ',b.nom_ter,' ',a.obra) like '%".$num."%'  ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../../imagenes/at1.png"  onclick="mostrar_cotizaciones(1)" style="cursor: pointer;">
                        <img src="../../imagenes/at2.png"  onclick="mostrar_cotizaciones(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../../imagenes/at1.png"> <img src="../../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../../imagenes/sig1.png"  onclick="mostrar_cotizaciones(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../imagenes/sig2.png" onclick="mostrar_cotizaciones(<?php echo $last_page;?>)" style="cursor: pointer;">
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
        <th>numero</th> 
        <th>nombre del cliente</th>  
        <th>nombre de la obra</th> 
        <th>Valor de Contrato</th>
    </tr>
    <?php
   
    $query = mysqli_query($con,"SELECT a.numero_cotizacion,a.version,b.id_ter,b.nom_ter, a.obra, a.registrado, a.costo_total FROM cotizacion a,  cont_terceros b where a.estado='Aprobado' and  a.id_tercero= b.id_ter and concat(a.numero_cotizacion,' ',b.nom_ter,' ',a.obra) like '%".$num."%' ".$limit);
  
    while ($fila = mysqli_fetch_array($query)){
        $nombre = "'".$fila['nom_ter']."'";
        $obra = "'".$fila['obra']."'";
        $vende = "'".$fila['registrado']."'";
        
        echo '<tr>'
        . '<td><a href="javascript:void(0);" onclick="seleccionar('.$fila['numero_cotizacion'].','.$fila['version'].','.$fila['id_ter'].','.$nombre.','.$obra.','.$vende.','.ceil($fila['costo_total']).')"> '.$fila['numero_cotizacion'].'.'.$fila['version'].'</a></td>'
        . '<td>'.$fila['nom_ter'].'</td>'
        . '<td>'.$fila['obra'].'</td>'
        . '<td>'.$fila['costo_total'].'</td>';
    }
    
    ?>
</table>
    </div>
<?php  }else {
 
    header("location:../index.php");
    
}  ?>

 