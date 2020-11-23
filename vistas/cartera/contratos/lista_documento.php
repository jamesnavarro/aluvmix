<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

    $query = mysqli_query($con,"SELECT *FROM archivos_obras where estado_doc=0 and id_contrato='".$_GET['id']."' order by fecha_reg_arc desc ");
   
    while ($fila = mysqli_fetch_array($query)){ 
        if($fila['archivo']!=''){
            $arc ='<a href="detalles.php?id='.$_GET['id'].'&descargar='.$fila['archivo'].' "><button class="glyphicon glyphicon-download-alt"> </button></a>';
           
        }else{
            $arc = '';
        }
        $archivo="'".$fila['archivo']. "'";
        echo '<tr>' 
       . '<td>'.$fila['id_arc'].'</td>'
       . '<td>'.$fila['tipo_documento'].'</td>'
       . '<td>'.$fila['sugerencias'].'</td>'
       . '<td>'.$fila['fecha_reg_arc'].'</td>'
       . '<td>'.$fila['registr_arc_por'].'</td>'
       . '<td><button onclick="ver_doc_n('.$archivo.')" class="glyphicon glyphicon-eye-open"> </button>'.$arc.'</td>'
       . '<td><button onclick="editar_doc('.$fila['id_arc'].')" class="glyphicon glyphicon-pencil"> </button>'
       . '<button onclick="borrar_doc('.$fila['id_arc'].')" class="glyphicon glyphicon-remove"> </button></td>';
    
    }

    ?>

<?php  }else {
   
   echo '<script> window.close(); </script>';
    
} ?>

