<?php 
include '../../../modelo/conexionv1.php';
session_start();
if(isset($_SESSION['k_username'])){
    $areab= $_GET['areab'];
    $puestob= $_GET['puestob'];
     $sedeb= $_GET['sedeb'];
    $page= $_GET['page'];
   $request = mysqli_query($con2,"SELECT count(*)  FROM puestos a, puestos_relacion b, subproceso c where a.id_puesto=b.id_puesto and b.id_area=c.id_subpro and a.nombrepuesto like '".$areab."%' and c.nombre_subpro like '".$puestob."%' and  a.sede like '".$sedeb."%'");

    if($request){
         $request = mysqli_fetch_row($request);
         $num_items = $request[0];
         }else{
                    $num_items = 0;
            }
            $rows_by_page = 20;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con2,"SELECT *FROM puestos a, puestos_relacion b, subproceso c where a.id_puesto=b.id_puesto and b.id_area=c.id_subpro and a.nombrepuesto like '".$areab."%' and c.nombre_subpro like '".$puestob."%' and  a.sede like '".$sedeb."%' " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
         {    
        echo '<tr>'
       . '<td>'.$fila['id_puesto'].'</td>'
       . '<td>'.$fila['nombrepuesto'].'</td>'
       . '<td>'.$fila['sede'].'</td>'
        . '<td>'.$fila['nombre_subpro'].'</td>'
       . '<td>'.$fila['valmo'].'</td>'
       . '<td>'.$fila['um1'].'</td>'
        . '<td>'.$fila['valmq'].'</td>'
        . '<td>'.$fila['um2'].'</td>'
        . '<td>'.$fila['calcif'].'</td>'
        . '<td>'.$fila['um3'].'</td>'
    
       . '</td>';
  }
        echo '<tr class="bg-info"><td colspan="7">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_procesos(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_procesos(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_procesos(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png"  onclick="mostrar_procesos (<?php echo $last_page;?>)" style="cursor: pointer;">
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
