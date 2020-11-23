<?php 
include '../../../modelo/conexionv1.php';
session_start();
if(isset($_SESSION['k_username'])){
    $busgrupo= $_GET['busgrupo'];
    $busarea= $_GET['busarea'];
    $page= $_GET['page'];
            $request = mysqli_query($con2,"SELECT count(*) FROM subproceso a, grupo b, pagos c where b.id_pago=c.id_pago and a.id_subpro=b.id_area and a.nombre_subpro like '".$busgrupo."%' and b.name like '%".$busarea."%'");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 13;

            $last_page = ceil($num_items/$rows_by_page);
            
            
              $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 


$request_ac = mysqli_query($con2,"SELECT * FROM subproceso a, grupo b, pagos c where b.id_pago=c.id_pago and a.id_subpro=b.id_area and a.nombre_subpro like '".$busgrupo."%' and b.name like '%".$busarea."%' order by id_subpro asc " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
            if($fila['estado_gr']=='0'){
                $est = '<img src="../images/ok.png" onclick="est">';
            }else{
                $est = '<img src="../images/eliminar.png" onclick="est">';
            }
        echo '<tr>'
        . '<td>'.$fila['id_g'].'</td>'
        . '<td>'.$fila['name'].'</td>'
        . '<td>'.$fila['nombre_subpro'].'</td>'
        . '<td>'.$fila['desc_pago'].'</td>'
        . '<td>'.$fila['fecha_reg'].'</td>'
        . '<td>'.$fila['register'].'</td>'
       . '<td><img src="../images/empleado.png" data-toggle="modal" data-target="#Formulario" onclick="pasar_id('.$fila['id_g'].')"></td>'
        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar('.$fila['id_g'].')" > <img src="../imagenes/modificar.png"></button></a></td>'
        . '<td>'.$est.'</td>';
  }
echo '<tr><td colspan="9">';
              if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_grupo(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_grupo(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_grupo(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_grupo(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                 echo 'Cantidad de registro '.$num_items; 
                echo '</td></tr>';
              
?>

<?php  }else {
    header("location:../index.php");
}  ?>
