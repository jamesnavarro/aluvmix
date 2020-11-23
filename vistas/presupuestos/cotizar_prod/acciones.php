<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idcotn'];
            $linprodc=$_GET['lineaprodnc'];
            $codc=$_GET['codnupronc'];
            $anchoc=$_GET['ancnupnc'];
            $nombrec=$_GET['nom_pronuenc'];
            $altuc=$_GET['alt_nuepnc'];
            $refec=$_GET['ref_pronuenc'];
            $kitc=$_GET['kit_nuenc'];
            $perfoc=$_GET['perfo_pronuenc'];
            $boquec=$_GET['boque_nuepnc'];
            $alcuc=$_GET['alcu_pronuec'];
            $alvenc=$_GET['alven_nuepnc'];
            $modnc=$_GET['modn_nuepnc'];
            $ancfc=$_GET['ancf_pronuenc'];
            $alvec=$_GET['alvendos_nuepc'];
            $lamic=$_GET['lami_nuepnc'];
            $ancmaxc=$_GET['ancmax_pronuenc'];
            $altmaxcl=$_GET['altmax_nuepnc'];
            $ok= $_GET['ok_idk'];
            $anulado= $_GET['apr_id'];
            
            if($id==''){
                $ver=mysqli_query($con,"insert into producto (`linea`,`codigo`,`ancho`,`producto`,`alto`,`referencia_p`,`kit`,`perforacion`,`boquete`,`med_adicional`,`altura_v_c`,`hoja`,`ancho_adicional`,`ancho_v_c`,`laminas`,`ancho_maximo`,`alto_maximo`,`ok`,`estado_producto`) values ('$linprodc','$codc','$anchoc','$nombrec','$altuc','$refec','$kitc','$perfoc','$boquec','$alcuc','$alvenc','$modnc','$ancfc','$alvec','$lamic','$ancmaxc','$altmaxcl','$ok','$anulado')");
                
                $query = mysqli_query($con,"select max(id_p) from producto");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_p)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update producto set linea='$linprodc',codigo='$codc',ancho='$anchoc',producto='$nombrec',alto='$altuc',referencia_p='$refec',kit='$kitc',perforacion='$perfoc',boquete='$boquec',med_adicional='$alcuc',altura_v_c='$alvenc',hoja='$modnc',ancho_adicional='$ancfc',ancho_v_c='$alvec',laminas='$lamic',ancho_maximo='$ancmaxc',alto_maximo='$altmaxcl',ok='$ok',estado_producto='$anulado' where id_p='$id'");
                echo $id;
            }
             if($kitc==0){
             $k = 'No';
             
         }else{
             $k= 'Si';
             
         }
          
         
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM producto where id_p='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_p']; 
                 $p[1]=$fila['linea'];
                 $p[2]=$fila['codigo'];
                 $p[3]=$fila['ancho'];
                 $p[4]=$fila['producto'];
                 $p[5]=$fila['alto'];
                 $p[6]=$fila['referencia_p'];
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
                     $btn_ok = '<button class="btn btn-danger" onclick="okr('.$p[0].','.$p[18].')">OK</button>';
                 }else{
                     $btn_ok = '<button class="btn btn-success" onclick="okr('.$p[0].','.$p[18].')"><i class="ace-icon fa fa-check "data-dismiss="modal"></i>OK</button>';
                 }
                 $p[19]=$btn_ok;
                 
                 
                $p[20]=$fila['estado_producto'];
                 
               if($fila['estado_producto']=='1'){
                     $btn_apro = '<button class="btn btn-danger" onclick="anular('.$p[0].','.$p[20].')">Producto Inactivo</button>';
                 }else{
                     $btn_apro = '<button class="btn btn-success" onclick="anular('.$p[0].','.$p[20].')"><i class="ace-icon fa fa-check "data-dismiss="modal"></i>Producto activo</button>';
                 }
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
                 
                  $p[28]= '<center><img src="../producto/'.$fila['ruta'].'" style="width: 100px; height: 100px;"/></center>' ;
                  $p[29]='<center><img src="../producto/'.$fila['ruta2'].'" style="width: 100px; height: 100px;"/></center>' ;
                 
                 
                 
                 
                 
                 
                 
                 
                  
            echo json_encode($p); 
            exit();
            
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
                
            
         
            }

