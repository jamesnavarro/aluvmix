<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){   

    $query = mysqli_query($con,"SELECT * ,a.estado,a.Description FROM actividad a ,sis_contacto b where a.id_contacto=b.id_contacto and a.id_tercero='".$_GET['id_cliente']."'  order by StartTime desc ");
   
    while ($fila = mysqli_fetch_array($query)){
        if ($_SESSION['k_username']== $fila['reg_user']){
            $boton='<button onclick="editar_act_nue('.$fila['Id'].')" class="glyphicon glyphicon-pencil"> </button>';
        }else{
             $boton='';
        }
        echo '<tr>' 
       . '<td>'.$fila['Id'].'</td>'
       . '<td>'.$fila['Subject'].'<br><b>Reg:</b> '.$fila['reg_user'].'</td>'
       . '<td>'.$fila['nombre_cont'].'</td>'
       . '<td>'.$fila['celular'].'</td>'
       . '<td>'.$fila['estado'].'</td>'
       . '<td>'.$fila['Description'].'</td>'
       . '<td>'.$fila['StartTime'].'</td>'
       . '<td>'.$fila['EndTime'].'</td>'
       . '<td>'.$boton.'</td>';
    
    }

    ?>

<?php  }else {
   
   echo '<script> window.close(); </script>';
    
} ?>

