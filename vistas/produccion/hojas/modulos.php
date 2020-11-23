<?php
include('../../../modelo/conexion_multiple.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
       
          case 1:
                 $id_cot=$_GET['id_cot'];
                 $id_items=$_GET['id_item'];
                 $cantidad_general = $_GET['cg'];
                 $cantidad_ordenada = $_GET['co'];
                 $idtrazvid = $_GET['idtrazvid'];
                 $cantidad = $cantidad_ordenada;
                  //echo $con;
                    $c = 0;$t = 0;$tr=0;
                     $total = 0;
                    $reques=mysqli_query($con_duos,"SELECT *,sum(cantidad) as canacc, sum(canperfil) as canper FROM virtuald_templadosa.desgloses_material a, virtuald_templadosa.referencias b where a.codigo_pro=b.codigo and id_cot=".$id_cot." and id_cot_item in (".$id_items.",'537437') group by a.codigo_pro ");
                    $contador=0;
                    $tott = 0;
                    //$cantidad_general = 9;
                    while($row=mysqli_fetch_array($reques)){

                        if($row['linea']=='Perfileria'){
                            $medres = mysqli_query($con_duos,"select sum(medida*cantidad) as med from virtuald_templadosa.desgloses_material where id_cot='".$id_cot."' and referencia='".$row['referencia']."' and perfil='".$row['perfil']."' and id_cot_item in (".$id_items.") ");
                            $md = mysqli_fetch_array($medres);

                             $medtotal = $md['med'];
                             $canper = $md['med']/($row['perfil']-100);

                            $canti = ceil($canper);
                            $unidad = $row['perfil'];

                            $ct = ($canti * $cantidad)/$cantidad_general;
                            $tot = ($unidad/1000)*$ct*$row['costo_mt'];

                            if($row['color']=='01'){
                                $crudo = 'ANONIZADO';
                                $codcolor = '01';
                            }else{
                                $crudo = 'CRUDO';
                                $codcolor = '00';
                            }
                            $ref = $row['referencia'];
                           $codigo = $ref.'-'.$codcolor.substr($row['perfil'],0,2);
                           $descripcion = substr($row['descripcion'],0,-6) .' '.$row['perfil'];

                        }else{
                             $canti = ceil($row['canacc']);
                             $unidad = $row['und_medida'];
                             $ct = ($canti * $cantidad)/$cantidad_general;
                              $tot = $ct*$row['costo_mt'];
                              $codigo = $row['codigo_pro'];
                              $descripcion = $row['descripcion'];
                        }
                        if($row['linea']=='Perfileria'){
                            $ct = ($canti * $cantidad)/$cantidad_general;
                            $tot = ($unidad/1000)*$ct*$row['costo_mt'];
                        }else{
                             $ct = ($canti * $cantidad)/$cantidad_general;
                              $tot = $ct*$row['costo_mt'];
                        }


                        $canti_pedida = ceil(($canti*$cantidad_ordenada)/$cantidad_general); //  / $can_real
                        //$tot = $canti_pedida * $row['costo_mt'];
                        $tott += $tot;


                        echo '<tr>'
                                . '<td>'.$codigo.'</td>'
                                . '<td>'.$descripcion.' </td>'
                                . '<td>'.$unidad.'</td>'
                                . '<td style="text-align:right">'.($canti).'</td>'
                                . '<td style="text-align:right">'.number_format($row['costo_mt'],0,',','.').'</td>'
                                . '<td style="text-align:right">'.number_format($tot,0,',','.').'</td>'
                                . '<td style="text-align:right">'.number_format($tot,0,',','.').'</td>';


                     }

                     $requesv=mysqli_query($con_duos,"SELECT id_op,color, sum((medida1/1000)*(medida2/1000)*cant_ordenada) as mt2 FROM virtuald_templadosa.orden_detalle WHERE codigo=".$_GET['id']."  ");

                    $tottvid = 0;
                    while($row=mysqli_fetch_array($requesv)){

                        $resvid = mysqli_query($con_duos,"SELECT costo_v FROM virtuald_templadosa.tipo_vidrio where color_v = '".$row['color']."' ");
                        $cv =mysqli_fetch_array($resvid);

                        $canti = $m2;
                        $totv = $cv[0]*$canti;
                        $tottvid += $totv;
                        echo '<tr>'
                                . '<td>'.$row['id_op'].'</td>'
                                . '<td>LAMINA '.$row['color'].'</td>'
                                . '<td>mt2</td>'
                                . '<td style="text-align:right">'.number_format($canti,0,',','.').'</td>'
                                . '<td style="text-align:right">'.number_format($cv[0],0,',','.').'</td>'
                                . '<td style="text-align:right">'.number_format($totv,0,',','.').'</td>'
                                . '<td style="text-align:right">'.number_format($totv,0,',','.').'</td>';


                     }

                                                    echo '<tr><td colspan="6">Total materia prima</td><td style="text-align:right"><input type="hidden" id="to" value="'.($tott+$tottvid).'">'.number_format(($tott+$tottvid),0,',','.'). ' | '.$cantidad_general. ' '.$id_cot.'</td>';
//                                                             echo '<tr><td></td>';
//                                                                       
//                                                           
//                                                                       echo '<tbody id="mostrar_invfom"><input type="hidden" id="to" value="0"></tbody>';
//                                                                   
//                                                                   echo '<tr><td colspan="4">Totales</td>';
                                                        $total +=$tottvid;
                                                        $total +=$tott;
                                                       
                                                              
            break;
        
     
}