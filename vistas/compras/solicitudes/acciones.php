<?php
include '../../../modelo/conexioni.php';
include '../../../modelo/roles_user.php';
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['ord'];
            $result = mysqli_query($con,"select * from orden_compra where codigo='$id' ");
            $e = mysqli_fetch_array($result);
            $p = array();
            $p['Empresa'] = $e['cod-empresa'];
            $p['Proveedor'] = $e['cod_ter'];
            $p['Fecha'] = date("Y-m-d").'T00:00:00.000Z';
            $p['Bodega'] = $e['bod_codigo'];
            $p['TipoCuenta'] = $e['cod_cuenta'];
            $p['CentroCosto'] = $e['centro_costo'];
            $p['Plazo'] = 30;
            $p['CodOperario'] = $e['usuario'];
            $p['Observaciones'] = $e['observaciones_compra'];
            $p['Direccion'] = $e['sede_dir'];
            $p['Total'] = $e['total'];
            $p['CodIca'] = $e['codica'];
            $p['NumeroCompra'] = $id;
            $p['DocumentoFomplus'] = '';
            $detalles = mysqli_query($con,"select * from orden_compra_detalle where codigo_orden='$id' ");
            $t = array();
            while($f = mysqli_fetch_array($detalles)){
                $res = mysqli_query($con,"select grupo, clase from productos_var where codigo='".$f['codigo']."' ");
                $pro = mysqli_fetch_array($res);
                $res2 = mysqli_query($con,"select iva from solicitudes_item where solicitud='".$f['solicitud']."' ");
                $iv = mysqli_fetch_array($res2);
//                if($e['cod-empresa']=='true'){
//                    $iva = 19;
//                }else{
//                    $iva = 0;
//                }
                $iva = $e['PORIVA'];
                $d = array();
                $c++;
                $d['Posicion'] = $c;
                $d['Articulo'] = $f['codigo'];
                $d['Referencia'] = $pro['referencia'];
                $d['Descripcion'] = $f['descripcion'];
                $d['UnidadMedida'] = "Und";
                $d['Cantidad'] = $f['cantidad'];
                $d['ValorUnitario'] = $f['precio'];
                $d['PorcentajeIVA'] = $iva;
                $d['Clase'] = $pro['clase'];
                $d['Grupo'] = $pro['grupo'];
                $d['Color'] = $f['color'];
                $d['Medida'] = $f['medida'];
                $t[] = $d;
            }
            
            $p["Detalle"] = $t;
            echo json_encode($p);
           
            break;
            case 2:
                 $id=$_GET['ord'];
            $result = mysqli_query($con,"select * from orden_compra where codigo='$id' ");
            $e = mysqli_fetch_array($result);
 
            $p = array("Empresa" => $e['cod-empresa'],
                "Proveedor" => $e['cod_ter'],
                "TipoCuenta" => "01",
                "Plazo"=> 30,
                "NumeroCompra" => $id,
                "DocumentoFomplus" => "",
                "Detalle" => '['.array("Posicion"=>1,"Articulo"=>"22015","Descripcion"=>"alambre","UnidadMedida"=>"Und","Cantidad"=>10,"ValorUnitario"=>5000)).']';
            $json =  json_encode($p);
            print_r($json);
           
        
        break;
        case 3:
             $id=$_GET['cod'];
            $result = mysqli_query($con,"select * from tipo_cuentas where codigo='$id' ");
            $e = mysqli_fetch_array($result);
            echo $e[2];
            break;
        case 4:
            $id=$_GET['ord'];
            $fom=$_GET['fom'];
            $result = mysqli_query($con,"update orden_compra set ordenfom='$fom' where codigo='$id' ");
            echo mysqli_error($con);
            break;
         case 5:
            $id=$_GET['id'];
            $pre=$_GET['pre'];
            $result = mysqli_query($con,"update solicitudes_item set precio='$pre', fmod='".date("Y-m-d H:i:s")."', umod='".$usuario."' where solicitud='$id' ");
            mysqli_query($con,"update orden_compra_detalle set precio='$pre' where solicitud='$id' ");
            echo mysqli_error($con);
            if($result){
                echo 'Se edito con exito';
            }else{
                echo 'Error a editar';
            }
            break;
        case 6:
            $id=$_GET['id'];
            $ord=$_GET['ord'];
            $soli=$_GET['soli'];
            mysqli_query($con, "UPDATE orden_compra_detalle SET codigo_orden='".$ord."' WHERE id_oc_de='".$id."'");
            
            break;
        case 7:
             $id=$_GET['id'];
            $result = mysqli_query($con,"select ordenfom, cod_ter, b.codigo, a.fecha,b.precio from orden_compra a,orden_compra_detalle b where a.codigo=b.codigo_orden and b.codigo_orden!=0 and b.codigo ='$id'  order by a.fecha asc  ");
            echo '<ol>';
            $c=0;
            while($e = mysqli_fetch_array($result)){
                $c++;
                $result2 = mysqli_query($con,"select nom_ter from cont_terceros where cod_ter='".$e['cod_ter']."' ");
                 $t = mysqli_fetch_array($result2);
                 echo '<li> '.$e['cod_ter'].' '.$t['nom_ter'].' | <font color="red">'.$e['fecha'].'</font> a $'.$e['precio'];
                 
            }
            
            if($c==0){
                echo '<li>Sin historial de compra en monty ';
            }
            break;
        case 8:
             $id=$_GET['id'];
             $cx=$_GET['cx'];
             mysqli_query($con, "UPDATE solicitudes_item SET cantidad='".$cx."',cantidad_pen='".$cx."', fmod='".date("Y-m-d H:i:s")."', umod='".$_SESSION['k_username']."' WHERE solicitud='".$id."'");
             mysqli_query($con, "delete from orden_compra_detalle WHERE solicitud='".$id."'");
            break;
         case 9:
             $id=$_GET['id'];
             $cx=$_GET['c'];
             $can=$_GET['can'];
             $sol=$_GET['sol'];
             $cr = $can - $cx;
             mysqli_query($con,"insert into solicitudes_item (codigo,id_sol,descripcion,date_added,cantidad,cantidad_pen,color,medida,user_id,precio,undmed,observacion,iva) "
             . "select codigo,id_sol,descripcion,date_added,'$cx','$cx',color,medida,user_id,precio,undmed,observacion,iva from solicitudes_item where solicitud='$sol' ");
             echo mysqli_error($con);
             mysqli_query($con, "UPDATE solicitudes_item SET cantidad='".$cr."',fmod='".date("Y-m-d H:i:s")."', umod='".$_SESSION['k_username']."' WHERE solicitud='".$sol."'");
        
             break;
        case 10:
            $id=$_GET['sol'];
            $result = mysqli_query($con,"select * from solicitudes_item where solicitud='$id' ");
            $e = mysqli_fetch_array($result);
            $p = array();
            $p[0] = $e['codigo'];
            $p[1] = $e['descripcion'];
            $p[2] = $e['color'];
            $p[3] = $e['medida'];
            $p[4] = $e['cantidad'];
            $p[5] = $e['cantidad']-$e['cantidad_pen'];
            $p[6] = $e['precio'];
            echo json_encode($p);
            break;
        case 11:
            $id=$_GET['id'];
            $cod=$_GET['cod'];
            $des=$_GET['des'];
            $col=$_GET['col'];
            $med=$_GET['med'];
            $can=$_GET['can'];
            $apr=$_GET['apr'];
            $pre=$_GET['pre'];
            $result = mysqli_query($con,"select count(codigo) from orden_compra_detalle where solicitud='$id' ");
            $f = mysqli_fetch_array($result);
            if($f[0]>0){
                 mysqli_query($con, "UPDATE solicitudes_item SET "
                    . "codigo='".$cod."',"
                    . "descripcion='".$des."',"
                    . "color='".$col."',"
                    . "medida='".$med."',"
                    . "cantidad='".$can."',"
                    . "cantidad_pen='0',"
                    . "precio='".$pre."',"
                    . "fmod='".date("Y-m-d H:i:s")."',"
                    . " umod='".$_SESSION['k_username']."' WHERE solicitud='".$id."'");
                 
                mysqli_query($con, "UPDATE orden_compra_detalle SET "
                    . "codigo='".$cod."',"
                    . "descripcion='".$des."',"
                    . "color='".$col."',"
                    . "medida='".$med."',"
                    . "precio='".$pre."',"
                    . "cantidad='".$can."',"
                    . "cantidad_pend='".$can."',"
                    . "mod_fec='".date("Y-m-d H:i:s")."',"
                    . " mod_use='".$_SESSION['k_username']."' WHERE solicitud='".$id."'");
            }else{
                 mysqli_query($con, "UPDATE solicitudes_item SET "
                    . "codigo='".$cod."',"
                    . "descripcion='".$des."',"
                    . "color='".$col."',"
                    . "medida='".$med."',"
                    . "cantidad='".$can."',"
                    . "cantidad_pen='".$can."',"
                    . "precio='".$pre."',"
                    . "fmod='".date("Y-m-d H:i:s")."',"
                    . " umod='".$_SESSION['k_username']."' WHERE solicitud='".$id."'");
            }
            echo 'Se edito con exito el codigo';
            break;
            //calle 79 b 26c 191 venta de comida rapida.
             case 12:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from solicitudes_item where solicitud='$id' ");
               $result = mysqli_query($con,"select codigo_orden,id_oc_de from orden_compra_detalle where solicitud='$id' ");
               $f = mysqli_fetch_array($result);
                if($f[0]==0){
                    $ido = $f[1];
                    $query = mysqli_query($con,"delete from orden_compra_detalle where id_oc_de='$ido' ");
                    echo 'Se elimino con exito el items';
                }else{
                     echo 'Se elimino con exito el items de la solicitud, pero este items tiene una orden activa, eliminelo directamente desde el modulo de orden de compra ';
                }
            break;
            
            
}
