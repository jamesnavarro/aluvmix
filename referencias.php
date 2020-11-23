<?php
include "modelo/conexion.php";

$result = mysql_query("select * from referencias_bk where referencia='0' ");
while($r = mysql_fetch_array($result)){
    
    echo $r['descripcion'].' '.$r['costo_mt'].'-'.$r['costo_fom'].'<br>';
    $id = $r['id_referencia'];
    $cos = $r['costo_mt'];
    mysql_query("update referencias set costo_mt='$cos', costo_fom='$cos' where id_referencia='$id' ");

    
}

