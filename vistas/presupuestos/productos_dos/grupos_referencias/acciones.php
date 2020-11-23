<?php
include('../../../../modelo/conexioni.php');
session_start();
  $ref = $_GET['ref'];
  $des = $_GET['des'];
  $par = $_GET['par'];

  $usuario=$_SESSION['k_username'];
  //echo 'ref:'.$ref.', cod:'.$cod.', par:'.$par.'&sel:'.$sel;
    $ver = mysqli_query($con,"select count(*) from grupos_referencia where referencia='$ref' and modulo='$par' ");
    $v = mysqli_fetch_row($ver);
  
  if($v[0]==0){
           mysqli_query($con,"insert into grupos_referencia (modulo,referencia,descuento) "
                   . "values ('$par','$ref','$des')");
         
          if($par=='Alfajia'){
              $result = mysqli_query($con, "select codigo from producto where tipo_alfajia='true' ");
              $c = '';
              while ($row = mysqli_fetch_array($result)) {
                  $refdt = $row[0];

                  $ver3 = mysqli_query($con,"select count(*) from producto_perfiles where codigo='$refdt' and referencia='$ref' and modulo='$par' ");
                  $ve = mysqli_fetch_row($ver3);

                  if($ve[0]==0){

                          $ver2 = mysqli_query($con,"select pro_nombre from productos where  pro_referencia='$ref'  ");
                          $f = mysqli_fetch_row($ver2);
                          $desopc = $f[0];

                         mysqli_query($con,"INSERT INTO `producto_perfiles` (`perfiles`,`modulo`,`name_opc`, `codigo`, `referencia`, `desc_referencia`, `formula`, `lado`, `lado_ref`, `ope1`, `var1`, `ope2`, `var2`, `cantidad`, `medidas`, `piezas`, `cadav`, `cadah`)"
                        . " VALUES ('Dinamico', '$par','$desopc', '$refdt', '$ref', '$desopc', 'Si', 'Ancho', 'ancho', '-', '0', '-', '0', '1', '1', 'No', '0', '0');");
                   }
              }
          }
           echo 'Se agrego con exito. ';
  }else{

            mysqli_query($con,"update grupos_referencia set descuento='$des' where  referencia='$ref' and modulo='$par'  ");
            echo 'Se edito con exito';
  }

