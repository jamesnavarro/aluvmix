<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

    $query = mysqli_query($con,"SELECT * ,a.estado FROM actividad a ,sis_contacto b where a.id_contacto=b.id_contacto and a.id_seleccionado='".$_GET['radicado']."'  order by fecha_reg_ta desc ");
   
    while ($fila = mysqli_fetch_array($query)){
       
        echo '<tr>' 
       . '<td>'.$fila['Id'].'</td>'
       . '<td>'.$fila['Description'].'</td>'
       . '<td>'.$fila['nombre_cont'].'</td>'
       . '<td>'.$fila['celular'].'</td>'
       . '<td>'.$fila['estado'].'</td>'
       . '<td>'.$fila['StartTime'].'</td>'
       . '<td>'.$fila['EndTime'].'</td>'
       . '<td> <button onclick="editar_act_nue('.$fila['Id'].')" class="glyphicon glyphicon-pencil"> </button>'
       . '<button onclick="borrar_las_acti('.$fila['Id'].')" class="glyphicon glyphicon-remove"> </button></td>';
    
    }

    ?>

<?php  }else {
   
   echo '<script> window.close(); </script>';
    
} ?>

