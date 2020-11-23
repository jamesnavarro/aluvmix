<?php
include '../../../modelo/conexionv1.php';
session_start();
if(isset($_SESSION['k_username'])){
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){
    case 1:

        $id = $_GET['id'];
        $sql6 = "SELECT * FROM cotizacion where id_cot=".$id." ";
        $r =mysqli_fetch_array(mysqli_query($con2 ,$sql6));
        $p = array();
        $p[0] = $r[0];
        $p[1] = $r[1];
        $p[2] = $r[2];
        $p[3] = $r[3];
        $p[4] = $r[4];
        $p[5] = $r[5];
        $p[6] = $r[6];
        $p[7] = $r[7];
        $p[8] = $r[8];
        $p[9] = $r[9];
        $p[10] = $r[10];
        $p[11] = $r[11];
        $p[12] = $r[12];
        $p[13] = $r[13];
        $p[14] = $r[14];
        $p[15] = $r[15];
        $p[16] = $r[16];
        $p[17] = $r[17];
        $p[18] = $r[18];
        $p[19] = $r[19];
        $p[20] = $r[20];
        $p[21] = $r[21];
        $p[22] = $r[22];
        $p[23] = $r[23];
        $p[24] = $r[24];
        $p[25] = $r[25];
        $p[26] = $r[26];
        $p[27] = $r[27];
        $p[28] = $r[28];
        $p[29] = $r[29];
        $p[30] = $r[30];
        $p[31] = $r[31];
        $p[32] = $r[32];
        $p[33] = $r[33];
        $p[34] = $r[34];
        $p[35] = $r[35];
        $p[36] = $r[36];
        $p[37] = $r[37];
        $p[38] = $r[38];
        $p[39] = $r[39];
        $p[40] = $r[40];
        $p[41] = $r[41];
        $p[42] = $r[42];
        $p[43] = $r[43];
        $p[44] = $r[44];
        $p[45] = $r[45];
        $p[46] = $r[46];
        $p[47] = $r[47];
        $p[48] = $r[48];
        $p[49] = $r[49];
        $p[50] = $r[50];
        $p[51] = $r[51];
        $p[52] = $r[52];
        $p[53] = $r[53];
        $p[54] = $r[54];
        $p[55] = $r[55];
        $p[56] = $r[56];
        $p[57] = $r[57];
        $p[58] = $r[58];
        $p[59] = $r[59];
        $p[60] = $r[60];
        $p[61] = $r[61];
        $p[62] = $r[62];
        $p[63] = $r[63];
        $p[64] = $r[64];
        $p[65] = $r[65];
        $p[66] = $r[66];
        $p[67] = $r[67];
        $p[68] = $r[68];
        if($r[8]!='Vidrio'){

                $sql7 = "SELECT count(id_cot) FROM desgloses_material where id_cot=".$id." ";
                $de =mysqli_fetch_array(mysqli_query($con2 ,$sql7));
                
                $sql8 = "SELECT count(id_cot) FROM desgloses_vidrios where id_cot=".$id." ";
                $dv =mysqli_fetch_array(mysqli_query($con2 ,$sql8));
                $dtt = $de[0] + $dv[0];
                if($dtt==0){
                    $p[69] = '<font color="red"> <img src="../../../imagenes/ledrojo.gif">Sin revisar desglose</font>';
                    $p[70] = '<font color="red"> <img src="../../../imagenes/ledrojo.gif">Sin revisar desglose</font>';
                    $p[71] = '0';
                }else{
                    $p[69] = '<img src="../../images/verficar.png" style="height: 32px">1. Aprobar '.$r[8];
                     $p[70] = '<font color="green"> Lista de Materiales Revisado</font>';
                     $p[71] = '1';
                }

        }else{
             $p[69] = '<img src="../../images/verficar.png" style="height: 32px">1. Aprobar '.$r[8];
             $p[70] = '';
             $p[71] = '1';
        }
//        if($r[64]==''){ 800248761-4
//            $query = mysqli_query($con2,"SELECT cod_ter FROM cont_terceros where id_ter='".$r[33]."' "); //consultA modificada por navabla
//            $fila = mysqli_fetch_array($query);
//            $p[64] = $fila[0];
//        }else{
//            $p[64] = $r[64];
//        }
        
        echo json_encode($p);
   
        
        
        break;
    case 2:
         $id=$_GET['cod'];
                 $query = mysqli_query($con2,"SELECT * FROM cont_terceros where id_ter='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_ter'];
                 $p[1]=$fila['digiver_ter'];
                 $p[2]=$fila['nom_ter'];
                 $p[3]=$fila['doc_ter'];
                 $p[4]=$fila['dir_ter'];
                 $p[5]=$fila['telfijo_ter'];
                 $p[6]=$fila['telmovil_ter'];
                 $p[7]=$fila['municipio_ter'];
                 $p[8]=$fila['ciudad_ter'];
                 $p[9]=$fila['pais_ter'];
                 $p[10]=$fila['fecnac_ter'];
                 $p[11]=$fila['correo_ter'];
                 $p[12]=$fila['cont_ter'];
                 $p[13]=$fila['pal'];
                 $p[14]=$fila['pvi'];
                 $p[15]=$fila['pac'];
                 $p[16]=$fila['estado_ter'];
                 $p[17]=$fila['especial'];
                 $p[18]=$fila['fuente'];
                 $p[19]=$fila['ica'];
                 $p[20]=$fila['iva'];
                 $p[21]=$fila['cree'];
                 $p[22]=$fila['vendedor']; 
                 $p[23]=$fila['tipo_ter'];
                 $p[24]=$fila['nom_ter'].' '.date("Y/m/d H:i");
            echo json_encode($p); 
        
        break;
  
    case 3:
       $id=$_GET['id'];
                 $query = mysqli_query($con2,"SELECT * FROM usuarios where usuario='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_user'];
                 $p[1]=$fila['usuario'];
                 $p[2]=$fila['cod_barra'];
                 $p[3]='';
                 $p[4]=$fila['cedula'];
                 $p[5]=$fila['email'];
                 $p[6]=$fila['administrador'];
                 $p[7]=$fila['nombre'];
                 $p[8]=$fila['apellido'];
                 $p[9]=$fila['estado'];
                 $p[10]=$fila['cargo'];
                 $p[11]=$fila['area'];
                 $p[12]=$fila['telefono'];
                 $p[13]=$fila['celular'];
                 $p[14]=$fila['direccion'];
                 $p[15]=$fila['pais'];
                 $p[16]=$fila['ciudad'];
                 $p[17]=$fila['municipio'];
                 $p[18]=$fila['sede'];
                 $p[19]=$fila['id_roles'];
                 $p[20]=$fila['id_empresa'];
                 $p[21]=$fila['sangre'];
                 $p[22]=$fila['ruta'];
                 $p[23]=$fila['userfom'];
         echo json_encode($p); 
        break;
    case 4:
        $cod = $_GET['id'];
        $request=mysqli_query($con2,"SELECT * FROM intercxc where ID='".$cod."'");
        $req = mysqli_fetch_array($request);
        $p = array(); 
                 $p[0]=$req['ID'];
                 $p[1]=$req['INT_NOMBRE'];
                   echo json_encode($p);
        
        break;
     case 5:
        $cod = $_GET['cod'];
        $pt = $_GET['pt'];
        $gru = $_GET['gru'];
        $cla = $_GET['cla'];
        $ref = $_GET['ref'];
        //$request=mysqli_query($con2,"update producto set ptfom='$pt',grupo='$gru',clase='$cla',refpro='$ref' where codigo='".$cod."'");
        
        
        break;
     case 6:
        $cot = $_GET['cot'];
        $ciu = $_GET['ciu'];
        $ter = $_GET['ter'];
        $cue = $_GET['cue'];
        $alm = $_GET['alm'];
        $tra = $_GET['tra'];
        $suc = $_GET['suc'];
        $ven = $_GET['ven'];
        $obs = $_GET['obs'];
        $cen = $_GET['cen'];
        $dire = $_GET['direccion'];
        $mun = $_GET['ciudad'];
        $cre = $_GET['cre'];
        $total = str_replace ( ".", "", $_GET['total']);
        $tp = $_GET['tp'];
        $query = mysqli_query($con2,"SELECT max(orden) FROM `cotizacion` WHERE estado='Aprobado' "); 
        $fila = mysqli_fetch_array($query);
        $orden = $fila[0]+1;
        $iduser=$_SESSION['id_user'];         
        
        $request=mysqli_query($con2,"update cotizacion set"
                . " estado='Aprobado',"
                . "orden='$orden',"
                . " aprobado_por='$iduser',"
                . " ped_fechapedido='$fecha', fecha_guardado='$fecha', "
                . " ped_ciudad='$ciu',"
                . "ped_tipcta='$cue',"
                . "ped_alm='$alm',"
                . "ped_centro='$cen',"
                . "ped_trasp='$tra',"
                . "ped_sucursal='$suc',"
                . "ped_vendedor='$ven',"
                . "ped_obs='$obs',"
                . "cod_temp='$ter',tipopedido='$tp',"
                . "ped_total='$total',"
                . "ped_cedula='$ter',"
                . "ped_direccion='$dire',"
                . "ped_municipio='$mun',ped_registrado='".$_SESSION['k_username']."',plazo='$cre' where id_cot='".$cot."'");
        echo $req = mysqli_error($con2);
        //7437  68075
        
        break;
    case 7:
            $cot=$_GET['cot'];
            $result = mysqli_query($con2,"select * from cotizacion where id_cot='$cot' ");
            $e = mysqli_fetch_array($result);
            $p = array();
            $p['TipoPedido'] = $e['tipopedido'];
            $p['Empresa'] = 'TEMPLADOS';
            $p['Cliente'] = $e['cod_temp'];
            $p['Sucursal'] = $e['ped_sucursal'];
            $p['Ciudad'] = $e['ped_ciudad'];
            $p['Vendedor'] = $e['ped_vendedor'];
            $p['Fecha'] = date("Y-m-d").'T00:00:00.000Z';
            $p['Bodega'] = $e['ped_alm'];
            $p['TipoCuenta'] = $e['ped_tipcta'];
            $p['CentroCosto'] = $e['ped_centro'];
            $p['Plazo'] = $e['plazo'];
            $p['CodOperario'] = $_SESSION['k_username'];
            $p['Observaciones'] = $e['ped_obs'];
            $p['Direccion'] = $e['ubicacion'];
            $p['Total'] = $e['ped_total'];
            $p['NumeroPedidoVenta'] = $cot;
            $p['DocumentoFomplus'] = '';
            $tipo_pedido = $e['ped_tipcta'];
            if($e['ped_tipcta']=='21'){
                $p['Imprevisto'] = '10';
                $p['Administracion'] = '10'; 
                // $p['Poraiu'] = '5';
            }else{
                $p['Imprevisto'] = '0';
                $p['Administracion'] = '0'; 
            }
            $detalles = mysqli_query($con2,"select * from cotizacion_pedidos where id_cot='$cot'  order by id_items asc ");
            $t = array();
            $c=0;
            while($f = mysqli_fetch_array($detalles)){
                if($tipo_pedido=='21'){
                    $iva = 0;
                    $poraiu = 5;
                }else{
                     $iva = 19;
                     $poraiu = 0;
                }
               
                $d = array();
                
                $d['Posicion'] = $c;
                $d['Articulo'] = $f['referencia'];
                $d['Referencia'] = $f['codigo'];
                $d['Descripcion'] = preg_replace('/( ){2,}/u',' ',$f['descripcion']);
                $d['UnidadMedida'] = $f['unidad'];
                $d['Cantidad'] = $f['cantidad'];
                $d['ValorUnitario'] = $f['valor_und'];
                $d['PorcentajeIVA'] = $iva;
                $d['Grupo'] = $f['grupo'];
                $d['Clase'] = $f['clase'];
                $d['Color'] = $f['color'];
                $d['Medida'] = $f['medida'];
                $d['Poraiu'] = $poraiu;
                $t[] = $d;
                $c++;
            }
            
            $p["Detalle"] = $t;
            echo json_encode($p);
           
            break;
    case 8:
        $cot = $_GET['cot'];
        $cod = $_GET['cod'];
        $cla = $_GET['cla'];
        $gru = $_GET['gru'];
        $ref = $_GET['ref'];
        $des = $_GET['des'];
        $und = $_GET['und'];
        $med = $_GET['med'];
        $col = $_GET['col'];
        $can = $_GET['can'];
        $vlr =  $_GET['vlr'];
        $tot =  $_GET['tot'];
        $obs = $_GET['obs'];
        $item = $_GET['item'];
        $query = mysqli_query($con2,"select count(id_detped) from cotizacion_pedidos where id_cot='$cot' and codigo='$cod' and medida='$med' ");
        $c =  mysqli_fetch_array($query);
        if($c[0]==0){
              mysqli_query($con2,"INSERT INTO `cotizacion_pedidos` (`id_detped`, `id_cot`, `referencia`, `grupo`, `clase`, `descripcion`, `unidad`, `medida`, `color`, `cantidad`, `valor_und`, `valor_total`, `observaciones`, `codigo`, `id_items`)"
                . " VALUES (NULL, '$cot', '$cod', '$gru', '$cla', '$des', '$und', '$med', '$col', '$can', '$vlr', '$tot', '$obs', '$ref', '$item')");
        }else{
             mysqli_query($con2,"update cotizacion_pedidos set cantidad=cantidad+'$can' where id_cot='$cot' and codigo='$ref' and medida='$med'   ");
        }
        break;
         case 9:
        $cod = $_GET['ord'];
        $fom = $_GET['fom'];
 
        mysqli_query($con2,"update cotizacion set pedido='$fom' where id_cot='".$cod."'");
        echo mysqli_error($con2);
        
        break;
    case 10:
       
        $cod = $_GET['cod'];
        $cla = $_GET['cla'];
        $gru = $_GET['gru'];
        $ref = $_GET['ref'];
        $des = $_GET['des'];
        $und = $_GET['und'];
        $med = $_GET['med'];
        $col = $_GET['col'];
        $can = $_GET['can'];
        $vlr =  $_GET['vlr'];
        $tot =  $_GET['tot'];
        $obs = $_GET['obs'];
        $item = $_GET['item'];
        mysqli_query($con2,"UPDATE `cotizacion_pedidos` SET `referencia` = '$cod', `grupo` = '$gru', `clase` = '$cla', `descripcion` = '$des', `unidad` = '$und', `medida` = '$med', `color` = '$col', `cantidad` = '$can', `valor_und` = '$vlr', `valor_total` = '$tot', `codigo` = '$cod' WHERE `cotizacion_pedidos`.`id_items` = '$item' ");
        echo 'Se edito con exito '.mysqli_error($con2);
        break;
    case 11:
        
         $cod = $_GET['cod'];
        $ciu = substr($cod, -3);
        $dep = substr($cod,0, -3);
        $request=mysqli_query($con2,"SELECT * FROM departamentos where cod_dep='".$dep."' and cod_mun='$ciu' ");
        $req = mysqli_fetch_array($request);
    
        //echo $p[0]=$req['ID'];
        echo $req[4];
           
        
        break;
    case 12:
        $cod = $_GET['cod'];
        $nom = $_GET['nom'];
        $cuenta = $_GET['cuenta'];
        $dire = $_GET['dire'];
        $zona = $_GET['zona'];
        
        
        break;
}
}
