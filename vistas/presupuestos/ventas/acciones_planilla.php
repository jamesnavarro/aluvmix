<?php
include '../../../modelo/conexioni.php';
session_start();
$usuario = $_SESSION['k_username'];
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){
      case 1:
      $titem = $_GET['item'];
      $cot = $_GET['cot'];
      $total_alum = $_GET['t_alu'];
      $tvid = $_GET['t_vid'];
      $suma_acc = $_GET['t_acc'] + $_GET['t_kit'] + $_GET['t_adi'];
      $fabricacion = $_GET['t_mob'];// * 1.45;
      $instalacion = $_GET['t_ins'];
      $poli = $_GET['t_pol'] * 1.45;
      $total_costo = $_GET['total_costo'];
      
              mysqli_query($con, "DELETE FROM `costo_totales` WHERE `id_cotizaciones` = '".$titem."'");

            if($vr2!=0){
               $aluminio = mysql_query("select count(id_cot) from costo_totales where id_cot='".$cot."' and id_cotizaciones='".$titem."' and tipo_costo='Aluminio' and id_cotizacion_mas=0 ");
               $at = mysql_fetch_row($aluminio);
               if($at[0]==0){
                  $ver =  mysql_query("insert into costo_totales (id_cot,id_cotizaciones, tipo_costo,unidad_med,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                           . " values ('".$cot."','".$titem."','Aluminio','Ml','$vr2','$porca','$contador_alu','$ptt') ") or die(mysql_error());
               }

            }

        
        break;
    
}

