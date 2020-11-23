<?php
include '../../../modelo/conexioni.php';
        ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Jerarquias de costos</title>
        		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                <link href="../../../css/estilo.css" rel="stylesheet">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
                <script src="../../../js/jquery.min.js"></script>
                <script src="../../../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
                <script src="funciones.js"></script>
    </head>
    <body>
    <center><h3>Jerarquía de Centros de Costo </h3></center>
    <ul>
        <?php
         $result = mysqli_query($con, "select * from clases_centros");
         while ($a = mysqli_fetch_array($result)){
             echo '<li onclick="ver_clases('.$a[0].')">'.$a[0].'-'.$a[1].'</li>';
               $result2 = mysqli_query($con, "select * from areascc where are_codigo like '".$a[0]."%' ");
               echo '<ul>';
               while ($b = mysqli_fetch_array($result2)){
                  echo '<li>'.$b[0].'-'.$b[1].'</li>';
                     $result3 = mysqli_query($con, "select * from centrocostos where cen_codigo like '".$b[0]."%' ");
                     echo '<ul>';
                     while ($c = mysqli_fetch_array($result3)){
                        echo '<li>'.$c[0].'-'.$c[1].'</li>';
                     }
                     echo '</ul>';
              }
              echo '</ul>';
         }
        ?>
    </ul>
        
    </body>
</html>
