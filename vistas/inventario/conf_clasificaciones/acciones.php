<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_estan'];
            $nom=$_GET['estante_f'];
     
            $result = mysqli_query($con,"select count(*) from estantes_ubicaciones where id_estante='$id' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into estantes_ubicaciones (`id_estante`,`estante`) values ('$id','$nom')");
            }
            else{
                mysqli_query($con,"update estantes_ubicaciones set estante='$nom  where id_estante='$id'");
                echo $id;
            }
            
            break;
            case 2:
                 $idw=$_GET['ids'];
                 $query = mysqli_query($con,"SELECT * FROM estantes_ubicaciones  where  id_estante='$idw' "); 
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_estante']; 
                 $p[1]=$fila['estante'];
              
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from estantes_ubicaciones where id_estante='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM estantes_ubicaciones where id_estante='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p = array();
                  $p[0]=$fila['id_estante']; 
                 $p[1]=$fila['estante'];
            echo json_encode($p); 
            exit();
            break;
            }

