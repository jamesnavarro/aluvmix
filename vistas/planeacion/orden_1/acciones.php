<?php
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){
    case 1:
        $id = $_GET['id'];
        mysqli_query($con,"update cotizacion set estado='En proceso' where id_cot='$id'");
        
        break;
    case 2:
        $id = $_GET['id'];
        $sql6 = "SELECT * FROM cotizacion where id_cot=".$id." ";
        $cot =mysqli_fetch_array(mysqli_query($con ,$sql6));
        $numero_cotizacion= $cot["numero_cotizacion"];
        
        $sql1 = "SELECT max(version) FROM cotizacion where numero_cotizacion=".$numero_cotizacion." ";
        $fila1 =mysqli_fetch_array(mysqli_query($con, $sql1));
        $version= $fila1["max(version)"]+1;
        echo $numero_cotizacion.'.'.$version;
        $sql = "INSERT INTO `cotizacion` (`sel_iva`,`cod_temp`,`nom_temp`,`fecha_reg_c`, `fecha_modificacion`, `grabado`,  `numero_cotizacion`, `copia`,`version`,`presupuesto`,`tipo`, `instalacion`,`precio`,`aiu`,`responsable`,`tel_responsable`,`ciudad`,`municipio`,`id_cliente`, `registrado`, `estado`, `obra`, `ubicacion`, `linea`, `costo_total`, `descuento`, `desc_general`, `costo_instalacion`, `comision`, `pago`, `nota`, `validez`, `id_tercero`)";
        $sql.= "VALUES ('19','".$cot['cod_temp']."','".$cot['nom_temp']."','".$fecha_hoy."','".$fecha_hoy."','".$_SESSION['k_username']."', '".$cot['numero_cotizacion']."', '".$numero_cotizacion."','".$version."','".$cot['presupuesto']."','".$cot['tipo']."','".$cot['instalacion']."','".$cot['precio']."','".$cot['aiu']."','".$cot['responsable']."','".$cot['tel_responsable']."','".$cot['ciudad']."','".$cot['municipio']."','".$cot['id_cliente']."', '".$cot['registrado']."', 'En proceso', '".$cot['obra']."', '".$cot['ubicacion']."', '".$cot['linea']."', '".$cot['costo_total']."', '".$cot['descuento']."', '".$cot['desc_general']."', '".$cot['costo_instalacion']."', '".$cot['comision']."', '".$cot['pago']."', '".$cot['nota']."', '".$cot['validez']."', '".$cot['id_tercero']."')";
        mysqli_query($con, $sql);
        $max = mysqli_insert_id($con);
        
        $request=mysqli_query($con, "SELECT * FROM cotizacion_item  where id_cot='$id' and id_cot_principal=0 ");
        while($row=mysqli_fetch_array($request)){
              //copia  del item pricipal
               mysqli_query($con,"INSERT INTO `cotizacion_item` (`id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`,`descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`)"
               . " VALUES ('".$max."','".$row['codigo']."','".$row['descripcion_principal']."','".$row['trazabilidad']."','".$row['descripcion_segunda']."','".$row['ancho']."', '".$row['alto']."','".$row['cantidad']."','".$row['laminas']."','".$row['perforacion']."','".$row['boquete']."','".$row['pelicula']."','".$row['carton']."','".$row['linea_cot']."', '".$row['id_cot_principal']."','".$row['ubicacion']."','".$row['observacion']."', '".$row['item']."','".$row['instalaccion']."','".$row['valor_item']."','".$row['descuento']."','".$row['iva']."','".$row['fecha_registro']."','".$row['usuario']."', '".$row['estado']."', '".$row['por_vid']."', '".$row['por_alu']."', '".$row['por_acc']."')");
               $idmax = mysqli_insert_id($con);
               
               //copia de los items secundario
               $idp = $row['id_cot_item'];
               $result2 = mysqli_query($con,"select * from cotizacion_item where id_cot_principal='$idp' ");
               while($f = mysqli_fetch_array($result2)){
               $sql3 = "INSERT INTO `cotizacion_item` (`id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`,`descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`)";
               $sql3.= "VALUES ('".$max."','".$f['codigo']."','".$f['descripcion_principal']."','".$f['trazabilidad']."','".$f['descripcion_segunda']."','".$f['ancho']."', '".$f['alto']."','".$f['cantidad']."','".$f['laminas']."','".$f['perforacion']."','".$f['boquete']."','".$row['pelicula']."','".$f['carton']."','".$f['linea_cot']."', '".$idmax."','".$f['ubicacion']."','".$f['observacion']."', '".$f['item']."','".$f['instalaccion']."','".$f['valor_item']."','".$f['descuento']."','".$f['iva']."','".$f['fecha_registro']."','".$f['usuario']."', '".$f['estado']."', '".$f['por_vid']."', '".$f['por_alu']."', '".$f['por_acc']."')";
               mysqli_query($con,$sql3);

               }
               //copia de los insumos extras
               $result3 = mysqli_query($con,"select * from cotizacion_insumos a, productos_var b where a.codigo=b.codigo and a.id_cot_item='$idp' ");
               $totalx = 0;
               while($r = mysqli_fetch_array($result3)){
               mysqli_query($con,"INSERT INTO `cotizacion_insumos` (`extra`,`id_cot`, `codigo`, `id_cot_item`, `cantidad`, `unidad`, `precio_unidad`, `medida`, `color`,`item`) "
               . "VALUES ('".$r['extra']."','".$max."', '".$r['codigo']."', '".$idmax."', '".$r['cantidad']."', '".$r['unidad']."', '".$r['precio_unidad']."', '".$r['medida']."', '".$r['color']."','".$r['item']."');");
               }
          }
        
        
 break;
        case 3:
        $id = $_GET['id'];
        $sql6 = "SELECT * FROM cotizacion where id_cot=".$id." ";
        $cot =mysqli_fetch_array(mysqli_query($con ,$sql6));
        $sql6 = "SELECT max(numero_cotizacion) FROM cotizacion";
        $fila6 =mysqli_fetch_array(mysqli_query($con,$sql6));
        $numero_cotizacion= $fila6["max(numero_cotizacion)"]+1;
        echo $numero_cotizacion.'.1';
        $sql = "INSERT INTO `cotizacion` (`sel_iva`,`cod_temp`,`nom_temp`,`fecha_reg_c`, `fecha_modificacion`, `grabado`,  `numero_cotizacion`, `copia`,`version`,`presupuesto`,`tipo`, `instalacion`,`precio`,`aiu`,`responsable`,`tel_responsable`,`ciudad`,`municipio`,`id_cliente`, `registrado`, `estado`, `obra`, `ubicacion`, `linea`, `costo_total`, `descuento`, `desc_general`, `costo_instalacion`, `comision`, `pago`, `nota`, `validez`, `id_tercero`)";
        $sql.= "VALUES ('19','".$cot['cod_temp']."','".$cot['nom_temp']."','".$fecha_hoy."','".$fecha_hoy."','".$_SESSION['k_username']."',  '".$numero_cotizacion."','".$cot['numero_cotizacion']."','1','".$cot['presupuesto']."','".$cot['tipo']."','".$cot['instalacion']."','".$cot['precio']."','".$cot['aiu']."','".$cot['responsable']."','".$cot['tel_responsable']."','".$cot['ciudad']."','".$cot['municipio']."','".$cot['id_cliente']."', '".$cot['registrado']."', 'En proceso', '".$cot['obra']."', '".$cot['ubicacion']."', '".$cot['linea']."', '".$cot['costo_total']."', '".$cot['descuento']."', '".$cot['desc_general']."', '".$cot['costo_instalacion']."', '".$cot['comision']."', '".$cot['pago']."', '".$cot['nota']."', '".$cot['validez']."', '".$cot['id_tercero']."')";
        mysqli_query($con, $sql);
        $max = mysqli_insert_id($con);
        
        $request=mysqli_query($con, "SELECT * FROM cotizacion_item  where id_cot='$id' and id_cot_principal=0 ");
          while($row=mysqli_fetch_array($request)){
              //copia  del item pricipal
                mysqli_query($con,"INSERT INTO `cotizacion_item` (`id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`,`descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`)"
                   . " VALUES ('".$max."','".$row['codigo']."','".$row['descripcion_principal']."','".$row['trazabilidad']."','".$row['descripcion_segunda']."','".$row['ancho']."', '".$row['alto']."','".$row['cantidad']."','".$row['laminas']."','".$row['perforacion']."','".$row['boquete']."','".$row['pelicula']."','".$row['carton']."','".$row['linea_cot']."', '".$row['id_cot_principal']."','".$row['ubicacion']."','".$row['observacion']."', '".$row['item']."','".$row['instalaccion']."','".$row['valor_item']."','".$row['descuento']."','".$row['iva']."','".$row['fecha_registro']."','".$row['usuario']."', '".$row['estado']."', '".$row['por_vid']."', '".$row['por_alu']."', '".$row['por_acc']."')");
               $idmax = mysqli_insert_id($con);
               
               //copia de los items secundario
               $idp = $row['id_cot_item'];
               $result2 = mysqli_query($con,"select * from cotizacion_item where id_cot_principal='$idp' ");
               while($f = mysqli_fetch_array($result2)){
                   $sql3 = "INSERT INTO `cotizacion_item` (`id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`,`descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`)";
                   $sql3.= "VALUES ('".$max."','".$f['codigo']."','".$f['descripcion_principal']."','".$f['trazabilidad']."','".$f['descripcion_segunda']."','".$f['ancho']."', '".$f['alto']."','".$f['cantidad']."','".$f['laminas']."','".$f['perforacion']."','".$f['boquete']."','".$row['pelicula']."','".$f['carton']."','".$f['linea_cot']."', '".$idmax."','".$f['ubicacion']."','".$f['observacion']."', '".$f['item']."','".$f['instalaccion']."','".$f['valor_item']."','".$f['descuento']."','".$f['iva']."','".$f['fecha_registro']."','".$f['usuario']."', '".$f['estado']."', '".$f['por_vid']."', '".$f['por_alu']."', '".$f['por_acc']."')";
                   mysqli_query($con,$sql3);

               }
               //copia de los insumos extras
               $result3 = mysqli_query($con,"select * from cotizacion_insumos a, productos_var b where a.codigo=b.codigo and a.id_cot_item='$idp' ");
               $totalx = 0;
               while($r = mysqli_fetch_array($result3)){
                   mysqli_query($con,"INSERT INTO `cotizacion_insumos` (`extra`,`id_cot`, `codigo`, `id_cot_item`, `cantidad`, `unidad`, `precio_unidad`, `medida`, `color`,`item`) "
                            . "VALUES ('".$r['extra']."','".$max."', '".$r['codigo']."', '".$idmax."', '".$r['cantidad']."', '".$r['unidad']."', '".$r['precio_unidad']."', '".$r['medida']."', '".$r['color']."','".$r['item']."');");
               }
              
          }
        
        break; 
        case 4:
                  $id=$_GET['cod'];
                 $col=$_GET['col'];
                 $query = mysqli_query($con,"SELECT * FROM productos_var where codigo='$id'");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['codigo']; 
                 $p[1]=$fila['referencia'];
                 $p[2]=$fila['descripcion'];
                 echo json_encode($p); 
               exit();
            break;
         case 5:
                  
            break;
}
}
