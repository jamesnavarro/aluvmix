<option value="0">Ninguno</option>
<?php
include '../../../modelo/conexion.php';
$query = mysqli_query($conexion,"select * from puestos where sede='".$_GET['sede']."' ");
while ($row = mysqli_fetch_array($query)) {
    echo '<option value="'.$row[0].'">'.$row[3].'</option>';
    //3339998  1.140.848.158
}