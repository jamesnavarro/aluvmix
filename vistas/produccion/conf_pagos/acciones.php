<?php
include('../../../modelo/conexionv1.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idconf'];
            $descr=$_GET['descri'];
            $codg=$_GET['codi'];
            $pagoc=$_GET['pago'];
            if($id==''){
                $ver=mysqli_query($con2,"insert into pagos (`desc_pago`,`observacion`,`tipo`) values ('$descr','$codg','$pagoc')");
                
                $query = mysqli_query($con2,"select max(id_pago) from pagos");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_pago)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con2,"update pagos set desc_pago='$descr', observacion='$codg', tipo='$pagoc' where id_pago='$id'");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con2,"SELECT * FROM pagos where id_pago='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_pago']; 
                 $p[1]=$fila['desc_pago'];
                 $p[2]=$fila['observacion'];
                 $p[3]=$fila['tipo'];
               
                  
            echo json_encode($p); 
            exit();     
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con2,"delete from pagos where id_pago='$id' ");
            break;
        
        
        
        
        
        
        
        
        
        
        
        
         case 4:
            $idg=$_GET['idnum'];
            $idu=$_GET['nomusu'];
            
            $query = mysqli_query($con2,"SELECT count(*) FROM grupo_det where id_g='$idg' and id_user='$idu' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 
                 if ($fila['count(*)']==0){
          
             $sql = "INSERT INTO `grupo_det` (`id_g`, `id_user`, `ingresado_por`, `fecha_ingreso`)";
             $sql.= "VALUES ('".$idg."', '".$idu."', '".$_SESSION['k_username']."', '".date("Y-m-d")."')";
             mysqli_query($con2,$sql, $conexion);
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
                }else{
                    $est = 0;
                }
               echo $ver =  mysqli_query($con2,"update grupo_det set est='$est' where id_gd='$idg'");
            break;
        
          case 6:
               $idu=$_GET['idnum'];
               $query = mysqli_query($con2,"delete from grupo_det where id_gd='$idu' ");
            break;
        
            }

