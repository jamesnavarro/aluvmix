<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $puesto_c=$_GET['puesto_c'];
            $estado_c=$_GET['estado_c'];
            $operacion_c=$_GET['operacion_c'];
            $fecha_cuenta=$_GET['fecha_cuenta'];
            $doc_cli=$_GET['doc_cli'];
            $cli_nom=$_GET['cli_nom'];
           
           
            if($id==''){
                $estado='En proceso';
                $ver=mysqli_query($con, "insert into cuenta_cobro (`puesto`,`estado`,`operacion`,`por`,`cc_cliente`,`cliente_nombre`)"
                        . "values ('$puesto_c','$estado','$operacion_c','$usuario','$doc_cli','$cli_nom')");
                echo mysqli_error($con);
                $id = mysqli_insert_id($con);  
            }
            else{
                $estado='Guardado';
                mysqli_query($con,"update cuenta_cobro set puesto='$puesto_c', estado='$estado', operacion='$operacion_c', por='$usuario', fecha='$fecha_cuenta', cc_cliente='$doc_cli', cliente_nombre='$cli_nom' where id_cuenta='$id'");
                $estado='Guardado';
            }
            $p = array(); 
                     $p[0]=$id;
                     $p[1]=$usuario;
                     $p[2]=date('Y-m-d'); 
                     $p[3]=$estado;  
            echo json_encode($p); 
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM cuenta_cobro where id_cuenta='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                     $p = array(); 
                     $p[0]=$fila['id_cuenta'];
                     $p[1]=$fila['puesto'];
                     $p[2]=$fila['estado']; 
                     $p[3]=$fila['operacion'];
                     $p[4]=$fila['por'];
                     $p[5]=$fila['fecha'];
                     $p[6]=$fila['cc_cliente'];
                     $p[7]=$fila['cliente_nombre'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from cuenta_cobro where id_cuenta='$id' ");
            break;
        
            case 4:
                 $id=$_GET['cod'];
                $query = mysqli_query($con,"SELECT * FROM cuenta_cobro where id_cuenta='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                    $p = array(); 
                   $p[0]=$fila['id_cuenta'];
                   $p[1]=$fila['puesto'];
                   $p[2]=$fila['estado']; 
                   $p[3]=$fila['operacion'];
                   $p[4]=$fila['por'];
                   $p[5]=$fila['fecha'];
            echo json_encode($p); 
            exit();
            break;
           
           case 5:
                 $id_servicio=$_GET['id_servicio'];
                 $des_s=$_GET['des_s'];
                 $cant_s=$_GET['cant_s'];
                 $val_s=$_GET['val_s'];
                 $totl_s=$_GET['totl_s'];
                 $id_cta_c=$_GET['id_cta_c'];
                 $id_itm=$_GET['id_itm'];
                 $puesto=$_GET['puesto'];
                 $movimiento=$_GET['movimiento'];
            if($id_itm==''){
                  $ver=mysqli_query($con,"insert into cuenta_cobro_items(`id_cuenta`,`id_servicio`,`descripcion`,`cantidad`,`valor_unidad`,`valor_total`,`registrado`,`id_puestos`,`movimientos`)"
                  ."values ('$id_cta_c','$id_servicio','$des_s','$cant_s','$val_s','$totl_s','$usuario','$puesto','$movimiento')");
                  echo mysqli_error($con);
            }else{
                mysqli_query($con,"update cuenta_cobro_items set  cantidad='$cant_s', valor_unidad='$val_s', valor_total='$totl_s', registrado='$usuario', id_puestos='$puesto', movimientos='$movimiento' where id='$id_itm'");
                echo $id_itm;
            }
          
            break;
        
            case 6:
                $id=$_GET['id'];
                $query = mysqli_query($con,"delete from cuenta_cobro_items where id='$id' ");
            break;
        
        
        
            case 7:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM cuenta_cobro_items a, puestos_trabajos b where a.id=b.id_puesto and  id='$id' "); 
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_cuenta'];
                 $p[1]=$fila['id_servicio'];
                 $p[2]=$fila['descripcion']; 
                 $p[3]=$fila['cantidad'];
                 $p[4]=$fila['valor_unidad'];
                 $p[5]=$fila['valor_total'];
                 $p[6]=$fila['id_puestos'];
                 $p[7]=$fila['movimientos'];
            echo json_encode($p); 
            exit();
            break;
        
            case 8:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM cont_terceros where cod_ter='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['cod_ter'];
                 $p[1]=$fila['nom_ter'];
                 echo json_encode($p); 
            exit();
            break;  
}