<?php
include('../../modelo/conexion.php');
session_start();
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
                 $query = mysqli_query($con,"SELECT * FROM dolares where id_dolar='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_dolar']; 
                 $p[1]=$fila['lma'];
                 $p[2]=$fila['precio_dolar'];
                 $p[3]=$fila['prima'];
                 $p[4]=$fila['precio_actual'];
                 $p[5]=$fila['fecha_reg_dolar'];
                  
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from dolares where id_dolar='$id' ");
            break;
            }

