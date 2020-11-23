<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
         
            
            $id=$_GET['radi'];
            $asunto=$_GET['asunt'];
            $fecha=$_GET['ini'];
            $hora=$_GET['hra'];
            $fsh=$fecha.' '.$hora;
            $asigna=$_GET['asig'];
            $avis=$_GET['aviso'];
            $desc=$_GET['descrip'];
            $llamada=$_GET['llamada'];
            $est=$_GET['estado'];
            $nombre=$_GET['nom_cli'];

            if($id==''){
               
                $ver=mysqli_query($con,"insert into actividad (`Subject`,`Description`,`StartTime`,`estado`,`prioridad`,`aviso`,`user`,`id_contacto`,`EndTime`,`reg_user`) values ('$asunto','$desc','$fsh','$est','$llamada','$avis','$asigna','$nombre','$fsh','".$_SESSION['k_username']."')");
                
                $query = mysqli_query($con,"select max(Id) from actividad");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(Id)'];
                echo $ver;
            }
            else{
             
                mysqli_query($con,"update actividad set notificacion='0', Subject='$asunto',Description='$desc',StartTime='$fsh',estado='$est',prioridad='$llamada',aviso='$avis',user='$asigna',EndTime='$fsh' where Id='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * ,a.estado FROM actividad a ,sis_contacto b where a.id_contacto=b.id_contacto and a.Id='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['Id']; 
            $p[1]=$fila['Subject'];
            $p[2]=$fila['Description'];
            $fe = substr($fila['StartTime'],0,10);
            $ho = substr($fila['StartTime'],11);
            $p[3]=$fe;
            $p[4]=$fila['estado'];
            $p[5]=$fila['prioridad'];
            $p[6]=$fila['aviso'];
            $p[7]=$fila['user'];
            $p[8]=$fila['id_contacto'];
            $p[9]=$ho;
            $p[10]=$fila['nombre_cont'];
      
            echo json_encode($p); 
            exit();
       break;
        case 3:
         
            $id=$_GET['id'];
          
            //$query = mysqli_query($con,"delete from cont_terceros where id_ter='$id' ");
             mysqli_query($con,"UPDATE `actividad` SET `estado` = 'Completada' WHERE `Id` ='$id' ");
            break;
        
        case 4: 
             $id=$_GET['nombre'];
             $consulta = mysqli_query($con,"SELECT * FROM `departamentos` where nombre_dep='$id'");
                            while($f = mysqli_fetch_array($consulta)){
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
                            }
            break;  
        case 5:
            $request = mysqli_query($con,"SELECT count(*) from actividad a, sis_contacto b  where a.id_contacto=b.id_contacto and a.estado = 'Planificada' and a.StartTime like '".date("Y-m-d")."%'    ");
            $r =  mysqli_fetch_row($request);
            echo $r[0];
            
            break;
        case 6:
            $request = mysqli_query($con,"SELECT count(*), concat(b.nombre_cont,' ',b.apellido_cont) from actividad a, sis_contacto b  where a.id_contacto=b.id_contacto and a.estado = 'Planificada' and a.StartTime = '".date("Y-m-d H:i")."' and a.notificacion=0    ");
            $r =  mysqli_fetch_row($request);
            echo $r[1];
            if($r[0]>0){
            mysqli_query($con,"update actividad set notificacion='1' where  estado = 'Planificada' and StartTime like '".date("Y-m-d H:i")."' and notificacion=0 ");
            }
            break;
        case 7:
            echo date("H:i:s");
            break;
}

