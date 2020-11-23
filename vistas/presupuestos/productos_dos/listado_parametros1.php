<?php
include('../../../modelo/conexioni.php');
$cod = $_GET['cod'];
$result = mysqli_query($con,"select * from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.codigo_ref='$cod' and a.compuesto='0' order by parametro asc ");
while($r = mysqli_fetch_array($result)){
    $ref = "'".$r['codigo_pro']."'";
    $tipo = "'".$r['parametro']."'";
    $desc = "'".$r['descripcion']."'";
    $cant = "'".$r['cantidad']."'";
    $und = "'".$r['und_med']."'";
    echo '<tr>'
    . '<td>'.$r['parametro'].'</td>'
            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['descripcion'].'</td>'
            . '<td>'.$r['cantidad'].'</td>'
            . '<td>'.$r['und_med'].'</td>'
            . '<td>'.number_format($r['costo_promedio']).'</td>'
            . '<td><button onclick="pre_pasarparametrocomp('.$r['id_pp'].','.$und.')" data-toggle="modal" data-target="#modalespaciadores">Comp.</button></td>'
            . '<td><button onclick="pre_pasarparametro('.$tipo.','.$ref.','.$desc.','.$cant.','.$und.')">Editar</button></td>'
            . '<td><button onclick="pre_delparametro('.$r['id_pp'].')">Eliminar</button></td>';
}