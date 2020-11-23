<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $tipodocempN=$_GET['tipodocemp'];
            $cod=$_GET['identifiemp'];
            $codigoempN=$_GET['codigoemp'];
            $nombreempN=$_GET['nombreemp'];
            $direccempN=$_GET['direccemp'];
            $telefonoempN=$_GET['telefonoemp'];
            $movilempN=$_GET['movilemp'];
            $correoempN=$_GET['correoemp'];
            $costoaempN=$_GET['costoaemp'];
            $cargoempN=$_GET['cargoemp'];
            $salaactuempN=$_GET['salaactuemp'];
            $estadoempN=$_GET['estadoemp'];
            $empdepN=$_GET['empdep'];
            $empmuniN=$_GET['empmuni'];
            $registroempN=$_GET['registroemp'];
            $modificacionempN=$_GET['modificacionemp'];
        
            $result = mysqli_query($con,"select count(*) from empleados where EMP_CEDULA='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into empleados (`EMP_CLADOC`,`EMP_CEDULA`,`EMP_CODIGO`,`EMP_NOMBRE`,`EMP_DIRECC`,`EMP_TELEFO`,`EMP_TELCEL`,`EMP_EMAIL`,`EMP_COSTOS`,`EMP_CARGO`,`EMP_SALACT`,`EMP_ESTADO`,`EMP_SUBZON`,`EMP_CIUDAD`,`EMP_FREGISTRO`,`EMP_MODIFICA`) "
          . "values ('$tipodocempN','$cod','$codigoempN','$nombreempN','$direccempN','$telefonoempN','$movilempN','$correoempN','$costoaempN','$cargoempN','$salaactuempN','$estadoempN','$empdepN','$empmuniN','$registroempN','$modificacionempN')");
           echo mysqli_error($con);
                }
            else{
                mysqli_query($con,"update empleados set EMP_CLADOC='$tipodocempN', EMP_CODIGO='$codigoempN', EMP_NOMBRE='$nombreempN', EMP_DIRECC='$direccempN', EMP_TELEFO='$telefonoempN', EMP_TELCEL='$movilempN', EMP_EMAIL='$correoempN', EMP_COSTOS='$costoaempN', EMP_CARGO='$cargoempN', EMP_SALACT='$salaactuempN', EMP_ESTADO='$estadoempN', EMP_SUBZON='$empdepN', EMP_CIUDAD='$empmuniN' where EMP_CEDULA='$cod'");
               
                echo mysqli_error($con);
            }
            
            break;
                case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM empleados where EMP_CEDULA='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $subject = $fila['EMP_DIRECC'];
                 $resultado = str_replace("°", "", $subject);
                 
                 $p = array(); 
                 $p[0]=$fila['EMP_CLADOC'];
                 $p[1]=$fila['EMP_CEDULA'];//
                 $p[2]=$fila['EMP_CODIGO'];
                 $p[3]=$fila['EMP_NOMBRE'];
                 $p[4]= trim($resultado);
                 $p[5]=$fila['EMP_TELEFO'];
                 $p[6]=$fila['EMP_TELCEL'];
                 $p[7]=$fila['EMP_EMAIL'];
                 $p[8]=$fila['EMP_COSTOS'];
                 $p[9]=$fila['EMP_CARGO'];
                 $p[10]=$fila['EMP_SALACT'];
                 $p[11]=$fila['EMP_ESTADO'];
                 $p[12]=$fila['EMP_SUBZON'];
                 $p[13]=$fila['EMP_CIUDAD'];
                 $p[14]=$fila['EMP_FREGISTRO'];
                 $p[15]=$fila['EMP_NAC'];
                 $p[16]=$fila['EMP_SALACT']*30;
              
                    
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query =  ("delete from empleados where EMP_CEDULA='$id' ");
            break;
        case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM empleados where EMP_CEDULA='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 

                 $subject = $fila['EMP_DIRECC'];
                 $resultado = str_replace("°", "", $subject);
     

                 $p = array();
                 $p[0]=$fila['EMP_CLADOC'];
                 $p[1]=$fila['EMP_CEDULA'];
                 $p[2]=$fila['EMP_NOMBRE'];
                 $p[3]=$fila['EMP_DIRECC'];
                 $p[4]=$resultado;
                 $p[5]=$fila['EMP_TELEFO'];
                 $p[6]=$fila['EMP_TELCEL'];
                 $p[7]=$fila['EMP_EMAIL'];
                 $p[8]=$fila['EMP_COSTOS'];
                 $p[9]=$fila['EMP_CARGO'];
                 $p[10]=$fila['EMP_SALACT'];
                 $p[11]=$fila['EMP_ESTADO'];
                 $p[12]=$fila['EMP_SUBZON'];
                 $p[13]=$fila['EMP_CIUDAD'];
                  $p[14]=$fila['EMP_FREGISTRO'];
                 $p[15]=$fila['EMP_NAC'];
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
