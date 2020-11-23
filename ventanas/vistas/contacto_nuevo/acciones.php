<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
          case 1:
            $id=$_GET['id_nuevocontn'];
            $nom_nuevocn=$_GET['nom_nuevoconn'];
            $tel_nuevoconn=$_GET['tel_nuevocontn'];
            $emai_nuevocon=$_GET['emai_nuevocontn'];
            $carg_nuevocn=$_GET['carg_nuevocontn'];
            $suge_nuevocn=$_GET['suge_nuevoconn'];
            $guardo_nuen=$_SESSION['k_username'];
            $fech_nuevoconn=date("Y-m-d");
            $nombre_idcli=$_GET['id_nomclien'];
            if($id==''){
               
                $ver=mysqli_query($con,"insert into sis_contacto (`nombre_cont`,`celular`,`email1`,`area_user`,`notas`,`quien_registra`,`fecha_registro`,`id_rel_tercero`)"
                        . "                         values ('$nom_nuevocn','$tel_nuevoconn','$emai_nuevocon','$carg_nuevocn','$suge_nuevocn','$guardo_nuen','$fech_nuevoconn','$nombre_idcli')");
                
                $query = mysqli_query($con,"select max(id_contacto) from sis_contacto");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_contacto)'];
                echo $ultimo;
               // echo $ver;
            }
            else{
             
                $ver = mysqli_query($con,"update sis_contacto set nombre_cont='$nom_nuevocn' ,celular='$tel_nuevoconn' ,email1='$emai_nuevocon' ,area_user='$carg_nuevocn' ,notas='$suge_nuevocn' ,quien_registra='$guardo_nuen' ,fecha_registro='$fech_nuevoconn' ,id_rel_tercero='$nombre_idcli' where id_contacto='$id'");
              
                echo $id;
            }
            
        break;
        
        case 2:
         $id=$_GET['id'];
            $query = mysqli_query($con,"select * FROM sis_contacto where id_contacto='$id' ");
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_contacto'];
            $p[1]=$fila['nombre_cont'];
            $p[2]=$fila['celular']; 
            $p[3]=$fila['email1'];
            $p[4]=$fila['area_user'];
            $p[5]=$fila['notas'];
            $p[6]=$fila['quien_registra'];
            $p[7]=$fila['fecha_registro'];
            
            $p[8]=$fila['id_rel_tercero'];
            $query = mysqli_query($con,"select nom_ter FROM cont_terceros where id_ter='".$fila['id_rel_tercero']."' ");
            $fi = mysqli_fetch_array($query);
            $p[9]=$fi['nom_ter'];
         
            echo json_encode($p); 
            exit();
            break;
        
        case 3:
           
            $id=$_GET['id'];
         
            $query = mysqli_query($con,"delete from sis_contacto where id_contacto='$id' ");
            
        break;
        
        case 4: 
             $id=$_GET['nombre'];
             $consulta = mysqli_query($con,"SELECT * FROM `departamentos` where nombre_dep='$id'");
                            while($f = mysqli_fetch_array($consulta)){ 
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
                            }
            break;
        
}

