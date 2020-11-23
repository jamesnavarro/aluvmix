<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['radi'];
            $seg_idss=$_GET['seg_ids'];
            $nomoo=$_GET['nom_oo'];
            $nomcc=$_GET['nom_cc'];
            $diroo=$_GET['dir_oo'];
            $dircc=$_GET['dir_cc'];
            $tlll=$_GET['tell'];
            $depcc=$_GET['dep_cc'];
            $depoo=$_GET['dep_oo'];
            $ciucc=$_GET['ciu_cc'];
            $ciuoo=$_GET['ciu_oo'];
            $contacc=$_GET['conta_cc'];
            $encaroo=$_GET['encar_oo'];
            $telcc=$_GET['tel_cc'];
            $analioo=$_GET['anali_oo'];
            $contcc=$_GET['cont_cc'];
            $valioo=$_GET['vali_oo'];
            $emailcc=$_GET['email_cc'];
            $pagoo=$_GET['pag_oo'];
            $vendcc=$_GET['vend_cc'];
            $precss=$_GET['prec_ss'];
            $ivasee=$_GET['iva_see'];
            $cedtt=$_GET['ced_tt'];
            $nomtt=$_GET['nom_tt'];
            $exptt=$_GET['exp_tt'];
            $fechatt=$_GET['fecha_tt'];
            $descsee=$_GET['desc_see'];
            $registra=$_GET['reg_sist'];
            $fecha_s=$_GET['fec_sist'];
            $n_cot=$_GET['ncott'];
            $v_cot=$_GET['vercott'];
            $seg_estac=$_GET['estad_csegg'];
            $lns=$_GET['linseggs'];
            $adi=$_GET['adics'];
            $fesis=$_GET['fechasiss'];
            
            if($id==''){
                $ver=mysqli_query($con,"insert into seguimientos_cot (`id_relacion`,`nombre_obra`,`nombre_cliente`,`direccion_obra`,`direccion_client`,`tel_obra`,`depart_cliente`,`depart_obra`,`ciudad_client`,`ciudad_obra`,`contacto_client`,`encargado_obra`,`tel_cliente`,`analista_obra`,`telcontacto_cli`,`validez_obra`,`email_cliente`,`fpago_obra`,`vendedor_cli`,`vtotal_obra`,`iva_client`,`doc_temp`,`nom_temp`,`serv_temp`,`fec_servitemp`,`seguimiento_a`,`registrado_p`,`fecha_regis`,`numero_cotizacion_s`,`version_s`,`estado_cot_s`,`linea_s`,`fec_sistema`) values ('$seg_idss','$nomoo','$nomcc','$diroo','$dircc','$tlll','$depcc','$depoo','$ciucc','$ciuoo','$contacc','$encaroo','$telcc','$analioo','$contcc','$valioo','$emailcc','$pagoo','$vendcc','$precss','$ivasee','$cedtt','$nomtt','$exptt','$fechatt','$descsee','$registra','$fecha_s','$n_cot','$v_cot','$seg_estac','$lns','$fesis')");
                
                $query = mysqli_query($con,"select max(id_s) from seguimientos_cot");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_s)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update seguimientos_cot set estado_cot_s='$seg_estac', linea_s='$lns', nombre_obra='$nomoo', nombre_cliente='$nomcc', numero_cotizacion_s='$n_cot', version_s='$v_cot', fec_sistema='$fesis' where id_s='$id'");
                echo $id;
            }
                mysqli_query($con,"update cotizacion set seguimiento='1'  where id_cot='$seg_idss'");
          
            break;
            
            case 2:
                $id=$_GET['pr'];
                $segg=$_GET['segui_cc'];
                $rad=$_GET['radics'];
                $reg=$_GET['regg'];
                $f=$_GET['fecc'];
                
             if($id==''){
                $ver=mysqli_query($con,"insert into seguimientos(`observacion`,`id_s`,`usuario_seg`,`fecha_registros`) values ('$segg','$rad','$reg','$f')");
                
                $query = mysqli_query($con,"select max(id_seguimiento) from seguimientos");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_seguimiento)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update seguimientos set observacion='$segg'  where id_seguimiento='$id'");
                echo $id;
            }
            
            break;
            
            case 3:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM seguimientos where id_seguimiento='$id'"); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_seguimiento']; 
                 $p[1]=$fila['observacion'];
        
        
             echo json_encode($p); 
             exit();
            
            break;  
            case 4:
                $id=$_GET['id'];
                $estado=$_GET['estado'];
                mysqli_query($con,"update seguimientos_cot set estado_cot_s='$estado' where id_s='$id'");
                echo $id;
            break;
   
            case 5:
                $id=$_GET['id'];
                $id_cot=$_GET['id_cot'];
                $query = mysqli_query($con,"delete from seguimientos_cot where id_s='$id' ");
                mysqli_query($con,"delete from seguimientos where id_s='$id_cot' ");
                mysqli_query($con,"update cotizacion set seguimiento='0'  where id_cot='$id_cot'");
            break;
          case 6:
                $id=$_GET['id'];
                $query = mysqli_query($con,"delete from seguimientos where id_seguimiento='$id' ");
            break;
        
      
}

