<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $cod=$_GET['codcxp'];
            $nomcxp=$_GET['nomcxp'];
            $ctacxp=$_GET['ctacxp'];
            $retecxp=$_GET['retecxp'];
            $reteivacxp=$_GET['reteivacxp'];
            $reteicacxp=$_GET['reteicacxp'];
            $porcrete=$_GET['porcrete'];
            $poriva=$_GET['poriva'];
            $porica=$_GET['porica'];
            $basecxp=$_GET['basecxp'];           
            $result = mysqli_query($con,"select count(*) from intercxp where codigo='$cod' ");
            $f = mysqli_fetch_array($result);            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into intercxp (`codigo`,`nombre`,`cuenta`,`retfte`,`retiva`,`retica`,`porfte`,`poriva`,`porica`,`base`) "
                . "values ('$cod','$nomcxp','$ctacxp','$retecxp','$reteivacxp','$reteicacxp','$porcrete','$poriva','$porica','$basecxp')");
            echo mysqli_error($con);                
            }
            
            else{
                mysqli_query($con,"update intercxp set nombre='$nomcxp', cuenta='$ctacxp', retfte='$retecxp', retiva='$reteivacxp', retica='$reteicacxp', porfte='$porcrete', poriva='$poriva',  porica='$porica',  base='$basecxp' where codigo='$cod'");
                echo $id;
                echo mysqli_error($con);
            }
            
            break;
            case 2:
                 $ids=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM intercxp where codigo='$ids' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['codigo']; 
                 $p[1]=$fila['nombre'];
                 $p[2]=$fila['cuenta'];
                 $p[3]=$fila['retfte'];
                 $p[4]=$fila['retiva'];
                 $p[5]=$fila['retica'];
                 $p[6]=$fila['porfte'];
                 $p[7]=$fila['poriva'];
                 $p[8]=$fila['porica'];
                 $p[9]=$fila['base'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query =  ("delete from intercxp where codigo='$id' ");
            break;
            case 4:
            - $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM intercxp where codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['codigo']; 
                 $p[1]=$fila['nombre'];
                 $p[2]=$fila['cuenta'];
                 $p[3]=$fila['retfte'];
                 $p[4]=$fila['retiva'];
                 $p[5]=$fila['retica'];
                 $p[6]=$fila['porfte'];
                 $p[7]=$fila['poriva'];
                 $p[8]=$fila['porica'];
                 $p[9]=$fila['base'];
            echo json_encode($p); 
            exit();
            break;
       
            }

