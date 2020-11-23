<?php
include('../../../modelo/conexionv1.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $est=$_GET['est'];
            $cod=$_GET['cod'];
            $pue=$_GET['des'];
            $tra=$_GET['tra'];
            $cp=$_GET['cp'];
            $cc=$_GET['cc'];
            $lin=$_GET['lin'];
            
            $mo=$_GET['mo'];
            $umb1=$_GET['umb1'];
            $maq=$_GET['maq'];
            $umb2=$_GET['umb2'];
            $cif=$_GET['cif'];
            $umb3=$_GET['umb3'];
            $und=$_GET['und'];
            $pro=$_GET['pro'];
            $umb4=$_GET['umb4'];
            
            
            $aguaa=$_GET['aguap'];
            $luzz=$_GET['luzp'];
            $gass=$_GET['gasp'];
            $intr=$_GET['intp'];
            
            
            
            
            
            
            
            $result = mysqli_query($con2,"select count(*) from subproceso where id_subpro='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con2,"insert into subproceso (`codigo_cc`,`codigo_cp`,`nombre_subpro`,`asignacion`,`estado`,`usuario`,`valor_mo`,`umb_mo`,`valor_maq`,`umb_maq`,`valor_cif`,`umb_cif`,`valor_unidad`,`producido`,`umb_pro`,`agua`,`luz`,`gas`,`internet` )"
                        . " values ('$cc','$cp','$pue','$tra','$est','$usuario','$mo','$umb1','$maq','$umb2','$cif','$umb3','$und','$pro','$umb4','$aguaa','$luzz','$gass','$intr')");
               echo  mysqli_error($con2);
            }
            else{
                mysqli_query($con2,"update subproceso set codigo_cc='$cc',codigo_cp='$cp',asignacion='$tra',"
                        . " nombre_subpro='$pue', estado='$est', usuario='$usuario', "
                        . "valor_mo='$mo', umb_mo='$umb1', valor_maq='$maq', umb_maq='$umb2', valor_cif='$cif', umb_cif='$umb3', valor_unidad='$und', producido='$pro', umb_pro='$umb4', agua='$aguaa', luz='$luzz', gas='$gass', internet='$intr' where id_subpro='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con2,"SELECT * FROM subproceso a, centrocostos b where a.codigo_cc=cen_codigo and a.id_subpro='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_subpro']; 
                 $p[1]=$fila['nombre_subpro'];
                 $p[2]=$fila['sede_sub'];
                 $p[3]=$fila['estado'];
                 $p[4]=$fila['codigo_cc'];
                 $p[5]=$fila['asignacion'];
                 $p[6]=$fila['codigo_cp'];
                 $p[7]=$fila['cen_nombre'];
                 $p[8]=$fila['valor_mo'];
                 $p[9]=$fila['umb_mo'];
                 $p[10]=$fila['valor_maq'];
                 $p[11]=$fila['umb_maq'];
                 $p[12]=$fila['valor_cif'];
                 $p[13]=$fila['umb_cif'];
                 $p[14]=$fila['valor_unidad'];
                 $p[15]=$fila['producido'];
                 $p[16]=$fila['umb_pro'];
                 $p[17]=$fila['agua'];
                 $p[18]=$fila['luz'];
                 $p[19]=$fila['gas'];
                 $p[20]=$fila['internet'];
                 
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con2,"delete from subproceso where id_subpro='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                  $query = mysqli_query($con2,"SELECT * FROM subproceso a, centrocostos b where a.codigo_cc=cen_codigo and a.id_subpro='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_subpro']; 
                 $p[1]=$fila['nombre_subpro'];
                 $p[2]=$fila['linea'];
                 $p[3]=$fila['estado'];
                 $p[4]=$fila['codigo_cc'];
                 $p[5]=$fila['asignacion'];
                 $p[6]=$fila['codigo_cp'];
                 $p[7]=$fila['cen_nombre'];
                 $p[8]=$fila['valor_mo'];
                 $p[9]=$fila['umb_mo'];
                 $p[10]=$fila['valor_maq'];
                 $p[11]=$fila['umb_maq'];
                 $p[12]=$fila['valor_cif'];
                 $p[13]=$fila['umb_cif'];
                 $p[14]=$fila['valor_unidad'];
                 $p[15]=$fila['producido'];
                 $p[16]=$fila['umb_pro'];
                 $p[17]=$fila['agua'];
                 $p[18]=$fila['luz'];
                 $p[19]=$fila['gas'];
                 $p[20]=$fila['internet'];
        
            echo json_encode($p); 
            exit();
            break;
        case 5:
            $id=$_GET['pue'];
            $result = mysqli_query($con2, "select * from clases_actividad a,puesto_actividades b where a.act_codigo=b.act_codigo and a.act_activo=0 and b.id_puesto='$id'");
            $total = 0;
            while ($r = mysqli_fetch_array($result)){
                $codigo = "'".$r[0]."'";
 
                $total += $r['valor_std'];
                echo '<tr>'
                . '<td>'.$r[0].'</td>'
                        . '<td>'.$r[1].'</td>'
                        . '<td>'.$r[4].'</td>'
                        . '<td><input type="text" id="valor'.$r[0].'" value="'.$r['valor_std'].'" style="width:100%" ></td>'
                        . '<td><button onclick="add_actividad('.$codigo.')">Up</button> <button onclick="del_actividad('.$r['id_pa'].')"> - </button></td>'
                        . '</tr>';
            }
            echo '<tr><td></td><td></td><td></td><td><input type="text" id="valort" style="width:100%" value="'.$total.'"></td></tr>';
            mysqli_query($con2, "update subproceso set valor_unidad='$total' where id_subpro='$id' ");
            break;
        case 6:
                $cod=$_GET['cod'];
                $cos=$_GET['cos'];
                $pue=$_GET['pue'];
                $result = mysqli_query($con2, "select count(*) from puesto_actividades where id_subpro='$pue' and act_codigo='$cod' ");
                $r = mysqli_fetch_row($result);
                if($r[0]==0){
                    mysqli_query($con2, "insert into puesto_actividades(id_puesto, act_codigo, valor_std) values ('$pue','$cod','$cos') ");
                    echo mysqli_error($con2);
                }else{
                    mysqli_query($con2, "update puesto_actividades set valor_std='$cos' where id_puesto='$pue' and act_codigo='$cod' ");
                    echo mysqli_error($con2);
                }
            break;
        case 7:
            $cod=$_GET['cod'];
            mysqli_query($con2, "delete from puesto_actividades where id_pa='$cod' ");
            
            break;
                case 8:
            $id=$_GET['pue'];
            $result = mysqli_query($con2, "select * from puestos_parametros a, empleados b where a.cedula=b.EMP_CEDULA and b.EMP_ESTADO=0 and a.id_puesto='$id'");
            $total = 0;
            while ($r = mysqli_fetch_array($result)){
                $codigo = "'".$r[0]."'";
 
                $total += $r[9];
                echo '<tr>'
                . '<td>'.$r[2].'</td>'
                        . '<td>'.$r[3].'</td>'
                        . '<td>'.$r[4].'</td>'
                        . '<td>'.$r[5].'</td>'
                        . '<td>'.$r[6].'</td>'
                        . '<td><input type="text" id="por'.$r[0].'" value="'.$r[7].'" onchange="up_mo('.$r[0].')" style="width:50px" >%</td>'
                        . '<td><input type="text" id="salario'.$r[0].'" value="'.$r[8].'" style="width:50px" disabled></td>'
                        . '<td>'.$r[9].'</td>'
                        . '<td><button onclick="del_mo('.$r[0].')"> - </button></td>'
                        . '</tr>';
            }
            echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><input type="text" id="valort" style="width:100%" value="'.$total.'"></td></td><td></tr>';
            mysqli_query($con2, "update subproceso set valor_mo='$total' where id_subpro='$id' ");
            break;
        case 9:
                $cedula=$_GET['cedula'];
                $nombre=$_GET['nombre'];
                $cargo=$_GET['cargo'];
                $mano=$_GET['mano'];
                $cp=$_GET['cp'];
                $por=$_GET['por'];
                $salario=$_GET['salario'];
                $valorl=$_GET['valor'];
                $pue=$_GET['puesto'];
                $query = mysqli_query($con2, "select * from puestos_parametros where cedula='$cedula' and id_puesto='$pue'");
                $r = mysqli_fetch_row($query);
                if($r){
                    mysqli_query($con2,"update puestos_parametros set porcentaje='$por', mano='$mano',valor='$valorl' where  cedula='$cedula' and id_puesto='$pue'");
                    $error = mysqli_error($con2);
                    $msg = 'Se edito con exito'.$error;
                }else{
                    mysqli_query($con2, "insert into puestos_parametros (id_puesto,cedula,empleado,cargo,mano,sede,porcentaje,salario,valor,estado)"
                        . " values ('$pue','$cedula','$nombre','$cargo','$mano','$cp','$por','$salario','$valorl','0')");
                      $error = mysqli_error($con2);
                      $msg = 'Se Registro con exito'.$error;
                }
                echo $msg;
            
            
            break;
        case 10:
            $id = $_GET['cod'];
            mysqli_query($con2,"delete from puestos_parametros where id='$id' ");
            break;
         case 11:
            $id = $_GET['id'];
             $por = $_GET['por'];
             $sal = $_GET['sal'];
             $val = ($por /100)*$sal;
            mysqli_query($con2,"update puestos_parametros set porcentaje='$por',valor='$val' where id='$id' ");
            break; 
        
                case 12:
                     $id = $_GET['id'];
                  $query = mysqli_query($con2,"SELECT a.id_cuenta, b.descripcion, b.valor_total, a.fecha FROM cuenta_cobro a, cuenta_cobro_items b where a.id_cuenta=b.id_cuenta and a.operacion='CIF' and a.puesto=$id "); //consultA modificada por navabla
                   $ctar=0;
                    $gtotal=0;
                  while ($fila = mysqli_fetch_array($query)){
                       $ctar=$ctar+1;
                       $gtotal=$gtotal + $fila[2];
                     echo $fila[1];
                     echo '<tr>'
                       . '<td>'.$fila[0].'</td>'
                       . '<td>'.$fila[1].'</td>'                      
                       . '<td>'.$fila[3].'</td>'
                       . '<td style="text-align:right">'.$fila[2].'</td>';
                     
                 }
                 echo
                  '<tr>'
                         . '<td colspan="3" style="text-align:right"><b>Total  CIF</b></td>'
                         . '<td style="text-align:right">'.$gtotal.'</td>';
            break;
             case 13:
                     $id = $_GET['id'];
                  $query = mysqli_query($con2,"SELECT a.id_cuenta, b.descripcion, b.valor_total, a.fecha FROM cuenta_cobro a, cuenta_cobro_items b where a.id_cuenta=b.id_cuenta and a.operacion='MAQ' and a.puesto=$id "); //consultA modificada por navabla
                
                  $con2tar=0;
                  $grantotal=0;
                  while ($fila = mysqli_fetch_array($query)){
                       $con2tar=$con2tar+1;
                       $grantotal=$grantotal + $fila[2];
                     echo $fila[1];
                     echo '<tr>'
                       . '<td>'.$fila[0].'</td>'
                       . '<td>'.$fila[1].'</td>'
                       . '<td>'.$fila[3].'</td>'
                       . '<td style="text-align:right">'.$fila[2].'</td>';
        
                 }
               
                 echo
                 '<tr>'
                         . '<td colspan="3" style="text-align:right"><b>Total  MAQ</b></td>'
                         . '<td style="text-align:right">'.$grantotal.'</td>';
                 
            break;
        case 14:
               $id=$_GET['id'];
                  $query = mysqli_query($con2,"SELECT * FROM puestos a, puestos_relacion b where a.id_puesto=b.id_puesto and b.id_area='$id' "); //consultA modificada por navabla
                 while($fila = mysqli_fetch_array($query)){
                     echo ' <tr>
              <td><input type="text" id="vsede'.$fila['id_puesto'].'" value="'.$fila['sede'].'" style="width:100%" disabled></td>
              <td><input type="text" id="vmo'.$fila['id_puesto'].'" value="'.$fila['valmo'].'" style="width:100%" disabled></td>
              <td><input type="text" id="" style="width:100%" value="'.$fila['um1'].'"disabled></td>
              <td><input type="text" id="vma'.$fila['id_puesto'].'"  value="'.$fila['valmq'].'" disabled style="width:100%"></td>
              <td><input type="text" id="" style="width:100%"  value="'.$fila['um2'].'" disabled></td>
              <td><input type="text" id="vci'.$fila['id_puesto'].'"  value="'.$fila['valcif'].'" disabled style="width:100%"></td>
              <td><input type="text" id="" style="width:100%"  value="'.$fila['um3'].'" disabled></td>
                        <td><button onclick="delprecio('.$fila['id_pr'].')">Quitar</button></td>
                        </tr>';
                 }
            break;
        case 15:
            $id=$_GET['id'];
            $idarea=$_GET['idarea'];
            $query = mysqli_query($con2, "select count(*) from puestos_relacion where id_puesto='$id' and id_area='$idarea'");
                $r = mysqli_fetch_row($query);
                if($r[0]==0){
                   mysqli_query($con2,"INSERT INTO `puestos_relacion` (`id_puesto`, `id_area`) "
                           . "VALUES ('$id', '$idarea')");
                   echo 'Se agrego con exito';
                }else{
                    echo 'Ya esta area esta asociada con este puesto de trabajo';
                }
                   
               
            
            break;
        case 16:
            $id=$_GET['id'];
    
   
                   mysqli_query($con2,"delete from `puestos_relacion` where id_pr='$id' ");
                   echo 'Se elimino con exito';
               
            
            break;
        
        
        
        
        
        
        
        
        
            }

