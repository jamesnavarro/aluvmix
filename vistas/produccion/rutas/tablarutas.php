<?php
include '../../../modelo/conexioni.php';
?>
<table style="width: 100%">
    <tr  style=" background: #D0D0D0">
        <th>Secuencia</th>
        <th>Puesto de Trabajo</th>
        
        <th nowrap>1 m<sup>2</sup></th>
        <th>umb</th>
        <th>Fecha Mod</th>
        <th>Usuario</th>
        <th>Quitar</th>
    </tr>
    <?php
        $cod = $_GET['cod'];
        $result = mysqli_query($con, "select a.id_hr,a.secuencia,a.usuario,a.fechamod,b.nombre_puesto,b.umb_pro "
                . "from hojas_rutas a, puestos_trabajos b "
                . "where a.codigo_pue=b.id_puesto and a.codigo_pro='$cod' order by secuencia asc ");
        while($r = mysqli_fetch_array($result)){
            if($r['umb_pro']=='m2'){
                $val = 1;
            }else if($r['umb_pro']=='ml'){
                 $val = 4;
            }else{
                $val = 1;
            }
            echo '<tr>'
                    . '<td><input type="text" id="secu'.$r['id_hr'].'" value="'.$r['secuencia'].'" onchange="pro_editarruta('.$r['id_hr'].')"></td>'
                    . '<td>'.$r['nombre_puesto'].'</td>'
                    . '<td>'.$val.'</td>'
                    . '<td>'.$r['umb_pro'].'</td>'
                    . '<td>'.$r['fechamod'].'</td>'
                    . '<td>'.$r['usuario'].'</td>'
                    . '<td> <button onclick="pro_delruta('.$r['id_hr'].')"> - </button> </td>';
        }
    ?>
</table>

