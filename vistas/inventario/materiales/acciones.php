<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        
        case 1:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM productos_var where codigo='$id'");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['codigo']; 
                 $p[1]=$fila['referencia'];
                 $p[2]=$fila['descripcion'];
                 $p[3]=$fila['tipo_articulo']; 
                 $p[4]=$fila['color'];
                 $p[5]=$fila['ancho'];
                 $p[6]=$fila['alto']; 
                 $p[7]=$fila['espesor']; 
                 $p[8]=$fila['area'];
                 $p[9]=$fila['peso'];
                 $p[10]=$fila['stock_max']; 
                 $p[11]=$fila['stock_min'];
                 $p[12]=$fila['stock_seg'];
                 $p[13]=$fila['costo_promedio'];
                 $p[14]=$fila['observaciones'];
                 $p[15]=$fila['clase'];
                $p[16]=$fila['grupo'];
        
            echo json_encode($p); 
            exit();
            break;
        case 2:
            $id = $_GET['cod'];
            $result = mysqli_query($con,"SELECT count(codigo) FROM productos_var where codigo='$id' ");
            $r = mysqli_fetch_array($result);
            if($r[0]==0){
            $sql=mysqli_query($con,"INSERT INTO `productos_var`(`codigo`, `descripcion`, `referencia`, `tipo_articulo`, `color`, `ancho`, `alto`, `espesor`, `area`, `peso`, `observaciones`,`estado_cr`,`usuario`, `cod_empresa`, `stock_max`, `stock_min`, `stock_seg`, `clase`, `grupo`, `aplicaiva`, `iva`, `costo_promedio`)"
                    . " VALUES ('".$_GET['cod']."','".$_GET['nom']."','".$_GET['ref']."','INVENTARIO','".$_GET['col']."','".$_GET['anc']."','".$_GET['alt']."','".$_GET['lar']."','0','0','Sincronizado de Fomplus','1','".$_GET['use']."','".$_GET['emp']."','0','0','0','".$_GET['cla']."','".$_GET['gru']."','".$_GET['iva']."','".$_GET['aiva']."','".$_GET['pre']."')");
	     echo  mysqli_error($con);
            }
        
            
            break;
        
            }

