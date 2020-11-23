<?php
include '../../../modelo/conexionv1.php';
session_start();
if(isset($_SESSION['k_username'])){
    date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha = date("Y-m-d").' '.$hora;
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
        $p[69] = $r[69];
        $p[70] = $r[70];
        
        if($r[71]==''){
            $p[71] = $r[71];
        }else{
           $p[71] = $r[71].', Anulado por:'.$r[69].' | fecha de anulacion:'.$r[70];
        }
        
//        if($r[64]==''){
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
                . "ped_municipio='$mun',ped_registrado='".$_SESSION['k_username']."' where id_cot='".$cot."'");
        echo $req = mysqli_error($con2);
        
        
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
            $p['Vendedor'] = $e['ped_vendedor'];
            $p['Ciudad'] = $e['ped_ciudad'];
            $p['Fecha'] = date("Y-m-d").'T00:00:00.000Z';
            $p['Bodega'] = $e['ped_alm'];
            $p['TipoCuenta'] = $e['ped_tipcta'];
            $p['CentroCosto'] = $e['ped_centro'];
            $p['Plazo'] = 30;
            $p['CodOperario'] = $_SESSION['k_username'];
            $p['Observaciones'] = $e['ped_obs'];
            $p['Direccion'] = $e['ubicacion'];
            $p['Total'] = $e['ped_total'];
            $p['NumeroPedidoVenta'] = $cot;
            $p['DocumentoFomplus'] = $e['pedido'];
            $tipo_pedido = $e['ped_tipcta'];
            if($e['ped_tipcta']=='21'){
                $p['Imprevisto'] = '10';
                $p['Administracion'] = '10';  
            }else{
                $p['Imprevisto'] = '0';
                $p['Administracion'] = '0'; 
            }
            $detalles = mysqli_query($con2,"select * from cotizacion_pedidos where id_cot='$cot' ");
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
                $d['ValorUnitario'] = number_format($f['valor_und'],0,'','');
                $d['PorcentajeIVA'] = $iva;
                $d['Clase'] = $f['clase'];
                $d['Grupo'] = $f['grupo'];
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
        mysqli_query($con2,"INSERT INTO `cotizacion_pedidos` (`id_detped`, `id_cot`, `referencia`, `grupo`, `clase`, `descripcion`, `unidad`, `medida`, `color`, `cantidad`, `valor_und`, `valor_total`, `observaciones`, `codigo`, `id_items`)"
                . " VALUES (NULL, '$cot', '$cod', '$gru', '$cla', '$des', '$und', '$med', '$col', '$can', '$vlr', '$tot', '$obs', '$ref', '$item')");
        
        break;
         case 9:
        $cod = $_GET['cot'];
        $dd = $_GET['d'];
 
        mysqli_query($con2,"update cotizacion set estado='Anulado', anulado_por='".$_SESSION['k_username']."',anulado_fecha='".date("Y-m-d H:i:s")."',porqueanulado='$dd' where id_cot='".$cod."'");
        mysqli_query($con2,"update cotizacion_pedidos set cantidad='0',valor_und='0' where id_cot='".$cod."'");
        echo 'Se ha anulado el pedido en Monty!... en FomPlus  debes de anularlo tambien.'.mysqli_error($con2);
        
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
        $detalles = mysqli_query($con2,"select * from cotizacion_pedidos where id_items='$item' ");
        $f = mysqli_fetch_array($detalles);
        
        mysqli_query($con2,"UPDATE `cotizacion_pedidos` SET `referencia` = '$cod', `grupo` = '$gru', `clase` = '$cla', `descripcion` = '$des', `unidad` = '$und', `medida` = '$med', `color` = '$col', `cantidad` = '$can', `valor_und` = '$vlr', `valor_total` = '$tot', `codigo` = '$cod' WHERE `cotizacion_pedidos`.`id_items` = '$item' ");
        echo 'Se edito con exito '.mysqli_error($con2);
        $me = '';
        if($f['medida']!=$med){
            $m = ' Se cambio la medida de '.$f['medida'].' a '.$med;
            $me .= $m;
        }
        if($f['color']!=$col){
            $m = ' Se cambio el color de '.$f['color'].' a '.$col;
            $me .= $m;
        }
        if($f['cantidad']!=$can){
            $m = ' Se cambio la cantidad de '.$f['cantidad'].' a '.$can;
            $me .= $m;
        }
        if($f['valor_und']!=$vlr){
            $m = ' Se cambio la valor_und de '.$f['valor_und'].' a '.$vlr;
            $me .= $m;
        }
        if($f['descripcion']!=$des){
            $m = ' Se cambio la descripcion de '.$f['descripcion'].' a '.$des;
            $me .= $m;
        }
        $mod = $cod.' '.$me;
         $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`, `registro`) ";
                  $sqlr.= "VALUES ('".$mod."', '".$f['id_cot']."', '".$_SESSION['k_username']."', 'Pedido','$fecha')";
                  mysqli_query($con2,$sqlr);
        
        break;
    case 11:
        $cod = $_GET['cot'];
        $obs = $_GET['obs'];
        $ven = $_GET['ven'];
        $detalles = mysqli_query($con2,"select * from cotizacion where id_cot='$cod' ");
        $f = mysqli_fetch_array($detalles);
 
        mysqli_query($con2,"update cotizacion set ped_obs='$obs',ped_vendedor='$ven' where id_cot='".$cod."'");
       $m='';
        if($f['ped_obs']!=$obs){
            $m = ' Se cambio la observacion de '.$f['ped_obs'].' a '.$obs;
            $me .= $m;
        }
        if($f['ped_vendedor']!=$ven){
            $m = ' Se cambio la ped_vendedor de '.$f['ped_vendedor'].' a '.$ven;
            $me .= $m;
        }
         $mod = $me;
        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`,`registro`) ";
                  $sqlr.= "VALUES ('$mod ', '".$cod."', '".$_SESSION['k_username']."', 'Pedido','$fecha')";
                  mysqli_query($con2,$sqlr);

        echo 'Se edito con exito el pedido'.mysqli_error($con2);
        
        break;
    case 12:

         $d = array();
         $d['PED_TIPPED'] = $_GET['PED_TIPPED'];
$d['PED_NUMPED'] = $_GET['PED_NUMPED'];
$d['PED_CIUDAD'] = $_GET['PED_CIUDAD'];
$d['PED_CEDULA'] = $_GET['PED_CEDULA'];
$d['PED_CEDCON'] = $_GET['PED_CEDCON'];
$d['PED_FECPED'] = $_GET['PED_FECPED'];
$d['PED_FECINI'] = $_GET['PED_FECINI'];
$d['PED_FECVEN'] = $_GET['PED_FECVEN'];
$d['PED_ORDCOM'] = $_GET['PED_ORDCOM'];
$d['PED_AGENTE'] = $_GET['PED_AGENTE'];
$d['PED_DESPP'] = $_GET['PED_DESPP'];
$d['PED_DESPF'] = $_GET['PED_DESPF'];
$d['PED_PLAZO'] = $_GET['PED_PLAZO'];
$d['PED_VENDED'] = $_GET['PED_VENDED'];
$d['PED_TIPCLI'] = $_GET['PED_TIPCLI'];
$d['PED_LISPRE'] = $_GET['PED_LISPRE'];
$d['PED_TIPCTA'] = $_GET['PED_TIPCTA'];
$d['PED_TIPNOT'] = $_GET['PED_TIPNOT'];
$d['PED_VALFLE'] = $_GET['PED_VALFLE'];
$d['PED_VALSEG'] = $_GET['PED_VALSEG'];
$d['PED_TASARM'] = $_GET['PED_TASARM'];
$d['PED_MONEDA'] = $_GET['PED_MONEDA'];
$d['PED_BODEGA'] = $_GET['PED_BODEGA'];
$d['PED_ALMCON'] = $_GET['PED_ALMCON'];
$d['PED_CODSEC'] = $_GET['PED_CODSEC'];
$d['PED_CODTRA'] = $_GET['PED_CODTRA'];
$d['PED_OBSERV'] = $_GET['PED_OBSERV'];
$d['PED_OBSADI'] = $_GET['PED_OBSADI'];
$d['PED_DIRENV'] = $_GET['PED_DIRENV'];
$d['PED_ESTREG'] = $_GET['PED_ESTREG'];
$d['PED_ACTIVO'] = $_GET['PED_ACTIVO'];
$d['PED_CIERRE'] = $_GET['PED_CIERRE'];
$d['PED_ESTADO'] = $_GET['PED_ESTADO'];
$d['PED_COPIAS'] = $_GET['PED_COPIAS'];
$d['PED_NOMEMP'] = $_GET['PED_NOMEMP'];
$d['PED_VERSIO'] = $_GET['PED_VERSIO'];
$d['PED_EQUIPO'] = $_GET['PED_EQUIPO'];
$d['PED_CODOPE'] = $_GET['PED_CODOPE'];
$d['PED_FECOPE'] = $_GET['PED_FECOPE'];
$d['PED_USUARIO'] = $_GET['PED_USUARIO'];
$d['PED_PROREG'] = $_GET['PED_PROREG'];
$d['PED_SECTOR'] = $_GET['PED_SECTOR'];
$d['PED_NUMREQ'] = $_GET['PED_NUMREQ'];
$d['PED_TIPREQ'] = $_GET['PED_TIPREQ'];
$d['PED_TIPOPE'] = $_GET['PED_TIPOPE'];
$d['PED_CEDREF'] = $_GET['PED_CEDREF'];
$d['PED_NUMEVE'] = $_GET['PED_NUMEVE'];
$d['PED_VALPED'] = $_GET['PED_VALPED'];
$d['PED_TIPINV'] = $_GET['PED_TIPINV'];
$d['PED_PREFIJ'] = $_GET['PED_PREFIJ'];
$d['PED_OBSINT'] = $_GET['PED_OBSINT'];
$d['PED_FECAUT'] = $_GET['PED_FECAUT'];
$d['PED_PORIMP'] = $_GET['PED_PORIMP'];
$d['PED_PORADM'] = $_GET['PED_PORADM'];
$d['PED_CODCLI'] = $_GET['PED_CODCLI'];
$d['PED_FECENT'] = $_GET['PED_FECENT'];
$d['PED_CONENT'] = $_GET['PED_CONENT'];
$d['PED_TIPANT'] = $_GET['PED_TIPANT'];
$d['PED_PREANT'] = $_GET['PED_PREANT'];
$d['PED_NUMANT'] = $_GET['PED_NUMANT'];
$d['PED_FECANT'] = $_GET['PED_FECANT'];
$d['PED_VALANT'] = $_GET['PED_VALANT'];
$d['PED_AUTCOS'] = $_GET['PED_AUTCOS'];
$d['PED_CONREQ'] = $_GET['PED_CONREQ'];
$d['PED_SOLANT'] = $_GET['PED_SOLANT'];
$d['PED_FECCOS'] = $_GET['PED_FECCOS'];
    $d['PED_USUCOS'] = $_GET['PED_USUCOS'];
$d['PED_USUSOL'] = $_GET['PED_USUSOL'];
$d['PED_FECSOL'] = $_GET['PED_FECSOL'];
$d['PED_NUMCON'] = $_GET['PED_NUMCON'];
$d['PED_CONPRO'] = $_GET['PED_CONPRO'];
$d['PED_FECORD'] = $_GET['PED_FECORD'];
$d['PED_CODICA'] = $_GET['PED_CODICA'];
echo json_encode($d);
        break;
    case 13:
        $item = $_GET['cot'];
        $detalles = mysqli_query($con2,"select * from modificaciones where id_cotizacion='$item' and modulo='Pedido' ");
        echo '<ul>';
        while($f = mysqli_fetch_array($detalles)){
            echo '<li>* '.$f['descripcion'].' por '.$f['por'].' el:'.$f['registro'].' </li>';
        }
        echo '<ul>';
       
        
        break;
    case 14:
        $item = $_GET['cot'];
        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`, `registro`) ";
                  $sqlr.= "VALUES ('Se edito el pedido a FOMPLUS ', '".$item."', '".$_SESSION['k_username']."', 'Pedido','$fecha')";
                  mysqli_query($con2,$sqlr);
        
        break;
}
}
//{Posicion: 0, Articulo: "PT-065", Referencia: "PT-065", Descripcion: "8MM INCOLORO VIDRIO TEMPLADO BPB S/PLANO ", UnidadMedida: "Und", …}