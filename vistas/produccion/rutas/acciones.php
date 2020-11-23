<?php
include('../../../modelo/conexioni.php');
session_start();
$empresa = $_SESSION['empresa'];
$usuario = $_SESSION['k_username'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idll'];
            $valorl=$_GET['valdoll'];
            $precl=$_GET['precdoll'];
            $varil=$_GET['varipril'];
            $preacl=$_GET['preactl'];
            $fecl=$_GET['fechactul'];
            if($id==''){
                $ver=mysqli_query($con,"insert into dolares (`lma`,`precio_dolar`,`prima`,`precio_actual`,`fecha_reg_dolar`) values ('$valorl','$precl','$varil','$preacl','$fecl')");
                
                $query = mysqli_query($con,"select max(id_dolar) from dolares");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_dolar)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update dolares set lma='$valorl',precio_dolar='$precl',prima='$varil',precio_actual='$preacl',fecha_reg_dolar='$fecl' where id_dolar='$id'");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $sec=$_GET['sec'];
                mysqli_query($con, "update hojas_rutas set secuencia='$sec', usuario='$usuario' where id_hr='$id'");
                echo $id;
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con , "delete from hojas_rutas where id_hr='$id' ");
            break;
        case 4:
            $codi=$_GET['codi'];
            $puesto=$_GET['puesto'];
            echo $puesto;
            $result = mysqli_query($con, "select max(secuencia) from hojas_rutas where codigo_pro='$codi' ");
            $r = mysqli_fetch_row($result);
            $sec = $r[0] + 1;
            $query = mysqli_query($con, "insert into hojas_rutas (codigo_pro, codigo_pue, usuario, secuencia) "
                    . "values ('$codi','$puesto','$usuario','$sec') ");
            break;
            }

