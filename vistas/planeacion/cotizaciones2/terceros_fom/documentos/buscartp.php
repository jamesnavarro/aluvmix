<?php
include('../../../../../modelo/conexioni.php');
$cod = $_GET['cod'];
$request=mysqli_query($con,"SELECT poriva FROM intercxp where codigo='".$cod."'");
$req = mysqli_fetch_row($request);
echo $req[0];  
   
            
