<?php include '../../../modelo/conexioni.php';
session_start();
$result = mysqli_query($con,"select pvi, nom_ter from cont_terceros where id_ter=".$_GET['id']);
$r = mysqli_fetch_array($result);
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
        <title>Actualizar descuentos</title>
    </head>
    <body>
        
        <fieldset>
            <legend><h3>Actualizar descuentos</h3></legend>
        <form action="" method="post">
            <b>Id Cliente</b><br>
            <input type="text" name="id" value="<?php echo $_GET['id']; ?>" readonly><br>
            <b>Nombre del Cliente</b><br>
            <input type="text" name="nom" value="<?php echo $r[1]; ?>" readonly><br>
            <b>Descuento Max</b><br>
            <input type="text" name="desc" value="<?php echo $r[0]; ?>"><br>
            <input type="submit" name="update" value="Actualizar"> <button type="button" onclick="window.close();">Cerrar</button>
        </form>
        </fieldset>
        <?php
        if(isset($_POST['update'])){
            mysqli_query($con,"update cont_terceros set pvi='".$_POST['desc']."' where id_ter='".$_POST['id']."' ");
            echo '<script>alert("Se actualizo correctamente");window.close();</script>';
        }
        // put your code here
        ?>
    </body>
</html>
