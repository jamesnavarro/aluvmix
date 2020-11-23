<?php
include('../../../modelo/conexionv1.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $cod=$_GET['cod'];
            $cot=$_GET['cot'];
            $ref=$_GET['ref'];
            $per=$_GET['per'];
            $pre=$_GET['pre'];
            $und=$_GET['und'];
            $iva=$_GET['iva'];
             $c=$_GET['c'];
            $query = mysqli_query($con2,"update desgloses_material set existefom='$c', codigo_sel='$cod', precio='$pre', unidad='$und', iva='$iva' where id_cot='$cot' and referencia='$ref' and perfil='$per'  ");    
            echo 'Se actualizo con exito'. mysqli_error($con2);
            break;
        case 11:
            $cod=$_GET['cod'];
            $cot=$_GET['cot'];
            $ref=$_GET['ref'];
            $per=$_GET['per'];
            $pre=$_GET['pre'];
            $und=$_GET['und'];
            $iva=$_GET['iva'];
            $color=$_GET['color'];
             $c=$_GET['c'];

            $query = mysqli_query($con2,"update desgloses_material set existefom='$c', codigo_sel='$cod', precio='$pre', unidad='$und', iva='$iva', color='$color' where id_cot='$cot' and codigo_pro='$cod'   ");
            
            echo 'Se actualizo con exito'. mysqli_error($con2);
            break;
            case 2:
               
                $cot=$_GET['cot'];
                $result = mysqli_query($con2,"select * from cotizacion where id_cot='$cot' ");
                $r = mysqli_fetch_array($result);
                echo $obs = 'Cotizacion: '.$r['numero_cotizacion'].'.'.$r['version'].', Obra:'.$r['obra'];
               
               //$obs = 'Cotizacion Id: '.$cot;
               
            break;
            case 3:
         
                $cot=$_GET['cot'];
                $ref=$_GET['ref'];
                $per=$_GET['per'];
                $query = mysqli_query($con2,"update desgloses_material set solicitud='1' where id_cot='$cot' and referencia='$ref' and perfil='$per'  ");
                echo 'Se actualizo con exito'. mysqli_error($con2);
            break;
        case 4:
                 $cot = $_GET['cot'];
            
            $reques=mysqli_query($con2,"SELECT * FROM desgloses_material where linea='Perfileria' and  id_cot=".$_GET["cot"]." and referencia='".$_GET["ref"]."' and perfil='".$_GET["med"]."' and cantidad!=0 ");
                $contador=0;
                $ref = '';
                $sw=0;
                $sistema = '';
                $medtot = 0;
                 while($rowp=mysqli_fetch_array($reques)){
                     $resnombre = mysqli_query($con2,"select descripcion from referencias where referencia='".$rowp['referencia']."' group by referencia ");
                     $name = mysqli_fetch_array($resnombre);
                     $medtot += $rowp['medida'] * $rowp['cantidad'];
                     echo '<tr>'
                        . '<td><input type="hidden" id="xcod'.$rowp['id_desglose'].'" value="'.$rowp['codigo_pro'].'" style="width:100px">'
                             . '<input type="text" id="xref'.$rowp['id_desglose'].'" value="'.$rowp['referencia'].'" style="width:100px"><button onclick="CambiarPerfil('.$rowp['id_desglose'].')">?</button></td>'
                        . '<td><input type="text" id="xdes'.$rowp['id_desglose'].'" value="'.$name['descripcion'].'" style="width:100%"></td>'
                        . '<td>'.$rowp['medida'].'</td>'
                        . '<td><input type="text" id="xcan'.$rowp['id_desglose'].'" value="'.$rowp['cantidad'].'" style="width:50px"></td>'
                        . '<td><input type="text" id="xmed'.$rowp['id_desglose'].'" value="'.$rowp['perfil'].'" style="width:100px"></td>'
                        . '<td>'.$rowp['tipo'].'</td>'
                        . '<td><button onclick="UpPerfil('.$rowp['id_desglose'].')">Editar</button></td>';  
                     }
                     $canp = $medtot / $_GET["med"];
                     echo '<tr><td colspan="2"></td><td colspan="3">Medida Total:'.$medtot.' / '.$_GET['med'].' = '.ceil($canp).' Perfiles<td>'; 
            
            break;
            case 5:
              $cot = $_GET['cot'];
              $id = $_GET['id'];
              $cod = $_GET['cod'];
              $ref = $_GET['ref'];
              $can = $_GET['can'];
              $per = $_GET['per'];
              $query = mysqli_query($con2,"update desgloses_material set codigo_pro='$cod' , referencia='$ref', perfil='$per' , cantidad='$can',fecmodifica='".date("Y-m-d H:i:s")."',user='".$_SESSION['k_username']."' where id_desglose='$id' ");
              if($query){
                  echo 'Se ha editado con exito';
              }else{
                  echo 'Hubo un errro al editar el perfil';
              }
              
               
            
            break;
            case 6:
              $cot = $_GET['cot'];
              $id = $_GET['id'];
              $cod = $_GET['cod'];
              $ref = $_GET['ref'];
              $can = $_GET['can'];
              $per = $_GET['per'];
              $query = mysqli_query($con2,"update desgloses_material set crear='1' where id_cot='$cot' and codigo_sel='$cod'  ");
              if($query){
                  echo 'Se ha solicitado la creacion de este producto. Cot_:'.$cot.' Prod:_'.$cod;
              }else{
                  echo 'Hubo un error al solicitar';
              }
              
               
            
            break;
            case 7:
              $cot = $_GET['cot'];
              $cod = $_GET['cod'];

              $query = mysqli_query($con2,"update desgloses_material set crear='0' where id_cot='$cot' and codigo_sel='$cod'  ");
              if($query){
                  echo 'Se ha sacado del listado con exito';
              }else{
                  echo 'Hubo un error al solicitar';
              }
              
               
            
            break;
            }


