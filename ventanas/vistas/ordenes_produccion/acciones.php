<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 2:
           
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM cotizacion a, orden_produccion b, cont_terceros c where a.id_cot= b.ref and a.id_tercero=c.id_ter and b.id_orden='$id' ");
            $fila = mysqli_fetch_array($query);
           
            $p = array();
            $p[0]=$fila['id_orden']; 
            $p[1]=$fila['íd_cot'];
            $p[2]=$fila['id_cliente'];
            $p[3]=$fila['ubicacion'];
            $p[4]=$fila['obra'];
            $p[5]=$fila['fecha_reg_c'];
            $p[6]=$fila['fecha_modificacion'];
            $p[7]=$fila['estado'];
            $p[8]=$fila['linea'];
            $p[9]=$fila['ciudad'];
            $p[10]=$fila['pais_ter'];
            $p[11]=$fila['municipio'];
           
            echo json_encode($p); 
            exit();
            break;
        
        case 3:
           
            $id=$_GET['id'];
         
            $query = mysqli_query($con,"delete from cont_terceros where id_ter='$id' ");
            
            break;
        
        case 4: 
             $id=$_GET['nombre'];
             $consulta = mysqli_query($con,"SELECT * FROM `departamentos` where nombre_dep='$id'");
                            while($f = mysqli_fetch_array($consulta)){
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
                            }
            
            break;
        
}

