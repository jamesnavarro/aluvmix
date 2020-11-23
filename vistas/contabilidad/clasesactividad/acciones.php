<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $est=$_GET['est'];
            $cod=$_GET['cod'];
            $des=$_GET['des'];
            $umb=$_GET['umb'];
            $cue=$_GET['cue'];
            $cp=$_GET['cp'];
            $para=$_GET['para'];
            $result = mysqli_query($con,"select count(*) from clases_actividad where act_codigo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into clases_actividad (`parafiscales`,`act_codigo`,`act_nombre`,`codigo_cp`,`act_umb`,`codigo_cue`,`act_activo`,`usuario`,`cod_empresa`) "
                        . "values ('$para','$cod','$des','$cp','$umb','$cue','$est','$usuario','$empresa')");
            }
            else{
                mysqli_query($con,"update clases_actividad set parafiscales='$para', act_nombre='$des', codigo_cp='$cp', act_umb='$umb', codigo_cue='$cue', act_activo='$est', usuario='$usuario' where act_codigo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM clases_actividad where act_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['act_codigo']; 
                 $p[1]=$fila['act_nombre'];
                 $p[2]=$fila['codigo_cp'];
                 $p[3]=$fila['act_activo'];
                 $p[4]=$fila['act_umb'];
                 $p[5]=$fila['codigo_cue'];
                 $p[6]=$fila['parafiscales'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from clases_actividad where act_codigo='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM clases_actividad where act_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['act_codigo']; 
                 $p[1]=$fila['act_nombre'];
                 $p[2]=$fila['act_nomrem'];
                 $p[3]=$fila['act_activo'];
                 $p[6]=$fila['parafiscales'];
        
            echo json_encode($p); 
            exit();
            break;
            }

