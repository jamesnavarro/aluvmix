<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

    $query = mysqli_query($con,"SELECT * ,a.estado FROM actividad a ,sis_contacto b where a.id_contacto=b.id_contacto and a.id_seleccionado='".$_GET['radicado']."'  order by fecha_reg_ta desc ");
   
    while ($fila = mysqli_fetch_array($query)){
        
        if ($_SESSION['k_username']== $fila['reg_user']){
            $botok='<button onclick="editar_act_nue('.$fila['Id'].')" class="glyphicon glyphicon-pencil"> </button>';
        }else{
             $botok='';
        }
        echo '<tr>' 
       . '<td>'.$fila['Id'].'</td>'
       . '<td>'.$fila['Description'].'</td>'
       . '<td>'.$fila['nombre_cont'].'<br><b>Reg: </b>'.$fila['reg_user'].'</td>'
       . '<td>'.$fila['celular'].'</td>'
       . '<td>'.$fila['estado'].'</td>'
       . '<td>'.$fila['StartTime'].'</td>'
       . '<td>'.$fila['EndTime'].'</td>'
       . '<td>'.$botok.''
       . '</td>';
    
    }

    ?>

<?php  }else {
   
   echo '<script> window.close(); </script>';
    
} ?>

