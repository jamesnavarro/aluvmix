<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

     $numced= $_GET['nom'];
     $estado= $_GET['estad'];
     $fechini= $_GET['ini'];
     $obra= $_GET['fin'];
     $page= $_GET['page'];
   
            $request = mysqli_query($con,"SELECT count(*) from actividad a, sis_contacto b where a.id_contacto=b.id_contacto  and a.estado like '%".$estado."%' and b.nombre_cont like '%".$numced."%' and a.StartTime like '".$fechini."%'    ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_actividades(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_actividades(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_actividades(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_actividades(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de Llamadas Totales:   '.$num_items; 
             
    ?>
                        <div style="float: right">
        
         <button onclick="nuevo()"><img src="../imagenes/newcall.png" width="23px" height="23px"><b>NUEVA LLAMADA</b></button>
    </div><br>
                        
<div class="table-responsive">          
  <table class="table">
    <tr class="bg-info">
        <th>Nombre de la Obra</th>
        <th>Descripcion del asunto</th> 
        <th>Nombre del Contacto</th> 
        <th>Telefono</th> 
        <th>Correo</th>
        <th>estado</th> 
        <th>fecha de inicio</th>  
        <th></th> 
        <th><b>CONTRATO</b></th>  
         
    
    </tr>
    <?php
   
    $query = mysqli_query($con,"SELECT *,a.estado from actividad a, sis_contacto b  where a.id_contacto=b.id_contacto and a.estado like '%".$estado."%' and b.nombre_cont like '%".$numced."%' and a.StartTime like '".$fechini."%'  ".$limit);
   
    $com = 0; $plan = 0;
    while ($fila = mysqli_fetch_array($query)){
        if($fila['estado']=='Planificada'){
            $stilo = ' style="background-color:red;" ';
            $plan += 1; 
        }else{
             $stilo = ' style="background-color:green;" ';
             $com += 1;
        }
        if($fila['id_seleccionado']!='0'){
            $query2 = mysqli_query($con,"select nombre_obra from informacion_obras where id_inf='".$fila['id_seleccionado']."' ");
            $c = mysqli_fetch_assoc($query2);
            $ob = $c['nombre_obra'];
            $btn = '<button onclick="detalles('.$fila['id_seleccionado'].')"><img src="../imagenes/nuevocontacto.png"></button>';
        }else{
            $ob = ''; 
            $btn = '';
        }
        
        echo '<tr>'
        . '<td>'.$ob.'</td>'
        . '<td>'.$fila['Subject'].'</td>'
        . '<td>'.$fila['nombre_cont'].'</td>'
        . '<td>'.$fila['tel_oficina'].' '.$fila['celular'].'</td>'   
       . '<td><a href="mailto:'.$fila['email1'].'">'.$fila['email1'].'</a></td>'
        . '<td '.$stilo.'> '.$fila['estado'].'</td>'
        . '<td>'.$fila['StartTime'].'</td>'
        . '<td><button onclick="editar_act('.$fila['Id'].')"><img src="../imagenes/modificar.png"></button></td>'
        . '<td>'.$btn.'</td>';
       
    }
    
    
    ?>
</table>
    <?php
    echo 'Llamadas Pendientes : <font color="red"> <b>'.$plan.'</b> </font>'
            ?> <br>
    <?php
    echo 'Llamadas completadas : <font color="green"> <b>'.$com.'</b> </font>'
    ?>
    </div>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
