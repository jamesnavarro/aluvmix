<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $desc_col=$_GET['desc_col'];
            $costo_col=$_GET['costo_col'];
            $vari_col=$_GET['vari_col'];
            $cod_col=$_GET['cod_col'];  
            $rendi_col=$_GET['rendi_col'];    
            $me_max=$_GET['me_max'];
            
            if($id==''){
                $ver=mysqli_query($con, "insert into tipo_aluminio (`color_a`,`costo_a`,`variable`,`codigo`,`rendimiento`,`medida_max`)" 
                                                        . "values ('$desc_col','$costo_col','$vari_col','$cod_col','$rendi_col','$me_max')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_ta) from tipo_aluminio");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ta)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update tipo_aluminio set color_a='$desc_col', costo_a='$costo_col', variable='$vari_col', codigo='$cod_col', rendimiento='$rendi_col', medida_max='$me_max' where id_ta='$id'");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM tipo_aluminio where id_ta='$id' "); //consulta modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_ta'];
                 $p[1]=$fila['color_a'];
                 $p[2]=$fila['costo_a'];
                 $p[3]=$fila['variable']; 
                 $p[4]=$fila['codigo'];
                 $p[5]=$fila['rendimiento'];
                 $p[6]=$fila['medida_max'];
               
                      
          
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from tipo_aluminio where id_ta='$id' ");
            break;
           
     
}