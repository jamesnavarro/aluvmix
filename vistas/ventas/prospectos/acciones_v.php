<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
                 $id    = $_GET['id'];
                 $est    = $_GET['est'];
                 $nov    = $_GET['nov'];
                 $sql = "UPDATE `prospecto` SET `estado` = '$est', novedad='$nov' WHERE `id_prospecto` = '$id'";
                 $oh = mysqli_query($con, $sql);
                 echo $oh ; 

           break;
        case 2:
                   $id     = $_GET['id'];
                   $obs    = $_GET['obs'];
                   $punto  = $_GET['punto'];
                 $sql = "UPDATE `prospecto` SET `puntos` = '".$punto."', obs='".$obs."' WHERE `id_prospecto` = '$id'";
                 echo $oh = mysqli_query($con,$sql, $conexioni);
           break;
        case 3:
                    $cod = $_GET['idc'];
                    $resultado = mysqli_query($con,"select *  FROM sis_contacto WHERE id_contacto = '$cod' ");
                    $r = mysqli_fetch_array($resultado);
                    $p = array();
                    $p[0] = $r[0]; 
                    $p[1] = $r[1];
                    $p[2] = $r[13];
                    $p[3] = $r[7];
                    $p[4] = $r[8];
                    $p[5] = $r[26];
                    $p[6] = $r[29];
                    echo json_encode($p);
                    exit();
        break;
        case 4:
            $idp    = $_GET['idp'];
            $idc    = $_GET['idc'];
            $nom    = $_GET['nom'];
            $cargo  = $_GET['cargo'];
            $area   = $_GET['area'];
            $email  = $_GET['email'];
            $obs    = $_GET['obs'];$tel    = $_GET['tel'];
            if($idc==''){
               $sql = "INSERT INTO sis_contacto (id_obra, tipo, area_user, nombre_cont, cargo, departamento, estado,tel_oficina, usuario, email1,informacion,fecha_registro,fecha_modificacion) ";
               $sql.= "VALUES ('".$idp."','Contactado','Ventas','".$nom."', '".$cargo."', '".$area."', 'Activo', '".$tel."', '".$_SESSION['k_username']."', '".$email."', '".$obs."', '".date("Y-m-d")."', '".date("Y-m-d")."')";
               $ver =  mysqli_query($con, $sql);
               echo mysqli_error($con);
               $sql1 = "SELECT MAX(id_contacto) as id FROM sis_contacto";
               $fila1 =mysqli_fetch_array(mysqli_query($con,$sql1));
               $idc = $fila1["id"];
               mysqli_query($con,"UPDATE `prospecto` SET `con` = `con`+1 WHERE `id_prospecto` = '".$idp."';");
            }else{
                $sql = "UPDATE `sis_contacto` SET `nombre_cont` = '".$nom."', `cargo` = '".$cargo."', `departamento` = '".$area."',  `tel_oficina` = '".$tel."', `email1` = '".$email."', `informacion` = '".$obs."', `fecha_modificacion` = '".date("Y-m-d")."' WHERE `id_contacto` = '".$idc."';";
                $ver = mysqli_query($con, $sql);
                echo mysqli_error($con);
            }
            
        break;
       case 5:
                    $cod = $_GET['id'];
                    $resultado = mysqli_query($con,"select * FROM actividad WHERE Id = '$cod' ");
                    $r = mysqli_fetch_array($resultado);
                    $p = array();
                    $p[0] = $r[0]; 
                    $p[1] = $r[1];
                    $p[2] = $r[2];
                    $p[3] = substr($r[4],0,10);
                    $p[4] = substr($r[5],0,10);
                    $p[5] = $r[9];
                    $p[6] = $r[16];
                    $p[7] = $r[3];
                    $p[8] = substr($r[4],11,-3);
                    $p[9] = substr($r[5],11,-3);
                    $p[10] = $r[13];
                    echo json_encode($p);
                    exit();
        break;
        case 6:
            $idp     = $_GET['idp'];
            $id      = $_GET['id'];
            $asunto  = $_GET['asunto'];
            $lugar   = $_GET['lugar'];
            $fi      = $_GET['fi'];
            $ff      = $_GET['ff'];
            $obs     = $_GET['obs'];
            $tipo    = $_GET['tipo'];
            $estado  = $_GET['estado'];
            $cont    = $_GET['con'];
            if($tipo=='Tarea'){
                $color= '-5';
            }else{
                if($tipo=='Llamada'){
                    $color= '9';
                }else{
                    $color= '12';
                 }
            }
            if($id==''){
               $sql = "INSERT INTO actividad (color, id_contacto, Subject, Location, Description, StartTime, EndTime, estado, id_seleccionado, tarea,user) ";
               $sql.= "VALUES ('".$color."','".$cont."','".$asunto."','".$lugar."','".$obs."','".$fi."','".$ff."', '".$estado."','".$idp."','".$tipo."','".$_SESSION['k_username']."')";
               mysqli_query($con,$sql);
               echo mysqli_error($con);
               $sql1 = "SELECT MAX(Id) as id FROM actividad";
               $fila1 =mysqli_fetch_array(mysqli_query($con,$sql1));
               $id = $fila1["id"];
               mysqli_query($con,"UPDATE `prospecto` SET `vis` = `vis`+1 WHERE `id_prospecto` = '".$idp."';");
               $result2 = mysqli_query($con,"select * from prospecto where `id_prospecto` = '$idp' ");
                 $p = mysqli_fetch_array($result2);
                 $proyecto = $p['nombre_proyecto'];
                 $asig = $p['asignado'];
                 //ventas@templadosa.com  jamesnavarroblanco@gmail.com
//                $result = mysqli_query($con,"select * from usuarios where usuario='$asig' ");
//                 $r = mysqli_fetch_array($result);
//                 //$email = $r['email'];
//                 $email = 'jamesjnb@hotmail.com';
//                 $para  = $email;
//                 
//$titulo    = 'Programacion de actividad '.$proyecto;
//$mensaje   = 'Se ha asignado una actividad nueva: ('.$asunto.'). Fecha de Inicio : '.$fi;
//$cabeceras = 'From: ventas@templadosa.com' . "\r\n" .
//    'Reply-To: ventas@templadosa.com' . "\r\n" .
//    'X-Mailer: PHP/' . phpversion();
//
//mail($para, $titulo, $mensaje, $cabeceras);

            }else{
              
                $ver = mysqli_query($con,"UPDATE `actividad` SET `id_contacto` = '".$cont."',`Location` = '".$lugar."',`Subject` = '".$asunto."', `Description` = '".$obs."', `StartTime` = '".$fi."',  `EndTime` = '".$ff."', `estado` = '".$estado."', `id_seleccionado` = '".$idp."', `tarea` = '".$tipo."' WHERE `Id` = '".$id."';");
 echo mysqli_error($con);          
                }

        break;
       case 7:
                    $cod = $_GET['idn'];
                    $resultado = mysqli_query($con,"select * FROM necesidades WHERE id_n = '$cod' ");
                    $r = mysqli_fetch_array($resultado);
                    $p = array();
                    $p[0] = $r[0]; 
                    $p[1] = $r[1];
                    $p[2] = $r[2];
                    echo json_encode($p);
                    exit();
        break;
        case 8:
         $idn    = $_GET['idn'];
         $nec    = $_GET['nec'];
         $file   = $_GET['file'];
         $obra   = $_GET['obra'];
            if($idn==''){
               mysqli_query($con,"UPDATE `prospecto` SET `nec1` = `nec1`+1 WHERE `id_prospecto` = '".$obra."';");
               $sql = "INSERT INTO necesidades (id_obra,asunto,registrado_por) ";
               $sql.= "VALUES ('".$obra."','".$nec."', '".$_SESSION['k_username']."')";
               $ver =  mysqli_query($con,$sql);
               $sql1 = "SELECT MAX(id_n) as id FROM necesidades";
               $fila1 =mysqli_fetch_array(mysqli_query($sql1));
               $id = $fila1["id"];
              
            }else{
                $sql = "UPDATE `necesidades` SET `asunto` = '".$nec."' WHERE `id_n` = '".$idn."';";
                $ver = mysqli_query($con,$sql);
            }
            echo $obra;
         
        break;
        case 9:

        break;
            case 10:
                    //C01BD01
                    $cod = $_GET['cod'];
                    $consulta= "select * from laboratorio WHERE `cod_lab`='".$cod."'";
                    $result=  mysqli_query($con,$consulta);
                    $r = ''; $co = ''; $no = '';
                    while($f=  mysqli_fetch_array($result)){
                        $r = $r.'<option value="'.$f[0].'">'.$f[1].' - '.$f[2].'</option>';
                        $co = $f['cod_lab'];
                        $no = $f['nombre_lab'];
                    }
                    $p = array();
                    $p[0] = $r; 
                    $p[1] = $co;
                    $p[2] = $no;
                    echo json_encode($p);
                    exit();
        break;
        case 11:
            
            $pro = $_GET['pro'];
            $emp = $_GET['emp'];
            $tel1 = $_GET['tel1'];
            $tel2 = $_GET['tel2'];
            $reg = $_GET['reg'];
            $ciu = $_GET['ciu'];
            $zon = $_GET['zon'];
            $dir = $_GET['dir'];
            $bar = $_GET['bar'];
            $estr = $_GET['estr'];
            $tip = $_GET['tip'];
            $fas = $_GET['fas'];
            $est = $_GET['est'];
            $asi = $_GET['asi'];
            $nit = $_GET['nit'];
            $conx = $_GET['con'];
            $id_obra = $_GET['obra'];
            $estg = $_GET['estg'];
            $porque = $_GET['porque'];
            if($id_obra==''){
                $res = mysqli_query($con,"insert into prospecto (`modificado_por`,`id_proyecto`, `regional`,"
                        . " `ciudad`,"
                        . " `zona`,"
                        . " `estrato`, "
                        . "`destino`, "
                        . "`barrio`,"
                        . " `nombre_proyecto`,"
                        . " `empresa`,"
                        . " `telefono_empresa`,"
                        . " `direccion_empresa`, "
                        . " `telefonos`,"
                        . " `nit_constructor`,"
                        . " `nombre_constructor`,"
                        . " `telefeno_constructor`, "
                        . " `tipo_proyecto`,"
                        . " `fase_proyecto`,"
                        . " `estado`,"
                        . " `asignado`,"
                        . " `fecha_asignada`,"
                        . "`estado_obra`,`con`,`vis`,`cot`,`nec1`,`ges`,`ped`,`puntos`) "
                        . " values ('".$_SESSION['k_username']."','0','$reg','$ciu','$zon','$estr','Venta','$bar','$pro','$emp','$tel1','$dir', '$tel2','$nit','$conx', '$tel1','$tip','$fas','Seleccionado','$asi','".date("Y-m-d H:m:s")."','$est','0','0','0','0','0','0','0')");
                
            }else{
                if($est=='Adjudicado'){
                    $cero = '1';
                }else{
                    $cero = '0';
                }
                $res = mysqli_query($con,"UPDATE `prospecto` SET "
                        . " `regional` = '$reg',"
                        . " `ciudad` = '$ciu',"
                        . " `zona` = '$zon',"
                        . " `estrato` = '$estr',"
                        . " `barrio` = '$bar',"
                        . " `nombre_proyecto` = '$pro',"
                        . " `empresa` = '$emp',"
                        . " `telefono_empresa` = '$emp',"
                        . " `direccion_empresa` = '$dir', "
                        . "`telefonos` = '$tel1',"
                        . " `nit_constructor` = '$nit',"
                        . " `nombre_constructor` = '$con',"
                        . " `telefeno_constructor` = '$tel2',"
                        . " `tipo_proyecto` = '$tip',"
                        . " `fase_proyecto` = '$fas',"
                        . " `asignado` = '$asi',"
                        . " `estado_obra` = '$est',`estado` = '$estg',`novedad` = '$porque',`ped` = '$cero',`ges` = '$cero' WHERE `id_prospecto` ='$id_obra' ");
            }
           echo $res;
        break;
        case 12:
                   $id    = $_GET['id'];
                  
                   $asig   = $_GET['asig'];
                 $sql = "UPDATE `prospecto` SET `asignado` = '".$asig."', fecha_asignada='".date("Y-m-d H:m:s")."' WHERE `id_prospecto` = '$id'";
                 echo $oh = mysqli_query($con,$sql);
                 
                 $result = mysqli_query($con,"select * from usuarios where usuario='$asig' ");
                 $r = mysqli_fetch_array($result);
                 $email = $r['email'];
                 $para      = $email;
                 $result2 = mysqli_query($con,"select * from prospecto where `id_prospecto` = '$id' ");
                 $p = mysqli_fetch_array($result2);
                 $proyecto = $p['nombre_proyecto'];
$titulo    = 'Prospecto Asignado , Obra: '.$proyecto;
$mensaje   = 'Se le ha asignado un prospecto nuevo, verifique en el sistema para que gestione esa obra. \n  ingrese al sistema: obras.templadosa.com.co';
$cabeceras = 'From: ventas@templadosa.com' . "\r\n" .
    'Reply-To: ventas@templadosa.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);

        break;
     case 13:
$idcot = $_GET['idcot'];
$obrac = $_GET['obrac'];
$numero = $_GET['numero'];
$analista = $_GET['analista'];
$asesor = $_GET['asesor'];
$est_cot = $_GET['est_cot'];
$fecha = $_GET['fecha'];

if($idcot==''){
$ingresar = mysqli_query($con,"insert into cotizaciones_prospectos (id_obra, numero_cotizacion, archivo, analista, asesor,estado, observaciones, registro_por)"
        . "  values('".$obrac."','".$numero."','".$foto."','".$analista."','".$asesor."','".$est_cot."','".$fecha."','".$_SESSION['k_username']."')");
echo mysqli_error($con);
mysqli_query($con,"UPDATE `prospecto` SET `cot` = `cot`+1 WHERE `id_prospecto` = '".$obrac."';");
}else{
    if($foto!=''){
        $f = ",archivo= '".$foto."'";
    }else{
        $f = '';
    }
    $sql = "UPDATE `cotizaciones_prospectos` SET `numero_cotizacion` = '".$numero."', `analista` = '".$analista."', `asesor` = '".$asesor."', `estado` = '".$est_cot."', `observaciones` = '".$fecha."',registro_por='".$_SESSION['k_username']."' $f  WHERE `id_cp` = '".$idcot."';";
                $ingresar = mysqli_query($con,$sql);
}

echo $ingresar;

        break;
       
     case 14:
          $cod = $_GET['idc'];
                    $resultado = mysqli_query($con,"select * FROM cotizaciones_prospectos WHERE id_cp = '$cod' ");
                    $r = mysqli_fetch_array($resultado);
                    $p = array();
                    $p[0] = $r[0]; 
                    $p[1] = $r[1];
                    $p[2] = $r[2];
                    $p[3] = $r[3];
                    $p[4] = $r[4];
                    $p[5] = $r[5];
                    $p[6] = $r[6];
                    $p[7] = $r[7];
                    $p[8] = $r[8];
                    $p[9] = $r[9];
                    $p[10] = $r[10];
                    echo json_encode($p);
                    exit();
           break;
}

?>