<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $nombreuserN=$_GET['nombreuser'];
            $codbarrauserN=$_GET['codbarrauser'];
            $conttruserN=md5($_GET['contraseñauser']);
            $numceduuserN=$_GET['numcedulauser'];
            $correouseN=$_GET['correouser'];
            $admuserN=$_GET['administradoruser'];
            $nomcompluserN=$_GET['nomcompletouser'];
            $apellidouserN=$_GET['apellidouser'];
            $estadouserN=$_GET['estadouser'];
            $cargusuN=$_GET['cargous'];
            $areauserN=$_GET['areauser'];
            $teleuserN=$_GET['telefonouser'];
            $moviluserN=$_GET['moviluser'];
            $direcuseNr=$_GET['direccionuser'];
            $paisuserN=$_GET['paisuser'];
            $userdepN=$_GET['userdep'];
            $usermuniN=$_GET['usermuni'];
            $sedeuserN=$_GET['sedeuser'];
            $roluserN=$_GET['roluser'];
            $empuserN=$_GET['empresauser'];
            $sangreuserN=$_GET['sangreuser'];
            $rutauserN=$_GET['rutauser']; 
            $user_fom=$_GET['user_fom'];
            if($id==''){
                $ver=mysqli_query($con, "insert into usuarios (`usuario`,`cod_barra`,`password`,`cedula`,`email`,`administrador`,`nombre`,`apellido`,`estado`,`cargo`,`area`,`telefono`,`celular`,`direccion`,`pais`,`ciudad`,`municipio`,`sede`,`id_roles`,`id_empresa`,`sangre`,`ruta`,`userfom`) "
                        . "values ('$nombreuserN','$codbarrauserN','$conttruserN','$numceduuserN','$correouseN','$admuserN','$nomcompluserN','$apellidouserN','$estadouserN','$cargusuN','$areauserN','$teleuserN','$moviluserN','$direcuseNr','$paisuserN','$userdepN','$usermuniN','$sedeuserN','$roluserN','$empuserN','$sangreuserN','$rutauserN','$user_fom')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_user) from usuarios");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_user)'];
                echo $ultimo;
            }
            else{
                if ($_GET['contraseñauser']==''){
                    $hc="";
                }else{
                    $hc=", password='$conttruserN' ";
                }
                mysqli_query($con,"update usuarios set usuario='$nombreuserN'  $hc , cod_barra='$codbarrauserN', cedula='$numceduuserN', email='$correouseN', administrador='$admuserN', nombre='$nomcompluserN', apellido='$apellidouserN', estado='$estadouserN', cargo='$cargusuN', area='$areauserN', telefono='$teleuserN', celular='$moviluserN', direccion='$direcuseNr', pais='$paisuserN', ciudad='$userdepN', municipio='$usermuniN', sede='$sedeuserN', id_roles='$roluserN', id_empresa='$empuserN', sangre='$sangreuserN', ruta='$rutauserN', userfom='$user_fom' where id_user='$id'");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM usuarios where id_user='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_user'];
                 $p[1]=$fila['usuario'];
                 $p[2]=$fila['cod_barra'];
                 $p[3]='';
                 $p[4]=$fila['cedula'];
                 $p[5]=$fila['email'];
                 $p[6]=$fila['administrador'];
                 $p[7]=$fila['nombre'];
                 $p[8]=$fila['apellido'];
                 $p[9]=$fila['estado'];
                 $p[10]=$fila['cargo'];
                 $p[11]=$fila['area'];
                 $p[12]=$fila['telefono'];
                 $p[13]=$fila['celular'];
                 $p[14]=$fila['direccion'];
                 $p[15]=$fila['pais'];
                 $p[16]=$fila['ciudad'];
                 $p[17]=$fila['municipio'];
                 $p[18]=$fila['sede'];
                 $p[19]=$fila['id_roles'];
                 $p[20]=$fila['id_empresa'];
                 $p[21]=$fila['sangre'];
                 $p[22]=$fila['ruta'];
                 $p[23]=$fila['userfom'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from usuarios where id_user='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM usuarios where usuario='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_user'];
                 $p[1]=$fila['usuario'];
                 $p[2]=$fila['cod_barra'];
                 $p[3]='';
                 $p[4]=$fila['cedula'];
                 $p[5]=$fila['email'];
                 $p[6]=$fila['administrador'];
                 $p[7]=$fila['nombre'];
                 $p[8]=$fila['apellido'];
                 $p[9]=$fila['estado'];
                 $p[10]=$fila['cargo'];
                 $p[11]=$fila['area'];
                 $p[12]=$fila['telefono'];
                 $p[13]=$fila['celular'];
                 $p[14]=$fila['direccion'];
                 $p[15]=$fila['pais'];
                 $p[16]=$fila['ciudad'];
                 $p[17]=$fila['municipio'];
                 $p[18]=$fila['sede'];
                 $p[19]=$fila['id_roles'];
                 $p[20]=$fila['id_empresa'];
                 $p[21]=$fila['sangre'];
                 $p[22]=$fila['ruta'];
                 $p[23]=$fila['userfom'];
                 
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
        case 6:
             $id=$_GET['id'];
             //comprobar si tiene roles
             $resultu= mysqli_query($con," select count(id_user) from roles where id_user='$id' ");
             $u = mysqli_fetch_array($resultu);
             if($u[0]==0){
                    $result= mysqli_query($con,"insert into roles (modulo,acceso,id_user,submodulo)  select modulo, '1', '$id', submenu from modulos  ");
            
             }
             $result2= mysqli_query($con," select modulo,submenu from modulos  ");
         
         while($fi = mysqli_fetch_array($result2)){
             $result3= mysqli_query($con," select count(modulo) from roles where modulo='".$fi['modulo']."' and submodulo='".$fi['submenu']."' and id_user=1 having count(modulo)=0 ");
             $t = mysqli_fetch_array($result3);
             if($t[0]=='0'){
             mysqli_query($con,"insert into roles (modulo,acceso,id_user,submodulo) values ('".$fi['modulo']."','1','$id','".$fi['submenu']."')  ");
             }
         }
             
             

          $result= mysqli_query($con," select * from roles where id_user='$id' and submodulo='' ");
         $c = 0;
         while($f = mysqli_fetch_array($result)){
          $c++;
          if($f['acceso']=='1'){
            $che = 'checked';
          }else{
            $che = '';
          }
          $res= mysqli_query($con," select modulo,id_rol,acceso from roles where submodulo='".$f['modulo']."' and id_user='$id' ");
        $sub = '<ul>';
         while($r = mysqli_fetch_array($res)){
             if($r['acceso']=='1'){
               $che2 = 'checked';
             }else{
               $che2 = '';
             } 
              $sub = $sub.'<li> <input type="checkbox" id="rol'.$r['id_rol'].'" '.$che2.' onclick="addrol('.$r['id_rol'].')"> '.$r[0];
           
         }
        
             
          echo '<tr>
          <td>'.$c.'</td>
          <td>'.$f['modulo'].'</td>
              <td>'.$sub.'</td>
           <td><input type="checkbox" id="rol'.$f['id_rol'].'" '.$che.' onclick="addrol('.$f['id_rol'].')"></td>
          </tr>';

         
         }
         
            
            break;
            case 7:
                $id=$_GET['id'];
                $resultu= mysqli_query($con," select acceso from roles where id_rol='$id' ");
                $f = mysqli_fetch_array($resultu);
                if($f['acceso']=='1'){
                $res = '0';
             }else{
                $res = '1';
             }

             mysqli_query($con,"update roles set acceso='$res' where id_rol='$id' ");
             echo mysqli_error($con);



            break;
            case 8:
                $id=$_GET['id'];
                $resultu= mysqli_query($con," select estado from usuarios where id_user='$id' ");
                $f = mysqli_fetch_array($resultu);
                if($f['estado']=='No Activo'){
                    $res = 'Activo';
                }else{
                    $res = 'No Activo';
                }

             mysqli_query($con,"update usuarios set estado='$res' where id_user='$id' ");
             echo mysqli_error($con);



            break;
}