<?php 
include '../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){ 
   $fechs=  $_GET['nuefecha'];
   $page= $_GET['page'];
            $request = mysql_query("SELECT count(*) FROM  seguimientos  where id_s = ".$_GET['rad']." and fecha_registros like '%".$fechs."%' ");
            if($request){
                    $request = mysql_fetch_row($request) or die(mysql_error());
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 20;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                         <img src="../../images/a1.png" onclick="mostrar_seguimientos(1)" style="cursor: pointer;">
                         <img src="../../images/a11.png" onclick="mostrar_seguimientos(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../../images/a1.png"> <img src="../../images/a11.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../../images/p1.png"  onclick="mostrar_seguimientos(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../images/p11.png" onclick="mostrar_seguimientos(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../images/p1.png"> <img src="../../images/p11.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?> 
             
  <table style="width: 95%" class="table table-hover">
    <tr class="table-hover">
        <th style="background-color: #d6e9c6">ITEMS</th>
    
        <th style="background-color: #d6e9c6" nowrap>Detalle de seguimiento</th> 
        <th style="background-color: #d6e9c6" nowrap>fecha de seguimiento</th> 
        <th style="background-color: #d6e9c6">Opciones</th>
        
    </tr>
   
    <?php
 
    $query = mysql_query("SELECT *FROM  seguimientos  where id_s = ".$_GET['rad']." and fecha_registros like '%".$fechs."%' order by id_seguimiento desc ".$limit);

  
    while ($fila = mysql_fetch_array($query)){
       
        echo '<tr>' 
        . '<td>'.$fila['id_seguimiento'].'</td>'
        . '<td>'.$fila['observacion'].'</td>'
        . '<td>'.$fila['fecha_registros'].'</td>' 
        . '<td nowrap><a href="#seguim" data-toggle="tab"><button class="btn btn-success" onclick="editar('.$fila['id_seguimiento'].')"> <img src="../../imagenes/modificar.png"> Editar </button></a>'
        . '</td>';
    }
    
    ?>
     
  </table> 
 
      
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
