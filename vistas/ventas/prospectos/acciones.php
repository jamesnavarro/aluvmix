<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $nomb=$_GET['prosnom'];
            $contr=$_GET['pcontruc'];
            $nitt=$_GET['prosnit'];
            $depa=$_GET['prodep'];
            $ciuda=$_GET['prociu'];
            $barrio=$_GET['probarr'];
            $tele=$_GET['protel'];
            $fase=$_GET['profase'];
            $estado=$_GET['proest'];
            $usu=$_GET['usuv'];
            if($id==''){
                $ver=mysqli_query($con, "insert into prospecto (`nombre_proyecto`,`nombre_constructor`,`nit_constructor`,`regional`,`ciudad`,`barrio`,`telefeno_constructor`,`fase_proyecto`,`estado`,`user`)"
                                      . "values ('$nomb','$contr','$nitt','$depa','$ciuda','$barrio','$tele','$fase','$estado','$usu')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_prospecto) from prospecto");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_prospecto)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update prospecto set nombre_proyecto='$nomb', nombre_constructor='$contr', nit_constructor='$nitt', regional='$depa', ciudad='$ciuda', barrio='$barrio', telefeno_constructor='$tele', fase_proyecto='$fase', estado='$estado', user='$usu' where id_prospecto='$id' ");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM prospecto where id_prospecto='$id'");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=trim($fila['nombre_proyecto']);
                 $p[1]=trim($fila['nombre_constructor']);
                 $p[2]=trim($fila['nit_constructor']);
                 $p[3]=trim($fila['regional']);
                 $p[4]=trim($fila['ciudad']);
                 $p[5]=trim($fila['barrio']);
                 $p[6]=trim($fila['telefeno_constructor']);
                 $p[7]=trim(utf8_encode($fila['fase_proyecto']));
                 $p[8]=trim($fila['estado']);
                 $p[9]=trim($fila['user']);
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from prospecto where bod_codigo='$id' ");
            break;
            case 4:
                  $id=$_GET['cod'];
                  $query = mysqli_query($con,"SELECT * FROM prospecto where id_prospecto='$id' "); //consultA modificada por navabla
                  $fila = mysqli_fetch_array($query);
                  $p = array();
                  $p[0]=$fila['id_prospecto']; 
                  $p[1]=$fila['nombre_proyecto'];
                  $p[2]=$fila['nombre_constructor'];
                  $p[3]=$fila['nit_constructor'];
                  $p[4]=$fila['regional'];
                  $p[5]=$fila['ciudad'];
                  $p[6]=$fila['barrio'];
                  $p[7]=$fila['telefeno_constructor'];
                  $p[8]=$fila['fase_proyecto'];
                  $p[9]=$fila['estado'];
            echo json_encode($p); 
            exit();
            break;
            case 5: 
             $id=$_GET['nombre'];
             $consulta = mysqli_query($con, "SELECT * FROM `departamentos` where nombre_dep='$id'");
                            while($f = mysqli_fetch_array($consulta)){ 
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
                            }
            break;
            }

