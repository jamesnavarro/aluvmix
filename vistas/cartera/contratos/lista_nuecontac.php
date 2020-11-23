<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

    $query = mysqli_query($con,"SELECT * FROM sis_contacto where id_rel_tercero='".$_GET['id']."' order by fecha_registro desc ");
   
    while ($fila = mysqli_fetch_array($query)){
       
        echo '<tr>' 
       . '<td>'.$fila['id_contacto'].'</td>'
       . '<td>'.$fila['nombre_cont'].'</td>'
       . '<td>'.$fila['celular'].'</td>'
      . '<td><a href="mailto:'.$fila['email1'].'">'.$fila['email1'].'</a></td>'
       . '<td>'.$fila['area_user'].'</td>'
       . '<td>'.$fila['notas'].'</td>'
       . '<td> <button onclick="editar_loscontactos('.$fila['id_contacto'].')" class="glyphicon glyphicon-pencil"> </button>'
       . '</td>';
    
    }

    ?>

<?php  }else {
   
   echo '<script> window.close(); </script>';
    
} ?>

