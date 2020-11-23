<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $cod=$_GET['codpref'];
            $ubin=$_GET['tipopref']; 
            $cen_ubi=$_GET['fuentepref'];
            $sed_ubi=$_GET['ultpref'];
            
             if($id==''){
                $ver=mysqli_query($con, "insert into prefijosinv (`pre_codigo`,`pre_tipmov`,`pre_fuente`,`pre_ultimo`) "
                        . "values ('$cod','$ubin','$cen_ubi','$sed_ubi')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_prefijo) from prefijosinv");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_prefijo)'];
                echo $ultimo;
            }else{
             mysqli_query($con,"update prefijosinv set pre_codigo='$cod', pre_tipmov='$ubin', pre_fuente='$cen_ubi', pre_ultimo='$sed_ubi' where id_prefijo='$id'");
                echo $id;
                }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM prefijosinv where id_prefijo='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_prefijo']; 
                 $p[1]=$fila['pre_codigo'];
                 $p[2]=$fila['pre_tipmov']; 
                 $p[3]=$fila['pre_fuente'];
                 $p[4]=$fila['pre_ultimo'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from prefijosinv where id_prefijo='$id' ");
            break;
        case 4:
               $idt=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM prefijosinv where pre_codigo='$idt' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p[0]=$fila['id_prefijo']; 
                 $p[1]=$fila['pre_codigo'];
                 $p[2]=$fila['pre_tipmov']; 
                 $p[3]=$fila['pre_fuente'];
                 $p[4]=$fila['pre_ultimo'];
        
            echo json_encode($p); 
            exit();
            break;
            }

