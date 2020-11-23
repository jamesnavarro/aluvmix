<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $est=$_GET['est'];
    $res=$_GET['res'];
    $ases=$_GET['ases'];
    $depp=$_GET['depp'];
    $ciub=$_GET['ciub'];
    $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM prospecto where nombre_proyecto like '%".$cod."%' and nombre_constructor like '%".$des."%' and estado like '%".$res."%' and user like '%".$ases."%' and regional like '%".$depp."%' and ciudad like '%".$ciub."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM prospecto where nombre_proyecto like '%".$cod."%' and nombre_constructor like '%".$des."%' and estado like '%".$res."%' and user like '%".$ases."%' and regional like '%".$depp."%' and ciudad like '%".$ciub."%' " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{ 
         if($fila['estado']=='Seleccionado'){
            $boton='<button type="button" title="Agrega un nuevo" class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="agregar('.$fila['id_prospecto'].','.$fila['id_s'].')">+</button>';
        }else{
             $boton='';
        }
            
        echo '<tr>'
        . '<td>'.$fila['id_prospecto'].'</td>'
        . '<td>'.$fila['nombre_proyecto'].'</td>'
        . '<td>'.$fila['nombre_constructor'].'<br><b>NIT</b>:'.$fila['nit_constructor'].'</td>'
        . '<td>'.$fila['regional'].'</td>'
        . '<td>'.$fila['ciudad'].'</td>'
        . '<td>'.$fila['barrio'].'</td>'
        . '<td nowrap>'.$fila['estado'].'</td>'
        . '<td>'.$fila['user'].'</td>'  
        . '<td nowrap><a data-toggle="tab" href="#lin2"><button onclick="editar_prose('.$fila['id_prospecto'].')"><img src="images/modificar.png"></button></a> '.$boton.'</td>'
        ;
  }
   echo '<tr><td colspan="6">';
                        if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_pros(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_pros(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_pros(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_pros(<?php echo $last_page;?>)" style="cursor: pointer;">
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
