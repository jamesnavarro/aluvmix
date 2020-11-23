<?php
include('../../../modelo/conexionv1.php');

     $can = $_GET['can'];
     $cg = $_GET['cg'];
            $reques=mysqli_query($con2,"SELECT * FROM desgloses_material a, referencias b where a.codigo_pro=b.codigo and id_cot=".$_GET["cot"]." and id_cot_item=".$_GET["item"]." ");
            $contador=0;
            $tott = 0;
            while($row=mysqli_fetch_array($reques)){
            
                if($row['linea']=='Perfileria'){
                    $cantidad = $row['canperfil'];
                    $unidad = $row['perfil'];
                    $ct = ($cantidad * $can)/$cg;
                    $tot = ($unidad/1000)*$ct*$row['costo_mt'];
                }else{
                     $cantidad = $row['cantidad'];
                     $unidad = $row['und_medida'];
                     $ct = ($cantidad * $can)/$cg;
                      $tot = $ct*$row['costo_mt'];
                }
                $tott += $tot;
                
                echo '<tr>'
                        . '<td>'.$row['codigo_pro'].'</td>'
                        . '<td>'.$row['descripcion'].'</td>'
                        . '<td>'.$unidad.'</td>'
                        . '<td style="text-align:right">'.$cantidad.'</td>'
                        . '<td style="text-align:right">'.number_format($row['costo_mt'],0,',','.').'</td>'
                        . '<td style="text-align:right">'.number_format($tot,0,',','.').'</td>'
                        . '<td style="text-align:right">'.number_format($tot,0,',','.').'</td>';
                       

             }
        
 echo '<tr><td colspan="6">Total materia prima</td><td style="text-align:right"><input type="hidden" id="to" value="'.$tott.'">'.number_format($tott,0,',','.').'</td>';