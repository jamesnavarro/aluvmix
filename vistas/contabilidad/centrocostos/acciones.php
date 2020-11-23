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
            $res=$_GET['res'];
            $cp=$_GET['cp'];
            $are=$_GET['are'];
            $result = mysqli_query($con,"select count(*) from centrocostos where cen_codigo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into centrocostos (`cen_codigo`,`cen_nombre`,`cen_nomrem`,`cen_activo`,`usuario`,`cod_empresa`,`cod_centropro`,`codigo_are`) "
                        . "values ('$cod','$des','$res','$est','$usuario','$empresa','$cp','$are')");
            }
            else{
                mysqli_query($con,"update centrocostos set cen_nomrem='$res', cen_nombre='$des', cen_activo='$est', usuario='$usuario', cod_centropro='$cp', codigo_are='$are' where cen_codigo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM centrocostos where cen_codigo='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cen_codigo']; 
                 $p[1]=$fila['cen_nombre'];
                 $p[2]=$fila['cen_nomrem'];
                 $p[3]=$fila['cen_activo'];
                 $p[4]=$fila['cod_centropro'];
                 $p[5]=$fila['codigo_are'];
                 $p[6]=  substr($fila['cen_codigo'],0,2); 
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from centrocostos where cen_codigo='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM centrocostos where cen_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p = array();
                 $p[0]=$fila['cen_codigo']; 
                 $p[1]=$fila['cen_nombre'];
                 $p[2]=$fila['cen_nomrem'];
                 $p[3]=$fila['cen_activo'];
                 $p[4]=$fila['cod_centropro'];
                 $p[5]=$fila['codigo_are'];
                 $p[6]=  substr($fila['cen_codigo'],0,2); 
        
            echo json_encode($p); 
            exit();
            break;
        case 5:
            $cla = $_GET['cla'];
            echo '<option value="">Seleccione</option>';
            $result = mysqli_query($con, "select * from areascc where are_activo=0 and are_codigo like '".$cla."%' ");
                            while($r = mysqli_fetch_array($result)){
                                echo '<option value="'.$r[0].'">'.$r[0].' - '.$r[1].'</option>';
                            }
            break;
            }

