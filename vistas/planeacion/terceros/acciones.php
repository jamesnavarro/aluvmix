<?php
include '../../../modelo/conexioni.php';
session_start();
$con2 = $con;
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_t'];
            $tipo_doct=$_GET['tipo_doct'];
            $num_t=$_GET['num_t'];
            $nombre_t=$_GET['nombre_t'];
             $dir_t=$_GET['dir_t'];
            $tel_t=$_GET['tel_t'];
            $movil_t=$_GET['movil_t'];
            $dep_p=$_GET['dep_p'];
            $ciu_t=$_GET['ciu_t'];
            $correo_t=$_GET['correo_t'];
            $est_tp=$_GET['est_tp'];
            
            if($id==''){
                $ver=mysqli_query($con,"insert into cont_terceros (`doc_ter`,`cod_ter`,`nom_ter`,`dir_ter`,`telfijo_ter`,`telmovil_ter`,`municipio_ter`,`ciudad_ter`,`correo_ter`,`estado_ter`) values ('$tipo_doct','$num_t','$nombre_t','$dir_t','$tel_t','$movil_t','$dep_p','$ciu_t','$correo_t','$est_tp')");
                
                $query = mysqli_query($con,"select max(id_ter) from cont_terceros");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ter)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update cont_terceros set doc_ter='$tipo_doct', cod_ter='$num_t', nom_ter='$nombre_t', dir_ter='$dir_t', telfijo_ter='$tel_t', telmovil_ter='$movil_t', municipio_ter='$dep_p', ciudad_ter='$ciu_t', correo_ter='$correo_t', estado_ter='$est_tp' where id_ter='$id' ");
                echo $id;
            }
            break;
            case 2:
                 $idm=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM cont_terceros where id_ter='$idm' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_ter']; 
                 $p[1]=$fila['doc_ter'];
                 $p[2]=$fila['cod_ter'];
                 $p[3]=$fila['nom_ter'];
                 $p[4]=$fila['dir_ter'];
                 $p[5]=$fila['telfijo_ter']; 
                 $p[6]=$fila['telmovil_ter'];
                 $p[7]=$fila['municipio_ter'];
                 $p[8]=$fila['ciudad_ter'];
                 $p[9]=$fila['correo_ter'];
                 $p[10]=$fila['estado_ter'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from cont_terceros where id_ter='$id' ");
            break;
        
        case 4: 
             $dep=$_GET['dep'];
             $consulta = mysqli_query($con, "SELECT * FROM `departamentos` where nombre_dep='$dep'");
                            while($f = mysqli_fetch_array($consulta)){ 
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
                            }
            
            break;
        case 5:
            $ced=$_GET['ced'];
                $consulta= mysqli_query($con2, "UPDATE `cont_terceros` SET `estado_ter` = '1', validado ='1' WHERE `cod_ter`='$ced' ");
                echo mysqli_error($con).' ced:'.$ced;
            
            break;
          case 6:
                $ced=$_GET['ced'];
                $nom=$_GET['nom'];
                $consulta= mysqli_query($con2, "UPDATE `cont_terceros` SET validado ='1', nom_ter='$nom' WHERE `cod_ter`='$ced' ");
                echo mysqli_error($con).' ced:'.$ced;
            
            break;
      
        
            }

