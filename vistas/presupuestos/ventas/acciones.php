<?php
include '../../../modelo/conexioni.php';
session_start();
$usuario = $_SESSION['k_username'];
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){
    case 1:
              $request2=mysqli_query($con,'select * from cont_terceros WHERE cod_ter="'.$_GET["doc"].'"');
              $row2=mysqli_fetch_array($request2);
              $p = array();
              $p[0] = $row2["id_ter"];
              $p[1] = $row2["cod_ter"];
              $p[2] = $row2["dir_ter"];
              $p[3] = $row2["telfijo_ter"];
              $p[4] = $row2["telmovil_ter"];
              $p[5] = $row2["correo_ter"];
              $p[6] = $row2["cont_ter"];
              $p[7] = $row2["nom_ter"];
              $p[8] = $row2["ciudad_ter"];
              $p[9] = $row2["municipio_ter"];
              $p[10] = $row2["vendedor"];
              $p[11] = $row2["pvi"];
              echo json_encode($p);
              exit();
        break;
    case 2:
        $request2=mysqli_query($con,'SELECT * FROM producto WHERE codigo="'.$_GET['cod'].'"');
        $row2=mysqli_fetch_array($request2);
        $p = array();
        $p[0] = $row2["id_p"];
          $p[1] = $row2["producto"];
          $p[2] = $row2["codigo"];
          $p[3] = $row2["referencia_p"];
            $cadena_de_texto = $row2["producto"];
            $cadena_per   = 'PERFORACION';
            $per = strrpos($cadena_de_texto, $cadena_per);
            $cadena_boq   = 'BOQUETE';
            $boq = strrpos($cadena_de_texto, $cadena_boq);
            if ($per === false) {
            $pe = 0;
            } else {
            $pe = 1;
            }
            if ($boq === false) {
            $bo = 0;
            } else {
            $bo = 1;
            }
          $p[4] = $pe;
          $p[5] = $bo;
          $p[6] = $row2["laminas"];
        echo json_encode($p);
        exit();
        break;
        case 3:
        $linea= 'Vidrio';
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $vid2= $_GET["vid2"];
        $vid3= $_GET["vid3"];
        $vid4= $_GET["vid4"];
        //$vty = $vid.'-'.$vid2.'-'.$vid3.'-'.$vid4;
        $precio_mp ='p1';
        $precio= 'p1';
        $an2 = $_GET["ancho"];
        $cann = $_GET["cant"];
        $all = $_GET["alto"];
        $pelicula = $_GET["pelicula"];
        $cantidad = $cann;
        $install = $_GET["install"];
        $desc= $_GET["desc"];
        $des= $_GET["des"];
        $adi= $_GET["adi"];
        $m2 = (($an2/1000)*($all/1000))*$_GET['cant'];
        //PORCENTAJE DE P1 PARA LOS 4 VIDRIOS
        $ajuste = mysqli_query($con,"select * from ajustes where id_referencia=$ref and id_vidrio=$vid ");
        $aj = mysqli_fetch_array($ajuste);
        if($aj){
        $vj = $aj['ajuste'] * (($_GET['ancho']/1000) * ($_GET['alto']/1000));
        $vjt = $vj * $_GET['cant'];
        }else{
        $vj = 0;
        }
        if($_GET['per']>5){
        $_GET['per'] = ($_GET['per'] - 5);
        }else{
         $_GET['per'] = 0;
        } 
        if($_GET['boq']>3){
        $_GET['boq'] = ($_GET['boq'] - 3);
        }else{
        $_GET['boq'] = 0;
        }    
        //$resultado = '$vty= '.$vty.', $all='.$all.' $an2='.$an2.' $desc='.$desc.',$install='.$install.' , $_GET["per"]= '.$_GET['per'].' , $cantidad='.$cantidad.', $ref='.$ref.', $vid='.$vid.', $st='.$st;
        $resultado = '';
        //CALCULO DE VIDRIO 1
        if($vid!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid."'";
        $fi31 =mysqli_fetch_array(mysqli_query($con,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;

        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
        $result=  mysqli_query($con,$consulta);
        $total = 0;
        $stt =0;
        //echo 'cantidad'.$cantidad.'<br>'; 
        $precio_adi_total = 0;
        while($fila=  mysqli_fetch_array($result)){
        $valor1=$fila['id_subpro'];
        $valor2=$fila['nombre_subpro'];
        $precio_a = $fila['precio'];
        $precio_adicional = $fila['precio_adicional'];
        $und_med = $fila['medida'];
        if($valor1==4){
        $pa = $precio_adicional * $_GET['per'];
        $cp = 0;
        }else{
        if($valor1==5){
        $pa = $precio_adicional * $_GET['boq'];
        $cp = 0;
        }else{
        $pa = $precio_adicional;
        $cp = 1;
        }
        }
        if($valor1=='7'){
        $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($con,$st));
        $cost= $fit["costo"];

        $st = $m2 * $cost;

        }else{ 
        $st = 0;
        }
        if($und_med=='Kg'){
        $pat = $peso * $pa;
        $ti = $peso * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='Und'){
        $pat = $cantidad * $pa;
        $ti = $cantidad * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='M2'){
        $pat = $m2 * $pa;
        $ti = $m2 * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        $precio_adi_total += $pat;
        $total = $total  + $ti ;
        $stt = $stt + $st;
        }
        $s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
        $fi3 =mysqli_fetch_array(mysqli_query($con,$s3));
        $porc= $fi3["p"]/100;
        $totalv1 = $total + ($vvc/$porc)+$stt ;
        $totalv1sp = $total + $vvc+$stt;
        //echo $totalv1;  total de precio de vidrios con p1
        }else{
           $totalv1 = 0 ; 
           $totalv1sp = 0 ;
        }

        //FIN DE CALCULO VIDRIO 1

        //CALCULO DE VIDRIO 2
                if($vid2!='' && $vid2!=0){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid2."'";
        $fi31 =mysqli_fetch_array(mysqli_query($con,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;

        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
        $result=  mysqli_query($con,$consulta);
        $total = 0;
        $stt =0;
        //echo 'cantidad'.$cantidad.'<br>';      
        while($fila=  mysqli_fetch_array($result)){
        $valor1=$fila['id_subpro'];
        $valor2=$fila['nombre_subpro'];
        $precio_a = $fila['precio'];
        $precio_adicional = $fila['precio_adicional'];
        $und_med = $fila['medida'];
        if($valor1==4){
        $pa = $precio_adicional * $_GET['per'];
        $cp =0;
        }else{
        if($valor1==5){
        $pa = $precio_adicional * $_GET['boq'];
        $cp = 0;
        }else{
        $pa = $precio_adicional;
        $cp = 1;
        }
        }
        if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($con,$st));
        $cost= $fit["costo"];

        $st = $m2 * $cost;

        }else{ 
        $st = 0;
        }
        if($und_med=='Kg'){
        $pat = $peso * $pa;
        $ti = $peso * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='Und'){
        $pat = $cantidad * $pa;
        $ti = $cantidad * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='M2'){
        $pat = $m2 * $pa;
        $ti = $m2 * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        $total = $total  + $ti + $pat;
        $stt = $stt + $st;
        }
        $s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
        $fi3 =mysqli_fetch_array(mysqli_query($con,$s3));
        $porc= $fi3["p"]/100;
        $totalv2 = $total + (($vvc)/$porc)+$stt;
        $totalv2sp = $total + (($vvc))+$stt;
        //echo $totalv1;  total de precio de vidrios con p1
        }else{
           $totalv2 = 0 ;  $totalv2sp = 0 ;
        }

        //FIN DE CALCULO VIDRIO 2
        //CALCULO VIDRIO 3
        if($vid3!='' && $vid3!=0){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid3."'";
        $fi31 =mysqli_fetch_array(mysqli_query($con,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;

        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
        $result=  mysqli_query($con,$consulta);
        $total = 0;
        $stt =0;
        //echo 'cantidad'.$cantidad.'<br>';      
        while($fila=  mysqli_fetch_array($result)){
        $valor1=$fila['id_subpro'];
        $valor2=$fila['nombre_subpro'];
        $precio_a = $fila['precio'];
        $precio_adicional = $fila['precio_adicional'];
        $und_med = $fila['medida'];
        if($valor1==4){
        $pa = $precio_adicional * $_GET['per'];
        $cp = 0;
        }else{
        if($valor1==5){
        $pa = $precio_adicional * $_GET['boq'];
        $cp = 0;
        }else{
        $pa = $precio_adicional;
        $cp = 1;
        }
        }
        if($valor1=='7'){
        $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($con,$st));
        $cost= $fit["costo"];

        $st = $m2 * $cost;

        }else{ 
        $st = 0;
        }
        if($und_med=='Kg'){
        $pat = $peso * $pa;
        $ti = $peso * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='Und'){
        $pat = $cantidad * $pa;
        $ti = $cantidad * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='M2'){
        $pat = $m2 * $pa;
        $ti = $m2 * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        $total = $total  + $ti + $pat;
        $stt = $stt + $st;
        }

        $totalv3 = $total + (($vvc)/$porc)+$stt;
        $totalv3sp = $total + (($vvc))+$stt;
        //echo $totalv1;  total de precio de vidrios con p1
        }else{
           $totalv3 = 0 ;  $totalv3sp = 0 ;
        }

        //FIN DE CALCULO VIDRIO 3
        //CALCULO VIDRIO 4
        if($vid4!='' && $vid4!=0){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid4."'";
        $fi31 =mysqli_fetch_array(mysqli_query($con,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;

        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
        $result=  mysqli_query($con,$consulta);
        $total = 0;
        $stt =0;
        //echo 'cantidad'.$cantidad.'<br>';      
        while($fila=  mysqli_fetch_array($result)){
        $valor1=$fila['id_subpro'];
        $valor2=$fila['nombre_subpro'];
        $precio_a = $fila['precio'];
        $precio_adicional = $fila['precio_adicional'];
        $und_med = $fila['medida'];
        if($valor1==4){
        $pa = $precio_adicional * $_GET['per'];
        $cp = 0;
        }else{
        if($valor1==5){
        $pa = $precio_adicional * $_GET['boq'];
        $cp = 0;
        }else{
        $pa = $precio_adicional;
        $cp = 1;
        }
        }
        if($valor1=='7'){
        $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($con,$st));
        $cost= $fit["costo"];

        $st = $m2 * $cost;

        }else{ 
        $st = 0;
        }
        if($und_med=='Kg'){
        $pat = $peso * $pa;
        $ti = $peso * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='Und'){
        $pat = $cantidad * $pa;
        $ti = $cantidad * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='M2'){
        $pat = $m2 * $pa;
        $ti = $m2 * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        $total = $total  + $ti + $pat;
        $stt = $stt + $st;
        }
        $s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
        $fi3 =mysqli_fetch_array(mysqli_query($con,$s3));
        $porc= $fi3["p"]/100;
        $totalv4 = $total + (($vvc)/$porc)+$stt;
        $totalv4sp = $total + (($vvc))+$stt;
        //echo $totalv1;  total de precio de vidrios con p1
        }else{
           $totalv4 = 0 ;  $totalv4sp = 0 ;
        }

        //FIN DE CALCULO VIDRIO 4



        // SUMA DE ACCESORIOS
         $acc_por = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
        $fipa =mysqli_fetch_array(mysqli_query($con,$acc_por));
        $porcacc= $fipa["p"]/100; 
         $acc_porB = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MPB' and grupo='Accesorios'";
        $fipaB =mysqli_fetch_array(mysqli_query($con,$acc_porB));
        $porcaccB= $fipaB["p"]/100; 
          $request_acE=mysqli_query($con,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." order by b.para ");
        if($request_acE){

        $tac = 0; $tacfom = 0; $tacfomp = 0;
        while($row=mysqli_fetch_array($request_acE))
        {  
        //--------------------------------------------------------------------
        if($row['can_rej']!=0){
        $request_v2=mysqli_query($con,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." and b.id_r_rej=".$row['can_rej']." ");
        while($rowz=mysqli_fetch_array($request_v2))
        {
        $sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." and b.id_r_a=".$rowz["id_referencia_med"]."");
        $fil_an =mysqli_fetch_array(mysqli_query($con,$sqlxy));
        $id_p= $fil_an["id_p"];

        if($fil_an['signo']=='+'){
        if($fil_an['medida_r_a']==1){
            $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==2){
            $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==3){
            $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
        }else{
             if($fil_an['medida_r_a']==4){
            $al = ($anchura_ventana+$fil_an["descuento"])+ $fil_an['variable'];
        }else{
             if($fil_an['lado']!="Vertical"){
        $al = ($_GET['ancho']+$fil_an["descuento"])+ $fil_an['variable'];

        }else{
        $al = ($_GET['alto']+$fil_an["descuento"])+ $fil_an['variable'];
        }
        }
        }
        }

        }

        }else{
        if($fil_an['signo']=='-'){
        if($fil_an['medida_r_a']==1){
            $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==2){
            $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==3){
            $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
        }else{
             if($fil_an['medida_r_a']==4){
            $al = ($anchura_ventana+$fil_an["descuento"])- $fil_an['variable'];
        }else{
             if($fil_an['lado']!="Vertical"){
        $al = ($_GET['ancho']+$fil_an["descuento"])- $fil_an['variable'];

        }else{
        $al = ($_GET['alto']+$fil_an["descuento"])- $fil_an['variable'];
        }
        }
        }
        }

        }
        }else{
        if($fil_an['signo']=='*'){
         if($fil_an['medida_r_a']==1){
            $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==2){
            $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==3){
            $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
        }else{
             if($fil_an['medida_r_a']==4){
            $al = ($anchura_ventana+$fil_an["descuento"])* $fil_an['variable'];
        }else{
             if($fil_an['lado']!="Vertical"){
        $al = ($_GET['ancho']+$fil_an["descuento"])* $fil_an['variable'];

        }else{
        $al = ($_GET['alto']+$fil_an["descuento"])* $fil_an['variable'];
        }
        }
        }
        }

        }
        }else{
        if($fil_an['signo']=='/'){
        if($fil_an['medida_r_a']==1){
            $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==2){
            $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==3){
            $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
        }else{
             if($fil_an['medida_r_a']==4){
            $al = ($anchura_ventana+$fil_an["descuento"])/ $fil_an['variable'];
        }else{
             if($fil_an['lado']!="Vertical"){
        $al = ($_GET['ancho']+$fil_an["descuento"])/ $fil_an['variable'];

        }else{
        $al = ($_GET['alto']+$fil_an["descuento"])/ $fil_an['variable'];
        }
        }
        }
        }

        }
        }
        }
        } 
        }
        $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);

        }}else{
        $cant_rej = 1;
        }

        //---------------------------------------------------------------------

        if($linea=='Fachada'){
         if($row["yes"]=='Si'){
             if($row["lado"]=='Vertical'){
                 $res = ((($row["cantidad_acc"]*$_GET['alto']) / $row["metro"])+$row["cantidad_acc"]);
             }else{
                 $res = ((($row["cantidad_acc"]*$_GET['ancho']) / $row["metro"])+$row["cantidad_acc"]);
             }         
         }else{
              $res = $row["cantidad_acc"];
         }
        }else{      
        if($row['calcular']=='ML'){
        $rs = $_GET['hoja'] * 2 * $row["cantidad_acc"];
        $res = (($_GET['ancho'] / 1000) * 2) + (($_GET['alto']/1000)*$rs);
        }ELSE{
          if($row['calcular']=='M2'){
              $res = (($_GET['alto'] / 1000)) * (($_GET['ancho']/1000))* $row["cantidad_acc"];
        }else{
         if($row["yes"]=='Si'){
             if($row["lado"]=='Vertical'){
                 $res = ($row["cantidad_acc"]*$_GET['alto']) / $row["metro"];
             }else{
                 $res = ($row["cantidad_acc"]*$_GET['ancho']) / $row["metro"];
             }             
         }else{
              $res = $row["cantidad_acc"];
         }            
        }}}
        $taa = $cant_rej * $res;
        if($row["med"]!=1){
         $m = $row["med"]/1000;
         $f = ''.number_format(($taa*$_GET["cant"])).' ML';
         $ft = $f * $row["valor_f"] ;
         $a = $f * $row["valor_f"] ;
        }else{
         $m = $row["med"];
         $f = ''.number_format($taa*$_GET["cant"]).' '.$row["calcular"].' ';
         $ft = 'No aplica' ;$a = '' ;
        }
        if($_GET['pelicula']!="No Aplica"  && $row['codigo']=='26002'){
        if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
        $tac = $tac + (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a);
        //            echo (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
        $tacfom = $tacfom + (($taa * $v) * ($row["costo_fom"])*$m*$_GET['cant'] + $a);
        $tacfomp = $tacfomp + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$_GET['cant'] + $a);

        }
        if($row['codigo']!='26002'){ 
        //                echo ($taa*($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
        $tac = $tac + ($taa*($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a);
        $tacfom = $tacfom + ($taa*($row["costo_fom"])*$m*$_GET['cant'] + $a);
        $tacfomp = $tacfomp + ($taa*($row["costo_fom"]/$porcaccB)*$m*$_GET['cant'] + $a);
        }
        //echo $tac.'<br>';
        } 

        }
        $accesorios = $tac;
        $accesorios_sinp = $tac * $porcacc;
        $accesorios_fom = $tacfomp;
        $accesorios_fom_sinp = $tacfomp * $porcaccB;
        // FIN DE ACCESORIOS
        // 
        $suma = $totalv1+$totalv2+$totalv3+$totalv4 + $accesorios;
        $suma_sp = $totalv1sp+$totalv2sp+$totalv3sp+$totalv4sp + $accesorios_sinp;
        $suma_fom = $totalv1+$totalv2+$totalv3+$totalv4 + $accesorios;
        $suma_fom_sin_p = $totalv1sp+$totalv2sp+$totalv3sp+$totalv4sp + $accesorios_sinp + $accesorios_sinp;
        //comienzo de maquinaria          
        $request_mano=mysqli_query($con,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$ref);    
        if($request_mano){
        $tot2=0;$tot2fom=0;$tot2fomp=0; $totsinp = 0;
        while($row=mysqli_fetch_array($request_mano))
        {       
        $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
        if($row['dias']=='Si'){
        if($_GET['alto']>3000){
            $res = $mt2 /2.25;
        }else{
            $res = 1;
        }
        $duracion=1;//esta variable viene del formulario, le coloque 1 
        $r = $row["porcentaje_ma"]*($res)*$duracion;
        $tot2 = $tot2 + $r ;
        $tot2fom = $tot2fom + $r ;
        $tot2fomp = $tot2fomp + $r ;
        $totsinp = $totsinp + $r ;
        }else{
        $r = $row["porcentaje_ma"]/100*$suma;
        $tot2 = $tot2 + $r;

        $r2 = $row["porcentaje_ma"]/100*$suma_fom;
         $tot2fom = $tot2fom + $r2 ; 

         $r3 = $row["porcentaje_ma"]/100*$suma_fom_sin_p;
         $tot2fomp = $tot2fomp + $r3 ;

         $r4 = $row["porcentaje_ma"]/100*$suma_sp;
         $totsinp = $totsinp + $r4 ;
        }    
        } 
        }
        //fin de maquinaria
        //
        //comienzo de mano de obra
        $maquina = $tot2;
        $maquina_sinp = $totsinp;
        $maquina_fom = $tot2fom;
        $maquina_fom_sinp = $tot2fomp;

        // fin mano de MAQUINARIA-------------------------------<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>

        $req=mysqli_query($con,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$ref);
        if($req){
        $tot=0;$tot_fom = 0;
        while($row=mysqli_fetch_array($req))
        {       
        $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
        $mtl = ($_GET['ancho']/1000);
        if($mt2<1){
        $mt2 = 1;
        }  else {
        $mt2 = $mt2;
        }
        if($_GET["install"]=="Si"){

        if($row['unidad_cobro']=='M2'){
            $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='ML'){
            $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='Und'){
            $tar =  ($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='Kg'){
            $tar =  ($_GET["cant"]*$row["valor_mo"]);
        }
           if($row['instalacion']=='No'){
        if($row['unidad_cobro']=='M2'){
            $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);

        }
        if($row['unidad_cobro']=='ML'){
            $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);

        }
        if($row['unidad_cobro']=='Und'){
            $tarf =  ($_GET["cant"]*$row["valor_mo"]);

        }
        if($row['unidad_cobro']=='Kg'){
            $tarf =  ($_GET["cant"]*$row["valor_mo"]);

        }
           if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
               if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 

               $tot_fom = $tot_fom + ($tarf * $v);
           }
         if($row['referencia']!='26002'){
               $tot_fom = $tot_fom + $tarf;
           }
        }
        if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
            if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
             $tot = $tot + ($tar * $v);

        }
        if($row['referencia']!='26002'){
             $tot = $tot + $tar;
        }
        }else{
        if($row['instalacion']=='No'){
        if($row['unidad_cobro']=='M2'){
            $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='ML'){
            $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='Und'){
            $tar =  ($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='Kg'){
            $tar =  ($_GET["cant"]*$row["valor_mo"]);
        }
        if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
            if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
             $tot = $tot + ($tar * $v);
        }
        if($row['referencia']!='26002'){
             $tot = $tot + $tar;
        }
        }else{
            $tar = 0;
        }
        }
        } 

        }
        $mano = $tot;
        $mano_fom = $tot_fom;

        ///FIN MANO DE OBRA ------------------------------------->>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<
        $suma_maq = $suma + $maquina + $mano;
        $suma_maq_sp = $suma_sp + $maquina_sinp + $mano;
        $suma_maq_fom = $suma_fom + $maquina_fom + $mano_fom;
        $suma_maq_fom_sin_p = $maquina_fom_sinp+ $suma_fom_sin_p + $mano;
        $request_ad=mysqli_query($con,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$ref);


        if($request_ad){

        $tota=0;  $tota_sinp=0;$totafom=0;$totafom_sinp=0;
        while($row=mysqli_fetch_array($request_ad))
        {              
        $por = 100;
        if($row['referencia_ad']!='ADM-007'){
           $totafom = $totafom + ($suma_maq_fom*$row["porcentaje_ad"]/$por);
           $totafom_sinp = $totafom_sinp + ($suma_maq_fom_sin_p*$row["porcentaje_ad"]/$por);
        }
        $tota = $tota + ($suma_maq*$row["porcentaje_ad"]/$por);
        $tota_sinp = $tota_sinp + ($suma_maq_sp*$row["porcentaje_ad"]/$por);

        } 

        }
        $admin = $tota;
        $admin_sinp = $tota_sinp;
        $admin_fom = $totafom;
        $admin_fom_sinp = $totafom_sinp;
        /// gastos administrativos
        //echo 'otros'.$admin.'<br>';
        //  FIN DE OTROS ---------------------------------<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>
        if(isset($totsi)){
        $si = $totsi;
        }else{$si =0;}

        $totalx = $suma_maq + $admin;
        $totalx_sinp = $suma_maq_sp + $admin_sinp;
        $totalxfom = $suma_maq_fom + $admin_fom;
        $totalxfom_sinp = $suma_maq_fom_sin_p + $admin_fom_sinp;
        // se verifica que tenga ajuste de precio
        
        //porcentaje de venta P1
        $s3 = "SELECT (".$precio.") as p FROM porcentajes where area_por='Vidrio'";
        $fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
        $mult = $fi3["p"]/100;
        $a = (($totalx / $mult) + $vjt);
        //valor unidad sin iva
        $adi = $precio_adi_total / $cann;
        $und = ($a / $cann);

        $tiva = ($a + $precio_adi_total) * 0.19;
        $t = ($a + $precio_adi_total) + $tiva;
        $to = $t * ($desc/100);
        $total = ($t + $to);
        
        if($und > 5000){

        $p = array();
        $p[0]= number_format(($a +$precio_adi_total),0,'','');
        $p[1]= number_format($tiva,0,'','');
        $p[2]= number_format($und,0,'','');
        $p[3]= number_format($total,0,'','');
        $p[4]=$totalx ;
        $p[5]=$totalx_sinp;
        $p[6]=$totalxfom;
        $p[7]=$totalxfom_sinp;
        $p[8]= number_format($t,0,'','');
        $p[9]= 'vidrios: '.$suma.' - ';
        $p[10]= $vj;

        $pu = ($a / $cann);
        $descpor = $pu * ($desc / 100);
        $pud = ($pu + $descpor) + $adi;
        $p[11]= number_format($pud,0,'','');
        $p[12]= number_format(($pud * $cann),0,'','');
        
        $p[13] = $precio_adi_total;
            //------------------------------------------------------------
        }else{
            //-------------------------------------------------------------
        $p = array();
        $cadena_de_texto = $des;
        $cadena_buscada   = 'CRUDO';
        $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
        if ($posicion_coincidencia === false) {
        $precio = 10000;
        }else{
        $precio = 5000;
        }
        $tiva = ($precio*$cann) * 0.19;
        $t = ($precio*$cann) + $tiva;
        $to = $t * ($desc/100);
        $total = $t + $to;
        
        $p[0]= number_format(($a +$precio_adi_total),0,'','');
        $p[1]= number_format($tiva,0,'','');
        $p[2]= number_format($precio,0,'','');
        $p[3]= number_format($total,0,'','');
        $p[4]=$totalx;
        $p[5]=$totalx_sinp;
        $p[6]=$totalxfom;
        $p[7]=$totalxfom_sinp;
        $p[8]= number_format($t,0,'','');
        $p[9]= 'vidrios: '.$suma.' - ';
        $p[10]= $vj;

        $pu = $precio;
        $descpor = $pu * ($desc / 100);
        $pud = ($pu + $descpor) + $adi;
        $p[11]= number_format($pud,0,'','');
        $p[12]= number_format(($pud * $cann),0,'','');
        $p[13] = $precio_adi_total;
        //$p[13]=$posicion_coincidencia;
        }


        echo json_encode($p);
        exit();

        break;
        case 4:
        $desc = $_GET['desc'];
        $piva = $_GET['piva'];
        $to = $piva * ($desc/100);
        $total = $piva + $to;
        echo number_format($total,0,'','');
        break;
        case 5:
        $linea= 'Vidrio';
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $vid2= $_GET["vid2"];
        $vid3= $_GET["vid3"];
        $vid4= $_GET["vid4"];
        $cot= $_GET["cot"];
        $cliente= $_GET["idc"];
        $precio_mp ='P1';
        $precio= 'P1';
        $ancho = $_GET["ancho"];
        $cantidad = $_GET["cant"];
        $alto = $_GET["alto"];
        $pelicula = $_GET["pelicula"];
        $install = $_GET["install"];
        $desc= $_GET["desc"];
        $per= $_GET["per"];
        $boq= $_GET["boq"];
        $rep= $_GET["rep"];
        $p4= $_GET["p4"];
        $p5= $_GET["p5"];
        $p6= $_GET["p6"];
        $p7= $_GET["p7"];
        $ajuste= $_GET["ajuste"];
        $adi= $_GET["adi"];

        $ubc= $_GET["ubc"];
        $obs= $_GET["obse"];
        $precioitem= $_GET["precio"];
        $pi = $precioitem * ($desc/100);
        $pitem = $precioitem + $pi;
        //echo $precioitem.' - '.$pi.' - '.$pitem;
        $maxid = mysqli_fetch_array(mysqli_query($con,"select max(id_dolar) from dolares"));
        $dolar = $maxid['max(id_dolar)'];
        $ct= $_GET["ct"];
        for($i=1;$i<=$rep;$i++){
            $ct = $ct + 1;
         $sql = "INSERT INTO `cotizaciones` (`adicional_per`,`ajuste`,`ubicacion_c`,`observaciones`,`fila`,`precio_item`, `lado`, `id_dolar`, `valor_c_sp`, `valor_fomp`, `ancho_temp`, `alto_temp`, `pelicula`, `valor_fom`, `modulo`, `imagen_mas`, `tip`,`imagen`, `ancho_abajo`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `install`, `id_vidrio2`, `id_vidrio3`, `id_vidrio4`, `id_vidrio5`, `id_vidrio6`,`tipo_c`, `duracion`, `horizontales`,`verticales`,`desc`, `observaciones2`, `hojas`, `cuerpo`, `color_ta`, `porcentaje`, `porcentaje_mp`, `per`, `boq`, `cod_traz`, `linea_cot`, `id_cot`, `cierre`, `id_referencia`, `id_vidrio`, `ancho_c`, `alto_c`, `valor_c`, `cant_restante`, `cantidad_c`, `id_cliente`, `estado_c`, `registrado_por_c` , `d1`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`)";
         $sql.= "VALUES ('".$adi."','".$ajuste."','".$ubc."','".$obs."','".$ct."','".$pitem."','0', '".$dolar."', '".$p5."', '".$p7."', '0', '0', '".$pelicula."', '".$p6."', '0', '', '0','0', '0', '".$ref."', '0', '0', '0', '1', '0', '0', '0', '".$install."', '".$vid2."', '".$vid3."', '".$vid4."', '0', '0','', '0', '0', '0','$desc', '', '1','0', 'N/A', 'P1', 'P1', '".$per."', '".$boq."','', '".$linea."', '".$cot."', 'No', '".$ref."', '".$vid."', '".$ancho."', '".$alto."',  '".$p4."',  '".$cantidad."',  '".$cantidad."', '".$cliente."', 'Cotizado', '".$_SESSION['k_username']."', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
         echo $ok = mysqli_query($con,$sql, $conexion);
        }

        break;
        case 6:
             $idc= $_GET["idc"];
            $cot= $_GET["cot"];
            $ana= $_GET["ana"];
            $dep= $_GET["dep"];
            $ciu= $_GET["ciu"];
            $ase= $_GET["ase"];
            $dir= $_GET["dir"];
            $ent= $_GET["ent"];
            $obra= $_GET["obra"];
            $obs= $_GET["obs"];
            $ser= $_GET["exp"];
            $pag= $_GET["pag"];
            $tel= $_GET["tel"];
            $iva= $_GET["iva"];
            
            $despvid= $_GET["despvid"];
            $despalu= $_GET["despalu"];
            $despacc= $_GET["despacc"];
            $despace= $_GET["despace"];
            $despesp= $_GET["despesp"];
            $despint= $_GET["despint"];
            
            $utilidad= $_GET["utilidad"];
            
            $fecha_hoy = date("Y-m-d");
            if($cot==''){
            $sx = "SELECT max(numero_cotizacion) FROM cotizacion";
                                    $filax =mysqli_fetch_array(mysqli_query($con,$sx));
                                    $max_nc= $filax["max(numero_cotizacion)"]+1;
                                    if ($ent != "") {
                                        $fecha_serv_express = $ent;
                                    } else {
                                        $fecha_serv_express = '0000-00-00';
                                    }
                                    //echo "<script>alert('" . $_POST['serv_express'] . " - " . $fecha_serv_express . "');</script>";
                                    $sql = "INSERT INTO `cotizacion` (`utilidad`, `desp_vid`,`desp_alu`,`desp_acc`,`desp_ace`,`desp_esp`,`desp_int`,`sel_iva`, `express`, `fecha_de_entrega`, `nota`, `fecha_modificacion`, `fecha_reg_c`, `pago`, `registrado`, `version`, `numero_cotizacion`,`presupuesto`,`tipo`, `instalacion`,`precio`,`aiu`,`responsable`,`tel_responsable`,`ciudad`,`municipio`,`id_tercero`, `grabado`, `estado`, `obra`, `ubicacion`, `linea`,`validez`,`cod_temp`,`nom_temp`)";
                                    $sql.= "VALUES ('15','" .$despvid."','" .$despalu."','" .$despacc."','" .$despace."','" .$despesp."','" .$despint."','" .$iva."', '" .$ser."', '".$fecha_serv_express."', '".$obs."','".$fecha_hoy."', '".$fecha_hoy."', '".$pag."', '".$ase."', '1', '".$max_nc."', '".$ana."','Empresarial','Si','p1','No','','".$tel."','".$dep."','".$ciu."','".$idc."', '".$_SESSION['k_username']."', 'En proceso', '".$obra."', '".$dir."', 'Vidrio','30 dias','','')";
                                    $res = mysqli_query($con,$sql);



                                    $sql21 = "SELECT max(id_cot) FROM cotizacion";
                                    $fila21 =mysqli_fetch_array(mysqli_query($con,$sql21));
                                    $max= $fila21["max(id_cot)"];
                                    $p = array();
                                    $p[0] = $max;
                                    $p[1] = $max_nc;
                                    $p[2] = 1;
                                    $p[3] = 'En proceso';
                                    $p[4] = $res;
                                    echo json_encode($p);
                                    exit();
            }else{
                mysqli_query($con,"update cotizacion set utilidad='$utilidad', desp_vid='$despvid',desp_alu='$despalu',desp_acc='$despacc',desp_ace='$ase',desp_esp='$ase',desp_int='$ase',fecha_guardado='".date("Y-m-d H:m:s")."', registrado='$ase', express='$ser',fecha_de_entrega='$ent',nota='$obs',obra='$obra',validez='$pag', ubicacion='$dir', estado='Pedido por aprobar' where id_cot='$cot'  ");
                                $p = array();
                                     $p[0] = $cot;
                                    $p[1] = 0;
                                    $p[2] = 1;
                                    $p[3] = 'Pedido por aprobar';
                                    echo json_encode($p);
                                    exit();
            }
   
            
            break;
        case 7:
        $cot = $_GET['cot'];
        $est = $_GET['est'];
        $result = mysqli_query($con,"SELECT * FROM cotizacion_item d where id_cot=".$cot." and estado='Guardado' and id_cot_principal=0 and compuesto=0 ");
        $c = 0;
        $gt= 0;
        $gtiva= 0;
        $ct= 0;
        $di = '';
        while($row = mysqli_fetch_array($result)){
        $c +=1;
        $valor = $row["valor_item"]+$row["total_compuestos"]+$row["total_material"]+$row["total_ins"]+$row["total_mob"];
        $descpor = $valor * ($row["descuento"] / 100);

        $ptt2 = ($valor +  $descpor);
        $pud = $ptt2 / $row["cantidad"];
        $iva = $ptt2 * ($row["iva"]/100);
        
        $pu = ($ptt2 / $row["cantidad"]);
        
        $total = $ptt2 + $iva;
        $gt += $ptt2;
        $gtiva += $total;
        $ct +=$row['cantidad'];
        if($est=='En proceso'){
            $di = '';
        }else{
            $di = 'disabled';
        }
        $resultv = mysqli_query($con,"SELECT descripcion_principal,descripcion_segunda FROM cotizacion_item  where estado='Guardado' and id_cot_principal='".$row['id_cot_item']."' and compuesto=0 ");
        $vidrio = '';
        while($v = mysqli_fetch_array($resultv)){
            $vidrio = ' '.$v[0].' ';
        }
        if($row['perforacion']==0){
            $per = '';
        }else{
             $per = ', Per:'.$row['perforacion'];
        }
        if($row['boquete']==0){
            $boq = '';
        }else{
             $boq = ', Boq:'.$row['boquete'];
        }
        $descripcion = $row['descripcion_principal'].$per.$boq.', '.$row['observacion'];
        ?>
        <tr>
            <td><input type="hidden" id="idtem<?php echo $c; ?>" disabled class="input6" value="<?php echo $row['id_cot_item']; ?>" style="width: 60px">
                <input type="text" <?php echo $di; ?> id="tipo<?php echo $c; ?>" style="text-align: center;width: 40px"  onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" class="input6" value="<?php echo $row['item']; ?>"></td>
            <td><?php echo $row['codigo']; ?><input type="hidden" id="cod<?php echo $c; ?>" disabled class="input6" value="<?php echo $row['codigo']; ?>" style="width: 60px"></td>
            <td><?php echo $descripcion; ?> <button onclick="info(<?php echo $row['id_cot_item']; ?>,'<?php echo $row['item']; ?>','<?php echo $row['nota']; ?>')">!</button><input type="hidden" id="des<?php echo $c; ?>" style="width: 250px" disabled value="<?php echo $row['descripcion_principal']; ?>" title="<?php echo $row['descripcion_principal']; ?>"></td>
            <td><?php echo $vidrio; ?></td>
            <td><?php echo $row['ancho']; ?><input type="hidden" <?php echo $di; ?>  onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" id="ancho<?php echo $c; ?>" style="width: 60px" value="<?php echo $row['ancho']; ?>" disabled></td>
            <td><?php echo $row['alto']; ?><input type="hidden" <?php echo $di; ?> onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" id="alto<?php echo $c; ?>" style="width: 60px" value="<?php echo $row['alto']; ?>" disabled></td>
            <input type="hidden" <?php echo $di; ?> id="per<?php echo $c; ?>" style="width: 40px"  value="<?php echo $row['perforacion']; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" disabled></td>
            <input type="hidden" <?php echo $di; ?> id="boq<?php echo $c; ?>" style="width: 40px"  value="<?php echo $row['boquete']; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" disabled></td>
            <td style="text-align:right"><?php echo number_format($row['cantidad']); ?><input type="hidden" <?php echo $di; ?> onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" style="text-align: center;width: 40px" id="cant<?php echo $c; ?>" class="input6" disabled value="<?php echo $row['cantidad']; ?>"></td>
            <td style="text-align:right"><?php echo number_format($pud); ?><input type="hidden"  id="pud<?php echo $c; ?>"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($pud,2,'.',''); ?>"></td> 
            <td style="text-align:right"><?php echo number_format($ptt2); ?><input type="hidden"  id="ptd<?php echo $c; ?>" name="item" style="width: 80px;text-align: right" disabled value="<?php echo number_format($ptt2,2,'.',''); ?>"></td>
            <td style="text-align:right"><?php echo number_format($total); ?><input type="hidden"  id="piva<?php echo $c; ?>"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($total,2,'.',''); ?>"></td>
            <td><input type="text" <?php echo $di; ?>  onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" id="desc<?php echo $c; ?>" style="width: 35px"  value="<?php echo $row['descuento']; ?>"></td>
            <td><input type="text" <?php echo $di; ?> id="ubc<?php echo $c; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)"  style="width: 50px" value="<?php echo $row['ubicacion']; ?>" title="<?php echo $row['ubicacion']; ?>"></td>
            <td><input type="text" <?php echo $di; ?> id="obse<?php echo $c; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)"  style="width: 50px" value="<?php echo $row['observacion']; ?>" title="<?php echo $row['observacion']; ?>"></td>
            <td><input type="text" <?php echo $di; ?> id="rep<?php echo $c; ?>" style="width: 20px" value="1"></td>
           
            <td>&nbsp;<button <?php echo $di; ?> onclick="rep_item(<?php echo $c.','.$row['id_cot_item']; ?>);" id="bot<?php echo $c; ?>" class="btn btn-warning glyphicon glyphicon-repeat" title="Repetir Item"></button>
            <td>&nbsp;<button class="btn btn-info glyphicon glyphicon-eye-open" <?php echo $di; ?> onclick="pre_cotizar_editar(<?php echo $row['id_cot_item']; ?>,'<?php echo $row['linea_cot']; ?>');" id="editar<?php echo $c; ?>" title="Ver Items"></button>
            <td>&nbsp;<div id="boton<?php echo $c; ?>"><button <?php echo $di; ?> onclick="del_item(<?php echo $c.','.$row['id_cot_item']; ?>);" id="bot<?php echo $c; ?>" class="btn btn-danger glyphicon glyphicon-remove-circle" title="Eliminar Items"></button>
                     

        </tr>


        <?php
        }
        ?>
        <tr>
            <th><input type="text" id="ct" style="width: 40px" value="<?php echo $c; ?>" disabled></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
         
            <th>Totales:</th>
            <th><?php echo number_format($ct); ?><input type="hidden" id="cantotal"  class="input6" disabled value="<?php echo number_format($ct); ?>" style="width: 40px;text-align: right"></th>
            <th></th>
            <th><?php echo number_format($gt); ?><input type="hidden" id="subgrantotal"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($gt,2,'.',''); ?>"></th>
            <th><?php echo number_format($gtiva); ?><input type="hidden" id="grantotal"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($gtiva,2,'.',''); ?>"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php
        mysqli_query($con,"update cotizacion set costo_total='$gt' where id_cot='$cot' ");
        break;
        case 8:
        $id=$_GET['id'];
            mysqli_query($con,"delete from cotizacion_insumos where id_cot_item='$id' ");
            mysqli_query($con,"delete from cotizacion_item where id_cot_item='$id' ");
            mysqli_query($con,"delete from cotizacion_item where id_cot_principal='$id' ");

        break;
        case 9:
        $id  = $_GET['id'];
        $rep = $_GET['rep'];

        $result = mysqli_query($con,"select * from cotizacion_item where id_cot_item='$id' ");
        $row = mysqli_fetch_array($result);
        for($i=0;$i<$rep;$i++){
         //$ct = $_GET['ct'] + $i;

           mysqli_query($con,"INSERT INTO `cotizacion_item` (`id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`, `descripcion_segunda`,                                                                                                                                                                                                                                             `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`, `por_ace`, `por_esp`, `por_int`, `imprevisto`, `utilidad`, `total_mob`, `total_ins`, `anchocfd`, `altocfs`, `anchocfi`, `altocfi`, `altorej`, `ancho_general`, `alto_general`, `id_parametro_vidrio`, `hoja_vidrio`, `rieles`, `alfajia`, `rejillas`, `cierres`, `rodajas`, `entre_rej`, `modulo`, `color`, `compuesto`, `total_compuestos`, `brazos`, `bisagras`, `bisagras_cant`, `can_cierres`, `ruta`, `ancho_total`, `alto_total`, `nota`, `can_rodajas`, `can_brazos`, `trazvid1`, `trazvid2`, `trazvid3`, `trazvid4`)"
                                              . " VALUES ('".$row['id_cot']."','".$row['codigo']."','".$row['descripcion_principal']."','".$row['trazabilidad']."','".$row['descripcion_segunda']."','".$row['ancho']."', '".$row['alto']."','".$row['cantidad']."','".$row['laminas']."','".$row['perforacion']."','".$row['boquete']."','".$row['pelicula']."','".$row['carton']."','".$row['linea_cot']."', '".$row['id_cot_principal']."','".$row['ubicacion']."','".$row['observacion']."', '".$row['item']."','".$row['instalaccion']."','".$row['valor_item']."','".$row['descuento']."','".$row['iva']."','".$row['fecha_registro']."','".$row['usuario']."', '".$row['estado']."', '".$row['por_vid']."', '".$row['por_alu']."', '".$row['por_acc']."', '".$row['por_acc']."', '".$row['por_acc']."', '".$row['por_acc']."', '".$row['por_acc']."', '".$row['por_ace']."', '".$row['por_esp']."', '".$row['por_int']."', '".$row['imprevisto']."', '".$row['utilidad']."', '".$row['total_mob']."', '".$row['total_ins']."', '".$row['anchocfi']."', '".$row['altocfi']."', '".$row['altorej']."', '".$row['ancho_general']."', '".$row['alto_general']."', '".$row['id_parametro_vidrio']."', '".$row['hoja_vidrio']."', '".$row['rieles']."', '".$row['alfajia']."', '".$row['cierres']."', '".$row['rodajas']."', '".$row['entre_rej']."', '".$row['modulo']."', '".$row['color']."', '".$row['compuesto']."', '".$row['total_compuestos']."', '".$row['bisagras']."', '".$row['bisagras_cant']."', '".$row['can_cierres']."', '".$row['ruta']."', '".$row['ancho_total']."', '".$row['alto_total']."', '".$row['nota']."', '".$row['can_rodajas']."', '".$row['can_brazos']."', '".$row['trazvid1']."', '".$row['trazvid2']."', '".$row['trazvid3']."', '".$row['trazvid4']."')");
           $error =  mysqli_error($con);
           $max = mysqli_insert_id($con);
           $idp = $row['id_cot_item'];
           $result2 = mysqli_query($con,"select * from cotizacion_item where id_cot_principal='$idp' ");
           while($f = mysqli_fetch_array($result2)){
                mysqli_query($con,"INSERT INTO `cotizacion_item` (`id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`, `descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`, `por_ace`, `por_esp`, `por_int`, `imprevisto`, `utilidad`, `total_mob`, `total_ins`, `anchocfd`, `altocfs`, `anchocfi`, `altocfi`, `altorej`, `ancho_general`, `alto_general`, `id_parametro_vidrio`, `hoja_vidrio`, `rieles`, `alfajia`, `rejillas`, `cierres`, `rodajas`, `entre_rej`, `modulo`, `color`, `compuesto`, `total_compuestos`, `brazos`, `bisagras`, `bisagras_cant`, `can_cierres`, `ruta`, `ancho_total`, `alto_total`, `nota`, `can_rodajas`, `can_brazos`, `trazvid1`, `trazvid2`, `trazvid3`, `trazvid4`)"
                   . " VALUES ('".$f['id_cot']."','".$f['codigo']."','".$f['descripcion_principal']."','".$f['trazabilidad']."','".$f['descripcion_segunda']."','".$f['ancho']."', '".$f['alto']."','".$f['cantidad']."','".$f['laminas']."','".$f['perforacion']."','".$f['boquete']."','".$f['pelicula']."','".$f['carton']."','".$f['linea_cot']."', '".$max."','".$f['ubicacion']."','".$f['observacion']."', '".$f['item']."','".$f['instalaccion']."','".$f['valor_item']."','".$f['descuento']."','".$f['iva']."','".$f['fecha_registro']."','".$f['usuario']."', '".$f['estado']."', '".$f['por_vid']."', '".$f['por_alu']."', '".$f['por_acc']."', '".$f['por_acc']."', '".$f['por_acc']."', '".$f['por_acc']."', '".$f['por_acc']."', '".$f['por_ace']."', '".$f['por_esp']."', '".$f['por_int']."', '".$f['imprevisto']."', '".$f['utilidad']."', '".$f['total_mob']."', '".$f['total_ins']."', '".$f['anchocfi']."', '".$f['altocfi']."', '".$f['altorej']."', '".$f['ancho_general']."', '".$f['alto_general']."', '".$f['id_parametro_vidrio']."', '".$f['hoja_vidrio']."', '".$f['rieles']."', '".$f['alfajia']."', '".$f['cierres']."', '".$f['rodajas']."', '".$f['entre_rej']."', '".$f['modulo']."', '".$f['color']."', '".$f['compuesto']."', '".$f['total_compuestos']."', '".$f['bisagras']."', '".$f['bisagras_cant']."', '".$f['can_cierres']."', '".$f['ruta']."', '".$f['ancho_total']."', '".$f['alto_total']."', '".$f['nota']."', '".$f['can_rodajas']."', '".$f['can_brazos']."', '".$f['trazvid1']."', '".$f['trazvid2']."', '".$f['trazvid3']."', '".$f['trazvid4']."')");
          
               
           }
           $result3 = mysqli_query($con,"select * from cotizacion_insumos a, productos_var b where a.codigo=b.codigo and a.id_cot_item='$idp' ");
           $totalx = 0;
           while($r = mysqli_fetch_array($result3)){
               mysqli_query($con,"INSERT INTO `cotizacion_insumos` (`extra`,`id_cot`, `codigo`, `id_cot_item`, `cantidad`, `unidad`, `precio_unidad`, `medida`, `color`,`item`,`porcentaje`,`tipomat`) "
                        . "VALUES ('".$r['extra']."','".$r['id_cot']."', '".$r['codigo']."', '".$max."', '".$r['cantidad']."', '".$r['unidad']."', '".$r['precio_unidad']."', '".$r['medida']."', '".$r['color']."','".$r['item']."', '".$r['porcentaje']."','".$r['tipomat']."');");
           }
           
           $result4 = mysqli_query($con,"select * from cotizaciones_servicios where id_cot_mas='$idp' ");
           while($r = mysqli_fetch_array($result4)){
                 mysqli_query($con, "insert into cotizaciones_servicios (id_cot_mas,id_cotizacion,id_servicio,descripcion_ser,precio_serv,cantidad_serv,descuento_serv,parafiscales,precio_und,precio_total,cod_ser,obs_servicio,registrado_por)"
                            . " values ('".$max."','".$r['id_cotizacion']."','".$r['id_servicio']."','".$r['descripcion_ser']."','".$r['precio_serv']."','".$r['cantidad_serv']."','".$r['descuento_serv']."','".$r['parafiscales']."','".$r['precio_und']."','".$r['precio_total']."','".$r['cod_ser']."','".$r['obs_servicio']."','".$r['registrado_por']."') ");
           }
          
           
           
        }
        
    echo 'ex.'.$error;

        break;
        case 10:
        $linea= 'Vidrio';
        $id_cot= $_GET["id_cot"];
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $vid2= $_GET["vid2"];
        $vid3= $_GET["vid3"];
        $vid4= $_GET["vid4"];
        $cot= $_GET["cot"];
        $cliente= $_GET["idc"];
        $precio_mp ='P1';
        $precio= 'P1';
        $ancho = $_GET["ancho"];
        $cantidad = $_GET["cant"];
        $alto = $_GET["alto"];
        $pelicula = $_GET["pelicula"];
        $install = $_GET["install"];
        $desc= $_GET["desc"];
        $per= $_GET["per"];
        $boq= $_GET["boq"];
        $rep= $_GET["rep"];
        $p4= $_GET["p4"];
        $p5= $_GET["p5"];
        $p6= $_GET["p6"];
        $p7= $_GET["p7"];
        $ajuste= $_GET["ajuste"];
        $ubc= $_GET["ubc"];
        $obse= $_GET["obse"];
        $fila= $_GET["fila"];
        $precioitem= $_GET["precio"];
        $adi= $_GET["adi"];
        $pi = $precioitem * ($desc/100);
        $pitem = $precioitem + $pi;
        $sql = "update cotizaciones set  `adicional_per`='$adi',`ajuste`='$ajuste',`ubicacion_c`='$ubc',`observaciones`='$obse',`fila`='$fila',`id_vidrio`='$vid',`id_vidrio2`='$vid2',`id_vidrio3`='$vid3',`id_vidrio4`='$vid4', `cantidad_c`='$cantidad', `cant_restante`='$cantidad', `valor_c`= '$p4', `valor_c_sp`='$p5', `valor_fom`='$p6', `valor_fomp`='$p7', `precio_item`='$pitem', `desc`='".$desc."', `per`='$per', `boq`='$boq', `ancho_c`='$ancho', `alto_c`='$alto' where `id_cotizacion`='".$id_cot."'; ";
        $ver = mysqli_query($con,$sql, $conexion);
        echo $pi;
        break;
        case 11:
        $request2=mysqli_query($con,'select * from cotizacion a, cont_terceros b WHERE a.id_tercero=b.id_ter and a.id_cot="'.$_GET["cot"].'"');
        $row2=mysqli_fetch_array($request2);
        $p = array();
        $p[0] = $row2["id_ter"];
        $p[1] = $row2["cod_ter"];
        $p[2] = $row2["dir_ter"];
        $p[3] = $row2["telfijo_ter"];
        $p[4] = $row2["telmovil_ter"];
        $p[5] = $row2["correo_ter"];
        $p[6] = $row2["cont_ter"];
        $p[7] = $row2["nom_ter"];
        $p[8] = $row2["ciudad_ter"];
        $p[9] = $row2["municipio_ter"];
        $p[10] = $row2["vendedor"];
        $p[11] = $row2["pvi"];
        $p[12] = $row2["ubicacion"];
        $p[13] = $row2["obra"];
        $p[14] = substr($row2["fecha_reg_c"],0,-9);
        $p[15] = $row2["registrado"];
        $p[16] = $row2["estado"];
        $p[17] = $row2["linea"];
        $p[18] = $row2["tel_responsable"];
        $p[19] = $row2["ciudad"];
        $p[20] = $row2["municipio"];
        $p[21] = $row2["numero_cotizacion"];
        $p[22] = $row2["version"];
        $p[23] = $row2["validez"];
        $p[24] = $row2["express"];
        $p[25] = $row2["fecha_de_entrega"];
        $p[26] = $row2["nota"];
        $p[27] = $row2["presupuesto"];
        $p[28] = $row2["registrado"];
        $p[29] = $row2["desp_vid"];
        $p[30] = $row2["desp_alu"];
        $p[31] = $row2["desp_acc"];
        $p[32] = $row2["desp_ace"];
        $p[33] = $row2["desp_esp"];
        $p[34] = $row2["desp_int"];
        $p[35] = $row2["utilidad"];
        $p[36] = $row2["sel_iva"];
                
        echo json_encode($p);
        exit();
        break;
        case 12:
        $ref= $_GET["ref"];
        $esp= $_GET["esp"];
        $pre= $_GET["pre"];
        $und= $_GET["und"];
        $aju= $_GET["aju"];
        $user= $_SESSION['k_username'];
        $fecha= date('Y-m-d');
        $ver = mysqli_query($con,"select count(id_ajuste), id_ajuste from ajustes where id_referencia=$ref and id_vidrio=$esp  ");
        $v = mysqli_fetch_array($ver);
        if($v[0]==0){
            $ok = mysqli_query($con,"insert into ajustes (id_referencia, id_vidrio, valor, precio, ajuste, por) values ($ref,$esp,$pre,$und,$aju, '$user')");
            echo $ok;
        }else{
           $id = $v[1];
           mysqli_query($con,"update ajustes set precio = $pre, valor= $und, ajuste= $aju, por= '$user' where id_ajuste=$id ");
            echo "2";
        }


        break;
        case 13:
            if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='STEFANNYR' || $_SESSION['k_username']=='TATIANA.JULIAO' || $_SESSION['k_username']=='LTAMAYO'){
                $dis = '';
            }else{
                $dis = 'disabled';
            }
        if($_GET['pro']!=''){
          $pro = ' and c.id_referencia = "'.$_GET['pro'].'" ';
        }else{
            $pro = '  ';
        }
        if($_GET['esp']!=''){
           $esp= ' and c.id_vidrio like "%'.$_GET['esp'].'%" ';
        }else{
           $esp = '';
        }
        $result = mysqli_query($con,"SELECT id_ajuste, producto, color_v, valor, ajuste, precio, fecha, por, c.id_referencia, c.id_vidrio FROM producto a, tipo_vidrio b, ajustes c where a.id_p=c.id_referencia and b.id_vidrio=c.id_vidrio ".$esp."  ".$pro." ");
    
        while ($r = mysqli_fetch_array($result)) {
           echo "<tr>
               <td>$r[0]</td>
               <td>".$r[8]." - ".$r[1]."</td>
               <td>".$r[9]." - $r[2]</td>
               <td><input type='' id='a".$r[0]."' value='".$r[3]."' style='width:80px;text-align:right' onchange='ajuste_manual(".$r[0].")' disabled></td>
               <td><input type='' id='b".$r[0]."' value='".$r[4]."' style='width:80px;text-align:right' onchange='ajuste_manual(".$r[0].")' disabled></td>
               <td><input type='' id='c".$r[0]."' value='".$r[5]."' style='width:80px;text-align:right' onchange='ajuste_manual(".$r[0].")' $dis></td>
               <td>$r[6]</td>
               <td id='por".$r[0]."'>$r[7]</td>"
            . "<td><button onclick='eliminar($r[0]);' $dis tittle='Eliminar registro'>x</button>"
                   . " <button onclick='recalcular(".$r[8].",".$r[9].",".$r[0].");' $dis  data-toggle='tooltip' data-placement='top' title='Recalcular Ajuste de precio y actualizarlo'>R</button>"
                   . "<span id='ok".$r[0]."'></span></td>";
        }

        break;
        case 14:
        $id= $_GET["id"];
        $vid= $_GET["vid"];
        $alu= $_GET["alu"];
        $ace= $_GET["ace"];
        mysqli_query($con,"update cont_terceros set pvi='$vid', pal='$alu', pac='$ace', autorizacion='".$_SESSION['k_username']."' where id_ter='$id' ");
        echo $_SESSION['k_username'];
        break;
        case 15:
        $id= $_GET["id"];
        $est= $_GET["est"];

        mysqli_query($con,"update tipo_vidrio set estado='$est', modi='".$_SESSION['k_username']."' where id_vidrio='$id' ");
        echo $_SESSION['k_username'];

        break;
        case 16:
        if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='STEFANNYR' || $_SESSION['k_username']=='TATIANA.JULIAO' || $_SESSION['k_username']=='LTAMAYO'){
        $id= $_GET["id"];
        mysqli_query($con,"delete from ajustes where id_ajuste='$id' ");
        }

        break;
        case 17:
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $ver = mysqli_query($con,"select count(*) from ajustes where id_referencia=$ref and id_vidrio=$vid  ");
        $v = mysqli_fetch_array($ver);
        echo $v[0];
        break;
        case 18:
        $linea= 'Vidrio';
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $vid2= 0;
        $vid3= 0;
        $vid4= 0;
        $precio_mp ='P1';
        $precio= 'P1';
        $an2 = 1000;
        $cann = 1;
        $all = 1000;
        $pelicula = 'No Aplica';
        $cantidad = $cann;
        $install ='No';
        $desc= 0;
        $des= 0;
        $m2 = (($an2/1000)*($all/1000))*$_GET['cant'];
        //PORCENTAJE DE P1 PARA LOS 4 VIDRIOS
//se quito esta parte para el calculo individual del vidrio sin el ajuste
            $vj = 0;
            $vjt = 0;
   
            if($_GET['per']>5){
            $_GET['per'] = $_GET['per'];
        }else{
            $_GET['per'] = 0;
        } 
        if($_GET['boq']>3){
            $_GET['boq'] = $_GET['boq'];
        }else{
            $_GET['boq'] = 0;
        }    
        //CALCULO DE VIDRIO 1
        if($vid!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid."'";
        $fi31 =mysqli_fetch_array(mysqli_query($con,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;
        
        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
        $result=  mysqli_query($con,$consulta);
        $total = 0;
        $stt =0;
        //echo 'cantidad'.$cantidad.'<br>';      
        while($fila=  mysqli_fetch_array($result)){
        $valor1=$fila['id_subpro'];
        $valor2=$fila['nombre_subpro'];
        $precio_a = $fila['precio'];
        $precio_adicional = $fila['precio_adicional'];
        $und_med = $fila['medida'];
        if($valor1==4){
        $pa = $precio_adicional * $_GET['per'];
        $cp = $_GET['per'];
        }else{
            if($valor1==5){
               $pa = $precio_adicional * $_GET['boq'];
               $cp = $_GET['boq'];
            }else{
            $pa = $precio_adicional;
            $cp = 1;
            }
        }
        if($valor1=='7'){
                $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
                $fit =mysqli_fetch_array(mysqli_query($con,$st));
                $cost= $fit["costo"];

                $st = $m2 * $cost;

        }else{ 
            $st = 0;
        }
        if($und_med=='Kg'){
            $pat = $peso * $pa;
            $ti = $peso * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='Und'){
            $pat = $cantidad * $pa;
            $ti = $cantidad * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='M2'){
            $pat = $m2 * $pa;
            $ti = $m2 * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        $total = $total  + $ti + $pat;
        $stt = $stt + $st;
        }
                $s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($con,$s3));
                $porc= $fi3["p"]/100;
                $totalv1 = $total + (($vvc)/$porc)+$stt;
                $totalv1sp = $total + (($vvc))+$stt;
                //echo $totalv1;  total de precio de vidrios con p1
                }else{
                   $totalv1 = 0 ;  $totalv1sp = 0 ;
                }
                
                //FIN DE CALCULO VIDRIO 1
                
                //CALCULO DE VIDRIO 2
                        if($vid2!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid2."'";
        $fi31 =mysqli_fetch_array(mysqli_query($con,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;
        
        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
        $result=  mysqli_query($con,$consulta);
        $total = 0;
        $stt =0;
        //echo 'cantidad'.$cantidad.'<br>';      
        while($fila=  mysqli_fetch_array($result)){
        $valor1=$fila['id_subpro'];
        $valor2=$fila['nombre_subpro'];
        $precio_a = $fila['precio'];
        $precio_adicional = $fila['precio_adicional'];
        $und_med = $fila['medida'];
        if($valor1==4){
        $pa = $precio_adicional * $_GET['per'];
        $cp = $_GET['per'];
        }else{
            if($valor1==5){
               $pa = $precio_adicional * $_GET['boq'];
               $cp = $_GET['boq'];
            }else{
            $pa = $precio_adicional;
            $cp = 1;
            }
        }
        if($valor1=='7'){
                $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
                $fit =mysqli_fetch_array(mysqli_query($con,$st));
                $cost= $fit["costo"];

                $st = $m2 * $cost;

        }else{ 
            $st = 0;
        }
        if($und_med=='Kg'){
            $pat = $peso * $pa;
            $ti = $peso * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='Und'){
            $pat = $cantidad * $pa;
            $ti = $cantidad * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='M2'){
            $pat = $m2 * $pa;
            $ti = $m2 * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        $total = $total  + $ti + $pat;
        $stt = $stt + $st;
        }
                $s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($con,$s3));
                $porc= $fi3["p"]/100;
                $totalv2 = $total + (($vvc)/$porc)+$stt;
                $totalv2sp = $total + (($vvc))+$stt;
                //echo $totalv1;  total de precio de vidrios con p1
                }else{
                   $totalv2 = 0 ;  $totalv2sp = 0 ;
                }
                
                //FIN DE CALCULO VIDRIO 2
                //CALCULO VIDRIO 3
                if($vid3!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid3."'";
        $fi31 =mysqli_fetch_array(mysqli_query($con,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;
        
        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
        $result=  mysqli_query($con,$consulta);
        $total = 0;
        $stt =0;
        //echo 'cantidad'.$cantidad.'<br>';      
        while($fila=  mysqli_fetch_array($result)){
        $valor1=$fila['id_subpro'];
        $valor2=$fila['nombre_subpro'];
        $precio_a = $fila['precio'];
        $precio_adicional = $fila['precio_adicional'];
        $und_med = $fila['medida'];
        if($valor1==4){
        $pa = $precio_adicional * $_GET['per'];
        $cp = $_GET['per'];
        }else{
            if($valor1==5){
               $pa = $precio_adicional * $_GET['boq'];
               $cp = $_GET['boq'];
            }else{
            $pa = $precio_adicional;
            $cp = 1;
            }
        }
        if($valor1=='7'){
                $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
                $fit =mysqli_fetch_array(mysqli_query($con,$st));
                $cost= $fit["costo"];

                $st = $m2 * $cost;

        }else{ 
            $st = 0;
        }
        if($und_med=='Kg'){
            $pat = $peso * $pa;
            $ti = $peso * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='Und'){
            $pat = $cantidad * $pa;
            $ti = $cantidad * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='M2'){
            $pat = $m2 * $pa;
            $ti = $m2 * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        $total = $total  + $ti + $pat;
        $stt = $stt + $st;
        }

                $totalv3 = $total + (($vvc)/$porc)+$stt;
                $totalv3sp = $total + (($vvc))+$stt;
                //echo $totalv1;  total de precio de vidrios con p1
                }else{
                   $totalv3 = 0 ;  $totalv3sp = 0 ;
                }
                
                //FIN DE CALCULO VIDRIO 3
                //CALCULO VIDRIO 4
                if($vid4!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid4."'";
        $fi31 =mysqli_fetch_array(mysqli_query($con,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;
        
        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
        $result=  mysqli_query($con,$consulta);
        $total = 0;
        $stt =0;
        //echo 'cantidad'.$cantidad.'<br>';      
        while($fila=  mysqli_fetch_array($result)){
        $valor1=$fila['id_subpro'];
        $valor2=$fila['nombre_subpro'];
        $precio_a = $fila['precio'];
        $precio_adicional = $fila['precio_adicional'];
        $und_med = $fila['medida'];
        if($valor1==4){
        $pa = $precio_adicional * $_GET['per'];
        $cp = $_GET['per'];
        }else{
            if($valor1==5){
               $pa = $precio_adicional * $_GET['boq'];
               $cp = $_GET['boq'];
            }else{
            $pa = $precio_adicional;
            $cp = 1;
            }
        }
        if($valor1=='7'){
                $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
                $fit =mysqli_fetch_array(mysqli_query($con,$st));
                $cost= $fit["costo"];

                $st = $m2 * $cost;

        }else{ 
            $st = 0;
        }
        if($und_med=='Kg'){
            $pat = $peso * $pa;
            $ti = $peso * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='Und'){
            $pat = $cantidad * $pa;
            $ti = $cantidad * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        if($und_med=='M2'){
            $pat = $m2 * $pa;
            $ti = $m2 * $precio_a*$cp;
        //    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
        }
        $total = $total  + $ti + $pat;
        $stt = $stt + $st;
        }
                $s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($con,$s3));
                $porc= $fi3["p"]/100;
                $totalv4 = $total + (($vvc)/$porc)+$stt;
                $totalv4sp = $total + (($vvc))+$stt;
                //echo $totalv1;  total de precio de vidrios con p1
                }else{
                   $totalv4 = 0 ;  $totalv4sp = 0 ;
                }
                
                //FIN DE CALCULO VIDRIO 4
                


                // SUMA DE ACCESORIOS
                 $acc_por = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($con,$acc_por));
                $porcacc= $fipa["p"]/100; 
                 $acc_porB = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MPB' and grupo='Accesorios'";
                $fipaB =mysqli_fetch_array(mysqli_query($con,$acc_porB));
                $porcaccB= $fipaB["p"]/100; 
                  $request_acE=mysqli_query($con,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." order by b.para ");
if($request_acE){

        $tac = 0; $tacfom = 0; $tacfomp = 0;
	while($row=mysqli_fetch_array($request_acE))
	{  
       //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysqli_query($con,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysqli_fetch_array($request_v2))
{
$sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($con,$sqlxy));
            $id_p= $fil_an["id_p"];
        
                if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_GET['ancho']+$fil_an["descuento"])+ $fil_an['variable'];
        
            }else{
                $al = ($_GET['alto']+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_GET['ancho']+$fil_an["descuento"])- $fil_an['variable'];
      
            }else{
                $al = ($_GET['alto']+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                 if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_GET['ancho']+$fil_an["descuento"])* $fil_an['variable'];
              
            }else{
                $al = ($_GET['alto']+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='/'){
               if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_GET['ancho']+$fil_an["descuento"])/ $fil_an['variable'];
           
            }else{
                $al = ($_GET['alto']+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
     $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
           
            //---------------------------------------------------------------------
   
            if($linea=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$_GET['alto']) / $row["metro"])+$row["cantidad_acc"]);
                     }else{
                         $res = ((($row["cantidad_acc"]*$_GET['ancho']) / $row["metro"])+$row["cantidad_acc"]);
                     }         
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{      
             if($row['calcular']=='ML'){
               $rs = $_GET['hoja'] * 2 * $row["cantidad_acc"];
               $res = (($_GET['ancho'] / 1000) * 2) + (($_GET['alto']/1000)*$rs);
            }ELSE{
                  if($row['calcular']=='M2'){
                      $res = (($_GET['alto'] / 1000)) * (($_GET['ancho']/1000))* $row["cantidad_acc"];
                }else{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$_GET['alto']) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$_GET['ancho']) / $row["metro"];
                     }             
                 }else{
                      $res = $row["cantidad_acc"];
                 }            
            }}}
             $taa = $cant_rej * $res;
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($taa*$_GET["cant"])).' ML';
                 $ft = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$_GET["cant"]).' '.$row["calcular"].' ';
                 $ft = 'No aplica' ;$a = '' ;
             }
            if($_GET['pelicula']!="No Aplica"  && $row['codigo']=='26002'){
            if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
            $tac = $tac + (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a);
//            echo (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
            $tacfom = $tacfom + (($taa * $v) * ($row["costo_fom"])*$m*$_GET['cant'] + $a);
            $tacfomp = $tacfomp + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$_GET['cant'] + $a);
           
            }
            if($row['codigo']!='26002'){ 
//                echo ($taa*($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
            $tac = $tac + ($taa*($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"])*$m*$_GET['cant'] + $a);
            $tacfomp = $tacfomp + ($taa*($row["costo_fom"]/$porcaccB)*$m*$_GET['cant'] + $a);
            }
           //echo $tac.'<br>';
	} 

}
$accesorios = $tac;
$accesorios_sinp = $tac * $porcacc;
$accesorios_fom = $tacfomp;
$accesorios_fom_sinp = $tacfomp * $porcaccB;
                // FIN DE ACCESORIOS
                // 
                $suma = $totalv1+$totalv2+$totalv3+$totalv4 + $accesorios;
                $suma_sp = $totalv1sp+$totalv2sp+$totalv3sp+$totalv4sp + $accesorios_sinp;
                $suma_fom = $totalv1+$totalv2+$totalv3+$totalv4 + $accesorios;
                $suma_fom_sin_p = $totalv1sp+$totalv2sp+$totalv3sp+$totalv4sp + $accesorios_sinp + $accesorios_sinp;
//comienzo de maquinaria          
$request_mano=mysqli_query($con,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$ref);    
if($request_mano){
        $tot2=0;$tot2fom=0;$tot2fomp=0; $totsinp = 0;
	while($row=mysqli_fetch_array($request_mano))
	{       
              $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            if($row['dias']=='Si'){
                if($_GET['alto']>3000){
                    $res = $mt2 /2.25;
                }else{
                    $res = 1;
                }
                $duracion=1;//esta variable viene del formulario, le coloque 1 
               $r = $row["porcentaje_ma"]*($res)*$duracion;
                $tot2 = $tot2 + $r ;
                $tot2fom = $tot2fom + $r ;
                $tot2fomp = $tot2fomp + $r ;
                $totsinp = $totsinp + $r ;
            }else{
                $r = $row["porcentaje_ma"]/100*$suma;
                $tot2 = $tot2 + $r;
                
                $r2 = $row["porcentaje_ma"]/100*$suma_fom;
                 $tot2fom = $tot2fom + $r2 ; 
                 
                 $r3 = $row["porcentaje_ma"]/100*$suma_fom_sin_p;
                 $tot2fomp = $tot2fomp + $r3 ;
                 
                 $r4 = $row["porcentaje_ma"]/100*$suma_sp;
                 $totsinp = $totsinp + $r4 ;
            }    
	} 
}
//fin de maquinaria
//
//comienzo de mano de obra
$maquina = $tot2;
$maquina_sinp = $totsinp;
$maquina_fom = $tot2fom;
$maquina_fom_sinp = $tot2fomp;

// fin mano de MAQUINARIA-------------------------------<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>

           $req=mysqli_query($con,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$ref);
        if($req){
        $tot=0;$tot_fom = 0;
	while($row=mysqli_fetch_array($req))
	{       
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            $mtl = ($_GET['ancho']/1000);
             if($mt2<1){
                $mt2 = 1;
            }  else {
                $mt2 = $mt2;
            }
           if($_GET["install"]=="Si"){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                   if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='ML'){
                    $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Und'){
                    $tarf =  ($_GET["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Kg'){
                    $tarf =  ($_GET["cant"]*$row["valor_mo"]);
                    
                }
                   if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
                       if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                    
                       $tot_fom = $tot_fom + ($tarf * $v);
                   }
                 if($row['referencia']!='26002'){
                       $tot_fom = $tot_fom + $tarf;
                   }
                }
                if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
                    if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                     $tot = $tot + ($tar * $v);
                  
                }
                if($row['referencia']!='26002'){
                     $tot = $tot + $tar;
                }
            }else{
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
                    if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                     $tot = $tot + ($tar * $v);
                }
                if($row['referencia']!='26002'){
                     $tot = $tot + $tar;
                }
                }else{
                    $tar = 0;
                }
            }
	} 

}
$mano = $tot;
$mano_fom = $tot_fom;

///FIN MANO DE OBRA ------------------------------------->>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<
$suma_maq = $suma + $maquina + $mano;
$suma_maq_sp = $suma_sp + $maquina_sinp + $mano;
$suma_maq_fom = $suma_fom + $maquina_fom + $mano_fom;
$suma_maq_fom_sin_p = $maquina_fom_sinp+ $suma_fom_sin_p + $mano;
$request_ad=mysqli_query($con,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$ref);
    

if($request_ad){

        $tota=0;  $tota_sinp=0;$totafom=0;$totafom_sinp=0;
	while($row=mysqli_fetch_array($request_ad))
	{              
             $por = 100;
              if($row['referencia_ad']!='ADM-007'){
                   $totafom = $totafom + ($suma_maq_fom*$row["porcentaje_ad"]/$por);
                   $totafom_sinp = $totafom_sinp + ($suma_maq_fom_sin_p*$row["porcentaje_ad"]/$por);
              }
             $tota = $tota + ($suma_maq*$row["porcentaje_ad"]/$por);
             $tota_sinp = $tota_sinp + ($suma_maq_sp*$row["porcentaje_ad"]/$por);
            
	} 

}
$admin = $tota;
$admin_sinp = $tota_sinp;
$admin_fom = $totafom;
$admin_fom_sinp = $totafom_sinp;
/// gastos administrativos
//echo 'otros'.$admin.'<br>';
//  FIN DE OTROS ---------------------------------<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>
  if(isset($totsi)){
    $si = $totsi;
}else{$si =0;}

$totalx = $suma_maq + $admin;
$totalx_sinp = $suma_maq_sp + $admin_sinp;
$totalxfom = $suma_maq_fom + $admin_fom;
$totalxfom_sinp = $suma_maq_fom_sin_p + $admin_fom_sinp;
// se verifica que tenga ajuste de precio

//porcentaje de venta P1
$s3 = "SELECT (".$precio.") as p FROM porcentajes where area_por='Vidrio'";
                $fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
                $mult = $fi3["p"]/100;
                $a = (($totalx / $mult));
                //valor unidad sin iva
                $und = ($a / $cann) ;
 
               $tiva = $a * 0.19;
               $t = $a + $tiva;
               $to = $t * ($desc/100);
               $total = $t + $to;
               
    if($und > 5000){

        $p = array();
        $p[0]= number_format($a,0,'','');
        $p[1]= number_format($tiva,0,'','');
        $p[2]= number_format($und,0,'','');
        $p[3]= number_format($total,0,'','');
        $p[4]=$totalx;
        $p[5]=$totalx_sinp;
        $p[6]=$totalxfom;
        $p[7]=$totalxfom_sinp;
        $p[8]= number_format($t,0,'','');
        $p[9]= 'vidrios: '.$suma.' - ';
        $p[10]= $vj;

        $pu = ($a / $cann);
        $descpor = $pu * ($desc / 100);
        $pud = $pu + $descpor;
        $p[11]= number_format($pud,0,'','');
        $p[12]= number_format(($pud * $cann),0,'','');
        
    }else{
        $p = array();
        $cadena_de_texto = $des;
        $cadena_buscada   = 'CRUDO';
        $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
        if ($posicion_coincidencia === false) {
            $precio = 10000;
        }else{
            $precio = 5000;
        }
               $tiva = ($precio*$cann) * 0.19;
               $t = ($precio*$cann) + $tiva;
               $to = $t * ($desc/100);
               $total = $t + $to;
               
        $p[0]= number_format($a,0,'','');
        $p[1]= number_format($tiva,0,'','');
        $p[2]= number_format($precio,0,'','');
        $p[3]= number_format($total,0,'','');
        $p[4]=$totalx;
        $p[5]=$totalx_sinp;
        $p[6]=$totalxfom;
        $p[7]=$totalxfom_sinp;
        $p[8]= number_format($t,0,'','');
        $p[9]= 'vidrios: '.$suma.' - ';
        $p[10]= $vj;

        $pu = $precio;
        $descpor = $pu * ($desc / 100);
        $pud = $pu + $descpor;
        $p[11]= number_format($pud,0,'','');
        $p[12]= number_format(($pud * $cann),0,'','');
        //$p[13]=$posicion_coincidencia;
    }
        
                
        echo json_encode($p);
        exit();
        
        break;
    case 19:
        $id = $_GET['id'];
        $cos = $_GET['cos'];
        $pre = $_GET['pre'];
        $aju = $_GET['aju'];
        $use = $_SESSION['k_username'];
        mysqli_query($con,"update ajustes set valor='$cos', precio='$pre', ajuste='$aju', por='$use' where id_ajuste='$id' ");
        echo $use;
        break;
        case 20:
            $cot = $_GET['cot'];
            $cod = $_GET['cod'];
            $id = $_GET['id'];
            $descri = $_GET['descri'];
            $col = $_GET['col'];
            $med = $_GET['med'];
            $can = $_GET['can'];
            $pre = $_GET['pre'];
            $pre_r = $_GET['pre_r'];
            $neto = $_GET['neto'];
            $tota = $_GET['tota'];
            $des = $_GET['des'];
            $m = $_GET['m'];
            
            $sql = "INSERT INTO `cotizaciones_materiales` (`color_ma`, `med`, `pe`, `id_cotizacion`, `id_material`, `cantidad_mat`, `descuento_mat`, `valor_und`, `valor_neto`, `valor_pagar`, `descripcion_material`, `codigo_material`)";
            $sql.= "VALUES ('".$col."', '".$med."', 'p1','".$cot."', '".$id."', '".$can."', '".$des."', '".$pre_r."', '".$neto."', '".$tota."', '".$descri."', '".$cod."')";
            $ver = mysqli_query($con,$sql, $conexion);
            echo $ver;
            
            
        break;
        case 21:
        $cot = $_GET['cot'];
        $query = mysqli_query($con,"select * from cotizaciones_materiales  where id_cotizacion = '$cot' ");
        $c = 0;
        $nt = 0;
        $tt = 0;
        while($f = mysqli_fetch_array($query)){
            $c ++;
            $codigo = $f['codigo_material'];
            if($f['linea']=='Accesorios'){
                 $pro = mysqli_query($con,"select descripcion from productos_var where codigo='$codigo' ");
                 $p = mysqli_fetch_array($pro);
                 $descr = $p[0];
                 $btn = '<button onclick="ver_ventas('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
            }else{
                 $pro = mysqli_query($con,"select pro_nombre from productos where pro_referencia='$codigo' ");
                 $p = mysqli_fetch_array($pro);
                 $descr = $p[0];
                 $btn = '<button onclick="ver_perfil('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
            }
           
            
            $tu = $f['valor_pagar']/$f['cantidad_mat'];
            $tom = $f['valor_pagar'];
            $iva = $tom * 0.19;
            $gt = $tom + $iva;
            $nt += $tom;
            $tt += $gt;
            echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td>'.$codigo.'</td>'
                    . '<td>'.$descr.'</td>'
                    . '<td>'.$f['mat_color'].'</td>'
                    . '<td>'.$f['med'].'</td>'
                    . '<td>'.$f['cantidad_mat'].'</td>'
                    . '<td style="text-align:right">'.number_format($tu,2).'</td>'
                    . '<td style="text-align:right">'.number_format($tom,2).'</td>'
//                    . '<td style="text-align:right">'.number_format($iva,2).'</td>'
//                    . '<td style="text-align:right">'.number_format($gt,2).'</td>'
                    . '<td>'.$btn.' '
                    . ' <button id="btn_del_ven" onclick="del_ventas('.$f[0].')" class="btn btn-danger"> <i class="ace-icon fa fa-trash-o"></i> </button></td>';
        }
        echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right">'.number_format($nt,2).'</td>'
//                    . '<td style="text-align:right"></td>'
//                    . '<td style="text-align:right">'.number_format($tt,2).'</td>'
                    . '<td></td>';
        break;
        case 21.1:
        $cot = $_GET['cot'];
        $query = mysqli_query($con,"select * from cotizaciones_servicios  where id_cotizacion = '$cot' ");
        $c = 0;
        $nt = 0;
        $tt = 0;
        while($f = mysqli_fetch_array($query)){
            $c ++;

           $btn = '<button onclick="ver_servicios('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
           
           
            
            $tu = $f['precio_total']/$f['cantidad_serv'];
            $tom = $f['precio_total'];
            $iva = $tom * 0.19;
            $gt = $tom + $iva;
            $nt += $tom;
            $tt += $gt;
            if($f['id_cot_mas']=='0'){
                $ico = '';
            } else{
                $ico = '<i class="icon fa-windows"></i>';
            }
            echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td>'.$f['id_servicio'].' '.$ico.'</td>'
                    . '<td>'.$f['descripcion_ser'].'</td>'
                    . '<td>'.$f['cod_ser'].'</td>'
                    . '<td>'.$f['precio_serv'].'</td>'
                    . '<td>'.$f['cantidad_serv'].'</td>'
                    . '<td style="text-align:right">'.number_format($f['precio_und'],2).'</td>'
                    . '<td style="text-align:right">'.number_format($f['precio_total'],2).'</td>'
                    . '<td>'.$btn.' '
                    . ' <button id="btn_del_ven" onclick="del_servicios('.$f[0].')" class="btn btn-danger"> <i class="ace-icon fa fa-trash-o"></i> </button></td>';
        }
        echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right">'.number_format($nt,2).'</td>'
//                    . '<td style="text-align:right"></td>'
//                    . '<td style="text-align:right">'.number_format($tt,2).'</td>'
                    . '<td></td>';
        break;
        
         case 21.2:
        $cot = $_GET['cot'];
        $item = $_GET['item'];
        $query = mysqli_query($con,"select * from cotizaciones_servicios  where id_cotizacion = '$cot' and id_cot_mas='$item' ");
        $c = 0;
        $nt = 0;
        $tt = 0;
        while($f = mysqli_fetch_array($query)){
            $c ++;

           $btn = '<button onclick="ver_servicios('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
           
           
            
            $tu = $f['precio_total']/$f['cantidad_serv'];
            $tom = $f['precio_total'];
            $iva = $tom * 0.19;
            $gt = $tom + $iva;
            $nt += $tom;
            $tt += $gt;
            if($f['id_cot_mas']=='0'){
                $ico = '';
            } else{
                $ico = '<i class="icon fa-windows"></i>';
            }
            echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td>'.$f['id_servicio'].' '.$ico.'</td>'
                    . '<td>'.$f['descripcion_ser'].'</td>'
                    . '<td>'.$f['cod_ser'].'</td>'
                    . '<td>'.$f['precio_serv'].'</td>'
                    . '<td>'.$f['cantidad_serv'].'</td>'
                    . '<td style="text-align:right">'.number_format($f['precio_und'],2).'</td>'
                    . '<td style="text-align:right">'.number_format($f['precio_total'],2).'</td>'
                    . '<td>'.$btn.' '
                    . ' <button id="btn_del_ven" onclick="del_servicios('.$f[0].')" class="btn btn-danger"> <i class="ace-icon fa fa-trash-o"></i> </button></td>';
        }
        echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right">'.number_format($nt,2).'</td>'
//                    . '<td style="text-align:right"></td>'
//                    . '<td style="text-align:right">'.number_format($tt,2).'</td>'
                    . '<td></td>';
        break;
    case 22:
        $id = $_GET['id'];

        $resultp = mysqli_query($con,"select id_cot_item from cotizaciones_materiales where id_cot_mat='$id' ");
         $r = mysqli_fetch_array($resultp);
         $item = $r[0];
        $query = mysqli_query($con,"delete from cotizaciones_materiales where id_cot_mat = '$id' ");
        echo $query;
        
        $result = mysqli_query($con,"select sum(total_material) from cotizaciones_materiales where id_cot_item='$item' ");
            $g = mysqli_fetch_array($result);
            $gt = $g[0];
             mysqli_query($con,"update cotizacion_item set total_material='$gt' where id_cot_item='$item' ");
        break;
    case 22.1:
        $id = $_GET['id'];
        $result = mysqli_query($con,"select id_cot_mas,total_ins from cotizaciones_servicios where  id_cot_serv = '$id'");
        $c = mysqli_fetch_array($result);
        $item = $c[0];
        $total= $c[1];
        $query = mysqli_query($con,"delete from cotizaciones_servicios where id_cot_serv = '$id' ");
        
        mysqli_query($con,"update cotizacion_item set total_ins=total_ins+'$total' where id_cot_item='$item' ");
        
        if($query==1){
            echo 'Se elimino con exito';
        }else{
            echo 'Error al procesar los datos';
        }
        break;
    case 23:
         $id = $_GET['id'];
          $uti = $_GET['uti'];
           $costo = $_GET['cos'];
           $ver = mysqli_query($con,"update referencias set costo_mt='$costo', utilidad='$uti', modificado='".$_SESSION['k_username']."' where id_referencia='$id' ");
           echo $ver;
           break;
    case 24:
        $cod= $_GET['cod'];
        $result = mysqli_query($con,"select a.secuencia,b.nombre_puesto from hojas_rutas a, puestos_trabajos b where a.codigo_pue=b.id_puesto and a.codigo_pro='$cod' ");
        echo '<ul>';
       
        while($r = mysqli_fetch_array($result)){
            echo '<li>'.$r[0].' '.$r[1];
        }
        break;
    case 25:
        $n= $_GET['n'];
        $cod= $_GET['cod'];
        $can= $_GET['can'];
        $desp= $_GET['desp'];
        $dtx= $_GET['dt'];
        $ancho = $_GET['ancho'];
        $alto = $_GET['alto'];
        $cot = $_GET['cot'];
        $idins = $_GET['idins'];
        $itemid = $_GET['item'];
        $extra = $_GET['extra'];
        $tipo = $_GET['tipo'];
        $porcentaje = (100 - $desp)/100;
        $mt2 = ($ancho/1000) * ($alto/1000) * $can;
        $mt = ((($ancho/1000) + ($alto/1000)) * 2) * $can;
        $medida = $ancho.'x'.$alto;

        $result = mysqli_query($con,"select b.costo_promedio, a.id_pp, a.und_med, a.cantidad,a.parametro from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.codigo_pro='$cod' and a.codigo_ref='$dtx' ");
        $r = mysqli_fetch_array($result);
        $id = $r[1];
        $med = $r[2];
        $canins = $r[3];
        $par = $r[4];

        if($med=='und'){
            $subcan = $can * $canins;
        }else if($med=='m2'){
            $subcan = $canins * $mt2;
        }else if($med=='mt'){
            $subcan = $mt * $canins;
        }else{
            $subcan = $can * $canins;
        }
        $st1 = $r[0] * $subcan;
        $result2 = mysqli_query($con,"select b.costo_promedio, a.id_pp, a.und_med, a.cantidad from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.compuesto='$id' and tipo='Fijo' order by parametro asc ");
        $st = 0;
        $costo = '';
        while($sr = mysqli_fetch_array($result2)){
            
                $medcom = $sr[2];
                $caninscom = $sr[3];
                if($medcom=='und'){
                    $subcancomp = $can * $caninscom;
                }else if($medcom=='m2'){
                    $subcancomp = $caninscom * $mt2;
                }else if($medcom=='mt'){
                    $subcancomp = $mt * $caninscom;
                    //$costo .= $mt.' * ='.$caninscom.'= id'.$id.',,';
                }else{
                    $subcancomp = $can * $caninscom;
                }
                 $su = $sr[0] * $subcancomp;
                $st += $su;
                $costo .= $mt2.' <'.$subcancomp.' X '.$sr[0].' = '.$su.'>';
        }
        if($par=='espaciadores'){
            $item = 'ES'.$n;
        }else{
                $item = 'EN'.$n;
        }
        
        $tod = $st1 + $st ;
        $tod = $tod;//  / $porcentaje
        $toddesp = $tod / $porcentaje;
        $to = $tod / $can;
        if($idins==''){
             mysqli_query($con,"INSERT INTO `cotizacion_insumos` (`porcentaje`,`tipomat`,`extra`,`id_cot`, `codigo`, `id_cot_item`, `cantidad`, `unidad`, `precio_unidad`, `medida`, `color`,`item`) "
                        . "VALUES ('$desp','$tipo','$extra','$cot', '$cod', '$itemid', '$subcan', '$med', '$to', '$medida', '','$item');");
             $idins = mysqli_insert_id($con);
        }else{
            mysqli_query($con,"update cotizacion_insumos set porcentaje='$desp',tipomat='$tipo',codigo='$cod',unidad='$med',cantidad='$subcan', medida='$medida',id_cot_item='$itemid',item='$item',precio_unidad='$to' where id_cot_ins='$idins' ");
            
        }
        $p = array();
        $p[0] = number_format($to,2,'.','');
        $p[1] = number_format($tod,2,'.','');
        $p[2] = $subcan;
        $p[3] = $med;
        $p[4] = 'res 1: '.$st1.' res 2:'.$st.' costo 1:'.$r[0].' costo 2:'.$costo.' SUBCANT: '.$subcan;
        $p[5] = $item;
        $p[6] = $id;
        $p[7] = $idins;
        $p[8] = number_format($toddesp,2,'.','');
        echo json_encode($p);
        break;
    case 26:
        echo $cod = $_GET['codigo'];
        $coditem = $_GET['codigoitem'];
        $item = $_GET['item'];
        $idpp = $_GET['idpp'];
        $query = mysqli_query($con , "select b.costo_promedio, a.id_pp, a.und_med, a.cantidad, a.codigo_pro, b.descripcion from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.compuesto='$idpp' and a.tipo='Seleccionable' order by parametro asc ");
        echo '<option value="">Seleccione</option>';
        while($r = mysqli_fetch_array($query)){
            echo '<option value="'.$r['codigo_pro'].'">'.$r['codigo_pro'].' '.$r['descripcion'].'</option>';
        } 
        break;
    case 27:
        $cot = $_GET['cot'];
        $des = $_GET['des'];
        $des0 = $_GET['des0'];
        $lam = $_GET['lam'];
        $cod = $_GET['cod'];
        $ancho = $_GET['ancho'];
        $alto = $_GET['alto'];
        $cant = $_GET['cant'];
        $per = $_GET['per'];
        $boq = $_GET['boq'];
        $pelicula = $_GET['pelicula'];
        $carton = $_GET['carton'];
        $despvid = $_GET['despvid'];
        $despalu = $_GET['despalu'];
        $despacc = $_GET['despacc'];
        $inst = $_GET['inst'];
        $ubc = $_GET['ubc'];
        $obse = $_GET['obse'];
        $item = $_GET['item'];
        $desc = $_GET['desc'];
        $valor = $_GET['precio'];
        $estado = $_GET['estado'];
        $comision = $_GET['comision'];
        $reposicion = $_GET['reposicion'];
        $imprevisto = $_GET['imprevisto'];
        $utilidad = $_GET['utilidad'];
        
 
        if($estado==''){
        mysqli_query($con,"INSERT INTO `cotizacion_item` (`utilidad`, `id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`,`descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`) "
                . "VALUES ('$utilidad', '$cot', '$cod', '$des', '$cod', '$des0', '$ancho', '$alto', '$cant', '$lam', '$per', '$boq', '$pelicula', '$carton', 'Vidrio', '0', '$ubc', '$obse', '$item', '$inst', '$valor', '$desc', '19', '$fecha', '$usuario', 'En proceso','$despvid','$despalu','$despacc');");
        $id = mysqli_insert_id($con);
        
        }else{
            mysqli_query($con,"update cotizacion_item set utilidad='$utilidad', descripcion_principal='$des',descripcion_segunda='$des0',laminas='$lam',cantidad='$cant',valor_item='$valor',por_vid='$despvid',por_alu='$despalu',por_acc='$despacc',instalaccion='$inst',pelicula='$pelicula' where id_cot_item='$item' ");
            $id = $item;
            mysqli_query($con,"delete from cotizacion_item where id_cot_principal='$item' ");
            mysqli_query($con,"delete from cotizacion_insumos where id_cot_item='$item' ");
        }
        
        $p = array();
        $p[0] =  $id;
        $p[1] =  mysqli_error($con);
        echo json_encode($p);
        
        break;
        case 28:
        $cot = $_GET['cot'];
        $des = $_GET['des'];
        $des0 = $_GET['des0'];
        $lam = $_GET['lam'];
        $cod = $_GET['cod'];
        $ancho = $_GET['ancho'];
        $alto = $_GET['alto'];
        $cant = $_GET['cant'];
        $per = $_GET['per'];
        $boq = $_GET['boq'];
        $pelicula = $_GET['pelicula'];
        $carton = $_GET['carton'];
        $despvid = $_GET['despvid'];
        $despalu = $_GET['despalu'];
        $despacc = $_GET['despacc'];
        $inst = $_GET['inst'];
        $ubc = $_GET['ubc'];
        $obse = $_GET['obse'];
        $item = $_GET['item'];
        $desc = $_GET['desc'];
        $valor = $_GET['precio'];
        $estado = $_GET['estado'];
        $itemv = $_GET['itemv'];
        $idlam = $_GET['idlam'];
        $traz = $_GET['traz'];
        
        $comision = $_GET['comision'];
        $reposicion = $_GET['reposicion'];
        $imprevisto = $_GET['imprevisto'];
        $utilidad = $_GET['utilidad'];
        $mob = $_GET['mob'];
        
        if($idlam==''){
        mysqli_query($con,"INSERT INTO `cotizacion_item` (`total_mob`,`id_cot`, `codigo`, `descripcion_principal`,`trazabilidad`, `descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`) "
                . "VALUES ('$mob' ,'$cot', '$cod', '$des', '$traz', '$des0', '$ancho', '$alto', '$cant', '$lam', '$per', '$boq', '$pelicula', '$carton', 'Vidrio', '$item', '$ubc', '$obse', '$itemv', '$inst', '$valor', '$desc', '19', '$fecha', '$usuario', 'En proceso','$despvid','$despalu','$despacc');");
        $id = mysqli_insert_id($con);
        $error = mysqli_error($con);
        
        }else{
            mysqli_query($con,"update cotizacion_item set codigo='$cod' ,total_mob='$mob' ,trazabilidad='$traz',descripcion_principal='$des',descripcion_segunda='$des0',laminas='$lam',cantidad='$cant',valor_item='$valor',por_vid='$despvid',por_alu='$despalu',por_acc='$despacc' where id_cot_item='$idlam' ");
            $id = $idlam;
            $error = mysqli_error($con);
        }
         mysqli_query($con,"update cotizacion_item set descripcion_principal='$des0' where id_cot_item='$item' ");
        $p = array();
        $p[0] =  $id;
        $p[1] =  $error;
        
        echo json_encode($p);
        
        break;
    case 29:
        $cod = $_GET['dtx'];
        $can = $_GET['can'];
        $result = mysqli_query($con,"select * from cotizacion_insumos a, productos_var b where a.codigo=b.codigo and a.id_cot_item='$cod' and a.extra='Si' ");
        $total = 0;
        while($r = mysqli_fetch_array($result)){
            $total += ($r['precio_unidad']*$can);
                    echo '<tr>';
                    echo '<td>'.$r['item'].'</td>
                          <td>'.$r['codigo'].'<td>'.$r['descripcion'].'</td>
                          <td>'.$r['cantidad'].'</td>
                          <td>'.$r['unidad'].'</td>
                          <td>'.$r['precio_unidad'].'</td>
                          <td>'.number_format($r['precio_unidad']*$can,2,'.','').' <button onclick="borrar_comp('.$r['id_cot_ins'].')"> - </button></td>';
        }
        echo '<tr><td colspan="5">Total Insumos extras<td><input type="number" id="total_comp" value="'.$total.'" style="width:60px;" disabled>';
        break;
    case 30:
        $id = $_GET['id'];
        mysqli_query($con, "delete from cotizacion_insumos where id_cot_ins='$id' ");
        
        break;
    case 31:
        $cot = $_GET['cot'];
        $des = $_GET['des'];
        $des0 = $_GET['des0'];
        $lam = $_GET['lam'];
        $cod = $_GET['cod'];
        $ancho = $_GET['ancho'];
        $alto = $_GET['alto'];
        $cant = $_GET['cant'];
        $per = $_GET['per'];
        $boq = $_GET['boq'];
        $pelicula = $_GET['pelicula'];
        $carton = $_GET['carton'];
        $despvid = $_GET['despvid'];
        $despalu = $_GET['despalu'];
        $despacc = $_GET['despacc'];
        
        $inst = $_GET['inst'];
        $ubc = $_GET['ubc'];
        $obse = $_GET['obse'];
        $item = $_GET['item'];
        $itemx = $_GET['itemx'];
        $desc = $_GET['desc'];
        $despesp = $_GET['despesp'];
        $despint = $_GET['despint'];
        $valor = $_GET['precio'];
        $estado = 'Guardado';
        $utilidad = $_GET['utilidad'];

        mysqli_query($con,"update cotizacion_item set utilidad='$utilidad', ancho='$ancho', alto='$alto', por_esp='$despesp' ,por_int='$despint' ,estado='$estado' ,descripcion_principal='$des',descripcion_segunda='$des0',laminas='$lam',cantidad='$cant',valor_item='$valor',por_vid='$despvid',por_alu='$despalu',por_acc='$despacc',item='$itemx',pelicula='$pelicula', instalaccion='$inst'  where id_cot_item='$item' ");
        echo mysqli_error($con);
        mysqli_query($con,"update cotizacion_item set estado='$estado' where id_cot_principal='$item' ");
        
        break;
    case 32:
        $item = $_GET['item'];
        $result = mysqli_query($con, "select * from cotizacion_item where id_cot_item='$item' ");
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
        
        
        
        echo json_encode($p);
        
        break;
    case 33:
        $idcot = $_GET['idcot'];
        $por_vid=  $_GET['por_vid'];
        $por_alu=  $_GET['por_alu'];
        $por_acc=  $_GET['por_acc'];
        $por_ace=  $_GET['por_ace'];
        $por_esp=  $_GET['por_esp'];
        $por_int=  $_GET['por_int'];
        $utilidad=  $_GET['utilidad'];
        $ver = mysqli_query($con, "update cotizacion set utilidad='$utilidad', desp_vid='$por_vid', desp_alu='$por_alu' , desp_acc='$por_acc' , desp_ace='$por_ace', desp_esp='$por_esp',desp_int='$por_int' where id_cot='$idcot' ");
        echo $ver;
        
        break;
    case 34:
        $idcot  = $_GET['cot'];
        $id_cos = $_GET['id_cos'];
        $item   = $_GET['item'];
        $por   = $_GET['por'];
        $query = mysqli_query($con, "select id_ci from costos_items where id_cot_item='$item' and id_cos='$id_cos' ");
        $c = mysqli_fetch_array($query);
        if(!$c){
            mysqli_query($con, "insert into costos_items (id_cos,id_cot_item,id_cot, porcentaje_item,fecha_registro,por) "
                    . "values ('$id_cos','$item','$idcot','$por','$fecha','$usuario')");
            echo mysqli_error($con);
        }else{
            mysqli_query($con, "update costos_items set porcentaje_item='$por' where id_cot_item='$item' and id_cos='$id_cos' ");
             echo mysqli_error($con);
        }
         echo mysqli_error($con);
         mysqli_query($con, "update cotizacion set planilla='1' where id_cot='$idcot' ");
        break;
    case 35:
        $item = $_GET['item'];
        $uti = $_GET['uti'];
        mysqli_query($con, "update costos_items set utilidad='$uti' where id_cot_item='$item' ");
        //mysqli_query($con, "update costos_items set utilidad='$uti' where id_cot_principal='$item' ");
        
        break;
    case 36:
        
        
                $resultado = mysqli_query($con,"select count(*), codigo from cotizacion_item where  id_cot=".$_GET['cot']." and id_cot_principal!=0 group by codigo ");
                $contador=0;
                while($c = mysqli_fetch_row($resultado)){
                    $contador ++;
                    //echo $c[1].' '.$c[0];
                }

                if($contador>1){
                    $disabled = 'disabled';
                    $msg = 'No puedes editar, vidrios diferentes';
                }else{
                    $disabled = '';
                    $msg = '';
                }
                $p = array();
                $p[0] = $disabled;
                $p[1] = $msg;
                echo json_encode($p);
      
        break;
    case 37:
        $cot = $_GET['idcot'];
        $iva = $_GET['iva'];
        mysqli_query($con,"update cotizacion set sel_iva='$iva' where id_cot='$cot'  ");
        mysqli_query($con,"update cotizacion_item set iva='$iva' where id_cot='$cot'  ");
        break;
    case 38:
        $item = $_GET['item'];
        $ubc=  $_GET['ubc'];
        $obse=  $_GET['obse'];
        $itemv = $_GET['itemv'];
         mysqli_query($con, "update cotizacion_item set item='$itemv', observacion='$obse',ubicacion='$ubc'  where id_cot_item='$item' ");
         mysqli_error($con);
        
        break;
    case 39:
        $idcot = $_GET['idcot'];
        $cod = $_GET['cod'];
        $can = $_GET['can'];
        $med = $_GET['med'];
        $des = $_GET['des'];
        $uti = $_GET['uti'];
        $obs = $_GET['obs'];
        $id = $_GET['id'];
        $pre = $_GET['pre'];
        $linea = $_GET['linea'];
        $desp = $_GET['desp'];
        $mat_td = $_GET['mat_td'];
        $pt = $_GET['pt'];
        $gt = $_GET['gt'];
        $col = $_GET['col'];
        $aca = $_GET['aca'];
        $item = $_GET['item'];
        if($id==''){
            mysqli_query($con, "insert into cotizaciones_materiales (id_cot_item,acabado,mat_color,id_cotizacion,codigo_material,cantidad_mat, descuento_mat,med,observaciones,valor_und,linea,por_desp,utilidad,valor_pagar,valor_neto)"
                            . " values ('$item','$aca','$col','$idcot','$cod','$can','$des','$med','$obs','$pre','$linea','$desp','$uti','$gt','$pt') ");
            $id = mysqli_insert_id($con);
            $error =  mysqli_error($con);
            mysqli_query($con,"update cotizacion_item set total_material=total_material+'$gt' where id_cot_item='$item' ");
        }else{
            mysqli_query($con, "update cotizaciones_materiales set id_cot_item='$item',acabado='$aca',mat_color='$col',codigo_material='$cod',cantidad_mat='$can',descuento_mat='$des',med='$med',utilidad='$uti',valor_pagar='$gt',valor_neto='$pt' where id_cot_mat='$id' ");
            $error =  mysqli_error($con);
            $result = mysqli_query($con,"select sum(total_material) from cotizaciones_materiales where id_cot_item='$item' ");
            $g = mysqli_fetch_array($result);
            $gt = $g[0];
             mysqli_query($con,"update cotizacion_item set total_material='$gt' where id_cot_item='$item' ");
        }
        
        $p = array();
        $p[0] = $id;
        $p[1] = $error;
        echo json_encode($p);
      
        
        break;
    case 40:
         $lin = $_GET['linea'];
         $desp2 = mysqli_query($con,"select * from porcentajes where nombre= '$lin' ");
         $f = mysqli_fetch_row($desp2);
         echo $f[2];
         
        
        break;
    case 41:
        $cod = $_GET['cod'];
        $color = $_GET['col'];
        $cantidad = $_GET['can'];
        $medida = $_GET['med'];
        
        $des = $_GET['des'];
        $desp = $_GET['por'];
        $uti = $_GET['uti'];
        $desptotal = (100-$desp)/100;
        
        $desp2 = mysqli_query($con,"select costo_aluminio,perimetro from productos where pro_referencia='$cod' ");
         $p = mysqli_fetch_array($desp2);
         $precio = $p[0];
         $perimetro = $p["perimetro"]/1000;
         $medtotal = $medida*$cantidad;
         $perfiles = $medtotal / 6000;
         $precio_total = $precio * ($medtotal/1000);
         include 'costopintura.php';
         $precio_total_acabado = $precio_total + $valor_acabado;
         
         $totadesp = $precio_total_acabado/$desptotal;
         $valor_unidad = $precio_total_acabado / $cantidad;
         $p = array();
         $p[0] = number_format($valor_unidad,2,'.','');
         $p[1] = number_format($precio_total,2,'.','');
         $p[2] = number_format($totadesp,2,'.','');
         $p[3] = number_format($precio_total_acabado,2,'.','');
         $p[4] = number_format($valor_acabado,2,'.','');
         $p[5] = 0;
         echo json_encode($p);
        break;
    case 42:
        $cod = $_GET['id'];
        $query = mysqli_query($con,"select * from cotizaciones_materiales  where id_cot_mat = '$cod' ");
        $f = mysqli_fetch_array($query);
          
            $codigo = $f['codigo_material'];
            if($f['linea']=='Accesorios'){
                 $pro = mysqli_query($con,"select descripcion from productos_var where codigo='$codigo' ");
                 $p = mysqli_fetch_array($pro);
                 $descr = $p[0];
            }else{
                 $pro = mysqli_query($con,"select pro_nombre from productos where pro_referencia='$codigo' ");
                 $p = mysqli_fetch_array($pro);
                 $descr = $p[0];
            }
            $p = array();
            $p[0] = $f[0];
            $p[1] = $f[1];
            $p[2] = $f[2];
            $p[3] = $f[3];
            $p[4] = $f[4];
            $p[5] = $f[5];
            $p[6] = $f[6];
            $p[7] = $f[7];
            $p[8] = $f[8];
            $p[9] = $f[9];
            $p[10] = $f[10];
            $p[11] = $f[11];
            $p[12] = $f[12];
            $p[13] = $f[13];
            $p[14] = $f[14];
            $p[15] = $f[15];
            $p[16] = $f[16];
            $p[17] = $descr;
             $p[18] = $f[10]-$f[15];
             $por = (100-$f[13])/100;
             $td = $f[10] / $por;
             $p[19] = number_format($td,2,'.','');
             $p[20] = $f[17];
            echo json_encode($p);
        
        break;
    case 43:
        $idcot = $_GET['idcot'];
        $cod = $_GET['cod'];
        $desc = $_GET['desc'];
        $precio = $_GET['precio'];
        $pro = $_GET['pro'];
        $can = $_GET['can'];
        $para = $_GET['para'];
        $des = $_GET['des'];
        $uni = $_GET['uni'];
        $total = $_GET['total'];
        $obs = $_GET['obs'];
        $id = $_GET['id'];
        $item = $_GET['item'];
        
       
        if($id==''){
            mysqli_query($con, "insert into cotizaciones_servicios (id_cot_mas,id_cotizacion,id_servicio,descripcion_ser,precio_serv,cantidad_serv,descuento_serv,parafiscales,precio_und,precio_total,cod_ser,obs_servicio,registrado_por)"
                            . " values ('$item','$idcot','$cod','$desc','$precio','$can','$des','$para','$uni','$total','$pro','$obs','$usuario') ");
            $id = mysqli_insert_id($con);
            $error =  mysqli_error($con);
            mysqli_query($con,"update cotizacion_item set total_ins=total_ins+'$total' where id_cot_item='$item' ");
        }else{
            mysqli_query($con, "update cotizaciones_servicios set id_cot_mas='$item',id_servicio='$cod',descripcion_ser='$desc',precio_serv='$precio',cantidad_serv='$can',descuento_serv='$des',precio_und='$uni',precio_total='$total',cod_ser='$pro',obs_servicio='$obs' where id_cot_serv='$id' ");
            $error =  mysqli_error($con);
              $result = mysqli_query($con,"select sum(precio_total) from cotizaciones_servicios where id_cot_mas='$item' ");
              $c = mysqli_fetch_array($result);
              $total= $c[0];
               mysqli_query($con,"update cotizacion_item set total_ins=total_ins+'$total' where id_cot_item='$item' ");
        }
        
        $p = array();
        $p[0] = $id;
        $p[1] = $error;
        echo json_encode($p);
        
        break;
  case 44:
        $cod = $_GET['id'];
        $query = mysqli_query($con,"select * from cotizaciones_servicios  where id_cot_serv = '$cod' ");
        $f = mysqli_fetch_array($query);

            $p = array();
            $p[0] = $f[0];
            $p[1] = $f[1];
            $p[2] = $f[2];
            $p[3] = $f[3];
            $p[4] = $f[4];
            $p[5] = $f[5];
            $p[6] = $f[6];
            $p[7] = $f[7];
            $p[8] = $f[8];
            $p[9] = $f[9];
            $p[10] = $f[10];
            $p[11] = $f[11];
            $p[12] = $f[12];
            $p[13] = $f[13];
            $p[14] = $f[14];
           
            echo json_encode($p);
        
        break;
    case 45:
        $tex = $_GET['tex'];
             $id = $_GET['id'];
        $query = mysqli_query($con,"insert into comentarios (textos_com, id_cotizacion, registrado_com) values ('$tex','$id','$user') ") or die(mysql_error());
         echo $query;
          $id = $_GET['id'];
          mysqli_query($con,"update cotizaciones set cont_item=cont_item+'1' where id_cotizacion='$id' ");
         
         
         
        break;
    case 46:
        $id = $_GET['id'];
        $query = mysqli_query($con,"select * from comentarios where id_cotizacion='$id' order by id_com desc ");
        
        while($r = mysqli_fetch_row($query)){
            echo '<tr><td>'.$r[1].' <button  onclick="borrar_com('.$r[0].','.$id.');"> x</button><br> Reg: '.$r[3].' por '.$r[4].'</td>'
                    . '<tr><td>=========================================================================';
        }
        break;
        case 47:
        $id = $_GET['id'];
        mysqli_query($con,"delete from comentarios where id_com='$id' ");
        break;
     case 48:
        $query = mysqli_query($con,"select * from observaciones_cotizacion where estado=0 ");
        
        while($r = mysqli_fetch_array($query)){
            echo '<tr><td><textarea id="text_1'.$r[0].'"  rows=5 onchange="cambiar_texto('.$r[0].');">'.$r[1].'</textarea></td>'
                    . '<td><button type="button" class="btn btn-primary"  data-dismiss="modal" onclick="salvar_up('.$r[0].');">Seleccionar</button> <button  onclick="borrar_texto('.$r[0].');" class="btn btn-danger" > x</button><br> Ult. Modificacion: '.$r[3].' por '.$r[4].'</td>';
        }
        break;
        case 49:
        $tex = $_GET['tex'];
        $query = mysqli_query($con,"insert into observaciones_cotizacion (texto, por) values ('$tex','$user') ");
         echo $query;

        break;
    case 50:
        $id = $_GET['id'];
        mysqli_query($con,"update observaciones_cotizacion set estado='1', por='$user' where id='$id' ");
        break;
    case 51:
        $id = $_GET['id'];
        $tex = $_GET['tex'];
        
        mysql_query("update observaciones_cotizacion set texto='$tex', por='$user' where id='$id' ");
        break;
    
        
        
        
        
        
    
}
