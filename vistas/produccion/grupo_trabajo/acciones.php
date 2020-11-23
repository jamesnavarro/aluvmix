<?php
include('../../../modelo/conexionv1.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idg'];
            $nomm=$_GET['nom'];
            $areag=$_GET['area_g'];
            $metg=$_GET['met_g'];
            $estado_g=$_GET['estado_g'];
            if($id==''){
                $ver=mysqli_query($con2,"insert into grupo (`name`,`id_area`,`id_pago`,`estado_gr`) values ('$nomm','$areag','$metg','$estado_g')");
                
                $query = mysqli_query($con2,"select max(id_g) from grupo");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_g)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con2,"update grupo set name='$nomm', id_area='$areag', id_pago='$metg', estado_gr='$estado_g' where id_g='$id'");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con2,"SELECT * FROM grupo where id_g='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_g']; 
                 $p[1]=$fila['name'];
                 $p[2]=$fila['id_area'];
                 $p[3]=$fila['id_pago'];
                 $p[4]=$fila['estado_gr'];
               
                  
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con2,"delete from grupo where id_g='$id' ");
            break;
        
         case 4:
            $idg=$_GET['idnum'];
            $idu=$_GET['nomusu'];
            
            $query = mysqli_query($con2,"SELECT count(*) FROM grupo_det where id_g='$idg' and id_user='$idu' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 
                 if ($fila['count(*)']==0){
          
             $sql = "INSERT INTO `grupo_det` (`id_g`, `id_user`, `ingresado_por`, `fecha_ingreso`)";
             $sql.= "VALUES ('".$idg."', '".$idu."', '".$_SESSION['k_username']."', '".date("Y-m-d")."')";
             mysqli_query($con2,$sql, $con2exion);
                      echo '0';
                 }else{
                     echo '1';
                 }
           
            break;
            
            
            case 5: 
                $idg=$_GET['idgd'];
                $est=$_GET['est'];
                if($est==0){
                    $est = 1;
                    //registro de inasistencia
                }else{
                    $est = 0;
                }
               echo $ver =  mysqli_query($con2,"update grupo_det set est='$est' where id_gd='$idg'");
            break;
        
          case 6:
               $user=$_GET['user'];
               $fecha=date("Y-m-d");
               $nov=$_GET['nov'];
               $query = mysqli_query($con2,"select count(id) from inasistencias where id_user='$user' and fecha_registro='$fecha' ");
               $r = mysqli_fetch_array($query);
               if($r[0]>0){
                   echo 'Ya se encuentra una novedad para esta fecha';
               }else{
                   
                   mysqli_query($con2,"INSERT INTO `inasistencias` (`id`, `id_user`, `fecha_registro`, `registradopor`, `fechamod`, `motivo`) VALUES (NULL, '$user', '$fecha', '".$_SESSION['k_username']."', '".date("Y-m-d H:i:s")."', '$nov')");
                   echo 'Se registro la novedad con exito';
               }
            break;
        case 7:
            $user=$_GET['id'];
            $query = mysqli_query($con2,"select * from inasistencias where id_user='$user' order by fecha_registro asc ");
            while ($row = mysqli_fetch_array($query)) {
                echo '<tr>'
                . '<td>'.$row[2].'</td>'
                . '<td>'.$row[3].'</td>'
                . '<td>'.$row[5].'</td>';
            }
          
            
            break;
        
            }

