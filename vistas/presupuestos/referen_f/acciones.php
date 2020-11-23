<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $referen_pre=$_GET['referen_pre'];
            $desc_pre=$_GET['desc_pre'];
            $sist_pre=$_GET['sist_pre'];
            $pes_pre=$_GET['pes_pre'];
            $perime_pre=$_GET['perime_pre'];  
            $perit_pre=$_GET['perit_pre'];
            $costalum_pre=$_GET['costalum_pre'];
            $reff_usu=$_GET['reff_usu'];
            $reff_inst=$_GET['reff_inst'];
            
            $result = mysqli_query($con, "select count(pro_referencia) from productos where pro_referencia = '$referen_pre' ");
            $r = mysqli_fetch_row($result);
                if($r[0]==0){
                
                    $ver=mysqli_query($con, "insert into productos (`clase`,`grupo`,`linea`,`pro_referencia`,`pro_nombre`,`sistema`,`peso`,`perimetro`,`perimetro_t`,`costo_aluminio`,`usu`,`fec`)" 
                        . "values ('00','0','Aluminio','$referen_pre','$desc_pre','$sist_pre','$pes_pre','$perime_pre','$perit_pre','$costalum_pre','$reff_usu','$reff_inst')");
                    $msg = 'Se guardo con exito';
                    $error = mysqli_error($con);
                    
                    $dolar = mysqli_query($con, "SELECT id_dolar, precio_actual FROM `dolares` order by id_dolar desc limit 1");
                    $d = mysqli_fetch_row($dolar);
                    $ultimo = $d[0];
                    $precio_actual = $d[1];
                    $precio_fom = $precio_actual;
                    $precio = $precio_actual * $pes_pre;
                    $sql3 = "INSERT INTO `dolar_relaciones` (`id_dolar`, `id_referencia`, `precio_actual`, `precio_act_fom`, `cod_ref`)";
		    $sql3.= "VALUES ('".$ultimo."','" .$referen_pre."','".$precio."','".$precio_fom."','".$referen_pre."')";
		    mysqli_query($con,$sql3); 
                    //983332
                     mysqli_query($con, "update productos set  costo_aluminio='$precio' where pro_referencia = '$referen_pre' "); //aqui va el update
                   
                }else{
                    
                    $dolar = mysqli_query($con, "SELECT id_dolar, precio_actual FROM `dolares` order by id_dolar desc limit 1");
                    $d = mysqli_fetch_row($dolar);
                    $ultimo = $d[0];
                    $precio_actual = $d[1];
                    $precio_fom = $precio_actual;
                    $precio = $precio_actual * $pes_pre;
                
                    mysqli_query($con, "update productos set pro_nombre='$desc_pre', sistema='$sist_pre', peso='$pes_pre', perimetro='$perime_pre', perimetro_t='$perit_pre', costo_aluminio='$precio' where pro_referencia = '$referen_pre' "); //aqui va el update
                    $msg = 'Se edito con exito';$error = mysqli_error($con);
                    
                    mysqli_query($con, "update dolar_relaciones set precio_actual='$precio' where id_dolar='$ultimo' and cod_ref='$referen_pre' ");
                    
                    
                
                }
                echo $msg.', '.$error;
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM productos where pro_referencia ='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['pro_referencia'];
                 $p[1]=$fila['pro_nombre'];
                 $p[2]=$fila['sistema'];
                 $p[3]=$fila['peso'];
                 $p[4]=$fila['perimetro']; 
                 $p[5]=$fila['perimetro_t'];
                 $p[6]=$fila['costo_aluminio'];
        
               
            echo json_encode($p); 
            exit();
            break;
         
         case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM productos where pro_referencia='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);

                  $p = array(); 
                     $p[0]=$fila['pro_referencia'];
                     $p[1]=$fila['pro_nombre'];
                     $p[2]=$fila['sistema'];
                     $p[3]=$fila['peso'];
                     $p[4]=$fila['perimetro']; 
                     $p[5]=$fila['perimetro_t'];
                     $p[6]=$fila['costo_aluminio'];
            echo json_encode($p); 

            exit();
            break;
        
        case 5:
          
            $id=$_GET['id'];
            $query = mysqli_query($con,"delete from productos where pro_referencia='$id' ");
            
         break;
}