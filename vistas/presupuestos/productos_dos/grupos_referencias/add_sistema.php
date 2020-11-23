<?php
include('../../../../modelo/conexioni.php');
$id = $_GET['id'];
$sis = $_GET['sis'];
$par='Rieles';
$result = mysqli_query($con, "select count(sistema) from grupos_referencia_sis where sistema='$sis' and codigo='$id' ");
$r = mysqli_fetch_row($result);
if($r[0]==0){
 mysqli_query($con,"insert into grupos_referencia_sis (sistema,codigo) values ('$sis','$id')");
      echo 'Se agrego el sistema a esta referencia';
      

              $result2 = mysqli_query($con, "select codigo from producto where tipo_riel='true' and sistemas like '%".$sis."%' ");
              $c = '';
              while ($row = mysqli_fetch_array($result2)) {
                  $refdt = $row[0];

                  $ver3 = mysqli_query($con,"select count(*) from producto_perfiles where codigo='$refdt' and referencia='$id' and modulo='$par' ");
                  $ve = mysqli_fetch_row($ver3);

                  if($ve[0]==0){

                          $ver2 = mysqli_query($con,"select pro_nombre from productos where  pro_referencia='$id'  ");
                          $f = mysqli_fetch_row($ver2);
                          $desopc = $f[0];

                         mysqli_query($con,"INSERT INTO `producto_perfiles` (`perfiles`,`modulo`,`name_opc`, `codigo`, `referencia`, `desc_referencia`, `formula`, `lado`, `lado_ref`, `ope1`, `var1`, `ope2`, `var2`, `cantidad`, `medidas`, `piezas`, `cadav`, `cadah`)"
                        . " VALUES ('Dinamico', '$par','$desopc', '$refdt', '$id', '$desopc', 'Si', 'Ancho', 'ancho', '-', '0', '-', '0', '1', '1', 'No', '0', '0');");
                   }
              }
          
}else{
      echo 'Ya este sistema existe';
}


