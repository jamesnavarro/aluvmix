<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $cod=$_GET['colm'];
            $ubin=$_GET['ubi']; 
            $cen_ubi=$_GET['cen_ubi'];
            $sed_ubi=$_GET['sed_ubi'];
            $result = mysqli_query($con,"select count(*) from ubicaciones where columna='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into ubicaciones (`columna`,`ubicacion`,`cp_codigo`,`codigo_cp`) values ('$cod','$ubin','$cen_ubi','$sed_ubi')");
            }
            
             if($id==''){
                $ver=mysqli_query($con, "insert into ubicaciones (`columna`,`ubicacion`,`cp_codigo`,`codigo_cp`) "
                        . "values ('$cod','$ubin','$cen_ubi','$sed_ubi')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_ua) from ubicaciones");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ua)'];
                echo $ultimo;
            }
             mysqli_query($con,"update ubicaciones set columna='$cod', ubicacion='$ubin', cp_codigo='$cen_ubi', codigo_cp='$sed_ubi' where id_ua='$id'");
                echo $id;
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM ubicaciones where id_ua='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_ua']; 
                 $p[1]=$fila['columna'];
                 $p[2]=$fila['ubicacion']; 
                 $p[3]=$fila['cp_codigo'];
                 $p[4]=$fila['codigo_cp'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from ubicaciones where id_ua='$id' ");
            break;
        case 4:
               $idt=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM ubicaciones where ubicacion='$idt' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p = array();
                 $p[0]=$fila['id_ua']; 
                 $p[1]=$fila['columna'];
                 $p[2]=$fila['ubicacion']; 
                 $p[3]=$fila['cp_codigo'];
                 $p[4]=$fila['codigo_cp'];
        
            echo json_encode($p); 
            exit();
            break;
            }

