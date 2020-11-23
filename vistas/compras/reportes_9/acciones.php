<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $fac=$_GET['fac'];
            $frec=$_GET['frec'];
            $rec=$_GET['rec'];
            $obs=$_GET['obs'];
            $ped=$_GET['ped'];
            
            $query = mysqli_query($con,"SELECT codigo FROM orden_compra where ordenfom='$ped' ");
            $fila = mysqli_fetch_array($query);
            $codigo = $fila[0];
                 
            
                mysqli_query($con,"update orden_compra_detalle set factura_pedido='$fac', obs_pedido='$obs', fecha_recibida='$frec', cantidad_rec='$rec', user_recibido='".$_SESSION['k_username']."' where codigo_orden='$codigo' ");
                echo 'Se actualizo la compra 9999'. mysqli_error($con);
            
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM orden_compra_detalle where id_oc_de='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['factura_pedido']; 
                 $p[1]=$fila['obs_pedido'];
                 $p[2]=$fila['fecha_recibida'];
        
            echo json_encode($p); 
            exit();
            break;
//            case 3:
//               $id=$_GET['id'];
//               $query = mysqli_query($con,"delete from modelo where cod_modelo='$id' ");
//            break;
//        case 4:
//               $id=$_GET['cod'];
//                 $query = mysqli_query($con,"SELECT * FROM modelo where cod_modelo='$id'"); //consultA modificada por navabla
//                 $fila = mysqli_fetch_array($query);
//                 $p = array();
//                 $p[0]=$fila['cod_modelo']; 
//                 $p[1]=$fila['nom_modelo'];
//                 $p[2]=$fila['resu_modelo'];
//                 $p[3]=$fila['estado_mod'];
//        
//            echo json_encode($p); 
//            exit();
//            break;
            }

