<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idll'];
            $valorl=$_GET['valdoll'];
            $precl=$_GET['precdoll'];
            $varil=$_GET['varipril'];
            $preacl=$_GET['preactl'];
            $precio_actual=$_GET['preactl'];
            $fecl=$_GET['fechactul'];
            if($id==''){
                
                $consultar = mysqli_fetch_array(mysqli_query($con, "SELECT precio_dolar FROM dolares ORDER BY id_dolar DESC LIMIT 1"));
	        $pd = $consultar['precio_dolar'];
        
                $ver=mysqli_query($con,"insert into dolares (`lma`,`precio_dolar`,`prima`,`precio_actual`,`fecha_reg_dolar`,`ingresado_por`) "
                        . "values ('$valorl','$precl','$varil','$preacl','$fecl','".$_SESSION['k_username']."')") ;
                
                $ultimo = mysqli_insert_id($con);
                echo $ultimo;
                
                $result = mysqli_query($con, "SELECT * FROM `productos` ");
                $c = 0;
                while ($row = mysqli_fetch_array($result)) {
		$c += 1;
		$por = $row['peso'];
                $precio_fom = $precio_actual;
                $precio = $precio_actual * $por;
                $sql3 = "INSERT INTO `dolar_relaciones` (`id_dolar`, `id_referencia`, `precio_actual`, `precio_act_fom`, `cod_ref`)";
		$sql3.= "VALUES ('" . $ultimo . "','" . $row['pro_referencia'] . "','" . $precio . "','" . $precio_fom . "','" . $row['pro_referencia']."')";
		mysqli_query($con,$sql3);
                
                if ($pd != '') {
			$sql4 = "UPDATE `productos_var` SET `costo_calculado` = '" . $precio . "' WHERE `referencia` = '" . $row['pro_referencia'] . "'";
			mysqli_query($con,$sql4);
                        
                        $sql4 = "UPDATE `productos` SET `costo_aluminio` = '" . $precio . "' WHERE `pro_referencia` = '" . $row['pro_referencia'] . "'";
			mysqli_query($con,$sql4);
		}
                    
                }
            }
            else{
                mysqli_query($con,"update dolares set lma='$valorl', precio_dolar='$precl', prima='$varil', precio_actual='$preacl', fecha_reg_dolar='$fecl'  where id_dolar='$id'");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM dolares where id_dolar='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_dolar']; 
                 $p[1]=$fila['lma'];
                 $p[2]=$fila['precio_dolar'];
                 $p[3]=$fila['prima'];
                 $p[4]=$fila['precio_actual'];
                 $p[5]=$fila['fecha_reg_dolar'];
                  
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query("delete from dolares where id_dolar='$id' ");
            break;
            }

