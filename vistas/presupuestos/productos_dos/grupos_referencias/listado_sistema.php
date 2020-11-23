<?php
include('../../../../modelo/conexioni.php');

  $ref = $_GET['ref'];

    $sql = mysqli_query($con,"SELECT * FROM grupos_referencia_sis  where codigo= '".$ref."' ");
$item = 0;
echo '<tr><td>Referencia</td><td>Sistema</td><td>Borrar</td>';
while($mostrar = mysqli_fetch_array($sql)){
        $item = $item+1;

        echo '<tr>
                <td>'.$mostrar['codigo'].'</td>
                <td>'.$mostrar['sistema'].'</td>'
                . '<td><input type="button" id="sel'.$mostrar['codigo'].'"  onclick="delrefsis('.$mostrar['id_rs'].')" value="-"> </td>';
        }




    ?>
   
                        
