<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idll'];
            $valorl=$_GET['valdoll'];
            $precl=$_GET['precdoll'];
            $varil=$_GET['varipril'];
            $preacl=$_GET['preactl'];
            $fecl=$_GET['fechactul'];
            if($id==''){
                $ver=mysqli_query($con,"insert into dolares (`lma`,`precio_dolar`,`prima`,`precio_actual`,`fecha_reg_dolar`) values ('$valorl','$precl','$varil','$preacl','$fecl')");
                
                $query = mysqli_query($con,"select max(id_dolar) from dolares");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_dolar)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update dolares set lma='$valorl',precio_dolar='$precl',prima='$varil',precio_actual='$preacl',fecha_reg_dolar='$fecl' where id_dolar='$id'");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM dolares where id_dolar='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_dolar']; 
                 $p[1]=$fila['lma'];
                 $p[2]=$fila['precio_dolar'];
                 $p[3]=$fila['prima'];
                 $p[4]=$fila['precio_actual'];
                 $p[5]=$fila['fecha_reg_dolar'];
                  
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from dolares where id_dolar='$id' ");
            break;
        case 4:
            $idp=$_GET['idp'];
            $cod=$_GET['cod'];
            $sistema=$_GET['sistema'];
            $linea=$_GET['linea'];
            $codigo=$_GET['digitado'];

            //echo $cod;   
            $maximo =  mysqli_query($con, "SELECT max(id_p)+1 FROM producto");
            $ma = mysqli_fetch_row($maximo);
            //echo $m[0]. mysqli_error($con);
            
            if($linea=='Vidrio'){
                $codigo = 'VD'.$ma[0];
            }else if($linea=='Acero'){
                $codigo = 'AC'.$ma[0];
            }else{
                $codigo = $codigo;
            }
            //echo $codigo;
            
            $busqueda = mysqli_query($con,"SELECT count(id_p) FROM producto where codigo='$codigo' "); //consultA modificada por navabla
            $b = mysqli_fetch_array($busqueda);
            if($b[0]>0){
                $msg = 'Ya este codigo existe';
                $error = 1;
            }else{
                // 1. se consulta el producto
            $query = mysqli_query($con,"SELECT * FROM producto where codigo='$cod' "); //consultA modificada por navabla
            $f = mysqli_fetch_array($query);
                //2. se inserta el producto para la llave foranea
            
            $RES = mysqli_query($con,"select count(*) from productos where pro_referencia='$codigo' ");
                $re = mysqli_fetch_row($RES);
                if($re[0]==0){     
                     $re = mysqli_query($con, "insert into productos (pro_referencia,pro_nombre,pro_undmed,clase,grupo,linea,usuario,cod_empresa,sistema)"
                     . "values ('$codigo','".$f['producto']."','und','00','0','$linea','$usuario','TEMPLADOS','$sistema')");
                     mysqli_error($con);
                }
                
               mysqli_query($con, "insert into producto (`ruta`,`tipo_rod`,`anchocfizq`,`anchocfder`,`altocfsup`,`altocfinf`, `espaciador`,`interlayer`,`configuracion`,`tipo`,`sistemas`,`tipo_vidrio`,`espesores`,`tipo_riel`,`tipo_alfajia`,`tipo_rejilla`,`tipo_cierre`,`cuerpo_fijo`,`linea`,`codigo`,`ancho`,`producto`,`alto`,`kit`,`perforacion`,`boquete`,`med_adicional`,`altura_v_c`,`hoja`,`ancho_adicional`,`ancho_v_c`,`laminas`,`ancho_maximo`,`alto_maximo`,`ok`,`estado_producto`,`cod_empresa`,`usuario`) "
               . " values ('".$f['ruta']."','".$f['tipo_rod']."','".$f['anchocfizq']."','".$f['anchocfder']."','".$f['altocfsup']."','".$f['altocfinf']."','".$f['espaciador']."','".$f['interlayer']."','".$f['configuracion']."','".$f['tipo']."','".$f['sistemas']."','".$f['tipo_vidrio']."','".$f['espesores']."','".$f['tipo_riel']."','".$f['tipo_alfajia']."','".$f['tipo_rejilla']."','".$f['tipo_cierre']."','".$f['cuerpo_fijo']."','".$f['linea']."','".$codigo."','".$f['ancho']."','COPIA-".$f['producto']."','".$f['alto']."','".$f['kit']."','".$f['perforacion']."','".$f['boquete']."','".$f['med_adicional']."','".$f['altura_v_c']."','".$f['hoja']."','".$f['ancho_adicional']."','".$f['ancho_v_c']."','".$f['laminas']."','".$f['ancho_maximo']."','".$f['alto_maximo']."','".$f['ok']."','".$f['estado_producto']."','".$f['cod_empresa']."','".$f['usuario']."')");
           
               //3.se consulta los perfiles e inserta
               $resultper = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' ");
            while($a = mysqli_fetch_array($resultper)){
              
                mysqli_query($con,"INSERT INTO `producto_perfiles` (`perfiles`,`modulo`,`name_opc`, `codigo`, `referencia`, `desc_referencia`, `formula`, `lado`, `lado_ref`, `ope1`, `var1`, `ope2`, `var2`, `cantidad`, `medidas`, `piezas`, `cadav`, `cadah`)"
                    . " VALUES ('".$a['perfiles']."', '".$a['modulo']."','".$a['name_opc']."', '".$codigo."', '".$a['referencia']."', '".$a['desc_referencia']."', '".$a['formula']."', '".$a['lado']."', '".$a['lado_ref']."', '".$a['ope1']."', '".$a['var1']."', '".$a['ope2']."', '".$a['var2']."', '".$a['cantidad']."', '".$a['medidas']."', '".$a['piezas']."', '".$a['cadav']."', '".$a['cadah']."');");
     
            }
               // 4. se consulta las rejillas y se inserta
            
            $result_rejillas = mysqli_query($con, "select * from producto_rejillas where codigo='$cod' ");
            while($r = mysqli_fetch_array($result_rejillas)){
                if(is_numeric($r['ref1'])){
                   // 'la variable es un numero';
                    $perfilrejilla1 = mysqli_query($con, "select referencia,lado,lado_ref,var1,var2 from producto_perfiles where codigo='$cod' and id_p='".$r['ref1']."' ");
                    $perrej = mysqli_fetch_array($perfilrejilla1);
                    $refe_rejilla = $perrej['referencia'];
                    $lado_rejilla = $perrej['lado'];
                    $ladoref_rejilla = $perrej['lado_ref'];
                    $var1_rejilla = $perrej['var1'];
                    $var2_rejilla = $perrej['var2'];
                    
                    $perfilrejilla2 = mysqli_query($con, "select id_p from producto_perfiles where codigo='$codigo' and referencia='".$refe_rejilla."' and lado='$lado_rejilla' and lado_ref='$ladoref_rejilla' and var1='$var1_rejilla' and var2='$var2_rejilla' ");
                    $verrej = mysqli_fetch_array($perfilrejilla2);
                    $ref1 = $verrej[0];

               }else{
                  // 'la variable no es numero';
                   $ref1 = $r['ref1'];
               }
               if(is_numeric($r['ref2'])){
                   // 'la variable es un numero';
                    $perfilrejilla3 = mysqli_query($con, "select referencia,lado,lado_ref,var1,var2 from producto_perfiles where codigo='$cod' and id_p='".$r['ref2']."' ");
                    $perrej2 = mysqli_fetch_array($perfilrejilla3);
                    $refe_rejilla = $perrej2['referencia'];
                    $lado_rejilla = $perrej2['lado'];
                    $ladoref_rejilla = $perrej2['lado_ref'];
                    $var1_rejilla = $perrej2['var1'];
                    $var2_rejilla = $perrej2['var2'];
                    
                    $perfilrejilla4 = mysqli_query($con, "select id_p from producto_perfiles where codigo='$codigo' and referencia='".$refe_rejilla."' and lado='$lado_rejilla' and lado_ref='$ladoref_rejilla' and var1='$var1_rejilla' and var2='$var2_rejilla' ");
                    $verrej2 = mysqli_fetch_array($perfilrejilla4);
                    $ref2 = $verrej2[0];

               }else{
                  // 'la variable no es numero';
                   $ref2 = $r['ref2'];
               }
                 mysqli_query($con, "INSERT INTO `producto_rejillas` (`codigo`, `rej_ref`, `rej_descripcion`, `ref1`, `ope1`, `var1`, `ope2`, `var2`, `ref2`, `ope3`, `var3`, `ope4`, `var4`, `por`)"
                        . " VALUES ('".$codigo."', '".$r['rej_ref']."', '".$r['rej_descripcion']."', '".$ref1."', '".$r['ope1']."', '".$r['var1']."', '".$r['ope2']."', '".$r['var2']."', '".$ref2."', '".$r['ope3']."', '".$r['var3']."', '".$r['ope4']."', '".$r['var4']."', '".$r['por']."');");
  
            }
            
            //5. se consulta los vidrios y se inserta
             $resultvidrio = mysqli_query($con, "select * from  producto_vidrios where codigo='$cod' ");
            while($v = mysqli_fetch_array($resultvidrio)){
                
                if(is_numeric($v['ref1'])){
                   // 'la variable es un numero';
                    $perfil1 = mysqli_query($con, "select referencia,lado,lado_ref,var1,var2 from producto_perfiles where codigo='$cod' and id_p='".$v['ref1']."' ");
                    $vid = mysqli_fetch_array($perfil1);
                    $refe_rejilla = $vid['referencia'];
                    $lado_rejilla = $vid['lado'];
                    $ladoref_rejilla = $vid['lado_ref'];
                    $var1_rejilla = $vid['var1'];
                    $var2_rejilla = $vid['var2'];
                    
                    $perfilrejilla6 = mysqli_query($con, "select id_p from producto_perfiles where codigo='$codigo' and referencia='".$refe_rejilla."' and lado='$lado_rejilla' and lado_ref='$ladoref_rejilla' and var1='$var1_rejilla' and var2='$var2_rejilla' ");
                    $vervid = mysqli_fetch_array($perfilrejilla6);
                    $refv1 = $vervid[0];

               }else{
                  // 'la variable no es numero';
                   $refv1 = $v['ref1'];
               }
               if(is_numeric($v['ref2'])){
                   // 'la variable es un numero';
                    $perfil2 = mysqli_query($con, "select referencia,lado,lado_ref,var1,var2 from producto_perfiles where codigo='$cod' and id_p='".$v['ref2']."' ");
                    $vid2 = mysqli_fetch_array($perfil2);
                    $refe_rejilla = $vid2['referencia'];
                    $lado_rejilla = $vid2['lado'];
                    $ladoref_rejilla = $vid2['lado_ref'];
                    $var1_rejilla = $vid2['var1'];
                    $var2_rejilla = $vid2['var2'];
                    
                    $perfilrejilla8 = mysqli_query($con, "select id_p from producto_perfiles where codigo='$codigo' and referencia='".$refe_rejilla."' and lado='$lado_rejilla' and lado_ref='$ladoref_rejilla' and var1='$var1_rejilla' and var2='$var2_rejilla' ");
                    $vervid2 = mysqli_fetch_array($perfilrejilla8);
                    $refv2 = $vervid2[0];

               }else{
                  // 'la variable no es numero';
                   $refv2 = $v['ref2'];
               }
                 mysqli_query($con,"INSERT INTO `producto_vidrios` (`codigo`, `ref_vidrio`, `ref1`, `ope1`, `var1`, `ope2`, `var2`, `ref2`, `ope3`, `var3`, `ope4`, `var4`, `cantidad`, `modulo`)"
                    . " VALUES ('$codigo', '".$v['ref_vidrio']."', '".$refv1."', '".$v['ope1']."', '".$v['var1']."', '".$v['ope2']."', '".$v['var2']."', '".$refv2."', '".$v['ope3']."', '".$v['var3']."', '".$v['ope4']."', '".$v['var4']."', '".$v['cantidad']."', '".$v['modulo']."');");
  
            }
            
            //6. registro de insumos
            
            $resultinsumos = mysqli_query($con, "select * FROM recetas  WHERE codigo_ref='$cod' ");
            $c = 0;
            while($m = mysqli_fetch_array($resultinsumos)){
                  mysqli_query($con, "insert into recetas (ref_rej,codigo_ref,codigo_pro,cantidad,calcular,metro,yes,lado,para,modulo,configuracion,insumo)"
                               . "values ('".$m['ref_rej']."','$codigo','".$m['codigo_pro']."','".$m['cantidad']."','".$m['calcular']."','".$m['metro']."','".$m['yes']."','".$m['lado']."','".$m['para']."','Accesorios','".$m['configuracion']."','".$m['insumo']."')");
     
            }
            
            //7. registro de instalacion
            $resultinstalacion = mysqli_query($con,"select * from  precios_instalaciones a, producto_instalacion b where a.id_precios=b.id_instalacion and b.codigo= '".$cod."' ");

            while ($in = mysqli_fetch_array($resultinstalacion)){
                
                 mysqli_query($con, "INSERT INTO `producto_instalacion` (`codigo`, `id_instalacion`, `hojas`, `calculo`, `rango`, `por`) "
                        . "VALUES ('$codigo', '".$in['id_instalacion']."', '".$in['hojas']."', '".$in['calculo']."', '".$in['rango']."', '".$in['por']."');");
            }
            
               
                $msg = 'Se copio el producto con exito';
                $error = 0;
            }
            
            $p = array();
            $p[0] = $codigo;
            $p[1] = $msg;
            $p[2] = $error;
            echo json_encode($p);
            
            
            break;
        case 5:
            $codigo = $_GET['digitado'];
            if(is_numeric($codigo)){
                 echo 'la variable es un numero';
                 
            }else{
                 echo 'la variable no es numero';
               
            }
            
            break;
            
            
            case 6:
            $id=$_GET['id'];
            $iva=$_GET['iva'];
           
            $ver = mysqli_query($con,"update producto set ivapro='$iva' where id_p='$id' ");
            if($ver){
                echo 'Se modifico con exito rl valor del IVA a '.$iva.'';
            }else{
                echo 'Error al editar'. mysqli_error($con).'';
            }
            break;
            
            
            
            
            
            
            
            }

