<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
   
        case 1:
            $id=$_GET['id'];
            $cod=$_GET['codcod'];
            $nom=$_GET['bodnomb'];
            $fiscall=$_GET['fiscal'];
            $niif=$_GET['contniif'];
            $natu=$_GET['codnatu'];
            $trm=$_GET['codtrm'];
            $contri=$_GET['codtribu'];
            $presu=$_GET['codpre'];
           
            if($id==''){
                $ver=mysqli_query($con,"insert into cont_codigos_contables (`cod_cod_cont`,`nom_cod_cont`,`desc_fiscal`,`desc_niif`,`naturaleza`,`tipo_trm`,`cod_tri_cod_cont`,`codigo_presupesto`) "
                                . "values ('$cod','$nom','$fiscall','$niif','$natu','$trm','$contri','$presu')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_cod_cont) from cont_codigos_contables");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_cod_cont)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update cont_codigos_contables set cod_cod_cont='$cod', nom_cod_cont='$nom', desc_fiscal='$fiscall', desc_niif='$niif', naturaleza='$natu', tipo_trm='$trm', cod_tri_cod_cont='$contri', codigo_presupesto='$presu' where id_cod_cont='$id' ");
                echo $id;
            }
            break;
        
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM cont_codigos_contables where id_cod_cont='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p = array();
                 $p[0]=$fila['id_cod_cont']; 
                 $p[1]=$fila['cod_cod_cont'];
                 $p[2]=$fila['nom_cod_cont'];
                 $p[3]=$fila['desc_fiscal'];
                 $p[4]=$fila['desc_niif'];
                 $p[5]=$fila['naturaleza'];
                 $p[6]=$fila['tipo_trm'];
                 $p[7]=$fila['cod_tri_cod_cont'];
                 $p[8]=$fila['codigo_presupesto'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query =  ("delete from cont_codigos_contables where id_cod_cont='$id' ");
            break;
        case 4:
                 $ids=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM cont_codigos_contables where cod_cod_cont='$ids' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_cod_cont']; 
                 $p[1]=$fila['cod_cod_cont'];
                 $p[2]=$fila['nom_cod_cont'];
                 $p[3]=$fila['desc_fiscal'];
                 $p[4]=$fila['desc_niif'];
                 $p[5]=$fila['naturaleza'];
                 $p[6]=$fila['tipo_trm'];
                 $p[7]=$fila['cod_tri_cod_cont'];
                 $p[8]=$fila['codigo_presupesto'];
            echo json_encode($p); 
            exit();
            break;
            }

