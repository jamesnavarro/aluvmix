<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            
            $id=$_GET['id_pend'];
            $n_contra=$_GET['numero_cont'];
            $numecoti=$_GET['cotiz'];
            $version=$_GET['versio'];
            $numpedido=$_GET['pedido'];
            $nomcli=$_GET['nomcliente'];
            $idcli=$_GET['id_cli'];
            $nombra=$_GET['nomobra'];
            $objcont=$_GET['objeto'];
            //$fsh=$fecha.' '.$hora;
            $vend=$_GET['vendedor'];
            $cord=$_GET['cordina'];
            $supervis=$_GET['superv'];
            $instalacion=$_GET['intalacion'];
            $valr=$_GET['valor'];
            $anti=$_GET['anticip'];
            $resta=$_GET['sald'];
            $estad_con=$_GET['est_c'];
            $fpago=$_GET['forpago'];
            $diferente=$_GET['otros'];
            $firmas=$_GET['firm'];
            $fechapag=$_GET['fechap'];
            $obser=$_GET['observaci'];
            $registro_por=$_GET['por'];
            $fec_reg_cont=$_GET['fechareg'];
            $limi_pago=$_GET['pago_limi'];
            if($id==''){
               
                $ver=mysqli_query($con,"insert into informacion_obras (`numero_contrato`,`numero_cot`,`version`,`num_pedido`,`id_ter`,`nombre_cliente`,`nombre_obra`,`obj_contra`,`vendedor`,`cor_obra`,`sup_obra`,`instalacion`,`valor_cont`,`val_antici`,`saldo`,`estado_cont`,`for_pag`,`otros`,`recibe_cont`,`fecha_pago`,`observaciones`,`registrado_por`,`fecha_registro_obrac`,`limite_pago_c`) values ('$n_contra','$numecoti','$version','$numpedido','$idcli','$nomcli','$nombra','$objcont','$vend','$cord','$supervis','$instalacion','$valr','$anti','$resta','$estad_con','$fpago','$diferente','$firmas','$fechapag','$obser','$registro_por','$fec_reg_cont','$limi_pago')");
                
                $query = mysqli_query($con,"select max(id_inf) from informacion_obras");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_inf)'];
                echo $ultimo;
                 mysqli_query($con,"update cotizacion set id_contrato='$ultimo' where numero_cotizacion='$numecoti' and version='$version' ");
            }
            else{
             
                $ver = mysqli_query($con,"update informacion_obras set numero_contrato='$n_contra', numero_cot='$numecoti', version='$version', num_pedido='$numpedido', id_ter='$idcli', nombre_cliente='$nomcli', nombre_obra='$nombra', obj_contra='$objcont', vendedor='$vend', cor_obra='$cord', sup_obra='$supervis', instalacion='$instalacion', valor_cont='$valr', val_antici='$anti', saldo='$resta', estado_cont='$estad_con', for_pag='$fpago', otros='$diferente', recibe_cont='$firmas', fecha_pago='$fechapag', observaciones='$obser', registrado_por='$registro_por', fecha_registro_obrac='$fec_reg_cont', limite_pago_c='$limi_pago' where id_inf='$id'");
              
                echo $id;
                 mysqli_query($con,"update cotizacion set id_contrato='$id' where numero_cotizacion='$numecoti' and version='$version' ");
            }
            
            
        break;
        case 2:
            $id=$_GET['id_inf'];
            $query = mysqli_query($con,"select *,a.vendedor from informacion_obras a, cont_terceros b, cotizacion c where a.id_ter = b.id_ter and a.numero_cot = c.numero_cotizacion  and a.id_inf='$id' ");
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_inf'];
            $p[1]=$fila['nombre_obra'];
            $p[2]=$fila['nom_ter']; 
            $p[3]=$fila['obj_contra'];
            $p[4]=$fila['vendedor'];
            $p[5]=$fila['cor_obra'];
            $p[6]=$fila['sup_obra'];
            $p[7]=$fila['instalacion'];
            $p[8]=$fila['numero_cotizacion'];
            $p[9]=$fila['valor_cont'];
            $p[10]=$fila['val_antici'];
            $p[11]=$fila['saldo'];
            $p[12]=$fila['for_pag'];
            $p[13]=$fila['otros'];
            $p[14]=$fila['recibe_cont'];
            $p[15]=$fila['num_pedido'];
            $p[16]=$fila['version'];
            $p[17]=$fila['fecha_pago'];
            $p[18]=$fila['observaciones'];
            $p[19]=$fila['estado_cont'];
            $p[20]=$fila['id_ter']; 
            $p[21]=$fila['numero_contrato']; 
            $p[22]=$fila['registrado_por']; 
            $p[23]=$fila['fecha_registro_obrac']; 
            $p[24]=$fila['limite_pago_c'];
      
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
            
            case 5:
            $id=$_GET['id_cot'];
            $query = mysqli_query($con,"select * FROM cont_terceros a, cotizacion b where a.id_tercero = b.id_cot and b.id_cot='$id' ");
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_inf'];
            $p[1]=$fila['nombre_obra'];
            $p[2]=$fila['nom_ter']; 
            $p[3]=$fila['obj_contra'];
            $p[4]=$fila['vendedor'];
            $p[5]=$fila['cor_obra'];
            $p[6]=$fila['sup_obra'];
            $p[7]=$fila['instalacion'];
            $p[8]=$fila['numero_cotizacion'];
            $p[9]=$fila['valor_cont'];
            $p[10]=$fila['val_antici'];
            $p[11]=$fila['saldo'];
            $p[12]=$fila['for_pag'];
            $p[13]=$fila['otros'];
            $p[14]=$fila['recibe_cont'];
            $p[15]=$fila['num_pedido'];
            $p[16]=$fila['version'];
            $p[17]=$fila['fecha_pago'];
            $p[18]=$fila['observaciones'];
            $p[19]=$fila['estado_cont'];
            $p[20]=$fila['id_ter']; 
            $p[21]=$fila['numero_contrato']; 
            $p[22]=$fila['registrado_por']; 
            $p[23]=$fila['fecha_registro_obrac']; 
            $p[24]=$fila['limite_pago_c'];
      
            echo json_encode($p); 
            exit();
       break;
        case 6:
             $id = $_GET['id'];
             $query = mysqli_query($con,"update archivos_obras set estado_doc='1' where id_arc='$id' ");
             
            break;
        case 7:
            $id=$_GET['id'];
            $query = mysqli_query($con,"select * FROM archivos_obras where id_arc='$id' ");
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_arc'];
            $p[1]=$fila['id_contrato'];
            $p[2]=$fila['tipo_documento']; 
            $p[3]=$fila['sugerencias'];
            $p[4]=$fila['fecha_reg_arc'];
            $p[5]=$fila['registr_arc_por'];
            $p[6]=$fila['estado_doc'];
            echo json_encode($p); 
            exit();
            break;
        //insertar de CONTACTOS
       
        case 9:
            $id=$_GET['id'];
            $query = mysqli_query($con,"select * FROM sis_contacto where id_contacto='$id' ");
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_contacto'];
            $p[1]=$fila['nombre_cont'];
            $p[2]=$fila['celular']; 
            $p[3]=$fila['email1'];
            $p[4]=$fila['area_user'];
            $p[5]=$fila['notas'];
            $p[6]=$fila['quien_registra'];
            $p[7]=$fila['fecha_registro'];
            $p[8]=$fila['id_rel_tercero'];
            echo json_encode($p); 
            exit();
            break;
        
          case 10:
            $id=$_GET['id_nuevocont'];
            $nom_nuevoc=$_GET['nom_nuevocon'];
            $tel_nuevocon=$_GET['tel_nuevocont'];
            $emai_nuevoco=$_GET['emai_nuevocont'];
            $carg_nuevoc=$_GET['carg_nuevocont'];
            $suge_nuevoc=$_GET['suge_nuevocon'];
            $guardo_nue=$_GET['guardo_nuevo'];
            $fech_nuevocon=$_GET['fech_nuevocont'];
            $cruse_rel=$_GET['cruse_relaci'];
            //$fsh=$fecha.' '.$hora;
            if($id==''){
                $ver=mysqli_query($con,"insert into sis_contacto (`nombre_cont`,`celular`,`email1`,`area_user`,`notas`,`quien_registra`,`fecha_registro`, `id_rel_tercero`)"
                        . "                         values ('$nom_nuevoc','$tel_nuevocon','$emai_nuevoco','$carg_nuevoc','$suge_nuevoc','$guardo_nue','$fech_nuevocon','$cruse_rel')");
                
                $query = mysqli_query($con,"select max(id_contacto) from sis_contacto");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_contacto)'];
                echo $ultimo;
               // echo $ver;
            }
            else{
             
                $ver = mysqli_query($con,"update sis_contacto set nombre_cont='$nom_nuevoc', celular='$tel_nuevocon', email1='$emai_nuevoco', area_user='$carg_nuevoc', notas='$suge_nuevoc', quien_registra='$guardo_nue', fecha_registro='$fech_nuevocon' where id_contacto='$id'");
              
                echo $id;
            }
            
        break;
        case 11:
            
            $id=$_GET['id_lla'];
            $asunto=$_GET['asunto'];
            $fecha=$_GET['fecha'];
            $hora=$_GET['hora'];
            $asi=$_GET['asi'];
            $aviso=$_GET['aviso'];
            $desc=$_GET['desc'];
            $llamada=$_GET['llamada'];
            $est_lla=$_GET['est_lla'];
            $id_con=$_GET['id_con'];
            $nom_con=$_GET['nom_con'];
            $rel=$_GET['rel'];
            $obra=$_GET['obra'];
            $fsh=$fecha.' '.$hora;
            
            if($id==''){
               
                $ver=mysqli_query($con,"insert into actividad (`prioridad`, `id_seleccionado`,`Subject`,`Description`,`StartTime`,`EndTime`,`estado`,`id_contacto`,`user`, `tarea`, `aviso`, `reg_user`, `id_tercero`)"
                        . "        values ('$llamada','$obra','$asunto','$desc','$fsh','$fsh','$est_lla','$id_con','$asi','Llamada','$aviso','".$_SESSION['k_username']."','$rel')");
                
                $query = mysqli_query($con,"select max(Id) from actividad");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(Id)'];
                echo $ultimo;
                //echo $ver;
            }
            else{
             
                $ver = mysqli_query($con,"update actividad set Subject='$asunto',Description='$desc',StartTime='$fsh',estado='$est_lla',prioridad='$llamada',aviso='$aviso',user='$asi',EndTime='$fsh' where Id='$id'");
              
                echo $id;
            }
            
        break;
        
           case 12:
             $id = $_GET['id'];
             $query = mysqli_query($con,"delete from actividades where Id='$id' ");
             
            break;
        
           case 13:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * ,a.estado FROM actividad a ,sis_contacto b where a.id_contacto=b.id_contacto and a.Id='".$_GET['id']."' ");
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['Id'];
            $p[1]=$fila['Subject'];
            $p[2]=$fila['Description'];
            $fec = substr($fila['StartTime'],0,10);
            $hon = substr($fila['StartTime'],11);
            $p[3]=$fec;
            $p[4]=$fila['estado'];
            $p[5]=$fila['prioridad'];
            $p[6]=$fila['id_contacto'];
            $p[7]=$fila['nombre_cont'];
            $p[8]=$hon;
            $p[9]=$fila['aviso'];
            echo json_encode($p); 
            exit();
     break;
        case 14:
             $cot=$_GET['cot'];
             $ver=$_GET['ver'];
             $rad=$_GET['rad'];
             $query = mysqli_query($con,"select id_cot, id_contrato from cotizacion where numero_cotizacion='$cot' and version='$ver' and estado='Aprobado' ");
             $q = mysqli_fetch_row($query);
             $id = $q[0];
             $con = $q[1];
             if($id){
                 if($con==0){
                      mysqli_query($con,"update cotizacion set id_contrato='$rad' where numero_cotizacion='$cot' and version='$ver' ");
                     echo 'Se agrego con exito la cotizacion al contrato No.'.$rad;
                 }else{
                     echo 'Ya esta cotizacion esta agregada al contrato No. '.$con;
                 }
             }else{
                 echo 'Esta cotizacion no se encuentra o no esta aprobada';
             }
                 
            break;
            
       case 15:
            
            $id=$_GET['rad_ped_f'];
            $factura_remi=$_GET['remi_factura'];
            $numped_fact=$_GET['num_pedifac'];
            $fact_fp=$_GET['num_fpls'];
            $factura_totl=$_GET['fact_total'];
            $rete_facturan=$_GET['rete_factu'];
            $reten_icafactu=$_GET['rete_icafac'];
            $rete_ivafactu=$_GET['rete_ivafact'];
            $can_despafactu=$_GET['cant_desfsact'];
            $reten_vlrfac=$_GET['rete_valorfact'];
            $otro_descuenf=$_GET['otro_desfact'];
            $suger_factn=$_GET['sug_nuefact'];
            $estad_factunu=$_GET['est_nuefact'];
            $plazo_dia=$_GET['dias_hasta'];
            $registro_porfac=$_GET['re_nuefact'];
            $fecha_regfact=$_GET['fecha_nuefact'];
            $rel_cont_fac=$_GET['contra'];
            $rel_ter_nuefa=$_GET['tercer'];
            $r_porcn_rete=$_GET['porcenrete'];
            $r_porcn_rica=$_GET['porcenrica'];
            $r_porc_iva=$_GET['porcenriva'];
            $r_porc_garant=$_GET['porcengaran'];
            if($id==''){
               
                $ver=mysqli_query($con,"insert into pagos_realizados (`remision_fac`,`pedido_fact`,`factura_fp`,`valor_total_fact`,`retefuente_fact`,`rete_ica_fact`,`rete_iva_fact`,`cnt_desp_fact`,`valor_retegarantia_f`,`otros_desc_fact`,`observ_factu`,`estado_nue_fact`,`fecha_pagada`,`registra_nom_fact`,`fecha_regs_factura`,`id_contrato_fact`,`id_cliente_fact`,`porc_fuente_fac`,`porc_ica_fac`,`porc_iva_fact`,`porc_garantia_fact`)"
                        . " values ('$factura_remi','$numped_fact','$fact_fp','$factura_totl','$rete_facturan','$reten_icafactu','$rete_ivafactu','$can_despafactu','$reten_vlrfac','$otro_descuenf','$suger_factn','$estad_factunu','$plazo_dia','$registro_porfac','$fecha_regfact','$rel_cont_fac','$rel_ter_nuefa','$r_porcn_rete','$r_porcn_rica','$r_porc_iva','$r_porc_garant')");
                
                $query = mysqli_query($con,"select max(id_pagos_f) from pagos_realizados");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_pagos_f)'];
                
                
                echo $ultimo;
//                 mysqli_query($con,"update cotizacion set id_contrato='$ultimo' where numero_cotizacion='$numecoti' and version='$version' ");
            }
            else{
             
                $ver = mysqli_query($con,"update pagos_realizados set remision_fac='$factura_remi', pedido_fact='$numped_fact', factura_fp='$fact_fp', valor_total_fact='$factura_totl', retefuente_fact='$rete_facturan', rete_ica_fact='$reten_icafactu', rete_iva_fact='$rete_ivafactu', cnt_desp_fact='$can_despafactu', valor_retegarantia_f='$reten_vlrfac', otros_desc_fact='$otro_descuenf', observ_factu='$suger_factn', estado_nue_fact='$estad_factunu', fecha_pagada='$plazo_dia', registra_nom_fact='$registro_porfac', fecha_regs_factura='$fecha_regfact', id_contrato_fact='$rel_cont_fac', id_cliente_fact='$rel_ter_nuefa', porc_fuente_fac='$r_porcn_rete', porc_ica_fac='$r_porcn_rica', porc_iva_fact='$r_porc_iva', porc_garantia_fact='$r_porc_garant' where id_pagos_f='$id'");
              
                echo $id;
                
            }
        break;   
        
        
       case 16:
           
            $id=$_GET['id'];
            $query = mysqli_query($con,"select * FROM pagos_realizados where id_pagos_f='$id' ");
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_pagos_f'];
            $p[1]=$fila['remision_fac'];
            $p[2]=$fila['pedido_fact']; 
            $p[3]=$fila['factura_fp'];
            $p[4]=$fila['valor_total_fact'];
            $p[5]=$fila['retefuente_fact'];
            $p[6]=$fila['rete_ica_fact'];
            $p[7]=$fila['rete_iva_fact'];
            $p[8]=$fila['cnt_desp_fact'];
            $p[9]=$fila['valor_retegarantia_f'];
            $p[10]=$fila['otros_desc_fact'];
            $p[11]=$fila['observ_factu'];
            $p[12]=$fila['estado_nue_fact'];
            $p[13]=$fila['fecha_pagada'];
            $p[14]=$fila['porc_fuente_fac'];
            $p[15]=$fila['porc_ica_fac'];
            $p[16]=$fila['porc_iva_fact'];
            $p[17]=$fila['porc_garantia_fact'];
          
            echo json_encode($p); 
            exit();
       break;
            
            
            
            
            
            
            
            
            
            
            
      

}