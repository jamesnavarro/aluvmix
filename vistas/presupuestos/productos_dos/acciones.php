<?php
include('../../../modelo/conexioni.php');
//include('../../../modelo/conexion_fom.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $idp=$_GET['idp'];
            $codigo=trim($_GET['codigo']);
            $referencia=$_GET['referencia'];
            $ancho=$_GET['ancho'];
            $archi=$_GET['archi'];
            $tipos=$_GET['tipos'];
            $alrejilla=$_GET['alrejilla'];
            $refer=$_GET['refer'];
            $confi=$_GET['confi'];
            $hojas=$_GET['hojas'];
            $cant=$_GET['cant'];
            $tipvid=$_GET['tipvid'];
            $espsorvi=$_GET['espsorvi'];
            $tipriel=$_GET['tipriel'];
            $tipreji=$_GET['tipreji'];
            $tiprod=$_GET['tiprod'];
            $tipbra=$_GET['tipbra'];
            $tipbis=$_GET['tipbis'];
            $anmax=$_GET['anmax'];
            $almax=$_GET['almax'];
            $tipcie=$_GET['tipcie'];
            $cuerf=$_GET['cuerf'];
            $alto= $_GET['alto'];
            $descrip= $_GET['descripcion'];
            $linea= trim($_GET['linea']);
            $alfa= $_GET['alfa'];
            
            $per= $_GET['per'];
            $boq= $_GET['boq'];
            $lam= $_GET['lam'];
            $siste= $_GET['siste'];
            $esp= $_GET['esp'];
            $inter= $_GET['inter'];
            $ancfd= $_GET['ancfd'];
            $ancfi= $_GET['ancfi'];
            $alcfs= $_GET['alcfs'];
            $alcfi= $_GET['alcfi'];
            $obs= $_GET['obs'];
            $can_cie = $_GET['can_cie'];
            $can_rod = $_GET['can_rod'];
            $can_bra = $_GET['can_bra'];
            $kitc ='';
            $alvenc = $alto - $alrejilla;
            if($idp==''){
                //.
                $RES = mysqli_query($con,"select count(*) from productos where pro_referencia='$codigo' ");
                $f = mysqli_fetch_row($RES);
                if($f[0]==0){     
//                $re = mysqli_query($con, "insert into productos_var (codigo,descripcion,referencia,tipo_articulo,color,ancho,alto,espesor,usuario,cod_empresa)"
//                                       . "values ('$codigo','$descrip','$referencia','INVENTARIO','N/A','$ancho','$alto','0','$usuario','$empresa')");
                     $re = mysqli_query($con, "insert into productos (pro_referencia,pro_nombre,pro_undmed,clase,grupo,linea,usuario,cod_empresa,sistema,tipo_ref)"
                                       . "values ('$codigo','$descrip','und','00','0','$linea','$usuario','$empresa','$siste','PT')"); 
                     mysqli_error($con);
                }
                mysqli_query($con, "insert into producto (`can_cierres`,`can_rodajas`,`can_brazos`,`observaciones_pro`,`tipo_bis`,`tipo_bra`,`tipo_rod`,`anchocfizq`,`anchocfder`,`altocfsup`,`altocfinf`, `espaciador`,`interlayer`,`configuracion`,`tipo`,`sistemas`,`tipo_vidrio`,`espesores`,`tipo_riel`,`tipo_alfajia`,`tipo_rejilla`,`tipo_cierre`,`cuerpo_fijo`,`linea`,`codigo`,`ancho`,`producto`,`alto`,`kit`,`perforacion`,`boquete`,`med_adicional`,`altura_v_c`,`hoja`,`ancho_adicional`,`ancho_v_c`,`laminas`,`ancho_maximo`,`alto_maximo`,`ok`,`estado_producto`,`cod_empresa`,`usuario`) "
                               . " values ('$can_cie','$can_rod','$can_bra','$obs','$tipbis','$tipbra','$tiprod','$ancfi','$ancfd','$alcfs','$alcfi','$esp','$inter','$confi','$tipos','$siste','1','$espsorvi','$tipriel','$alfa','$tipreji','$tipcie','$cuerf','$linea','$codigo','$ancho','$descrip','$alto','No','$per','$boq','$alrejilla','$alvenc','$hojas','$lam','$ancho','0','$anmax','$almax','0','1','$empresa','$usuario')");
                echo mysqli_error($con);
    
//                $ultimo = mysqli_insert_id($con);
//                echo  $ultimo;
            }
            else{
                mysqli_query($con, "update producto set configuracion='$confi',observaciones_pro='$obs', "
                        . "sistemas='$siste',"
                        . "tipo_bis='$tipbis',"
                        . "tipo_bra='$tipbra',"
                        . "espaciador='$esp',"
                        . "interlayer='$inter',"
                        . "tipo='$tipos',"
                        . "linea='$linea',"
                        . "ancho='$ancho',"
                        . "producto='$descrip',"
                        . "alto='$alto',"
                        . "perforacion='$per',"
                        . "boquete='$boq',"
                        . "med_adicional='$alrejilla',altura_v_c='$alvenc',hoja='$hojas',ancho_adicional='0',"
                        . "ancho_v_c='$ancho',tipo_riel='$tipriel',tipo_alfajia='$alfa',tipo_rejilla='$tipreji',tipo_cierre='$tipcie',cuerpo_fijo='$cuerf',configuracion='$confi',"
                        . "laminas='$lam',ancho_maximo='$anmax',alto_maximo='$almax',anchocfizq='$ancfi',anchocfder='$ancfd',altocfsup='$alcfs',altocfinf='$alcfi',tipo_rod='$tiprod',can_cierres='$can_cie',can_rodajas='$can_rod',can_brazos='$can_bra' where id_p='$idp'");
                echo $idp;
            }

   
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM producto where codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_p']; 
                 $p[1]=trim($fila['linea']);
                 $p[2]=trim($fila['codigo']);
                 $p[3]=$fila['ancho'];
                 $p[4]=$fila['producto'];
                 $p[5]=$fila['alto'];
                 $p[6]='';
                 $p[7]=$fila['kit'];
                 $p[8]=$fila['perforacion'];
                 $p[9]=$fila['boquete'];
                 $p[10]=$fila['med_adicional'];
                 $p[11]=$fila['altura_v_c'];
                 $p[12]=$fila['hoja'];
                 $p[13]=$fila['ancho_adicional'];
                 $p[14]=$fila['ancho_v_c'];
                 $p[15]=$fila['laminas'];
                 $p[16]=$fila['ancho_maximo'];
                 $p[17]=$fila['alto_maximo'];
                 $p[18]=$fila['ok'];
                 if($fila['ok']=='0'){
                     $btn_ok = '<button class="btn btn-danger" onclick="okr('.$p[0].','.$p[18].')">DT</button>';
                 }else{
                     $btn_ok = '<button class="btn btn-success" onclick="okr('.$p[0].','.$p[18].')"><i class="ace-icon fa fa-check "data-dismiss="modal"></i>DT</button>';
                 }
                 $p[19]=$btn_ok;
                $p[20]=$fila['estado_producto'];
                    if($fila['estado_producto']=='0'){
                     $btn_apro = '<button class="btn btn-danger" onclick="anular('.$p[0].','.$p[20].')">Producto Inactivo</button>';
                 }else{
                     $btn_apro = '<button class="btn btn-success" onclick="anular('.$p[0].','.$p[20].')"><i class="ace-icon fa fa-check "data-dismiss="modal"></i>Producto activo</button>';
                 }
                 //
                 $p[21]=$btn_apro;
                  $p[22]=$fila['aprobado'];
                 if($fila['aprobado']=='0'){
                     $btn_aproba = '<button class="btn btn-danger" onclick="aprobado('.$p[0].','.$p[22].')">Sin aprobar</button>';
                 }else{
                     $btn_aproba = '<button class="btn btn-success" onclick="aprobado('.$p[0].','.$p[22].')"><i class="ace-icon fa fa-check "data-dismiss="modal"></i>Aprobado</button>';
                 }
                  $p[23]=$btn_aproba;
                  $p[24]=$fila['revisado'];
                  if($fila['revisado']=='0'){
                     $btn_rev = '<button class="btn btn-danger" onclick="revisar('.$p[0].','.$p[24].')">DT Sin Revisar</button>';
                 }else{
                     $btn_rev = '<button class="btn btn-success" onclick="revisar('.$p[0].','.$p[24].')"><i class="ace-icon fa fa-check "data-dismiss="modal"></i>DT Revisada</button>';
                 }
                 $p[25]=$btn_rev;
                 
                  $p[26]=$fila['actualizado'];
                   if($fila['actualizado']=='0'){
                     $btn_actua = '<button class="btn btn-danger" onclick="actualizado('.$p[0].','.$p[26].')">Sin Desglose</button>';
                 }else{
                     $btn_actua = '<button class="btn btn-success" onclick="actualizado('.$p[0].','.$p[26].')"><i class="ace-icon fa fa-check "data-dismiss="modal"></i>Desglose actualizado</button>';
                 }
                 $p[27]=$btn_actua;
                 if($fila['ruta']!=''){
                  $p[28]= '<center><img src="../producto/'.$fila['ruta'].'" style="width: 100px;"/></center>' ;
                 }else{
                     $p[28]= '<center><img src="../producto/noimagen.png" style="width: 100px; "/></center>' ;
                 }
                  $p[29]='<center><img src="../producto/'.$fila['ruta2'].'" style="width: 100px;"/></center>' ;
                 $p[30]=$fila['sistemas'];
                 $p[31]=$fila['tipo'];
                 $p[32]=$fila['configuracion'];
                 $p[33]=$fila['espesores'];
                 $p[34]=$fila['tipo_riel'];
                 $p[35]=$fila['tipo_alfajia'];
                 $p[36]=$fila['tipo_cierre'];
                 $p[37]=$fila['cuerpo_fijo'];
                 $p[38]=$fila['tipo_rejilla'];
                 $p[39]=$fila['espaciador'];
                 $p[40]=$fila['interlayer'];
                 $p[41]=$fila['anchocfder'];
                 $p[42]=$fila['anchocfizq'];
                 $p[43]=$fila['altocfsup'];
                 $p[44]=$fila['altocfinf'];
                 $p[45]=$fila['tipo_rod'];
                 if($fila['ruta']!=''){
                     $p[46]= '<center><img src="../../../producto/'.$fila['ruta'].'" style="width: 100px; height: 100px;"/></center>' ;
                 }else{
                     $p[46]= '<center><img src="../../../producto/noimagen.png" style="width: 100px; height: 100px;"/></center>' ;
                 }
                 $p[47]=$fila['observaciones_pro'];
                 $p[48]=$fila['aprobado_por'];
                 $p[49]=$fila['tipo_bra'];
                 $p[50]=$fila['tipo_bis'];
                 $p[51]=$fila['can_cierres'];
                 $p[52]=$fila['can_rodajas'];
                 $p[53]=$fila['can_brazos'];
                 
                 
                  
            echo json_encode($p); 
            exit();
            
            break;
            case 2.1:
                $id=$_GET['id'];
                $query = mysqli_query($con,"SELECT * FROM producto where id_p='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                
                 echo $fila['codigo'];
                
                break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from dolares where id_dolar='$id' ");
            break;
        
            case 4:
                    $id = $_GET['id'];
                    $ok = $_GET['ok'];
                    if($ok==0){
                        $o = 1;
                    }else{
                        $o = 0;
                    }
                    mysqli_query($con,"update producto set ok='$o'  where id_p=$id ");
                    
                     echo '<button id="ok" type="button" onclick="okr('.$id.','.$o.')">'.$led.' Ok</button>';
                break;
        
        
               case 5:
                    $id = $_GET['id'];
                    $ok = $_GET['ok'];
                    if($ok==0){
                        $o = 1;
                    }else{
                        $o = 0;
                    }
                    mysqli_query($con,"update producto set estado_producto='$o' , anulado_por='".$_SESSION['k_username']."'  where id_p=$id ");
                    
                    if($o==0){
                    $btn = '<font color="green">Producto Activo</font>';
                    }else
                     {
                      $btn = '<font color="red">Producto Inactivo</font>';
                     }
                     echo '<button id="est" type="button" onclick="anular('.$id.','.$o.')">'.$btn.'</button>';
                break;
                
                 case 6:
                    $id = $_GET['id'];
                    $ok = $_GET['ok'];
                    if($ok==0){
                        $o = 1;
                    }else{
                        $o = 0;
                    }
                    mysqli_query($con,"update producto set aprobado='$o' , anulado_por='".$_SESSION['k_username']."'  where id_p=$id ");
                    
                    if($o==0){
                    $btn = '<font color="green">Producto Activo</font>';
                    }else
                     {
                    $btn = '<font color="red">Producto Inactivo</font>';
                      }
                     echo '<button  type="button" onclick="aprobado('.$id.','.$o.')">'.$btn.'</button>';
                break;
                
                case 7:
                    $id = $_GET['id'];
                    $ok = $_GET['ok'];
                    if($ok==0){
                        $o = 1;
                    }else{
                        $o = 0;
                    }
                    mysqli_query($con,"update producto set revisado='$o' , anulado_por='".$_SESSION['k_username']."'  where id_p=$id ");
                    
                    if($o==0){
                    $btn = '<font color="green">Producto Activo</font>';
                    }else
                     {
                    $btn = '<font color="red">Producto Inactivo</font>';
                      }
                     echo '<button type="button" onclick="revisar('.$id.','.$o.')">'.$btn.'</button>';
                break;
                
                  case 8:
                    $id = $_GET['id'];
                    $ok = $_GET['ok'];
                    if($ok==0){
                        $o = 1;
                    }else{
                        $o = 0;
                    }
                    mysqli_query($con,"update producto set actualizado='$o' , anulado_por='".$_SESSION['k_username']."'  where id_p=$id ");
                    
                    if($o==1){
                    $btn = '<font color="green">Producto Activo</font>';
                    }else
                     {
                    $btn = '<font color="red">Producto Inactivo</font>';
                      }
                     echo '<button id="est" type="button" onclick="actualizado('.$id.','.$o.')">'.$btn.'</button>';
                break;
        case 9:
            $cod = $_GET['cod'];
            $verificar = mysqli_query($con, "select codigo from producto where codigo= '$cod' ");
            $v = mysqli_fetch_row($verificar);
            if($v[0]){
                $cod_principal = $v[0];
            }else{
                $cod_principal = '0';
            }
            $ver = mysqli_query($con,"select pro_referencia from productos where pro_referencia='$cod' ");
            $f = mysqli_fetch_array($ver);
            if($f[0]){
                $cod_alu = $f[0];
            }else{
                $cod_alu = '0';
            }
            $p = array();
            $p[0] = $cod_principal;
            $p[1] = $cod_alu;
            
            echo json_encode($p);
            break;
        case 10:
            $cod = $_GET['cod'];
            $ver = mysqli_query($con,"select * from productos where pro_referencia='$cod' ");
            $f = mysqli_fetch_array($ver);
            $p = array();
            $p[0] = $f[0];
            $p[1] = $f[1];
            $p[2] = $f[2];
            
            echo json_encode($p);
            
            break;
        case 11:
            $id = $_GET['id'];
            $cod = $_GET['cod'];
            $acod = $_GET['acod'];
            $cant = $_GET['cant'];
            $calc = $_GET['calc'];
            $dist = $_GET['dist'];
            $cada = $_GET['cada'];
            $lado = $_GET['lado'];
            $para = $_GET['para'];
            $conf = $_GET['conf'];
            $insu = $_GET['insu'];
            $acc_rej = $_GET['acc_rej'];
            if($id==''){
                      mysqli_query($con, "insert into recetas (ref_rej,codigo_ref,codigo_pro,cantidad,calcular,metro,yes,lado,para,modulo,configuracion,insumo)"
                                       . "values ('$acc_rej','$cod','$acod','$cant','$calc','$cada','$dist','$lado','$para','Accesorios','$conf','$insu')");
                      mysqli_error($con);
                      echo $max = mysqli_insert_id($con);
                      
            }else{
                mysqli_query($con, "update recetas set ref_rej='$acc_rej', configuracion='$conf', insumo='$insu',cantidad='$cant', calcular='$calc', metro='$cada', yes='$dist', lado='$lado', para='$para' where id_r_ac='$id' "); 
                echo mysqli_error($con);
                echo $max = $id;
            }
            
            
            break;
        case 12:
            $codi = $_GET['cod'];
            
            $resultf = mysqli_query($con, "select * FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$codi' and a.insumo='Principal' order by para asc ");
            $c = 0;
            $div = 0;
            $co_to = 0;
            while($r = mysqli_fetch_array($resultf)){
                $cod = "'".$r['codigo_pro']."'";
                $des = "'".trim($r['descripcion'])."'";
                
                $cal = "'".$r['calcular']."'";
                $yes = "'".$r['yes']."'";
                $met = "'".$r['metro']."'";
                $ladox = "'".$r['lado']."'";
                $par = "'".$r['para']."'";
                $id = "'".$r['id_r_ac']."'";
                $codi = "'".$_GET['cod']."'";
                $conf = "'".$r['configuracion']."'";
                $insu = "'".$r['insumo']."'";
                $ref_rej = $r['ref_rej'];
                $calcular = $r['calcular'];
                $can = $r['cantidad'];
                $distancia = $r['yes'];
                $cada = $r['metro'];
                $lad = $r['lado'];
                
                
                
                
   
                include 'formula_accesorios.php';
                $costo_to= $total *$r['costo_promedio'];
                $co_to +=$costo_to;
                
                echo '<tr>'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>'.$r['lado'].'</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.number_format($r['cantidad'],2).'</td>'
                . '<td>'.$r['calcular'].'</td>'
                . '<td>'.number_format($total,2).'</td>'
                 . '<td title="Costo unidad : $ '.$r['costo_promedio'].'"><b>$ '.number_format($costo_to).'</b></td>'
                . '<td>'.$r['para'].'</td>'
                . '<td><button onclick="pre_pasaracc('.$cod.','.$des.','.$can.','.$cal.','.$yes.','.$met.','.$ladox.','.$par.','.$id.','.$conf.','.$insu.','.$ref_rej.')">Editar</button>'
                        . '<button onclick="pre_delacc('.$id.','.$codi.')">Eliminar</button></td>';
                
               
                if($r['para']=='Fabricacion'){             
                    $div += 1;  
                }
                
                 
                 
            }
            echo '<tr><td colspan="7"></td><td>$ '.number_format($co_to).'</td><td colspan="2"></td>';
            
            break;
             case 12.1:
            $codi = $_GET['cod'];
            $result = mysqli_query($con, "select * FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$codi' and a.insumo='Cierres' order by a.para desc ");
            $c = 0;
            while($r = mysqli_fetch_array($result)){
                $cod = "'".$r['codigo_pro']."'";
                $des = "'".trim($r['descripcion'])."'";
                $can = "'".$r['cantidad']."'";
                $cal = "'".$r['calcular']."'";
                $yes = "'".$r['yes']."'";
                $met = "'".$r['metro']."'";
                $lado = "'".$r['lado']."'";
                $par = "'".$r['para']."'";
                $id = "'".$r['id_r_ac']."'";
                $codi = "'".$_GET['cod']."'";
                $conf = "'".$r['configuracion']."'";
                $insu = "'".$r['insumo']."'";
                $ref_rej = $r['ref_rej'];
                $calcular = $r['calcular'];
                $can = $r['cantidad'];
                $distancia = $r['yes'];
                $cada = $r['metro'];
                $lad = $r['lado'];
   
                include 'formula_accesorios.php';
                $costo_to= $total *$r['costo_promedio'];
         
                
                echo '<tr>'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>'.$r['lado'].'</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.$r['cantidad'].'</td>'
                . '<td>'.$r['calcular'].'</td>'
                . '<td>'.$total.' Und</td>'
                . '<td title="Costo unidad : $ '.$r['costo_promedio'].'"><b>$ '.number_format($costo_to).'</b></td>'
                . '<td>'.$r['para'].'</td>'
                . '<td><button onclick="pre_pasaracc('.$cod.','.$des.','.$can.','.$cal.','.$yes.','.$met.','.$lado.','.$par.','.$id.','.$conf.','.$insu.','.$ref_rej.')">Editar</button>'
                        . '<button onclick="pre_delacc('.$id.','.$codi.')">Eliminar</button></td>';
            }
            
            break;
             case 12.2:
            $codi = $_GET['cod'];
            $result = mysqli_query($con, "select * FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$codi' and a.insumo='Rodajas' order by a.para desc ");
            while($r = mysqli_fetch_array($result)){
                $cod = "'".$r['codigo_pro']."'";
                $des = "'".trim($r['descripcion'])."'";
                $can = "'".$r['cantidad']."'";
                $cal = "'".$r['calcular']."'";
                $yes = "'".$r['yes']."'";
                $met = "'".$r['metro']."'";
                $lado = "'".$r['lado']."'";
                $par = "'".$r['para']."'";
                $id = "'".$r['id_r_ac']."'";
                $codi = "'".$_GET['cod']."'";
                $conf = "'".$r['configuracion']."'";
                $insu = "'".$r['insumo']."'";
                $ref_rej = $r['ref_rej'];
                $calcular = $r['calcular'];
                $can = $r['cantidad'];
                $distancia = $r['yes'];
                $cada = $r['metro'];
                $lad = $r['lado'];
   
                include 'formula_accesorios.php';
                $costo_to= $total *$r['costo_promedio'];
                
                echo '<tr>'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>'.$r['lado'].'</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.$r['cantidad'].'</td>'
                . '<td>'.$r['calcular'].'</td>'
                . '<td>'.$total.'</td>'
                . '<td title="Costo unidad : $ '.$r['costo_promedio'].'"><b>$ '.number_format($costo_to).'</b></td>'
                . '<td>'.$r['para'].'</td>'
                . '<td><button onclick="pre_pasaracc('.$cod.','.$des.','.$can.','.$cal.','.$yes.','.$met.','.$lado.','.$par.','.$id.','.$conf.','.$insu.','.$ref_rej.')">Editar</button>'
                        . '<button onclick="pre_delacc('.$id.','.$codi.')">Eliminar</button></td>';
            }
            
            break;
            case 12.3:
            $codi = $_GET['cod'];
            $result = mysqli_query($con, "select * FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$codi' and a.insumo='Brazos' order by a.para desc ");
            while($r = mysqli_fetch_array($result)){
                $cod = "'".$r['codigo_pro']."'";
                $des = "'".trim($r['descripcion'])."'";
                $can = "'".$r['cantidad']."'";
                $cal = "'".$r['calcular']."'";
                $yes = "'".$r['yes']."'";
                $met = "'".$r['metro']."'";
                $lado = "'".$r['lado']."'";
                $par = "'".$r['para']."'";
                $id = "'".$r['id_r_ac']."'";
                $codi = "'".$_GET['cod']."'";
                $conf = "'".$r['configuracion']."'";
                $insu = "'".$r['insumo']."'";
                $ref_rej = $r['ref_rej'];
                $calcular = $r['calcular'];
                $can = $r['cantidad'];
                $distancia = $r['yes'];
                $cada = $r['metro'];
                $lad = $r['lado'];
   
                include 'formula_accesorios.php';
                $costo_to= $total *$r['costo_promedio'];
                
                echo '<tr>'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>'.$r['lado'].'</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.$r['cantidad'].'</td>'
                . '<td>'.$r['calcular'].'</td>'
                . '<td>'.$total.'</td>'
                . '<td title="Costo unidad : $ '.$r['costo_promedio'].'"><b>$ '.number_format($costo_to).'</b></td>'
                . '<td>'.$r['para'].'</td>'
                . '<td><button onclick="pre_pasaracc('.$cod.','.$des.','.$can.','.$cal.','.$yes.','.$met.','.$lado.','.$par.','.$id.','.$conf.','.$insu.','.$ref_rej.')">Editar</button>'
                        . '<button onclick="pre_delacc('.$id.','.$codi.')">Eliminar</button></td>';
            }
            
            break;
            case 12.4:
            $codi = $_GET['cod'];
            $result = mysqli_query($con, "select * FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$codi' and a.insumo='Bisagras' order by a.para desc ");
            while($r = mysqli_fetch_array($result)){
                $cod = "'".$r['codigo_pro']."'";
                $des = "'".trim($r['descripcion'])."'";
                $can = "'".$r['cantidad']."'";
                $cal = "'".$r['calcular']."'";
                $yes = "'".$r['yes']."'";
                $met = "'".$r['metro']."'";
                $lado = "'".$r['lado']."'";
                $par = "'".$r['para']."'";
                $id = "'".$r['id_r_ac']."'";
                $codi = "'".$_GET['cod']."'";
                $conf = "'".$r['configuracion']."'";
                $insu = "'".$r['insumo']."'";
                $ref_rej = $r['ref_rej'];
                $calcular = $r['calcular'];
                $can = $r['cantidad'];
                $distancia = $r['yes'];
                $cada = $r['metro'];
                $lad = $r['lado'];
   
                include 'formula_accesorios.php';
                $costo_to= $total *$r['costo_promedio'];
                
                echo '<tr>'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>'.$r['lado'].'</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.$r['cantidad'].'</td>'
                . '<td>'.$r['calcular'].'</td>'
                . '<td>'.$total.'</td>'
                . '<td title="Costo unidad : $ '.$r['costo_promedio'].'"><b>$ '.number_format($costo_to).'</b></td>'
                . '<td>'.$r['para'].'</td>'
                . '<td><button onclick="pre_pasaracc('.$cod.','.$des.','.$can.','.$cal.','.$yes.','.$met.','.$lado.','.$par.','.$id.','.$conf.','.$insu.','.$ref_rej.')">Editar</button>'
                        . '<button onclick="pre_delacc('.$id.','.$codi.')">Eliminar</button></td>';
            }
            
            break;
        case 13:
            $ref = $_GET['ref'];
            $cod = $_GET['cod'];
            $par = $_GET['tipo'];
            $can = $_GET['can'];
            $und = $_GET['und'];
            $usuario=$_SESSION['k_username'];
            //echo 'ref:'.$ref.', cod:'.$cod.', par:'.$par.'&sel:'.$sel;
            $ver = mysqli_query($con, "select count(*) from productos_parametros where codigo_pro='$ref' and codigo_ref='$cod' and parametro='$par' ");
            $v = mysqli_fetch_row($ver);
  
             if($v[0]==0){
                       mysqli_query($con, "insert into productos_parametros (codigo_pro,codigo_ref,parametro,estado_par,usuario,cantidad,und_med) "
                               . "values ('$ref','$cod','$par','1','$usuario','$can','$und')");
                      echo 'Se agrego con exito';
              }else{

                        mysqli_query($con, "update productos_parametros set und_med='$und', cantidad='$can' where  codigo_pro='$ref' and codigo_ref='$cod' and parametro='$par' ");
                        echo 'Se edito con exito';
              }
            
            break;
        case 14:
            $cod = $_GET['id'];
            $ver = mysqli_query($con, "delete from recetas where id_r_ac='$cod' ");
            echo mysqli_error($con);
            break;
        case 15:
            $cod = $_GET['cod'];
            $ver = mysqli_query($con, "delete from productos_parametros where id_pp='$cod' ");
            echo mysqli_error($con);
            break;
        case 16:
            echo '<table style="width:100%" border="1">';
            echo '<tr><td>CODIGO</td><td>DESCRIPCION</td><td>COSTO</td><td>CANTIDAD</td><td>CALCULAR</td><td>TIPO</td><td>Quitar';
            $cod = $_GET['cod'];
$result = mysqli_query($con,"select * from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.compuesto='$cod' order by parametro asc ");
while($r = mysqli_fetch_array($result)){
    $ref = "'".$r['codigo_pro']."'";
    $tipo = "'".$r['parametro']."'";
    $desc = "'".$r['descripcion']."'";
    $cant = "'".$r['cantidad']."'";
    $und = "'".$r['und_med']."'";
    echo '<tr>'
    . '<td>'.$r['codigo_pro'].'</td>'
    . '<td>'.$r['descripcion'].'</td>'
            . '<td>'.$r['costo_promedio'].'</td>'
    . '<td>'.$r['cantidad'].'</td>'
            . '<td>'.$r['tipo'].'</td>'
    . '<td>'.$r['und_med'].'</td><td><button onclick="del_espcomp('.$r['id_pp'].')">-</button>';
}
echo '</table>';
            break;
        case 17:
            $cod = $_GET['cod'];
            mysqli_query($con, "delete from productos_parametros where id_pp='$cod' ");
            
            break;
        case 18:
             $ref = $_GET['ref'];
            $cod = $_GET['cod'];
            $par = $_GET['tipo'];
            $can = $_GET['can'];
            $und = $_GET['und'];
            $id = $_GET['id'];
            $tiposel = $_GET['tiposel'];
            $usuario=$_SESSION['k_username'];
            //echo 'ref:'.$ref.', cod:'.$cod.', par:'.$par.'&sel:'.$sel;
            $ver = mysqli_query($con, "select count(*) from productos_parametros where codigo_pro='$ref' and codigo_ref='$cod' and parametro='$par' and compuesto='$id' ");
            $v = mysqli_fetch_row($ver);
             if($v[0]==0){
                       mysqli_query($con, "insert into productos_parametros (tipo,compuesto,codigo_pro,codigo_ref,parametro,estado_par,usuario,cantidad,und_med) "
                               . "values ('$tiposel','$id','$ref','$cod','$par','1','$usuario','$can','$und')");
                      echo mysqli_error($con);
                      echo 'Se agrego con exito';
              }else{

                        mysqli_query($con, "update productos_parametros set tipo='$tiposel',compuesto='$id',und_med='$und', cantidad='$can' where  codigo_pro='$ref' and codigo_ref='$cod' and parametro='$par' ");
                        echo 'Se edito con exito';
              }
            break;
        case 19:
            $id = $_GET['id'];
            $codigo = $_GET['codigo'];
            $ref = $_GET['ref'];
            $des = $_GET['des'];
            $desopc = $_GET['des_opc'];
            $formula = $_GET['formula'];
            $lado = $_GET['lado'];
            $perfil = $_GET['perfil'];
            $ope1 = $_GET['ope1'];
            $ope2 = $_GET['ope2'];
            $cifra1 = $_GET['cifra1'];
            $cifra2 = $_GET['cifra2'];
            $fija = $_GET['fija'];
            
            $cant = $_GET['cant'];
            $pieza = $_GET['piezas'];
            $cadav = $_GET['cadav'];
            $cadah = $_GET['cadah'];
            $alu_dim = $_GET['alu_dim'];
            $alu_mod = $_GET['alu_mod'];
            $alu_div = $_GET['alu_div'];

            if($id==''){
                mysqli_query($con,"INSERT INTO `producto_perfiles` (`divisiones`,`perfiles`,`modulo`,`name_opc`, `codigo`, `referencia`, `desc_referencia`, `formula`, `lado`, `lado_ref`, `ope1`, `var1`, `ope2`, `var2`, `cantidad`, `medidas`, `piezas`, `cadav`, `cadah`)"
                    . " VALUES ('$alu_div','$alu_dim', '$alu_mod','$desopc', '$codigo', '$ref', '$des', '$formula', '$lado', '$perfil', '$ope1', '$cifra1', '$ope2', '$cifra2', '$cant', '$fija', '$pieza', '$cadav', '$cadah');");
                $id = mysqli_insert_id($con);
                $msg = 'Se guardo con exito'.$codigo;
            }else{
                mysqli_query($con, "UPDATE `producto_perfiles` SET `divisiones`='$alu_div', `perfiles` = '$alu_dim',`modulo` = '$alu_mod',`referencia` = '$ref', `desc_referencia`='$des', `name_opc`='$desopc', `formula` = '$formula', `lado` = '$lado', `lado_ref` = '$perfil', `ope1` = '$ope1', `var1` = '$cifra1', `ope2` = '$ope2', `var2` = '$cifra2', `cantidad` = '$cant', `medidas` = '$fija', `piezas` = '$pieza', `cadav` = '$cadav', `cadah` = '$cadah' WHERE `id_p` = '$id';");
                $id = $_GET['id'];
                $msg = 'Se edito con exito';
            }
            $p = array();
            $p[0] = $id;
            $p[1] = $msg;
            echo json_encode($p);
            break;
        case 20:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej =  $alto - $rej;
                    
 
            $result = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' and modulo='Principal' order by lado desc ");
            $gtpeso = 0;
            $gttotal =0;
            while($f = mysqli_fetch_array($result)){
                $formula = $f[4];
                $lado_per = $f[6];
                $ope1 = $f[7];
                $var1 = $f[8];
                $ope2 = $f[9];
                $var2 = $f[10];
                $lado = $f[5];
                $medida = $f[12];
                $piezas = $f[13];
                $cantidad = $f[11];
                $cadah = $f[15];
                $cadav = $f[14];
                include 'formula_perfil.php';
                $medtotal = $medida*$cantidad;
                $perfiles = $medtotal / 6000;
                $ref = $f[2];
                $conspeso = mysqli_query($con, "select peso,perimetro,costo_aluminio from productos where pro_referencia='".$ref."' ");
                $cs = mysqli_fetch_row($conspeso);
                $ver = mysqli_error($con);
                
                $pesototal = $cs[0] * ($medtotal/1000);
                $costo = $cs[2] * ($medtotal/1000);
                $gtpeso += $pesototal;
                $gttotal += $costo;
                
                echo '<tr>'
                . '<td>'.$f[2].'</td>'
                        . '<td>'.$f[3].'</td>'
                        . '<td>'.$f[16].'</td>'
                        . '<td>'.$lado.'</td>'
                        . '<td>'.$f[4].'</td>'
                        . '<td>'.$f[13].'</td>'
                        . '<td style="text-align:right"><font color="red">'.number_format($medida,2).'</font></td>'
                        . '<td style="text-align:right"><font color="blue">'.$cantidad.'</font></td>'
                        //. '<td style="text-align:right">'.number_format($perfiles,2).'</td>'
                        . '<td style="text-align:right">'.number_format($medtotal).'</td>'
                        . '<td style="text-align:right" title="Peso perfil mtl= '.$cs[0].' Kg ">'.number_format($pesototal,3).' Kg</td>'
                        . '<td style="text-align:right" title="Valor Mtl perfil= $ '.$cs[2].'"><b>$ '.number_format($costo).'</b></td>'
                        . '<td><button onclick="sel_perfil('.$f[0].')"  data-toggle="modal" data-target="#Formularioaluminio">Editar</button> '
                        . '<td><button onclick="del_perfil('.$f[0].')">-</button></td>';
                
            }
            echo '<tr><td colspan="9">Totales</td><td style="text-align:right">'.number_format($gtpeso,3).' Kg</td><td style="text-align:right"><b>$ '.number_format($gttotal).'</b></td><td colspan="2"></td></tr>';
            
            break;
            case 20.1:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi;
            $altomrej =  $alto - $rej;
            $gtpeso = 0;
            $gttotal =0; 
           
            $result = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' and modulo='Rieles' ");
            while($f = mysqli_fetch_array($result)){
                $formula = $f[4];
                $lado_per = $f[6];
                $ope1 = $f[7];
                $var1 = $f[8];
                $ope2 = $f[9];
                $var2 = $f[10];
                $lado = $f[5];
                $medida = $f[12];
                $piezas = $f[13];
                $cantidad = $f[11];
                $cadah = $f[15];
                $cadav = $f[14];
                include 'formula_perfil.php';
                $medtotal = $medida*$cantidad;
                $perfiles = $medtotal / 6000;
                
                 $ref = $f[2];
                $conspeso = mysqli_query($con, "select peso,perimetro,costo_aluminio from productos where pro_referencia='".$ref."' ");
                $cs = mysqli_fetch_row($conspeso);
                $ver = mysqli_error($con);
                
                $pesototal = $cs[0] * ($medtotal/1000);
                $costo = $cs[2] * ($medtotal/1000);
                 $gtpeso += $pesototal;
                $gttotal += $costo;
                echo '<tr>'
                . '<td>'.$f[2].'</td>'
                        . '<td>'.$f[3].'</td>'
                        . '<td>'.$f[16].'</td>'
                        . '<td>'.$lado.'</td>'
                        . '<td>'.$f[4].'</td>'
                        . '<td>'.$f[13].'</td>'
                        . '<td style="text-align:right">'.number_format($medida,2).'</td>'
                        . '<td style="text-align:right"><font color="blue">'.$cantidad.'</font></td>'
                        //. '<td style="text-align:right">'.number_format($perfiles,2).'</td>'
                        . '<td style="text-align:right"><font color="red">'.number_format($medtotal).'</font></td>'
                        . '<td style="text-align:right" title="Peso perfil mtl= '.$cs[0].' Kg ">'.number_format($pesototal,3).' Kg</td>'
                        . '<td style="text-align:right" title="Valor Mtl perfil= $ '.$cs[2].'"><b>$ '.number_format($costo,2).'</b></td>'
                        . '<td><button onclick="sel_perfil('.$f[0].')"  data-toggle="modal" data-target="#Formularioaluminio">Editar</button> '
                        . '<td><button onclick="del_perfil('.$f[0].')">-</button></td>';
                
            }
               echo '<tr><td colspan="9">Totales</td><td style="text-align:right">'.number_format($gtpeso,3).' Kg</td><td style="text-align:right"><b>$ '.number_format($gttotal).'</b></td><td colspan="2"></td></tr>';
            
            break;
            case 20.2:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi;
            $altomrej =  $alto - $rej;
            $gtpeso = 0;
            $gttotal =0;
            $result = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' and modulo='Alfajia' ");
            while($f = mysqli_fetch_array($result)){
                $formula = $f[4];
                $lado_per = $f[6];
                $ope1 = $f[7];
                $var1 = $f[8];
                $ope2 = $f[9];
                $var2 = $f[10];
                $lado = $f[5];
                $medida = $f[12];
                $piezas = $f[13];
                $cantidad = $f[11];
                $cadah = $f[15];
                $cadav = $f[14];
                include 'formula_perfil.php';
                $medtotal = $medida*$cantidad;
                $perfiles = $medtotal / 6000;
                
                 $ref = $f[2];
                $conspeso = mysqli_query($con, "select peso,perimetro,costo_aluminio from productos where pro_referencia='".$ref."' ");
                $cs = mysqli_fetch_row($conspeso);
                $ver = mysqli_error($con);
                
                $resdesc = mysqli_query($con, "select descuento from grupos_referencia where referencia='$ref' ");
                $d = mysqli_fetch_row($resdesc);
                
                $pesototal = $cs[0] * ($medtotal/1000);
                $costo = $cs[2] * ($medtotal/1000);
                $gtpeso += $pesototal;
                $gttotal += $costo;
                echo '<tr>'
                . '<td>'.$f[2].'</td>'
                        . '<td>'.$f[3].'</td>'
                        . '<td>'.$f[16].'</td>'
                        . '<td>'.$lado.'</td>'
                        . '<td>'.$f[4].'</td>'
                        . '<td>'.$f[13].'</td>'
                        . '<td style="text-align:right" title="Descuento de este perfil para los demas: '.$d[0].' mm ">'.number_format($medida,2).'</td>'
                        . '<td style="text-align:right"><font color="blue">'.$cantidad.'</font></td>'
                        . '<td style="text-align:right"><font color="red">'.number_format($medtotal).'</font></td>'
                        . '<td style="text-align:right" title="Peso perfil mtl= '.$cs[0].' Kg ">'.number_format($pesototal,3).' Kg</td>'
                        . '<td style="text-align:right" title="Valor Mtl perfil= $ '.$cs[2].'"><b>$ '.number_format($costo,2).'</b></td>'
                        . '<td><button onclick="sel_perfil('.$f[0].')"  data-toggle="modal" data-target="#Formularioaluminio">Editar</button> '
                        . '<td><button onclick="del_perfil('.$f[0].')">-</button></td>';
                
            }
               echo '<tr><td colspan="9">Totales</td><td style="text-align:right">'.number_format($gtpeso,3).' Kg</td><td style="text-align:right"><b>$ '.number_format($gttotal).'</b></td><td colspan="2"></td></tr>';
            
            break;
        case 21:
            $id = $_GET['id'];
            mysqli_query($con, "delete from producto_perfiles where id_p='$id' ");
            echo 'Se elimino con exito! Res:'.mysqli_error($con);            
            break;
        case 22:
            $id = $_GET['id'];
            $result = mysqli_query($con,"select * from producto_perfiles where id_p='$id'");
            $r = mysqli_fetch_array($result);
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
            echo json_encode($p);
            
            
            break;
           case 23:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej = $alto - $rej;
                        if($ancfd!=0){
                echo '<option value="Anchocfd">Ancho cf der ('.$ancfd.')</option>';
            }
            if($ancfi!=0){
                echo '<option value="Anchocfi">Ancho cf izq ('.$ancfi.')</option>';
            }
            if($alcfs!=0){
                echo '<option value="Altocfs">Alto cf sup ('.$alcfs.')</option>';
            }
            if($alcfi!=0){
                echo '<option value="Altocfi">Alto cf inf ('.$alcfi.')</option>';
            }
            if($anchovc!=0){
                echo '<option value="Anchovc">Ancho Restante ('.$anchovc.')</option>';
            }
            if($altovc!=0){
                echo '<option value="Altovc">Alto Restante Total x ('.$altovc.')</option>';
            }
            if($rej!=0){
                echo '<option value="Altorej">Alto Rejilla ('.$rej.')</option> ';
            }
            if($altomrej!=0){
                echo '<option value="Altomrej">Alto - Rejilla ('.$altomrej.')</option> ';
            }
           echo '<option value="" disabled>-------------------------------------</option>';   
   
            $result = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' ");
            
            while($f = mysqli_fetch_array($result)){
                $formula = $f[4];
                $lado_per = $f[6];
                $ope1 = $f[7];
                $var1 = $f[8];
                $ope2 = $f[9];
                $var2 = $f[10];
                $lado = $f[5];
                $medida = $f[12];
                $piezas = $f[13];
                $cantidad = $f[11];
                include 'formula_perfil.php';
                $medtotal = $medida*$cantidad;
                $perfiles = $medtotal / 6000;
                if($f[16]!=''){
                    $desc = $f[16];
                }else{
                    $desc = $f[3];
                }
                echo '<option value="'.$f[0].'">'.$desc.', ('.$medida.')</option>';

            }

                      
      
               break;
               case 23.1:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej = $alto - $rej;
            echo '<option value="ancho">Ancho  ('.$ancho.')</option>';
            echo '<option value="alto">Alto ('.$alto.')</option>';
            if($ancfd!=0){
                echo '<option value="Anchocfd">Ancho cf der ('.$ancfd.')</option>';
            }
            if($ancfi!=0){
                echo '<option value="Anchocfi">Ancho cf izq ('.$ancfi.')</option>';
            }
            if($alcfs!=0){
                echo '<option value="Altocfs">Alto cf sup ('.$alcfs.')</option>';
            }
            if($alcfi!=0){
                echo '<option value="Altocfi">Alto cf inf ('.$alcfi.')</option>';
            }
            if($anchovc!=0){
                echo '<option value="Anchovc">Ancho Restante ('.$anchovc.')</option>';
            }
            if($altovc!=0){
                echo '<option value="Altovc">Alto Restante Total ('.$altovc.')</option>';
            }
            if($rej!=0){
                echo '<option value="Altorej">Alto Rejilla ('.$rej.')</option> ';
            }
            if($altomrej!=0){
                echo '<option value="Altomrej">Alto - Rejilla ('.$altomrej.')</option> ';
            }

                      
      
               break;
        case 24:
            $cod = $_GET['cod'];
            $ref_vidrio = $_GET['ref_vidrio'];
            $vid_ref1 = $_GET['vid_ref1'];
            $vid_ope1 = $_GET['vid_ope1'];
            $vid_var1 = $_GET['vid_var1'];
            $vid_ope2 = $_GET['vid_ope2'];
            $vid_var2 = $_GET['vid_var2'];
            $vid_ref3 = $_GET['vid_ref3'];
            $vid_ope3 = $_GET['vid_ope3'];
            $vid_var3 = $_GET['vid_var3'];
            $vid_ope4 = $_GET['vid_ope4'];
            $vid_var4 = $_GET['vid_var4'];
            $vid_can = $_GET['vid_can'];
            $vid_mod = $_GET['vid_mod'];
            $vid_id = $_GET['vid_id'];
            if($vid_id==''){
               mysqli_query($con,"INSERT INTO `producto_vidrios` (`id_pv`, `codigo`, `ref_vidrio`, `ref1`, `ope1`, `var1`, `ope2`, `var2`, `ref2`, `ope3`, `var3`, `ope4`, `var4`, `cantidad`, `modulo`)"
                    . " VALUES ('', '$cod', '$ref_vidrio', '$vid_ref1', '$vid_ope1', '$vid_var1', '$vid_ope2', '$vid_var2', '$vid_ref3', '$vid_ope3', '$vid_var3', '$vid_ope4', '$vid_var4', '$vid_can', '$vid_mod');");
               $id = mysqli_insert_id($con);
            }else{
                mysqli_query($con,"UPDATE `producto_vidrios` SET `ref_vidrio` = '$ref_vidrio', `ref1` = '$vid_ref1', `ope1` = '$vid_ope1', `var1` = '$vid_var1', `ope2` = '$vid_ope2', `var2` = '$vid_var2', `ref2` = '$vid_ref3', `ope3` = '$vid_ope3', `var3` = '$vid_var3', `ope4` = '$vid_ope4', `var4` = '$vid_var4', `cantidad` = '$vid_can', `modulo` = '$vid_mod' WHERE `id_pv` = '$vid_id';");
                $id = $vid_id;
              }
            echo $id;
            break;
        case 25:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej = $alto - $rej;
 
            $result = mysqli_query($con, "select * from  producto_vidrios where codigo='$cod' ");
            while($f = mysqli_fetch_array($result)){
                $vidrio = $f[2];
                $vref1 = $f[3];
                $vope1 = $f[4];
                $vvar1 = $f[5];
                $vope2 = $f[6];
                $vvar2 = $f[7];
                
                $vref2 = $f[8];
                $vope3 = $f[9];
                $vvar3 = $f[10];
                $vope4 = $f[11];
                $vvar4 = $f[12];

                $cantidad = $f[13];

                include 'formula_vidrios.php';
                $formula1 = number_format($variablev,2).$f[4].$f[5].$f[6].$f[7];
                $formula2 = number_format($variablev2,2).$f[9].$f[10].$f[11].$f[12];
                
                
                echo '<tr>'
                        . '<td>'.$f[0].'</td>'
                        . '<td>'.$f[2].'</td>'
                        . '<td>'.$formula1.'</td>'
                        . '<td style="text-align:right"><font color="red">'.number_format($resultadov,2).'</font> </td>'
                        . '<td>'.$formula2.'</td>'
                        . '<td style="text-align:right"><font color="red">'.number_format($resultadov2,2).'</font></td>'   
                        . '<td style="text-align:right">'.$f[13].'</td>'
                        . '<td>'.$f[14].'</td>'
                        . '<td><button onclick="sel_vidrio('.$f[0].')"  data-toggle="modal" data-target="#modalvidrios">Editar</button> </td>'
                        . '<td><button onclick="del_vidrio('.$f[0].')">-</button></td>';
                
            }
            
            break;
        case 26:
            $id = $_GET['id'];
            $result = mysqli_query($con,"select * from producto_vidrios where id_pv='$id' ");
            $r = mysqli_fetch_array($result);
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

            echo json_encode($p);
            
            break;
        case 27:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej =  $alto - $rej;
            if($cod=='ancho'){
                    $variable2 = $ancho;
                }elseif($cod=='alto'){
                    $variable2 = $alto;
                }elseif($cod=='Anchocfd'){
                    $variable2 = $ancfd;
                }elseif($cod=='Anchocfi'){
                    $variable2 = $ancfi;
                }elseif($cod=='Anchovc'){
                    $variable2 = $anchovc;
                }elseif($cod=='Altocfs'){
                    $variable2 = $alcfs;
                }elseif($cod=='Altocfi'){
                    $variable2 = $alcfi;
                }elseif($cod=='Altorej'){
                    $variable2 = $rej;
                }elseif($cod=='Altovc'){
                    $variable2 = $altovc;
                }elseif($cod=='Altomrej'){
                    $variable2 = $altomrej;
                }else{

                   $result = mysqli_query($con, "select * from producto_perfiles where id_p='$cod' ");
                    $f = mysqli_fetch_array($result);
                    $formula = $f[4];
                    $lado_per = $f[6];
                    $ope1 = $f[7];
                    $var1 = $f[8];
                    $ope2 = $f[9];
                    $var2 = $f[10];
                    $lado = $f[5];
                    $medida = $f[12];
                    $piezas = $f[13];
                    $cantidad = $f[11];
                    $cadav = $f[14];
                    $cadah = $f[15];
                    include 'formula_perfil.php';
                    $medtotal = $medida*$cantidad;
                    $perfiles = $medtotal / 6000;
                     $variable2 = $medida;
                }
                echo $variable2;

               break;
        case 28:
            $id = $_GET['id'];
            $result = mysqli_query($con,"delete from producto_vidrios where id_pv='$id' ");
            $del = mysqli_error($con);
            if($del){
                $res = 'error '.$del;
            }else{
                $res = 'Se elimino con exito';
            }
            echo $res;
            break;
        case 29:
            $idrefe = $_GET['idrefe'];
            $cod = $_GET['cod'];
            $rej_ref = $_GET['rej_ref'];
            $rej_des = $_GET['rej_des'];
            $rej_ref1 = $_GET['rej_ref1'];
            $rej_ope1 = $_GET['rej_ope1'];
            $rej_var1 = $_GET['rej_var1'];
            $rej_ope2 = $_GET['rej_ope2'];
            $rej_var2 = $_GET['rej_var2'];
            $rej_ref2= $_GET['rej_ref2'];
            $rej_ope3 = $_GET['rej_ope3'];
            $rej_var3= $_GET['rej_var3'];
            $rej_ope4 = $_GET['rej_ope4'];
            $rej_var4 = $_GET['rej_var4'];
            if($idrefe==''){
                mysqli_query($con, "INSERT INTO `producto_rejillas` (`id_pr`, `codigo`, `rej_ref`, `rej_descripcion`, `ref1`, `ope1`, `var1`, `ope2`, `var2`, `ref2`, `ope3`, `var3`, `ope4`, `var4`, `por`)"
                        . " VALUES (NULL, '$cod', '$rej_ref', '$rej_des', '$rej_ref1', '$rej_ope1', '$rej_var1', '$rej_ope2', '$rej_var2', '$rej_ref2', '$rej_ope3', '$rej_var3', '$rej_ope4', '$rej_var4', '$usuario');");
                $id = mysqli_insert_id($con);
                $msg = 'Se guardo con exito';
            }else{
                 mysqli_query($con, "UPDATE `producto_rejillas` SET  `rej_ref` = '$rej_ref', `rej_descripcion` = '$rej_des', `ref1` = '$rej_ref1', `ope1` = '$rej_ope1', `var1` = '$rej_var1', `ope2` = '$rej_ope2', `var2` = '$rej_var2', `ref2` = '$rej_ref2', `ope3` = '$rej_ope3', `var3` = '$rej_var3', `ope4` = '$rej_ope4', `var4` = '$rej_var4' WHERE `id_pr` = '$idrefe';");
                $id = $idrefe;
                $msg = 'Se edito con exito';
            }
            $p = array();
            $p[0] = $id;
            $p[1] = $msg;
            echo json_encode($p);
        
            
            
            break;
        case 30:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
                    
 
            $result = mysqli_query($con, "select * from producto_rejillas where codigo='$cod' ");
            while($f = mysqli_fetch_array($result)){
                $rejilla = $f[2];
                $vref1 = $f[4];
                $vope1 = $f[5];
                $vvar1 = $f[6];
                $vope2 = $f[7];
                $vvar2 = $f[8];
                
                $vref2 = $f[9];
                $vope3 = $f[10];
                $vvar3 = $f[11];
                $vope4 = $f[12];
                $vvar4 = $f[13];

                //$cantidad = $f[13];

                include 'formula_rejillas.php';
                $formula1 = number_format($variablev,2).$f[5].$f[6].$f[7].$f[8];
                $formula2 = number_format($variablev2,2).$f[10].$f[11].$f[12].$f[13];
                
                $ref = $f[2];
                $conspeso = mysqli_query($con, "select peso,perimetro,costo_aluminio from productos where pro_referencia='".$ref."' ");
                $cs = mysqli_fetch_row($conspeso);
                
                $precio = $cs[2];
                $perfiles = ($resultadov * $resultadov2)/ 6000;
                $medto = ($resultadov * $resultadov2)/1000;
                $medcost = $medto * $precio;
                
                echo '<tr>'
                . '<td>'.$f[2].'</td>'
                        . '<td>'.$f[3].'</td>'
                        . '<td>'.$ancho.'</td>'
                        . '<td>'.$formula1.'</td>'
                        . '<td><font color="red">'.  number_format($resultadov,2).'</font></td>'
                        . '<td style="text-align:right">'.$formula2.'</td>'
                        . '<td style="text-align:right"><font color="red">'.$resultadov2.'</font></td>'
                        . '<td style="text-align:right">'.number_format($perfiles,2).'</td>'
                        . '<td style="text-align:right">'.number_format($resultadov * $resultadov2).'</td>'
                        . '<td style="text-align:right" title="precio metro: '.$precio.'"><b>$ '.number_format($medcost).'</b></td>'
                        . '<td><button onclick="sel_rejilla('.$f[0].')"  data-toggle="modal" data-target="#ModalRejillas">Editar</button> '
                        . '<td><button onclick="del_rejilla('.$f[0].')">-</button></td>';
                
            }
            
            
            break;
            case 30.1:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
                    
 
            $result = mysqli_query($con, "select * from producto_rejillas where codigo='$cod' ");
            while($f = mysqli_fetch_array($result)){
                $rejilla = $f[2];
                $vref1 = $f[4];
                $vope1 = $f[5];
                $vvar1 = $f[6];
                $vope2 = $f[7];
                $vvar2 = $f[8];
                
                $vref2 = $f[9];
                $vope3 = $f[10];
                $vvar3 = $f[11];
                $vope4 = $f[12];
                $vvar4 = $f[13];

                //$cantidad = $f[13];

                include 'formula_rejillas.php';
                $formula1 = number_format($variablev,2).$f[5].$f[6].$f[7].$f[8];
                $formula2 = number_format($variablev2,2).$f[10].$f[11].$f[12].$f[13];
                
                $perfiles = ($resultadov * $resultadov2)/ 6000;
                echo '<option value="'.$f[0].'">'.$f[3].' ('.$resultadov.')</option>';

                
            }
            
            
            break;
             case 30.2:
                 
               include 'cantidad_rejillas.php';
                 
            break;
            case 31:
            $id = $_GET['id'];
            $result = mysqli_query($con,"select * from producto_rejillas where id_pr='$id' ");
            $r = mysqli_fetch_array($result);
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

            echo json_encode($p);
            
            break;
         case 32:
            $id = $_GET['id'];
            $result = mysqli_query($con,"delete from producto_rejillas where id_pr='$id' ");
            $del = mysqli_error($con);
            if($del){
                $res = 'error '.$del;
            }else{
                $res = 'Se elimino con exito';
            }
            echo $res;
            break;
        case 33:
            $cod = $_GET['cod'];
            $fab_id = $_GET['fab_id'];
            $fab_cod = $_GET['fab_cod'];
            $fab_hoja = $_GET['fab_hoja'];
            $fab_rango = $_GET['fab_rango'];
            $fab_lado = $_GET['fab_lado'];
            if($fab_id==''){
                mysqli_query($con, "INSERT INTO `producto_instalacion` (`codigo`, `id_instalacion`, `hojas`, `calculo`, `rango`, `por`) "
                        . "VALUES ('$cod', '$fab_cod', '$fab_hoja', '$fab_lado', '$fab_rango', '$usuario');");
                $id = mysqli_insert_id($con);
                $msg = 'Se guardo correctamente';
                
            }else{
                
                mysqli_query($con, "UPDATE `producto_instalacion` SET `codigo` = '$cod', `id_instalacion` = '$fab_cod', `hojas` = '$fab_hoja', `calculo` = '$fab_lado', `rango` = '$fab_rango' WHERE `id_pi` = '$fab_id';");
                $id = $fab_id;
                 $msg = 'Se edito correctamente';
                
            }
            $p = array();
            $p[0] = $id;
            $p[1] = $msg;
            echo json_encode($p);
     
            
           
            
            
            break;
        case 34:
            $sistema = $_GET['sistema'];
            $p = explode(",", $sistema);
            $sistema = "'".$p[0]."','".$p[1]."','".$p[2]."','".$p[3]."','".$p[4]."'";
            

            $result = mysqli_query($con,"select * from  precios_instalaciones a,precios_instalaciones_sistemas b where a.id_precios=b.id_precios and b.sistema in ($sistema) ");
            echo '<option value="">Seleccione</option>';
            while ($r = mysqli_fetch_array($result)){
                echo '<option value="'.$r[0].'">'.$r['sistema'].'-'.$r[2].'</option>';
            }
            
            
            break;
            
        case 35:
            $cod = $_GET['cod'];
            $result = mysqli_query($con,"select * from  precios_instalaciones a, producto_instalacion b where a.id_precios=b.id_instalacion and b.codigo= '".$cod."' ");

            while ($r = mysqli_fetch_array($result)){
                
                $umb = "'".$r['umb']."'";
                $hoja = "'".$r['hojas']."'";
                $calculo = "'".$r['calculo']."'";
                $rango = "'".$r['rango']."'";
                echo '<tr>'
                        . '<td>'.$r['id_pi'].'</td>'
                        . '<td>'.$r['nom_insta'].'</td>'
                        . '<td>'.$r['calculo'].'</td>'
                        . '<td>'.$r['rango'].'</td>'
                        . '<td>'.$r['sistema_insta'].'</td>'
                        . '<td>'.$r['total_1'].'</td>'
        
                        . '<td><button onclick="pasar_instalacion('.$r['id_pi'].','.$r['id_instalacion'].','.$umb.','.$r['total_1'].','.$r['total_1'].','.$hoja.','.$calculo.','.$rango.')" data-toggle="modal" data-target="#modalmano">Editar</button></td>'
                        . '<td><button onclick="borrar_instalacion('.$r['id_pi'].')">Borrar</button></td></td>'
                . '</tr>';
            }
            
            break;
            case 36:
                $id = $_GET['id'];
            $result = mysqli_query($con,"delete from producto_instalacion where id_pi='$id' ");
            $del = mysqli_error($con);
            if($del){
                $res = 'error '.$del;
            }else{
                $res = 'Se elimino con exito';
            }
            echo $res;
        
              break;
        case 37:
            $cod = $_GET['cod'];
            $alf = $_GET['alf'];
            if($alf=='true'){
                $sql = mysqli_query($con,"SELECT * FROM productos a, grupos_referencia b where a.pro_referencia=b.referencia and modulo='Alfajia' ");

               $c=0;
                while($mostrar = mysqli_fetch_array($sql)){
                    $c +=1;
                        $item = $item+1;
                        $ref=$mostrar['pro_referencia'];
                        $ver2 = mysqli_query($con,"select pro_nombre from productos where  pro_referencia='$ref'  ");
                        $f = mysqli_fetch_row($ver2); 
                        $desopc = $f[0];

                      mysqli_query($con,"INSERT INTO `producto_perfiles` (`perfiles`,`modulo`,`name_opc`, `codigo`, `referencia`, `desc_referencia`, `formula`, `lado`, `lado_ref`, `ope1`, `var1`, `ope2`, `var2`, `cantidad`, `medidas`, `piezas`, `cadav`, `cadah`)"
                     . " VALUES ('Dinamico', 'Alfajia','$desopc', '$cod', '$ref', '$desopc', 'Si', 'Ancho', 'ancho', '-', '0', '-', '0', '1', '1', 'No', '0', '0');");
              
                      
                        
                        }
                        mysqli_query($con, "update producto set tipo_alfajia='true' where codigo='$cod' ");
                        echo 'Se agrego el listado de alfajias';
                
            }else{
                mysqli_query($con, "delete from producto_perfiles where codigo='$cod' and  modulo='Alfajia' ");
                mysqli_query($con, "update producto set tipo_alfajia='false' where codigo='$cod' ");
                echo 'Se elimino el listado de alfajias de la DT.';
                
                
            }
            break;
            case 38:
            $cod = $_GET['cod'];
            $alf = $_GET['alf'];
            if($alf=='true'){
                $sql = mysqli_query($con,"SELECT * FROM productos a, grupos_referencia b where a.pro_referencia=b.referencia and modulo='Rieles' ");

               $c=0;
                while($mostrar = mysqli_fetch_array($sql)){
                    $c +=1;
                        $item = $item+1;
                        $ref=$mostrar['pro_referencia'];
                        $ver2 = mysqli_query($con,"select pro_nombre from productos where  pro_referencia='$ref'  ");
                        $f = mysqli_fetch_row($ver2); 
                        $desopc = $f[0];

                      mysqli_query($con,"INSERT INTO `producto_perfiles` (`perfiles`,`modulo`,`name_opc`, `codigo`, `referencia`, `desc_referencia`, `formula`, `lado`, `lado_ref`, `ope1`, `var1`, `ope2`, `var2`, `cantidad`, `medidas`, `piezas`, `cadav`, `cadah`)"
                     . " VALUES ('Dinamico', 'Rieles','$desopc', '$cod', '$ref', '$desopc', 'Si', 'Ancho', 'ancho', '-', '0', '-', '0', '1', '1', 'No', '0', '0');");
              
                      
                        
                        }
                        mysqli_query($con, "update producto set tipo_riel='true' where codigo='$cod' ");
                        echo 'Se agrego el listado de rieles';
                
            }else{
                mysqli_query($con, "delete from producto_perfiles where codigo='$cod' and  modulo='Rieles' ");
                mysqli_query($con, "update producto set tipo_riel='false' where codigo='$cod' ");
                echo 'Se elimino el listado de rieles de la DT.';
                
                
            }
            break;
        case 39:
            $cod = $_GET['cod'];
            $linea = $_GET['linea'];
//            $res = mysqli_query($con,"select id_puesto,nombre_puesto,secuencia,id_hr from hojas_rutas a, puestos_trabajos b where a.codigo_pue=b.id_puesto and a.codigo_pro='$cod' order by a.secuencia asc ");
//            while($r = mysqli_fetch_array($res)){
//                echo '<tr><td>'.$r['id_puesto'].'</td>'
//                        . '<td>'.$r['nombre_puesto'].'</td>'
//                        . '<td><input type="number" id="sec'.$r['id_hr'].'" value="'.$r['secuencia'].'" style="width:50px" onchange="sec('.$r['id_hr'].')"></td>';
//            }
            $res = mysqli_query($con,"select id_puesto,nombre_puesto from puestos_trabajos where linea='$linea' ");
            while($r = mysqli_fetch_array($res)){
                $area = $r[0];
                $query = mysqli_query($con, "select * from hojas_rutas where codigo_pro='$cod' and codigo_pue='$area' ");
                $row = mysqli_fetch_array($query);
                if($row){
                    $stile='style="background:#E7E7E7" ';
                    $chec = 'checked';
                    $disable = '';
                    $ce= 0;
                }else{
                    $stile='';
                    $chec = '';
                    $disable = 'disabled';
                    $ce= 1;
                }
                echo '<tr '.$stile.'><td><input type="checkbox" '.$chec.' id="id'.$r['id_puesto'].'" onclick="addtra('.$r['id_puesto'].','.$ce.')"></td>'
                        . '<td>'.$r['nombre_puesto'].'</td>'
                        . '<td><input type="text" id="sec'.$row['id_hr'].'" value="'.$row['secuencia'].'" '.$disable.' style="width:30px;height:20px;font-size:9px" onchange="sec('.$row['id_hr'].')"></td>';
            }
            break;
        case 40:
            $cadena = $_GET['cad'];
            $del = $_GET['del'];
            $resultado2 = str_replace($del, "", $cadena);
            echo $resultado2;
            break;
        case 41:
            $cod = $_GET['cod'];
            $area = $_GET['area'];
            $c = $_GET['c'];  
             $linea = $_GET['linea'];
            if($c==1){
                $ver = mysqli_query($con, "select count(codigo_pro) from hojas_rutas where codigo_pro='$cod' and codigo_pue='$area' ");
                $v = mysqli_fetch_row($ver);
                if($v[0]==0){
                    mysqli_query($con,"insert into hojas_rutas (codigo_pro,codigo_pue) values ('$cod','$area')");
                    
                }
               //se agrega el area lavadora si pertenece a estas areas.
                if($area==2 || $area==3 ||$area==4 ||$area==5 ||$area==6 ||$area==8 ||$area==9 ||$area==10){
                    $verlav = mysqli_query($con, "select count(codigo_pro) from hojas_rutas where codigo_pro='$cod' and codigo_pue='7' ");
                    $vl = mysqli_fetch_row($verlav);
                    if($vl[0]==0){
                        mysqli_query($con,"insert into hojas_rutas (codigo_pro,codigo_pue) values ('$cod','7')");
                    }
                }
            }else{
                mysqli_query($con,"delete from hojas_rutas where codigo_pro='$cod' and codigo_pue='$area' ");
          
            }
            $verd = mysqli_query($con, "select count(codigo_pro) from hojas_rutas where codigo_pro='$cod' and codigo_pue='20' ");
                $vd = mysqli_fetch_row($verd);
                if($vd[0]==0){
                    mysqli_query($con,"insert into hojas_rutas (codigo_pro,codigo_pue) values ('$cod','20')");
                }
                
                 $res = mysqli_query($con,"select id_puesto from puestos_trabajos where linea='$linea' ");
                 $secuencia = 0;
                 while($r = mysqli_fetch_array($res)){
                     $pue = $r[0];
                     $verv = mysqli_query($con, "select count(codigo_pro) from hojas_rutas where codigo_pro='$cod' and codigo_pue='$pue' ");
                      $vv = mysqli_fetch_row($verv);
                      if($vv[0]!=0){
                          $secuencia += 1;
                           mysqli_query($con,"update hojas_rutas set secuencia='$secuencia' where codigo_pro='$cod' and codigo_pue='$pue' ");
                      }
            
                 }
            
            break;
        case 42:
            $id = $_GET['id'];
            $sec = $_GET['sec'];
            mysqli_query($con,"update hojas_rutas set secuencia='$sec' where id_hr='$id' ");
            
            break;
            case 43:
            $cod = $_GET['cod'];
            $nom = $_GET['nom'];
            mysqli_query($con,"update producto set producto='$nom' where codigo='$cod' ");
            
            break;
    
    
         
            }
mysqli_close($con);
