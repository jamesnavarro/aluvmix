<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $est_b= $_GET['est_b'];
    $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM precios_instalaciones where concat(nom_insta,' ',gruposistemas) like '%".$cod."%' and sistema_insta like '%".$est_b."%'");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM precios_instalaciones where concat(nom_insta,' ',gruposistemas) like '%".$cod."%' and sistema_insta like '%".$est_b."%' order by id_precios ASC " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
         {         
            if($fila['estado_insta']=='0'){
            $estat = 'ACTIVO</b>';
            $gra = 'ok-circle';
            $plan += 1; 
        }else{
             $estat = 'INACTIVO</b>';
             $gra = 'lock';
             $com += 1;
        }
        $query = mysqli_query($con, "select sistema from precios_instalaciones_sistemas where id_precios='".$fila['id_precios']."' ");
        $sistema = '';
        while($s = mysqli_fetch_array($query)){
            $sistema = $sistema.$s[0].'-';
        }
        echo '<tr>'
       . '<td>'.$fila['id_precios'].'</td>'
       . '<td nowrap>'.$fila['nom_insta'].' '.$sistema.'</td>'
       . '<td nowrap>'.$fila['sistema_insta'].'</td>'
       . '<td>'.$fila['umb'].'</td>'
       . '<td>'.number_format($fila['total_1']).'</td>'
    
       . '<td>'.$fila['parafiscales']. '<b>&nbsp %</b>'.'</td>'
        . '<td>'.$estat.'</td>'
       . '<td><a data-toggle="tab" href="#agregar"><img onclick="editar_precio('.$fila['id_precios'].')" src="images/modificar.png"></a>'
                . '<button onclick="sisins('.$fila['id_precios'].')" class="glyphicon glyphicon-list-alt" title="Agregar Sistemas" data-toggle="modal" data-target="#modalsistema"> </button>'
                . '<button onclick="cam('.$fila['id_precios'].','.$fila['estado_insta'].')" class="glyphicon glyphicon-'.$gra.'"> '
       . '</td>';
  }
   echo '<tr class="bg-info"><td colspan="9">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_pinsta(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_pinsta(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_pinsta(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_pinsta (<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="images/sig1.png"> <img src="images/sig2.png"> <?php
                }
                
                echo 'Cantidad de registro '.$num_items; 
                echo '</td></tr>';
                 ?>
  
<?php  }else {
      echo 'error';
}  ?>
