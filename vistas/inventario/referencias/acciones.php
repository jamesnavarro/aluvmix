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
                $p[17]=$fila['aplicaiva'];
                $p[18]=$fila['iva'];
                $p[19]=$fila['unidad'];
        
            echo json_encode($p); 
            exit();
            break;
            }

