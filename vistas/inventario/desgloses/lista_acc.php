<?php 
include '../../../modelo/conexionv1.php';
//include '../../../modelo/conexioni.php';
session_start();
if($_GET['sol']=='2'){
    $sol = "";
}else{
    $sol = " a.solicitud='".$_GET['sol']."' and ";
}
$reques=mysqli_query($con2,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can FROM desgloses_material a, referencias b where $sol a.linea='Accesorios' and  a.codigo_pro=b.codigo and a.id_cot=".$_GET["cot"]." and cantidad!=0 group by a.codigo_pro order by a.referencia asc ");
                $contador=0;
                $ref = '';
                $sw=0;
                $sistema = '';
                 while($rowp=mysqli_fetch_array($reques)){
                     $contador++;
                     if($rowp['dado']=='0' || $rowp['dado']==''){
                         $dado = $rowp['referencia'];
                     }else{
                         $dado = $rowp['dado'];
                     }
  
                     if($rowp['color']=='02'){
                         $area=$rowp['area']/1000;
                     }else{
                          $area=$rowp['area'];
                     }
                     if($rowp['color']=='01'){
                         $crudo = 'ANONIZADO';
                     }else{
                         $crudo = 'CRUDO';
                     }
                     $areat = $area*($rowp['perfil']/1000);
                     // sacar color del items
                     $resultc = mysqli_query($con2,"select color_ta from cotizaciones where id_cotizacion='".$rowp['id_cot_item']."' ");
                     $rc = mysqli_fetch_array($resultc);
                     
                     
                     $alum_porr = "SELECT costo_a,rendimiento,variable FROM tipo_aluminio where color_a='".$rc[0]."'";
                    $fia4 =mysqli_fetch_array(mysqli_query($con2,$alum_porr));
                    $vc= $fia4["costo_a"]*$fia4["variable"];  //se le agrego la variable que multiplica la pintura
                    $rendimiento= $fia4["rendimiento"];
                    $tipopintura= $fia4["variable"];
                    
                  
                    $queryma = mysqli_query($con2,"select tipo from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' group by tipo ");
                    $ventana = '';
                    while ($row1 = mysqli_fetch_array($queryma)) {
                        $ventana = $ventana.$row1[0].' ,';
                    }
                    $mystring = $rowp['descripcion'];
                   
                   $descripcion = $rowp['descripcion'];
                   
                    if($contador==1){
                            echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                          
                        }
                    if($sistema!=$rowp['sistema']){
                         
                            echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                         
                     }
//                     $consulta=mysql_query($con,"select sum(stock_ubi) as st FROM `relacion_ubicaciones` where bod_codigo='".$_GET['bod']."' and codigo_pro='$codigo' ");
//                     $s = mysqli_fetch_array($consulta);
//                     $stock = $s[0];
//                     if($stock==null){
//                         $st = 0;
//                     }else{
//                         $st = $stock;
//                     }
                    
                     $ref = $rowp['referencia'];
                     $sistema = $rowp['sistema'];
                     $codigo = $rowp['codigo'];
                     if($rowp['existefom']=='1'){ 
                         $bcolor='#F4CACA';
                         $ch2 = '';
                     }else{
                         $bcolor='#C5E9C0';
                         $ch2='<input type="checkbox" id="'.$contador.'" name="item2" checked>';
                     }
                     echo '<tr style="background-color:'.$bcolor.'" id="td'.$contador.'">'
                             . '<td>'.$contador.'</td>'
                            . '<td>'.$rowp['can'].' </td>'
                             . '<td><input type="text" value="'.$rowp['can'].'" style="width:60px" id="can'.$contador.'"></td>'
                             . '<td><input type="text" value="" style="width:60px" id="sto'.$contador.'" disabled></td>'
                             . '<td> <input type="text" value="'.$dado.'" style="width:70px" id="ref'.$contador.'" disabled> '.$ch2.'</td>'
                             . '<td><input type="text" value="'.$codigo.'" style="width:100px" id="cod'.$contador.'"></td>'
                             . '<td><textarea id="des'.$contador.'" style="width:100%">'.$descripcion.'</textarea></td>'
                             . '<td><input type="text" value="'.$rowp['color'].'" style="width:80px" id="aca'.$contador.'"></td>'
     
                             . '<td><input type="text" value="'.$rowp['costo_mt'].'" style="width:80px" id="pre'.$contador.'">'.substr($ventana,0,-1).'</td>'
                             . '<td><input type="text" value="'.$rowp['perfil'].'" style="width:80px" id="per'.$contador.'"></td>'
                              
                             . '<td><input type="text" value="'.$rowp['referencia'].'" style="width:70px" id="dad'.$contador.'" disabled><input type="checkbox" id="'.$contador.'" name="item" disabled checked></td>';

                 }
                 ?>
