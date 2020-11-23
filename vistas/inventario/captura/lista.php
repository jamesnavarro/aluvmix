<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
     
       $cod= $_GET['cod']; 
        $fecha= $_GET['fecha'];
        $c_bod= $_GET['c_bod']; 
        $nom_alm= $_GET['nom_alm'];
        $lin_a= $_GET['lin_a']; 
        
       $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM capturas where id_captura like '%".$cod."%' and fecha_cap like '%".$fecha."%' and cod_bodega like '%".$c_bod."%' and nom_bod like '%".$nom_alm."%' and linea like '%".$lin_a."%' ");

            if($request){
                    $req = mysqli_fetch_row($request);
                    $num_items = $req[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM capturas where id_captura like '%".$cod."%' and fecha_cap like '%".$fecha."%' and cod_bodega like '%".$c_bod."%' and nom_bod like '%".$nom_alm."%' and linea like '%".$lin_a."%' order by id_captura desc  " .$limit );

	while($fila=mysqli_fetch_array($request_ac))
	{  
        if($fila['estado']==0){
            $est = 'En proceso';
            $color = 'danger';
                      }else{
                         $est = 'Guardado';
                         $color = 'primary';
                        }

        echo '<tr>'
        . '<td>'.$fila['id_captura'].'</td>'
        . '<td>'.$fila['fecha_cap'].'</td>'
        . '<td nowrap>'.$fila['cod_bodega'].'</td>'
        . '<td>'.$fila['nom_bod'].'</td>'
        . '<td>'.$fila['linea'].'</td>'
        . '<td>'.$fila['registrado_por'].'</td>'
        . '<td><button onclick="inv_cap_inv('.$fila['id_captura'].')" class="btn btn-'.$color.'"> Ver</button></a>'
        . '</td>';
  }
  
   echo '<tr class="bg-info"><td colspan="8">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_captura(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_captura(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_captura(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_captura(<?php echo $last_page;?>)" style="cursor: pointer;">
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
