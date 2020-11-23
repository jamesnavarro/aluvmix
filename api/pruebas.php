<?php
include 'conexion.php';
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
        <title></title>
    </head>
    <body>
        <?php
        $result = mysqli_query($conw,"select * from conector");
        $r = mysqli_fetch_array($result);
        echo $r[0];
        ?>
    </body>
</html>
