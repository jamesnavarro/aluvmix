<?php
include('../../../../modelo/conexioni.php');
$cod= $_GET['cod'];
$n= $_GET['item'];
                             
     $sql = mysqli_query($con, "select * from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.codigo_ref='$cod' and a.parametro in ('interlayer','espaciadores')  order by parametro asc");
    $item = 0;
    if(mysqli_num_rows($sql)>0){
            while($mostrar = mysqli_fetch_array($sql)){
                    $item = $item+1;
                    $codi = "'".trim($mostrar['codigo_pro'])."'";
                    $desc = "'".trim($mostrar['descripcion'])."'";
                    $parametro = "'".trim($mostrar['parametro'])."'";
                    echo '<tr>
<td><a href="#" onclick="pasar('.$codi.','.$desc.','.$n.','.$parametro.')">'.$mostrar['codigo_pro'].'</a></td>
<td>'.$mostrar['descripcion'].'</td><td>'.$mostrar['cantidad'].' '.$mostrar['und_med'].'</td><td style="text-align:right">'.number_format($mostrar['costo_promedio']).'</td>'; }
    }else{
            echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
    }
                                    
                                    ?>
                              
                        
