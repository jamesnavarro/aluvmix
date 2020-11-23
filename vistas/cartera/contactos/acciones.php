<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $nombreN=$_GET['contnombre'];
            $telcontN=$_GET['telcont'];
            $emailcontN=$_GET['emailcont'];
            $cargcargrN=$_GET['cargcarg'];
            $sugercontN=$_GET['sugercont'];
            $ccN=$_GET['ccc'];
            $usucreaN=$_GET['usucrea'];
            $fcreaN=$_GET['fcrea'];
            
            
            if($id==''){
                $ver=mysqli_query($con, "insert into sis_contacto (`nombre_cont`,`celular`,`email1`,`area_user`,`notas`,`id_rel_tercero`,`quien_registra`,`fecha_registro`) "
                . "values ('$nombreN','$telcontN','$emailcontN','$cargcargrN','$sugercontN','$ccN','$usucreaN','$fcreaN')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_contacto) from sis_contacto");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_contacto)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update sis_contacto set nombre_cont='$nombreN', celular='$telcontN', email1='$emailcontN', area_user='$cargcargrN', notas='$sugercontN', id_rel_tercero='$ccN', quien_registra='$usucreaN', fecha_registro='$fcreaN' where id_contacto='$id'");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM sis_contacto where id_contacto='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                   $p = array(); 
                   $p[0]=$fila['id_contacto'];
                   $p[1]=$fila['nombre_cont'];
                   $p[2]=$fila['celular']; 
                   $p[3]=$fila['email1'];
                   $p[4]=$fila['area_user'];
                   $p[5]=$fila['notas'];
                   $p[6]=$fila['id_rel_tercero'];
                   $query2 = mysqli_query($con,"select nom_ter FROM cont_terceros where id_ter='".$fila['id_rel_tercero']."' ");
                   $fi = mysqli_fetch_array($query2);
                   $p[7]=$fi['nom_ter'];
                   $p[8]=$fila['quien_registra'];
                   $p[9]=$fila['fecha_registro'];
                
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from sis_contacto where id_contacto='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM sis_contacto where nombre_cont='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                   $p = array();
                   $p[0]=$fila['id_contacto'];
                   $p[1]=$fila['nombre_cont'];
                   $p[2]=$fila['celular']; 
                   $p[3]=$fila['email1'];
                   $p[4]=$fila['area_user'];
                   $p[5]=$fila['notas'];
                   $p[6]=$fila['id_rel_tercero'];
                   $query2 = mysqli_query($con,"select nom_ter FROM cont_terceros where id_ter='".$fila['id_rel_tercero']."' ");
                   $fi = mysqli_fetch_array($query2);
                   $p[7]=$fi['nom_ter'];
                   $p[8]=$fila['quien_registra'];
                   $p[9]=$fila['fecha_registro'];
                 
            echo json_encode($p); 
            exit();
            break;
            case 5: 
            $id=$_GET['nombre'];
            $consulta = mysqli_query($con, "SELECT * FROM `departamentos` where  nombre_dep='$id'");
              while($f = mysqli_fetch_array($consulta)){ 
              echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
              }
            break;
}