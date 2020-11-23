<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $cod_cta=$_GET['cod_cta'];
            $desc_cta=$_GET['desc_cta'];
            $cuenta_cta=$_GET['cuenta_cta'];
           
            if($id==''){
                $ver=mysqli_query($con, "insert into tipo_cuentas (`codigo`,`descripcion`,`cuenta`) "
                                        . "values ('$cod_cta','$desc_cta','$cuenta_cta')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_cta) from tipo_cuentas");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_cta)'];
                echo $ultimo;
            }
            
            else{+
                mysqli_query($con,"update tipo_cuentas set codigo='$cod_cta', descripcion='$desc_cta', cuenta='$cuenta_cta' where id_cta='$id'");
                echo $id;
            }
            break;
            
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM tipo_cuentas where id_cta='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_cta'];
                 $p[1]=$fila['codigo'];
                 $p[2]=$fila['descripcion'];
                 $p[3]=$fila['cuenta'];
            echo json_encode($p); 
            exit();
            break;
        
            case 3:
               $id=$_GET['id'];
               $query = ("delete from tipo_cuentas where id_cta='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM tipo_cuentas codigo where codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_cta'];
                 $p[1]=$fila['codigo'];
                 $p[2]=$fila['descripcion'];
                 $p[3]=$fila['cuenta'];
               
            echo json_encode($p); 
            exit();
            break;
         
}
